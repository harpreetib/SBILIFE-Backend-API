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
                <h1>Manage Gesture</h1>
                <ul>
                    <li><a href="">View Gesture</a></li>
                    <li>Gesture List</li>
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
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Gesture</button>

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
                                            <th scope="col">Icon</th>
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
                                            <td style="width:20%">{{$i++}}</td>
                                            <td style="width:20%">{{$list->gm_name}}</td>
                                            <td style="width:20%;"><img src="{{asset($list->gm_file)}}" style="max-width: 140px;max-height:140px;background-color: #485a69;"/></td>
                                            <td style="width:15%;">
                                            <?php
                                            $checked = ($list->gm_status == 'active') ? 'checked' : '';
                                            ?>
                                            <label class="switch switch-success mr-3">
                                             <input type="checkbox" id="{{ $list->gm_id }}" onclick="enabledisableservices('{{ $list->gm_id }}', this.checked)" {{ $checked }}>
                                             <span class="slider"></span>
                                            </label>
                                        </td>
                                            <td style="width:20%;">
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="{{$list->gm_id}}" onclick="addeditgesture('{{$list->gm_id}}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Add New Gesture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addGesture" action="addGestureName" method="post" id="addGesture" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Gesture Name:</label>
                                        <input type="text" class="form-control" name="gesture_name" id="gesture_name" value="" placeholder="Please Enter Gesture Name ">
                                       <span class="text-danger" id="msg_gesture_name" name="msg_gesture_name"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('gesture_name') }}</span>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Gesture Icon:</label>
                                        <input type="file" class="form-control" name="gesture" id="gesture" value="" accept="image/*">
                                       <span class="text-danger" id="msg_gesture" name="msg_gesture"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('gesture') }}</span>
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
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Gesture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <form name="editGestureForm" id="editGestureForm" method="post"  enctype="multipart/form-data">
                              {!! csrf_field() !!}  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-12 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Gesture Name:</label>
                                        <input type="text" class="form-control" name="ed_gesture_name" id="ed_gesture_name" value="">
                                       <span class="text-danger" id="ed_msg_gesture_name" name="ed_msg_gesture_name"  style="display:none;"></span>
                                    </div>
                                <div class="col-md-12">
                                        <label for="recipient-name-2" class="col-form-label">Choose Geture Icon:</label>
                                        <input type="file" class="form-control" name="ed_gest_icon" id="ed_gest_icon" value="" accept="image/*">
                                       <span class="text-danger" id="ed_msg_gest_icon" name="ed_msg_gest_icon"  style="display:none;"></span>
                                       <span class="text-danger p-1">{{ $errors->first('ed_gest_icon') }}</span>
                                    </div>
                                  
                               
                            <div>
                            
                                
                                 </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="gm_id" id="gm_id">
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
    $("#save").click(function(e) {
    var name = $("#gesture_name").val();
    var gsture_icon = $("#gesture")[0].files[0];

    $("#msg_gesture_name").fadeOut('fast');
    $("#msg_gesture").fadeOut('fast');

    if ($.trim(name) == '') {
        $("#msg_gesture_name").text("Please Enter Gesture Name");
        $("#msg_gesture_name").fadeIn('fast');
        $("#gesture_name").focus();
        return false;
    }
    
    if (!gsture_icon) {
    $("#msg_gesture").text("Please choose a gesture icon");
    $("#msg_gesture").fadeIn('fast');
    return false;
    }

    var formData = new FormData();
    formData.append('gesture_name', name);
    formData.append('gesture', gsture_icon);

    e.preventDefault();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'addGestureName',
        data: formData,
        processData: false,
        cache: false,
        contentType: false,
        success: function(response) {
            if (response === "exists") {
                $("#msg_gesture_name").text("Gesture Name already exists");
                $("#msg_gesture_name").fadeIn('fast');
            } else {
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Gesture Name Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        },
        error: function(response) {
            $('#msg_gesture_name').html(response.responseJSON.errors.gesture_name);
        }
    });
});
    
});



         function addeditgesture(exhim_id){
 		 //  alert(exhim_id);return false;
            //  $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editGesture',
              	data: 'id='+exhim_id,
                success: function (data) {   
                // console.log(data);
                    // $('#edit').html(data);
    
                    $("#gm_id").val(data.gm_id);
                    $("#ed_gesture_name").val(data.gm_name);
                    $('#verifyModalContent1').modal('toggle')
                   
                    }      
            });
        }
</script>
<script>
    $(document).ready(function(){
    
     $(".update").click(function (e) {
    var name = $("#ed_gesture_name").val();
    var gsture_icn = $("#ed_gest_icon")[0].files[0];
    var id = $("#gm_id").val();

    $("#ed_msg_gesture_name").fadeOut('fast');

    if ($.trim(name) == '') {
        $("#ed_msg_gesture_name").text("Please Enter Gesture Name").fadeIn('fast');
        $("#ed_gesture_name").focus();
        return false;
    }

    var data = $('#editGestureForm').serialize();
    var formData = new FormData();
    formData.append('ed_gesture_name', name);
    formData.append('ed_gest_icon', gsture_icn);
    formData.append('gm_id', id);

    e.preventDefault();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'updateGestureName',
        data: formData,
        processData: false,
        cache: false,
        contentType: false,
        success: function (response) {
            if (response.status === 'error') {
                $("#ed_msg_gesture_name").text(response.message).fadeIn('fast');
            } else {
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Gesture Name Updated Successfully',
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
</script>
<script>
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
            url: "enable-disable/" + id,
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
