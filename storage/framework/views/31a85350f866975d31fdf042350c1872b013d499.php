<?php $__env->startSection('page-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
<style>
    .divide{
        border-top: 1px solid #dee2e6;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
            <div class="breadcrumb">
                <h1>Events</h1>
                <ul>
                  <li>Details</li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>
            </div>
            

<div class="separator-breadcrumb border-top"></div>
          
<div class="row mb-4">
  <div class="col-md-12 mb-3">

                    <h4>  <a href="#" class="float-right"  data-toggle="modal" data-target="#CounselorModel" ><button type="button" class="btn btn-info btn-rounded m-1">Add Event</button></a><h4>
            </div>
  <div class="col-md-12 mb-4">
    <div class="card text-left">
        <div class="card-body">
            <div class="table-responsive">
              <div class="row ">
                  <div class="col-md-12">
                      <div class="table-responsive">
                              <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                      <tr>
                                      <th scope="col">#</th>

                                      <th scope="col">Name
                                              <div class="divide"> NickName </div>
                                              <div class="divide"> Frontend url </div></th>
                                              
                                      <th scope="col">Selected Template
                                              <div class="divide"> Live Date Time </div></th>

                                      <th scope="col">Address
                                          <div class="divide"> Location </div></th>

                                      <th scope="col">Start Date
                                          <div class="divide"> End Date </div></th>

                                      <th scope="col">Date
                                          <div class="divide"> Event Date </div></th>
                                          
                                      <th scope="col">Day
                                        <div class="divide"> Time </div></th>
                                    
                                      <th scope="col">Mail Subject 
                                          <div class="divide">Event Mail </div></th>

                                      <th scope="col">SMS
                                          <div class="divide"> SMS Template</div></th>

                                      <th scope="col">Logo
                                          <div class="divide"> Status</div></th>

                                      <th scope="col">Header Image<div class="divide"> Action</div></th>
                                      </tr>
                                  </thead>
                                     
                                      <tbody>     
                      				          <?php
                                          $i=1
                                          ?>
                                          <?php if(isset($eventList) && !empty($eventList)): ?>
                                              <?php $__currentLoopData = $eventList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>          
                                          <tr>
                                              <th scope="row"><?php echo e($i++); ?></th>
                                                <td><?php echo e($list->aem_name); ?>

                                                 <div class="divide"> <?php echo e($list->aem_event_nickname); ?></div>
                                                 <div class="divide"> <a target="_blank" href="<?php echo e(Config::get('app.url').'/apps/'.$brand->bm_nickname.'/'.$list->aem_event_nickname); ?>">Go To Landing Page</a></div></td>
                                                
                                                <td>
                                                    <select id="selectTemp"  name="selectTemp" onchange="selectTemp(this.value, '<?php echo e($list->aem_id); ?>');">
                                                        <?php $__currentLoopData = $templateData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $td): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($td->tm_id); ?>" <?php echo ($list->tm_id == $td->tm_id) ? 'selected' : '' ?> ><?php echo e($td->tm_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    &nbsp;
                                                    <div class="divide"><?php echo e(date('d-M,Y',strtotime($list->aem_live_date_time))); ?> <?php echo e(date('h:i A',strtotime($list->aem_live_date_time))); ?></div>
                                                </td> 

                                                <td><?php echo e($list->aem_full_address); ?>

                                                  <div class="divide"><?php echo e($list->aem_location); ?></div></td>

                                                <td> <?php echo e(date('d-M,Y',strtotime($list->aem_start_date))); ?> <?php echo e(date('h:i A',strtotime($list->aem_start_date))); ?><div class="divide"><?php echo e(date('d-M,Y',strtotime($list->aem_end_date))); ?> <?php echo e(date('h:i A',strtotime($list->aem_end_date))); ?></div> </td>

                                                <td><?php echo e($list->aem_date); ?><div class="divide"><?php echo e($list->aem_event_date); ?></div></td>
                                                <td><?php echo e($list->aem_day); ?><div class="divide"><?php echo e($list->aem_time); ?></div></td>      
                                                <!--<td> <?php echo e($list->aem_mail_subject); ?> <div class="divide"><?php echo $list->aem_mail_html; ?></div> </td>-->
                                                 <td> <?php echo e($list->aem_mail_subject); ?> <div class="divide"> <span class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalLong" onclick="$('#MailPreview').html(`<?php echo e($list->aem_mail_html); ?>`);" > <i class="i-Eye"></i>  &nbsp; Text Preview</span> <span  class="btn btn-outline-success" onclick="sm('<?php echo e($list->aem_id); ?>');"><i class="i-Eye"></i> &nbsp; Mail Preview</span>  </div> </td> 
    
                                                <td><?php echo $list->aem_sms_text; ?><div class="divide"><?php echo e($list->aem_sms_template); ?></div></td>

                                                <?php if(!empty($list->aem_logo_image)): ?>
                                                <td><img src="<?php echo e(URL::to($list->aem_logo_image)); ?>" style="height: 80px; width: 80px;"><div class="divide">
                                                <?php if($list->aem_status == 'old'): ?>
                                                  Finish
                                                <?php else: ?>
                                                  <?php echo e(ucfirst($list->aem_status)); ?>

                                                <?php endif; ?>
                                                  </div></td>
                                                <?php else: ?>
                                               <td>No logo<div class="divide">
                                                <?php if($list->aem_status == 'old'): ?>
                                                  Finish
                                                <?php else: ?>
                                                  <?php echo e(ucfirst($list->aem_status)); ?>

                                                <?php endif; ?>
                                              </div></td>
                                                <?php endif; ?>

                                                 <?php if(!empty($list->aem_header_img)): ?>
                                                  <td><img src="<?php echo e(URL::to($list->aem_header_img)); ?>" style="height: 80px; width: 80px;"><div class="divide">
                                                  <a href="javascript:void(0);" class="text-success mr-2" onclick="editeventdetails('<?php echo e($list->aem_id); ?>');">
                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i></a></div></td>
                                                 <?php else: ?>
                                                  <td>Image not found<div class="divide">
                                                  <a href="javascript:void(0);" class="text-success mr-2" onclick="editeventdetails('<?php echo e($list->aem_id); ?>');">
                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i></a></div></td>
                                                 <?php endif; ?>   
                                               
                                               
                                          </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php else: ?>
                                              <tr><th scope="row" >Empty record!</th></tr>
                                         <?php endif; ?>
                                      </tbody>
                               </table>            
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Courses Offered modal -->
 <div class="modal fade" id="CounselorModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add New Event</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addevent" id="addevent" class="" action="" method="post"  enctype="multipart/form-data" onsubmit="return validateAddform()">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                              <input class="form-control" type="hidden" name="addcourse" id="addcourse" value="addcourse" />
                             <div class="card mb-4">
                              <div class="card-body">                
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration"> Name <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        value="">
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">NickName <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="nickname" id="nickname" placeholder="NickName" 
                                         value="" readonly/>
                                        <span class="text-danger" id="err_nickname" name="err_nickname"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Address</label>
                                        <input type="text" class="form-control" name="address" id="address"  placeholder="Address"
                                         value="">
                                        <span class="text-danger" id="err_address" name="err_address"  style="display:none;"></span>
                                    </div>
                                    
                                    

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Location</label>
                                        <input type="text" class="form-control" name="location" id="location" placeholder=" Location" 
                                         value="">
                                        <span class="text-danger" id="err_location" name="err_location"  style="display:none;"></span>
                                    </div> 
                                    
                                    <div class="col-md-6 form-group mb-3">
                                      <label for="livedt">Live Date Time <span style="color:red">*</span></label>             
                                      <input id="livedt" type="text" step=1 class="form-control" name="livedt" placeholder="Live Date Time">
                                      <div class="input-group-append">
                                          
                                      </div>
                                      <span class="text-danger" id="err_live" name="err_live"  style="display:none;"></span>
                                    </div>

                                   <div class="col-md-6 form-group mb-3">
                                      <label for="picker3">Start Date Time <span style="color:red">*</span> </label>             
                                      <input id="picker3" type="text" step=1 class="form-control" name="picker3" placeholder="Start Date Time">
                                      <div class="input-group-append">
                                          
                                      </div>
                                      <span class="text-danger" id="err_start" name="err_start"  style="display:none;"></span>
                                    </div>

                                  <div class="col-md-6 form-group mb-3">
                                      <label for="picker3">End Date Time <span style="color:red">*</span> </label>
                                      <input id="enddate" class="form-control" type="text" step=1 name="enddate" placeholder="End Date Time">
                                      <div class="input-group-append">                                       
                                      </div>
                                      <span class="text-danger" id="err_end" name="err_end"  style="display:none;"></span>
                                    </div>

                                     <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Select Day</label>
                                        
                                         <select class="form-control" id="day" name="day">

                                         <option value="">Select Day</option>
                                       
                                       <option value="Sunday">Sunday</option>
                                       <option value="Monday">Monday</option>
                                       <option value="Tuesday">Tuesday</option>
                                       <option value="Wednesday">Wednesday</option>
                                       <option value="Thursday">Thursday</option>
                                       <option value="Friday">Friday</option>
                                       <option value="Saturday">Saturday</option>
                                        
                                       
                                        </select>
                                        <span class="text-danger" id="err_day" name="err_day"  style="display:none;"></span>
                                    </div> 

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Time</label>
                                        <input type="text" class="form-control" name="time" id="time" step=1 placeholder=" Time" 
                                         value="">
                                        <span class="text-danger" id="err_time" name="err_time"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem"> Date</label>
                                        <input type="text" class="form-control" name="between" id="between" step=1 placeholder=" Date" 
                                         value="">
                                        <span class="text-danger" id="err_between" name="err_between"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem"> Event Date</label>
                                        <input type="text" class="form-control" name="eventdate" id="eventdate" step=1 placeholder=" Event Date" 
                                         value="">
                                        <span class="text-danger" id="err_eventdate" name="err_eventdate"  style="display:none;"></span>
                                    </div>

                                    
                                         <div class="col-md-6 form-group mb-3">
                                              <label for="recipient-name-2">Select Timezone:</label>
                                            <select class="form-control" name="timezones" id="timezones">
                                                <?php $__currentLoopData = $Allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <option value="<?php echo e($country->timezones); ?>" data-id="<?php echo e($country->counm_code); ?>"><?php echo e($country->counm_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                          </div>
                                      
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Subject</label>
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" 
                                         value="">
                                        <span class="text-danger" id="err_subject" name="err_subject"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">SMS</label>
                                        
                                         <textarea class="ckeditor form-control form-control-lg"  name="sms" autocomplete="off" id="sms" ></textarea>
                                        <span class="text-danger" id="err_sms" name="err_sms"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Event Mail</label>
                                        <textarea class="ckeditor form-control form-control-lg"  name="mail" autocomplete="off" id="mail" ></textarea>

                                       
                                        <span class="text-danger" id="err_mail" name="err_mail"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Logo</label>
                                        <input type="file" class="form-control" name="file" id="file"  
                                         value="">
                                        <span class="text-danger" id="err_f" name="err_f"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Header Image</label>
                                        <input type="file" class="form-control" name="header_img" id="header_img"  
                                         value="">
                                        <span class="text-danger" id="err_header" name="err_header"  style="display:none;"></span>
                                    </div>


                                    
                                </div>
                        </div>
                        
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="Addevent()">Add Event</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
 <!--End Courses Offered modal -->

 <!-- Preview Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="MailPreview">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


 <!-- start Edit User modal -->
        <div class="modal fade" id="EditeventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="editevent_m">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-js'); ?>
<script src="<?php echo e(asset('assets/js/vendor/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatables.script.js')); ?>"></script>
 <!--<script src="<?php echo e(asset('assets/js/ckeditor/ckeditor.js')); ?>"></script>-->
 <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
<!--<!--ript src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->-->
<!-- <script>
  $(document).ready(function() {
        $('#mail').summernote();
    });
</script> -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#livedt").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });

  $(document).ready(function(){
    $("#picker3").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });

  $(document).ready(function(){
    $("#enddate").focus( function() {
      $(this).attr({type: 'datetime-local'});
      });
    });

  $(document).ready(function(){
    $("#time").focus( function() {
      $(this).attr({type: 'time'});
      });
    });

function sm(aem_id){
    // alert(aem_id);
    $('#MailPreview').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'mailstp',
                data: 'aem_id='+aem_id,
                success: function (data) { 
                     $("#MailPreview").html(data);
                     $('#exampleModalLong').modal('toggle')
                    }      
            });
   
}

