@extends('layouts.master')
@section('page-css')

<meta name="csrf-token" content="{{ csrf_token() }}">
<!--<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">-->
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/choices/choices.min.css')}}">
<style>
.divide{
    border-top: 1px solid #dee2e6;
}
.modal-header .close {
    font-weight: 200;
    font-size: 40px;
    padding: 5px 15px 0 0;
    outline: none;
}
.yelloworder {
    background-color: #ffd300;
}

</style>
@endsection

@section('main-content')

  <div class="breadcrumb">
    <h1>Manage </h1>
     <ul>
        <li><a href="">{{empty($leadtype) ? ''  : ucwords($leadtype)}} Leads</a></li>
        @if(Session::get('AllEvent')==false)
        <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
        @else
        <li>All Locations</li>
         @endif
    </ul>
  </div>
    <div id="spinner" style="display:none;z-index: 99999;position: fixed;width: 100%;height: 100%;">
            <div class="loader spinner-bubble spinner-bubble-primary" style="margin-top: 20%;margin-left: 44%;"></div>
    </div>
    <div class="separator-breadcrumb border-top"></div>

          
            </div>
           



            <div class="row mb-4">
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
                                                        <th scope="col">Virtual Fair Location
                                                              /  <!--<div class="divide"> Lead source </div></th>-->
                                                        <th>User Type </th>
                                                        <th scope="col">Register Date
                                                                <div class="divide"> Register Time </div></th>
                                                        <!--<th scope="col">Visit Date-->
                                                        <!--        <div class="divide"> Visit Time </div></th>-->

                                                        <th scope="col">Name
                                                            <!-- <div class="divide"> Country </div>
                                                            <div class="divide"> City </div> -->
                                                        </th>

                                                        <th scope="col">Email
                                                             <div class="divide"> Mobile </div>
                                                            <!--<div class="divide"> OTP </div> -->
                                                        </th>

                                                        <th scope="col">Company Name
                                                            <div class="divide"> Designation </div></th>
                                                        <th scope="col">Business Nature of Company
                                                            <div class="divide"> Sector Of Interest </div></th>
                                                            
                                                                <th scope="col">Country Name
                                                            <div class="divide"> State </div>
                                                        <div class="divide"> City </div></th>
                                                            
                                                            
                                                        <th scope="col">Activity</th>
                                                      
                                                        <th scope="col">Lead Stage / Conversation 
                                                            <div class="divide"> Last Interaction By</div></th>
                                                        
                                                        <!-- <th>Transfer Lead</th> -->
                                                       
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $i=1
                                                        @endphp
                                                        @foreach($leadList as $list)

                                                    <tr>
                                                        <th scope="row">{{$i++}}</th>
                                                        <td scope="row"><b>{{ ucwords($list->aem_name) }}</b>
                                                                   <!-- <div class="divide"> {{ $list->ls_text }}</div>
                                                                    @if(!empty($list->lemm_adid)) <div class="divide"> {{ ucfirst($list->lemm_adid) }}</div>@endif 
                                                                    
                                                                     @if(!empty($list->lemm_utm_campaign)) <div class="divide"> {{ ucfirst($list->lemm_utm_campaign) }}</div>@endif
                                                                      @if(!empty($list->lemm_utm_term)) <div class="divide"> {{ ucfirst($list->lemm_utm_term) }}</div>@endif
                                                                       @if(!empty($list->lemm_utm_content)) <div class="divide"> {{ ucfirst($list->lemm_utm_content) }}</div>@endif
                                                                    -->
                                                                    </td>
                                                        <td>{{$list->rtm_name}}</td>
                                                        <td scope="row">{{date('d-M,Y',strtotime($list->lemm_insert_date))}}
                                                                <div class="divide"> {{date('h:i A',strtotime($list->lemm_insert_date))}}</div></td>
                                                                
                                                             
                                                        
                                                        <td> {{---$list->lm_id .'-'. $list->lemm_id--}} {{ucfirst($list->lm_fullname)}}
                                                                <!--<div class="divide">{{--$list->cm_name--}}{{--$list->counm_name--}} </div>-->
                                                                <!--<div class="divide">{{--$list->cm_name--}}{{--$list->city_id--}} </div>-->
                                                                </td>

                                                        <td>{{$list->lm_email}}
                                                                <div class="divide"> @if(!empty($list->lm_country_code))+{{$list->lm_country_code}}-@endif{{$list->lm_mobile}} </div>
                                                                <!--<div class="divide"> {{--$list->lm_otp--}} </div>-->
                                                                <!--<div class="divide"> @if($list->lm_is_verified=='Y')  @else  @endif </div>-->
                                                                </td>


                                                        <td>{{ucfirst($list->lm_company_name)}}
                                                                <div class="divide" style="font-size: 11px;">{!! $list->lm_designation !!} </div></td>
                                                         <td>{{ucfirst($list->industry_profile)}}
                                                                <div class="divide" style="font-size: 11px;">
                                                                   
                                                                    {!!  $list->pm_text !!}
                                                                
                                                                    </div></td>

                                                        <td>{{$list->counm_name}}
                                                            <div class="divide">
                                                                {{$list->sm_name}}
                                                            </div>
                                                            <div class="divide">
                                                                {{$list->cm_name}}
                                                            </div>
                                                        </td>
                                                        
                                                        <td style="font-size: 11px;"> @if(!empty($list->exhim_organization_name)) <b>#  {{$list->exhim_organization_name }}  </b> @endif<br>
                                                        {!! $list->activity !!} @if(!empty($list->alloted_by)) <br><li>{{$list->alloted_by }}</li> @endif</td>

                                                        
                                                        <td> 
                                                                @if(Session::has('profileDetail') && in_array(Session::get('profileDetail')->at_id, array('4','3')))
                                                                    <a href="javascript:void(0);" class="text-success mr-2" onclick="addcate('{{$list->leem_id}}');">
                                                                    <span class="badge badge-pill badge-outline-primary p-1 m-0" id="status{{$list->leem_id}}" >{{$list->lc_text}} &nbsp;<i class="nav-icon i-Pen-2 font-weight-bold"></i> </span></a>/
                                                                @endif     
                                                                <span class="btn p-1 m-0" onclick="showhistory('{{$list->leem_id}}');" >View</span>
                                                                 @if(strpos($list->activity,'Send Inquiry')==true)
                                                                    <span class="btn p-1 m-0 divide" onclick="showEnquiry('{{$list->lm_mobile}}','{{$list->lm_email}}');" > / View Enquiry</span>
                                                                    @endif


                                                                <div class="divide">
                                                                <span  >{{ucwords($list->last_interaction_by)}}</span></div>
                                                        </td>
                                         
                                                        <!-- <td> <span class="btn btn-secondary" onclick="OpenTLModal('{{$list->lemm_id}}')"><i class="i-Transfer"></i>Transfer Lead</td> -->
                                                   
                                                    </tr>

                                                        @endforeach

                                                    </tbody>
                                                    <!--tfoot>
                                                       
                                                    </tfoot-->
                                          </table>
                                      </div>
                                  </div>
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
                                        Displaying {{$leadList->count()}} of {{ $leadList->total() }} customer(s).
                                        </p>
                                  </div>


                              </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end of col modal-lg-->

                <div aria-hidden="true" aria-labelledby="ChangeLeadStage" role="dialog" tabindex="-1" id="ChangeLeadStage" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="changeLeadStatusform" id="changeLeadStatusform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTile">Lead Status</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgShowleadcSF" style="display:none;"></div>
                                <div class="modal-body" id="modelDiv">




                                </div>

                                <div class="modal-footer justify-content-center" id="footerDiv">

                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="changeLeadStatus();">Submit</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                
                
                
                <!-- enquiry modal -->
                <div aria-hidden="true" aria-labelledby="showEnquiry" role="dialog" tabindex="-1" id="showEnquiry" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="EnquiryStatusform" id="EnquiryStatusform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTiles">Show Enquiry</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgShowleadcSF" style="display:none;"></div>
                                <div class="modal-body" id="modelDivs">




                                </div>

                                <div class="modal-footer justify-content-center" id="footerDivs">
                                
                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" >Submit</button>
                                
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- end enquiry modal -->
                
                
                
                
                <!-- Transfer modal -->
                <div aria-hidden="true" aria-labelledby="TLead" role="dialog" tabindex="-1" id="TLead" data-backdrop="static" data-keyboard="false"  class="modal fade bg-white show">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0">
                            <form name="TLform" id="TLform" method="post">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title text-blue" id="modelTiles">Transfer Lead</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>

                                <div class="col-md-12 alert alert-danger" id="errMsgTL" style="display:none;"></div>
                                <div class="modal-body" id="TLDiv">
                                    
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Lead Name</th>
                                            <th>Lead Mobile No.</th>
                                            <th>University List</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                <td><span id="name"></span></td>
                                                <td><span id="mobile"></span></td>
                                                <td><select class="form-control" name="exhim_id[]" id="exhim_id" multiple="">
                                                    
                                                </select>
                                                </td>
                                                <input type="hidden" id="lemm_id" name="lemm_id" value="">
                                                </tr>
                                            
                                            </tbody>
                                    </table>
                                    

                                </div>

                                <div class="modal-footer justify-content-center" id="footerTL">
                                
                                   
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="Allotlead();" >Submit</button>
                                
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- end Transfer modal -->
                
                
                
                </div>

            </div>
        <!-- end of row -->
