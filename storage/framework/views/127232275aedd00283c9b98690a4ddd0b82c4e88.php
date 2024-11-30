<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">


<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
<style>
    .multiselect-container .checkbox input{    position: inherit;
    opacity: 1;
    height: auto;
    width: auto;}
    
    .my-multiselect .btn-default {
      background: #f8f9fa;
    border: 1px solid #ced4da;
    color: #47404f;
    padding: 6px 10px 2px 10px;
    height: auto;
    width:100%;

    border-radius: 4px !important;
}
.breadcrumb ul li {
    display: inline;
    position: relative;
    padding: 0 0.5rem;
    line-height: 1;
    vertical-align: bottom;
    color: #70657b;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Manage Unity Content</h1>
                <ul>
                  <li><a href="manageassetlibrary">View List</a></li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div>
                <iframe id="unityIframe" src="https://induction.ibentos.com/<?php echo e($bm_name); ?>/?user_type=admin" width="100%" height="500"></iframe>
            </div>
            


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



  <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
 <script type="text/javascript">
 
    function LoadUnityContentEditor()
    {
        //do nothing
    }
    LoadUnityContentEditor();
 </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/manageunitycontent/index.blade.php ENDPATH**/ ?>