<?php
    $setModelTitle="";
    if($reqData['ajaxRequset']=='loctionDetail'){
        $setModelTitle="ADDRESS";
    }elseif($reqData['ajaxRequset']=='quickFactsDetail'){
        $setModelTitle="QUCIK FACTS";
    }elseif($reqData['ajaxRequset']=='contactUsDetail'){
        $setModelTitle="CONTACT US";
    }elseif($reqData['ajaxRequset']=='punchline'){
        $setModelTitle="Punchline";
    }
    
    $ppmIdArray = explode(',',$profileDetail->ppmm_id);
    
?>


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4><?php echo e($setModelTitle); ?></h4></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<link rel="stylesheet" href="https://virtual.mymedex.com.my/se/public/assets/styles/css/my-multiselect.css">
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
</style>


<form  name="quickfactform" id="quickfactform" class="" action="saveuserprofile" method="post" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

        
    <div class="modal-body" >
        <!----Form Section---->
       

        <?php if($reqData['ajaxRequset']=='loctionDetail'): ?>
            <input class="form-control" type="hidden" name="quickfact" id="quickfact" value="quickfact" />
            <div class="row">

                <div class="col-md-12 col-12">

                    <div class="mb-4 col-12">
                        <p class="text-primary mb-1">Fascia Name/ Exhibitor Name</p>
                        <span><input type="text" class="form-control"  name="organization_name" id="organization_name" value="<?php echo e($profileDetail->exhim_organization_name); ?>" /></span>
                    </div>

                    <div class="mb-4  col-12 ">
                        <p class="text-primary mb-1">Country</p>
                        <span>
                            <select id="country" name="country"   data-id="country" class="form-control custom-select target" >
                                <option value="">Select Country</option>
                                <?php if(!empty($counm_code)): ?>
                                        <?php $__currentLoopData = $counm_code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $counmdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($counmdata->counm_id); ?>" <?php if(isset($profileDetail->counm_id) && $profileDetail->counm_id==$counmdata->counm_id): ?> selected <?php endif; ?> > <?php echo e($counmdata->counm_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </span>
                    </div>

                    <div class="mb-4  col-12 d-none">
                        <p class="text-primary mb-1">State</p>
                        <span>
                            <select id="state" name="state"   data-id="state" class="form-control custom-select target" onchange="fillCityList(this.value);">
                                <option value="">Select Please</option>
                                <?php if(!empty($stateList)): ?>
                                        <?php $__currentLoopData = $stateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stateData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($stateData->sm_id); ?>" <?php if(isset($profileDetail->sm_id) && $profileDetail->sm_id==$stateData->sm_id): ?> selected <?php endif; ?> > <?php echo e($stateData->sm_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </span>
                    </div>

                    <div class="mb-4  col-12 d-none">
                        <p class="text-primary mb-1">City</p>
                        <span>
                            <select id="cityList" name="city"  data-id="city" class="form-control custom-select target">
                                <option value="">Select Please</option>
                                <?php if(!empty($cityList)): ?>
                                        <?php $__currentLoopData = $cityList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cityData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cityData->cm_id); ?>" <?php if(isset($profileDetail->cm_id) && $profileDetail->cm_id==$cityData->cm_id): ?> selected <?php endif; ?> > <?php echo e($cityData->cm_name); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </span>
                    </div>
                
                </div>

            </div>


        <?php elseif($reqData['ajaxRequset']=='quickFactsDetail'): ?>

 <input class="form-control" type="hidden" name="quickfact" id="quickfact" value="quickfact" />
        <div class="row">
                <div class="col-md-4 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Type of Institute</p>
                        <span><input class="form-control" type="text" name="institute_type" id="institute_type" value="<?php echo e($profileDetail->exhim_type_of_institute); ?>" /></span>
                    </div>
                    <div class="mb-4">
                        <p class="text-primary mb-1">Affiliation</p>
                        <span><input type="text" class="form-control"  name="ownership" id="ownership" value="<?php echo e($profileDetail->exhim_ownership); ?>" /></span>
                    </div>

                    <div class="mb-4">
                        <p class="text-primary mb-1">Estd. Year</p>
                        <span><input type="text" class="form-control"  name="estd_year" id="estd_year" value="<?php echo e($profileDetail->exhim_estd_year); ?>" /></span>
                    </div>
                    
                </div>

                <div class="col-md-4 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Accreditation</p>
                        <span><input type="text" class="form-control"  name="accreditation" id="accreditation" value="<?php echo e($profileDetail->exhim_accreditation); ?>" /></span>
                    </div>

                    <div class="mb-4">
                        <p class="text-primary mb-1">Recognition</p>
                        <span><input type="text" class="form-control"  name="recognition" id="recognition" value="<?php echo e($profileDetail->exhim_recognition); ?>" /></span>
                    </div>

                </div>

                <div class="col-md-4 col-6">

                    <div class="mb-4">
                        <p class="text-primary mb-1">Campus Size</p>
                        <span><input type="text" class="form-control"  name="campus_area" id="campus_area" value="<?php echo e($profileDetail->exhim_campus_area); ?>" /></span>
                    </div>
                    <div class="mb-4">
                        <p class="text-primary mb-1">Approval</p>
                        <span><input type="text" class="form-control"  name="approval" id="approval" value="<?php echo e($profileDetail->exhim_approval); ?>" /></span>
                    </div>

                </div>

            </div>



        <?php elseif($reqData['ajaxRequset']=='contactUsDetail'): ?>
 <input class="form-control" type="hidden" name="quickfact" id="quickfact" value="quickfact" />
        <div class="row">
                <!--<div class="col-md-6 col-6">-->
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Email</p>-->
                <!--        <span><input type="text" class="form-control"  name="email" id="email" value="<?php echo e($profileDetail->exhim_contact_email); ?>" /></span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-6 col-6">-->
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Contact Person In-Charge</p>-->
                <!--        <span><input type="text" class="form-control"  name="contact_person_incharge" id="contact_person_incharge" value="<?php echo e($profileDetail->contact_person_incharge); ?>" /></span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-6 col-6">-->
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Designation</p>-->
                <!--        <span><input type="text" class="form-control"  name="designation" id="designation" value="<?php echo e($profileDetail->exhim_designation); ?>" /></span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-6 col-6">-->
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Contact Number (Office)</p>-->
                <!--        <span class="row">-->
                <!--            <span class="col-2">-->
                <!--            <input type="number" class="form-control" placeholder="Country Code"  name="office_phone_code" id="office_phone_code" value="<?php echo e($profileDetail->office_phone_code); ?>" />-->
                <!--            </span>-->
                            
                <!--            <span class="col-10">-->
                <!--            <input type="text" class="form-control"  name="office_contact_number" id="office_contact_number" value="<?php echo e($profileDetail->office_contact_number); ?>" />-->
                <!--            </span>-->
                <!--            </span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="col-md-6 col-6">-->
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Fax Number</p>-->
                <!--        <span><input type="text" class="form-control"  name="fax_number" id="fax_number" value="<?php echo e($profileDetail->fax_number); ?>" /></span>-->
                <!--    </div>-->
                <!--</div>-->
                
                <?php
                $industyArray = explode(',',$profileDetail->ot_id);
                ?>
                
                <div class="form-group col-md-6 col-6 my-multiselect">
                        <p class="text-primary mb-1">Industry</p>
                        	<select multiple class="custom-select form-control shadow-sm" name="industry[]" id="multiselect" data-text="Select your > Looking for or interested in: Industry">
                        	    <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($industry->ot_id); ?>" <?php if(in_array($industry->ot_id, $industyArray)): ?> selected <?php endif; ?>><?php echo e($industry->ot_name); ?></option> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        			
                        	</select>
                        </div>
                        
                <div class="col-md-6 form-group mb-3" id="modal-content">
                    <label for="text-primary mb-1">Exhibitor Profile</label>
                        <select class="custom-select form-control shadow-sm" id="exhibitor_profile" name="exhibitor_profile">
                            <?php $__currentLoopData = $exhibitor_profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exhibitor_profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($exhibitor_profile->epm_id); ?>" <?php if($exhibitor_profile->epm_id == $profileDetail->exhim_profile): ?> selected <?php endif; ?>><?php echo e($exhibitor_profile->epm_text); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <span class="text-danger" id="err_exhibitor_profile" name="err_exhibitor_profile"  style="display:none;"></span>
                </div>

                <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Website </p>
                        <span><input type="text" class="form-control"  name="web_link" id="web_link" value="<?php echo e($profileDetail->exhim_web_link); ?>" /></span>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Facebook </p>
                        <span><input type="text" class="form-control"  name="facebook" id="facebook" value="<?php echo e($profileDetail->exhim_facebook_link); ?>" /></span>
                    </div>
                </div>
                 <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Youtube </p>
                        <span><input type="text" class="form-control"  name="youtube" id="youtube" value="<?php echo e($profileDetail->exhim_youtube_link); ?>" /></span>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Instagram </p>
                        <span><input type="text" class="form-control"  name="instagram" id="instagram" value="<?php echo e($profileDetail->exhim_instagram_link); ?>" /></span>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">Twitter </p>
                        <span><input type="text" class="form-control"  name="twitter" id="twitter" value="<?php echo e($profileDetail->exhim_twitter_link); ?>" /></span>
                    </div>
                </div>
                
                <div class="col-md-6 col-6">
                    <div class="mb-4">
                        <p class="text-primary mb-1">LinkedIn </p>
                        <span><input type="text" class="form-control"  name="linkedIn" id="linkedIn" value="<?php echo e($profileDetail->exhim_linkedIn_link); ?>" /></span>
                    </div>
                </div>

                <!--<div class="col-md-4 col-6">-->
                    
                <!--    <div class="mb-4">-->
                <!--        <p class="text-primary mb-1">Whatsapp Number </p>-->
                <!--        <span><input type="text" class="form-control"  name="whatsapp_id" id="whatsapp_id" value="<?php echo e($profileDetail->exhim_whatsapp); ?>" /></span>-->
                <!--    </div>-->

                <!--</div>-->

            </div>
            
            
        <?php elseif($reqData['ajaxRequset']=='punchline'): ?>
 <input class="form-control" type="hidden" name="quickfact" id="quickfact" value="quickfact" />
         <div class="row">

                <div class="col-md-12 col-12">

                    <div class="mb-4 col-12">
                        <p class="text-primary mb-1">Punchline Text</p>
                        <span><input type="text" class="form-control"  name="punchline_text" id="punchline_text" value="<?php echo e($profileDetail->exhim_punchline); ?>" /></span>
                    </div>

                    
                </div>

            </div>   
            
            
       
        
        
          <?php elseif($reqData['ajaxRequset']=='standeeimg'): ?>
        
         <h4>Standee Image </h4>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                                   <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="standeeform" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                             <div class="col-md-12">
                                             <label>Booth: Standee Image (<?php echo e($reqData['width']); ?> X <?php echo e($reqData['height']); ?> px)</label>
                                                      <div class="input-group mb-2">
                                                           
                                                            <input type="hidden" name="staimage" id="staimage" value="">
                                                        <input type="hidden" name="standeeimage" id="standeeimage" value="standeeimage">
                                                          <input type="file" class="form-control" id="upload_standee" name="upload_standee" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                                        <span class="btn btn-primary" id="standeecrop-result">Crop</span>
                                                          
                                                      </div>
                                          </div>
                                          
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="standee-demo"  style="max-height:300px; overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div>
                                         
                                          <!--</form>-->
                                       
                                           
                                        </div>
                                    </div>
                                </div>    
                                   
                                    
                              <?php elseif($reqData['ajaxRequset']=='standeeimg2'): ?>
        
         <h4>Standee Image 2 </h4>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                                   <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="standeeform" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                             <div class="col-md-12">
                                             <label>Booth: Standee Image (<?php echo e($reqData['width']); ?> X <?php echo e($reqData['height']); ?> px)</label>
                                                      <div class="input-group mb-2">
                                                      
                                                            <input type="hidden" name="sta2image" id="sta2image" value="">
                                                        <input type="hidden" name="standee2image" id="standee2image" value="standee2image">
                                                          <input type="file" class="form-control" id="upload2_standee11" name="upload2_standee" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                                        <span class="btn btn-primary" id="standee2crop-result">Crop</span>
                                                          
                                                      </div>
                                          </div>
                                          
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="standee2-demo"  style="max-height:300px; overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div>
                                         
                                          <!--</form>-->
                                       
                                           
                                        </div>
                                    </div>
                                </div>                
                                 
                                             <?php elseif($reqData['ajaxRequset']=='standeeimg3'): ?>
        
         <h4>Standee Image 3 </h4>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                                   <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="standeeform" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                             <div class="col-md-12">
                                             <label>Booth: Standee Image (<?php echo e($reqData['width']); ?> X <?php echo e($reqData['height']); ?> px)</label>
                                                      <div class="input-group mb-2">
                                                     
                                                            <input type="hidden" name="sta3image" id="sta3image" value="">
                                                        <input type="hidden" name="standee3image" id="standee3image" value="standee3image">
                                                          <input type="file" class="form-control" id="upload3_standee" name="upload3_standee" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                                        <span class="btn btn-primary" id="standee3crop-result">Crop</span>
                                                          
                                                      </div>
                                          </div>
                                          
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="standee3-demo"  style="max-height:300px; overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div>
                                         
                                          <!--</form>-->
                                       
                                           
                                        </div>
                                    </div>
                                </div>                
                                 
                 <?php elseif($reqData['ajaxRequset']=='standeeimg4'): ?>
        
         <h4>Standee Image 4 </h4>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                                   <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="standeeform" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                             <div class="col-md-12">
                                             <label>Booth: Standee Image ((<?php echo e($reqData['width']); ?> X <?php echo e($reqData['height']); ?> px) </label>
                                                      <div class="input-group mb-2">
                                                    
                                                            <input type="hidden" name="sta4image" id="sta4image" value="">
                                                        <input type="hidden" name="standee4image" id="standee4image" value="standee4image">
                                                          <input type="file" class="form-control" id="upload4_standee" name="upload4_standee" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                                        <span class="btn btn-primary" id="standee4crop-result">Crop</span>
                                                          
                                                      </div>
                                          </div>
                                          
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="standee4-demo"  style="max-height:300px; overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div>
                                         
                                          <!--</form>-->
                                       
                                           
                                        </div>
                                    </div>
                                </div>          
                                    
                                    
                             <?php elseif($reqData['ajaxRequset']=='desklogo'): ?>   
                               <h4>Booth: Desk-Logo</h4>
                                    <!--Booth: Desk Logo -->
                                     <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="desklogoForm" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                                <div class="col-md-12">
                                                      <label>Booth: Desk-Logo  <em>(<?php echo e($reqData['width']); ?> X <?php echo e($reqData['height']); ?> px)</em></label>
                                                      <div class="input-group mb-2">
                                                           
                                                          <input type="hidden" name="desklogo" id="desklogo" value="desklogo-1">
                                                          <input type="hidden" name="deskimage" id="deskimage" value="">
                                                          
                                                            <input type="hidden" name="ppm_id" id="ppm_id" value="<?php echo e($profileDetail->ppm_id); ?>">
                                                          
                                                          <input type="file" class="form-control" id="upload_desklogo" name="upload_desklogo" placeholder="Change/Upload Desk Logo" aria-label="Backdrop" accept="image/x-png,image/gif,image/jpeg" />
                                                       
                                                        <span class="btn btn-primary" id="deskcrop-result">Crop</span>
                                                    
                                                      </div>
                                                </div>
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="desk-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                         
                                          <!--</form>-->
                                          
                                           
                                        </div>
                                    </div> 
                                    
                                  
                                   </div>
                                   
                                   
                        <?php elseif($reqData['ajaxRequset']=='backdrop-n-video'): ?>  
                        <h4>Backdrop Image & Led Video</h4>
                         <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                             
                             
                              <!--Booth: Backdrop Image of Led video -->
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                          <!--<form class="" name="backdropofvideoForm" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                           
                                                <div class="col-md-12">
                                                      <label>Booth: Backdrop Image  <em>( <?php if(!empty($reqData['width'])) { echo $reqData['width']; } else { echo '1360'; }  ?> X 
                                                      <?php if(!empty($reqData['height'])) { echo $reqData['height']; } else { echo '450'; }  ?>) PX</em></label>
                                                      <div class="input-group mb-2">
                                                           
                                                          <input type="hidden" name="backdropofvideo" id="backdropofvideo" value="backdropImage-1">
                                                           <input type="hidden" name="bcimage" id="bcimage" value="">
                                                          <input type="file" class="form-control" id="upload_backdropimage" name="upload_backdropimage" placeholder="Change/Upload Backdrop Image" aria-label="Backdrop" accept="image/x-png,image/gif,image/jpeg"  />
                                                        
                                                         <span class="btn btn-primary" id="crop-result">Crop</span>
                                                      </div>
                                                </div>
                                            
                                                                             
                                          <!--</form>-->
                                          
                                          
                                           
                                        </div>
                                    </div> 
                                    
                                     <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="upload-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    <!-- Booth: Led video -->
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                             <!--<form class="" name="standeevideo" action="saveuserprofile" method="post" enctype="multipart/form-data">-->
                                          
                                             
                                             <div class="col-md-12">
                                                 <label>Booth: Led Video <span class="text-danger">(Note: Max file size should be 30MB)</span></label>
                                                  <div class="input-group mb-2">
                                              <input type="hidden" name="standeevideo" id="standeevideo" value="standeevideo">
                                              <!--<input type="text" class="form-control" name="standeevideo_url" id="standeevideo_url" placeholder="Embed URL/Link of a Youtube Video." value="<?php echo e($profileDetail->exhim_stall_video); ?>" aria-label="video" >-->
                                              <input type="file" class="form-control" name="standeevideo_file" id="standeevideo_file" accept="video/mp4,video/x-m4v,video/*" aria-label="video">
                                          </div>
                                             </div>
                                           
                                          <!--</form>-->
                                           
                                         </div>
                                    </div>
                                    
                             
                         </div> 
                                     
                                     
        
        
         <?php endif; ?>
        
        
        
        
        
        <!----Form Section---->
    </div>

    <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

</form>
<script src="https://virtual.mymedex.com.my/se/public/assets/js/vendor/bootstrap-multiselect.min.js" type="e55026323ce49a945cd6b22e-text/javascript"></script>
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>


<script>
    $(document).ready( function(){
        
        
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});



/*  backdrop image crop */
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: <?php if(!empty($reqData['width'])) { echo $reqData['width']; } else { echo '1360'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo $reqData['height']; } else { echo '450'; }  ?>,
        type: 'square'
    },
    boundary: {
        width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '1400'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '500'; }  ?>
    },enableResize: false
    
});


