@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">


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
@endsection

@section('main-content')

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Home Page</h1>
                <ul>
                  <li><a href="managehomepage">View List</a></li>
                  <li>{{ (isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '') }}</li>
                </ul>
                 <div class="ml-auto pr-3">
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="full-screen-icon"><i class="i-Information" ></i></a>
                    <a href="#" data-toggle="tooltip" title="Share Now" class="full-screen-icon"><i class="i-Sharethis" ></i></a>
                    <a href="#" data-toggle="tooltip" title="Fullscreen" class="full-screen-icon"><i class="i-Full-Screen" data-fullscreen=""></i></a>
                </div>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
           
            
            <div class="row mb-4">
              
                @if(count($leadList) < 1)
                <div class="col-md-12 mb-3">
                    <h4>  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add File</button></a><h4> 
                </div>
                @endif


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table-responsive">
                              <div class="row ">
                                  <div class="col-md-12">

    <form method="post" action="{{$_SERVER['REQUEST_URI']}}" id="pageInput">
        <div class="row pagination-bar">
            <div class="col-12 col-md-7">
                <div class="form-group mt-3">
                    @csrf
                    <div class="d-flex flex-row">
                       <div class="mr-2">
                        <select class="custom-select" name="pagination" id="pagination" onchange="this.form.submit();">
                            <option value="10"  @if($leadList->perPage() == 10) selected    @endif > 10 </option>
                            <option value="25"  @if($leadList->perPage() == 25) selected    @endif > 25 </option>
                            <option value="50"  @if($leadList->perPage() == 50) selected    @endif > 50 </option>
                            <option value="75"  @if($leadList->perPage() == 75) selected    @endif > 75 </option>
                            <option value="100" @if($leadList->perPage() == 100) selected   @endif  > 100 </option>
                            <option value="200" @if($leadList->perPage() == 200) selected   @endif > 200 </option>
                            <option value="500" @if($leadList->perPage() == 500) selected   @endif > 500 </option>
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
                    <th scope="col">Metaverse Name</th>
                    <th scope="col">Background Type</th>
                    <th scope="col">File</th>
                    <th scope="col">Form Background Color</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
				 @php
				    $eventNickName=(isset(Session::get('selectedEvent')->aem_event_nickname) ? Session::get('selectedEvent')->aem_event_nickname : 'v1');
                    $i=1
                    @endphp
                    @if(isset($leadList) && !empty($leadList))
                        @foreach($leadList as $list)
                        
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{ucfirst($list->meta_name)}}</td>
                        <td id="plan{{$list->ehc_id}}">{{ucfirst($list->hp_type)}}</td>
                        <td>
                            @if($list->hp_type=='video')
                            <a href="{{$list->bg_video}}" target="_blank" class="btn btn-outline-success">View</a>
                            @else
                            <img src="{{$list->logo}}" style="width:300px;"/>
                            @endif
                        </td>
                        <td><div style="background-color: {{$list->ehc_color_code}}; height: 40px; width: 60px;"></div></td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-outline-primary mr-2" onclick="addEditBannerDetails('{{$list->ehc_id}}');">
                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr><th scope="row" >Empty record!</th></tr>
                   @endif
                </tbody>
             </table>
             
  </div>
 <!-- <div>-->
 <!--     <h3 class="font-weight-bold">Preview</h3>-->
 <!-- </div>-->
 <!-- <div class="preview-section">-->
 <!--   <iframe id="unityIframe" src="https://megaspace.ai/{{$bm_name}}/" width="100%" height="500"></iframe>-->
 <!--</div>-->
</div>
   <div class="col-md-12">

     <div class="col-md-6  text-right">{{$leadList->onEachSide(2)->appends(request()->except('page'))->links()}}</div>
   </div>


</div>
</div>

</div>
</div>
</div>


<div class="modal fade" id="photosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="max-width:60%;">
                    <div class="modal-content">
                        <form name="photouploadform" id="photouploadform" class="" action="addhomepagecontent" method="post"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalCenterTitle-2">  <h4 id="up-photo">Add/Edit Home Page Content</h4></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="restDiv();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="row" id="mCaption">
                                        <div class="col-md-6  form-group" >
                                         <label>Metaverse Name</label>
                                         <input class="form-control " type="text" name="meta_name" id="meta_name" required/>
                                          <span class="text-danger" id="err_name"  style="display:none;"></span>
                                        </div>
                                        
                                        <div class="col-md-6  form-group" >
                                            <label>Form Background Color Code</label>
                                            <input class="form-control " type="text" name="egcolor" min="1" id="egcolor" required/>
                                            <span class="text-danger" id="err_iColor_coe"  style="display:none;"></span>
                                        </div>
                                    
                                        <div class="col-md-6 form-group" id="fileTypeDiv">
                                             <label>Background Type</label>
                                            <select class="custom-select" name="file_type" id="file_type" onchange="checkFileType(this.value)">
                                                <option value="image">Image </option>
                                                <option value="video">Video </option>
                                            </select>
                                            <span class="text-danger" id="err_iCaption_cfy"  style="display:none;"></span>
                                        </div>
                                        
                                        <div class="col-md-6 form-group" id="videoDiv" style="display:none;">
                                             <label>Video File</label>
                                             <input class="form-control " type="file" name="egapplylink" accept="video/mp4" min="1" id="egapplylink"/>
                                              <span class="text-danger" id="err_iApply_link"  style="display:none;"></span>
                                        </div>
                                    </div>
                                  <div id="imgDiv">
                                    <div class="form-group">
                                        <label id="wbaner"> Web banner</label>
                                        <div class="input-group mb-2">
                                                <input class="form-control" type="file" name="upload_photo" id="upload_photo" accept="image/jpg,image/jpeg" />
                                                <input type="hidden" name="logoimage" id="logoimage" value="">
                                                <input type="hidden" name="photoupload" id="photoupload" value="photoupload">
                                        </div>
                                        
                                        <span class="text-danger" id="err_img"  style="display:none;"></span>
                                        <input type="hidden" name="eg_id" id="eg_id" value="">
                                        <input type="hidden" name="eg_name" id="eg_name" value="">
                                    </div>
                                    
                                   <div class="col-md-12 d-none" id="logocropdiv" >
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="logo-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12 d-none" id="photocropdiv" >
                                        <div class="card mb-3">
                                        	<div class="col-md-12" id="photo-demo"  style="overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="appendcropdiv">
                                          <span class="btn btn-primary" id="logocrop-result">Crop</span>
                                      </div>
                                      
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="photoappendcropdiv">
                                          <span class="btn btn-primary" id="photocrop-result">Crop</span>
                                      </div>
                                </div>
                                  
                                  <div class="col-md-12" id="bmDiv"></div>
                                   
                                 <div class="form-group d-none" id="mbanner">
                                     <label> mobile banner</label>
                                       <input class="form-control " type="file" name="upload_mbanner" id="upload_mbanner" />
                                       Exhibitor Picture  <span style="color: #ed3838;">[Choose File 550 × 280 pix]</span>
                                </div>

                                </div>
                                
                                <div class="modal-footer">
                                    <input type="hidden" name="ehc_id" id="bm_id" value="">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>


