<?php $__env->startSection('page-css'); ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/ladda-themeless.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/sweetalert2.min.css')); ?>">


<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
<style>
    .multiselect-container .checkbox input{    position: inherit;
    opacity: 1;
    height: auto;
    width: auto;}
    
    .my-multiselect .btn-default {
      background: #f8f9fa;
    border: 1px solid #ced4da;
    color: #47404f;
    padding: 6px 10px 2px 10px;
    height: auto;
    width:100%;

    border-radius: 4px !important;
}
.breadcrumb ul li {
    display: inline;
    position: relative;
    padding: 0 0.5rem;
    line-height: 1;
    vertical-align: bottom;
    color: #70657b;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Manage Lobby Banners</h1>
                <ul>
                  <li><a href="managelobby">View List</a></li>
                  <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="managelobby" onsubmit="return validateForm()">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                        
                        

                            <div class="col-md-3 form-group mb-3">
                                <select class="form-control" id="cat_id" name="cat_id">
                                  <option value=""> Select Banner Category</option>
                                    <?php foreach($category as $detail){ ?>
                                    <option value="<?php echo e($detail->bcm_id); ?>" <? if($detail->bcm_id==$bcm_id){ echo 'selected'; } ?> ><?php echo e($detail->bcm_name); ?></option>
                                    <?php } ?>
                                   </select>
                           </div>
                           
                           
                             
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
            
            <div class="row">
                <!-- ICON BG -->
                <?php $__currentLoopData = $bannerCount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerD): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-icon mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-File"></i>
                            <p class="text-muted mt-2 mb-2"><?php echo e($bannerD->bcm_name); ?></p>
                            <p class="text-primary text-24 line-height-1 m-0"><?php echo e($bannerD->total); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="row mb-4">
            <div class="col-md-12 mb-3 d-none">
                <h4>  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Banner</button></a><h4> 
            </div>

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
                        <select class="custom-select" name="pagination" id="pagination" onchange="this.form.submit();">
                            <option value="10"  <?php if($leadList->perPage() == 10): ?> selected    <?php endif; ?> > 10 </option>
                            <option value="25"  <?php if($leadList->perPage() == 25): ?> selected    <?php endif; ?> > 25 </option>
                            <option value="50"  <?php if($leadList->perPage() == 50): ?> selected    <?php endif; ?> > 50 </option>
                            <option value="75"  <?php if($leadList->perPage() == 75): ?> selected    <?php endif; ?> > 75 </option>
                            <option value="100" <?php if($leadList->perPage() == 100): ?> selected   <?php endif; ?>  > 100 </option>
                            <option value="200" <?php if($leadList->perPage() == 200): ?> selected   <?php endif; ?> > 200 </option>
                            <option value="500" <?php if($leadList->perPage() == 500): ?> selected   <?php endif; ?> > 500 </option>
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
                    <th scope="col">Banner Image</th>
                    <th scope="col">Banner Caption</th>
                    <th scope="col">Banner Category</th>
                    <th scope="col">Width</th>
                    <th scope="col">Height</th>           
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
				 <?php
				    $eventNickName=(isset(Session::get('selectedEvent')->aem_event_nickname) ? Session::get('selectedEvent')->aem_event_nickname : 'v1');
                    $i=1
                    ?>
                    <?php if(isset($leadList) && !empty($leadList)): ?>
                        <?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                    <tr>
                        <th scope="row"><?php echo e($i++); ?></th>
                        <td><img src="<?php echo e($list->bm_banner); ?>" style="max-width:30%;"></td>
                        <td id="plan<?php echo e($list->bcm_id); ?>"><?php echo e($list->bm_caption); ?></td>
                        <td id="plan<?php echo e($list->bcm_id); ?>"><?php echo e($list->bcm_name); ?></td>
                        
                        <td><?php echo e($list->bcm_banner_width); ?></td>
                        <td><?php echo e($list->bcm_banner_height); ?></td>
                        
                       
                        <td>
                            <a href="javascript:void(0);" class="text-success mr-2" onclick="addEditBannerDetails('<?php echo e($list->bm_id); ?>','<?php echo e($list->bcm_id); ?>');">
                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr><th scope="row" >Empty record!</th></tr>
                   <?php endif; ?>
                </tbody>
             </table>
             
  </div>
</div>
   <div class="col-md-12">

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
                                        Displaying <?php echo e($leadList->count()); ?> of <?php echo e($leadList->total()); ?> banner(s).
                                        </p>
                                  </div>
   </div>


</div>
</div>

</div>
</div>
</div>


