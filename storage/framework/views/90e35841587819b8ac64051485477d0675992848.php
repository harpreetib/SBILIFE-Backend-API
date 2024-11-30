<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">
<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
        padding-bottom: 5px;
    }
  
    .modal-lg {
        max-width: 90% !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
            <div class="breadcrumb">
                <h1>Manage Intermediate Page</h1>
                <ul>
                  <li>Details</li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3">

                    <h4>  <a href="javascript:void(0);"  onclick="editAccessPermission('');" class="float-right"  ><button type="button" class="btn btn-info btn-rounded m-1">Add Intermediate Page</button></a><h4>
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
                                                        <th scope="col" width="5%">#</th>
                                                        
                                                        <th scope="col" width="20%">Page Name
                                                            <div class="divide"> Page Caption </div></th>
                                                        
                                                        <th scope="col" width="70%">Page URL 
                                                            <div class="divide"> Page Background Image </div>
                                                            <div class="divide"> Page Presentation Video </div> </th>
    
                                                      
                                                        
                                                        <th scope="col" width="5%">Status
                                                            <div class="divide"> Set As Default </div>
                                                            <div class="divide"> Edit </div></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                    <?php
                                                    $i=1
                                                    ?>
                                                    <?php if(isset($hallCategory) && !empty($hallCategory)): ?>
                                                        <?php $__currentLoopData = $hallCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        <?php
                                                            $profileDetail=Session('AprofileDetail');
                                    
                                                        ?>
                                                    <tr>
                                                        
                                                        <th scope="row"><?php echo e($i++); ?></th>
                                                        
                                                        
                                                                <td><span style="color: red;"><?php echo e($list->mip_name); ?></span>
                                                                    <div class="divide"> <?php echo e($list->mip_caption); ?></div></td>
                                                                
                                                                <td>
                                                                    
                                                                   <b>WithVideo: </b>: <a href="<?php echo e(config('app.front-appurl')); ?>/vf/<?php echo e($profileDetail->bm_nickname); ?>/v1/ledpresentation/<?php echo e(base64_encode($list->mip_id)); ?>" target="_blank">ledpresentation/<?php echo e(base64_encode($list->mip_id)); ?></a>
                                                                   <br>
                                                                    <b>Direct: </b>: <a href="<?php echo e(config('app.front-appurl')); ?>/vf/<?php echo e($profileDetail->bm_nickname); ?>/v1/lobby/<?php echo e(base64_encode($list->mip_id)); ?>" target="_blank">lobby/<?php echo e(base64_encode($list->mip_id)); ?></a>
                                                                   
                                                                   
                                                                  
                                                                   <div class="divide"> 
                                                                       <?php if(!empty($list->mip_bgimage)): ?>
                                                                        <a href="javascript:void(0);" onclick="showImage('<?php echo e($list->mip_bgimage); ?>');"><img height="100px" src="<?php echo e(URL::to('/')); ?>/public/assets/images/<?php echo e(Session('A_Session')->bm_id); ?>/exhibitionhall/<?php echo e($list->mip_bgimage); ?>" ></a>
                                                                       <?php endif; ?>
                                                                   </div>
                                                                   
                                                                   <div class="divide"> 
                                                                       <?php if(!empty($list->mip_presentation_video)): ?>
                                                                        <a href="<?php echo e($list->mip_presentation_video); ?>" target="_new">View Presentation Video</a>
                                                                       <?php endif; ?>
                                                                    </div>
                                                                   
                                                                </td>
                                                                
                                                                     
                                                               
                                                                <td>
                                                                        <?php if($list->mip_status=='active'): ?>
                                                                            <label class="switch switch-success mr-3" onclick="changePerStatus('<?php echo e($list->mip_id); ?>','<?php echo e($list->mip_status); ?>');">
                                                                                <input type="checkbox" checked="" id="pssh1<?php echo e($list->mip_id); ?>">
                                                                                <span class="slider"></span>
                                                                            </label>
                                                                        <?php else: ?>
                                                                            <label class="switch switch-success mr-3" onclick="changePerStatus('<?php echo e($list->mip_id); ?>','<?php echo e($list->mip_status); ?>');"> 
                                                                                <input type="checkbox" id="pssh_che<?php echo e($list->mip_id); ?>" >
                                                                                <span class="slider"></span>
                                                                            </label>
                                                                        <?php endif; ?>
                                                                        &nbsp;
                                                                        <div class="divide">
                                                                            <?php if($list->isDefault=='Y'): ?>
                                                                                <label class="switch switch-success mr-3" onclick="setDefaultStatus('<?php echo e($list->mip_id); ?>','N');">
                                                                                    <input type="checkbox" checked="" id="sdsY<?php echo e($list->mip_id); ?>">
                                                                                    <span class="slider"></span>
                                                                                </label>
                                                                            <?php else: ?>
                                                                                <label class="switch switch-success mr-3" onclick="setDefaultStatus('<?php echo e($list->mip_id); ?>','Y');"> 
                                                                                    <input type="checkbox" id="sdsN<?php echo e($list->mip_id); ?>" >
                                                                                    <span class="slider"></span>
                                                                                </label>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        
                                                                        <div class="divide">
                                                                            <a href="javascript:void(0);" class="text-success mr-2" onclick="editAccessPermission('<?php echo e($list->mip_id); ?>');"><i class="nav-icon i-Pen-4 font-weight-bold"></i></a></div>
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
                                        
                                        
                                        
                                </div>
                            </div>
                                        
            </div>
        </div>
    </div>
    <!-- end of col -->

    <!-- start Edit User modal -->
    <div class="modal fade" id="Editexhibitormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" id="edit">
                
                
                
            </div>
        </div>
    </div>
    <!--End Edit User modal -->


</div>
<!-- end of row -->



<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

 <script src="<?php echo e(asset('assets/js/vendor/datatables.min.js')); ?>"></script>
 <script src="<?php echo e(asset('assets/js/datatables.script.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
 <script type="text/javascript">
   
        function showImage(imgUrl)
        {
                var htmlCreat="";
                    htmlCreat +='<div class="modal-header">';
                    htmlCreat +='   <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Background Image</h4></h5>';
                    htmlCreat +='   <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    htmlCreat +='       <span aria-hidden="true">&times;</span>';
                    htmlCreat +='   </button>';
                    htmlCreat +='</div>';
                    htmlCreat +='<div class="modal-body">';
                    htmlCreat +='  <img  src="<?php echo e(URL::to('/')); ?>/public/assets/images/<?php echo e(Session('A_Session')->bm_id); ?>/exhibitionhall/'+imgUrl+'">';
                    htmlCreat +='</div>';

        		        
		        
            $('#edit').html('');
            $('#edit').html(htmlCreat);
            $('#Editexhibitormodal').modal('toggle');
            
        }
        

        function editAccessPermission(mipId)
        {
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "addeditpopup-intermediate-page",
                data: 'mipId='+mipId,
                success: function (data) {           
                        $('#edit').html(data);
                        $('#Editexhibitormodal').modal('toggle')
                    }      
            });
        }
        
        
         function changePerStatus(mipId,mipStatus)
            {
             
                var setText="unset";
                var status='active';
                if(mipStatus=='active'){
                    setText="set";
                    status='inactive';
                }
              swal({
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        text: 'Are you sure you want to Changed ?',
                        title: 'Are You Sure !',
                
              }).then(function() {
                
                            $.ajax({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    method:"POST",
                                    url: "updatestatus-intermediate-page",
                                    data: {'mipId':mipId},
                                    success: function (data) {
                                          swal({
                                              type: 'success',
                                              title: 'Success!',
                                              text: 'Changed Successfully',
                                              buttonsStyling: false,
                                              confirmButtonClass: 'btn btn-lg btn-success'
                                             })
                                            // setTimeout(function(){ window.location.reload(); }, 1000);
                                            // return false;
                                           
                                        }
                                    });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){ 
                            if(mipStatus=='active'){
                                $("#pssh1"+mipId).prop("checked", true);
                            }else{
                                $("#pssh_che"+mipId).prop("checked", false); 
                            }       
                                              
                            swal("Cancelled", "No data has been changed, Your data is safe :)", "error");
                      }
            });
        }
        
        //==================================================================//
        $(document).ready(function (e) {
                $('#addneexhibitor').on('submit',(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var urlAction = $(this).attr('action');
                    addeditwebinarst(urlAction, formData);
                }));
        });

        function addeditwebinarst(setUrl, forData){
                $.ajax({
                    type:'POST',
                    url: setUrl,
                    data:forData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'intermediate Page Added Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                             setTimeout(function(){ window.location.reload(); }, 3000);
                             return false;
                        //console.log("success");
                        //console.log(data);
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                });
        }
        
        

function setDefaultStatus(mip_id,isDefault){
    if(mip_id){
        swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'You want to Change ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "setDefaultStatusMip",
                        data: {'mip_id':mip_id,'isDefault':isDefault},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){
                      if(isDefault=='Y'){
                          $("#sdsN"+mip_id).prop("checked", false);
                        }else{
                          $("#sdsY"+mip_id).prop("checked", true); 
                        }
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");
                      }
                  });   
    }
}


       
 </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/datatables/manage_intermediate_page.blade.php ENDPATH**/ ?>