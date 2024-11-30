<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- The above 3 meta tags *must* come first in the head -->

    <!-- SITE TITLE -->
    <title>Emeet</title>
    <meta name="description" content="Responsive Emeet HTML Template"/>
    <meta name="keywords" content="Bootstrap3, Event,  Conference, Meetup, Template, Responsive, HTML5"/>
    <meta name="author" content="themearth.com"/>

    <!-- twitter card starts from here, if you don't need remove this section -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@yourtwitterusername"/>
    <meta name="twitter:creator" content="@yourtwitterusername"/>
    <meta name="twitter:url" content="http://yourdomain.com"/>
    <meta name="twitter:title" content="Your home page title, max 140 char"/>
    <!-- maximum 140 char -->
    <meta name="twitter:description" content="Your site description, maximum 140 char "/>
    <!-- maximum 140 char -->
    <meta name="twitter:image" content="{{asset('l_assets/img/twittercardimg/twittercard-280-150.jpg')}}"/>
    <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends from here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="Your home page title"/>
    <meta property="og:url" content="http://your domain here.com"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="Your site name here"/>
    <!--meta property="fb:admins" content="" /-->  <!-- use this if you have  -->
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{asset('l_assets/img/opengraph/fbphoto.jpg')}}"/>
    <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends from here -->

    <!--  FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('l_assets/img/favicon.ico')}}"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="{{asset('l_assets/img/favicon.ico')}}"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('l_assets/img/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('l_assets/img/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('l_assets/img/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('l_assets/img/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('l_assets/img/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('l_assets/img/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('l_assets/img/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('l_assets/img/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('l_assets/img/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('l_assets/img/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('l_assets/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('l_assets/img/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('l_assets/img/favicon/favicon-16x16.png')}}">


    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{asset('l_assets/libs/bootstrap/css/bootstrap.min.css')}}" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{asset('l_assets/libs/fontawesome/css/font-awesome.min.css')}}" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{asset('l_assets/libs/maginificpopup/magnific-popup.css')}}" media="all"/>

    <!-- Time Circle -->
    <link rel="stylesheet" href="{{asset('l_assets/libs/timer/TimeCircles.css')}}" media="all"/>

    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="{{asset('l_assets/libs/owlcarousel/owl.carousel.min.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('l_assets/libs/owlcarousel/owl.theme.default.min.css')}}" media="all" />

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald:400,700%7cRaleway:300,400,400i,500,600,700,900"/>

    <!-- MASTER  STYLESHEET  -->
    <link id="lgx-master-style" rel="stylesheet" href="{{asset('l_assets/css/style-default.min.css')}}" media="all"/>

    <!-- MODERNIZER CSS  -->
    <script src="{{asset('l_assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body class="home" >

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="container-fluid">
<!-- ***  ADD YOUR SITE CONTENT HERE *** -->
<div class="row">
    <div class="col-lg-2">
         <nav class="navbar bg-light">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#demo" data-toggle="collapse">Page template</a>
              <div id="demo" class="collapse">
              <select class="form-control" id="pagetemp">
              <option value="simple">simple</option>
              <option value="modern">Mordern</option>
              </select>
               </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Page Style</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Page Content</a>
            </li>
          </ul>
        </nav>
    </div>
    <div class="col-lg-10">


@yield('content')


