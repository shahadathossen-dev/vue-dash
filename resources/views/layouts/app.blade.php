<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Krada Studio, Delivery Haste" />
    <meta name="description" content="Krada Studio is a super powerful desktop and mobile game organization in the world" />
    <meta name="author" content="Shahadat Hossen" />

    <!-- shortcut/favicon icons -->
    <link rel="favicon" href="{{asset('frontend')}}/img/favicon.png">
    <link rel="shortcut icon" href="{{asset('frontend')}}/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend')}}/img/favicon.png">
    <!-- short cut cions -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{str_replace('-', ' ', config('app.name'))}} | @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Fonts -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/bootstrap.min.css" />
    <!-- Split Slider CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/banner.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/animate.css" />
    <!-- //Split Slider CSS -->

    <!-- AOS CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/js/aos/aos.css" />
    <!-- AOS CSS -->

    <!-- light Gallery CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/lightGallery.css" type="text/css" media="all" />
    <!-- // light Gallery CSS -->

    <!-- Jarallax CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/js/jarallax/jarallax.css" />
    <!-- Jarallax CSS -->

    <!-- Owl Carousel Slide -->
    <link href="{{asset('frontend')}}/css/owl.theme.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.css" type="text/css" media="all">
    <!-- Owl Carousel Slide -->

    <!-- Toastr CSS -->
    <link href="{{asset('vendor')}}/toastr/dist/jquery.toast.min.css" rel="stylesheet">
    <!-- Toastr CSS -->

    <!-- Custom CSS -->
    <link href="{{asset('frontend')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/responsive.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('frontend') }}/js/modernizr.min.js"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/styleNoJS.css" />
    </noscript>
    <!-- Split Slider CSS -->
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>

    @stack('styles')

