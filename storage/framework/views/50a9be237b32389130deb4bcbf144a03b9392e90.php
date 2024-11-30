
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
                <h1>Customers</h1>
                <ul>
                    <li><a href="">Customer</a></li>
                    <li>Customer List</li>
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
                        
                        
                           <!--<div class="col-md-3 form-group mb-3">                        -->
                           <!--     <select class="form-control" id="serch_by_company" name="serch_by_company" placeholder="Search by Company"> -->
                           <!--         <option value="">Search by Company</option>                                    -->
                           <!--      <?php $__currentLoopData = $companyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $companyDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    -->
                           <!--          <option value="<?php echo e($companyDetails->lm_company_name); ?>" <?php if($serch_by_company==$companyDetails->lm_company_name): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($companyDetails->lm_company_name); ?></option>      -->
                           <!--      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                           <!--    </select>                               -->
                           <!-- </div>-->



                         <!-- <div class="col-md-3 form-group mb-3">                        
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
                           </div> -->
                           
                            
                             <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder="DateFrom" name="datefrom" value="<?php echo e(empty($datefrom) ? ''  : $datefrom); ?>">
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder=" Date To" name="dateto" value="<?php echo e(empty($dateto) ? ''  : $dateto); ?>">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <select class="form-control" name="leadstage">
                                   
                                    <?php 
                                    if (!empty($leadstage)) { ?>
                                       <option value="<?php echo e($leadstage->lead_stage); ?>"><?php echo e(ucfirst($leadstage->lead_stage)); ?></option>
                                       <option value="">Show All Lead Stage</option>
                                    <?php
                                    }else{?>
                                        <option value="">Search by Lead Stage</option>
                                    <?php
                                    }
                                    ?>
                                        <option value="prospect">Prospect</option>
                                        <option value="trail">Trail</option>
                                        <option value="paid">Paid</option>
                                   
                                </select>
                            </div> 
                            
                             <!-- <div class="col-md-3 form-group mb-3">
                                <select class="form-control" name="univrsty">
                                   <option value="">Select University/Institute</option>
                                    <?php $__currentLoopData = $universitylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   
                                    <option value="<?php echo e($ulist->exhim_id); ?>" <?php if($ulist->exhim_id==$univrstyId) { echo 'selected'; } ?>   ><?php echo e($ulist->exhim_organization_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>  -->

                           <!-- <div class="col-md-3 form-group mb-3">-->
                           <!--     <select class="form-control" id="leadsource" name="leadsource">-->
                           <!--       <option value=""> Select Lead Source</option>-->
                           <!--         <?php foreach($leadsource as $source){ ?>-->
                           <!--         <option value="<?php echo e($source->ls_id); ?>" <? if($source->ls_id==$leadsrc){ echo 'selected'; } ?> ><?php echo e($source->ls_text); ?></option>-->
                           <!--         <?php } ?>-->
                           <!--        </select>-->
                           <!--</div>-->
                           
                           <!--<div class="col-md-3 form-group mb-3">-->
                           <!--     <select class="form-control" id="adid" name="adid">-->
                           <!--       <option value="">Select Ad Id</option>-->
                           <!--         <?php foreach($ad_id as $source){ ?>-->
                           <!--         <option value="<?php echo e($source->lemm_adid); ?>" <? if($source->lemm_adid==$adid){ echo 'selected'; } ?> ><?php echo e($source->lemm_adid); ?></option>-->
                           <!--         <?php } ?>-->
                           <!--        </select>-->
                           <!--</div>-->

                           <!--<div class="col-md-3 form-group mb-3">-->
                           <!--     <select class="form-control" id="status" name="status">-->
                           <!--       <option value="">Select Status</option>-->
                           <!--        <option value="">All</option>-->
                           <!--        <option <? if($status == 'Y'){ echo 'selected'; } ?> value="Y">Verified</option>-->
                           <!--        <option <? if($status == 'N'){ echo 'selected'; } ?> value="N">Unverified</option>-->
                           <!--        </select>-->
                           <!--</div>-->
                           
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
            
            <!--<div class="row mb-4">-->
            <!--    <div class="col-md-12">-->
            <!--        <h4>Datatables</h4>-->
            <!--        <p>DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, build upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table.</p>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- end of row -->
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Customers</button>

                 </div>
            </div>
             <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <!--<h4 class="card-title mb-3">Zero configuration</h4>-->
                            <!--<p>DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</p>-->
                            
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
                                 <?php echo $__env->make('datatables.table_content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </table>
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($Alldata->previousPageUrl()); ?>" tabindex="-1">Previous</a>
                                    </li>
                                     <?php for($i=1;$i<=$Alldata->lastPage();$i++): ?>
                                    <li class="page-item <?php echo e($Alldata->currentPage() ==  $i ? 'active' : ''); ?>">
                                        <a class="page-link" href="<?php echo e($Alldata->url($i)); ?>"><?php echo e($i); ?> <span class="sr-only">(current)</span></a>
                                    </li>
                                     <?php endfor; ?>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($Alldata->nextPageUrl()); ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                              <p>
                                Displaying <?php echo e($Alldata->count()); ?> of <?php echo e($Alldata->total()); ?> customer(s).
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end of col -->




            </div>
            <!-- end of row -->
<!-- MAIL MODAL -->
 <div class="modal fade" id="MailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-None modal-dialog-centered" role="document" style="max-width:50%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Send Mail</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="MailForm" id="MailForm" class="" action="" method="post"  enctype="multipart/form-data" >
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                             
                             <div class="card mb-4">
                              <div class="card-body">                
                                <div class="row">
                                   <div class="col-md-12 form-group">
                                        <label>To</label>
                                       <input type="text" class="form-control" name="to" id="to" value="" readonly />
                                    </div>
                                     <div class="col-md-12 form-group">
                                        <label>CC</label>
                                       <input type="text" class="form-control" name="cc" id="cc" value="" readonly />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subject</label>
                                       <input type="text" class="form-control" name="subject" id="subject" value="" readonly />
                                    </div>
                           
                                    <div class="col-md-12 form-group">

                                    <label for="content">Mail body</label>
                                        
                                         <textarea class="ckeditor form-control form-control-lg"  name="content" id="content" autocomplete="off"></textarea>
                                         <script type="text/javascript">
                                        	 $(document).ready(function() {
                                                CKEDITOR.replace("content");
                                            });
                                        </script>
                                    </div>


                                </div>
                        </div>
                        
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="SendMail()">Send Mail </button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
 <!--End Mail modal -->
<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addprospectsForm" id="addprospectsForm">
                                <?php echo csrf_field(); ?>

                        <div class="modal-body">
                             
                                <div class="form-row">
                                <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" value="">
                                       <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                                       <span class="text-danger p-1"><?php echo e($errors->first('full_name')); ?></span>
                                    </div>
                                     <div class="col-md-6 mb-3">
                                         <label for="recipient-name-2" class="col-form-label">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                         <span class="text-danger" id="msg_email" name="msg_email"  style="display:none;"></span>
                                    </div>
                                    </div>
                               
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                          <label for="recipient-name-2" class="col-form-label">Select Country:</label>
                                        <select class="form-control" name="country" id="country">
                                            <?php $__currentLoopData = $Allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($country->counm_id); ?>" data-id="<?php echo e($country->counm_code); ?>"><?php echo e($country->counm_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Mobile:</label>
                                        	<div class="input-group form-group position-relative">
                                        	<div class="input-group-prepend" >
                    									<div class="input-group-text" style="padding: unset;
                                                                                            border: unset;
                                                                                            background: #fff;
                                                                                            /*border-top-left-radius: 50px;
                                                                                            border-bottom-left-radius: 50px;*/
                                                                                            font-size: 14px;
                                                                                            height: 35px;">
                    											<select class="custom-select" style="border: unset; margin-left: 0px;"  name="country_code" id="country_code" data-text="Select current state!" required>
                                                                <?php        
                                                                    if(!empty($Allcountry)){
                                                                        foreach($Allcountry as $key => $countryData){
                                                                            echo '<option value="'.$countryData->counm_code.'">+'.$countryData->counm_code.'</option>';
                                                                        }
                                                                    }
                                                                ?>
                    											</select>
                    									</div>
                    								</div>
                    								 <input type="number" class="form-control" name="mobile" id="mobile">
                    					    </div>
                                        <!--<input type="text" class="form-control" name="phone_number" id="phone_number">-->
                                      </div>
                                </div>
                                
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Company Website:</label>
                                        <input type="text" class="form-control" name="company_website" id="company_website" placeholder="Website Name">
                                    </div>
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Company Name:</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-2 mt-2">
                                        <h5><label for="usr" class="font-weight-bold">Select Template</label></h5>
                                        <span class="text-danger" id="msg_temp" name="msg_temp"  style="display:none;"></span>
                                    </div>
                                    <?php $__currentLoopData = $tempList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-3 mb-3">
                                        <div class="card card-body ul-border__bottom">
                                            <div class="text-center">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="temp_ids[]" value="<?php echo e($list->etm_id); ?>" id="defaultChecked<?php echo e($key); ?>">
                                                    <label class="custom-control-label" for="defaultChecked<?php echo e($key); ?>"></label>
                                                </div>
                                                <h5 class="heading text-primary mb-1"><?php echo e($list->etm_name); ?></h5>
                                                <p class="text-primary mt-2"><a href="javascript:void(0)" onclick="showPreview('<?php echo e(asset($list->etm_video)); ?>')" class="btn btn-primary">Preview</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </div>
                            
                        </div>
                        <div class="modal-footer">
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
                                <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="ed_full_name" id="ed_full_name" value="">
                                       <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-6 mb-3">
                                         <label for="recipient-name-2" class="col-form-label">Email:</label>
                                        <input type="email" class="form-control" name="ed_email" id="ed_email" value="">
                                         <span class="text-danger" id="ed_msg_email" name="ed_msg_email"  style="display:none;"></span>
                                    </div>
                                    </div>
                               
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                          <label for="recipient-name-2" class="col-form-label">Select Country:</label>
                                        <select class="form-control" name="ed_country" id="ed_country">
                                            <?php $__currentLoopData = $Allcountry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($country->counm_id); ?>" data-id="<?php echo e($country->counm_code); ?>" ><?php echo e($country->counm_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Mobile:</label>
                                        	<div class="input-group form-group position-relative">
                                        	<div class="input-group-prepend" >
                    									<div class="input-group-text" style="padding: unset;
                                                                                            border: unset;
                                                                                            background: #fff;
                                                                                            /*border-top-left-radius: 50px;
                                                                                            border-bottom-left-radius: 50px;*/
                                                                                            font-size: 14px;
                                                                                            height: 35px;">
                    											<select class="custom-select" style="border: unset; margin-left: 0px;"  name="ed_country_code" id="ed_country_code" data-text="Select current state!" required>
                                                                <?php        
                                                                    if(!empty($Allcountry)){
                                                                        foreach($Allcountry as $key => $countryData){
                                                                            echo '<option value="'.$countryData->counm_code.'">+'.$countryData->counm_code.'</option>';
                                                                        }
                                                                    }
                                                                ?>
                    											</select>
                    									</div>
                    								</div>
                    								 <input type="number" class="form-control" name="ed_mobile" id="ed_mobile" value="">
                    					    </div>
                                      </div>
                                </div>
                                
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Company Website:</label>
                                        <input type="text" class="form-control" name="ed_company_website" id="ed_company_website" placeholder="Website Name" value="">
                                    </div>
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Company Name:</label>
                                        <input type="text" class="form-control" name="ed_company_name" id="ed_company_name" placeholder="Company Name" value="">
                                    </div>
                                   
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-12 mb-2 mt-2">
                                        <h5><label for="usr" class="font-weight-bold">Select Template</label></h5>
                                        <span class="text-danger" id="ed_msg_temp" name="ed_msg_temp"  style="display:none;"></span>
                                    </div>
                                    <?php $__currentLoopData = $tempList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-3 mb-3">
                                        <div class="card card-body ul-border__bottom">
                                            <div class="text-center">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="etemp_ids[]" value="<?php echo e($list->etm_id); ?>" id="eddefaultChecked<?php echo e($key); ?>">
                                                    <label class="custom-control-label" for="eddefaultChecked<?php echo e($key); ?>"></label>
                                                </div>
                                                <h5 class="heading text-primary mb-1"><?php echo e($list->etm_name); ?></h5>
                                                <p class="text-primary mt-2"><a href="javascript:void(0)" onclick="showPreview('<?php echo e(asset($list->etm_video)); ?>')" class="btn btn-primary">Preview</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
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
                    
                    if($('input[name="temp_ids[]"]:checked').length < 1)
                    {
                       $("#msg_temp").text("Please Select at least one template");
                       $("#msg_temp").fadeIn('fast');
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
                    
                    $('#verifyModalContent1').modal('toggle');
                    
                    const etmIdArray = data.etm_ids.split(",");
                    $('input[name="etemp_ids[]"]').each(function(index, element) {
                        if ($.inArray(element.value, etmIdArray) != -1)
                        {
                          $(this).prop('checked', true);
                        }
                    });
                   
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
                    
                    if($('input[name="etemp_ids[]"]:checked').length < 1)
                    {
                       $("#ed_msg_temp").text("Please Select at least one template");
                       $("#ed_msg_temp").fadeIn('fast');
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/superadmin/prospects-table.blade.php ENDPATH**/ ?>