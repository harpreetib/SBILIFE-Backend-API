@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
<style>
    .divide{
        border-top: 1px solid #dee2e6;
    }
</style>
@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Users</h1>
                <ul>
                  <li>Details</li>
                  <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3">
                    <h4>  <a href="#" class="float-right" data-toggle="modal" data-target="#userModal"><button type="button" class="btn btn-info btn-rounded m-1">Add User</button></a></h4><h4>
            </h4></div>


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
                        <select class="custom-select" name="pagination" id="pagination"
                                    onchange="this.form.submit();">
                                    <option value="10" @if($leadList->perPage() == 10) selected @endif>
                                        10
                                    </option>
                                <option value="25" @if($leadList->perPage() == 25) selected @endif>
                                    25
                                </option>
                                <option value="50" @if($leadList->perPage() == 50) selected @endif >
                                    50
                                </option>
                                <option value="75" @if($leadList->perPage() == 75) selected @endif >
                                    75
                                </option>
                                <option value="100"
                                        @if($leadList->perPage() == 100) selected @endif >100
                                </option>
                                <option value="200"
                                        @if($leadList->perPage() == 200) selected @endif >200
                                </option>
                                <option value="500"
                                        @if($leadList->perPage() == 500) selected @endif >500
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
                    <th scope="col">#</th>
                    <th scope="col">UserName</th>
                    <th scope="col">Email</th>
                    <th scope="col">LoginID</th>
                    <th scope="col">Password</th>
                    <th scope="col">Mobile No </th>
                    <th scope="col">Video Url</th>
                    <th scope="col">Status</th>
                    <th>Action</th>
                   
                    </tr>
                </thead>
                <tbody>
                      @php
                          $i=1
                          @endphp
                          @foreach($leadList as $list)
                          <tr>
                              <th scope="row">{{$i++}}</th>
                              <td scope="row">{{ ucfirst($list->user_name) }} </td>
                              <td>{{$list->email_id}}</td>
                              <td scope="row">{{$list->login_id}}</td>
                              <td>  {{$list->password}}</td>
                              <td>{{$list->mobile_no}}</td>
                              <td> {{$list->video_url }}</td> 
                             <td>
                           @if($list->status=='active')
                        
                          <label class="switch switch-success mr-3" onclick="checked('{{$list->map_id}}','inactive');">
                          <input type="checkbox" id="status_{{$list->map_id}}" checked="">
                            <span class="slider"></span>
                        </label>
                        @else
                        <label class="switch switch-success mr-3" onclick="checked('{{$list->map_id}}','active');"> 
                            <input type="checkbox" id="status_{{$list->map_id}}">
                            <span class="slider"></span>
                        </label>
                        </td>
                        @endif         
                              

                              <td><a href="javascript:void(0);" class="text-success mr-2" onclick="editUser('{{$list->map_id}}');">
                              <i class="nav-icon i-Pen-2 font-weight-bold"></i></a></td>
                          </tr>

                          @endforeach

                      </tbody>
             </table>
             
              </div>
            </div>
            <div class="col-md-12">

           <div class="col-md-6  text-right">{{$leadList->onEachSide(2)->appends(request()->except('page'))->links()}}</div>
            </div>


            </div>
            </div>

            </div>
            </div>
            </div>
            </div>
            <!-- end of row -->
            <!-- userModal -->

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"></h5><h4>Add New User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form name="addnewuser" id="addnewuser" class="" action="#" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                        
                        <div class="modal-body">
                              <input class="form-control" type="hidden" name="addcourse" id="addcourse" value="addcourse">
                             <div class="card mb-4">
                              <div class="card-body">                
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">User Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="">
                                        <span class="text-danger" id="err_name" name="err_name" style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Login ID</label>
                                        <input type="text" class="form-control" name="loginid" id="loginid" placeholder="Login ID" value="">
                                        <span class="text-danger" id="err_login" name="err_login" style="display:none;"></span>
                                    </div>

                                    <!-- <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Password</label>
                                        <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="">
                                        <span class="text-danger" id="err_password" name="err_password" style="display:none;"></span>
                                    </div> -->

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail Address" value="">
                                        <span class="text-danger" id="err_email" name="err_email" style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Mobile</label>
                                        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="">
                                        <span class="text-danger" id="err_mobile" name="err_mobile" style="display:none;"></span>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Video Url</label>
                                        <input type="text" class="form-control" name="video" id="video" placeholder="Video Url"  
                                         value="">
                                        <span class="text-danger" id="err_video" name="err_video"  style="display:none;"></span>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="acccess_type">Access Type</label>
                                        <select class="form-control" name="access_type" id="access_type">
                                            <option value="">Select Access Type</option>
                                            @foreach($accesType as $type)
                                              <option value="{{$type->at_id}}">{{$type->at_name}}</option>
                                            @endforeach
                                            

                                        </select>
                                        <span class="text-danger" id="err_at" name="err_at"  style="display:none;"></span>
                                    </div>
                                    
                                    
                                </div>
                        </div>
                        
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="AddeNewUser()">Add User</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        <!-- EndUserModal -->

        <!-- start Edit User modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->