$('#upload_backdropimage').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
        swal({
          type: 'success',
          title: 'Image Crop',
          text: 'Please Click on "Crop button" to crop the image',
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-lg btn-danger'
         })
});


$('#crop-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#bcimage').val(resp);
	    
            swal({
              type: 'success',
              title: 'Image Crop',
              text: 'Cropped Successfully',
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-lg btn-danger'
             })

	});

});    
        
 
 
 /*  desk logo crop */

 $deskCrop = $('#desk-demo').croppie({
    enableExif: true,
   viewport: {
        width: <?php if(!empty($reqData['width'])) { echo $reqData['width']; } else { echo '330'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo $reqData['height']; } else { echo '150'; }  ?>,
        type: 'square'
    },
    boundary: {
        width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '400'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '180'; }  ?>
    },enableResize: false
    
});


$('#upload_desklogo').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$deskCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});

$('#deskcrop-result').on('click', function (ev) {
	$deskCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#deskimage').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});         





 /*  standee image logo crop */
 
 $standeeCrop = $('#standee-demo').croppie({
    enableExif: true,
     viewport: {
       width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']); } else { echo '340'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']); } else { echo '700'; }  ?>,
        type: 'square'
    },
    boundary: {
         width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '500'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '800'; }  ?>
    },enableResize: false
    
});


