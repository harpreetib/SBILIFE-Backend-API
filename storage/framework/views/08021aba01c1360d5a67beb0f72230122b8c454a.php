
<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.date.css')); ?>">
 
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
  <div class="breadcrumb">
                <h1>Template</h1>
                <ul>
                    <li><a href="">Template</a></li>
                    <li>Template List</li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="prospects">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                            
                             <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder="DateFrom" name="datefrom" value="<?php echo e(empty($datefrom) ? ''  : $datefrom); ?>">
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder=" Date To" name="dateto" value="<?php echo e(empty($dateto) ? ''  : $dateto); ?>">
                            </div>
                           
                             <input type="hidden" name="leadtype" id="leadtype" value="<?php echo e(empty($leadtype) ? ''  : $leadtype); ?>">
                             <div class="col-md-2 form-group mb-3">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                                
                            </div>


                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
           
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Templates</button>

                 </div>
            </div>
             <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            
                          <form method="post" action="<?php echo e($_SERVER['REQUEST_URI']); ?>" id="pageInput">
                                            <div class="row pagination-bar">
                                                <div class="col-12 col-md-7">
                                                    <div class="form-group mt-3">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="d-flex flex-row">
                                                            <div class="mr-2">
                                                            <select class="custom-select" name="perPage" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" <?php if($Alldata->perPage() == 10): ?> selected <?php endif; ?>>
                                                                            10
                                                                        </option>
                                                                    <option value="25" <?php if($Alldata->perPage() == 25): ?> selected <?php endif; ?>>
                                                                        25
                                                                    </option>
                                                                    <option value="50" <?php if($Alldata->perPage() == 50): ?> selected <?php endif; ?> >
                                                                        50
                                                                    </option>
                                                                    <option value="75" <?php if($Alldata->perPage() == 75): ?> selected <?php endif; ?> >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            <?php if($Alldata->perPage() == 100): ?> selected <?php endif; ?> >100
                                                                    </option>
                                                                    <option value="200"
                                                                            <?php if($Alldata->perPage() == 200): ?> selected <?php endif; ?> >200
                                                                    </option>
                                                                    <option value="500"
                                                                            <?php if($Alldata->perPage() == 500): ?> selected <?php endif; ?> >500
                                                                    </option>
                                                                </select>
                                                            </div>
                                                          <!-- code goes here -->

                                                        </div>

                                                    </div>
                                                </div>
                                            <div class="col-md-3">
                                            &nbsp;
                                            </div>
                                                <div class="col-md-2 mt-3">
                                              <div class="form-group ">
                                                  <i class="seacrh-icon"></i>
                                                  <input type="text" class="form-control seacrh-field pl-4" name="search_text" placeholder="Search"  autocomplete="off" value="<?php if(isset($_REQUEST['search_text']) && !empty($_REQUEST['search_text'])){ echo$_REQUEST['search_text']; } ?>" onchange="this.form.submit();">

                                              </div>
                                          </div> 

                                            </div>
                                        </form>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                   <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Preview Video</th>
                                            <th scope="col">Locations</th>
                                            <th scope="col">Menu Items</th>
                                            <th scope="col">Assets</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $Alldata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td style="width:20%"><?php echo e($list->etm_name); ?></td>
                                            <td style="width:30%"><img src="<?php echo e(asset($list->etm_image)); ?>" style="width:50%"></td>
                                            <td style="width:10%">
                                                <a href="javascript:void(0);" class="text text-primary" data-id="<?php echo e($list->etm_id); ?>" onclick="previewFile('<?php echo e($list->etm_id); ?>');">View</a>
                                            </td>
                                            <td style="width:15%"><a href="./templates/locations/<?php echo e($list->etm_id); ?>" class="text text-primary" data-id="<?php echo e($list->etm_id); ?>">Manage Locations</a>
                                            </td>
                                            <td style="width:15%"><a href="./templates/menus/<?php echo e($list->etm_id); ?>" class="text text-primary" data-id="<?php echo e($list->etm_id); ?>">Manage Menu Items</a></td>
                                            <td style="width:15%"><a href="./templates/assets/<?php echo e($list->etm_id); ?>" class="text text-primary" data-id="<?php echo e($list->etm_id); ?>">Manage Assets</a></td>
                                            <td>
                                                <a href="javascript:void(0);" class="text text-primary mr-2 edit1" data-id="<?php echo e($list->etm_id); ?>" onclick="addeditprospect('<?php echo e($list->etm_id); ?>');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11" style="text-align:center">No templates to display.</td>
                                        </tr> 
                                    <?php endif; ?>
                                         </tbody>
                                    

                                </table>
                            </div>
                              
                        </div>
                    </div>
                </div>
                <!-- end of col -->




            </div>
            <!-- end of row -->

