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
                <h1>Manage Template Locations</h1>
                <ul>
                  <li><a href="../">View Templates</a></li>
                  <li><a href="../locations/{{$etm_id}}" class="text text-success">View Locations</a></li>
                  <li><a href="../menus/{{$etm_id}}" class="text text-success">View Menus</a></li>
                  <li><a href="./{{$etm_id}}" class="text text-danger">View Assets</a></li>
                  <li>{{$tempDetail->etm_name}}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4 d-none">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Add Template Scene </h4></span>
  <!-- Start filter -->
 <form id="uniqueCodeForm2" method="post">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">
                            <div class="col-md-3 form-group mb-3">
                                <input type="text" class="form-control" id="scene_name2" name="scene_name2" placeholder="Enter Scene Name">
                                <span class="text-danger" id="err_msg" name="err_msg" style="display:none;"></span>
                           </div>
                             <div class="col-md-2 form-group mb-3">
                                 <input type="hidden" name="temp_id2" id="temp_id2" value="{{$etm_id}}">
                                <a id="SubmitBtn" class="btn btn-primary" onclick="validateForm2()" >Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
            <div class="row d-none">
                <!-- ICON BG -->
                
                
               
                 

            </div>
            
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3">
                    <h4 class="float-left font-weight-bold">Template Name: <span class="text-danger">{{$tempDetail->etm_name}}</span></h4>
                    <h4 class="">  <a href="#" class="float-right"  data-toggle="modal" data-target="#verifyModalContent" ><button type="button" class="btn btn-info btn-rounded m-1">Add Asset</button></a><h4> 
            </div>

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
                    <th scope="col">Scene Name</th>
                    <th scope="col">Device Type</th>
                    <th scope="col">Asset Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($leadList) && !empty($leadList))
                        @foreach($leadList as $key=>$list)
                        
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$list->sm_name}}</td>
                        <td>{{ucfirst($list->gs_platform_type)}}</td>
                        <td>{{$list->gs_asset_uri}}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-outline-info mr-2" onclick="AddEditAssetDetails('{{$list->sm_id}}','{{$list->etm_id}}');">
                            <i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr><th scope="row" >Empty record!</th></tr>
                   @endif
                </tbody>
             </table>
             
  </div>
</div>
   <div class="col-md-12">

     <div class="col-md-12">

                                    <!--<div class="col-md-6  text-right">{{$leadList->onEachSide(2)->appends(request()->except('page'))->links()}}</div>-->
                                     <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadList->previousPageUrl()}}" tabindex="-1">Previous</a>
                                            </li>
                                             @for($i=1;$i<=$leadList->lastPage();$i++)
                                            <li class="page-item {{$leadList->currentPage() ==  $i ? 'active' : ''}}">
                                                <a class="page-link" href="{{$leadList->url($i)}}">{{$i}} <span class="sr-only">(current)</span></a>
                                            </li>
                                             @endfor
                                            
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadList->nextPageUrl()}}">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                        <p>
                                        Displaying {{$leadList->count()}} of {{ $leadList->total() }} banner(s).
                                        </p>
                                  </div>
   </div>


</div>
</div>

</div>
</div>
</div>

