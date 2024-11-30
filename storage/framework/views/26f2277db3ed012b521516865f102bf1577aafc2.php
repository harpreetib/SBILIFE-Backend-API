<?php $roomid="";
    if(isset($eewbmdetail->eewbm_video_caller_id)){
        $roomid=$eewbmdetail->eewbm_video_caller_id;
    }
  
?>

<?php $__env->startSection('page-css'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<!--<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">-->

<style>
  /* #p1
  {
    color: #FF0000;
    font-size:12px;
  } */
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

.chat-wrapper{   
    position: fixed;	
            bottom: 0;
            right: 20px;
            min-height: 62px;
            text-align: right;
            min-width: 120px;
            display:none;
            z-index:2;
           }
            
.chat-button{
position: absolute;
    display:none;
top: 11px;
right: 32px;
}

</style>

<script>
(function(t,a,l,k,j,s){
s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.head.appendChild(s)
;k=t.Promise;t.Talk={v:2,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
.push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


  <div class="breadcrumb">
    <h1>My </h1>
    <ul>
        <li><h1><a href=""><?php echo e(empty($leadtype) ? ''  : ucwords($leadtype)); ?> Leads</a></h1></li>
        <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
    </ul>
<ul class="d-none"><a  target="_blank" href="https://www.whatsapp.com/download" class="btn btn-success float-right"><i class="i-Video"></i>&nbsp;Download WhatsApp</a></ul> 
   <?php if(Session('session')[0]->at_id==4 && !empty($eewbmdetail->eewbm_video_url)): ?>
    <!--<ul ><a    href="<?php echo e($eewbmdetail->eewbm_video_url); ?>" target="_blank" class="btn btn-primary float-right"><i class="i-Video"></i>&nbsp;Join Meeting</a></ul> -->
    
    <!--<ul ><a  target="_blank" href="https://virtualadmissionsfair.com/vfair/confo/<?php echo e($eewbmdetail->eewbm_video_caller_id); ?>/moderator/<?php echo e($eewbmdetail->ebsm_name); ?>" class="btn btn-primary float-right"><i class="i-Video"></i>&nbsp;Join Meeting</a></ul>-->
  <!--<ul ><a  target="_blank" href="<?php echo e($eewbmdetail->eewbm_video_caller_id_moderator); ?>?key=<?php echo e(base64_encode($profileDetail->exhim_contact_email.'-'.$profileDetail->exhim_organization_name)); ?>" class="btn btn-primary float-right"><i class="i-Video"></i>&nbsp;Join Meeting</a></ul> -->
    <!-- https://webinar.virtualadmissionsfair.com/join/cGFydGljaXBhbnQtNWVkZjFmNjRmMTBjZmUwN2VmNzBlOTA1?key= -->
    <ul ><a  onclick="createtoken();"   href="#" class="btn btn-primary float-right"><i class="i-Video"></i>&nbsp;Join Meeting</a></ul>
    
    <?php elseif(Session('session')[0]->at_id==4 && $eewbmdetail->eewbm_audio_call == 'active' && $eewbmdetail->pps_id == '7'): ?>
    <ul>
        <a href="https://liveexpo.terraterri.com/?uniqueid=<?php echo e(base64_encode(Session('session')[0]->ebm_login_user)); ?>" target="_blank" class="btn btn-primary float-right"><i class="i-Audio"></i>&nbsp;Join Metaverse</a>
    </ul>
    <?php endif; ?>
    
  </div>
    <div id="spinner" style="display:none;z-index: 99999;position: fixed;width: 100%;height: 100%;">
            <div class="loader spinner-bubble spinner-bubble-primary" style="margin-top: 20%;margin-left: 44%;"></div>
    </div>
    <div class="separator-breadcrumb border-top"></div>

          
            </div>

             <div class="row mb-4 d-none">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="all-leads" onsubmit="return validateForm()">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">                        
                         <div class="col-md-3 form-group mb-3">                        
                                <select class="form-control" id="qualifications" name="qm" placeholder="Search by Qualification">                                     
                                     <?php 
                                    if (!empty($qualification)) { ?>
                                       <option value="<?php echo e($qualification->qm_id); ?>"><?php echo e($qualification->qm_text); ?></option>
                                       <option value="">Show All Qualification</option> 
                                    <?php
                                    }else{?>
                                        <option value="">Search by Qualification</option>
                                    <?php
                                    }
                                    ?>
                                 <?php $__currentLoopData = $qualificationdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                     <option value="<?php echo e($qualification->qm_id); ?>"><?php echo e($qualification->qm_text); ?></option>      
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>                               
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                 <select class="form-control" id="course" name="course">
                                   
                                      <?php 

                                    if (!empty($courses)) { ?>
                                       <option value="<?php echo e($courses->ppm_id); ?>"><?php echo e($courses->ppm_text); ?></option>
                                       <option value="">Show All Courses</option>
                                    <?php
                                    }else{?>
                                        <option value="">Search by Courses</option>
                                    <?php
                                    }
                                    ?>
                                     <?php $__currentLoopData = $productdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                  
                                      <option value="<?php echo e($course->ppm_id); ?>"><?php echo e($course->ppm_text); ?></option>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </div>


                            <div class="col-md-3 form-group mb-3">
                                <select class="form-control" name="state" id="ex_category">                                       
                                        <?php 
                                    if (!empty($states) && !empty($citys)) { ?>
                                       <option value="<?php echo e($states->sm_id); ?>"><?php echo e($states->sm_name); ?></option>
                                      <option value="">Show All States</option>
                                    <?php
                                    }else{?>
                                        <option value="">Search by State</option>
                                    <?php
                                    }
                                    ?>
                                     <?php $__currentLoopData = $statedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
                                        <option value="<?php echo e($state->sm_id); ?>"><?php echo e($state->sm_name); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                
                                 <select class="form-control" name="city" id="subcategory">
                                   
                                    <?php 

                                    if (!empty($citys)) { ?>
                                       <option value="<?php echo e($citys->cm_id); ?>"><?php echo e($citys->cm_name); ?></option>
                                      <option value="">Show All City</option>
                                    <?php
                                    }else{?>
                                        <option value="">Search by City</option>
                                    <?php
                                    }
                                    ?>    
                                </select>
                                <!-- <p id="p1"></p> -->
                                <span id="city_err" class="text-danger"> </span>

                            </div>
                             <div class="col-md-3 form-group mb-3">
                                <input id="picker" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder="DateFrom" name="datefrom" value="<?php echo e(empty($datefrom) ? ''  : $datefrom); ?>">
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <input id="dateto" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder=" Date To" name="dateto" value="<?php echo e(empty($dateto) ? ''  : $dateto); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <select class="form-control" name="leadstage">
                                   
                                    <?php 
                                    if (!empty($leadstage)) { ?>
                                       <option value="<?php echo e($leadstage->lc_id); ?>"><?php echo e($leadstage->lc_text); ?></option>
                                       <option value="">Show All Lead Stage</option>
                                    <?php
                                    }else{?>
                                        <option value="">Search by Lead Stage</option>
                                    <?php
                                    }
                                    ?>
                                    <?php $__currentLoopData = $leadcategorization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->lc_id); ?>"><?php echo e($category->lc_text); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                             <input type="hidden" name="leadtype" id="leadtype" value="<?php echo e(empty($leadtype) ? ''  : $leadtype); ?>">
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
            <!-- end of row -->
            
               <div class="row">                                                             
                             <div class="col-md-6 form-group mb-3">     
                                 <a href="downloadExcelexhibitor?qm_id=<?php if(isset($qm_id)) echo $qm_id;?>&cm_id=<?php if(isset($cm_id)) echo $cm_id; ?>&ppm_id=<?php if(isset($ppm_id)) echo $ppm_id;?>&datefrom=<?php if(isset($datefrom)) echo $datefrom; ?>&dateto=<?php if(isset($dateto)) echo $dateto; ?>">
                                    <button type="button" class="btn btn-outline-success btn-excel" >Download Excel</button></a>   
                                    
                               <a href="https://liveexpo.terraterri.com/?uniqueid=<?php echo e(base64_encode($exhim_email)); ?>" target="_blank">
                                   <button type="button" class="btn btn-primary btn-excel" >View Expo</button>
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

                                                        <!--<th scope="col">Visit Date-->
                                                        <!--        <div class="divide"> Visit Time </div></th>-->

                                                        <th scope="col">Name
                                                            <div class="divide"> Email  </div>
                                                            <div class="divide"> Mobile No.  </div>
                                                        </th>
                                                            
                                                        <!--<th scope="col">Designation-->
                                                        <!--    <div class="divide"> Company </div></th>-->

                                                        <!--<th scope="col">Institution Name-->
                                                        <!--    <div class="divide"> Department </div>-->
                                                        <!--    <div class="divide"> Designation </div>-->
                                                        <!--</th>-->

                                                        <!--<th scope="col">Current Qualification
                                                            <div class="divide"> Course Interested In </div></th>-->
                                                        <!--th scope="col">Choose Your Company
                                                            <div class="divide"> Like to Meet </div></th-->
                                                            
                                                        <th scope="col">Activity</th>
                                                      
                                                        <th scope="col">Conversation 
                                                            <div class="divide"> Last Interaction By</div></th>
                                                            
                                                             <th>Visitors Recall</th>
                                                        <!-- <?php if($profileDetail->exhim_NoPaperForms=='yes'): ?>-->
                                                        <!--  <th scope="col">Push to NoPaperForms</th>-->
                                                        <!--  <?php endif; ?>-->
                                                          
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                      <?php echo $__env->make('datatables.visitor_content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </tbody>
                                                    <!--tfoot>
                                                       
                                                    </tfoot-->
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
                </div>

            </div>
        <!-- end of row -->
        <?php echo $__env->make('layouts.talkjshtml', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
<?php echo $__env->make('layouts.talkjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <!--<script src="<?php echo e(asset('assets/js/vendor/datatables.min.js')); ?>"></script>-->
 <!--<script src="<?php echo e(asset('assets/js/datatables.script.js')); ?>"></script>-->
 <script type="text/javascript">

     /*$(function () {
        $("#reset-btn").bind("click", function () {
            //$('#qualifications option:selected').removeAttr('selected');
            //$("#qualifications")[0].selectedIndex ='select';
             $('#qualifications').val('select').trigger("change");
           
        });
    });*/


 </script>
 <script>
    $(document).on({
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
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

function showEnquiry(leem_mobile,leem_email){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'showEnquiry',
             data: {'leem_mobile':leem_mobile,'leem_email':leem_email},
            success: function (data) {
                console.log(data);
                $('#modelDivs').html(data);       
                $('#modelTiles').html('Show Enquiry');
                $('#footerDivs').hide();
                $('#showEnquiry').modal('toggle')
                    
                }      
        });
}


function showQuotation(leem_mobile,leem_email){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'showQuotation',
             data: {'leem_mobile':leem_mobile,'leem_email':leem_email},
            success: function (data) {
                console.log(data);
                $('#modelDivs').html(data);       
                $('#modelTiles').html('Show Quotation');
                $('#footerDivs').hide();
                $('#showEnquiry').modal('toggle')
                    
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

function SynctoNoPaperForms(leem_id){
     $.ajax({
         headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            method:"post",
            url: "SynctoNoPaperForms",
            data:{leem_id:leem_id},
            success: function (data) {
                console.log(data);
                    var obj=jQuery.parseJSON(data);
                    var type="warning";
                    var icon="error";
                    var btn="btn-warning";
                    if(obj.status=='Success' || obj.status=='Duplicate'){
                        type="success";
                        icon="success";
                        btn="btn-success";
                        $('#sync'+leem_id).removeClass('btn-primary');
                        $('#sync'+leem_id).addClass('btn-success');
                        $('#sync'+leem_id).html('Synced');
                    }
                            swal({
                                type: type,
                                icon: icon,
                                title: obj.status+'!',
                                
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg '+btn
                            });
                    }
            
        });
}

var isMobile = {
				Android: function() {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function() {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function() {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function() {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function() {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function() {
					return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
				}
			};

 
		
		
	
		
	
	function createtoken(){
      
      
      
        var createToken = function (details, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response =  JSON.parse(this.responseText);
            if(response.error){
                $.toast({
                    heading: 'Error',
                    text: response.error,
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right',
                    showHideTransition: 'slide'
                });
            }
            else {
                callback(response.token);
            }
        }
    };
    xhttp.open("POST", "../../api/createToken", true);
    xhttp.setRequestHeader('Content-Type', 'application/json');
    xhttp.send(JSON.stringify(details));
};


var data=['<?php echo Session('session')[0]->ebsm_name." (".$profileDetail->exhim_organization_name.")"; ?>','moderator','<?php echo $roomid; ?>','<?php echo $profileDetail->exhim_contact_email; ?>'];
  var createDataJson = function (url) {
        sessionStorage.clear()

        var urlData = url;
        username = urlData[0];
        var retData = {
            "name": urlData[0],
            "role": urlData[1],
            "roomId": urlData[2],
            "user_ref": urlData[3],
        };
        return retData;
  }
 createToken(createDataJson(data), function (response) {

        var token = response;
        
        var redirectUrl = 'https://smartevents.daily.co/'+'<?php echo $roomid; ?>'+'/?t='+token;
        console.log(redirectUrl);
        window.open(
  redirectUrl,
  '_blank' // <- This is what makes it open in a new window.
);
        
 });
            
      
  }

</script>

<script>
function openchat() {
    console.log('test chat');
    Talk.ready.then(function () {
		var me = new Talk.User({
            id: '<?php echo $profileDetail->exhim_id;?>b2bexpo2023',
			name: '<?php echo $profileDetail->exhim_organization_name;?>',
			email: '<?php echo $profileDetail->exhim_contact_email;?>',
			role: 'user',
		});
		window.talkSession = new Talk.Session({
			appId: '6SG5GBvc',
			me: me,
		
		});
		
		var inbox = talkSession.createInbox({});
    inbox.mount(document.getElementById('talkjs-container'));
		});


 
    $('#chat-box1').css('display','block');
    $('.chat-button').css('display','block');
    
}

Talk.ready.then(function () {
		var me = new Talk.User({
            id: '<?php echo $profileDetail->exhim_id;?>b2bexpo2023',
			name: '<?php echo $profileDetail->exhim_organization_name;?>',
			email: '<?php echo $profileDetail->exhim_contact_email;?>',
			role: 'user',
		});
		window.talkSession = new Talk.Session({
			appId: '6SG5GBvc',
			me: me,
			
		});
	

	talkSession.unreads.on('change', function (unreadConversations) {
  var amountOfUnreads = unreadConversations.length;
  
  // update the text and hide the badge if there are
  // no unreads.
  $('#notifier-badge')
    .text(amountOfUnreads)
    .toggle(amountOfUnreads > 0);

  // update the tab title so users can easily see that they have
  // messages waiting
  if (amountOfUnreads > 0) {
    document.title = '(' + amountOfUnreads + ') New Message';
  } else {
    document.title = 'Business Expo';
  }
});

		});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/datatables/visitor-tables.blade.php ENDPATH**/ ?>