@endsection

@section('page-js')
   <script src="{{asset('assets/js/choices/choices.min.js')}}"></script>
 <!--<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>-->
 <!--<script src="{{asset('assets/js/datatables.script.js')}}"></script>-->
 <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>

 
 <script>
    $(document).on({
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
   document.addEventListener('DOMContentLoaded', function() {

    new Choices('#exhim_id', {
      removeItemButton: true,
    });

  });
    
    //finction for state and city
        $('#ex_category').change(function(){
                var cityId = $(this).val();  
                if(cityId){
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                       type:"POST",
                       url:"getcity",
                       data:{'cityId':cityId},
                       success:function(res){               
                        if(res){
                            $("#subcategory").empty();
                            $("#subcategory").append('<option value="">Search by City</option>');
                            $.each(res,function(key,value){
                                $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
                            });
                       
                        }else{
                           $("#subcategory").empty();
                        }
                       }
                    });
                }else{
                    $("#subcategory").empty();
                }      
               });

      function validateForm(){
         
    
          var city = $("#subcategory").val();
          var state = $("#ex_category").val();
            
        //alert('Please');
         $("#city_err").fadeOut('fast');
          if($.trim(state) != '' && $.trim(city) == '')
            {      
              $("#city_err").text("Please Select City");
                  $("#city_err").fadeIn('fast');
                    $("#subcategory").focus();
                     //if is any error found. then do this
              return false;
            }
      
        }


