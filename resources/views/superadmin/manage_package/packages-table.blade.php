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
                <h1>Manage Packages</h1>
                <ul>
                    <li><a href="">View List</a></li>
                    <!--<li>Package List</li>-->
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
                            <div class="col-md-3 form-group mb-3 d-none">
                                <select class="form-control" name="leadstage">
                                   
                                    
                                        <option value="prospect">Prospect</option>
                                        <option value="trail">Trail</option>
                                        <option value="paid">Paid</option>
                                   
                                </select>
                            </div> 
                            
                             
                           
                             <input type="hidden" name="leadtype" id="leadtype" value="{{empty($leadtype) ? ''  : $leadtype}}">
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
            
           
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <button type="button" style="float:right" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Add Package</button>

                 </div>
            </div>
             <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <!--<h4 class="card-title mb-3">Zero configuration</h4>-->
                            <!--<p>DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</p>-->
                            
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
                                 @include('superadmin.manage_package.package_table_content')
                                </table>
                            </div>
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
                                Displaying {{$Alldata->count()}} of {{ $Alldata->total() }} customer(s).
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end of col -->




            </div>
            <!-- end of row -->
<!-- MAIL MODAL -->
 <div class="modal fade" id="MailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-None modal-dialog-centered" role="document" style="max-width:50%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Send Mail</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="MailForm" id="MailForm" class="" action="" method="post"  enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="modal-body">
                             
                             <div class="card mb-4">
                              <div class="card-body">                
                                <div class="row">
                                   <div class="col-md-12 form-group">
                                        <label>To</label>
                                       <input type="text" class="form-control" name="to" id="to" value="" readonly />
                                    </div>
                                     <div class="col-md-12 form-group">
                                        <label>CC</label>
                                       <input type="text" class="form-control" name="cc" id="cc" value="" readonly />
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Subject</label>
                                       <input type="text" class="form-control" name="subject" id="subject" value="" readonly />
                                    </div>
                           
                                    <div class="col-md-12 form-group">

                                    <label for="content">Mail body</label>
                                        
                                         <textarea class="ckeditor form-control form-control-lg"  name="content" id="content" autocomplete="off"></textarea>
                                         <script type="text/javascript">
                                        	 $(document).ready(function() {
                                                CKEDITOR.replace("content");
                                            });
                                        </script>
                                    </div>


                                </div>
                        </div>
                        
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="SendMail()">Send Mail </button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
 <!--End Mail modal -->
