<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">


<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
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
.breadcrumb ul li {
    display: inline;
    position: relative;
    padding: 0 0.5rem;
    line-height: 1;
    vertical-align: bottom;
    color: #70657b;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Dashboard Setting</h1>
                <ul>
                  <li><a href="dashboard-settings">View List</a></li>
                  <li><?php echo e((isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '')); ?></li>
                </ul>
                 <div class="ml-auto pr-3">
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="full-screen-icon"><i class="i-Information" ></i></a>
                    <a href="#" data-toggle="tooltip" title="Share Now" class="full-screen-icon"><i class="i-Sharethis" ></i></a>
                    <a href="#" data-toggle="tooltip" title="Fullscreen" class="full-screen-icon"><i class="i-Full-Screen" data-fullscreen=""></i></a>
                </div>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
           
            
            <div class="row mb-4">
              
                <?php if(count($leadList) < 1): ?>
                <div class="col-md-12 mb-3">
                    <h4>  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add File</button></a><h4> 
                </div>
                <?php endif; ?>


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table-responsive">
                              <div class="row ">
                                  <div class="col-md-12">

    <form method="post" action="<?php echo e($_SERVER['REQUEST_URI']); ?>" id="pageInput">
        <div class="row pagination-bar">
            <div class="col-12 col-md-7">
                <div class="form-group mt-3">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex flex-row">
                       <div class="mr-2">
                        <select class="custom-select" name="pagination" id="pagination" onchange="this.form.submit();">
                            <option value="10"  <?php if($leadList->perPage() == 10): ?> selected    <?php endif; ?> > 10 </option>
                            <option value="25"  <?php if($leadList->perPage() == 25): ?> selected    <?php endif; ?> > 25 </option>
                            <option value="50"  <?php if($leadList->perPage() == 50): ?> selected    <?php endif; ?> > 50 </option>
                            <option value="75"  <?php if($leadList->perPage() == 75): ?> selected    <?php endif; ?> > 75 </option>
                            <option value="100" <?php if($leadList->perPage() == 100): ?> selected   <?php endif; ?>  > 100 </option>
                            <option value="200" <?php if($leadList->perPage() == 200): ?> selected   <?php endif; ?> > 200 </option>
                            <option value="500" <?php if($leadList->perPage() == 500): ?> selected   <?php endif; ?> > 500 </option>
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
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">New Feed</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Background Image</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
				 <?php
				    $eventNickName=(isset(Session::get('selectedEvent')->aem_event_nickname) ? Session::get('selectedEvent')->aem_event_nickname : 'v1');
                    $i=1
                    ?>
                    <?php if(isset($leadList) && !empty($leadList)): ?>
                        <?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                    <tr>
                        <th scope="row"><?php echo e($i++); ?></th>
                        <td><?php echo e(ucfirst($list->title)); ?></td>
                        <td><?php echo e(ucfirst($list->news_text)); ?></td>
                        <td>
                            <img src="<?php echo e($list->logo); ?>" style="width:300px;"/>
                        </td>
                        <td>
                            <img src="<?php echo e($list->bgimg); ?>" style="width:300px;"/>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-outline-primary mr-2" onclick="addEditBannerDetails('<?php echo e($list->dsm_id); ?>');">
                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr><th scope="row" >Empty record!</th></tr>
                   <?php endif; ?>
                </tbody>
             </table>
             
  </div>
 
</div>
   <div class="col-md-12">

     <div class="col-md-6  text-right"><?php echo e($leadList->onEachSide(2)->appends(request()->except('page'))->links()); ?></div>
   </div>


</div>
</div>

</div>
</div>
</div>


<div class="modal fade" id="photosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="max-width:60%;">
                    <div class="modal-content">
                        <form name="photouploadform" id="photouploadform" class="" action="addhomepagecontent" method="post"  enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalCenterTitle-2">  <h4 id="up-photo">Add/Edit Dashboard Page Content</h4></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="restDiv();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="row" id="mCaption">
                                        <div class="col-md-6  form-group" >
                                         <label>Title</label>
                                         <input class="form-control " type="text" name="title" id="meta_name" required/>
                                          <span class="text-danger" id="err_name"  style="display:none;"></span>
                                        </div>
                                        
                                        <div class="col-md-6  form-group" >
                                         <label>News Feed</label>
                                         <input class="form-control " type="text" name="news_feed" id="news_feed" required/>
                                          <span class="text-danger" id="err_news_feed"  style="display:none;"></span>
                                        </div>
                                        
                                        <div class="col-md-6 form-group">
                                             <label>Logo <span class="text-danger">(Note: Dimension 367 X 63)</span></label>
                                             <input class="form-control " type="file" name="logo" accept="images/png,images/jpg" min="1" id="logo"/>
                                              <span class="text-danger" id="err_iApply_link"  style="display:none;"></span>
                                        </div>
                                        
                                        <div class="col-md-6 form-group">
                                             <label>Background Image <span class="text-danger">(Note: Dimension 1920 X 1080)</span></label>
                                             <input class="form-control " type="file" name="egapplylink" accept="images/png,images/jpg" min="1" id="bgimg"/>
                                              <span class="text-danger" id="err_iApply_link"  style="display:none;"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <input type="hidden" name="ehc_id" id="bm_id" value="">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



  <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
 <script type="text/javascript">
 
    $(document).on({
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    $('#logo').on('change', function () {
        const fileSize = this.files[0].size / 1024;
        if (fileSize > 100) {
            $('#logo').focus();
            $('#logo').val('');
            swal({
                type: 'error',
                title: 'File Size',
                text: 'File size should be less than 100 KB',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            })
            
            return false;
        }
    });

    $('#bgimg').on('change', function () {
        const fileSize = this.files[0].size / 1024;
        if (fileSize > 800) {
            $('#bgimg').focus();
            $('#bgimg').val('');
            swal({
                type: 'error',
                title: 'File Size',
                text: 'File size should be less than 800 KB',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            })
            
            return false;
        }
    });


    function Addbanner()
    {    	
        $.ajax({
            type: 'POST',
            url: 'dashboard-settings/add',
            data: new FormData(ele),
            //dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                  
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: ' Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                }).then(function(){
                    $('#courseofferedmodal').modal('toggle');
                });
                        setTimeout(function(){
                            window.location.reload(); 
                        }, 2000);
                		return false;
            }
        });
    }

    
    
    
    function addEditBannerDetails(bmId,bcmd){
        
        if(bmId!='') {
            uploadphotoEvnt();
            $('#photosmodal').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'edithomepagecontent',
                data: 'ehc_id='+bmId,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        $('#file_type').val(result.hp_type);
                        $('#bm_id').val(bmId);
                        $('#egcolor').val(result.color_code);
                        $('#title').val(result.meta_name);
                        //
                        $('#upload_photo').attr('required', false);
                        $('#egapplylink').attr('required', false);
                    }
                    else{
                        //console.log(result.code);
                    }
                }      
        
            });
        }
    }
        
    $('#photouploadform').submit(validatePhotoUploadForm);

 </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/sbilife/admin/resources/views/customers/dashboard-setting/index.blade.php ENDPATH**/ ?>