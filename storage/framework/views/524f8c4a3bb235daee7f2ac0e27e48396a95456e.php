<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">
<!-- multiselect CSS -->	
<link rel="stylesheet" href="https://ied.ibentos.com/landing-page/css/my-multiselect.css">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" />
<!--<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">-->
<!--<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">-->
<style>
    .multiselect-selected-text{width: 100%!important}
     
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Manage</h1>
                <ul>
                  <li>Registration Page</li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            <h4>Common Fields</h4>
            <div class="row mb-4">
                
                <?php $__currentLoopData = $commonFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
                   <?php   
                    $reqtext="active";
                    $checked="";
                    $status = "Disabled";
                   ?>
                   <?php $__currentLoopData = $commonFieldsMapp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cfm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($cfm->rfm_id == $cf->rfm_id): ?>
                      <?php 
                            if($cfm->rfmm_status=='active'){
                              $reqtext="inactive";  
                              $checked="checked";
                              $status = "Enabled";
                            }
                            
                             break;
                      ?>  
                    <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
                <div class="col-lg-3 mb-3">
                    <div class="card card-body ul-border__bottom">
                        <div class="text-center">
                            <h5 class="heading text-primary"><?php echo e($cf->rfm_name); ?></h5>
                            <p class="mb-3  text-primary"><i class="i-Big-Data ul-accordion__font"> </i></p>
                                <label class="switch switch-success mr-3">
                                    <span id="cf_st_<?php echo e($cf->rfm_id); ?>"><?php echo e($status); ?></span>
                                     <input type="checkbox" id="cf_<?php echo e($cf->rfm_id); ?>" name="cf_<?php echo e($cf->rfm_id); ?>" onclick="fieldToggle(`<?php echo e($cf->rfm_id); ?>`,`<?php echo e($reqtext); ?>`);" <?php echo e($checked); ?> >
                                    <span class="slider"></span>
                                </label>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            <div class="col-md-12 mb-3">

                    <h4>
                    <a href="#" class="float-right"  data-toggle="modal" data-target="#fieldModal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Custom Fields</button></a>
                    <h4>
            </div>
            
            


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table-responsive">
                              <div class="row ">
                                  <div class="col-md-12">

    <!--<form method="post" action="<?php echo e($_SERVER['REQUEST_URI']); ?>" id="pageInput">-->
    <!--    <div class="row pagination-bar">-->
    <!--        <div class="col-12 col-md-7">-->
    <!--            <div class="form-group mt-3">-->
    <!--                <?php echo csrf_field(); ?>-->
    <!--                <div class="d-flex flex-row">-->
    <!--                    <div class="mr-2">-->
    <!--                    <select class="custom-select" name="pagination" id="pagination"-->
    <!--                                onchange="this.form.submit();">-->
    <!--                                <option value="10">-->
    <!--                                    10-->
    <!--                                </option>-->
    <!--                        </select>-->
    <!--                    </div>-->
                      <!-- code goes here -->

    <!--                </div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    <div class="col-md-3">-->
    <!--    &nbsp;-->
    <!--    </div>-->
    <!--        <div class="col-md-2 mt-3">-->
    <!--      <div class="form-group ">-->
    <!--          <i class="seacrh-icon"></i>-->
    <!--          <input type="text" class="form-control seacrh-field pl-4" name="search_text" placeholder="Search"  autocomplete="off" value="<?php if(isset($_REQUEST['search_text']) && !empty($_REQUEST['search_text'])){ echo$_REQUEST['search_text']; } ?>" onchange="this.form.submit();">-->

    <!--      </div>-->
    <!--  </div>-->

    <!--    </div>-->
    <!--</form>-->

  <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            	<tr>
            	<th scope="col">#</th>
            	<th scope="col">Custom Fields</th>
            	<th scope="col">Input Type</th>
            	<th scope="col">Values</th>
            	<th scope="col">Is Mandatory</th>
            	<th scope="col">Status</th>
            	<th scope="col">Action</th>
            	</tr>
            </thead>
            <tbody>
              
             <?php
            	$i=1
            	?>
            		
        		<?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            	<tr>
            		<th scope="row"><?php echo e($i++); ?></th>
        		    <td><?php echo e($cust->rfc_label); ?></td>
        		    <td><?php echo e($cust->rfc_type); ?></td>
        		    <td>
        		        <?php if($cust->rfc_values !== null): ?>
            				<?php echo e($cust->rfc_values); ?>

        				<?php else: ?>
            				----
        				<?php endif; ?>
        		    </td>
        		    <td>
        		        <?php if($cust->is_mandatory == 'on'): ?> 
            				    <label class="switch">
                                  <input type="checkbox" id="cf_mandatory_<?php echo e($cust->rfc_id); ?>" onclick="cfToggle(`<?php echo e($cust->rfc_id); ?>`,`off`,`is_mandatory`);" checked>
                                  <span class="slider round"></span>
                                </label>
                        <?php else: ?>
                                <label class="switch">
                                  <input type="checkbox" id="cf_mandatory_<?php echo e($cust->rfc_id); ?>" onclick="cfToggle(`<?php echo e($cust->rfc_id); ?>`,`on`,`is_mandatory`);">
                                  <span class="slider round"></span>
                                </label>
                        <?php endif; ?>
        		    </td>
        		    <td>
        		        <?php if($cust->rfc_status == 'active'): ?>
            				    <label class="switch">
                                  <input type="checkbox" id="cf_status_<?php echo e($cust->rfc_id); ?>" onclick="cfToggle(`<?php echo e($cust->rfc_id); ?>`,`inactive`,`rfc_status`);" checked>
                                  <span class="slider round"></span>
                                </label>
                        <?php else: ?>
                                <label class="switch">
                                  <input type="checkbox" id="cf_status_<?php echo e($cust->rfc_id); ?>" onclick="cfToggle(`<?php echo e($cust->rfc_id); ?>`,`active`,`rfc_status`);">
                                  <span class="slider round"></span>
                                </label>
                        <?php endif; ?>
        		    </td>
        		    <td>
				        <a href="javascript:void(0);" class="text-success mr-2" onclick="cfEdit(`<?php echo e($cust->rfc_id); ?>`);">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                        <div class="divide">
                            <select id="orderbyId"  name="orderbyId" onchange="callOrderBy(this.value, '<?php echo e($cust->rfc_id); ?>');">
                                <option value="" >Select Order By</option>
                                <?php for($or=1; $or<=10; $or++): ?>
                                <?php
                                    $selectedOrderBy="";
                                    if($cust->rfc_orderby==$or){
                                       $selectedOrderBy="selected"; 
                                    }
                                ?>
                                    <option value="<?php echo e($or); ?>" <?php echo e($selectedOrderBy); ?>><?php echo e($or); ?></option>
                                <?php endfor; ?>
                         </select>
                        </div>
        		    </td>
            	</tr>
            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
             
  </div>
