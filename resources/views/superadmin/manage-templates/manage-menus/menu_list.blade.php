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
                <h1>Manage Template Menus</h1>
                <ul>
                  <li><a href="../">View Templates</a></li>
                  <li><a href="../locations/{{$etm_id}}" class="text text-success">View Locations</a></li>
                  <li><a href="./{{$etm_id}}" class="text text-danger">View Menus</a></li>
                  <li><a href="../assets/{{$etm_id}}" class="text text-success">View Assets</a></li>
                  <li>{{$tempDetail->etm_name}}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Upload Menus <a href="{{asset('assets/MenuSamplev1.xlsx')}}" class="ml-3">
                        <button type="button" class="btn btn-success btn-excel"><i class="nav-icon i-Download mr-2"></i>Menu Sample</button>
                    </a></h4> <span class="text-danger">(Accept only xls files)</span>
  <!-- Start filter -->
 <form id="uniqueCodeForm" method="post">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">
                            <div class="col-md-3 form-group mb-3">
                                <input type="file" class="form-control" id="import_unique_code" name="import_unique_code" accept=".xlsx,.xls">
                                <span class="text-danger" id="err_file" name="err_file" style="display:none;"></span>
                           </div>
                             <div class="col-md-2 form-group mb-3">
                                 <input type="hidden" name="temp_id" id="temp_id" value="{{$etm_id}}">
                                <a id="SubmitBtn" class="btn btn-primary" onclick="validateForm()" >Upload</a>
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
                    <h4 class="d-none">  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Banner</button></a><h4> 
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
                    <th scope="col">Menu Name</th>
                    <th scope="col">Menu Id</th>
                    <th scope="col">Order</th>
                    <th scope="col">Status</th>
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
                        <td><input class="form-control" id="menu_name{{$i}}" value="{{$list->em_menu_name}}"></td>
                        <td>{{$list->em_menu_id}}</td>
                        <td>{{$list->em_order_by}}</td>
                        <td>
                            <select name="menu_status_{{$i}}" class="custom-select">
                                <option value="active" @if($list->em_status=='active') Selected @endif>Active</option>
                                <option value="inactive" @if($list->em_status=='inactive') Selected @endif >Deactive</option>
                            </select>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-outline-success mr-2" onclick="AddEditMenuDetails('{{$list->id}}','{{$list->etm_id}}','{{$i}}');">
                            Update</a>
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
    
    function AddEditMenuDetails(Id,etmId,index){
        
        if(Id!='') {
            
            var menu_name = $('#menu_name'+index).val();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '{{$action_url}}',
                data: 'etllId='+Id+'&etmId='+etmId+
                        '&menu_name='+menu_name,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        swal('Success','Template Menu Item Updated Successfully !','success');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                    else{
                        swal('Failed','Something goes wrong, please try again!','error');
                    }
                }      
        
            });
        }
    }
    
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
                    $('#import_unique_code').val('');
                    $('#submitBtn').text('Upload').attr('disabled', false);
                    swal('Success','Menu file uploaded successfully!','success');
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
        if (($("#import_unique_code").val()).trim() == "") {
            $("#err_file").html('Please select Menu List file !');
            $("#err_file").fadeIn('fast');
            $("#err_file").fadeOut(5000);
            document.getElementById("import_unique_code").focus();
            return false;
        } else {
            return true;
        }
    }
 </script>
@endsection
