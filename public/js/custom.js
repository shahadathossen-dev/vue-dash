

        function submitContactForm(){
            $("form").on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'), // Get the action URL to send AJAX to
                    type: "post",
                    data: new FormData(this), // get all form variables
                    success: (response => {
                        return response;
                    }),
                    error: (e => {
                        return e;
                    }),
                })
            });
        }

        export {submitContactForm}