</div>
   <!--<div class="col-md-12">-->

   <!--  <div class="col-md-6  text-right"></div>-->
   <!--</div>-->


</div>
</div>

</div>
</div>
</div>
<!-- end of col -->

</div>
<!-- end of row -->



<!-- FIELD MODAL -->
 <div class="modal fade" id="fieldModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 65%!important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add New Custom Field</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addcustomfield" id="addcustomfield" class="" action="" method="post"  enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">


                        <div class="card mb-4">
                                <div class="card-body">
                                <div class="row ">
                                  <div name="div_add_field" id="div_add_field"  >
        						
        								<div class="col-md-6">
        									<h5><b>Add New Custom Field:</b></h5>
        								</div>
        								<div class="col-md-6 float-right" >
        									<button type="button" class="btn btn-info add-field" id="addfield" name="addfield">Add Row</button>
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
            										<tbody id="field">
            											<?php $j=0;?>
            											<tr>
        											        <td><input class="form-control" type="text" name="flabel-<?php echo $j; ?>" autocomplete="off" id="flabel-<?php echo $j; ?>" value=""   placeholder="Field Label"></td>
            											    <td><select class="form-control" name="ftype-<?php echo $j; ?>" id="ftype-<?php echo $j; ?>" >
                											        <option value="">Select Field Type</option>
                											        <?php $__currentLoopData = $fieldType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                											            <option value="<?php echo e($ft->rft_type); ?>"><?php echo e($ft->rft_name); ?></option>
                											        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            											        </select>
        											        </td>
            											    <td>
            											        <input class="form-control" type="text" name="fvalue-<?php echo $j; ?>" autocomplete="off" id="fvalue-<?php echo $j; ?>" value=""   placeholder="Values" readonly>
            											        <!--<small style="color:red;">Like : Apple,Mango,Grapes</small>-->
            											        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#optModal" onclick="setCopyFn('fvalue-<?php echo $j; ?>');">Add Options</button>
            											    </td>
            												<td><label class="switch"><input type="checkbox" name="freq-<?php echo $j; ?>" id="freq-<?php echo $j; ?>" ><span class="slider round"></span></label></td>
            												<td class="text-danger"><a class="i-Close delete-row"></a>
            												<input type="hidden" value=""></td>
            											</tr>
            										</tbody>
            									</table>
            								</div>
            								<div class="" align="center">
            									<input type="hidden" name="row_count_field" id="row_count_field" value="<?php echo $j; ?>">
            								</div>
						
						    </div>
                         </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button " data-style="expand-right" onclick="AddCustomField()">Save</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            </div>
