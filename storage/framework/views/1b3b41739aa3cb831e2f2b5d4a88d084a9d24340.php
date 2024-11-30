<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
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
    <meta name="twitter:image" content="<?php echo e(asset('l_assets/img/twittercardimg/twittercard-280-150.jpg')); ?>"/>
    <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends from here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="Your home page title"/>
    <meta property="og:url" content="http://your domain here.com"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:site_name" content="Your site name here"/>
    <!--meta property="fb:admins" content="" /-->  <!-- use this if you have  -->
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="<?php echo e(asset('l_assets/img/opengraph/fbphoto.jpg')); ?>"/>
    <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends from here -->

    <!--  FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('l_assets/img/favicon.ico')); ?>"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('l_assets/img/favicon.ico')); ?>"/>
    <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-57x57.png')); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-60x60.png')); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-72x72.png')); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-76x76.png')); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-114x114.png')); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-120x120.png')); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-144x144.png')); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-152x152.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('l_assets/img/favicon/apple-icon-180x180.png')); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('l_assets/img/favicon/android-icon-192x192.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('l_assets/img/favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('l_assets/img/favicon/favicon-96x96.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('l_assets/img/favicon/favicon-16x16.png')); ?>">


    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/bootstrap/css/bootstrap.min.css')); ?>" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/fontawesome/css/font-awesome.min.css')); ?>" media="all"/>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/maginificpopup/magnific-popup.css')); ?>" media="all"/>

    <!-- Time Circle -->
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/timer/TimeCircles.css')); ?>" media="all"/>

    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/owlcarousel/owl.carousel.min.css')); ?>" media="all" />
    <link rel="stylesheet" href="<?php echo e(asset('l_assets/libs/owlcarousel/owl.theme.default.min.css')); ?>" media="all" />

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald:400,700%7cRaleway:300,400,400i,500,600,700,900"/>

    <!-- MASTER  STYLESHEET  -->
    <link id="lgx-master-style" rel="stylesheet" href="<?php echo e(asset('l_assets/css/style-default.min.css')); ?>" media="all"/>
    
    <!-- SWAL -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>


    <!-- MODERNIZER CSS  -->
    <script src="<?php echo e(asset('l_assets/js/vendor/modernizr-2.8.3.min.js')); ?>"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<!-- TEMPLATE SIDEBAR CSS -->
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidebar {
  height: 150px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 10;
  right: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  margin-top: 150px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media  screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}

</style>
<!-- TEMPLATE SIDEBAR CSS END -->

<!-- TOGGLE SWITCH CSS -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 24px;
  width: 24px;
  left: 0px;
  bottom: 0px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 24px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<!-- TOGGLE SWITCH CSS END -->


<!-- CROPPER JS CSS -->
<style type="text/css">
img {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px; 
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
</style>
<!-- CROPPER JS CSS END -->

<?php echo $__env->yieldContent('page-css'); ?>
</head>

<body class="home">
    
    
<div id="mySidebar" class="sidebar">
    <?php
        $selectedEvent=Session('selectedEvent');
    ?>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <?php $__currentLoopData = $templateData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $td): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <a href="landingPage?template=<?php echo e(base64_encode($td->tm_id)); ?>" onclick="selectTemp('<?php echo e($td->tm_id); ?>', '<?php echo e($selectedEvent->aem_id); ?>');" ><?php echo e($td->tm_name); ?></a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>    
    
<?php echo $__env->yieldContent('main-content'); ?>

<?php echo $__env->make('layouts.modal-lpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- *** ADD YOUR SITE SCRIPT HERE *** -->
<!-- JQUERY  -->
<script src="<?php echo e(asset('l_assets/js/vendor/jquery-1.12.4.min.js')); ?>"></script>

<!-- BOOTSTRAP JS  -->
<script src="<?php echo e(asset('l_assets/libs/bootstrap/js/bootstrap.min.js')); ?>"></script>

<!-- Smooth Scroll  -->
<script src="<?php echo e(asset('l_assets/libs/jquery.smooth-scroll.js')); ?>"></script>

<!-- SKILLS SCRIPT  -->
<script src="<?php echo e(asset('l_assets/libs/jquery.validate.js')); ?>"></script>

<!-- if load google maps then load this api, change api key as it may expire for limit cross as this is provided with any theme -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQvRGGtL6OrpP5xVMxq_0NgiMiRhm3ycI"></script>

<!-- CUSTOM GOOGLE MAP -->
<script type="text/javascript" src="<?php echo e(asset('l_assets/libs/gmap/jquery.googlemap.js')); ?>"></script>

<!-- adding magnific popup js library -->
<script type="text/javascript" src="<?php echo e(asset('l_assets/libs/maginificpopup/jquery.magnific-popup.min.js')); ?>"></script>

<!-- Owl Carousel  -->
<script src="<?php echo e(asset('l_assets/libs/owlcarousel/owl.carousel.min.js')); ?>"></script>

<!-- COUNTDOWN   -->
<script src="<?php echo e(asset('l_assets/libs/countdown.js')); ?>"></script>
<script src="<?php echo e(asset('l_assets/libs/timer/TimeCircles.js')); ?>"></script>

<!-- Counter JS -->
<script src="<?php echo e(asset('l_assets/libs/waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('l_assets/libs/counterup/jquery.counterup.min.js')); ?>"></script>

<!-- SMOTH SCROLL -->
<script src="<?php echo e(asset('l_assets/libs/jquery.smooth-scroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('l_assets/libs/jquery.easing.min.js')); ?>"></script>

<!-- type js -->
<script src="<?php echo e(asset('l_assets/libs/typed/typed.min.js')); ?>"></script>

<!-- header parallax js -->
<script src="<?php echo e(asset('l_assets/libs/header-parallax.js')); ?>"></script>

<!-- instafeed js -->

<script src="<?php echo e(asset('l_assets/libs/instafeed.min.js')); ?>"></script>

<!-- CUSTOM SCRIPT  -->
<script src="<?php echo e(asset('l_assets/js/custom.script.js')); ?>"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" ></script>



<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        
<?php echo $__env->make('layouts.script-lpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/layouts/lpage-master.blade.php ENDPATH**/ ?>