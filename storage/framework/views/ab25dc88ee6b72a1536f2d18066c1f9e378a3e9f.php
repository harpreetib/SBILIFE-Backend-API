		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add/ Edit Intermediate Page</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <form  name="editexhibitorhall" id="editexhibitorhall" action="addedit-intermediate-page" method="post" enctype="multipart/form-data">
		        <?php echo e(csrf_field()); ?>


                <input class="form-control" type="hidden" name="addeditexhibitorshall" id="addeditexhibitorshall" value="addEdit" />
                <div class="modal-body">
		            
		            
		            
		            <?php
		            $mip_name= isset($dataList->mip_name) ? $dataList->mip_name :'';
		            $mip_caption= isset($dataList->mip_caption) ? $dataList->mip_caption :'';
		            $mipId= isset($dataList->mip_id) ? $dataList->mip_id :'';
		            $gcm_id= isset($dataList->gcm_id) ? $dataList->gcm_id :'';
		            $mip_presentation_video= isset($dataList->mip_presentation_video) ? $dataList->mip_presentation_video :'';
		             $mip_lobby_video= isset($dataList->mip_lobby_video) ? $dataList->mip_lobby_video :'';
		            $mipHtml= isset($dataList->mip_html) ? $dataList->mip_html :'';
		            $mipFooterHtml= isset($dataList->mip_html) ? $dataList->mip_footer_wigets :'';
		            $mip_custom_css= isset($dataList->mip_custom_css) ? $dataList->mip_custom_css :'';
		            $mip_redirect_url= isset($dataList->mip_redirect_url) ? $dataList->mip_redirect_url :'';
		            $isDefault= isset($dataList->isDefault) ? $dataList->isDefault :'';
		            
		            $isDefaultYes="";
		            $isDefaultNo="";
		            if($isDefault=='Y'){
		                $isDefaultYes="checked";
		            }else{
		                $isDefaultNo="checked";
		            }
		            
		            ?>
		            

            		    <div class="card mb-4">
            		        <div class="card-body">
            		           
            		                <div class="row">
            		                    
            		                            <div class="col-md-4 form-group mb-3">
                                                    <label for="pageName">Page Name</label>
                                                    <input type="text" class="form-control" name="pageName" id="pageName" placeholder="Page Name" value="<?php echo e($mip_name); ?>" required>
                                                    <span class="text-danger" id="err_hallname" name="err_hallname"  style="display:none;"></span>
                                                </div>
            
                                                <div class="col-md-4 form-group mb-3">
                                                    <label for="pageCaption">Page Caption</label>
                                                    <input type="text" class="form-control" name="pageCaption" id="pageCaption" placeholder="Page Caption" value="<?php echo e($mip_caption); ?>" required>
                                                    <span class="text-danger" id="err_pageCaption"  style="display:none;"></span>
                                                </div>
                                                
                                                 <!--div class="col-md-12 form-group mb-3">
                                                    <label for="galleryCategory">Gallery Category</label>
                                                    <select class="form-control" name="galleryCategory" id="galleryCategory">
                                                        <option>Select Category</option>
                                                        <?php if(isset($galleryCategory) && !empty($galleryCategory)): ?>
                                                            <?php $__currentLoopData = $galleryCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gCatList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php 
                                                                $isSelected="";
                                                                if($gCatList->gcm_id==$gcm_id){
                                                                    $isSelected="selected";
                                                                }
                                                               ?>
                                                                <option value="<?php echo e($gCatList->gcm_id); ?>"  <?php echo e($isSelected); ?> ><?php echo e($gCatList->gcm_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="text-danger" id="err_galleryCategory" name="err_galleryCategory"  style="display:none;"></span>
                                                </div-->
                                                
                                                           <div class="col-md-4 form-group mb-3">
                                                    <label for="redirectUrl">After Video Custom Redirect Url</label>
                                                    <input type="text" class="form-control" name="redirectUrl" id="redirectUrl" placeholder="After Video Custom Redirect Url" value="<?php echo e($mip_redirect_url); ?>" >
                                                  
                                                </div>
                                                 <div class="col-md-6 form-group mb-3 ">
                                                    <label for="presentationVideoUrl">Page Presentation Video Url</label>
                                                    <textarea  class="form-control" name="presentationVideoUrl" id="presentationVideoUrl" placeholder="Page Presentation Video Url"><?php echo e($mip_presentation_video); ?></textarea>
                                                    <span class="text-danger" id="err_presentationVideoUrl"  style="display:none;"></span>
                                       
                                                </div>
                                                
                             
                                                        
                                                
                                                 <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="lobbyVideoUrl">Lobby Video HTML</label>
                                                    <textarea  class="form-control" name="lobbyVideoUrl" id="lobbyVideoUrl" placeholder="Lobby Video Url" style="height: 200px;" ><?php echo e($mip_lobby_video); ?></textarea>
                                                    <span class="text-danger" id="err_presentationVideoUrl"  style="display:none;"></span>
                                        <!--
                                                    <?php if(!empty($dataList->mip_presentation_video)): ?>
                                                    <a href="<?php echo e($dataList->mip_presentation_video); ?>" target="_new">View Presentation Video</a>
                                                   <?php endif; ?>
                                                   -->
                                                </div>
                                                
                                                
                                                
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="bgimage">Upload Page Background Image <span style="color:red;">[choose File 1920 * 1080 px]</span></label>
                                                    <input type="file" class="form-control" name="bgimage" id="bgimage" placeholder="Image for Page Background"  <?php if(empty($dataList->mip_bgimage)): ?> required <?php endif; ?>>
                                                
                                                    <?php if(!empty($dataList->mip_bgimage)): ?>
                                                    <br>
                                                    <img height="100px" src="<?php echo e(URL::to('/')); ?>/public/assets/images/<?php echo e(Session('A_Session')->bm_id); ?>/exhibitionhall/<?php echo e($dataList->mip_bgimage); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="pageHtml"> Page HTML </label>
                                                    <textarea class="form-control" name="pageHtml" id="pageHtml" placeholder="Page HTML" style="height: 200px;"><?php echo e($mipHtml); ?></textarea>
                                                    <span class="text-danger" id="pageHtml"  style="display:none;"></span>
                                                </div>
                                                
                                                  <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="pageHtml"> Page Footer Wigets HTML </label>
                                                    <textarea class="form-control" name="footer_wigets" id="footer_wigets" placeholder="Footer Wigets" style="height: 200px;"><?php echo e($mipFooterHtml); ?></textarea>
                                                    <span class="text-danger" id="pageHtml"  style="display:none;"></span>
                                                </div>
                                                
                                                  <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="pageHtml"> Page Custom CSS (<em>Witout style tag</em>) </label>
                                                    <textarea class="form-control" name="custom_css" id="custom_css" placeholder="Custom" style="height: 200px;"><?php echo e($mip_custom_css); ?></textarea>
                                                    
                                                </div>
                                                
                                                <div class="col-md-12 form-group mb-3">
                                                	<label> Set As Default Page </label>
                                                	<div class="form-check">
                                                		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultNo" value="N" <?php echo e($isDefaultNo); ?>>
                                                		<label class="form-check-label" for="isDefaultNo">
                                                			No
                                                		</label>
                                                	</div>
                                                	<div class="form-check">
                                                		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultYes" value="Y" <?php echo e($isDefaultYes); ?>>
                                                		<label class="form-check-label" for="isDefaultYes">
                                                			Yes
                                                		</label>
                                                	</div>
                                                	<span class="text-danger" id="err_isDefault" style="display:none;"></span>
                                                </div>

            		                </div>
            		        </div>
            		    </div>


        		        </div>
        		        <div class="modal-footer">
        		             <input type="hidden" class="form-control" value="<?php echo e($mipId); ?>" name="mipId">
        		            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" >Save</button>
        		        </div>
        		</form>
		      
                <script type="text/javascript">
                
                        $(document).ready(function (e) {
                                
                                $('#editexhibitorhall').on('submit',(function(e) {
                                    e.preventDefault();
                                    var formData = new FormData(this);
                                    var urlAction = $(this).attr('action');
                                    
                                    addeditwebinarst(urlAction, formData);
                                }));
                            
                        });
                </script><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/datatables/addeditpopup_intermediate_page.blade.php ENDPATH**/ ?>