@endsection

@section('page-js')

   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    

    $('#upload_photo').on('change', function () {
        
        const fileSize = this.files[0].size / 1024;
        //console.log(fileSize);
        if (fileSize > 600) {
            $('#upload_photo').focus();
            $('#upload_photo').val('');
            swal({
                type: 'error',
                title: 'File Size',
                text: 'File size should be less than 600 KB',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-danger'
            })
            
            return false;
        }
        else {
        
        	var reader = new FileReader();
            reader.onload = function (e) {
            	$photoCrop.croppie('bind', {
            		url: e.target.result
            	}).then(function(){
            		//console.log('jQuery bind complete');
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
        }
    });

    /*  photo image crop */
    $photoCrop = $('#photo-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1080,
            height: 500,
            type: 'square'
        },
        boundary: {
            width: 1100,
            height: 600
        },enableResize: false
        
    });

    $('#photocrop-result').on('click', function (ev) {
    	$photoCrop.croppie('result', {
    		type: 'canvas',
    		size: 'viewport',
    		format: 'jpeg',
    		quality:0.2
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
        //console.log('check11');
  
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCrop2.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		//console.log('jQuery bind complete');
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
    		size: 'viewport',
    		format: 'jpeg',
    		quality:0.2
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
        //console.log('upload photo 3');
  
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCrop3.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		//console.log('jQuery bind complete');
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
    		size: 'viewport',
    		format: 'jpeg',
    		quality:0.2
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
                url: 'addhomepagecontent',
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
        $('#photouploadform')[0].reset();
        $('#bmDiv').html("");
        
        $('#up-photo').html('Add/Edit Home Page Content');
        $('#photoupload').val('photoupload');
        $('#instructionDiv').html('Background Image <span style="color: #ed3838;">[Choose File 1920 x 1080 pix]</span>');
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
        $('#wbaner').html('Background Image');
        $('#wbaner').removeClass('d-none');
      
        $('#eg_id').val();
        $('#eg_name').val();
    }
    
    
    function addEditBannerDetails(bmId,bcmd){
        
        if(bmId!='') {
            uploadphotoEvnt();
            $('#photosmodal').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'edithomepagecontent',
                data: 'ehc_id='+bmId,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        $('#file_type').val(result.hp_type);
                        checkFileType(result.hp_type);
                        $('#bm_id').val(bmId);
                        $('#egcolor').val(result.color_code);
                        $('#meta_name').val(result.meta_name);
                        //
                        $('#upload_photo').attr('required', false);
                        $('#egapplylink').attr('required', false);
                    }
                    else{
                        //console.log(result.code);
                    }
                }      
        
            });
        }
    }
    
    function restDiv()
    {
        //do nothing
    }
    
    // $('#file_type').on('change', function () {
        
    //     var fileType = $('#file_type').val();
    //     if(fileType == 'image')
    //     {
    //         $('#videoDiv').hide();
    //          $('#imgDiv').show();
    //     }
    //     else {
    //         $('#videoDiv').show();
    //         $('#imgDiv').hide();
    //     }
        
    // });
    
    function checkFileType(file_type)
    {
        if(file_type == 'image')
        {
            $('#upload_photo').attr('required', true);
            $('#egapplylink').attr('required', false);
            $('#videoDiv').hide();
            $('#imgDiv').show();
            
            $('#fileTypeDiv').removeClass('col-md-6').addClass('col-md-12');
        }
        else {
            $('#upload_photo').attr('required', false);
            $('#egapplylink').attr('required', true);
            $('#videoDiv').show();
            $('#imgDiv').hide();
            
            $('#fileTypeDiv').removeClass('col-md-12').addClass('col-md-6');
        }  
    }
    
    function validatePhotoUploadForm()
    {
        let upload_photo = document.getElementById("upload_photo");
        if(upload_photo.files.length != 0)
        {
            if($('#file_type').val() == 'image') {
                var logoimage=$('#logoimage').val();
                if($.trim(logoimage)==''){
                    swal({
                      type: 'error',
                      title: 'Image Crop',
                      text: 'Please Crop Image before submit the button',
                      buttonsStyling: false,
                      confirmButtonClass: 'btn btn-lg btn-danger'
                     })
                                             
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }
    }
        
    $('#photouploadform').submit(validatePhotoUploadForm);

 </script>

  
@endsection
