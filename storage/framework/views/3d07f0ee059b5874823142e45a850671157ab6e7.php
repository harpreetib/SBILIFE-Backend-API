
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
                <h1>Manage App Setting</h1>
                <ul>
                    <li><a href="">List</a></li>
                    <li>App Id List</li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="manage-app-setting">
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
            
           
            <?php if(count($Alldata) < 1): ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add App Id</button>

                 </div>
            </div>
            <?php endif; ?>
            
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
                                            <th scope="col">App Id</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $Alldata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td style="width:20%"><?php echo e($list->asm_name); ?></td>
                                            <td style="width:60%"><?php echo e($list->asm_app_id); ?></td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary mr-2 edit1" data-id="<?php echo e($list->asm_id); ?>" onclick="addedittemplate('<?php echo e($list->asm_id); ?>');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
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
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">App Id</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addtemplateForm" action="addApptemplate" method="post" id="addtemplateForm" enctype="multipart/form-data">
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
                                        <label for="recipient-name-2" class="col-form-label">App Id:</label>
                                        <input type="text" class="form-control" name="app_id" id="app_id" value="">
                                       <span class="text-danger" id="msg_app_id" name="msg_app_id"  style="display:none;"></span>
                                       <span class="text-danger p-1"><?php echo e($errors->first('app_id')); ?></span>
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
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Edit App Id</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <form name="editprospectsForm" id="editprospectsForm" method="post"  enctype="multipart/form-data">
                              <?php echo csrf_field(); ?>  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="ed_full_name" id="ed_full_name" value="">
                                       <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">App Id:</label>
                                        <input type="text" class="form-control" name="ed_app_id" id="ed_app_id" value="">
                                       <span class="text-danger" id="ed_msg_app" name="ed_msg_app"  style="display:none;"></span>
                                    </div>
                                  
                               
                            <div>
                            
                                
                                 </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="asm_id" id="asm_id">
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
        var app_name=$("#app_id").val();
        
        $("#msg_name").fadeOut('fast');
        $("#msg_app_id").fadeOut('fast');
        
        if( $.trim(name) == '')
        {      
            $("#msg_name").text("Please Enter Name");
            $("#msg_name").fadeIn('fast');
            $("#full_name").focus();
            return false;
        }
        if( $.trim(app_name) == '')
        {      
            $("#msg_app_id").text("Please Enter App Id");
            $("#msg_app_id").fadeIn('fast');
            $("#app_id").focus();
            return false;
        }
                    
        var data = $('#addtemplateForm').serialize();
        var formData = new FormData();
        formData.append('full_name', name);
        formData.append('app_id', app_name);
        e.preventDefault();
                
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'addApptemplate',
            data:formData,
            processData:false,
            cache: false,
            contentType: false,
            success: function(response){
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'App Id Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
        
                setTimeout(function(){ window.location.reload(); }, 1000);
                return false;
            },
            error: function(response) {
                $('#msg_name').html(response.responseJSON.errors.full_name);
                $('#msg_app_id').html(response.responseJSON.errors.app_id);
            }
        });
    });
});
            
function addedittemplate(appId)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'manage-app-setting/view',
       	data: 'id='+appId,
        success: function (data) {
            $("#asm_id").val(data.asm_id );
            $("#ed_full_name").val(data.asm_name);
            $("#ed_app_id").val(data.asm_app_id);
            $('#verifyModalContent1').modal('toggle')
           
        }      
    });
}

$(document).ready(function(){
    $(".update").click(function(e){
     
        var name=$("#ed_full_name").val();
        var app_name=$("#ed_app_id").val();
        var id=$("#asm_id").val();
        
        $("#ed_msg_name").fadeOut('fast');
        $("#ed_msg_app").fadeOut('fast');
        
        if ($.trim(name) == '') {
            $("#ed_msg_name").text("Please Enter Name").fadeIn('fast');
            $("#ed_full_name").focus();
            return false;
        }
        if ($.trim(app_name) == '') {
            $("#ed_msg_app").text("Please Enter App Id").fadeIn('fast');
            $("#ed_app_id").focus();
            return false;
        }
        
        var data = $('#editprospectsForm').serialize();
        var formData = new FormData();
        formData.append('ed_full_name', name);
        formData.append('ed_app_id', app_name);
        formData.append('asm_id', id);
        
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'manage-app-setting/update',
            data:formData,
            processData:false,
            cache: false,
            contentType: false,
            success: function(response){
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'App Id Updated Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
                setTimeout(function(){ window.location.reload(); }, 1000);
                return false;
            }
        });
    });
});
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/superadmin/manage-app/app-setting.blade.php ENDPATH**/ ?>