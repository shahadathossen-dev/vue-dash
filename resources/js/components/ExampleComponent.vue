<template>
    <!-- Navbar -->
    <div class="container">
        I am from Example Component.
    </div>
<!-- Navbar -->
</template>

<script>
    export default {
        data : function() {
                return {
                    // notifications : [],
                }
            },
        props: ['notificationRoute', 'authUser'],
        filters: {
            dateTime: function (datetime) {
                if (!datetime) {
                    return 'N/A'
                }
                return moment(datetime).format('YYYY-MM-DD HH:mm:ss');
                // return moment(date, 'YYYY-MM-DD').format(format);
            },
        },
        methods: {
            getNotifications(){
                axios.get(this.notificationRoute)
                    .then(res=>{
                        this.$nextTick(function () {
                            this.notifications = res.data;
                        });
                    })
                    .catch(e=>{
                        alert(e);
                    })
            },
        },

        created () {
        },
        mounted() {

            this.getNotifications();
            Echo.private('App.Models.Backend.User.' + this.authUser)
                .notification((notification) => {
                    this.getNotifications();
                    this.$toastr.info(notification.message, notification.title);

                });
            // Subscribe to public notifications
            Echo.private('App.Models.Backend.User')
                .notification((notification) => {
                    console.log(notification);
                });
        }
    }
</script>
