<?php
    $arrVal = explode('^',$cust->rfc_values);
?>
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Option Values</h4></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="emptyOpt();">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form name="editoptions" id="editoptions" class="" action="" method="post"  enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <div class="modal-body">


    <div class="card mb-4">
            <div class="card-body">
            <div class="row ">
              <div name="div_edit_opt" id="div_edit_opt"  >
			
					<div class="col-md-6">
						<h5><b>Edit Option Values</b></h5>
					</div>
					<div class="col-md-6 float-right" >
						<button type="button" class="btn btn-info add-option-edit" id="editoption" name="editoption">Add Option</button>
					</div>
			
         
						<div>
							<table class="table table-bordered table-striped" align="center">
								<thead>
									<tr>
									    <th>Option Value</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="noptions">
								    <?php $__currentLoopData = $arrVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
									    <td>
									        <input class='form-control' type='text' name='opt[]' autocomplete='off' value='<?php echo e($arr); ?>'   placeholder='Enter Option Value'>
								        </td>
								        <td class='text-danger'>
								            <a class='i-Close delete-opt'></a>
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
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="emptyOpt();">Close</button>
        <button type="button" class="btn btn-primary ladda-button basic-ladda-button " id="copyArrEdit" data-style="expand-right" data-dismiss="modal" onclick="copyArray();">Save</button>
    </div>
  </form>

<script type="text/javascript">


$(document).ready(function () {
	$(".add-option-edit").click(function(){
    	var markup = "<tr><td><input class='form-control' type='text' name='opt[]' autocomplete='off' value=''   placeholder='Enter Option Value'></td><td class='text-danger'><a class='i-Close delete-opt'></a><input type='hidden' value=''></td></tr>";
        $("#noptions").append(markup);
        // console.log(markup);
    });
});	

 </script>

		     
              <?php /**PATH /home/eventsibentos/public_html/admin/resources/views/lpage/editcustomfieldsOpt.blade.php ENDPATH**/ ?>