function editeventdetails(aem_id){
   // alert(aem_id);
            
            $('#editevent_m').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editevent',
                data: 'aem_id='+aem_id,
                success: function (data) {           
                    $('#editevent_m').html(data);
                    $('#EditeventModal').modal('toggle')
                    }      
            });
        }

        

      function Addevent()
        {     
          $("#addevent").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'Addevent',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                      if (response==true) {
                    Swal.fire({
                          type: 'success',
                          title: 'Success!',
                          text: ' Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  }
                      setTimeout(function(){ window.location.reload(); }, 3000);
                      return false;
                       
                    }
                });
            });
          }


       function updateEvent(){
            $("#updateEvent_d").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'Addevent',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                      if (response==true) {
                    Swal.fire({
                          type: 'success',
                          title: 'Success!',
                          text: ' Event Updated Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  }
                      setTimeout(function(){ window.location.reload(); }, 3000);
                      return false;
                       
                    }
                });
            });
             
          }
//Validate Edit Event Input boxes
        function validateForm(){

        var file = $("#ex_file").val(); 
        var name = $("#ex_name").val(); 
        var nickname = $("#ex_nickname").val(); 
        var address = $("#ex_address").val(); 
        var location = $("#ex_location").val(); 
        var l_date = $("#e_livedt").val();
        var s_date = $("#e_startdates").val();      
        var e_date = $("#ex_enddate").val(); 
        var day = $("#ex_day").val(); 
        var time = $("#ex_time").val(); 
        var between = $("#ex_date").val();
        var eventdate = $("#ex_eventdate").val(); 
        var subject = $("#ex_subject").val(); 
        var sms = $("#ex_sms").val(); 
        var mail = $("#ex_mail").val();
        var he_image = $("#he_image").val();

        $("#msg_name").fadeOut('fast');
          if( $.trim(name) == '')
            {      
              $("#msg_name").text("Please Enter Name");
                  $("#msg_name").fadeIn('fast');
                    $("#ex_name").focus();
              return false;
            }

          $("#msg_nickname").fadeOut('fast');
          if( $.trim(nickname) == '')
            {      
              $("#msg_nickname").text("Please Enter NickName");
                  $("#msg_nickname").fadeIn('fast');
                    $("#ex_nickname").focus();
              return false;
            }

          /*$("#msg_address").fadeOut('fast');
          if( $.trim(address) == '')
            {      
              $("#msg_address").text("Please Enter Address");
                  $("#msg_address").fadeIn('fast');
                    $("#ex_address").focus();
              return false;
            }*/

         /* $("#msg_location").fadeOut('fast');
          if( $.trim(location) == '')
            {      
              $("#msg_location").text("Please Enter Location");
                  $("#msg_location").fadeIn('fast');
                    $("#ex_location").focus();
              return false;
            }*/
          
          $("#msg_live").fadeOut('fast');
          if( $.trim(l_date) == '')
            {      
              $("#msg_live").text("Please Select Live Date Time");
                  $("#msg_live").fadeIn('fast');
                    $("#e_livedt").focus();
              return false;
            }
          
          $("#msg_start").fadeOut('fast');
          if( $.trim(s_date) == '')
            {      
              $("#msg_start").text("Please Select Start Date");
                  $("#msg_start").fadeIn('fast');
                    $("#e_startdates").focus();
              return false;
            }

          $("#msg_end").fadeOut('fast');
          if( $.trim(e_date) == '')
            {      
              $("#msg_end").text("Please Select End Date");
                  $("#msg_end").fadeIn('fast');
                    $("#ex_enddate").focus();
              return false;
            }
          $("#msg_day").fadeOut('fast');
          if( $.trim(day) == '')
            {      
              $("#msg_day").text("Please Select Day");
                  $("#msg_day").fadeIn('fast');
                    $("#ex_day").focus();
              return false;
            }

          $("#msg_time").fadeOut('fast');
          if( $.trim(time) == '')
            {      
              $("#msg_time").text("Please Enter Time");
                  $("#msg_time").fadeIn('fast');
                    $("#ex_time").focus();
              return false;
            }

          $("#msg_date").fadeOut('fast');
          if( $.trim(between) == '')
            {      
              $("#msg_date").text("Please Enter Between date");
                  $("#msg_date").fadeIn('fast');
                    $("#ex_date").focus();
              return false;
            }

          $("#msg_eventdate").fadeOut('fast');
          if( $.trim(eventdate) == '')
            {      
              $("#msg_eventdate").text("Please Enter Between Event date");
                  $("#msg_eventdate").fadeIn('fast');
                    $("#ex_eventdate").focus();
              return false;
            }

          /*$("#msg_subject").fadeOut('fast');
          if( $.trim(subject) == '')
            {      
              $("#msg_subject").text("Please Enter Subject");
                  $("#msg_subject").fadeIn('fast');
                    $("#ex_subject").focus();
              return false;
            }*/
          /*$("#msg_sms").fadeOut('fast');
          if( $.trim(sms) == '')
            {      
              $("#msg_sms").text("Please Enter SMS");
                  $("#msg_sms").fadeIn('fast');
                    $("#ex_sms").focus();
              return false;
            }*/

          /*$("#msg_mail").fadeOut('fast');
          if( $.trim(mail) == '')
            {      
              $("#msg_mail").text("Please Enter Mail");
                  $("#msg_mail").fadeIn('fast');
                    $("#ex_mail").focus();
              return false;
            }*/
         /*$("#msg_file").fadeOut('fast');
          if( $.trim(file) == '')
            {      
              $("#msg_file").text("Please Select logo");
                  $("#msg_file").fadeIn('fast');
                    $("#ex_file").focus();
              return false;
            }*/

            /*$("#err_he_img").fadeOut('fast');
          if( $.trim(he_image) == '')
            {      
              $("#err_he_img").text("Please Select Header Image");
                  $("#err_he_img").fadeIn('fast');
                    $("#he_image").focus();
              return false;
            }*/
      
        }