@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
 <script src="{{asset('assets/js/datatables.script.js')}}"></script>
  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
 <script type="text/javascript">

      function AddeNewUser()
        {
          var name = $("#name").val(); 
          var loginid = $("#loginid").val();
          var password = $("#password").val();
          var email = $("#email").val();
          var mobile = $("#mobile").val();
          var access_type =  $("#access_type").val();
        
           
        $("#err_name").fadeOut('fast');
          if( $.trim(name) == '')
            {      
              $("#err_name").text("Please Enter Name");
                  $("#err_name").fadeIn('fast');
                    $("#name").focus();
              return false;
            }

          $("#err_login").fadeOut('fast');
          if( $.trim(loginid) == '')
            {      
              $("#err_login").text("Please Enter LoginID");
                  $("#err_login").fadeIn('fast');
                    $("#loginid").focus();
              return false;
            }
          
            $("#err_email").fadeOut('fast');
          if( $.trim(email) == '')
            {      
              $("#err_email").text("Please Enter Email");
                  $("#err_email").fadeIn('fast');
                    $("#email").focus();
              return false;
            }
            
            $("#err_mobile").fadeOut('fast');
          if( $.trim(mobile) == '')
            {      
              $("#err_mobile").text("Please Enter Mobile No.");
                  $("#err_mobile").fadeIn('fast');
                    $("#mobile").focus();
              return false;
            }
             $("#err_at").fadeOut('fast');
          if( $.trim(access_type) == '')
            {      
              $("#err_at").text("Please Select Access Type");
                  $("#err_at").fadeIn('fast');
                    $("#access_type").focus();
              return false;
            }
          //alert('kjkj');
          $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type:"post",
                  url: "saveNewuser",
                  data: $('#addnewuser').serialize(),
                  success: function (data) {
                    
                      swal({
                          type: 'success',
                          title: 'Success!',
                          text: "User Added Successfully!",
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      });
                      $("#userModal").modal("hide");
                     
                      setTimeout(function(){ window.location.reload(); }, 2000);
                      return false;                  
                      
                  }
              });

        }

        function editUser(map_id)
        {
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'edituser',
                data: 'map_id='+map_id,
                success: function (data) {           
                    $('#edit').html(data);
                    $('#editUserModal').modal('toggle')
                    }      
            });
        }

        function updateuser ()
        {
            $.ajax({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
            method:"POST",
            url:"updateuser",
            data:$('#edituser').serialize(),
            success:function(data){
              swal({
                  type: 'success',
                  title: 'Success!',
                  text: 'User Update Successfully',
                  buttonsStyling: false,
                  confirmButtonClass: 'btn btn-lg btn-success'
              })
             $("#editUserModal").modal("hide");
              setTimeout(function(){ window.location.reload(); }, 3000);
              return false;
            }
          });
        }

        function checked(map_id,resStatus)
            {
              //alert(map_id);return false;
             
              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
              
                title: 'Are You Sure !',
                
              }).then(function(result) {
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "changeuserStatus",
                        data: {'map_id':map_id},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                               

                            }
                        });

              }).catch(function(reason){
                        swal({
                              type: 'error',
                              title: 'Cancel!',
                              text: 'Cancelled Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
                             if(resStatus=='active'){
                                  $("#status_"+map_id).prop("checked", false);

                             }else{
                                  $("#status_"+map_id).prop("checked", true);
                              }

                            

                    });
            
            }
 </script>

  
@endsection