//end state and city

 function addcate(leemId){
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'addcategory',
        data: 'leemId='+leemId,
        success: function (data) {
                $('#modelDiv').html(data);
                $('#modelTile').html('Lead Status');
                $('#footerDiv').show();
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}

function showhistory(leemId){
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: 'showhistory',
        data: 'leemId='+leemId,
        success: function (data) {
                $('#modelDiv').html(data);
                
                $('#modelTile').html('Conversation History');
                $('#footerDiv').hide();
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}


function changeLeadStatus(){
    var selectedMsg = $("#clsstage option:selected").text(); 
    var leemId = $("#leemId").val(); 

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'changeleadstatus',
        data: $('#changeLeadStatusform').serialize(),
        success: function (data) {
                var obj=jQuery.parseJSON(data);
                if(obj.code==='200'){
                    $('#status'+leemId).html(selectedMsg);
                }
                $('#ChangeLeadStage').modal('toggle')
            }      
    });
}
function leadtypeFormSubmit(leadType){
$('#leadtype').val(leadType);
$('#searchbtn').click();
}
function showEnquiry(leem_mobile,leem_email){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'showEnquiry',
             data: {'leem_mobile':leem_mobile,'leem_email':leem_email},
            success: function (data) {
                $('#modelDivs').html(data);       
                $('#modelTiles').html('Show Enquiry');
                $('#footerDivs').hide();
                $('#showEnquiry').modal('toggle')
                    
                }      
        });
}

function OpenTLModal(lemmId){

    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'OpenTLModal',
             data: {'lemmId':lemmId},
            success: function (data) {
                $('#TLDiv').html(data);       
               // $('#footerDivs').hide();
                $('#TLead').modal('toggle');
                 new Choices('#exhim_id', {
                      removeItemButton: true,
                    });
                
                console.log(data);
                       
                }      
        });
}

function Allotlead(){
    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "post",
            url: 'Allotlead',
             data: $('#TLform').serialize(),
            success: function (data) {
                swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Lead Transfered Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                                                });
                                                $('#TLead').modal('toggle');
                    setTimeout(function(){ window.location.reload(); }, 2000);
                    							return false;
                
                    
                }      
        });
}

</script>
@endsection
