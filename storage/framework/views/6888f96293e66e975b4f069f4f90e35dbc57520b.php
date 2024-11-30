<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">

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
                <h1>Manage Events</h1>
                <ul>
                  <li><a href="manageevents">View List</a></li>
                  <li><?php echo e((isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
           
            
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3 d-none">

                    <h4>  <a href="javascript:void(0)" class="float-right" onclick="eventStart()"><button type="button" class="btn btn-info btn-rounded m-1">Launch Event</button></a><h4> 
                    
                    <h4>  <a href="javascript:void(0)" class="float-right" onclick="LiveStreamStart()"><button type="button" class="btn btn-info btn-rounded m-1">Start Live Stream</button></a><h4>
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
                    <th scope="col">Name</th>
                    <th scope="col">Shoot Date/Time</th>
                    <th scope="col">Video URL</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    ?>
                    <?php $__currentLoopData = $eventLaunch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($eDetail->el_name); ?></td>
                        <td><?php echo e($eDetail->elm_start_date); ?></td>
                        <td>
                            <!--<b>YouTube URL:</b> <span style="color: blue;"><?php echo e($eDetail->elm_youtube_url); ?></span>-->
                            
                            <table style="width: 100%;">
                                    <tr>
                                        <td> <b>YouTube URL:</b> <span style="color: blue;"><?php echo e($eDetail->elm_youtube_url); ?></span></td>
                                        <td> 
                                        <?php if(!empty($eDetail->elm_youtube_url)): ?>
                                                <?php
                                                
                                                $video='';
                                                $vstat='';
                                                
                                                if($eDetail->elm_active_url=='youtube'){
                                                $video='checked';
                                                $vstat='disabled';
                                                }
                                                
                                                ?>
                                                
                                                <label class="switch switch-success mr-3"  <?php if($vstat!='disabled') { ?>onclick="ActivateStreamVideo('<?php echo e($eDetail->elm_id); ?>','youtube');" <?php }?>>
                                                <input type="checkbox" <?php echo e($video); ?> <?php echo e($vstat); ?> id="live_video<?php echo e($eDetail->elm_id); ?>">
                                                <span class="slider"></span>
                                                </label>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td> <b>Daily.Co URL:</b> <span style="color: blue;"><?php echo e($eDetail->elm_daily_co_url); ?></span></td>
                                        <td> 
                                         <?php if(!empty($eDetail->elm_daily_co_url)): ?>
                                                <?php
                                                
                                                    $youtube='';
                                                    $ystat='';
                                                    if($eDetail->elm_active_url=='daily-co'){
                                                        $youtube='checked';
                                                         $ystat='disabled';
                                                    }
                                                
                                                ?>
                                                 <label class="switch switch-success mr-3" <?php if($ystat!='disabled') { ?>onclick="ActivateStreamVideo('<?php echo e($eDetail->elm_id); ?>','daily-co');" <?php }?>>
                                                    <input type="checkbox" <?php echo e($youtube); ?> <?php echo e($ystat); ?> id="youtube<?php echo e($eDetail->elm_id); ?>">
                                                    <span class="slider"></span>
                                                </label>
                                          <?php endif; ?>
                                        </td>
                                    </tr>
                                    
                                </table>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="text-success mr-2" onclick="editVideoData('<?php echo e($eDetail->elId); ?>','<?php echo e($eDetail->elm_id); ?>');">
                                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                                            <hr>
                            <?php if(!empty($eDetail->elm_id)): ?>
                            <button type="button" class="btn <?php echo e($eDetail->elm_status=='active' ? 'btn-danger':'btn-success'); ?> " onclick="shoot('<?php echo e($eDetail->elm_id); ?>','<?php echo e($eDetail->elm_status); ?>');"><?php echo e($eDetail->elm_status=='active' ? 'Stop':'Start'); ?></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
             </table>
             
                            </div>
                        </div>
   


                    </div>
                </div>

            </div>
        </div>
</div>

<!-- start Edit User modal -->
        <div class="modal fade" id="EditEventLaunchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

  <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    function restDiv()
    {
        //do nothing
    }
    
    function shoot(elmId,elmStatus)
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'event-launch',
            data: 'elmId='+elmId+'&elmStatus='+elmStatus,
            success: function (data) {
                swal('success','Event run successfully!','success');
                setTimeout(function(){
                    window.location.reload(); 
                }, 2000);
            }      
    
        });
    }
    
    function editVideoData(elId,elmId)
    {
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editEventLaunch',
                data: 'el_id='+elId+'&elm_id='+elmId,
                success: function (data) {           
                    $('#edit').html(data);
                    $('#EditEventLaunchModal').modal('toggle')
                    }      
            });
    }
    
    function AddVideoData(setUrl, forData){
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
                                  text: 'Stream Added Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                             setTimeout(function(){ window.location.reload(); }, 3000);
                             return false;
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                });
        }
        
        function ActivateStreamVideo(elm_id,el_active_url){
            
              var status='active';
              var setText="set";

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
                        url: "activate-stream-video",
                        data: {'elm_id':elm_id,'el_active_url':el_active_url},
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
                   
                       
                         $("#"+mws_active_url+mws_id).prop("checked", false); 
                           
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
                  
            }
 </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/sbilife/admin/resources/views/customers/manage-events/events.blade.php ENDPATH**/ ?>