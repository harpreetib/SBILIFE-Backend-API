 
 <?php $__currentLoopData = $boothdesign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $design): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
  <?php if($design->ebm_id==$profileDetail->ebm_id): ?> 
  
  <?php if(!empty($design->ebm_css_inline)): ?>
      <style>
          <?php echo $design->ebm_css_inline; ?>

      </style>
  <?php endif; ?>
  
        <div class="card ">
				<div class="card-body">
				<div class="<?php echo e($design->ebm_css); ?>">
                    <span class="position-relative d-inline-block">
                      <div class="w-100 text-left slider-comp-name">
                      <span class="companyName"><input type="text" class="boothname-txtbox" placeholder="Enter Booth name Help Desk"  name="organization_name" id="organization_name" value="<?php echo e($profileDetail->exhim_organization_name); ?>" readonly onclick="reqUpdateFormFields('loctionDetail','','');" /></span>

                      <span class="punchlineText"><input  type="text" readonly placeholder="Enter punchline here" class="booth-txtbox"  name="punchline_text" id="punchline_text" value="<?php echo e($profileDetail->exhim_punchline); ?>" onclick="reqUpdateFormFields('punchline','','');" /></span>

                      </div>
                      <img src="<?php echo e(URL::to('/')); ?>/public/assets/images/boothdesign/<?php echo e($design->ebm_image_frontend); ?>" class="img-fluid">
                      <span class="logo-box-1">
					  <!--<input type="file" class="logo-box-1-file">-->
					  <span class="logo-box-1-span" onclick="logoUpload('<?php echo e($profileDetail->exhim_id); ?>', '<?php echo e($profileDetail->exhim_logo); ?>', 'update');" data-toggle="modal" data-target="#photosmodal"> COMPANY LOGO</span>
					  <img src="<?php echo e(URL::to('/')); ?>/public/assets/images/booth/<?php echo e($bmid); ?>/<?php echo e($profileDetail->exhim_id); ?>/<?php echo e($profileDetail->exhim_logo); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_logo)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
                      <span class="standy-1">
    					   <!--<input type="file" class="logo-box-1-file">-->
    					  <span class="logo-box-1-span" onclick="reqUpdateFormFields('standeeimg','<?php echo e($design->ebm_standee_width); ?>','<?php echo e($design->ebm_standee_height); ?>');"> E-BUNTING</span>
    					  <img src="<?php echo e(URL::to('/')); ?>/public/assets/images/booth/<?php echo e($bmid); ?>/<?php echo e($profileDetail->exhim_id); ?>/<?php echo e($profileDetail->exhim_standee); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_standee)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
					  
                      <span class="standy-2">
                        <?php
                            $w='';
                            $h='';					   
                            if($design->ebm_css == 'stall-g'){
                               $w=400;
                               $h=290;
                            }else{
                               $w=$design->ebm_standee_width ;
                               $h= $design->ebm_standee_height ;
                            }
                        ?>
					    <!--<input type="file" class="logo-box-1-file">-->
					    <span class="logo-box-1-span" onclick="reqUpdateFormFields('standeeimg2','<?php echo e($w); ?>','<?php echo e($h); ?>');"> E-BUNTING</span>
					    <img src="<?php echo e(URL::to('/')); ?>/public/assets/images/booth/<?php echo e($bmid); ?>/<?php echo e($profileDetail->exhim_id); ?>/<?php echo e($profileDetail->exhim_standee2); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_standee)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
					  
					  <span class="standy-3">
					      <?php
    					   $w='';
    					   $h='';					   
    					   if($design->ebm_css == 'stall-g'){
        					    $w=400;
        					    $h=290;
    					   }else{
    					        $w=$design->ebm_standee_width ;
    					        $h=$design->ebm_standee_height ;
    					   }
    					  ?>
					        <!--<input type="file" class="logo-box-1-file">-->
					        <span class="logo-box-1-span" onclick="reqUpdateFormFields('standeeimg3','<?php echo e($w); ?>','<?php echo e($h); ?>');"> E-BUNTING</span>
					        <img src="<?php echo e(URL::to('/')); ?>/public/assets/images/booth/<?php echo e($bmid); ?>/<?php echo e($profileDetail->exhim_id); ?>/<?php echo e($profileDetail->exhim_standee3); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_standee)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
					  
					  <span class="standy-4" style="display:none;">
					        <!--<input type="file" class="logo-box-1-file">-->
					        <span class="logo-box-1-span" onclick="reqUpdateFormFields('standeeimg4','<?php echo e($design->ebm_standee_width); ?>','<?php echo e($design->ebm_standee_height); ?>');"> E-BUNTING</span>
					        <img src="<?php echo e($profileDetail->exhim_standee4); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_standee)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
					  
                      <span class="desk-logo" style="display:none;">
					        <!--<input type="file" class="logo-box-1-file">-->
					        <span class="logo-box-1-span" onclick="reqUpdateFormFields('desklogo','<?php echo e($design->desk_logo_width); ?>','<?php echo e($design->desk_logo_height); ?>');"> COMPANY DESK LOGO </span>
					        <img src="<?php echo e($profileDetail->exhim_desk_logo); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_desk_logo)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
					  
                      <span class="backdrop-image-1">
					        <!--<input type="file" class="logo-box-1-file">-->
					        <span class="logo-box-1-span" onclick="reqUpdateFormFields('backdrop-n-video','<?php echo e($design->ebm_backdrop_width); ?>','<?php echo e($design->ebm_backdrop_height); ?>');"> CORPORATE VIDEO </span>
					        <img src="<?php echo e($profileDetail->exhim_stall_backdropofvideo); ?>" class="img-fluid" <?php if(empty($profileDetail->exhim_stall_backdropofvideo)): ?> style="opacity:0;" <?php endif; ?>>
					  </span>
                     <!-- <span class="lobby-image-1"><img src="https://ibentos.com/bharatparv2021/se/public/assets/images/1/1/lobby-2021-01-171610824683.jpg" class="img-fluid"></span>

                      <span class="lobby-video-1"><video src="" loop="" muted="" autoplay=""></video></span> -->

                      <span class="play-btn"><a href="#" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/hSTwJxAW-UE" data-target="#myModal"><img src="<?php echo e(URL::to('/business_expo')); ?><?php echo e('../../public/assets/images/'); ?>video-btn.svg"></a></span>
                    </span>
                  </div>
						  </div>

						 <!-- <div class="card-footer text-center">-->
							<!--<button class="btn btn-danger mr-2">Upload</button> <button class="btn btn-danger ml-2">Save</button>-->
						 <!-- </div>-->
						  </div>
				<?php endif; ?>		  
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 				  <?php /**PATH /home/megaspace/public_html/admin/resources/views/others/stall-design1.blade.php ENDPATH**/ ?>