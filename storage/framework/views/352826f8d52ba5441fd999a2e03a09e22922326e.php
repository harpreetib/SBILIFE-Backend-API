		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
		
		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Counselor Session</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <form  name="editcounselorsession" id="editcounselorsession" class="" action="" method="post">
		              <?php echo e(csrf_field()); ?>


		              <input class="form-control" type="hidden" name="editexhibitors" id="editexhibitors" value="adduser" />
		        <div class="modal-body">
		            

		    <div class="card mb-4">
		        <div class="card-body">
		           
		                <div class="row">
		                     <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Session Type</label>
		                        <select class="form-control" name="e_type" id="e_type" >
		                            <option value="">Select Session Type</option>
		                           
		                            
		                             <option value="audi" <?php if($dataList->lccs_type=='audi'){ echo 'selected'; } ?>>Main Audi</option>
		                            <option value="h1" <?php if($dataList->lccs_type=='h1'){ echo 'selected'; } ?>>Hall 1</option>
		                             <option value="h2" <?php if($dataList->lccs_type=='h2'){ echo 'selected'; } ?>>Hall 2</option>
		                              <option value="h3" <?php if($dataList->lccs_type=='h3'){ echo 'selected'; } ?>>Hall 3</option>
		                               <option value="h4" <?php if($dataList->lccs_type=='h4'){ echo 'selected'; } ?>>Hall 4</option>
		                                <option value="h5" <?php if($dataList->lccs_type=='h5'){ echo 'selected'; } ?>>Hall 5</option>
		                                 <option value="h6" <?php if($dataList->lccs_type=='h6'){ echo 'selected'; } ?>>Hall 6</option>
		                        </select>
		                        <!--<span class="text-danger" id="e_type" name="e_type"  style="display:none;"></span>-->
		                    </div>
		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Session Name</label>
		                        <input type="text" class="form-control" name="e_name" id="e_name" placeholder="Session Name"
		                        value="<?php echo e($dataList->lccs_name); ?>">
		                        <span class="text-danger" id="lccc_name" name="lccc_name"  style="display:none;"></span>
		                    </div>
		                    <div class="col-md-6 form-group mb-3">
		                        <label for="course_duration">Sub Heading</label>
		                        <!--<input type="text" class="form-control" name="e_sub_title" id="e_sub_title" placeholder="Sub Heading"-->
		                        <!--value="<?php echo e($dataList->lccs_sub_title); ?>">-->
		                        <textarea class="form-control" name="e_sub_title" id="e_sub_title" placeholder="Sub Heading"><?php echo e($dataList->lccs_sub_title); ?></textarea>
		                        <!--<span class="text-danger" id="lccc_name" name="lccc_name"  style="display:none;"></span>-->
		                    </div>
		                   
		                   <!--<div class="col-md-6 form-group mb-3">-->
		                   <!--     <label for="course_duration">Moderator / Host Name</label>-->
		                   <!--     <input type="text" class="form-control" name="e_moderator" id="e_moderator" placeholder="Moderator Name"-->
		                   <!--     value="<?php echo e($dataList->lccs_moderator_name); ?>">-->
		                        <!--<span class="text-danger" id="lccc_sname" name="lccc_esname"  style="display:none;"></span>-->
		                   <!-- </div>-->
		                    
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator / Host Designation</label>-->
		                    <!--    <input type="text" class="form-control" name="e_mdesignation" id="e_mdesignation" placeholder="Moderator Designation"-->
		                    <!--    value="<?php echo e($dataList->lccs_moderator_designation); ?>">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator / Host Description</label>-->
		                    <!--    <input type="text" class="form-control" name="e_mdesc" id="e_mdesc" placeholder="Moderator Description"-->
		                    <!--    value="<?php echo e($dataList->lccs_moderator_desc); ?>">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Moderator / Host Pic</label>-->
		                    <!--    <input type="file" class="form-control" name="e_moderatorpic" id="e_moderatorpic" -->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Name</label>-->
		                    <!--    <input type="text" class="form-control" name="e_host" id="e_host" placeholder="Host Name"-->
		                    <!--    value="<?php echo e($dataList->lccs_host_name); ?>">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Desigation</label>-->
		                    <!--    <input type="text" class="form-control" name="e_hdesignation" id="e_hdesignation" placeholder="Host Desigation"-->
		                    <!--    value="<?php echo e($dataList->lccs_host_designation); ?>">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    <!-- <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Description</label>-->
		                    <!--    <input type="text" class="form-control" name="e_hdesc" id="e_hdesc" placeholder="Host Description"-->
		                    <!--    value="<?php echo e($dataList->lccs_host_desc); ?>">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    <!--  <div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_duration"> Co-host Pic</label>-->
		                    <!--    <input type="file" class="form-control" name="e_hostpic" id="e_hostpic" -->
		                    <!--    value="">-->
		                        <!--<span class="text-danger" id="lcc_sname" name="lcc_sname"  style="display:none;"></span>-->
		                    <!--</div>-->

		                    <div class="col-md-6 form-group mb-3">
	                            <label for="picker3">Start Date Time</label>                        
	                                <input id="e_startdates" type="datetime-local" step=1 class="form-control" name="e_startdates" placeholder="Start Date Time"  value="<?php echo e(date("Y-m-d\TH:i:s", strtotime($dataList->lccs_start_datewtime))); ?>">
	                               <div class="input-group-append">                                      
	                            </div>
	                            <span class="text-danger" id="lccc_start" name="lccc_start"  style="display:none;"></span>
                        	</div>

		                   
		                    <div class="col-md-6 form-group mb-3">
	                            <label for="picker3">End Date Time</label>                        
	                                <input id="e_enddate" type="datetime-local" step=1 class="form-control" name="e_enddate" placeholder="End Date Time"   value="<?php echo e(date("Y-m-d\TH:i:s", strtotime($dataList->lccs_end_datewtime))); ?>">
	                               <div class="input-group-append">                                      
	                            </div>
	                           <span class="text-danger" id="lccc_end" name="lccc_end"  style="display:none;"></span>
                        	</div>

		                   
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_fee_year">Room Url</label>-->
		                    <!--    <input type="text" class="form-control" name="e_roomid" id="e_roomid"  placeholder="Room Url"-->
		                    <!--     value="<?php echo e($dataList->lcss_room_id); ?>">-->
		                    <!--    <span class="text-danger" id="lccc_room" name="lccc_room"  style="display:none;"></span>-->
		                    <!--</div>-->
		                    
		                    
		                    <!--<div class="col-md-6 form-group mb-3">-->
		                    <!--    <label for="course_fee_year">Zoom Password</label>-->
		                    <!--    <input type="text" class="form-control" name="e_zoompass" id="e_zoompass"  placeholder="Zoom Password"  -->
		                    <!--        value="<?php echo e($dataList->lccs_zoom_pwd); ?>">-->
		                    <!--    <span class="text-danger" id="lccc_zoom_pwd" name="lccc_zoom_pwd"  style="display:none;"></span>-->
		                    <!--</div> -->
		                       <!--<div class="col-md-6 form-group mb-3">-->
                         <!--   <label for="picker3">Past Video Url</label>-->
                         <!--       <input id="pastvideo_url" class="form-control" type="text" name="pastvideo_url" placeholder="Past Video Url">-->
                         <!--       <div class="input-group-append">                                       -->
                         <!--       </div>-->
                         <!--       <span class="text-danger" id="lcc_pastvideo" name="lcc_pastvideo"  style="display:none;"></span>-->
                         <!--   </div>-->

		                       
		                </div>
		                
		                
		                
		                
		        </div>
		    </div>
		    
		    
		    <div class="card mb-4">
                                <div class="card-body"> 
                                      
                                <div class="row ">
                                
                                        
                                  <div name="div_add_speaker" id="div_add_speaker"  >
        						
        								<div class="col-md-6">
        									<h5><b>Add Speakers:</b></h5>
        								</div>
        								<div class="col-md-6 float-right" >
        									<button type="button" class="btn btn-info add-nspeaker" id="addspeaker" name="addspeaker">Add Speaker</button>
        								</div>
        						
                             
            								<div class="">
            									<table class="table table-bordered table-striped">
            										<thead>
            											<tr>
            												<th>Session Time</th>
            											<th>Speaker Company Name</th>
            												<th>Speaker Name<span style="color:red;">*</span></th>
            												<th>Speaker Designation</th>
            												<th>Speaker Description</th>
            												<th>Speaker pic</th>
            												<th>Change Photo</th>
            												<th>Action</th>
            												
            											</tr>
            										</thead>
            										<tbody id="nspeaker">
            											<?php $j=0;?>
            											<?php if(count($speaker_data)>0): ?>
            											    <?php $__currentLoopData = $speaker_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            											<tr>
            											    <td><input class="form-control" type="text" name="estime-<?php echo $j; ?>" autocomplete="off" id="estime-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_time); ?>"   placeholder="Session Time"></td>
            											    <td><input class="form-control" type="text" name="escname-<?php echo $j; ?>" autocomplete="off" id="escname-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_company_name); ?>"   placeholder="Compqny Name"></td>
            												<td><input class="form-control" type="text" name="esname-<?php echo $j; ?>" autocomplete="off" id="esname-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_name); ?>"   placeholder="Full Name"></td>
            												<td><input class="form-control" type="text" name="esdesig-<?php echo $j; ?>" autocomplete="off" id="esdesig-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_designation); ?>"   placeholder="Designation"></td>
            													<td><input class="form-control" type="text" name="esdesc-<?php echo $j; ?>" autocomplete="off" id="esdesc-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_description); ?>"   placeholder="Description"></td>
            													<td><img style="width:50px;" src="<?php echo e(asset($speaker->lccss_pic)); ?>"</td>
            												<td><input class="form-control" type="file" name="espic-<?php echo $j; ?>" autocomplete="off" id="espic-<?php echo $j; ?>" value=""  ></td>
            												<td class="text-danger"><a class="fa fa-trash delete-rowe"></a>
            												
            												
            													<input type="hidden" name="lccss_id-<?php echo $j; ?>" value="<?php echo e($speaker->lccss_id); ?>"></td>
            												
            											
            											</tr>
            											<?php $j++ ?>
            											    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            											<?php endif; ?>
            											
            												<tr>
            												    	<td><input class="form-control" type="text" name="new_stime-<?php echo $j; ?>" autocomplete="off" id="new_stime-<?php echo $j; ?>" value=""   placeholder="Session Time"></td>
            												    	<td><input class="form-control" type="text" name="new_scname-<?php echo $j; ?>" autocomplete="off" id="new_scname-<?php echo $j; ?>" value=""   placeholder="Company Name"></td>
            												<td><input class="form-control" type="text" name="new_sname-<?php echo $j; ?>" autocomplete="off" id="new_sname-<?php echo $j; ?>" value=""   placeholder="Full Name"></td>
            												<td><input class="form-control" type="text" name="new_sdesig-<?php echo $j; ?>" autocomplete="off" id="new_sdesig-<?php echo $j; ?>" value=""   placeholder="Designation"></td>
            													<td><input class="form-control" type="text" name="new_sdesc-<?php echo $j; ?>" autocomplete="off" id="new_sdesc-<?php echo $j; ?>" value=""   placeholder="Description"></td>
            												<td>&nbsp;</td>
            												<td><input class="form-control" type="file" name="new_spic-<?php echo $j; ?>" autocomplete="off" id="new_spic-<?php echo $j; ?>" value=""  ></td>
            											
            												<td class="text-danger"><a class="fa fa-trash delete-rowe"></a>
            												<input type="hidden" value=""></td>
            											</tr>
            											
            											
            										</tbody>
            									</table>
            								</div>
            								<div class="" align="center">
            									<input type="hidden" name="row_count_nspeaker" id="row_count_nspeaker" value="<?php echo $j; ?>">
            									<input type="hidden" name="template" value="" />
            								</div>
						
						    </div>
                         </div>
                        </div>
                    </div>


		        </div>
		        <div class="modal-footer">
		              <input type="hidden" class="form-control" value="<?php echo e($dataList->lccs_id); ?>" name="lccs_id" id="lccs_id">
		            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="updateCounselorSession()">Update Session</button>
		        </div>
		      </form>