<div class="modal fade" id="photosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="max-width:60%;">
                    <div class="modal-content">
                        <form name="photouploadform" id="photouploadform" class="" action="AddLobbybanner" method="post"  enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalCenterTitle-2">  <h4 id="up-photo">Upload Banner Image</h4></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="restDiv();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="row" id="mCaption">
                                            <div class="col-md-12 form-group" >
                                                 <label>  Caption</label>
                                                 <input class="form-control " type="text" name="egcaption" id="egcaption" required/>
                                                   <!--Exhibitor Picture  <span style="color: #ed3838;">[Choose File 550 × 280 pix]</span>-->
                                                  <span class="text-danger" id="err_iCaption_cfy"  style="display:none;"></span>
                                            </div>
                                            
                                             <div class="form-group col-md-6 mb-3 d-none">
                                                    <label for="egcategory">Image Category</label>
                                                    <select name="egcategory" id="egcategory" class="custom-select form-control" required>
                                                        <option value="" class="dropdown-item" >Select Category</option>
                                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gCategoty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($gCategoty->bcm_id); ?>" opt-width="<?php echo e($gCategoty->bcm_banner_width); ?>" opt-height="<?php echo e($gCategoty->bcm_banner_height); ?>" class="dropdown-item" ><?php echo e($gCategoty->bcm_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                      
                                                    <span class="text-danger" id="err_iCategory_cfy"  style="display:none;"></span>
                                            </div>
                                    </div>
                                    
                                  
                                    <div class="form-group">
                                        <label id="wbaner"> Web banner</label>
                                        <div class="input-group mb-2">
                                                <input class="form-control d-none" type="file" name="upload_logo" id="upload_logo" accept="image/*" required />
                                                <input class="form-control d-none" type="file" name="upload_photo" id="upload_photo" accept="image/*" required />
                                                <input class="form-control d-none" type="file" name="upload_photo_2" id="upload_photo_2" accept="image/*" required />
                                                <input class="form-control d-none" type="file" name="upload_photo_3" id="upload_photo_3" accept="image/*" />
                                                <input type="hidden" name="logoimage" id="logoimage" value="">
                                                <input type="hidden" name="photoupload" id="photoupload" value="photoupload">
                                        </div>
                                        
                                        <input type="hidden" name="eg_id" id="eg_id" value="">
                                        <input type="hidden" name="eg_name" id="eg_name" value="">
        
                                        <div  id="instructionDiv" style="padding-top: 6px;">Note: Maximum 8 pictures can be uploaded</div>
                                    </div>
                                    
                                   <div class="col-md-12 d-none" id="logocropdiv" >
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="logo-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12 d-none" id="photocropdiv" >
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="photo-demo"  style="overflow-y: scroll; overflow-x: scroll;" ></div>
                                        	<div class="col-md-12 d-none" id="photo-demo-2"  style="overflow-y: scroll; overflow-x: scroll;" ></div>
                                        	<div class="col-md-12 d-none" id="photo-demo-3"  style="overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="appendcropdiv">
                                          <span class="btn btn-primary" id="logocrop-result">Crop</span>
                                      </div>
                                      
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="photoappendcropdiv">
                                          <span class="btn btn-primary" id="photocrop-result">Crop</span>
                                          <span class="btn btn-primary d-none" id="photocrop-result-2">Crop</span>
                                          <span class="btn btn-primary d-none" id="photocrop-result-3">Crop</span>
                                      </div>
                                  
                                  <div class="col-md-12" id="bmDiv"></div>
                                   
                                 <div class="form-group d-none" id="mbanner">
                                     <label> mobile banner</label>
                                       <input class="form-control " type="file" name="upload_mbanner" id="upload_mbanner" />
                                       Exhibitor Picture  <span style="color: #ed3838;">[Choose File 550 × 280 pix]</span>
                                </div>

                                </div>
                                
                                
                                <div class="modal-footer">
                                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                    <input type="hidden" name="page" value="<?php echo e(request('page')!=NULL ? request('page') : ''); ?>">
                                    <input type="hidden" name="bm_id" id="bm_id" value="">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



  <script src="<?php echo e(asset('assets/js/vendor/sweetalert2.min.js')); ?>"></script>
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    

    $('#upload_photo').on('change', function () {
        console.log('upload photo');
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCrop.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
        }
        reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
            type: 'success',
            title: 'Image Crop',
            text: 'Please Click on "Crop button" to crop the image',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
        })
    });

    /*  photo image crop */
    $photoCrop = $('#photo-demo').croppie({
        enableExif: true,
        viewport: {
            width: 512,
            height: 300,
            type: 'square'
        },
        boundary: {
            width: 600,
            height: 400
        },enableResize: false
        
    });

    $('#photocrop-result').on('click', function (ev) {
    	$photoCrop.croppie('result', {
    		type: 'canvas',
    		size: 'viewport'
    	}).then(function (resp) {
    	    
    	    $('#logoimage').val(resp);
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Cropped Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    
    	});
    
    });  
    
    

    /*  backdrop image crop */
    $logoCrop = $('#logo-demo').croppie({
        enableExif: true,
        viewport: {
             width: <?php if(!empty($w)) { echo ($w); } else { echo '400'; }  ?>,
            height: <?php if(!empty($h)) { echo ($h); } else { echo '210'; }  ?>,
            type: 'square'
        },
        boundary: {
            width: <?php if(!empty($w)) { echo ($w+50); } else { echo '450'; }  ?>,
            height: <?php if(!empty($w)) { echo ($h+50); } else { echo '250'; }  ?>
        },enableResize: false
        
    });
    
    
    $('#upload_photo_2').on('change', function () {
        console.log('check11');
  
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCrop2.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
        }
        reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
            type: 'success',
            title: 'Image Crop',
            text: 'Please Click on "Crop button" to crop the image',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
        })
    });
    
    /*  photo image crop */
    $photoCrop2 = $('#photo-demo-2').croppie({
        enableExif: true,
        viewport: {
            width: 1024,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 1100,
            height: 300
        },enableResize: false
        
    });
    
    $('#photocrop-result-2').on('click', function (ev) {
    	$photoCrop2.croppie('result', {
    		type: 'canvas',
    		size: 'viewport'
    	}).then(function (resp) {
    	    
    	    $('#logoimage').val(resp);
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Cropped Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    
    	});
    
    });
    
    
    //Pillar Front Branding Croppy
    $photoCrop3 = $('#photo-demo-3').croppie({
        enableExif: true,
        viewport: {
            width: 425,
            height: 850,
            type: 'square'
        },
        boundary: {
            width: 500,
            height: 900
        },enableResize: false
        
    });
    
    $('#upload_photo_3').on('change', function () {
        console.log('upload photo 3');
  
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCrop3.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
        }
        reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
            type: 'success',
            title: 'Image Crop',
            text: 'Please Click on "Crop button" to crop the image',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-danger'
        })
    });
    
    
    $('#photocrop-result-3').on('click', function (ev) {
    	$photoCrop3.croppie('result', {
    		type: 'canvas',
    		size: 'viewport'
    	}).then(function (resp) {
    	    
    	    $('#logoimage').val(resp);
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Cropped Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    
    	});
    
    });
	 

        function Addbanner()
        {    	
        
            $.ajax({
                type: 'POST',
                url: 'AddLobbybanner',
                data: new FormData(ele),
                //dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                      
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: ' Added Successfully',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-lg btn-success'
                    }).then(function(){
                        $('#courseofferedmodal').modal('toggle');
                    });
                            setTimeout(function(){
                                window.location.reload(); 
                            }, 2000);
                    		return false;
                }
            });
        }

    function uploadphotoEvnt(){
        $('#up-photo').html('Upload Banner Image');
        $('#photoupload').val('photoupload');
        $('#instructionDiv').html('Gallery Image <span style="color: #ed3838;">[Choose File 512 x 300 pix]</span>');
         $('#upload_logo').addClass('d-none');
          $('#upload_logo').attr('required', false);
        $('#mCaption').removeClass('d-none');
        $('#egcaption').attr('required', true);
        $('#egcategory').attr('required', true);
       $('#logocropdiv').addClass('d-none');
         $('#photocropdiv').removeClass('d-none');
        $('#upload_photo').removeClass('d-none');
        $('#upload_photo').attr('required', true);
        $('#upload_photo_2').attr('required', false);
        $('#appendcropdiv').addClass('d-none');
         $('#photoappendcropdiv').removeClass('d-none');
        $('#wbaner').html('Choose Image');
        $('#wbaner').removeClass('d-none');
      
        $('#eg_id').val();
        $('#eg_name').val();
    }
    
    
    $("#egcategory").change(function(){
        var width = $(this).find('option:selected').attr("opt-width");
        var height = $(this).find('option:selected').attr("opt-height");
        $('#instructionDiv').html('Gallery Image <span style="color: #ed3838;">[Choose File '+width+' x '+height+' pix]</span>');
        
        if($(this).val() == 4)
        {
            $('#photo-demo').addClass('d-none');
            $('#photo-demo-2').removeClass('d-none');
            $('#photo-demo-3').addClass('d-none'); //pillar branding
            
            $('#upload_photo').addClass('d-none').removeAttr('required');
            $('#upload_photo_2').removeClass('d-none').attr('required','true');
            $('#upload_photo_3').addClass('d-none').removeAttr('required'); //pillar branding
            
            $('#photocrop-result').addClass('d-none');
            $('#photocrop-result-2').removeClass('d-none');
            $('#photocrop-result-3').addClass('d-none'); //pillar branding
            
        }
        else if($(this).val() == 6) //Pillar branding
        {
            $('#photo-demo').addClass('d-none');
            $('#photo-demo-2').addClass('d-none');
            $('#photo-demo-3').removeClass('d-none');
            
            $('#upload_photo').addClass('d-none').removeAttr('required');
            $('#upload_photo_2').addClass('d-none').removeAttr('required','true');
            $('#upload_photo_3').removeClass('d-none').attr('required','true');
            
            $('#photocrop-result').addClass('d-none');
            $('#photocrop-result-2').addClass('d-none');
            $('#photocrop-result-3').removeClass('d-none');
            
        }
        else{
            $('#photo-demo').removeClass('d-none');
            $('#photo-demo-2').addClass('d-none');
            $('#photo-demo-3').addClass('d-none'); //Pillar branding
            
            $('#upload_photo').removeClass('d-none').attr('required','true');
            $('#upload_photo_2').addClass('d-none').removeAttr('required');
            $('#upload_photo_3').addClass('d-none').removeAttr('required'); //Pillar branding
            
            $('#photocrop-result').removeClass('d-none');
            $('#photocrop-result-2').addClass('d-none');
            $('#photocrop-result-3').addClass('d-none'); //Pillar branding
        }
    });
    
    
    function addEditBannerDetails(bmId,bcmd){
        
        if(bmId!='') {
            
            uploadphotoEvnt();
            
            $('#photosmodal').modal('show');
            
            if(bcmd == 4)
            {
                console.log('check11');
                $('#photo-demo').addClass('d-none');
                $('#photo-demo-2').removeClass('d-none');
                $('#photo-demo-3').addClass('d-none'); //pillar branding
                
                $('#photocrop-result').addClass('d-none');
                $('#photocrop-result-2').removeClass('d-none');
                $('#photocrop-result-3').addClass('d-none'); //pillar branding
                
                $('#upload_photo').addClass('d-none').removeAttr('required');
                $('#upload_photo_2').removeClass('d-none').removeAttr('required');
                $('#upload_photo_3').addClass('d-none').removeAttr('required'); //pillar branding
                
            }
            else if(bcmd == 6) //pillar branding
            {
                console.log('check12');
                $('#photo-demo').addClass('d-none');
                $('#photo-demo-2').addClass('d-none');
                $('#photo-demo-3').removeClass('d-none');
                
                $('#photocrop-result').addClass('d-none');
                $('#photocrop-result-2').addClass('d-none');
                $('#photocrop-result-3').removeClass('d-none');
                
                $('#upload_photo').addClass('d-none').removeAttr('required');
                $('#upload_photo_2').addClass('d-none').removeAttr('required');
                $('#upload_photo_3').removeClass('d-none').removeAttr('required');
                
            }
            else{
                console.log('check13');
                $('#photo-demo').removeClass('d-none');
                $('#photo-demo-2').addClass('d-none');
                $('#photo-demo-3').addClass('d-none'); //pillar branding
                
                $('#photocrop-result').removeClass('d-none');
                $('#photocrop-result-2').addClass('d-none');
                $('#photocrop-result-3').addClass('d-none'); //pillar branding
                 
                $('#upload_photo').removeClass('d-none').removeAttr('required');
                $('#upload_photo_2').addClass('d-none').removeAttr('required');
                $('#upload_photo_3').addClass('d-none').removeAttr('required'); //pillar branding
            }
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'EditLobbybanner',
                data: 'bmId='+bmId,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        $('#egcaption').val(result.caption);
                        $('#bm_id').val(bmId);
                        $('#egcategory option[value="'+result.cat_id+'"]').attr('selected', 'true');
                        $('#bmDiv').html("<img src='"+result.img+"' style='max-width:30%;'>")
                    
                        var width = $('#egcategory option[value="'+result.cat_id+'"]').attr("opt-width");
                        var height = $('#egcategory option[value="'+result.cat_id+'"]').attr("opt-height");
                        $('#instructionDiv').html('Gallery Image <span style="color: #ed3838;">[Choose File '+width+' x '+height+' pix]</span>');
                    }
                    else{
                        console.log(result.code);
                    }
                }      
        
            });
        }
    }
    
    function restDiv()
    {
        //do nothing
    }

 </script>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/managelobby/index.blade.php ENDPATH**/ ?>