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
    <h1>Activity Report </h1>
    <ul>
        <li><a href="activityreport">View List</a></li>
        <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
    </ul>
<ul class="d-none"><a  target="_blank" href="https://www.whatsapp.com/download" class="btn btn-success float-right"><i class="i-Video"></i>&nbsp;Download WhatsApp</a></ul> 
   <?php if(Session('session')[0]->at_id==4 && !empty($eewbmdetail->eewbm_video_url)): ?>
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

             <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="activityreport" onsubmit="return validateForm()">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                            
                             <div class="col-md-3 form-group mb-3">
                                <input id="picker" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder="DateFrom" name="datefrom" value="<?php echo e(empty($datefrom) ? ''  : $datefrom); ?>">
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <input id="dateto" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder=" Date To" name="dateto" value="<?php echo e(empty($dateto) ? ''  : $dateto); ?>">
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
                                 <a href="activityreport?datefrom=<?php if(isset($datefrom)) echo $datefrom; ?>&dateto=<?php if(isset($dateto)) echo $dateto; ?>&action=download">
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

                                                        <th scope="col">Visit Date
                                                                <div class="divide"> Visit Time </div></th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Mobile No.</th>  
                                                        <th scope="col">Designation
                                                            <div class="divide"> Company </div></th>
                                                        <th scope="col">Activity</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                        $i=1
                                                        ?>
                                                        <?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                          <tr>
                                                              <th scope="row"><?php echo e($i++); ?></th>
                                                        
                                                              <td scope="row"><?php echo e(date('d-M,Y',strtotime($list->leem_datetime))); ?>

                                                              <div class="divide"> <?php echo e(date('h:i A',strtotime($list->leem_datetime))); ?></div></td>
                                                              <td><?php echo e(ucfirst($list->lm_fullname)); ?></td>
                                                              <td><?php echo e($list->lm_email); ?></td>
                                                                <td><?php echo e($list->lm_mobile); ?></td>
                                                                
                                                                <td><?php echo e($list->lm_designation); ?>

                                                                <div class="divide"><?php echo e($list->lm_company_name); ?></div>
                                                                </td>
                                                             
                                                              <td style="font-size: 11px;"><?php echo $list->activity; ?></td>
                                                          </tr>
                                                        
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

               

                </div>

            </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
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



function leadtypeFormSubmit(leadType){
$('#leadtype').val(leadType);
$('#searchbtn').click();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/exhibitors/activity_report.blade.php ENDPATH**/ ?>