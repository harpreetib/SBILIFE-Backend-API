@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
 <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
 
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endsection

@section('main-content')
  <div class="breadcrumb">
                <h1>Template</h1>
                <ul>
                    <li><a href="">Template</a></li>
                    <li>Template List</li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="prospects">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                            
                             <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder="DateFrom" name="datefrom" value="{{empty($datefrom) ? ''  : $datefrom}}">
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <input id="picker2" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" class="form-control" placeholder=" Date To" name="dateto" value="{{empty($dateto) ? ''  : $dateto}}">
                            </div>
                           
                             <input type="hidden" name="leadtype" id="leadtype" value="{{empty($leadtype) ? ''  : $leadtype}}">
                             <div class="col-md-2 form-group mb-3">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                                
                            </div>


                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
           
            
            <div class="row mb-4 d-none">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Templates</button>

                 </div>
            </div>
             <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            
                          <form method="post" action="{{$_SERVER['REQUEST_URI']}}" id="pageInput">
                                            <div class="row pagination-bar">
                                                <div class="col-12 col-md-7">
                                                    <div class="form-group mt-3">
                                                        @csrf
                                                        <div class="d-flex flex-row">
                                                            <div class="mr-2">
                                                            <select class="custom-select" name="perPage" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" @if($Alldata->perPage() == 10) selected @endif>
                                                                            10
                                                                        </option>
                                                                    <option value="25" @if($Alldata->perPage() == 25) selected @endif>
                                                                        25
                                                                    </option>
                                                                    <option value="50" @if($Alldata->perPage() == 50) selected @endif >
                                                                        50
                                                                    </option>
                                                                    <option value="75" @if($Alldata->perPage() == 75) selected @endif >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            @if($Alldata->perPage() == 100) selected @endif >100
                                                                    </option>
                                                                    <option value="200"
                                                                            @if($Alldata->perPage() == 200) selected @endif >200
                                                                    </option>
                                                                    <option value="500"
                                                                            @if($Alldata->perPage() == 500) selected @endif >500
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
                                            <th scope="col">Sr.No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Main Scene</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Preview Video</th>
                                            <th scope="col">Locations</th>
                                            <th scope="col">Menu Items</th>
                                            <th scope="col">Assets</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @forelse($Alldata as $list)
                                        <tr>
                                            <td style="width:10%">{{$i++}}</td>
                                            <td style="width:10%">{{$list->etm_name}}</td>
                                            <td style="width:10%">{{$list->etm_main_scene}}</td>
                                            <td style="width:25%"><img src="{{asset($list->etm_image)}}" style="width:100%;"></td>
                                            <td style="width:10%">
                                                <a href="javascript:void(0);" class="btn btn-outline-success" data-id="{{$list->etm_id}}" onclick="previewFile('{{$list->etm_id}}');">View</a>
                                            </td>
                                            <td style="width:15%"><a href="./templates/locations/{{$list->etm_id}}" class="btn btn-outline-success" data-id="{{$list->etm_id}}">Manage Locations</a>
                                            </td>
                                            <td style="width:15%"><a href="./templates/menus/{{$list->etm_id}}" class="btn btn-outline-success" data-id="{{$list->etm_id}}">Manage Menu Items</a></td>
                                            <td style="width:15%"><a href="./templates/assets/{{$list->etm_id}}" class="btn btn-outline-success" data-id="{{$list->etm_id}}">Manage Assets</a></td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary mr-2 edit1" data-id="{{$list->etm_id}}" onclick="addedittemplate('{{$list->etm_id}}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" style="text-align:center">No templates to display.</td>
                                        </tr> 
                                    @endforelse
                                         </tbody>
                                    

                                </table>
                                <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="{{$Alldata->previousPageUrl()}}" tabindex="-1">Previous</a>
                                    </li>
                                     @for($i=1;$i<=$Alldata->lastPage();$i++)
                                    <li class="page-item {{$Alldata->currentPage() ==  $i ? 'active' : ''}}">
                                        <a class="page-link" href="{{$Alldata->url($i)}}">{{$i}} <span class="sr-only">(current)</span></a>
                                    </li>
                                     @endfor
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="{{$Alldata->nextPageUrl()}}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                              <p>
                                Displaying {{$Alldata->count()}} of {{ $Alldata->total() }} template(s).
                            </p>
                            </div>
                              
                        </div>
                    </div>
                </div>
                <!-- end of col -->




            </div>
            <!-- end of row -->

<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Add New Template</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addtemplateForm" action="addtemplate" method="post" id="addtemplateForm" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" value="">
                                       <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('full_name') }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="recipient-name-2" class="col-form-label">Main Scene:</label>
                                        <input type="text" class="form-control" name="main_scene_name" id="main_scene_name" value="">
                                       <span class="text-danger" id="msg_scene" name="msg_scene"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('main_scene_name') }}</span>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Image File:</label>
                                        <input type="file" class="form-control" name="image22" id="image" accept="image/*">
                                       <span class="text-danger" id="msg_image" name="msg_image"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('image') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Preview Video File:</label>
                                        <input type="file" class="form-control" name="video22" id="video" accept="video/mp4">
                                       <span class="text-danger" id="msg_video" name="msg_video"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('video') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="location" id="location" value="1">
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
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Template</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="editprospectsForm" id="editprospectsForm" method="post"  enctype="multipart/form-data">
                            {!! csrf_field() !!}  
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="ed_full_name" id="ed_full_name" value="">
                                        <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Main Scene Name:</label>
                                        <input type="text" class="form-control" name="ed_scene_name" id="ed_scene_name" value="">
                                        <span class="text-danger" id="ed_scene" name="ed_scene"  style="display:none;"></span>
                                    </div>
            
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Image File:</label>
                                        <input type="file" class="form-control" name="ed_image" id="ed_image" accept="image/*" value="">
                                        <span class="text-danger" id="ed_msg_image" name="ed_msg_image"  style="display:none;"></span>
                                        <span class="text-danger p-1">{{ $errors->first('image') }}</span>
                                        <div>
                                            <img id="image_preview" class="mt-2 rounded" src="" alt="Image Preview" style="width: 150px; height: 100px;display:none;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Preview Video File:</label>
                                        <input type="file" class="form-control w-100" name="ed_video" id="ed_video" accept="video/mp4" value="">
                                        <span class="text-danger" id="ed_msg_video" name="ed_msg_video"  style="display:none;"></span>
                                        <span class="text-danger p-1">{{ $errors->first('video') }}</span>
                                        <div>
                                            <video id="video_preview" class="mt-1" width="150" height="100" controls style="display:block;">
                                                <source src="" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <input type="hidden" class="form-control" value="" name="etm_id" id="etm_id">
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
        var main_scene_name=$("#main_scene_name").val();
        var image = $("#image")[0].files[0];
        var video = $("#video")[0].files[0];
        var maxImageSize = 512 * 1024; 
        var maxVideoSize = 6 * 1024 * 1024;
    
        $("#msg_name").fadeOut('fast');
        $("#msg_image").fadeOut('fast'); 
        $("#msg_video").fadeOut('fast');
                 
        if( $.trim(name) == '')
        {      
            $("#msg_name").text("Please Enter Name");
            $("#msg_name").fadeIn('fast');
            $("#full_name").focus();
            return false;
        }
        
        if( $.trim(main_scene_name) == '')
        {      
            $("#msg_scene").text("Please Enter Main Scene Name");
            $("#msg_scene").fadeIn('fast');
            $("#main_scene_name").focus();
            return false;
        }
                    
        if (!image) {
            $("#msg_image").text("Please Select an Image");
            $("#msg_image").fadeIn('fast');
            return false;
        }
        
        if (image.size > maxImageSize) {
            $("#msg_image").text("Image size exceeds the maximum allowed size 512KB.");
            $("#msg_image").fadeIn('fast');
            return false;
        }

        if (!video) {
            $("#msg_video").text("Please Select a Video");
            $("#msg_video").fadeIn('fast');
            return false;
        }
        
        if (video.size > maxVideoSize) {
            $("#msg_video").text("Video size exceeds the maximum allowed size 6MB.");
            $("#msg_video").fadeIn('fast');
            return false;
        }
                
        var data = $('#addtemplateForm').serialize();
        var formData = new FormData();
        formData.append('image', $('input[id=image]')[0].files[0]);
        formData.append('full_name', name);
        formData.append('scene_name', main_scene_name);
        formData.append('video22', video);
        e.preventDefault();
                
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'addtemplate',
            data:formData,
            processData:false,
            cache: false,
            contentType: false,
            success: function(response){
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: ' Template Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
        
                setTimeout(function(){ window.location.reload(); }, 1000);
                  return false;
            },
            error: function(response) {
                $('#msg_name').html(response.responseJSON.errors.full_name);
                $('#msg_scene').html(response.responseJSON.errors.main_scene_name);
                $('#msg_image').html(response.responseJSON.errors.image);
                $('#msg_video').html(response.responseJSON.errors.video);
                //   $('#msg_email').text(response.responseJSON.errors.email);
            }
        });
    });
});
</script>
<script>
    $(document).ready(function(){
    
        $(".update").click(function(e){
     
            var name=$("#ed_full_name").val();
            var scene_name=$("#ed_scene_name").val();
            var id=$("#etm_id").val();
            
            var image = $("#ed_image")[0].files[0];
            var video = $("#ed_video")[0].files[0];
            var maxImageSize = 512 * 1024;
            var maxVideoSize = 6 * 1024 * 1024;
                
            $("#ed_msg_name").fadeOut('fast');    
            if ($.trim(name) == '') {
                $("#ed_msg_name").text("Please Enter Name").fadeIn('fast');
                $("#ed_full_name").focus();
                return false;
            }
            
            $("#ed_scene").fadeOut('fast');    
            if ($.trim(name) == '') {
                $("#ed_scene").text("Please Enter Main Scene Name").fadeIn('ed_scene');
                $("#ed_scene_name").focus();
                return false;
            }
            
            $("#ed_msg_image").fadeOut('fast');
            if (image && image.size > maxImageSize) {
                $("#ed_msg_image").text("Image size exceeds the maximum allowed size (512KB).");
                $("#ed_msg_image").fadeIn('fast');
            }
            
            $("#ed_msg_video").fadeOut('fast');
            if (video && video.size > maxVideoSize) {
                $("#ed_msg_video").text("Video size exceeds the maximum allowed size (6MB).");
                $("#ed_msg_video").fadeIn('fast');
            }
                 
            var data = $('#editprospectsForm').serialize();
            var formData = new FormData();
            formData.append('etm_id', id);
            formData.append('ed_image', image);
            formData.append('ed_full_name', name);
            formData.append('ed_scene_name', scene_name);
            formData.append('ed_video', video);
            e.preventDefault();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'updatetemplate',
                data:formData,
                processData:false,
                cache: false,
                contentType: false,
                success: function(response){
                    swal({
                          type: 'success',
                          title: 'Success!',
                          text: ' Template Updated Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                      setTimeout(function(){ window.location.reload(); }, 1000);
                      return false;
                }
            });
        });
    });
 
   function showPreview(videoUrl)
   {
       $('#preview_id').attr('src',videoUrl);
      $('#previewVideoModal').modal('show'); 
   }
   
   
   function addedittemplate(exhim_id)
   {
        var assets_url="{{asset('')}}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'edittemplate',
           	data: 'id='+exhim_id,
            success: function (data) {   
                $("#etm_id").val(data.etm_id);
                $("#ed_full_name").val(data.etm_name);
                $("#ed_scene_name").val(data.etm_main_scene);

                if (data.etm_image) {
                    $("#image_preview").attr("src", '' + assets_url+data.etm_image);
                    $("#image_preview").show();
                } else {
                    $("#image_preview").hide();
                }
    
                var imageSizeKB = data.etm_image / 1024;
                if (imageSizeKB > 512) {
                    $("#ed_msg_image_size").text("Image size exceeds 512KB");
                    $("#ed_msg_image_size").show();
                } 
                else {
                    $("#ed_msg_image_size").hide();
                }
            
                 if (data.etm_video) {
                    $("#video_preview source").attr("src", assets_url + data.etm_video);
                    $("#video_preview")[0].load();
                    $("#video_preview").show();
                } else {
                    $("#video_preview").hide();
                }
        
                $('#verifyModalContent1').modal('toggle')
                   
            }      
        });
    }
 </script>
    
@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.script.js')}}"></script>
     <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert.script.js')}}"></script>

<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>

<script src="{{asset('assets/js/form.basic.script.js')}}"></script>

 <script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>
@endsection
