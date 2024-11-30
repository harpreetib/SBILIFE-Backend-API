    
     		 <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    	<div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Event Detail</h4></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  name="updateEvent_d" id="updateEvent_d" class="" method="post" enctype="multipart/form-data"
             onsubmit="return validateForm()">
                  <?php echo e(csrf_field()); ?>             
            <div class="modal-body">
        <div class="card mb-4">
            <div class="card-body">              
                   <div class="row">
                        
                        <div class="col-md-6 form-group mb-3">
                            <label for="course_duration"> Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="ex_name" id="ex_name" placeholder="Name"
                            value="<?php echo e($eventlist->aem_name); ?>">
                            <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="course_fee_sem">NickName <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="ex_nickname" id="ex_nickname" placeholder="NickName" 
                             value="<?php echo e($eventlist->aem_event_nickname); ?>" readonly/>
                            <span class="text-danger" id="msg_nickname" name="msg_nickname"  style="display:none;"></span>
                        </div>
              
              <div class="col-md-6 form-group mb-3">
                            <label for="course_fee_year">Address</label>
                            <input type="text" class="form-control" name="ex_address" id="ex_address"  placeholder="Address"
                             value="<?php echo e($eventlist->aem_full_address); ?>">
                            <span class="text-danger" id="msg_address" name="msg_address"  style="display:none;"></span>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="course_fee_year">Location</label>
                            <input type="text" class="form-control" name="ex_location" id="ex_location"  placeholder="Address"
                             value="<?php echo e($eventlist->aem_location); ?>">
                            <span class="text-danger" id="msg_location" name="msg_location"  style="display:none;"></span>
                        </div>

                        
                        <div class="col-md-6 form-group mb-3">
                              <label for="e_livedt">Live Date Time <span style="color:red;"><sup>Change this to make event live</sup></span></label>                        
                                  <input id="e_livedt" type="text" step=1 class="form-control" name="ex_livedt" placeholder="Live Date Time"  value="<?php echo e($eventlist->aem_live_date_time); ?>">
                                 <div class="input-group-append">                                      
                              </div>
                              <span class="text-danger" id="msg_start" name="lccc_start"  style="display:none;"></span>
                          </div>
                        
                          <div class="col-md-6 form-group mb-3">
                              <label for="picker3">Start Date Time <span style="color:red">*</span></label>                        
                                  <input id="e_startdates" type="text" step=1 class="form-control" name="ex_startdates" placeholder="Start Date Time"  value="<?php echo e($eventlist->aem_start_date); ?>">
                                 <div class="input-group-append">                                      
                              </div>
                              <span class="text-danger" id="msg_start" name="lccc_start"  style="display:none;"></span>
                          </div>


              <div class="col-md-6 form-group mb-3">
                              <label for="picker3">End Date Time <span style="color:red">*</span></label>                        
                                  <input id="ex_enddate" type="text" step=1 class="form-control" name="e_enddate" placeholder="End Date Time"   value="<?php echo e($eventlist->aem_end_date); ?>">
                                 
                             <span class="text-danger" id="msg_end" name="lccc_end"  style="display:none;"></span>
                          </div>
                       

                        

                             <div class="col-md-6 form-group mb-3">
                                <label for="course_fee_sem">Select Day</label>  
                                 <select class="form-control" id="ex_day" name="ex_day">
                                  <option value="<?php echo e($eventlist->aem_day); ?>"><?php echo e($eventlist->aem_day); ?></option>         
                                  <option value="Sunday">Sunday</option>
                                  <option value="Monday">Monday</option>
                                  <option value="Tuesday">Tuesday</option>
                                  <option value="Wednesday">Wednesday</option>
                                  <option value="Thursday">Thursday</option>
                                  <option value="Friday">Friday</option>
                                  <option value="Saturday">Saturday</option>
                                
                               
                                </select>
                                <span class="text-danger" id="msg_day" name="err_day"  style="display:none;"></span>
                            </div> 

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Time</label>
                                        <input type="time" class="form-control" name="ex_time" id="ex_time" step=1 placeholder=" Time" 
                                         value="<?php echo e($eventlist->aem_time); ?>">
                                        <span class="text-danger" id="msg_time" name="err_time"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem"> Date</label>
                                        <input type="text" class="form-control" name="ex_date" id="ex_date" step=1 placeholder=" Date" 
                                         value="<?php echo e($eventlist->aem_date); ?>">
                                        <span class="text-danger" id="msg_date" name="err_date"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem"> Event Date</label>
                                        <input type="text" class="form-control" name="ex_eventdate" id="ex_eventdate" step=1 placeholder=" Event Date" 
                                         value="<?php echo e($eventlist->aem_event_date); ?>">
                                        <span class="text-danger" id="msg_eventdate" name="err_eventdate"  style="display:none;"></span>
                                    </div>
                                    
                                     <div class="col-md-6 form-group mb-3">
                                          <label for="recipient-name-2">Select Timezone:</label>
                                        <select class="form-control" name="ex_timezones" id="ex_timezones">
                                            <?php $__currentLoopData = $Allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($country->timezones); ?>" data-id="<?php echo e($country->counm_code); ?>" <?php echo e($country->timezones == $eventlist->aem_timezones ? 'selected' : ''); ?>><?php echo e($country->counm_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                          
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">SUbject</label>
                                        <input type="text" class="form-control" name="ex_subject" id="ex_subject" placeholder="Subject" 
                                         value="<?php echo e($eventlist->aem_mail_subject); ?>">
                                        <span class="text-danger" id="msg_subject" name="err_subject"  style="display:none;"></span>
                                    </div>
  


                                <div class="col-md-6 form-group mb-3">
                                <label for="course_fee_sem">Status</label>
                  				<select class="custom-select" name="status" id="status">                            
                                    <?php if($eventlist->aem_status =='future'): ?>
                                    <option value="<?php echo e($eventlist->aem_status); ?>"><?php echo e(ucfirst($eventlist->aem_status)); ?></option>
                                    <option value="current">Current</option>
                                    <option value="old">Finish</option>  
                                    <option value="inactivate">Inactivate</option> 
                                    <?php endif; ?>
                                    <?php if($eventlist->aem_status =='current'): ?>
                                    <option value="<?php echo e($eventlist->aem_status); ?>"><?php echo e(ucfirst($eventlist->aem_status)); ?></option>
                                    <option value="future">Future</option>
                                    <option value="old">Finish</option>  
                                    <option value="inactivate">Inactivate</option> 
                                    <?php endif; ?>
                                    <?php if($eventlist->aem_status =='old'): ?>
                                    <option value="<?php echo e($eventlist->aem_status); ?>">Finish</option>
                                    <option value="future">Future</option>
                                    <option value="current">Current</option>  
                                    <option value="inactivate">Inactivate</option>
                                    <?php endif; ?>
                                    <?php if($eventlist->aem_status =='inactivate'): ?>
                                     <option value="<?php echo e($eventlist->aem_status); ?>"><?php echo e(ucfirst($eventlist->aem_status)); ?></option>
                                    <option value="future">Future</option>
                                    <option value="current">Current</option>  
                                    <option value="old">Finish</option>
                                    <?php endif; ?>
                  				</select>
                                 <span class="text-danger" id="msg_status" name="err_status"  style="display:none;"></span>
                                 </div>

                                     <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Event Mail</label>
                                        
                                         <textarea class="ckeditor form-control form-control-lg"  name="ex_eventmail" autocomplete="off" id="ex_mail" ><?php echo e($eventlist->aem_mail_html); ?></textarea>

                                        <span class="text-danger" id="msg_mail" name="err_mail"  style="display:none;"></span>
                                    </div>
                                      
                                    
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">SMS</label>
                                         
                                         <textarea class="ckeditor form-control form-control-lg"  name="ex_sms" autocomplete="off" id="ex_sms" ><?php echo e($eventlist->aem_sms_text); ?></textarea>

                                        <span class="text-danger" id="msg_sms" name="err_sms"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                      
                                        <label for="course_fee_sem">Logo</label>
                                        <input class="input-file uniform_on" name="ex_file" id="ex_file" type="file"><img src="<?php echo e(URL::to($eventlist->aem_logo_image)); ?>" style="height: 89px; margin-left: 32px;width: 122px;">
                                        <span class="text-danger" id="msg_file" name="err_file"  style="display:none;"></span>
                                        
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                      
                                        <label for="course_fee_sem">Header</label>
                                        <input class="input-file uniform_on" name="he_image" id="he_image" type="file"><img src="<?php echo e(URL::to($eventlist->aem_header_img)); ?>" style="height: 89px; margin-left: 32px;width: 122px;">
                                        <span class="text-danger" id="err_he_img" name="err_he_img"  style="display:none;"></span>
                                        
                               </div>     
                    </div>
            </div>
        </div>


            </div>
            <div class="modal-footer">
                 <input type="hidden" class="form-control" value="<?php echo e($eventlist->aem_id); ?>" name="aem_id" id="aem_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="updateEvent()">Update Event</button>
            </div>
          </form>


