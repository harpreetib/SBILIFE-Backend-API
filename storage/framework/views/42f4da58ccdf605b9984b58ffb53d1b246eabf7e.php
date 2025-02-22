
<!-- SOCIAL MODAL -->
<div class="modal fade" id="socialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="socialModalTitle">Add Social Media Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" id="socialForm" action="logoUpload" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
          <div class="col-md-12 form-group">
              
                <div id="socialLink" style="display:none;">
                    
                    <?php if(!empty($data[0])): ?>
                        <label>Facebook</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="facebook" value="<?php echo e($data[0]->facebook); ?>" />
                        <label>Twitter</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="twitter" value="<?php echo e($data[0]->twitter); ?>" />
                        <label>Instagram</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="instagram" value="<?php echo e($data[0]->instagram); ?>" />
                    <?php else: ?>
                        <label>Facebook</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="facebook" value="" />
                        <label>Twitter</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="twitter" value="" />
                        <label>Instagram</label>
                        <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" name="instagram" value="" />
                    <?php endif; ?>
                    
                </div>
                <div id="youtubeLink" style="display:none;">
                    <label>Youtube Video Link</label>
                    <input type="text" class="form-control" placeholder="Enter URL" style="background-color:#d1d1d1;" id="video_url" name="video_url" value="" />    
                </div>
                
                <input type="hidden" name="template" value="<?php echo e($_REQUEST['template']); ?>" />
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary" id="socialBtn" name="socialMedia">ADD</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--SOCIAL MODAL END-->