<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">New Template</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addprospectsForm" id="addprospectsForm">
                                <?php echo csrf_field(); ?>

                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" value="">
                                       <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                                       <span class="text-danger p-1"><?php echo e($errors->first('full_name')); ?></span>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Image File:</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                       <span class="text-danger" id="msg_location" name="msg_location"  style="display:none;"></span>
                                       <span class="text-danger p-1"><?php echo e($errors->first('location')); ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Preview Video File:</label>
                                        <input type="file" class="form-control" name="video" id="video">
                                       <span class="text-danger" id="msg_location" name="msg_location"  style="display:none;"></span>
                                       <span class="text-danger p-1"><?php echo e($errors->first('location')); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="location" id="location" value="1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="save">Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--edit model-->
            <div class="modal fade" id="verifyModalContent1" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="editprospectsForm" id="editprospectsForm" method="post">
                              <?php echo csrf_field(); ?>  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="ed_full_name" id="ed_full_name" value="">
                                       <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                    
                                    </div>
                               
                                
                                
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="cd_id" id="cd_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary update">Update </button>
                        </div>
                        </form>
                       
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="previewVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="close mb-2 text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <iframe width="100%" id="preview_id" height="350" src="" frameborder="0" allowfullscreen></iframe> 
                    </div>
                  </div>
                </div>
            </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
 $("#save").click(function(e){
                 var name=$("#full_name").val();
                 var email=$("#email").val();
                 $("#msg_name").fadeOut('fast');
                  if( $.trim(name) == '')
                    {      
                      $("#msg_name").text("Please Enter Name");
                          $("#msg_name").fadeIn('fast');
                            $("#full_name").focus();
                      return false;
                    }
                $("#msg_email").fadeOut('fast');
                  if( $.trim(email) == '')
                    {      
                      $("#msg_email").text("Please Enter Email");
                          $("#msg_email").fadeIn('fast');
                            $("#email").focus();
                      return false;
                    }
                  var data = $('#addprospectsForm').serialize();
                 e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'addprospects',
                    data:data,
                    processData:false,
                    success: function(response){
                        //  console.log(response.errors);
                        //  console.log(response.responseJSON.errors.full_name)
                    //   if (response==true) {
                    swal({
                          type: 'success',
                          title: 'Success!',
                          text: ' Prospect Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                //   }
                      setTimeout(function(){ window.location.reload(); }, 1000);
                      return false;
                       
                    },
                    error: function(response) {
                          $('#msg_name').html(response.responseJSON.errors.full_name);
                           $('#msg_email').text(response.responseJSON.errors.email);
                       }
                });
            });
});