<!-- Verify Modal content -->
            <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="verifyModalContent_title"> Add New Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addpackageForm" id="addpackageForm">
                                {!! csrf_field() !!}
                        <div class="modal-body">
                             
                                <div class="form-row">
                                <div class="col-md-6 mb-1">
                                        <label for="recipient-name-2" class="col-form-label font-weight-bold">Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Package Name" name="name" id="name" value="">
                                       <span class="text-danger" id="msg_name" name="msg_name"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">User Limit:</label>
                                            <select class="form-control" name="users" id="users">
                                               <option value="">Select</option>
                                               @foreach($userList as $user)
                                               <option value="{{$user->pum_id}}">{{$user->pum_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger" id="msg_users" name="msg_users"  style="display:none;"></span>
                                      </div>
                                    </div>
                               
                                 <div class="form-row">
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Custom Landing Page:</label>
                                            <select class="form-control" name="custom_landing_page" id="custom_landing_page">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_custom_landing_page" name="msg_custom_landing_page"  style="display:none;"></span>
                                      </div>
                                      <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Unique URL:</label>
                                            <select class="form-control" name="unique_url" id="unique_url">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_unique_url" name="msg_unique_url"  style="display:none;"></span>
                                      </div>
                                      
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Templates</label>
                                            <select class="form-control" name="template" id="template">
                                                <option value="">Select</option>
                                               <option value="default">Default</option>
                                               <option value="custom">Custom Design</option>
                                            </select>
                                            <span class="text-danger" id="msg_template" name="msg_template"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Branding & Personalized Content:</label>
                                            <select class="form-control" name="branding" id="branding">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_branding" name="msg_branding"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Custom Avatars:</label>
                                            <select class="form-control" name="custom_avatar" id="custom_avatar">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_custom_avatar" name="msg_custom_avatar"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">NPCs:</label>
                                            <select class="form-control" name="npcs" id="npcs">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_npcs" name="msg_npcs"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Videos</label>
                                            <select class="form-control" name="videos" id="videos">
                                                <option value="">Select</option>
                                               @foreach($videoTypeList as $videoType)
                                               <option value="{{$videoType->pvm_id}}">{{$videoType->pvm_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger" id="msg_videos" name="msg_videos"  style="display:none;"></span>
                                      </div>
                                      
                                      <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Breakout Rooms</label>
                                            <select class="form-control" name="breakout_room" id="breakout_room">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_breakout_room" name="msg_breakout_room"  style="display:none;"></span>
                                      </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Access</label>
                                            <select class="form-control" name="access" id="access">
                                                <option value="">Select</option>
                                            @foreach($accessList as $access)
                                               <option value="{{$access->pam_id}}">{{$access->pam_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger" id="msg_access" name="msg_access"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Live Voice & Text Interactions:</label>
                                            <select class="form-control" name="live_voice" id="live_voice">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_live_voice" name="msg_live_voice"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Analytics</label>
                                            <select class="form-control" name="analytics" id="analytics">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_analytics" name="msg_analytics"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Preferred Support:</label>
                                            <select class="form-control" name="preferred_support" id="preferred_support">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger" id="msg_preferred_support" name="msg_preferred_support"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                               <div class="form-row">
                                <label for="recipient-name-2" class="col-form-label font-weight-bold">Platforms:</label>
                                <span class="text-danger mt-2" id="msg_platform" name="msg_platform"  style="display:none;"></span>
                                <div class="col-md-12 mb-1">
                                          @foreach($platformList as $platform)
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="checkbox" name="platforms[]" value="{{$platform->ppam_id}}" />
                                              <label class="form-check-label" for="inlineCheckbox1">{{$platform->ppam_name}}</label>
                                            </div>
                                          @endforeach
                                      </div>
                                
                                </div>
                            
                        </div>
                        <div class="modal-footer">
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
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="editpackageForm" id="editpackageForm" method="post">
                              {!! csrf_field() !!}  
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-6 mb-1">
                                        <label for="recipient-name-2" class="col-form-label font-weight-bold">Name:</label>
                                        <input type="text" class="form-control" name="ed_name" id="ed_name" value="">
                                       <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Users:</label>
                                            <select class="form-control" name="ed_users" id="ed_users">
                                               <option value="">Select</option>
                                               @foreach($userList as $user)
                                               <option value="{{$user->pum_id}}">{{$user->pum_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_users" name="ed_msg_users"  style="display:none;"></span>
                                      </div>
                                    </div>
                               
                                 <div class="form-row">
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Custom Landing Page:</label>
                                            <select class="form-control" name="ed_custom_landing_page" id="ed_custom_landing_page">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_custom_landing_page" name="ed_msg_custom_landing_page"  style="display:none;"></span>
                                      </div>
                                      <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Unique URL:</label>
                                            <select class="form-control" name="ed_unique_url" id="ed_unique_url">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_unique_url" name="ed_msg_unique_url"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Templates</label>
                                            <select class="form-control" name="ed_template" id="ed_template">
                                                <option value="">Select</option>
                                               <option value="default">Default</option>
                                               <option value="custom">Custom Design</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_template" name="ed_msg_template"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Branding & Personalized Content:</label>
                                            <select class="form-control" name="ed_branding" id="ed_branding">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_branding" name="ed_msg_branding"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Custom Avatars:</label>
                                            <select class="form-control" name="ed_custom_avatar" id="ed_custom_avatar">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_custom_avatar" name="ed_msg_custom_avatar"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">NPCs:</label>
                                            <select class="form-control" name="ed_npcs" id="ed_npcs">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_npcs" name="ed_msg_npcs"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Videos</label>
                                            <select class="form-control" name="ed_videos" id="ed_videos">
                                                <option value="">Select</option>
                                               @foreach($videoTypeList as $videoType)
                                               <option value="{{$videoType->pvm_id}}">{{$videoType->pvm_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_videos" name="ed_msg_videos"  style="display:none;"></span>
                                      </div>
                                      
                                      <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Breakout Rooms</label>
                                            <select class="form-control" name="ed_breakout_room" id="ed_breakout_room">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_breakout_room" name="ed_msg_breakout_room"  style="display:none;"></span>
                                      </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Access</label>
                                            <select class="form-control" name="ed_access" id="ed_access">
                                                <option value="">Select</option>
                                            @foreach($accessList as $access)
                                               <option value="{{$access->pam_id}}">{{$access->pam_name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_access" name="ed_msg_access"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Live Voice & Text Interactions:</label>
                                            <select class="form-control" name="ed_live_voice" id="ed_live_voice">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_live_voice" name="ed_msg_live_voice"  style="display:none;"></span>
                                      </div>
                                      
                                </div>
                                
                                <div class="form-row">
                                    <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Analytics</label>
                                            <select class="form-control" name="ed_analytics" id="ed_analytics">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_analytics" name="ed_msg_analytics"  style="display:none;"></span>
                                      </div>
                                      
                                     <div class="col-md-6 mb-1">
                                          <label for="recipient-name-2" class="col-form-label font-weight-bold">Preferred Support:</label>
                                            <select class="form-control" name="ed_preferred_support" id="ed_preferred_support">
                                                <option value="">Select</option>
                                               <option value="yes">Yes</option>
                                               <option value="no">No</option>
                                            </select>
                                            <span class="text-danger mt-2" id="ed_msg_preferred_support" name="ed_msg_preferred_support"  style="display:none;"></span>
                                            
                                      </div>
                                      
                                </div>
                                
                               <div class="form-row">
                                <label for="recipient-name-2" class="col-form-label font-weight-bold">Platforms:</label>
                                <span class="text-danger mt-2" id="ed_msg_platform" name="ed_msg_platform"  style="display:none;"></span>
                                <div class="col-md-12 mb-1">
                                          @foreach($platformList as $platform)
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="checkbox" name="ed_platforms[]" value="{{$platform->ppam_id}}" />
                                              <label class="form-check-label" for="inlineCheckbox1">{{$platform->ppam_name}}</label>
                                            </div>
                                          @endforeach
                                      </div>
                                
                                </div>
                               
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="" name="pm_id" id="pm_id">
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
        $("#msg_name").fadeOut('fast');
        if( $.trim($("#name").val()) == '')
        {      
            $("#msg_name").text("Please Enter Package Name");
            $("#msg_name").fadeIn('fast');
            $("#name").focus();
            return false;
        }
        
        $("#msg_users").fadeOut('fast');
        if( $.trim($("#users").val()) == '')
        {      
            $("#msg_users").text("Select Max Users Limit");
            $("#msg_users").fadeIn('fast');
            $("#users").focus();
            return false;
        }
        
        $("#msg_custom_landing_page").fadeOut('fast');
        if( $.trim($("#custom_landing_page").val()) == '')
        {      
            $("#msg_custom_landing_page").text("Select Is Custom Landing Page Enable");
            $("#msg_custom_landing_page").fadeIn('fast');
            $("#custom_landing_page").focus();
            return false;
        }
        
        $("#msg_unique_url").fadeOut('fast');
        if( $.trim($("#unique_url").val()) == '')
        {      
            $("#msg_unique_url").text("Select Is Unique URL Enable");
            $("#msg_unique_url").fadeIn('fast');
            $("#unique_url").focus();
            return false;
        }
        
        $("#msg_template").fadeOut('fast');
        if( $.trim($("#template").val()) == '')
        {      
            $("#msg_template").text("Select Template Type");
            $("#msg_template").fadeIn('fast');
            $("#template").focus();
            return false;
        }
		
		$("#msg_branding").fadeOut('fast');
        if( $.trim($("#branding").val()) == '')
        {      
            $("#msg_branding").text("Select Is Branding & Personalized Content Enable");
            $("#msg_branding").fadeIn('fast');
            $("#branding").focus();
            return false;
        }
		
		$("#msg_custom_avatar").fadeOut('fast');
        if( $.trim($("#custom_avatar").val()) == '')
        {      
            $("#msg_custom_avatar").text("Select Is Custom Avatar Enable");
            $("#msg_custom_avatar").fadeIn('fast');
            $("#custom_avatar").focus();
            return false;
        }
		
		$("#msg_npcs").fadeOut('fast');
        if( $.trim($("#npcs").val()) == '')
        {      
            $("#msg_npcs").text("Select Is NPCs Enable");
            $("#msg_npcs").fadeIn('fast');
            $("#npcs").focus();
            return false;
        }
		
		$("#msg_videos").fadeOut('fast');
        if( $.trim($("#videos").val()) == '')
        {      
            $("#msg_videos").text("Select videos Type");
            $("#msg_videos").fadeIn('fast');
            $("#videos").focus();
            return false;
        }
		
		$("#msg_breakout_room").fadeOut('fast');
        if( $.trim($("#breakout_room").val()) == '')
        {      
            $("#msg_breakout_room").text("Select Is Breakout Room Enable");
            $("#msg_breakout_room").fadeIn('fast');
            $("#breakout_room").focus();
            return false;
        }
		
		$("#msg_access").fadeOut('fast');
        if( $.trim($("#access").val()) == '')
        {      
            $("#msg_access").text("Select Access Type");
            $("#msg_access").fadeIn('fast');
            $("#access").focus();
            return false;
        }
		
		$("#msg_live_voice").fadeOut('fast');
        if( $.trim($("#live_voice").val()) == '')
        {      
            $("#msg_live_voice").text("Select Live Voice & Text Interaction Enable");
            $("#msg_live_voice").fadeIn('fast');
            $("#live_voice").focus();
            return false;
        }
		
		$("#msg_analytics").fadeOut('fast');
        if( $.trim($("#analytics").val()) == '')
        {      
            $("#msg_analytics").text("Select Is Analytics Enable");
            $("#msg_analytics").fadeIn('fast');
            $("#analytics").focus();
            return false;
        }
		
		$("#msg_preferred_support").fadeOut('fast');
        if( $.trim($("#preferred_support").val()) == '')
        {      
            $("#msg_preferred_support").text("Select Is Preferred Support Enable");
            $("#msg_preferred_support").fadeIn('fast');
            $("#preferred_support").focus();
            return false;
        }
        
        if($('input[name="platforms[]"]:checked').length < 1)
        {
            $("#msg_platform").text("Please Select at least one Platform");
            $("#msg_platform").fadeIn('fast');
            return false; 
        }
        
        var data = $('#addpackageForm').serialize();
        e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'addpackages',
                    data:data,
                    processData:false,
                    success: function(response){
                        //  console.log(response.errors);
                        //  console.log(response.responseJSON.errors.full_name)
                    //   if (response==true) {
                    swal({
                          type: 'success',
                          title: 'Success!',
                          text: ' Prospect Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                //   }
                      setTimeout(function(){ window.location.reload(); }, 1000);
                      return false;
                       
                    },
                    error: function(response) {
                          $('#msg_name').html(response.responseJSON.errors.full_name);
                           $('#msg_email').text(response.responseJSON.errors.email);
                       }
                });
            });
});


         
         function addeditprospect(exhim_id){
 		 //  alert(exhim_id);return false;
            //  $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editpackages',
               	data: 'id='+exhim_id,
                success: function (data) {   
                     console.log(data);
                    // $('#edit').html(data); 
                    $("#pm_id").attr("value",data.pm_id);
                    $("#ed_name").attr("value",data.pm_name);
                    $("#ed_users").val(data.pum_id);
                    $("#ed_custom_landing_page").val(data.pm_custom_landing_page);
                    $("#ed_unique_url").val(data.pm_unique_url);
                    $("#ed_template").val(data.pm_templates);
                    $("#ed_branding").val(data.pm_branding_personalized_content);
                    $("#ed_custom_avatar").val(data.pm_custom_avatars);
                    $("#ed_npcs").val(data.pm_npc);
                    $("#ed_videos").val(data.pvm_id);
                    $("#ed_breakout_room").val(data.pm_breakout_room);
                    $("#ed_access").val(data.pam_id);
                    $("#ed_live_voice").val(data.pm_live_voice_text_interaction);
                    $("#ed_analytics").val(data.pm_analytics);
                    $("#ed_preferred_support").val(data.pm_preferred_support);
                    
                    $('#verifyModalContent1').modal('toggle');
                    
                    const etmIdArray = data.ppam_id.split(",");
                    $('input[name="ed_platforms[]"]').each(function(index, element) {
                        if ($.inArray(element.value, etmIdArray) != -1)
                        {
                          $(this).prop('checked', true);
                        }
                    });
                   
                    }      
            });
        }
</script>
<script>
    $(document).ready(function(){
    
     $(".update").click(function(e){
     
        $("#ed_msg_name").fadeOut('fast');
        if( $.trim($("#ed_name").val()) == '')
        {      
            $("#ed_msg_name").text("Please Enter Package Name");
            $("#ed_msg_name").fadeIn('fast');
            $("#ed_name").focus();
            return false;
        }
        
        $("#ed_msg_users").fadeOut('fast');
        if( $.trim($("#ed_users").val()) == '')
        {      
            $("#ed_msg_users").text("Select Max Users Limit");
            $("#ed_msg_users").fadeIn('fast');
            $("#ed_users").focus();
            return false;
        }
        
        $("#ed_msg_custom_landing_page").fadeOut('fast');
        if( $.trim($("#ed_custom_landing_page").val()) == '')
        {      
            $("#ed_msg_custom_landing_page").text("Select Is Custom Landing Page Enable");
            $("#ed_msg_custom_landing_page").fadeIn('fast');
            $("#ed_custom_landing_page").focus();
            return false;
        }
        
        $("#ed_msg_unique_url").fadeOut('fast');
        if( $.trim($("#ed_unique_url").val()) == '')
        {      
            $("#ed_msg_unique_url").text("Select Is Unique URL Enable");
            $("#ed_msg_unique_url").fadeIn('fast');
            $("#ed_unique_url").focus();
            return false;
        }
        
        $("#ed_msg_template").fadeOut('fast');
        if( $.trim($("#ed_template").val()) == '')
        {      
            $("#ed_msg_template").text("Select Template Type");
            $("#ed_msg_template").fadeIn('fast');
            $("#ed_template").focus();
            return false;
        }
		
		$("#ed_msg_branding").fadeOut('fast');
        if( $.trim($("#ed_branding").val()) == '')
        {      
            $("#ed_msg_branding").text("Select Is Branding & Personalized Content Enable");
            $("#ed_msg_branding").fadeIn('fast');
            $("#ed_branding").focus();
            return false;
        }
		
		$("#ed_msg_custom_avatar").fadeOut('fast');
        if( $.trim($("#ed_custom_avatar").val()) == '')
        {      
            $("#ed_msg_custom_avatar").text("Select Is Custom Avatar Enable");
            $("#ed_msg_custom_avatar").fadeIn('fast');
            $("#ed_custom_avatar").focus();
            return false;
        }
		
		$("#ed_msg_npcs").fadeOut('fast');
        if( $.trim($("#ed_npcs").val()) == '')
        {      
            $("#ed_msg_npcs").text("Select Is NPCs Enable");
            $("#ed_msg_npcs").fadeIn('fast');
            $("#ed_npcs").focus();
            return false;
        }
		
		$("#ed_msg_videos").fadeOut('fast');
        if( $.trim($("#ed_videos").val()) == '')
        {      
            $("#ed_msg_videos").text("Select videos Type");
            $("#ed_msg_videos").fadeIn('fast');
            $("#ed_videos").focus();
            return false;
        }
		
		$("#ed_msg_breakout_room").fadeOut('fast');
        if( $.trim($("#ed_breakout_room").val()) == '')
        {      
            $("#ed_msg_breakout_room").text("Select Is Breakout Room Enable");
            $("#ed_msg_breakout_room").fadeIn('fast');
            $("#ed_breakout_room").focus();
            return false;
        }
		
		$("#ed_msg_access").fadeOut('fast');
        if( $.trim($("#ed_access").val()) == '')
        {      
            $("#ed_msg_access").text("Select Access Type");
            $("#ed_msg_access").fadeIn('fast');
            $("#ed_access").focus();
            return false;
        }
		
		$("#ed_msg_live_voice").fadeOut('fast');
        if( $.trim($("#ed_live_voice").val()) == '')
        {      
            $("#ed_msg_live_voice").text("Select Live Voice & Text Interaction Enable");
            $("#ed_msg_live_voice").fadeIn('fast');
            $("#ed_live_voice").focus();
            return false;
        }
		
		$("#ed_msg_analytics").fadeOut('fast');
        if( $.trim($("#ed_analytics").val()) == '')
        {      
            $("#ed_msg_analytics").text("Select Is Analytics Enable");
            $("#ed_msg_analytics").fadeIn('fast');
            $("#ed_analytics").focus();
            return false;
        }
		
		$("#ed_msg_preferred_support").fadeOut('fast');
        if( $.trim($("#ed_preferred_support").val()) == '')
        {      
            $("#ed_msg_preferred_support").text("Select Is Preferred Support Enable");
            $("#ed_msg_preferred_support").fadeIn('fast');
            $("#ed_preferred_support").focus();
            return false;
        }
        
        if($('input[name="ed_platforms[]"]:checked').length < 1)
        {
            $("#ed_msg_platform").text("Please Select at least one Platform");
            $("#ed_msg_platform").fadeIn('fast');
            return false; 
        }
                    
                
                  var data = $('#editpackageForm').serialize();
                   e.preventDefault();
                
                $.ajax({
                    
                    type: 'POST',
                    url: 'updatepackages',
                    data:data,
                    processData:false,
                    success: function(response){
                        // console.log(response.errors);
                    //   if (response==true) {
                    swal({
                          type: 'success',
                          title: 'Success!',
                          text: ' Package Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  //}
                      setTimeout(function(){ window.location.reload(); }, 1000);
                      return false;
                       
                    }
                });
       
         
     });
        
    });
</script>
<script>
    function statusProspect(cd_id)
    {
            //   alert(cd_id);return false;
             
              
            
    }
            
   function showPreview(videoUrl)
   {
       $('#preview_id').attr('src',videoUrl);
      $('#previewVideoModal').modal('show'); 
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