$('#upload_standee').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$standeeCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});

$('#standeecrop-result').on('click', function (ev) {
	$standeeCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#staimage').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});


/*  standee2 image logo crop */
 
 $standee2Crop = $('#standee2-demo').croppie({
    enableExif: true,
    viewport: {
       width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']); } else { echo '340'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']); } else { echo '700'; }  ?>,
        type: 'square'
    },
    boundary: {
         width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '500'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '800'; }  ?>
    },enableResize: false
    
});


$('#upload2_standee11').on('change', function () {
	var reader = new FileReader();
    reader.onload = function (e) {
    	$standee2Crop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});

$('#standee2crop-result').on('click', function (ev) {
	$standee2Crop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#sta2image').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});



/*  standee3 image logo crop */
 
 $standee3Crop = $('#standee3-demo').croppie({
    enableExif: true,
    viewport: {
         width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']); } else { echo '340'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']); } else { echo '700'; }  ?>,
        type: 'square'
    },
    boundary: {
        width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '500'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '800'; }  ?>
    },enableResize: false
    
});


$('#upload3_standee').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$standee3Crop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});

$('#standee3crop-result').on('click', function (ev) {
	$standee3Crop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#sta3image').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});



				
/*  standee4 image logo crop */
 
 $standee4Crop = $('#standee4-demo').croppie({
    enableExif: true,
    viewport: {
        width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']); } else { echo '340'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']); } else { echo '700'; }  ?>,
        type: 'square'
    },
    boundary: {
        width: <?php if(!empty($reqData['width'])) { echo ($reqData['width']+50); } else { echo '500'; }  ?>,
        height: <?php if(!empty($reqData['height'])) { echo ($reqData['height']+50); } else { echo '800'; }  ?>
    },enableResize: false
    
});


$('#upload4_standee').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$standee4Crop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});

$('#standee4crop-result').on('click', function (ev) {
	$standee4Crop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#sta4image').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});





    });
    
    
    $('#standeevideo_file').on('change', function() {
          
            const size = 
               (this.files[0].size / 1024 / 1024).toFixed(2);
            console.log(size);
            if (size > 30 || size < 0) {
                alert("File size is too large. Max file size should be 30MB.");
                $('#standeevideo_file').val("")
            } else {
                // $("#output").html('<b>' +
                //   'This file size is: ' + size + " MB" + '</b>');
            }
        });	
</script>



<?php /**PATH /home/megaspace/public_html/admin/resources/views/others/basicdetail-form.blade.php ENDPATH**/ ?>