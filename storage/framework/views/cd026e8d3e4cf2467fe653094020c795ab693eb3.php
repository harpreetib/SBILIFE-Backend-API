		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Custom Field</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <form  name="editcustomfields" id="editcustomfields" class="" action="" method="post">
		              <?php echo e(csrf_field()); ?>

		              
		        <div class="modal-body">
		    <div class="card mb-4">
                                <div class="card-body">
                                <div class="row ">
                                
                                        
                                  <div name="div_add_field" id="div_add_field"  >
        						
        								<div class="col-md-12">
        									<h5><b>Add New Custom Field:</b></h5>
        								</div>
        						
                             
            								<div>
            									<table class="table table-bordered table-striped" align="center">
            										<thead>
            											<tr>
            											    <th>Field Label</th>
            											    <th>Field Type</th>
            											    <th>Field Value<sup style="color:red;"> For Select Dropdown Only</sup></th>
            												<th>Is Mandatory ?<span style="color:red;">*</span></th>
            												<th>Action</th>
            											</tr>
            										</thead>
            										<tbody id="nfield">
            											<?php $j=0; ?>
            											<tr>
        											        <td><input class="form-control" type="text" name="eflabel-<?php echo $j; ?>" autocomplete="off" id="eflabel-<?php echo $j; ?>" value="<?php echo e($cust->rfc_label); ?>"   placeholder="Field Label"></td>
            											    <td><select class="form-control" name="eftype-<?php echo $j; ?>" id="eftype-<?php echo $j; ?>" >
            											        <?php $__currentLoopData = $fieldType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        											                <option value="<?php echo e($ft->rft_type); ?>" <?php echo ($cust->rfc_type == $ft->rft_type) ? 'selected' : '' ?>><?php echo e($ft->rft_name); ?></option>
            											        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            											    <td>
            											        <input class="form-control" type="text" name="efvalue-<?php echo $j; ?>" autocomplete="off" id="efvalue-<?php echo $j; ?>" value="<?php echo e($cust->rfc_values); ?>"   placeholder="Values" readonly>
            											        <button type="button" class="btn btn-info"   onclick="setCopyFnEdit('efvalue-<?php echo $j; ?>','<?php echo e($cust->rfc_id); ?>');">Add/Edit Options</button>
            											    </td>
            												<td><label class="switch"><input type="checkbox" name="efreq-<?php echo $j; ?>" id="efreq-<?php echo $j; ?>" <?php echo ($cust->is_mandatory == 'on') ? 'checked' : '' ?> ><span class="slider round"></span></label></td>
            												<td class="text-danger"><a class="i-Close delete-rowe"></a>
            												<input type="hidden" name="rfc_id-<?php echo $j; ?>" value="<?php echo e($cust->rfc_id); ?>"></td>
            											</tr>
            										</tbody>
            									</table>
            								</div>
            								<div class="" align="center">
            									<input type="hidden" name="row_count_nfield" id="row_count_nfield" value="<?php echo $j; ?>">
            								</div>
						
						    </div>
                         </div>
                        </div>
                    </div>


		        </div>
		        
		        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ladda-button basic-ladda-button " data-style="expand-right" onclick="updateCustomField()">Update</button>
                </div>
                
		      </form>

<script type="text/javascript">

	$(document).on("click", ".delete-rowe", function(e) {
			var rfc_id=$(this).next('input').val();
			var reqText = 'inactive';
			var reqColumn = 'rfc_status';
			
			
			if($.isNumeric(rfc_id)){
				if (confirm('Do You want to Delete..!!')) {
					$(this).parents("tr").remove();
					$.ajax({
					    headers: {
                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                        },
					type:"post",
					cache:false,
					url:'cfToggle',
					data: {'rfc_id':rfc_id,'reqText':reqText,'reqColumn':reqColumn},
					success:function(data)
					{
					console.log("success");
						
					}					
					
				});
					
				// 	setTimeout(function(){ window.location.reload(); }, 3000);
                //  return false;
					
				} else {
					
				}
			}else{
				$(this).parents("tr").remove();
			}
    });	
 </script>

		     
              <?php /**PATH /home/eventsibentos/public_html/admin/resources/views/lpage/editcustomfields.blade.php ENDPATH**/ ?>