<!-- AGENDA MODAL -->
 <div class="modal fade" id="agendaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 80%!important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add New Counselor Session</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addcounselorSession" id="addcounselorSession" class="" action="" method="post"  enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                              <input class="form-control" type="hidden" name="addcourse" id="addcourse" value="addcourse" />
                             <div class="card mb-4">
                             	<div class="card-body">                
                                <div class="row">
                                <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Session Type</label>
		                        <select class="form-control" name="type" id="type" >
		                            <option value="">Select Session Type</option>
		                            <option value="audi">Main Audi</option>
		                            <option value="h1">Hall 1</option>
		                             <option value="h2">Hall 2</option>
		                              <option value="h3">Hall 3</option>
		                               <option value="h4">Hall 4</option>
		                                <option value="h5">Hall 5</option>
		                                 <option value="h6">Hall 6</option>
		                                 
		                        </select>
		                        
		                    </div>
		                      <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Session Name</label>
		                        <input type="text" class="form-control" name="name" id="name" placeholder="Session Name"
		                        value="">
		                        <span class="text-danger" id="lcc_name" name="lcc_name"  style="display:none;"></span>
		                    </div>
		                    
		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Sub Heading</label>
		                        <!--<input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="Sub Heading"-->
		                        <!--value="">-->
		                        <textarea class="form-control" name="sub_title" id="sub_title" placeholder="Sub Heading"
		                        value=""></textarea>
		                        <!--<span class="text-danger" id="lcc_name" name="lcc_name"  style="display:none;"></span>-->
		                    </div>
		                    
		                   <!--<div class="col-md-6 form-group mb-3">-->
		                   <!--     <label for="course_duration">Session Banner</label>-->
		                   <!--     <input type="file" class="form-control" name="sbanner" id="sbanner" -->
		                   <!--     value="">-->
		                   <!--     <span class="text-danger" id="lcc_name" name="lcc_name"  style="display:none;"></span>-->
		                   <!-- </div>-->
		                   
		                     <!-- <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration"> Speaker Name</label>
		                        <input type="text" class="form-control" name="s_name" id="s_name" placeholder="Speaker Name"
		                        value="">
		                        <span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>
		                    </div> -->
		                    
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator / Host Name</label>-->
		                    <!--    <input type="text" class="form-control" name="moderator" id="moderator" placeholder="Moderator Name"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator/Host Designation</label>-->
		                    <!--    <input type="text" class="form-control" name="mdesignation" id="mdesignation" placeholder="Moderator Designation"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator /Host Description</label>-->
		                    <!--    <input type="text" class="form-control" name="mdesc" id="mdesc" placeholder="Moderator Description"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator /Host  Pic</label>-->
		                    <!--    <input type="file" class="form-control" name="moderatorpic" id="moderatorpic" -->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Name</label>-->
		                    <!--    <input type="text" class="form-control" name="host" id="host" placeholder="Host Name"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Desigation</label>-->
		                    <!--    <input type="text" class="form-control" name="hdesignation" id="hdesignation" placeholder="Host Desigation"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Description</label>-->
		                    <!--    <input type="text" class="form-control" name="hdesc" id="hdesc" placeholder="Host Description"-->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!--  <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Pic</label>-->
		                    <!--    <input type="file" class="form-control" name="hostpic" id="hostpic" -->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
                            
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker3">Start Date Time</label> 
                                <input id="picker3" onfocus="(this.type='datetime-local')" step=1 onblur="if(!this.value)this.type='text'" class="form-control" placeholder="Select DateFrom" name="picker3" value="">
                                <span class="text-danger" id="lcc_start" name="lcc_start"  style="display:none;"></span>
                            </div>
                             
                            <div class="col-md-6 form-group mb-3">
                                <label for="picker3">End Date Time</label>
                                <input id="enddate" onfocus="(this.type='datetime-local')" step=1 onblur="if(!this.value)this.type='text'" class="form-control" placeholder="Select DateTo" name="enddate" value="">
                                <span class="text-danger" id="lcc_end" name="lcc_end"  style="display:none;"></span>
                            </div>
		                    
							<!-- <div class="col-md-6 form-group mb-3">
	                            <label for="picker3">Start Date Time</label>             
	                                <input id="picker3" type="text" step=1 class="form-control" name="picker3" placeholder="Start Date Time">
	                                <div class="input-group-append">
	                                        
	                            </div>
	                            <span class="text-danger" id="lcc_start" name="lcc_start"  style="display:none;"></span>
                        	</div>

							<div class="col-md-6 form-group mb-3">
                            <label for="picker3">End Date Time</label>
                                <input id="enddate" class="form-control" type="text" step=1 name="enddate" placeholder="End Date Time">
                                <div class="input-group-append">                                       
                            	</div>
                            	<span class="text-danger" id="lcc_end" name="lcc_end"  style="display:none;"></span>
                    		</div> -->

                            <!--<div class="col-md-6 form-group mb-3">-->
                            <!--<label for="picker3">Past Video Url</label>-->
                            <!--    <input id="pastvideo_url" class="form-control" type="text" name="pastvideo_url" placeholder="Past Video Url">-->
                            <!--    <div class="input-group-append">                                       -->
                            <!--    </div>-->
                            <!--    <span class="text-danger" id="lcc_pastvideo" name="lcc_pastvideo"  style="display:none;"></span>-->
                            <!--</div>-->

		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_fee_year">Room url</label>-->
		                    <!--    <input type="text" class="form-control" name="roomid" id="roomid"  placeholder="Room URL"-->
		                    <!--     value="">-->
		                    <!--    <span class="text-danger" id="lcc_room" name="lcc_room"  style="display:none;"></span>-->
		                    <!--</div>-->


		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_fee_year">Zoom Password</label>-->
		                    <!--    <input type="text" class="form-control" name="zoompass" id="zoompass"  placeholder="Zoom Password"  -->
		                    <!--        value="">-->
		                    <!--    <span class="text-danger" id="lccs_zoom_pwd" name="lccs_zoom_pwd"  style="display:none;"></span>-->
		                    <!--</div> -->
		                       
		                </div>
                        </div>
                        
                    		</div>


                        <div class="card mb-4">
                                <div class="card-body"> 
                                      
                                <div class="row ">
                                
                                        
                                  <div name="div_add_speaker" id="div_add_speaker"  >
        						
        								<div class="col-md-6">
        									<h5><b>Add Speakers:</b></h5>
        								</div>
        								<div class="col-md-6 float-right" >
        									<button type="button" class="btn btn-info add-speaker" id="addspeaker" name="addspeaker">Add Speaker</button>
        								</div>
        						
                             
            								<div>
            									<table class="table table-bordered table-striped">
            										<thead>
            											<tr>
            											<th>Session Time</th>
            											<th>Speaker Company Name</th>
            												<th>Speaker Name<span style="color:red;">*</span></th>
            												<th>Speaker Designation</th>
            												<th>Speaker Description</th>
            												<th>Photo</th>
            												<th>Action</th>
            												
            											</tr>
            										</thead>
            										<tbody id="speaker">
            											<?php $j=0;?>
            											<tr>
            											     <td><input class="form-control" type="text" name="stime-<?php echo $j; ?>" autocomplete="off" id="stime-<?php echo $j; ?>" value=""   placeholder="Session Time"></td>
            											    <td><input class="form-control" type="text" name="scname-<?php echo $j; ?>" autocomplete="off" id="scname-<?php echo $j; ?>" value=""   placeholder="Speaker Company Name"></td>
            												<td><input class="form-control" type="text" name="sname-<?php echo $j; ?>" autocomplete="off" id="sname-<?php echo $j; ?>" value=""   placeholder="Full Name"></td>
            												<td><input class="form-control" type="text" name="sdesig-<?php echo $j; ?>" autocomplete="off" id="sdesig-<?php echo $j; ?>" value=""   placeholder="Designation"></td>
            													<td><input class="form-control" type="text" name="sdesc-<?php echo $j; ?>" autocomplete="off" id="sdesc-<?php echo $j; ?>" value=""   placeholder="Description"></td>
            												<td><input class="form-control" type="file" name="spic-<?php echo $j; ?>" autocomplete="off" id="spic-<?php echo $j; ?>" value=""  ></td>
            												<td class="text-danger"><a class="fa fa-trash delete-row"></a>
            												<input type="hidden" value=""></td>
            											</tr>
            										</tbody>
            									</table>
            								</div>
            								<div class="" align="center">
            									<input type="hidden" name="row_count_speaker" id="row_count_speaker" value="<?php echo $j; ?>">
            									<input type="hidden" name="template" value="<?php echo e($_REQUEST['template']); ?>" />
            								</div>
						
						    </div>
                         </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button " data-style="expand-right" onclick="AddCounselorSession()">Add Session</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            </div>
