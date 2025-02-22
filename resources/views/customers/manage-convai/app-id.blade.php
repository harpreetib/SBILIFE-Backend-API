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
                <h1>Manage Convai App Id</h1>
                <ul>
                    <li><a href="">List</a></li>
                    <li>App Id List</li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="manage-app-setting">
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
            
           
            @if(count($Alldata) < 1)
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add App Id</button>

                 </div>
            </div>
            @endif
            
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
                                            <th scope="col">App Id</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($Alldata as $key=>$list)
                                        <tr>
                                            <td style="width:20%">{{$key+1}}</td>
                                            <td style="width:60%">{{$list->csm_app_id}}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-outline-primary mr-2 edit1" data-id="{{$list->csm_id }}" onclick="addedittemplate('{{$list->csm_id }}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" style="text-align:center">No App Id available to display.</td>
                                        </tr> 
                                    @endforelse
                                         </tbody>
                                    

                                </table>
                            </div>
                              
                        </div>
                    </div>
                </div>
                <!-- end of col -->




            </div>
            <!-- end of row -->

<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">App Id</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addtemplateForm" action="addApptemplate" method="post" id="addtemplateForm" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">App Id:</label>
                                        <input type="text" class="form-control" name="app_id" id="app_id" value="">
                                       <span class="text-danger" id="msg_app_id" name="msg_app_id"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('app_id') }}</span>
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
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Edit App Id</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <form name="editprospectsForm" id="editprospectsForm" method="post"  enctype="multipart/form-data">
                              {!! csrf_field() !!}  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">App Id:</label>
                                        <input type="text" class="form-control" name="ed_app_id" id="ed_app_id" value="">
                                       <span class="text-danger" id="ed_msg_app" name="ed_msg_app"  style="display:none;"></span>
                                    </div>
                                  
                               
                            <div>
                            
                                
                                 </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="csm_id" id="csm_id">
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
        var app_name=$("#app_id").val();
        
        $("#msg_name").fadeOut('fast');
        $("#msg_app_id").fadeOut('fast');
        
        if( $.trim(app_name) == '')
        {      
            $("#msg_app_id").text("Please Enter App Id");
            $("#msg_app_id").fadeIn('fast');
            $("#app_id").focus();
            return false;
        }
                    
        var data = $('#addtemplateForm').serialize();
        var formData = new FormData();
        formData.append('app_id', app_name);
        e.preventDefault();
                
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'manage-convai-appid/add',
            data:formData,
            processData:false,
            cache: false,
            contentType: false,
            success: function(response){
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'App Id Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
        
                setTimeout(function(){ window.location.reload(); }, 1000);
                return false;
            },
            error: function(response) {
                $('#msg_name').html(response.responseJSON.errors.full_name);
                $('#msg_app_id').html(response.responseJSON.errors.app_id);
            }
        });
    });
});
            
function addedittemplate(appId)
{
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'manage-convai-appid/view',
       	data: 'id='+appId,
        success: function (data) {
            $("#csm_id").val(data.csm_id );
            $("#ed_app_id").val(data.csm_app_id);
            $('#verifyModalContent1').modal('toggle')
           
        }      
    });
}

$(document).ready(function(){
    $(".update").click(function(e){
     
        var app_name=$("#ed_app_id").val();
        var id=$("#csm_id").val();
        
        $("#ed_msg_app").fadeOut('fast');
        
        if ($.trim(app_name) == '') {
            $("#ed_msg_app").text("Please Enter App Id").fadeIn('fast');
            $("#ed_app_id").focus();
            return false;
        }
        
        var data = $('#editprospectsForm').serialize();
        var formData = new FormData();
        formData.append('ed_app_id', app_name);
        formData.append('csm_id', id);
        
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'manage-convai-appid/update',
            data:formData,
            processData:false,
            cache: false,
            contentType: false,
            success: function(response){
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'App Id Updated Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })
                setTimeout(function(){ window.location.reload(); }, 1000);
                return false;
            }
        });
    });
});
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
