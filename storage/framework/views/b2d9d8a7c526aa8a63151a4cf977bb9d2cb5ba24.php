		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Stream Details</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		<form  name="editStream" id="editStream" action="AddeStreams" method="post" enctype="multipart/form-data">
		 <?php echo e(csrf_field()); ?>


		      <input class="form-control" type="hidden" name="editStreams" id="editStreams" value="adduser" />
		       <div class="modal-body">
		            

		    <div class="card mb-4">
		        <div class="card-body">
		           
		                <div class="row">
		                    
		                     <div class="col-md-6 form-group mb-3 d-none">
                                        <label for="course_duration">Mode</label>
                                        <select class="form-control" name="mws_mode" id="mws_mode">
                                            <option value="live"  <?php if($dataList->mws_mode=='live'): ?> selected <?php endif; ?> >Live</option>
                                            <option value="gallery" <?php if($dataList->mws_mode=='gallery'): ?> selected <?php endif; ?> >Gallery</option>
                                        </select>
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
		                    
		                       <div class="col-md-6 form-group mb-3 ">
                                        <label for="course_duration">Has Exhibition</label>
                                        <select class="form-control" name="mws_has_exhibition" id="mws_has_exhibition">
                                            <option value="Yes"  <?php if($dataList->mws_has_exhibition=='Yes'): ?> selected <?php endif; ?> >Yes</option>
                                            <option value="No" <?php if($dataList->mws_has_exhibition=='No'): ?> selected <?php endif; ?> >No</option>
                                        </select>
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">Exhibition URL</label>
                                        <input type="text" class="form-control" name="mws_exhibition_url" id="mws_exhibition_url" placeholder="Exhibiton URL"
                                        value="<?php echo e($dataList->mws_exhibition_url); ?>" >
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
		                    
		                            <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">Conference Name</label>
                                        <input type="text" class="form-control" name="mws_name" id="mws_name" placeholder="Name"
                                        value="<?php echo e($dataList->mws_name); ?>" required>
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                   

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Vimeo URL</label>
                                        <input type="text" class="form-control" name="mws_video_url" id="mws_video_url" placeholder="Vimeo url" 
                                         value="<?php echo e($dataList->mws_video_url); ?>" required>
                                        <span class="text-danger" id="err_phone" name="err_phone"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">YouTube URL</label>
                                        <input type="text" class="form-control" name="mws_youtube_url" id="mws_youtube_url" placeholder="Youtube embed url" 
                                         value="<?php echo e($dataList->mws_youtube_url); ?>">
                                        
                                    </div>
                                     <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Facebook URL</label>
                                        <input type="text" class="form-control" name="mws_facebook_url" id="mws_facebook_url" placeholder="Facebook embed url" 
                                         value="<?php echo e($dataList->mws_facebook_url); ?>">
                                        
                                    </div>
                                     <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Post Conference URL</label>
                                        <input type="text" class="form-control" name="mws_webinar_finish_url" id="mws_webinar_finish_url" placeholder="Post Conference url" 
                                         value="<?php echo e($dataList->mws_webinar_finish_url); ?>">
                                    </div>
                                    
                                     <div class="col-md-6 form-group mb-3">
                                        <label for="liveChatUrl">Live Chat URL</label>
                                        <input type="text" class="form-control" name="liveChatUrl" id="liveChatUrl" placeholder="Live Chat url" 
                                         value="<?php echo e($dataList->mws_live_chat_url); ?>" >
                                        <span class="text-danger" id="err_liveChatUrl" name="err_liveChatUrl"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="presentationVideoUrl">Page Presentation Video Url</label>
                                        <textarea  class="form-control" name="presentationVideoUrl" id="presentationVideoUrl" placeholder="Page Presentation Video Url"><?php echo e($dataList->mws_presentation_video); ?></textarea> 
                                        <span class="text-danger" id="err_presentationVideoUrl"  style="display:none;"></span>
                                        
                                        <?php if(!empty($dataList->mws_presentation_video)): ?>
                                            <a href="<?php echo e($dataList->mws_presentation_video); ?>" target="_new">View Presentation Video</a>
                                        <?php endif; ?>
                                    </div>
                                    
                                     <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Upload Background Image <span style="color:red;">[choose File 1920 * 1080 px]</span></label>
                                        <input type="file" class="form-control" name="web_bgimage" id="ImageBrowse" placeholder="Image for Background" 
                                         value="">
                                        <?php if(!empty($dataList->mws_background_img)): ?>
                                        <br>
                                        <img height="100px" src="<?php echo e(URL::to('/')); ?><?php echo e('/public/assets/images/'.Session('A_Session')->bm_id.'/conferencehall/'.$dataList->mws_background_img); ?>">
                                        <?php endif; ?>
                                    </div>
                                    
                                    
                                    <div class="col-md-12 form-group mb-3 d-none">
                                        <label for="pageHtml"> Page Footer Wigets HTML </label>
                                        <textarea class="form-control" name="footer_wigets" id="footer_wigets" placeholder="Footer Wigets" style="height: 200px;"><?php echo e($dataList->mws_footer_wigets); ?></textarea>
                                        <span class="text-danger" id="pageHtml"  style="display:none;"></span>
                                    </div>
                                                
                                    <div class="col-md-12 form-group mb-3 d-none">
                                        <label for="pageHtml"> Page Custom CSS (<em>Witout style tag</em>) </label>
                                        <textarea class="form-control" name="mws_custom_css" id="mws_custom_css" placeholder="Custom" style="height: 200px;"><?php echo e($dataList->mws_custom_css); ?></textarea>
                                    </div>
                                                
                                                
                                    <div class="col-md-12 form-group mb-3">
                                    	<label> Set As Default Page </label>
                                    	<div class="form-check">
                                    		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultNo" value="N" <?php if($dataList->isDefault=='N'): ?> checked <?php endif; ?>>
                                    		<label class="form-check-label" for="isDefaultNo">
                                    			No
                                    		</label>
                                    	</div>
                                    	<div class="form-check">
                                    		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultYes" value="Y" <?php if($dataList->isDefault=='Y'): ?> checked <?php endif; ?>>
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
		             <input type="hidden" class="form-control" value="<?php echo e($dataList->mws_id); ?>" name="mws_id" id="mws_id">
		            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		            <!--<button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="updateAccessPermission()">Save</button>-->
		            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" >Save</button>
		        </div>
		      </form>
		      
            <script type="text/javascript">
            
                    $(document).ready(function (e) {
                            
                            $('#editStream').on('submit',(function(e) {
                                e.preventDefault();
                                var formData = new FormData(this);
                                var urlAction = $(this).attr('action');
                                
                                addeditwebinarst(urlAction, formData);
                            }));
                        
                    });
            </script>


		      <?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/datatables/editstream.blade.php ENDPATH**/ ?>