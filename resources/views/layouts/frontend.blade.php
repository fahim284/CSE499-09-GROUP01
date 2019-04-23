<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    
    <title>@section('title') Redprint App Builder @show</title>

    @section('css')

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

      <!-- Bootstrap CSS File -->
      <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

      <!-- Libraries CSS Files -->
      <link href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/animate/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

      <!-- Main Stylesheet File -->
      <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    @show
    @yield('head-js')

  </head>

  <body id="page-top">

    @section('topbar')
      <section id="topbar" class="d-none d-lg-block">
        <div class="container clearfix">
          <div class="contact-info float-left">
            <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">contact@example.com</a>
            <i class="fa fa-phone"></i> +0 0000 00000 00
          </div>
          <div class="social-links float-right">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div>
        </div>
      </section>
    @show

    @section('nav')
      <header id="header">
        <div class="container" id="body">

          <div id="logo" class="pull-left">
            <a href="/"><img style="width: 120px;" src="{{ asset('frontend/images/redprint_default.png') }}" alt="" title="" /></a>
          </div>

          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li class="menu-active"><a href="#body">Home</a></li>
              <li><a href="#about">About Redprint</a></li>
              <li class="menu-has-children"><a href="">Drop Down</a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                  <li><a href="#">Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="/backend/login" class="btn btn-warning">BACKEND</a></li>
            </ul>
          </nav><!-- #nav-menu-container -->
        </div>
      </header><!-- #header -->
    @show

    @section('intro')
    @show

    <main id="main">
      <section id="body" class="wow fadeInUp">
        <div class="container" style="min-height: 800px;">
          @yield('content')
        </div>
      </section>
    </main>
    
    @section('footer')
      <footer id="footer">
        <div class="container">
          <div class="copyright">
            &copy; Copyright <strong>Redprint</strong>. All Rights Reserved
          </div>
        </div>
      </footer><!-- #footer -->

      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    @show

    @section('js')
      <!-- JavaScript Libraries -->
      <script src="frontend/vendor/jquery/jquery.min.js"></script>
      <script src="frontend/vendor/jquery/jquery-migrate.min.js"></script>
      <script src="frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="frontend/vendor/easing/easing.min.js"></script>
      <script src="frontend/vendor/superfish/hoverIntent.js"></script>
      <script src="frontend/vendor/superfish/superfish.min.js"></script>
      <script src="frontend/vendor/wow/wow.min.js"></script>
      <script src="frontend/vendor/owlcarousel/owl.carousel.min.js"></script>
      <script src="frontend/vendor/magnific-popup/magnific-popup.min.js"></script>
      <script src="frontend/vendor/sticky/sticky.js"></script>
      <!-- Template Main Javascript File -->
      <script src="frontend/js/main.js"></script>
    @show
    @yield('post-js')
  </body>

</html>
