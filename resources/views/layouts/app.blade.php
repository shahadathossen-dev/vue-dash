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

    <script type="text/javascript">
    $(document).ready(function() {

        // Laravel ajax-token integration
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
    });


    </script>
    <!-- Owl Carousel Slide -->

    {{-- <script src="{{asset('js/app.js')}}"></script> --}}
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ asset('frontend') }}/js/easing.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/main.js"></script>

</body>
</html>
