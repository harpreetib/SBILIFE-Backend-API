@extends('layouts.master')
@section('page-css')
     <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
 <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
@endsection
@section('main-content')

        <div class="breadcrumb">
                <h1>&nbsp;</h1>
                <ul>
                    <li><strong>Treasure Hunt Report </strong></li>
                    <li><a href="treasurehuntreport">List</a></li>
                    @if(Session::get('AllEvent')==false)
                     <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
                    @else
                    <li>All Locations</li>
                    @endif
                    
                </ul>
            </div>
                
            <div class="separator-breadcrumb border-top"></div>

    <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="{{$_SERVER['REQUEST_URI']}}" onsubmit="return validateForm()">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">                        
 
                            <div class="col-md-3 form-group mb-3">
                                <label for="picker2">Date From</label>
                                <input id="picker2" class="form-control" placeholder="yyyy-mm-dd"    name="datefrom" value="{{empty($datefrom) ? ''  : $datefrom}}">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="picker3">Date To</label>
                                <input id="picker3" class="form-control" placeholder="yyyy-mm-dd"    name="dateto" value="{{empty($dateto) ? ''  : $dateto}}">
                            </div>
                    
                                <div class="col-md-1 form-group mt-4">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                            </div>

                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
            <div class="row">
                
                <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Total Users</p>
                                    <p class="text-primary text-24 line-height-1 m-0">{{$TotalSelfieUploaded}}</p>
                                </div>
                            </div>
                        </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Selfie Data</div>
                             <div class="panel-body" align="center">
                                 <form method="post" action="{{$_SERVER['REQUEST_URI']}}" id="pageInput">
                                            <div class="row pagination-bar">
                                                <div class="col-12 col-md-7">
                                                    <div class="form-group mt-3">
                                                        @csrf
                                                        <div class="d-flex flex-row">
                                                            <div class="mr-2">
                                                            <select class="custom-select" name="pagination" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" @if($leadlist->perPage() == 10) selected @endif>
                                                                            10
                                                                        </option>
                                                                    <option value="25" @if($leadlist->perPage() == 25) selected @endif>
                                                                        25
                                                                    </option>
                                                                    <option value="50" @if($leadlist->perPage() == 50) selected @endif >
                                                                        50
                                                                    </option>
                                                                    <option value="75" @if($leadlist->perPage() == 75) selected @endif >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            @if($leadlist->perPage() == 100) selected @endif >100
                                                                    </option>
                                                                    <option value="200"
                                                                            @if($leadlist->perPage() == 200) selected @endif >200
                                                                    </option>
                                                                    <option value="500"
                                                                            @if($leadlist->perPage() == 500) selected @endif >500
                                                                    </option>
                                                                    <option value="1000"
                                                                            @if($leadlist->perPage() == 1000) selected @endif >1000
                                                                    </option>
                                                                      <option value="2000"
                                                                            @if($leadlist->perPage() == 2000) selected @endif >2000
                                                                    </option>
                                                                    <option value="2500"
                                                                            @if($leadlist->perPage() == 2500) selected @endif >2500
                                                                    </option>
                                                                    <option value="4000"
                                                                            @if($leadlist->perPage() == 4000) selected @endif >4000
                                                                    </option>
                                                                    <option value="4500"
                                                                            @if($leadlist->perPage() == 4500) selected @endif >4500
                                                                    </option>
                                                                    <option value="6000"
                                                                            @if($leadlist->perPage() == 6000) selected @endif >6000
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
                                 
                                 <div id="tabledata" class="table-responsive">
                                         <table id="user_table" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#Rank</th>
                                                    <th scope="col">User Name</th>
                                                    <th scope="col">Email Id</th>
                                                    <th scope="col">Total Time Spent (in Second)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($leadlist) > 0)
                                                    @php $i=1; @endphp
                                                    @foreach($leadlist as $list)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{ucfirst($list->lm_fullname)}}</td>
                                                        <td>{{$list->lm_email}}</td>
                                                        <td>{{round($list->total_points,1)}}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="4" class="text-danger">No data available</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                 </div>

                                    @if(count($leadlist) > 0)
                                        <div class="col-md-12">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{$leadlist->previousPageUrl()}}" tabindex="-1">Previous</a>
                                                    </li>
                                                     @for($i=1;$i<=$leadlist->lastPage();$i++)
                                                    <li class="page-item {{$leadlist->currentPage() ==  $i ? 'active' : ''}}">
                                                        <a class="page-link" href="{{$leadlist->url($i)}}">{{$i}} <span class="sr-only">(current)</span></a>
                                                    </li>
                                                     @endfor
                                                    
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{$leadlist->nextPageUrl()}}">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <p class="float-left">
                                            Displaying {{$leadlist->count()}} of {{ $leadlist->total() }} user(s).
                                            </p>
                                        </div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
                             
            </div>
            
  
  <!--------Group List Modal --->
    <div class="modal fade" id="groupMemberModal" role="dialog">
        <div class="modal-dialog modal-lg" style="width:1100px;">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Group Member List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <div id="tabledata" class="table-responsive" style="min-height: 359px;">
                        <table id="user_table" class="table table-bordered  text-center">
                            <thead>
                            <tr>
                            <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Student Id</th>
                                <th scope="col">Group Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Degree</th>
                            </tr>
                            </thead>
                            <tbody id="group_member_id"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
      
