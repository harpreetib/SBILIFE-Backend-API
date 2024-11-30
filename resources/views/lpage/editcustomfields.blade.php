		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Custom Field</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		        <form  name="editcustomfields" id="editcustomfields" class="" action="" method="post">
		              {{ csrf_field() }}
		              
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
        											        <td><input class="form-control" type="text" name="eflabel-<?php echo $j; ?>" autocomplete="off" id="eflabel-<?php echo $j; ?>" value="{{$cust->rfc_label}}"   placeholder="Field Label"></td>
            											    <td><select class="form-control" name="eftype-<?php echo $j; ?>" id="eftype-<?php echo $j; ?>" >
            											        @foreach($fieldType as $ft)
        											                <option value="{{$ft->rft_type}}" <?php echo ($cust->rfc_type == $ft->rft_type) ? 'selected' : '' ?>>{{$ft->rft_name}}</option>
            											        @endforeach
            											    <td>
            											        <input class="form-control" type="text" name="efvalue-<?php echo $j; ?>" autocomplete="off" id="efvalue-<?php echo $j; ?>" value="{{$cust->rfc_values}}"   placeholder="Values" readonly>
            											        <button type="button" class="btn btn-info"   onclick="setCopyFnEdit('efvalue-<?php echo $j; ?>','{{$cust->rfc_id}}');">Add/Edit Options</button>
            											    </td>
            												<td><label class="switch"><input type="checkbox" name="efreq-<?php echo $j; ?>" id="efreq-<?php echo $j; ?>" <?php echo ($cust->is_mandatory == 'on') ? 'checked' : '' ?> ><span class="slider round"></span></label></td>
            												<td class="text-danger"><a class="i-Close delete-rowe"></a>
            												<input type="hidden" name="rfc_id-<?php echo $j; ?>" value="{{$cust->rfc_id}}"></td>
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
                            'X-CSRF-TOKEN': '{{@csrf_token()}}'
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

		     
              