<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Add New Asset</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="uniqueCodeForm" id="uniqueCodeForm">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label font-weight-bold">Scene Name:</label>
                                        <input type="text" class="form-control" name="scene_name" id="scene_name" value="" placeholder="Enter Scene Name">
                                       <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Device Type:</label>
                                        <select class="custom-select" name="device_type" id="device_type">
                                            <option value="webgl">WebGl</option>
                                            <option value="android">Android</option>
                                            <option value="ios">Ios</option>
                                        </select>
                                        <span class="text-danger" id="msg_device_type" name="msg_device_type" style="display:none;"></span>
                                    </div>
                                
                                    <div class="col-md-12 mt-2">
                                        <label for="recipient-file" class="col-form-label font-weight-bold">Upload Asset:</label>
                                        <p><span class="text text-danger">Note:</span>(Max file size allowed 30MB)</p>
                                        <input type="file" class="form-control" name="asset_name" id="asset_name">
                                       <span class="text-danger" id="msg_asset" name="msg_asset"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="recipient-name-2" class="col-form-label font-weight-bold">Select Scaling:</label>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="1" disabled name="scaling_type[]">
                                          <label class="form-check-label" for="defaultCheck1">
                                            Building
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="2" name="scaling_type[]">
                                          <label class="form-check-label" for="defaultCheck1">
                                            Ground
                                          </label>
                                        </div>
                                       <span class="text-danger" id="msg_scale" name="msg_scale"  style="display:none;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="temp_id" id="temp_id" value="{{$etm_id}}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a id="SubmitBtn" class="btn btn-primary" onclick="validateForm()" >Save</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            
            <!-- Verify Modal content -->
            <div class="modal fade" id="EditAssetModal" tabindex="-1" role="dialog" aria-labelledby="EditAssetModal" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title2">Edit Asset</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="AssetEditForm" id="AssetEditForm">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label font-weight-bold">Scene Name:</label>
                                        <input type="text" class="form-control" name="escene_name" id="escene_name">
                                       <span class="text-danger" id="emsg_name" name="emsg_name"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="recipient-file" class="col-form-label font-weight-bold">Upload Asset:</label>
                                        <p><span class="text text-danger">Note:</span>(Max file size allowed 30MB)</p>
                                        <input type="file" class="form-control" name="easset_name" id="easset_name">
                                       <span class="text-danger" id="emsg_asset" name="emsg_asset"  style="display:none;"></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="esm_id" id="esm_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a id="SubmitEditBtn" class="btn btn-primary" onclick="validateEditForm()" >Save</a>
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
    
    function validateForm() {
        if(validateUniqueCodeForm() == true) { 
            $('#submitBtn').text('Please wait..').attr('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{$fileupload_url}}",
                type: "POST",
                data: new FormData($('#uniqueCodeForm')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    $('#scene_name').val('');
                    document.getElementById('uniqueCodeForm').reset();
                    $('#submitBtn').text('Save').attr('disabled', false);
                    swal('Success','Asset Added successfully!','success');
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }
            })
        }
        else{
            return false;
        }
    }
    
    function validateUniqueCodeForm() {
        
        let asset = document.getElementById("asset_name");
        
        if (($("#scene_name").val()).trim() == "") {
            $("#msg_name").html('Please Enter Scene Name!');
            $("#msg_name").fadeIn('fast');
            $("#msg_name").fadeOut(5000);
            document.getElementById("scene_name").focus();
            return false;
        }
        // else if (asset.files.length < 1) {
        //     $("#msg_asset").html('Please Select Asset File To Upload!');
        //     $("#msg_asset").fadeIn('fast');
        //     $("#msg_asset").fadeOut(5000);
        //     document.getElementById("asset_name").focus();
        //     return false;
        // }
        // else if ((asset.files[0].size / 1024 / 1024) > 30) {
        //     $("#msg_asset").html('Asset file size too large!!');
        //     $("#msg_asset").fadeIn('fast');
        //     $("#msg_asset").fadeOut(5000);
        //     document.getElementById("asset_name").focus();
        //     return false;
        // }
        else if($('input[name="scaling_type[]"]:checked').length < 1)
        {
            $("#msg_scale").text("Please Select at least one Scaling Type");
            $("#msg_scale").fadeIn('fast');
            return false; 
        }
        else {
            return true;
        }
    }
    
    function AddEditAssetDetails(Id,etmId){
        
        if(Id!='') {
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '{{$action_url}}',
                data: 'smId='+Id+'&etmId='+etmId,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        $('#etemp_id').val(etmId);
                        $('#esm_id').val(Id);
                        $('#escene_name').val(result.scene_name).prop('disabled',true);
                        $('#EditAssetModal').modal('show');
                    }
                    else{
                        swal('Failed','Something goes wrong, please try again!','error');
                    }
                }      
        
            });
        }
    }
    
    function validateEditForm() {
        if(validateEditAssetForm() == true) { 
            $('#submitEditBtn').text('Please wait..').attr('disabled', true);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{$fileupdate_url}}",
                type: "POST",
                data: new FormData($('#AssetEditForm')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        document.getElementById('AssetEditForm').reset();
                        $('#submitEditBtn').text('Save').attr('disabled', false);
                        swal('Success','Asset Updated successfully!','success');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                    else{
                        swal('Failed','Something went wrong, please try again!','error');
                    }
                }
            })
        }
        else{
            return false;
        }
    }
    
    
    function validateEditAssetForm() {
        
        let asset = document.getElementById("easset_name");
        
        if (asset.files.length < 1) {
            $("#emsg_asset").html('Please Select Asset File To Upload!');
            $("#emsg_asset").fadeIn('fast');
            $("#emsg_asset").fadeOut(5000);
            document.getElementById("easset_name").focus();
            return false;
        }
        else if ((asset.files[0].size / 1024 / 1024) > 30) {
            $("#emsg_asset").html('Asset file size too large!!');
            $("#emsg_asset").fadeIn('fast');
            $("#msg_emsg_assetasset").fadeOut(5000);
            document.getElementById("easset_name").focus();
            return false;
        }
        else {
            return true;
        }
    }
 </script>
@endsection