$(".ledStage").change(function(){
//   alert(this.value); 
                  var id = $(this).attr("data-id");
                //   alert(id);
                 $.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    type: 'POST',
                    url: 'changeleadstage',
                    data:{'id':id,'leadType':this.value},
                      success: function(res){
                        if (res==true) {
                            swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: ' Change Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                        }
                            setTimeout(function(){ window.location.reload(); }, 1000);
                            return false;
                     
                      },
                      error: function(res) {
                          $('#ed_msg_name').html(res.responseJSON.errors.ed_full_name);
                           $('#ed_msg_email').text(res.responseJSON.errors.ed_email);
                       }
                 });
            });
            
             $("select#country").change(function(){ 
                var selectedCountryCode = $(this).children("option:selected").attr("data-id");
                $('#country_code option[value='+selectedCountryCode+']').attr('selected', true);
             });
              $("select#ed_country").change(function(){ 
                var selectedCountryCode = $(this).children("option:selected").attr("data-id");
                $('#ed_country_code option[value='+selectedCountryCode+']').attr('selected', true);
             });
         
         function addeditprospect(exhim_id){
 		 //  alert(exhim_id);return false;
            //  $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editprospects',
               	data: 'id='+exhim_id,
                success: function (data) {   
                   // console.log(data);
                    // $('#edit').html(data); 
                    $("#cd_id").attr("value",data.id);
                    $("#ed_full_name").attr("value",data.cd_full_name);
                    $("#ed_mobile").attr("value",data.cd_mobile);
                    $("#ed_email").attr("value",data.cd_email);
                    $("#ed_company_website").attr("value",data.cd_company_website);
                     $("#ed_company_name").attr("value",data.cd_company_name);
                    //$("#ed_event_name").attr("value",data.cd_event_name);
                    //$("#picker3").attr("value",data.cd_event_date);
                    //$("#ed_event_type").attr("value",data.cd_event_type);
                    
                    $('#verifyModalContent1').modal('toggle')
                   
                    }      
            });
        }
       
       function Settings(cd_id){
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'settings',
               	data: 'id='+cd_id
                // success: function (data) {   
                //     console.log(data);
                //     // $("#to").attr("value",data.cd_email);
                //     //  $("#cc").attr("value",data.cc);
                //     //  $("#subject").attr("value",data.subject);
                //     //  CKEDITOR.instances['content'].setData(data.content);
                //     //   CKEDITOR.instances['content'].updateElement();
                //     // $('#MailModal').modal('toggle')
                   
                //     }      
            });
        }
       function mailcontent(cd_id){
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'mailcontent',
               	data: 'id='+cd_id,
                success: function (data) {   
                    console.log(data);
                    $("#to").attr("value",data.cd_email);
                     $("#cc").attr("value",data.cc);
                     $("#subject").attr("value",data.subject);
                     CKEDITOR.instances['content'].setData(data.content);
                      CKEDITOR.instances['content'].updateElement();
                    // $('#MailModal').modal('toggle')
                   
                    }      
            });
        }
     function SendMail(){
         
             $.ajax({
                       
                          method:"POST",
                          url: "SendCredentials",
                          data: $('#MailForm').serialize(),
                          success: function (data) {
                             console.log(data);
                              $('#MailModal').modal('toggle')  
                              
                                 swal({
                                                  type: 'success',
                                                  title: 'Success!',
                                                  text: 'Mail Sent Successfully',
                                                  buttonsStyling: false,
                                                  confirmButtonClass: 'btn btn-lg btn-success'
                                                });
                                                setTimeout(function(){ window.location.reload(); }, 1000);
                                                            return false;
                                  
                              }
                          });
                    
        } 
</script>
<script>
    $(document).ready(function(){
    
     $(".update").click(function(e){
     
                 var name=$("#ed_full_name").val();
                 
                 var email=$("#ed_email").val();
                 $("#ed_msg_name").fadeOut('fast');
                  if( $.trim(name) == '')
                    {      
                      $("#ed_msg_name").text("Please Enter Name");
                          $("#ed_msg_name").fadeIn('fast');
                            $("#ed_full_name").focus();
                      return false;
                    }
                $("#ed_msg_email").fadeOut('fast');
                  if( $.trim(email) == '')
                    {      
                      $("#ed_msg_email").text("Please Enter Email");
                          $("#ed_msg_email").fadeIn('fast');
                            $("#ed_email").focus();
                      return false;
                    }
                  var data = $('#editprospectsForm').serialize();
                   e.preventDefault();
                
                $.ajax({
                    
                    type: 'POST',
                    url: 'updateprospects',
                    data:data,
                    processData:false,
                    success: function(response){
                        // console.log(response.errors);
                    //   if (response==true) {
                    swal({
                          type: 'success',
                          title: 'Success!',
                          text: ' Prospect Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  //}
                      setTimeout(function(){ window.location.reload(); }, 1000);
                      return false;
                       
                    }
                });
       
         
     });
        
    });
</script>
<script>
    function statusProspect(cd_id)
            {
            //   alert(cd_id);return false;
             
              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
              
                title: 'Are You Sure Want To Remove !',
                
              }).then(function(result) {
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "prospectStatus",
                        data: {'cd_id':cd_id},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Remove Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                 setTimeout(function(){ window.location.reload(); }, 1000);
				            return false;
                               
                            }
                        });

              }).catch(function(reason){
                        swal({
                              type: 'error',
                              title: 'Cancel!',
                              text: 'Remove Cancelled Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             }) 
                    });
            
            }
            
   function showPreview(videoUrl)
   {
       $('#preview_id').attr('src',videoUrl);
      $('#previewVideoModal').modal('show'); 
   }
 </script>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

 <script src="<?php echo e(asset('assets/js/vendor/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatables.script.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/sweetalert.script.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/vendor/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/vendor/pickadate/picker.date.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/form.basic.script.js')); ?>"></script>

 <script src="<?php echo e(asset('assets/js/vendor/quill.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/quill.script.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction_testing/admin/resources/views/superadmin/manage-templates/templates.blade.php ENDPATH**/ ?>