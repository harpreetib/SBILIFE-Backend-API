		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Exhibitor Detail</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <form  name="editexhibitor" id="editexhibitor" class="" action="" method="post">
		              <?php echo e(csrf_field()); ?>


		              <input class="form-control" type="hidden" name="editexhibitors" id="editexhibitors" value="adduser" />
		        <div class="modal-body">
		            

		    <div class="card mb-4">
		        <div class="card-body">
		           
		                <div class="row">
		                    
		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Organisation Name</label>
		                        <input type="text" class="form-control" name="ex_name" id="ex_name" placeholder="Name"
		                        value="<?php echo e($dataList->exhim_organization_name); ?>">
		                        <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
		                    </div>
		                    
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration">Organisation Email</label>-->
		                    <!--    <input type="text" class="form-control" name="ex_organisation_email" id="ex_organisation_email" placeholder="Name"-->
		                    <!--    value="<?php echo e($dataList->exhim_organisation_email); ?>">-->
		                    <!--    <span class="text-danger" id="msg_orgemail" name="msg_orgemail"  style="display:none;"></span>-->
		                    <!--</div>-->

		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_fee_sem">Contact E-mail</label>
		                        <input type="email" class="form-control" name="ex_email" id="ex_email" placeholder="E-mail Address" 
		                         value="<?php echo e($dataList->exhim_contact_email); ?>">
		                        <span class="text-danger" id="msg_email" name="msg_email"  style="display:none;"></span>
		                    </div>
		                    
		                    
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Designation</label>
                                        <input type="text" class="form-control"  name="ex_designation" id="ex_designation" placeholder="Designation" value="<?php echo e($dataList->exhim_designation); ?>" />
                                        <span class="text-danger" id="msg_designation" name="msg_designation"  style="display:none;"></span>
                                    </div>

		                    
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Select Country</label>
                                        
                                         <select class="form-control" id="ex_country" name="ex_country">

		  								 <option value="">Select Country</option>
										 <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										 <option value="<?php echo e($cut->counm_id); ?>" <?php echo e($id->counm_id == $cut->counm_id  ? 'selected' : ''); ?>><?php echo e($cut->counm_name); ?></option>
		  								
		  								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  								</select>
                                        <span class="text-danger" id="msg_country" name="msg_country"  style="display:none;"></span>
                                </div> 

                                 
                                    
                                    <div class="col-md-6 form-group mb-3">
                                    <label for="country_code">Contact No (Mobile)</label>
                                            <div class="input-group form-group position-relative">
                                               
                    							<div class="input-group-prepend" >
                    									<div class="input-group-text" style="padding: unset;
                                                                                            border: unset;
                                                                                            background: #fff;
                                                                                            /*border-top-left-radius: 50px;
                                                                                            border-bottom-left-radius: 50px;*/
                                                                                            font-size: 14px;
                                                                                            height: 35px;border: 1px solid #ced4da;">
                    											<select class="custom-select" style="border: unset; margin-left: 0px;"  name="ex_country_code" id="ex_country_code" data-text="Select current state!" required>
                                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        										 <option value="<?php echo e($cut->counm_code); ?>" <?php echo e($dataList->fax_code == $cut->counm_code  ? 'selected' : ''); ?>>+<?php echo e($cut->counm_code); ?></option>
                        		  								
                        		  								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    											</select>
                    									</div>
                    								</div>
                    								<input type="number" class="form-control" name="ex_phone" id="ex_phone"  placeholder="Mobile" value="<?php echo e($dataList->exhim_contact_us); ?>">
                    								<span class="text-danger" id="err_contact_mobile" name="err_contact_mobile"  style="display:none;"></span>
                    								
                    							
                    						  </div>
                    					</div>
		                    
		                    
		                    
		                    

		                    <div class="col-md-6 form-group mb-3 d-none">
		                        <label for="course_fee_sem">Select State</label>
		                        
		                         <select class="form-control" id="ex_category" name="ex_sm_ids">	
									
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            <option value="" ></option>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
		                        <span class="text-danger" id="msg_state" name="msg_state"  style="display:none;"></span>
		                    </div> 
		                    <div class="col-md-6 form-group mb-3 d-none">
		                        <label for="course_fee_sem">Select City</label>
		                        <select class="form-control" id="ex_subcategory" name="ex_cm_ids">
									 <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            <option value="<?php echo e($subcategory->cm_id); ?>" <?php echo e($id->cm_id == $subcategory->cm_id  ? 'selected' : ''); ?>><?php echo e($subcategory->cm_name); ?></option>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                    </select>
		                        <span class="text-danger" id="msg_city" name="msg_city"  style="display:none;"></span>
		                    </div>
		                    
		                       

		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_fee_sem">Booth Package</label>
		                         <select class="form-control" id="plan" name="plan">	
    								<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    		                            <option value="<?php echo e($plan->ppm_id); ?>" <?php echo e($dataList->ppm_id == $plan->ppm_id  ? 'selected' : ''); ?>><?php echo e($plan->ppm_text); ?></option>
    		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								 </select>
		                        <span class="text-danger" id="msg_plan" name="msg_plan"  style="display:none;"></span>
		                    </div> 
		                    
		                    
	                            <div class="col-md-6 form-group mb-3 d-none" id="modal-content">
                                    <label for="exhiHallCategory">Select HALL Category</label>
                                        <select class="form-control chosen" id="exhiHallCategory" name="exhiHallCategory[]" required>
                                            <?php $__currentLoopData = $exhibitorHallCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hallCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($hallCategory->ehc_id); ?>" <?php if(in_array($hallCategory->ehc_id, explode(',', $dataList->ehc_id))) { echo 'selected'; } ?> > <?php echo e($hallCategory->ehc_hall_name); ?> ( <?php echo e($hallCategory->ehc_name); ?> )</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        
                                   
                                    <span class="text-danger" id="err_exhiHallCategory"  style="display:none;"></span>
                                </div>
                                
                                <div class="col-md-6 form-group mb-3 d-none">
    		                        <label for="course_fee_year">Stall Number</label>
    		                        <input type="text" class="form-control" name="ex_stallnumber" id="ex_stallnumber"  placeholder="Stall Number"
    		                         value="<?php echo e($dataList->eem_stall_number); ?>">
    		                        <span class="text-danger" id="msg_stall" name="msg_stall"  style="display:none;"></span>
    		                    </div>
                                
                                <div class="col-md-12 form-group mb-3">
    		                        <label for="course_fee_year">Address</label>
    		                        <input type="text" class="form-control" name="ex_address" id="ex_address"  placeholder="Address"
    		                         value="<?php echo e($dataList->exhim_address); ?>">
    		                        <span class="text-danger" id="msg_address" name="msg_address"  style="display:none;"></span>
    		                    </div>
                                    
                                    
                                    <?php if(isset(Session::get('session')[0]->at_id) && Session::get('session')[0]->at_id=='1'): ?> 
                                        <div class="col-md-12 form-group mb-3 d-none">
            		                        <label for="course_duration">Custom Back To Hall Url</label>
            		                        <input type="text" class="form-control" name="custom_backtohall" id="custom_backtohall" placeholder="Back To Hall Page"
            		                        value="<?php echo e($dataList->eem_custom_backtohall); ?>">
            		                        <span class="text-danger" id="msg_custom_backtohall" style="display:none;"></span>
            		                    </div>
        		                    <?php endif; ?>
        		                    
        		                       
        		                    <h3 class="d-none"># SHOW BOOTH / OUR INNOVATIONS (Only )</h3>
                                    <div class="col-md-12 form-group mb-3 d-none">
                                         
                                         <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="is_booth_list" id="is_booth_list" value='Y' <?php if(isset($dataList->eem_is_booth_list) && $dataList->eem_is_booth_list=='Y'): ?> <?php echo e('checked'); ?> <?php endif; ?> >
                                            <label class="form-check-label" for="exampleCheck1">Show Booth List</label>
                                          </div>
                                        
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="is_product_list" id="is_product_list" value='Y' <?php if(isset($dataList->eem_is_product_list) && $dataList->eem_is_product_list=='Y'): ?> <?php echo e('checked'); ?> <?php endif; ?>>
                                            <label class="form-check-label" for="exampleCheck1">Show Product List</label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12 form-group mb-3 d-none2">
                                        <h5 class="d-none2"><label class="font-weight-bold"># DOORS</label></h5>
                                        <span class="text-danger" id="ed_msg_temp" name="ed_msg_temp"  style="display:none;"></span>
                                        <?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="etd_ids[]" value="<?php echo e($list->etd_id); ?>"  <?php if(in_array($list->etd_id,explode(',',$dataList->etd_id))): ?> <?php echo e('checked'); ?> <?php endif; ?> >
                                            <label class="form-check-label" for="exampleCheck1"><?php echo e($list->etd_name); ?></label>
                                          </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    
                                    
		                       
		                </div>
		        </div>
		    </div>


		        </div>
		        <div class="modal-footer">
		             <input type="hidden" class="form-control" value="<?php echo e($dataList->exhim_id); ?>" name="exhim_id" id="exhim_id">
		            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="updateExhibitor()">Update Exhibitor</button>
		        </div>
		      </form>
<?php /**PATH /home/megaspace/public_html/admin/resources/views/customers/editexhibitor.blade.php ENDPATH**/ ?>