<!--FIELD MODAL END -->


<!-- EDIT CUSTOM FIELD MODAL -->
        <div class="modal fade" id="editCustomField" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
               <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 65%!important;">
                   <div class="modal-content" id="CustomField">
                       
                       
                       
                   </div>
               </div>
           </div>
 <!--EDIT CUSTOM FIELD MODAL END -->
 
 <!-- OPTION MODAL -->
 <div class="modal fade" id="optModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 30%!important;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add Option Values</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="emptyOpt();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addoptions" id="addoptions" class="" action="" method="post"  enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">


                        <div class="card mb-4">
                                <div class="card-body">
                                <div class="row ">
                                  <div name="div_add_opt" id="div_add_opt"  >
        						
        								<div class="col-md-6">
        									<h5><b>Add Option Values</b></h5>
        								</div>
        								<div class="col-md-6 float-right" >
        									<button type="button" class="btn btn-info add-option" id="addoption" name="addoption">Add Option</button>
        								</div>
        						
                             
            								<div>
            									<table class="table table-bordered table-striped" align="center">
            										<thead>
            											<tr>
            											    <th>Option Value</th>
            												<th>Action</th>
            											</tr>
            										</thead>
            										<tbody id="options">
            											<tr>
            											    <td>
            											        <input class='form-control' type='text' name='opt[]' autocomplete='off' value=''   placeholder='Enter Option Value'>
        											        </td>
        											        <td class='text-danger'>
        											            <a class='i-Close delete-opt'></a>
        											            <input type='hidden' value=''>
    											            </td>
											            </tr>
            										</tbody>
            									</table>
            								</div>
						
						    </div>
                         </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="emptyOpt();">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button " id="copyArr" data-style="expand-right" data-dismiss="modal" onclick="copyArray();">Save</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            </div>
<!--FIELD MODAL END -->


<!-- EDIT CUSTOM FIELD OPTION MODAL -->
        <div class="modal fade" id="editCustomFieldOpt" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
               <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 30%!important;">
                   <div class="modal-content" id="CustomFieldOpt">
                       
                       
                       
                   </div>
               </div>
           </div>
 <!--EDIT CUSTOM FIELD OPTION MODAL END -->


