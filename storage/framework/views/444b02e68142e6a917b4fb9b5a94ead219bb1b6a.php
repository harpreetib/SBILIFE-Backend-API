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
                <h1>Manage Template Locations</h1>
                <ul>
                  <li><a href="../">View Templates</a></li>
                  <li><a href="./<?php echo e($etm_id); ?>">View List</a></li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="" onsubmit="return validateForm()">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                        
                        

                            <div class="col-md-3 form-group mb-3">
                                <select class="form-control" id="cat_id" name="cat_id">
                                  <option value=""> Select Location</option>
                                    
                                   </select>
                           </div>
                           
                           
                             
                             <div class="col-md-2 form-group mb-3">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                                <!--  <button type="button" id="reset-btn" class="btn btn-success">Remove Filter</button> -->
                            </div>


                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
            <div class="row d-none">
                <!-- ICON BG -->
                
                
               
                 

            </div>
            
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3 d-none">

                    <h4>  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Banner</button></a><h4> 
            </div>

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
                    <th scope="col">Location</th>
                    <th scope="col">File Type</th>
                    <th scope="col">Position</th>
                    <th scope="col">Rotation</th>   
                    <th scope="col">Scale</th>  
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
                        <td>Loc-<?php echo e($list->location_id); ?></td>
                        </td>
                        <td>
                            <select class="from-control" id="type_<?php echo e($i); ?>">
                                 <option value="image" <?php if($list->type=='image'): ?> selected <?php endif; ?>>Image</option>
                                 <option value="video" <?php if($list->type=='video'): ?> selected <?php endif; ?>>Video</option>
                            </select>
                        </td>
                        <!--<td></td>-->
                        <td>
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <td><b>X</b><input type="text" id="position_x_<?php echo e($i); ?>" value="<?php echo e($list->em_position_x); ?>" class="form-control"></td>
                                    <td><b>Y</b><input type="text" id="position_y_<?php echo e($i); ?>" value="<?php echo e($list->em_position_y); ?>" class="form-control"></td>
                                    <td><b>Z</b><input type="text" id="position_z_<?php echo e($i); ?>" value="<?php echo e($list->em_position_z); ?>" class="form-control"></td>
                                </tr>
                            </table>
                        </td>
                        
                        <td>
                            <table id="example3" class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <td><b>X</b><input type="text" id="rotation_x_<?php echo e($i); ?>" value="<?php echo e($list->em_rotation_x); ?>" class="form-control"></td>
                                    <td><b>Y</b><input type="text" id="rotation_y_<?php echo e($i); ?>" value="<?php echo e($list->em_rotation_y); ?>" class="form-control"></td>
                                    <td><b>Z</b><input type="text" id="rotation_z_<?php echo e($i); ?>" value="<?php echo e($list->em_rotation_z); ?>" class="form-control"></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <td><b>X</b><input type="text" id="scale_x_<?php echo e($i); ?>" value="<?php echo e($list->em_scale_x); ?>" class="form-control"></td>
                                    <td><b>Y</b><input type="text" id="scale_y_<?php echo e($i); ?>" value="<?php echo e($list->em_scale_y); ?>" class="form-control"></td>
                                    <td><b>Z</b><input type="text" id="scale_z_<?php echo e($i); ?>" value="<?php echo e($list->em_scale_z); ?>" class="form-control"></td>
                                </tr>
                            </table>
                        </td>
                        
                       
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success mr-2" onclick="AddEditLocationDetails('<?php echo e($list->id); ?>','<?php echo e($list->etm_id); ?>','<?php echo e($i); ?>');">
                            Update</a>
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

     <div class="col-md-12">

                                    <!--<div class="col-md-6  text-right"><?php echo e($leadList->onEachSide(2)->appends(request()->except('page'))->links()); ?></div>-->
                                     <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo e($leadList->previousPageUrl()); ?>" tabindex="-1">Previous</a>
                                            </li>
                                             <?php for($i=1;$i<=$leadList->lastPage();$i++): ?>
                                            <li class="page-item <?php echo e($leadList->currentPage() ==  $i ? 'active' : ''); ?>">
                                                <a class="page-link" href="<?php echo e($leadList->url($i)); ?>"><?php echo e($i); ?> <span class="sr-only">(current)</span></a>
                                            </li>
                                             <?php endfor; ?>
                                            
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo e($leadList->nextPageUrl()); ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                        <p>
                                        Displaying <?php echo e($leadList->count()); ?> of <?php echo e($leadList->total()); ?> banner(s).
                                        </p>
                                  </div>
   </div>


</div>
</div>

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
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    function AddEditLocationDetails(Id,etmId,index){
        
        if(Id!='') {
            
            var position_x = $('#position_x_'+index).val();
            var position_y = $('#position_y_'+index).val();
            var position_z = $('#position_z_'+index).val();
            
            var rotation_x = $('#rotation_x_'+index).val();
            var rotation_y = $('#rotation_y_'+index).val();
            var rotation_z = $('#rotation_z_'+index).val();
            
            var scale_x = $('#scale_x_'+index).val();
            var scale_y = $('#scale_y_'+index).val();
            var scale_z = $('#scale_z_'+index).val();
            
            var type = $('#type_'+index).val();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '<?php echo e($action_url); ?>',
                data: 'etllId='+Id+'&etmId='+etmId+
                        '&position_x='+position_x+'&position_y='+position_y+'&position_z='+position_z+
                        '&rotation_x='+rotation_x+'&rotation_y='+rotation_y+'&rotation_z='+rotation_z+
                        '&scale_x='+scale_x+'&scale_y='+scale_y+'&scale_z='+scale_z+'&type='+type,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        swal('Success','Template Location Updated Successfully !','success');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                    else{
                        swal('Failed','Something goes wrong, please try again!','error');
                    }
                }      
        
            });
        }
    }
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/superadmin/manage-templates/manage-locations/location_list.blade.php ENDPATH**/ ?>