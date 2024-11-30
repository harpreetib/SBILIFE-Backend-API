
<?php $__env->startSection('page-css'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<!--<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">-->
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/js/choices/choices.min.css')); ?>">
<style>
.divide{
    border-top: 1px solid #dee2e6;
}
.modal-header .close {
    font-weight: 200;
    font-size: 40px;
    padding: 5px 15px 0 0;
    outline: none;
}
.yelloworder {
    background-color: #ffd300;
}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

  <div class="breadcrumb">
        <h1>Manage Registrations</h1>
        <ul>
          <li><a href="all-leads">View List</a></li>
          <li><?php echo e((isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '')); ?></li>
        </ul>
  </div>
    <div id="spinner" style="display:none;z-index: 99999;position: fixed;width: 100%;height: 100%;">
            <div class="loader spinner-bubble spinner-bubble-primary" style="margin-top: 20%;margin-left: 44%;"></div>
    </div>
    <div class="separator-breadcrumb border-top"></div>

          
            </div>
           
            <div class="row">                                                             
                             <div class="col-md-6 form-group mb-3">     
                                 <a href="all-leads?datefrom=<?php if(isset($datefrom)) echo $datefrom; ?>&dateto=<?php if(isset($dateto)) echo $dateto; ?>&action=download">
                                    <button type="button" class="btn btn-outline-success btn-excel" >Download Excel</button>
                                </a>
                            </div>
                         </div>


            <div class="row mb-4">
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
                                                            <select class="custom-select" name="pagination" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" <?php if($leadList->perPage() == 10): ?> selected <?php endif; ?>>
                                                                            10
                                                                        </option>
                                                                    <option value="25" <?php if($leadList->perPage() == 25): ?> selected <?php endif; ?>>
                                                                        25
                                                                    </option>
                                                                    <option value="50" <?php if($leadList->perPage() == 50): ?> selected <?php endif; ?> >
                                                                        50
                                                                    </option>
                                                                    <option value="75" <?php if($leadList->perPage() == 75): ?> selected <?php endif; ?> >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            <?php if($leadList->perPage() == 100): ?> selected <?php endif; ?> >100
                                                                    </option>
                                                                    <option value="200"
                                                                            <?php if($leadList->perPage() == 200): ?> selected <?php endif; ?> >200
                                                                    </option>
                                                                    <option value="500"
                                                                            <?php if($leadList->perPage() == 500): ?> selected <?php endif; ?> >500
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
                                                        <th scope="col">#</th>
                                                        
                                                        <th scope="col">Register Date
                                                            <div class="divide"> Register Time </div>
                                                        </th>
                                                        <!--<th scope="col">User Type</th>-->
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">IP Address</th>
                                                        <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $i=1
                                                        ?>
                                                        <?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>
                                                        <th scope="row"><?php echo e($i++); ?></th>
                                                        
                                                        <td scope="row"><?php echo e(date('d-M,Y',strtotime($list->lemm_insert_date))); ?>

                                                            <div class="divide"> <?php echo e(date('h:i A',strtotime($list->lemm_insert_date))); ?></div>
                                                        </td>
                                                        <td> <?php echo e(ucfirst($list->lm_fullname)); ?></td>
                                                        <td><?php echo e($list->lm_email); ?></td>
                                                        <td> <?php echo e(empty($list->lm_mobile) ? '-' : $list->lm_mobile); ?></td>
                                                        <td><?php echo e(empty($list->lm_ip) ? '-' : $list->lm_ip); ?></td>
                                                        <td>
                                                            <?php if(isset($featureList['treasure-hunt']) && $featureList['treasure-hunt']=='active'): ?>
                                                                <?php if($list->is_treasure_hunt=='inactive'): ?>
                                                                <button class="btn btn-outline-success" onclick="ResetTreasureHunt('<?php echo e($list->lemm_id); ?>')">Reset Treasure Hunt</button>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            
                                                            <?php if(isset($featureList['daily-co-live-streaming']) && $featureList['daily-co-live-streaming']=='active'): ?>
                                                                <?php if(in_array($list->lm_user_type,array('speaker','moderator'))): ?>
                                                                <button class="btn btn-outline-danger" onclick="GenerateMeetingToken('<?php echo e($list->lemm_id); ?>')">Generate Meeting Token</button>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            
                                                            <?php if(isset($featureList['is-user-verify']) && $featureList['is-user-verify']=='active'): ?>
                                                                <!--<?php if($list->is_verified=='N'): ?>-->
                                                                
                                                                <!--<button class="btn btn-outline-success" onclick="VerifyUser('<?php echo e($list->lemm_id); ?>')">Approve</button>-->
                                                                <!--<?php endif; ?>-->
                                                                
                                                                <?php
                                                                $checked = $list->is_verified=='N' ? "" : "checked";
                                                                $texts = $list->is_verified=='N' ? 'Enable' : 'Disable';
                                                                $apStatus = $list->is_verified=='N' ? 'active' : 'inactive';
                                                                ?>
                                                                
                                                                <label class="switch switch-success mr-3">
                                                                    <input type="checkbox" id="usrapprove_<?php echo e($list->lemm_id); ?>" <?php echo e($checked); ?> onclick="VerifyUnverifyUser('<?php echo e($list->lemm_id); ?>','<?php echo e($apStatus); ?>')">
                                                                    <span class="slider"></span><?php echo e($texts); ?>

                                                                </label>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                          </table>
                                      </div>
                                  </div>
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
                                        Displaying <?php echo e($leadList->count()); ?> of <?php echo e($leadList->total()); ?> customer(s).
                                        </p>
                                  </div>


                              </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end of col modal-lg-->

                <div aria-hidden="true" aria-labelledby="ChangeLeadStage" role="dialog" tabindex="-1" id="ChangeLeadStage" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="changeLeadStatusform" id="changeLeadStatusform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTile">Lead Status</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgShowleadcSF" style="display:none;"></div>
                                <div class="modal-body" id="modelDiv">




                                </div>

                                <div class="modal-footer justify-content-center" id="footerDiv">

                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="changeLeadStatus();">Submit</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                
                
                
                <!-- enquiry modal -->
                <div aria-hidden="true" aria-labelledby="showEnquiry" role="dialog" tabindex="-1" id="showEnquiry" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="EnquiryStatusform" id="EnquiryStatusform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTiles">Show Enquiry</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgShowleadcSF" style="display:none;"></div>
                                <div class="modal-body" id="modelDivs">




                                </div>

                                <div class="modal-footer justify-content-center" id="footerDivs">
                                
                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" >Submit</button>
                                
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- end enquiry modal -->
                
                
                
                
                <!-- Transfer modal -->
                <div aria-hidden="true" aria-labelledby="TLead" role="dialog" tabindex="-1" id="TLead" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="TLform" id="TLform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTiles">Transfer Lead</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgTL" style="display:none;"></div>
                                <div class="modal-body" id="TLDiv">
                                    
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Lead Name</th>
                                            <th>Lead Mobile No.</th>
                                            <th>University List</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                <td><span id="name"></span></td>
                                                <td><span id="mobile"></span></td>
                                                <td><select class="form-control" name="exhim_id[]" id="exhim_id" multiple="">
                                                    
                                                </select>
                                                </td>
                                                <input type="hidden" id="lemm_id" name="lemm_id" value="">
                                                </tr>
                                            
                                            </tbody>
                                    </table>
                                    

                                </div>

                                <div class="modal-footer justify-content-center" id="footerTL">
                                
                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="Allotlead();" >Submit</button>
                                
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- end Transfer modal -->
                
                
                
                </div>

            </div>
        <!-- end of row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
   <script src="<?php echo e(asset('assets/js/choices/choices.min.js')); ?>"></script>
 <!--<script src="<?php echo e(asset('assets/js/vendor/datatables.min.js')); ?>"></script>-->
 <!--<script src="<?php echo e(asset('assets/js/datatables.script.js')); ?>"></script>-->
 <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>

 
 <script>
    $(document).on({
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
   document.addEventListener('DOMContentLoaded', function() {

    new Choices('#exhim_id', {
      removeItemButton: true,
    });

  });
    
    //finction for state and city
        $('#ex_category').change(function(){
                var cityId = $(this).val();  
                if(cityId){
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                       type:"POST",
                       url:"getcity",
                       data:{'cityId':cityId},
                       success:function(res){               
                        if(res){
                            $("#subcategory").empty();
                            $("#subcategory").append('<option value="">Search by City</option>');
                            $.each(res,function(key,value){
                                $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
                            });
                       
                        }else{
                           $("#subcategory").empty();
                        }
                       }
                    });
                }else{
                    $("#subcategory").empty();
                }      
               });

      function validateForm(){
         
    
          var city = $("#subcategory").val();
          var state = $("#ex_category").val();
            
        //alert('Please');
         $("#city_err").fadeOut('fast');
          if($.trim(state) != '' && $.trim(city) == '')
            {      
              $("#city_err").text("Please Select City");
                  $("#city_err").fadeIn('fast');
                    $("#subcategory").focus();
                     //if is any error found. then do this
              return false;
            }
      
        }


//end state and city

 function addcate(leemId){
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'addcategory',
        data: 'leemId='+leemId,
        success: function (data) {
                $('#modelDiv').html(data);
                $('#modelTile').html('Lead Status');
                $('#footerDiv').show();
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}

function showhistory(leemId){
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'showhistory',
        data: 'leemId='+leemId,
        success: function (data) {
                $('#modelDiv').html(data);
                
                $('#modelTile').html('Conversation History');
                $('#footerDiv').hide();
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}


function changeLeadStatus(){
    var selectedMsg = $("#clsstage option:selected").text(); 
    var leemId = $("#leemId").val(); 

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'changeleadstatus',
        data: $('#changeLeadStatusform').serialize(),
        success: function (data) {
                var obj=jQuery.parseJSON(data);
                if(obj.code==='200'){
                    $('#status'+leemId).html(selectedMsg);
                }
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}
function leadtypeFormSubmit(leadType){
$('#leadtype').val(leadType);
$('#searchbtn').click();
}
function showEnquiry(leem_mobile,leem_email){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'showEnquiry',
             data: {'leem_mobile':leem_mobile,'leem_email':leem_email},
            success: function (data) {
                $('#modelDivs').html(data);       
                $('#modelTiles').html('Show Enquiry');
                $('#footerDivs').hide();
                $('#showEnquiry').modal('toggle')
                    
                }      
        });
}

function OpenTLModal(lemmId){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'OpenTLModal',
             data: {'lemmId':lemmId},
            success: function (data) {
                $('#TLDiv').html(data);       
               // $('#footerDivs').hide();
                $('#TLead').modal('toggle');
                 new Choices('#exhim_id', {
                      removeItemButton: true,
                    });
                
                console.log(data);
                       
                }      
        });
}