<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 -->
<!--<script src="<?php echo e(asset('assets/js/ckeditor/ckeditor.js')); ?>"></script>-->
<!--<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>-->
<script type="text/javascript">
	 jQuery(document).ready(function() {
  CKEDITOR.replace("ex_sms")
 });
</script>
<script type="text/javascript">
	 jQuery(document).ready(function() {
  CKEDITOR.replace("ex_mail")
 });
</script>
 <script type="text/javascript">
  
  $(document).ready(function(){
    $("#e_livedt").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });
  
  $(document).ready(function(){
    $("#e_startdates").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });

  $(document).ready(function(){
    $("#ex_enddate").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });

  $(document).ready(function(){
    $("#ex_time").focus( function() {
      $(this).attr({type: 'time'});
      });
    });
</script>
<script>
  $(document).ready(function() {
        $('#ex_mail').summernote();
    });
</script>
  <script type="text/javascript">
   $("#ex_name").keyup(function () {
   var str = $(this).val();
   var slug=str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\|\/,.<>?\s]/g, ' ').toLowerCase();
   var slug=str.replace(/^\s+|\s+$/gm,'');
   var slug=str.replace(/\s+/g, '');
   var trimmed=$.trim(str)
   var check =slug.toLowerCase();
   $("#ex_nickname").val(slug.toLowerCase());
   });
</script>     
              <?php /**PATH /home/eventsibentos/public_html/admin/resources/views/datatables/editevent.blade.php ENDPATH**/ ?>