<!--AGENDA MODAL END -->

<!-- EDIT AGENDA MODAL -->
        <div class="modal fade" id="editCareerSession" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
               <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 80%!important;">
                   <div class="modal-content" id="careerSession">
                       
                       
                       
                   </div>
               </div>
           </div>
 <!--EDIT AGENDA MODAL END -->


<!-- TOGGLE MODAL -->
<div class="modal fade" id="toggleModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Section Toggle On/Off</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="window.location.reload();">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--<form  method="POST" action="sectionToggle" enctype="multipart/form-data">-->
            <!--<?php echo csrf_field(); ?>-->
          <div class="col-md-12 form-group">
              &nbsp;
              <div class="row">
                  
                  <?php $__currentLoopData = $sectionData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $reqtext="active";
                        $checked="";
                       ?>
                       <?php $__currentLoopData = $sectionMapData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($smd->sm_id == $sd->sm_id): ?>
                          <?php 
                                if($smd->smm_status=='active'){
                                  $reqtext="inactive";  
                                  $checked="checked";
                                }
                                
                                 break;
                          ?>  
                        <?php endif; ?>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="col-md-4">
                            <h4><?php echo e($sd->sm_name); ?></h4>
                            <label class="switch">
                              <input type="checkbox" id="sm_id_<?php echo e($sd->sm_id); ?>" name="sm_id_<?php echo e($sd->sm_id); ?>" onclick="sectionToggle(`<?php echo e($_REQUEST['template']); ?>`,`<?php echo e($sd->sm_id); ?>`,`<?php echo e($reqtext); ?>`);" <?php echo e($checked); ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
              </div>
                
                <!--<input type="hidden" name="template" value="<?php echo e($_REQUEST['template']); ?>" />-->
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onClick="window.location.reload();">Close</button>
        <!--<button type="submit" class="btn btn-secondary" id="toggleBtn" name="toggle">Save</button>-->
      </div>
      <!--</form>-->
    </div>
  </div>
</div>
<!--TOGGLE MODAL END-->

<!--CROPPER MODAL START-->
<div class="modal fade" id="modal" tabindex="-1"  role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form name="cropperImgForm" id="cropperImgForm" action="photoUpload" method="post"  enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="emptyFile();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    Dimensions <span  id="dimensions" style="color: #ed3838;"></span>
                    <div class="row">
                        <div class="col-md-8" style="max-height: 250px">
                            <img id="image" src="">
                            <input type="hidden" name="template" value="<?php echo e($_REQUEST['template']); ?>" />
                            <input type="hidden" id="croppedImage" name="croppedImage" value="" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                        <div id="spkFields" class="col-md-12" style="display:none;">
                            &nbsp;
                            <input type="text" class="form-control" placeholder="Enter Speaker Name" style="background-color:#d1d1d1;" id="spk_name" name="spk_name" value="" />
                            &nbsp;
                            <input type="text" class="form-control" placeholder="Enter Speaker Designation" style="background-color:#d1d1d1;" id="spk_des" name="spk_des" value="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="emptyFile();">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
                <button type="submit" class="btn btn-primary" id="cropperSaveBtn" name="uploadgSponsor" style="display:none;">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--CROPPER MODAL END--><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/layouts/modal-lpage.blade.php ENDPATH**/ ?>