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
                <h1>Manage Feature</h1>
                <ul>
                    <li><a href="">View Feature</a></li>
                    <li>Feature List</li>
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
            
           
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Feature</button>

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
                                            <th scope="col">Feature Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                    @forelse($Alldata as $list)
                                        <tr>
                                            <td style="width:20%">{{$i++}}.</td>
                                            <td style="width:20%">{{$list->afm_name}}</td>
                                            <td style="width:15%;">
                                            <?php
                                            $checked = ($list->afm_status == 'active') ? 'checked' : '';
                                            ?>
                                            <label class="switch switch-success mr-3">
                                             <input type="checkbox" id="{{ $list->afm_id }}" onclick="enabledisableservices('{{ $list->afm_id }}', this.checked)" {{ $checked }}>
                                             <span class="slider"></span>
                                            </label>
                                        </td>
                                            <td style="width:20%;">
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="{{$list->afm_id}}" onclick="addeditfeaturedata('{{$list->afm_id}}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                            </td>
                                        </div>
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
                                Displaying {{$Alldata->count()}} of {{ $Alldata->total() }} feature(s).
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
                <div class="modal-dialog modal-md modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Add New Feature</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addFeatureName" action="addFeature" method="post" id="addFeatureName" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Feature Name:</label>
                                        <input type="text" class="form-control" name="feature_name" id="feature_name" value="" placeholder="Please Enter Feature Name ">
                                       <span class="text-danger" id="msg_feature_name" name="msg_feature_name"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('feature_name') }}</span>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Feature</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <form name="editFeatureForm" id="editFeatureForm" method="post"  enctype="multipart/form-data">
                              {!! csrf_field() !!}  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Feature Name:</label>
                                        <input type="text" class="form-control" name="ed_feature_name" id="ed_feature_name" value="">
                                       <span class="text-danger" id="ed_msg_feature_name" name="ed_msg_feature_name"  style="display:none;"></span>
                                    </div>
                            <div>
                            
                                
                                 </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="afm_id" id="afm_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary update">Update </button>
                        </div>
                        </form>
                       
                    </div>
                </div>
            </div>
            

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#save").click(function(e) {
    var feturename = $("#feature_name").val();

    $("#msg_feature_name").fadeOut('fast');

    if ($.trim(feturename) == '') {
        $("#msg_feature_name").text("Please Enter Feature Name");
        $("#msg_feature_name").fadeIn('fast');
        $("#feature_name").focus();
        return false;
    }

    var formData = new FormData();
    formData.append('feature_name', feturename);

    e.preventDefault();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'addFeature',
        data: formData,
        processData: false,
        cache: false,
        contentType: false,
        success: function(response) {
            if (response === "exists") {
                $("#msg_feature_name").text("Feature Name already exists");
                $("#msg_feature_name").fadeIn('fast');
            } else {
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Feature Name Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        },
        error: function(response) {
            $('#msg_feature_name').html(response.responseJSON.errors.feature_name);
        }
    });
});
});

         function addeditfeaturedata(exhim_id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editFeatureFormdata',
               	data: 'id='+exhim_id,
                success: function (data) {   
                // console.log(data);
                    // $('#edit').html(data);
    
                    $("#afm_id").val(data.afm_id);
                    $("#ed_feature_name").val(data.afm_name);
                    $('#verifyModalContent1').modal('toggle')
                   
                    }      
            });
        }
</script>
<script>
    $(document).ready(function(){
    
     $(".update").click(function (e) {
    var name = $("#ed_feature_name").val();
    var id = $("#afm_id").val();

    $("#ed_msg_feature_name").fadeOut('fast');

    if ($.trim(name) == '') {
        $("#ed_msg_feature_name").text("Please Enter Feature Name").fadeIn('fast');
        $("#ed_feature_name").focus();
        return false;
    }

    var data = $('#editFeatureForm').serialize();
    var formData = new FormData();
    formData.append('ed_feature_name', name);
    formData.append('afm_id', id);

    e.preventDefault();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'updatefeatureName',
        data: formData,
        processData: false,
        cache: false,
        contentType: false,
        success: function (response) {
            if (response.status === 'error') {
                $("#ed_msg_feature_name").text(response.message).fadeIn('fast');
            } else {
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Feature Name Updated Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                });
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        }
    });
});
        
    });
    
    function enabledisableservices(id, cuStatus) {
    var status = cuStatus === 'active' ? 'inactive' : 'active';

    swal({
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        text: 'Are you sure you want to change?',
        title: 'Are You Sure!',
    }).then(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            method: "POST",
            url: "enable-disable-feature/" + id,
            data: { 'id': id },
            success: function (data) {
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Changed Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                })

                $("#" + id).prop("checked", status === 'active');

                setTimeout(function () { window.location.reload(); }, 1000);
                return false;
            }
        });

    }, function (dismiss) {
        if (dismiss == 'cancel') {
            $("#" + id).prop("checked", cuStatus === 'active');
            swal("Cancelled", "No data has been changed, Your data is safe :)", "error");
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
