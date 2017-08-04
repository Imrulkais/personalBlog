 <!DOCTYPE html>
<html>
    <head>
        <title>Imrul Kais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="{{asset('dist/images/favicon.png')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('dist/css/custom.css')}}">
        <script src="{{asset('dist/js/angular.js')}}" type="text/javascript"></script>
        <script src="{{asset('dist/js/jqueryui.js')}}" type="text/javascript"></script>
        <script src = "{{asset('bootstrap/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src = "{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

        <script type="text/javascript">
            $("document").ready(function ($) {
                var nav = $('#main-menu-container');
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 5) {
                        nav.addClass("f-nav");
                    } else {
                        nav.removeClass("f-nav");
                    }
                });
            });

            var GlobalApp = angular.module('GlobalApp', [], function ($interpolateProvider) {
                $interpolateProvider.startSymbol('[[');
                $interpolateProvider.endSymbol(']]');
            });

        </script>
    </head>
    <body ng-app="GlobalApp">	
        <div class="container">
            <p style="text-align: right;margin-bottom: 0;"><a href="#">EN</a>|<a href="http://localhost/personal-website/Working/bn/">BN</a></p>
            <div id="main-menu-container">
                <div id="main-menu">
                    <nav class="navbar navbar-default ">

                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span> 
                                </button>
                                <a class="navbar-brand" href="{{ url('/')}}"><img class="img-responsive header_icon" src="{{asset('dist/images/header_icon.png')}}">Md. Imrul Kais</a>
                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="{{ url('about')}}">ABOUT ME</a></li>
                                    <li><a href="{{ url('portfolio')}}">PORTFOLIO</a></li>
                                    <li><a href="{{ url('blog')}}">BLOG</a></li>
                                    <li><a href="{{ url('contact')}}">CONTACT</a></li>
                                    <?php if (Auth::check()) { ?> <li><a href="{{ url('logout')}}">LOGOUT</a></li <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        @yield('content')

        <div class="clearfix"></div>
        <div class="full_footer">
            <div class="container">
                <div class="left_footer">Powered by PHP(Laravel)</div>
                <div class="right_footer">
                    <div class="social-popout"><a href="#"><img src="{{asset('dist/images/facebook.png')}}" alt="facebook" /></a></div>
                    <div class="social-popout"><a href="#"><img src="{{asset('dist/images/twitter.png')}}" alt="twitter" /></a></div>
                    <div class="social-popout"><a href="#"><img src="{{asset('dist/images/googleplus.png')}}" alt="googleplus" /></a></div>
                    <div class="social-popout"><a href="#"><img src="{{asset('dist/images/linkedin.png')}}" alt="linkedin" /></a></div>

                </div>
            </div>
        </div>

    </body>
</html>