function Allotlead(){
    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'Allotlead',
             data: $('#TLform').serialize(),
            success: function (data) {
                swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Lead Transfered Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                                                });
                                                $('#TLead').modal('toggle');
                    setTimeout(function(){ window.location.reload(); }, 2000);
                    							return false;
                
                    
                }      
        });
}


function GenerateMeetingToken(lemmId)
{
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'generate-meeting-token',
        data: 'lemm_id='+lemmId,
        success: function (data) {
            swal('Success','Meeting Token Generated Successfully','success');
            setTimeout(function(){ window.location.reload(); }, 1000);
            return false;
        }      
    });
}

function ResetTreasureHunt(lemmId)
{
   $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'reset-reasure-hunt',
        data: 'lemm_id='+lemmId,
        success: function (data) {
            swal('Success','Treasure Hunt Updated Successfully','success');
            setTimeout(function(){ window.location.reload(); }, 1000);
            return false;
        }      
    }); 
}

function VerifyUser2(lemmId)
{
   $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'verify-user',
        data: 'lemm_id='+lemmId,
        success: function (data) {
            swal('Success','User Verified Successfully','success');
            setTimeout(function(){ window.location.reload(); }, 1000);
            return false;
        }      
    }); 
}

function VerifyUnverifyUser(lemmId,resStatus)
            {
              //alert(ppm_id);return false;
              var s = $('#plan_content_'+lemmId).clone();
              s.find('.chosen').addClass('swal');

              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                html: s.html(),
                title: 'Are You Sure !',
                preConfirm: function() {
                  return new Promise(function(resolve) {
                    resolve( $('.chosen.swal').val() );
                  });
                }
              }).then(function(result) {
                // reset modal overflow
                $('.swal2-modal').css('overflow', '');
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "verify-user",
                        data: {'status':resStatus,'lemm_id':lemmId},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 });
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                            }
                        });

              }).catch(function(reason){
                        swal({
                              type: 'error',
                              title: 'Cancel!',
                              text: 'Cancelled Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
                             if(resStatus=='active'){
                                  $("#usrapprove_"+lemmId).prop("checked", false);

                             }else{
                                  $("#usrapprove_"+lemmId).prop("checked", true);
                              }
                            

                    });
                    
            }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/sbilife/admin/resources/views/customers/visitor-tables-all.blade.php ENDPATH**/ ?>