//Validate Add Event Input boxes
      function validateAddform(){

        var file = $("#file").val(); 
        var name = $("#name").val(); 
        var nickname = $("#nickname").val(); 
        var address = $("#address").val(); 
        var location = $("#location").val(); 
        var l_date = $("#livedt").val();
        var s_date = $("#picker3").val();      
        var e_date = $("#enddate").val(); 
        var day = $("#day").val(); 
        var time = $("#time").val(); 
        var between = $("#between").val();
        var eventdate = $("#eventdate").val(); 
        var subject = $("#subject").val(); 
        var sms = $("#sms").val(); 
        var mail = $("#mail").val(); 
        var header_img = $("#header_img").val();

          $("#err_name").fadeOut('fast');
          if( $.trim(name) == '')
            {      
              $("#err_name").text("Please Enter Name");
                  $("#err_name").fadeIn('fast');
                    $("#name").focus();
              return false;
            }

          $("#err_nickname").fadeOut('fast');
          if( $.trim(nickname) == '')
            {      
              $("#err_nickname").text("Please Enter NickName");
                  $("#err_nickname").fadeIn('fast');
                    $("#nickname").focus();
              return false;
            }

          /*$("#err_address").fadeOut('fast');
          if( $.trim(address) == '')
            {      
              $("#err_address").text("Please Enter Address");
                  $("#err_address").fadeIn('fast');
                    $("#address").focus();
              return false;
            }*/

          /*$("#err_location").fadeOut('fast');
          if( $.trim(location) == '')
            {      
              $("#err_location").text("Please Enter Location");
                  $("#err_location").fadeIn('fast');
                    $("#location").focus();
              return false;
            }*/
          
          $("#err_live").fadeOut('fast');
          if( $.trim(l_date) == '')
            {      
              $("#err_live").text("Please Select Live Date Time");
                  $("#err_live").fadeIn('fast');
                    $("#livedt").focus();
              return false;
            }
          
          $("#err_start").fadeOut('fast');
          if( $.trim(s_date) == '')
            {      
              $("#err_start").text("Please Select Start Date");
                  $("#err_start").fadeIn('fast');
                    $("#picker3").focus();
              return false;
            }

          $("#err_end").fadeOut('fast');
          if( $.trim(e_date) == '')
            {      
              $("#err_end").text("Please Select End Date");
                  $("#err_end").fadeIn('fast');
                    $("#enddate").focus();
              return false;
            }
          $("#err_day").fadeOut('fast');
          if( $.trim(day) == '')
            {      
              $("#err_day").text("Please Select Day");
                  $("#err_day").fadeIn('fast');
                    $("#day").focus();
              return false;
            }

          $("#err_time").fadeOut('fast');
          if( $.trim(time) == '')
            {      
              $("#err_time").text("Please Enter Time");
                  $("#err_time").fadeIn('fast');
                    $("#time").focus();
              return false;
            }

          $("#err_between").fadeOut('fast');
          if( $.trim(between) == '')
            {      
              $("#err_between").text("Please Enter Between date");
                  $("#err_between").fadeIn('fast');
                    $("#between").focus();
              return false;
            }

          $("#err_eventdate").fadeOut('fast');
          if( $.trim(eventdate) == '')
            {      
              $("#err_eventdate").text("Please Enter Between Event date");
                  $("#err_eventdate").fadeIn('fast');
                    $("#eventdate").focus();
              return false;
            }

          /*$("#err_subject").fadeOut('fast');
          if( $.trim(subject) == '')
            {      
              $("#err_subject").text("Please Enter Subject");
                  $("#err_subject").fadeIn('fast');
                    $("#subject").focus();
              return false;
            }*/
         /* $("#err_sms").fadeOut('fast');
          if( $.trim(sms) == '')
            {      
              $("#err_sms").text("Please Enter SMS");
                  $("#err_sms").fadeIn('fast');
                    $("#sms").focus();
              return false;
            }*/

          /*$("#err_mail").fadeOut('fast');
          if( $.trim(mail) == '')
            {      
              $("#err_mail").text("Please Enter Mail");
                  $("#err_mail").fadeIn('fast');
                    $("#mail").focus();
              return false;
            }*/

          /*$("#err_f").fadeOut('fast');
          if( $.trim(file) == '')
            {      
              $("#err_f").text("Please Select logo");
                  $("#err_f").fadeIn('fast');
                    $("#file").focus();
              return false;
            }

            $("#err_header").fadeOut('fast');
          if( $.trim(header_img) == '')
            {      
              $("#err_header").text("Please Select Header Image");
                  $("#err_header").fadeIn('fast');
                    $("#header_img").focus();
              return false;
            }*/

      }
      
function selectTemp(tm_id,aem_id){       
    if(aem_id){
        $.ajax({
           headers: {
                    'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                },
           type:"POST",
           url:"requesttosettemplate",
           data: "tm_id="+tm_id+"&aem_id="+aem_id,
           success:function(res){               
                Swal.fire({
                          type: 'success',
                          title: 'Success!',
                          text: 'Saved Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                         })
                setTimeout(function(){ window.location.reload(); }, 2000);
                return false;
           }
        });
    }   
}

      
</script> 
<script type="text/javascript">
   $("#name").keyup(function () {
   var str = $(this).val();
   var slug=str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\|\/,.<>?\s]/g, ' ').toLowerCase();
   var slug=str.replace(/^\s+|\s+$/gm,'');
   var slug=str.replace(/\s+/g, '');
   var trimmed=$.trim(str)
   var check =slug.toLowerCase();
   $("#nickname").val(slug.toLowerCase());
   });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/datatables/eventMaster.blade.php ENDPATH**/ ?>