<script type="text/javascript">
$(document).ready(function () {
        		$(".add-nspeaker").click(function(){
			var row_val= parseInt($('#row_count_nspeaker').val(), 10);
            row_val +=1;
			$('#row_count_nspeaker').val(row_val);
			var markup = "<tr><td><input class='form-control' type='text' name='new_stime-"+row_val+"' autocomplete='off' id='new_stime-"+row_val+"' value=''   placeholder='Session Time'></td><td><input class='form-control' type='text' name='new_scname-"+row_val+"' autocomplete='off' id='new_scname-"+row_val+"' value=''   placeholder='Company Name'></td><td><input class='form-control' type='text' name='new_sname-"+row_val+"' autocomplete='off' id='new_sname-"+row_val+"' value=''   placeholder='Full Name'></td><td><input class='form-control' type='text' name='new_sdesig-"+row_val+"' autocomplete='off' id='new_sdesig-"+row_val+"' value='' autocomplete='off' value=''   placeholder='designation' ></td><td><input class='form-control' type='text' name='new_sdesc-"+row_val+"' autocomplete='off' id='new_sdesc-"+row_val+"' value=''   placeholder='Description'></td><td>&nbsp;</td><td><input class='form-control' type='file' name='new_spic-"+row_val+"' autocomplete='off' id='new_spic-"+row_val+"' value=''   ></td ><td class='text-danger'><a class='fa fa-trash delete-rowe'></a><input type='hidden' value=''></td></tr>";
            $("#nspeaker").append(markup);	
        });
		

	$(document).on("click", ".delete-rowe", function(e) {
			var del_id=$(this).next('input').val();
			if($.isNumeric(del_id)){
				if (confirm('Do You want to Delete..!!')) {
					$(this).parents("tr").remove();
					$.ajax({
					    headers: {
                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                        },
					type:"post",
					cache:false,
					url:'deletespeaker',
					data: "del_id="+del_id,
					success:function(data)
					{
					console.log("success");
						
					}					
					
				});
					
				} else {
					
				}
			}else{
				$(this).parents("tr").remove();
			}
        });
											       
});			
 </script>

		     
              <?php /**PATH /home/eventsibentos/public_html/admin/resources/views/lpage/editcareersessions.blade.php ENDPATH**/ ?>