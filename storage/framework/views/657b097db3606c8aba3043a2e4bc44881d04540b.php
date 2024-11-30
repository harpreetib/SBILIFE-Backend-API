<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">

<style>
.avatar-lg {
    width: 150px;
    height: 150px;
}

.user-profile .user-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: unset;
    margin-top: -28px;
    z-index: 9;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<?php  
    $profile_pic="/public/assets/images/faces/University-Logo.png"; 
    if(!empty($profileDetail->exhim_logo)){
        $profile_pic='/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_logo;
    }
    
?>

<div class="breadcrumb">
    <h1>Settings</h1>
    <ul>
        <!--<li><a href="">Pages</a></li>-->
        <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
        
    </ul>
</div>

            <div class="separator-breadcrumb border-top"></div>
            

                                    
                                    
                                    <!-- Settings List-->
                <div class="row">
                    <?php $__currentLoopData = $settinngsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $settings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <?php if($settings->afm_id==2): ?>
                     
                        <div class="col-lg-3 mb-3">
                            <div class="card card-body ul-border__bottom">
                                <div class="text-center">
                                    <h5 class="heading text-primary"><?php echo e($settings->afm_name); ?></h5>
                                    <p class="mb-3  text-primary"><?php echo $settings->afm_icon_html; ?></p>
    
                                    <a href="#<?php echo e(implode('_',explode(' ',$settings->afm_name))); ?>" class="text-default collapsed" data-toggle="collapse" aria-expanded="false">
                                        
                                        <i class="i-Arrow-Down-2 t-font-boldest"></i>
                                    </a>
                                </div>
    
                                <div class="collapse" id="<?php echo e(implode('_',explode(' ',$settings->afm_name))); ?>">
                                    <div class="mt-3">
                                          <?php $__currentLoopData = $LandingPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php
                                                $reqtext="active";
                                                $checked="";
                                                $class="radio-outline-primary";
                                               ?>
                                                              <?php $__currentLoopData = $FeatureSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($fset->afm_id== $settings->afm_id): ?>
                                                                  <?php 
                                                                        if($fset->sm_status=='active' && $fset->alm_id==$page->alm_id){
                                                                          $reqtext="inactive";  
                                                                          $checked="checked";
                                                                          $class="radio-outline-success";
                                                                        }
                                                                        
                                                                         break;
                                                                  ?>  
                                                                <?php endif; ?>
                                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          
                                                    
                                                     <label class="radio <?php echo e($class); ?>">
                                                            <input type="radio" name="landingpage"    <?php if(empty($checked)): ?> id="lnd<?php echo e($page->alm_id); ?>" <?php else: ?> id="chklnd" <?php endif; ?>  value="<?php echo e($page->alm_id); ?>" <?php echo e($checked); ?> formControlName="radio" <?php if(empty($checked)): ?> onclick="enabledisableservice('<?php echo e($settings->afm_id); ?>','<?php echo e($reqtext); ?>','<?php echo e($page->alm_id); ?>','landingpage')" <?php endif; ?>>
                                                            <span><?php echo e($page->alm_name); ?></span>
                                                            <span class="checkmark" ></span>
                                                        </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php else: ?>
                    
                    <div class="col-lg-3 mb-3">
                            <div class="card card-body ul-border__bottom">
                                <div class="text-center">
                                    <h5 class="heading text-primary"><?php echo e($settings->afm_name); ?></h5>
                                    <p class="mb-3  text-primary"><?php echo $settings->afm_icon_html; ?></p>
    
                                    <!--<a href="#<?php echo e(implode('_',explode(' ',$settings->afm_name))); ?>" class="text-default collapsed" data-toggle="collapse" aria-expanded="false">-->
                                        
                                    
                                           <?php
                                                $reqtext="active";
                                                $checked="";
                                                
                                               ?>
                                                              <?php $__currentLoopData = $FeatureSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($fset->afm_id== $settings->afm_id): ?>
                                                                  <?php 
                                                                        if($fset->sm_status=='active' ){
                                                                          $reqtext="inactive";  
                                                                          $checked="checked";
                                                                          
                                                                        }
                                                                        
                                                                         break;
                                                                  ?>  
                                                                <?php endif; ?>
                                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        
                                        
                                        
                                        
                                        <label class="switch switch-success mr-3">
                                            <span>Enabled</span>
                                             <input type="checkbox"  id="<?php echo e($settings->afm_id); ?>" name="<?php echo e(implode('_',explode(' ',$settings->afm_name))); ?>" onclick="enabledisableservice('<?php echo e($settings->afm_id); ?>','<?php echo e($reqtext); ?>','','')"  <?php echo e($checked); ?>>
                                            
                                            <span class="slider"></span>
                                        </label>
                                    </a>
                                </div>
                                
    
                            </div>
                        </div>
                    
                    
                    <?php endif; ?>
    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </div>                  
         
    
                                         
                                     




<?php $__env->stopSection(); ?>



<?php $__env->startSection('page-js'); ?>
<!--<script src="<?php echo e(asset('assets/js/carousel.script.js')); ?>"></script>-->

    <script src="<?php echo e(asset('assets/js/vendor/spin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vendor/ladda.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ladda.script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>

    <script>
        function enabledisableservice(AfmId,reqText,AlmId,sel){
            
            
             var setText="unset";
                        var status='active';
                        if(reqText=='active'){
                            setText="set";
                            status='inactive';
                        }


                        swal({
                        title: 'Are you sure!',
                        text: "Do you want to "+setText+" ?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: "Yes !",
                        cancelButtonText: 'cancel'
                    
                        }).then(function(){

                                        $.ajax({
                                            url: "saveSettings",
                                            data: {'AfmId':AfmId,'reqText':reqText,'AlmId':AlmId},
                                            success: function (data) {
                                               
                                              //var obj=jQuery.parseJSON(data);

                                                swal({
                                                    type: 'success',
                                                    title: 'Success!',
                                                    text: "Changed Successfully!",
                                                    buttonsStyling: false,
                                                    confirmButtonClass: 'btn btn-lg btn-success'
                                                });
                                                
                                                // if(sel==''){
                                                //     $("#"+AfmId).attr('onclick', "enabledisableservice('"+AfmId+"', '"+status+"', '','');");
                                                // }else{
                                                //      $("#chklnd").removeAttr('onclick');
                                                     
                                                // }
                                                setTimeout(function(){ window.location.reload(); }, 2000);
                                                return false;
                                             
                                                
                                            }
                                        });


                        }, function(dismiss){
                            if(dismiss == 'cancel'){
                              if(reqText=='active' && sel==''){
                                $("#"+AfmId).prop("checked", false);
                              }else  if(reqText=='inactive' && sel==''){
                                $("#"+AfmId).prop("checked", true); 
                              }else  if(reqText=='active' && sel!=''){
                                   $("#chklnd").prop("checked", true); 
                              }
                                swal("Cancelled", "No data has been changed, Your data is safe :)", "error");
                            }
                        });

            
            
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/settings/settings.blade.php ENDPATH**/ ?>