<?php $__env->startSection('page-js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        		$(".add-field").click(function(){
			var row_val= parseInt($('#row_count_field').val(), 10);
            row_val +=1;
			$('#row_count_field').val(row_val);
			
			var optval = <?php foreach($fieldType as $ft){ ?>
			 +'<option value="<?php echo $ft->rft_type ?>"><?php echo $ft->rft_name ?></option>'
			<?php } ?> ;
			
			var optvals = optval.replace('NaN', '')
			
			var markup = "<tr><td><input class='form-control' type='text' name='flabel-"+row_val+"' autocomplete='off' id='flabel-"+row_val+"' value=''   placeholder='Field Label'></td><td><select class='form-control' name='ftype-"+row_val+"' id='ftype-"+row_val+"'><option value=''>Select Field Type</option>"+optvals+"</select></td><td><input class='form-control' type='text' name='fvalue-"+row_val+"' autocomplete='off' id='fvalue-"+row_val+"' value=''   placeholder='Values' readonly><button type='button' class='btn btn-info' data-toggle='modal' data-target='#optModal' onclick='setCopyFn(`fvalue-"+row_val+"`);'>Add Options</button></td><td><label class='switch'><input type='checkbox' name='freq-"+row_val+"' id='freq-"+row_val+"' ><span class='slider round'></span></label></td><td class='text-danger'><a class='i-Close delete-row'></a><input type='hidden' value=''></td></tr>";
            $("#field").append(markup);
            // console.log(markup);
        });
		


											       
        // Find and remove selected table rows
        
		$(document).on("click", ".delete-row", function(e) {
			var del_id=$(this).next('input').val();
			if($.isNumeric(del_id)){
				if (confirm('Do You want to Delete')) {
					$(this).parents("tr").remove();
					$.ajax({
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




function fieldToggle(rfm_id,reqText){
                
                Swal.fire({  
                  title: 'Are you sure, you want to change status ?',  
                  showDenyButton: true,
                //   showCancelButton: true,  
                  confirmButtonText: `Yes`,  
                  denyButtonText: `No`,
                }).then((result) => {  

                    if (result.isConfirmed) {    
                                    $.ajax({
                                    headers: {
                                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                                        },
                                    type: 'POST',
                                    url: 'fieldToggle',
                                    data: {'rfm_id':rfm_id,'reqText':reqText},
                                    success: function (data) {
                                    	Swal.fire('Changed !', '', 'success')    
                                    	if(reqText == 'active'){
                                        	$("#cf_"+rfm_id).attr('onclick', 'fieldToggle(`'+rfm_id+'`,`inactive`)');    
                                        	$("#cf_st_"+rfm_id).text('Enabled');
                                    	}else{
                                        	$("#cf_"+rfm_id).attr('onclick', 'fieldToggle(`'+rfm_id+'`,`active`)');
                                        	$("#cf_st_"+rfm_id).text('Disabled');
                                    	}
                                        // 	setTimeout(function(){ window.location.reload(); }, 1000);
                                        //     return false;
                                            }
                                });
                    } else if (result.isDenied) {    
                    	Swal.fire('Cancelled', '', 'info')  
                    	if(reqText=='active'){
                                $("#cf_"+rfm_id).prop("checked", false);
                              }else  if(reqText=='inactive'){
                                $("#cf_"+rfm_id).prop("checked", true); 
                              }
                        if(reqText=='active'){
                                $("#ecf_"+rfm_id).prop("checked", false);
                              }else  if(reqText=='inactive'){
                                $("#ecf_"+rfm_id).prop("checked", true); 
                              }
                 	}
                });
                
            }


function AddCustomField(){
    
              $("#addcustomfield").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'add_custom_field',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                      if (response==true) {
                    Swal.fire({
                          type: 'success',
                          title: 'Success!',
                          text: ' Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  }
                      setTimeout(function(){ window.location.reload(); }, 3000);
                      return false;
                       
                    }
                });
            });
}




function cfToggle(rfc_id,reqText,reqColumn){
                
                Swal.fire({  
                  title: 'Are you sure, you want to change status ?',  
                  showDenyButton: true,
                //   showCancelButton: true,  
                  confirmButtonText: `Yes`,  
                  denyButtonText: `No`,
                }).then((result) => {  

                    if (result.isConfirmed) {    
                                    $.ajax({
                                    headers: {
                                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                                        },
                                    type: 'POST',
                                    url: 'cfToggle',
                                    data: {'rfc_id':rfc_id,'reqText':reqText,'reqColumn':reqColumn},
                                    success: function (data) {
                                    	Swal.fire('Changed !', '', 'success')    
                                        	setTimeout(function(){ window.location.reload(); }, 1000);
                                            return false;
                                            }
                                });
                    } else if (result.isDenied) {    
                    	Swal.fire('Cancelled', '', 'info')  
                    	if(reqText=='active'){
                                $("#cf_status_"+rfc_id).prop("checked", false);
                              }else  if(reqText=='inactive'){
                                $("#cf_status_"+rfc_id).prop("checked", true); 
                              }else if(reqText=='on'){
                                $("#cf_mandatory_"+rfc_id).prop("checked", false);
                              }else  if(reqText=='off'){
                                $("#cf_mandatory_"+rfc_id).prop("checked", true); 
                              }
                 	}
                });
                
            }

function cfEdit(rfc_id){
                //alert(rfc_id);return false;

                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                        },
                        method:"POST",
                        url: "cfEdit",
                        data: {'rfc_id':rfc_id},
                        success: function (data) {
                            $('#CustomField').html(data);
                            $('#editCustomField').modal('toggle')  
                                
                            }
                        });
            }
            
            
function updateCustomField(){
        
		  $("#editcustomfields").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'update_custom_field',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){
               
                   
                }
            });
            
             Swal.fire({
                      type: 'success',
                      title: 'Success!',
                      text: ' Field Updated Successfully',
                      buttonsStyling: false,
                      confirmButtonClass: 'btn btn-lg btn-success'
                  })
                  
                  setTimeout(function(){ window.location.reload(); }, 3000);
                  return false;
        });
			
			
    }