</head>
<body class="">
    <!-- Preloader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->

    {{-- header section --}}
    <header class="">
        <nav class="navbar navbar-expand-lg bg-shadow fixed-top">
            <div class="container">
            <a class="navbar-brand text-white" href="{{route('welcome')}}"><img class="extended" src="{{ asset('frontend')}}/img/logo-white.png" alt="{{str_replace('-', ' ', config('app.name'))}}" style=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fas fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav slide-effect navbar-right text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="#home">
                                <span data-hover="Home">
                                    Home
                                </span>
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">
                                <span data-hover="Gallery">
                                    Gallery
                                </span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#projects">
                                <span data-hover="Games">
                                    Games
                                </span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">
                                <span data-hover="Contact">
                                    Contact
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">
                                <span data-hover="About">
                                    About
                                </span>
                            </a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown link
                            </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                        </li> -->
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    {{-- header section --}}


    <main id="app">

        @yield('content')

    </main>


    <!-- footer section -->
    <footer class="footer">
        <div class="container ">
            <div class="row ">
                <div class="col-md-4 footer-left">
                    <div class="logo_container">
                        <div class="logo"><a href="#">Krada Studio</a></div>
                    </div>
                    <div class="footer_column footer_contact">
                        <!-- <div class="footer_title">Got Question? Call Us 24/7</div>
                        <div class="footer_phone"><i class="topbar-social-item fa fa-phone"></i> +880-1847-277630</div>
                        <div class="footer_contact_text">
                            <p>124/A, Chowrangi Bhaban (4th floor),</p>
                            <p> New Elephant Road, Dhaka-1205</p>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="footer-right">
                        <div class="row">
                            <div class="col footer-menu">
                                <h3>Who We Are</h3>
                                <ul>
                                    <li><a href="#about">About Us</a></li>
                                    <!-- <li><a href="contact.html">24 / 7 Help Center</a></li> -->
                                </ul>
                            </div>
                            <div class="col footer-menu">
                                <h3>What We Do</h3>
                                <ul>
                                    <li><a href="#projects">Our Products</a></li>
                                    <!-- <li><a href="#">Careers</a></li> -->
                                </ul>
                            </div>
                            <div class="col footer-menu last">
                                <h3>Terms & Conditions</h3>
                                <ul>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <!-- <li><a href="#">Advertising Policy</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- Copyright -->
    <div class="copyright">
        <p>© 2020 Krada Studio. All Rights Reserved</p>
    </div>
    <!-- //Copyright -->

    <!-- Scroll to Top -->
    <span id="scroll-top" class="btn btn-default smooth-scroll" title="Home" role="button" style="display: none;">
        <img src="{{asset('frontend')}}/img/top-arrow.svg" width="30" height="40" class="" alt="">
    </span>
    <!-- //Scroll to Top -->
    <!-- //footer section-->


    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <!-- Toastr loades js -->
    <script type="text/javascript" src="{{ asset('vendor') }}/toastr/dist/jquery.toast.min.js"></script>

    <!-- Images loades js -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/imagesLoaded.js"></script>
    <script>
        // init imagesLoaded
        $('body').imagesLoaded( function() {
            $('body').addClass('loaded');
        });

        // Activate menu on scroll
        $.fn.isInViewport = function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();

            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height() / 2;

            return elementTop >= viewportTop && elementTop < viewportBottom;
        };

        $(document).ready( function() {
            // init WOW
            // new WOW().init();
            var navbarHeight = $('nav').height();
            // $('#home').css('margin-top', navbarHeight);

            var OnePageNavigation = function() {
                $("body").on("click", ".navbar-nav li a[href^='#']", function(e) {
                    e.preventDefault();
                    var hash = this.hash;

                    $('html, body').animate({
                        'scrollTop': $(hash).offset().top - navbarHeight
                    }, 2000, 'easeInOutCirc');

                    // $('html, body').animate({
                    //     'scrollTop': $(hash).offset().top - 70
                    // }, 2000, 'easeInOutCirc', function(){
                    //     window.location.hash = hash;
                    // });
                });
            };
            OnePageNavigation();

            $menu = $( '.navbar-nav > li' );

            $menu.each( function( i ) {

                $( this ).on( 'click', function( event ) {

                    var $current = $( this );

                    if( ! $current.hasClass('active') ) {

                        $menu.removeClass( 'active' );
                        $current.addClass( 'active' );

                    }

                    return true;

                });

            });


            $(window).on('resize scroll', function() {

                $menu.each( function( i ) {

                    var $current = $( this );
                    var $section = $current.children('a').attr('href');

                    if ($($section).isInViewport()) {
                        if( ! $current.hasClass('active') ) {

                            $menu.removeClass( 'active' );
                            $current.addClass( 'active' );

                        }

                        return true;

                    }

                });
            });

        });
    </script>
    <!-- Images loades js -->

    <!-- fontawesome Js -->
    {{-- <script type="text/javascript" src="{{ asset('frontend') }}/js/font-awesome.min.js"></script> --}}

    <!-- Jarallax Js -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jarallax/ofi.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jarallax/jarallax.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jarallax/jarallax-video.js"></script>
    {{-- <script src="{{ asset('frontend') }}/js/jarallax/buttons.min.js"></script> --}}
    <script type="text/javascript">
        // object-fit polyfill run
        objectFitImages();

        /* init Jarallax */
        jarallax(document.querySelectorAll('.jarallax'));

        jarallax(document.querySelectorAll('.jarallax-keep-img'), {
            keepImg: true,
        });
    </script>
    <!-- Jarallax Js -->
    <!-- js for banner section -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery.slitslider.js"></script>
    <script type="text/javascript">
        var videoInterval = $('.sl-slider .jarallax').data('length');
        $.Slitslider.defaults = {
            // transitions speed
            speed : 1500,
            // if true the item's slices will also animate the opacity value
            optOpacity : true,
            // amount (%) to translate both slices - adjust as necessary
            translateFactor : 100,
            // maximum possible angle
            maxAngle : 25,
            // maximum possible scale
            maxScale : 1,
            // slideshow on / off
            autoplay : false,
            // keyboard navigation
            keyboard : true,
            // time between transitions
            interval : 3000,
            // time video transitions
            videoInterval : $('.sl-slider .jarallax').data('length'),

            // callbacks
        };

        $(function() {

            var Page = (function() {

                var $navArrows = $( '#nav-arrows' ),
                    $nav = $( '#nav-dots > span' ),
                    slitslider = $( '#slider' ).slitslider({
                        onBeforeChange : function( slide, pos ) {
                            $nav.removeClass( 'nav-dot-current' );
                            $nav.eq( pos ).addClass( 'nav-dot-current' );
                            return false;
                        },
                        onAfterChange: function(slide, pos)
                        {
                            if(pos == 0)
                            {
                                slitslider._stopSlideshow();
                                slitslider.options.interval = $.Slitslider.defaults.videoInterval;
                                slitslider._startSlideshow(); // added
                            } else {
                                slitslider._stopSlideshow(); // added
                                slitslider.options.interval = $.Slitslider.defaults.interval;
                                slitslider._startSlideshow();
                            }

                            // slitslider._startSlideshow(); // Starts the autoplay again
                            return false;
                        }
                    });

                init = function() {
                    initEvents();
                    if(slitslider.current == 0)
                    {
                        slitslider._stopSlideshow();
                        setTimeout(
                            function(){
                                slitslider._startSlideshow();
                            }, $.Slitslider.defaults.videoInterval
                        )
                    }
                },

                initEvents = function() {

                    // add navigation events
                    $navArrows.children( ':last' ).on( 'click', function()
                    {
                        // original
                        slitslider.next();
                        return false;
                    });

                    $navArrows.children( ':first' ).on( 'click', function()
                    {
                        // original
                        slitslider.previous();
                        return false;
                    } );

                    $nav.each( function( i ) {

                        $( this ).on( 'click', function( event ) {

                            var $dot = $( this );

                            if( !slitslider.isActive() ) {

                                $nav.removeClass( 'nav-dot-current' );
                                $dot.addClass( 'nav-dot-current' );

                            }

                            slitslider.jump( i + 1 );
                            return false;

                        });

                    });

                };

                return { init : init };

            })();

            Page.init();

        });
    </script>
    <!-- js for banner section -->

    <!-- Gallery-Section -->
	<script type="text/javascript" src="{{ asset('frontend') }}/js/lightGallery.js"></script>
	<script type="text/javascript">
    	$(document).ready(function() {
			$(".lightGallery").lightGallery({
				mode:"fade",
				speed:800,
				caption:true,
				desc:true,
				mobileSrc:true
			});
		});
    </script>
    <!-- Gallery-Section -->

    <!-- Animation Js -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/aos/aos.js"></script>
    <script type="text/javascript">
        AOS.init();
    </script>
    <!-- Animation Js -->

    <!-- Owl Carousel Slide -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/owl.carousel.js"></script>

    {{-- {!! NoCaptcha::renderJs() !!} --}}

    <script type="text/javascript">
    $(document).ready(function() {

        $("#owl-demo").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds
            autoPlay : true,
            navigation :true,
            items : 4,
            itemsDesktop : [640,5],
            itemsDesktopSmall : [414,4]

        });

        // Laravel ajax-token integration
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });

        $("#messageForm [name]").each(function() {
            $(this).on('focusout', function(){
                let inputField = $(this),
                     targetIchiro = inputField.parents('.input');
                     inputFilled = inputField.val();
                if(inputFilled) {
                    targetIchiro.addClass('input-filled');
                    console.log(inputFilled);
                } else {
                    targetIchiro.removeClass('input-filled');
                }
            });
        });

        $("#messageForm").on("submit", function (event) {
            event.preventDefault();
            // let isHuman = $('form input[type=submit]').val();
            // Google recaptcha check
            let isHuman = grecaptcha.getResponse();
            if(isHuman){
                $('form button[type=submit] span').html('Sending Your Message...');
                $('form button[type=submit]').attr('disabled', true);
                $.ajax({
                    url: $(this).attr('action'), // Get the action URL to send AJAX to
                    type: "post",
                    data: new FormData(this), // get all form variables
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (res => {
                        $('form button[type=submit] span').html('Send Message');
                        $('form button[type=submit]').attr('disabled', false);
                        $.toast({
                            text : res.message,
                            showHideTransition : 'slide',  // It can be plain, fade or slide
                            bgColor : 'green',              // Background color for toast
                            // textColor : '#eee',            // text color
                            allowToastClose : false,       // Show the close button or not
                            hideAfter : 5000,              // `false` to make it sticky or time in miliseconds to hide after
                            textAlign : 'left',            // Alignment of text i.e. left, right, center
                            position : 'bottom-right'       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                        });
                        $(this).find("input, textarea").not('input[type=submit]').val("");
                        $(this).find("input, textarea").parent('.input').removeClass('input-filled');
                    }),
                    error: (err => {
                        $('form input[type=submit]').html('Send Message');
                        $('form input[type=submit]').attr('disabled', false);
                        errorProcess(err)
                    }),
                })
                $('.refresh-button').click();
            } else {
                let xhr = {responseJSON: {message: 'Please, fill the recaptcha to verify that you are human.'}};
                errorProcess(xhr)
            }

        });


        // SHOW RESPECTIVE VALIDATION ERROR MESSAGES
        function errorProcess(xhr){
            if (xhr.status == 422) {
                var errors_obj = JSON.parse(xhr.responseText);
                var errors = errors_obj.errors;
                for (name in errors) {
                    if(name == 'g-recaptcha-response')
                    {
                        $('.error-msg').html(errors[name][0])
                    } else {

                        $("[name="+name+"]").siblings('.alert').children('.error').html(errors[name][0]);
                        $("[name="+name+"]").siblings('.alert').slideDown();
                    }
                }
            } else {
                $.toast({
                    text : xhr.responseJSON.message,
                    showHideTransition : 'slide',  // It can be plain, fade or slide
                    bgColor : '#333333',              // Background color for toast
                    textColor : '#ddd',            // text color
                    allowToastClose : false,       // Show the close button or not
                    hideAfter : 5000,              // `false` to make it sticky or time in miliseconds to hide after
                    textAlign : 'left',            // Alignment of text i.e. left, right, center
                    position : 'bottom-right'       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                });
            }
        }

        // VALIDATION MESSAGE CLOSE
        $('.close').on('click', function(e){
            var alert = $(this).parent();
            alert.slideUp();
        })

    });
    </script>
    <!-- Owl Carousel Slide -->

    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/easing.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/main.js"></script>

</body>
</html>