@endsection


@section('page-js')
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>



@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>

<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
               
              
              function ViewBoothServeyPointList(boothId)
              {
                  console.log(boothId);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'get-question-score',
                        data: 'boothId='+boothId,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                console.log('check11');
                                $('#point_id').html(result.html);
                                $('#myModal').modal('show');
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
              }
              
              
              function GroupMemberModal(groupId,userId)
              {
                  //console.log(groupId);
                  $('#group_member_id').html('');
                  $('#groupMemberModal').modal('show');
                  $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'get-group-member-list',
                        data: 'group_id='+groupId+'&user_id='+userId,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                $('#group_member_id').html(result.html);
                                //$('#groupMemberModal').modal('show');
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
              }
              
              function UpdateQAResult(userId,index)
              {
                  return false;
                  var qa_result = $('#qa_result_'+index).val();
                  if(qa_result!='')
                  {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'update-avatar-qa-result',
                        data: 'user_id='+userId+'&qa_result='+qa_result,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                swal('Success','Student QA Result Updated Successfully!','success');
                                setTimeout(function() {
                                    location.reload(true);
                                }, 2000);
                    
                                
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
                  }
              }
              
              
              function submitQA(userId,index)
              {
                  var qa_result = $('#qa_result_'+index).val();
                  var qa_remark = $('#qa_remark_'+index).val();
                  
                  if(qa_result=='')
                  {
                      $('#qa_result_'+index).focus();
                      return false;
                  }
                  else if(qa_remark=='')
                  {
                      $('#qa_remark_'+index).focus();
                      return false;
                  }
                  else {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'update-avatar-qa-result',
                        data: 'user_id='+userId+'&qa_result='+qa_result+'&qa_remark='+qa_remark,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                swal('Success','Student QA Result Updated Successfully!','success');
                                setTimeout(function() {
                                    location.reload(true);
                                }, 2000);
                    
                                
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
                  }
              }
    
    function SendAvatarMail(lemmId,indexId) 
    {
        //return false;
        $('#recreate_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'avatar-mail-sent',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Avatar Mail Sent Successfully!','success');
                    $('#recreate_btn_'+indexId).removeClass('btn-outline-danger').addClass('btn-outline-success').text('Avatar Mail Sent');
                    setTimeout(function() {
                        //location.reload(true);
                        swal.close();
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#recreate_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    
    
    function SendReminderAvatarMail(lemmId,indexId) 
    {
        //return false;
        $('#recreate_reminder_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'avatar-mail-sent',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Reminder Avatar Mail Sent Successfully!','success');
                    $('#recreate_reminder_btn_'+indexId).prop("disabled", false);
                    setTimeout(function() {
                        swal.close();
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#recreate_reminder_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    function GenerateUserVoice(lemmId,indexId) 
    {
        $('#generateVoice_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'generate-user-voice',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Voice Generated Successfully!','success');
                    $('#generateVoice_btn_'+indexId).prop('disabled',false);
                    setTimeout(function() {
                        location.reload(true);
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#generateVoice_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    function ReUploadSelfie(userId,index)
    {
        var reupload_selfie = $('#reupload_selfie_'+index)[0];
                  
        if(reupload_selfie.files.length < 1)
        {
            $('#reupload_selfie_'+index).focus();
            return false;
        }
                 
        else {
            
            var formdata = new FormData();
            formdata.append("re_selfie", reupload_selfie.files[0]);
            formdata.append("user_id", userId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'update-avatar-selfie',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result.code);
                    if(result.code == 200)
                    {
                        swal('Success','Student Selfie Updated Successfully!','success');
                        setTimeout(function() {
                            location.reload(true);
                        }, 2000);
                    }
                    else{
                        console.log(result.code);
                    }
                }      
        
            });
        }
    }
            
    </script>
@endsection