function callOrderBy(orderVal,rfc_id){
           
            if(rfc_id){
                $.ajax({
                   headers: {
                            'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
                        },
                   type:"POST",
                   url:"requesttosetorderby",
                   data: "orderVal="+orderVal+"&rfc_id="+rfc_id,
                   success:function(res){               
                        Swal.fire({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Saved Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                   }
                });
            }   
    }






$(document).ready(function () {
	$(".add-option").click(function(){
	var markup = "<tr><td><input class='form-control' type='text' name='opt[]' autocomplete='off' value=''   placeholder='Enter Option Value'></td><td class='text-danger'><a class='i-Close delete-opt'></a><input type='hidden' value=''></td></tr>";
    $("#options").append(markup);
    // console.log(markup);
});
		


											       
        // Find and remove selected table rows
        
		$(document).on("click", ".delete-opt", function(e) {
			var del_id=$(this).next('input').val();
			if($.isNumeric(del_id)){
				if (confirm('Do You want to Delete')) {
					$(this).parents("tr").remove();
					$.ajax({
					type:"post",
					cache:false,
					url:'deleteoption',
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

function copyArray(id){
    
    var values = [];
    $("input[name='opt[]']").each(function() {
        values.push($(this).val());
    });
    
    
        let str = "";
        
        values.forEach((val, key, arr) => {
        
            if(val != '' && val != ' '){
                str += val ;
                if (Object.is(arr.length - 1, key)) {
                    str += '';
                }else{
                    str += '^';
                }   
            }
        });
    
    document.getElementById(id).value = str;
    
    console.log(str);
    
    $("input[name='opt[]']").val('');
    
}

function setCopyFn(id){
    $("#copyArr").attr('onclick', 'copyArray(`'+id+'`)');
}

function setCopyFnEdit(id,rfc_id){
    
        if(id == 'efvalue-0'){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(@csrf_token()); ?>'
            },
            method:"POST",
            url: "cfEditOpt",
            data: {'rfc_id':rfc_id},
            success: function (data) {
                $('#CustomFieldOpt').html(data);
                $('#editCustomFieldOpt').modal('toggle');
                $("#copyArrEdit").attr('onclick', 'copyArray(`'+id+'`)');
            }
        });    
    }

}


function emptyOpt(){
    $("input[name='opt[]']").val('');
}

</script>

<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/lpage/manage-registration-page.blade.php ENDPATH**/ ?>