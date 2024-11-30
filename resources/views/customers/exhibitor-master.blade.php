@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
<!--<link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">-->
<!--<link rel="stylesheet" href="https://virtual.mymedex.com.my/se/public/assets/styles/css/my-multiselect.css">-->
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
</style>
@endsection

@section('main-content')

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Manage Exhibitors</h1>
                <ul>
                  <li><a href="exhibitor">View List</a></li>
                  <li>{{ (isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '') }}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="exhibitor" onsubmit="return validateForm()">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row"> 
                        
                        

                            <div class="col-md-3 form-group mb-3">
                                <select class="custom-select" id="hall_cat_id" name="hall_cat_id">
                                  <option value=""> Select Door</option>
                                    @foreach($exhibitorHallCategory as $hallCategory)
                                        <option value="{{$hallCategory->etd_id}}" @if($hallCategory->etd_id==$etd_id) selected @endif >{{$hallCategory->etd_name }}</option>
                                    @endforeach
                                   </select>
                           </div>
                           
                           <div class="col-md-3 form-group mb-3">
                                <select class="custom-select" id="booth_type" name="booth_type">
                                  <option value=""> Select Booth Type</option>
                                    @foreach($plans as $plan)
                                        <option value="{{$plan->ppm_id}}" @if($plan->ppm_id==$booth_type) selected @endif >{{$plan->ppm_text}}</option>
                                    @endforeach
                                   </select>
                           </div>
                           
                           
                             
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
            
            <div class="row">
                <!-- ICON BG -->
                
                
                
            </div>
            
            <div class="row mb-4 d-none">
                <div class="col-md-12">
                     <div class="card text-left">
                        <div class="card-body">
                            <div class="breadcrumb">
                                <h1>Door List</h1>
                            </div>
                            <div class="separator-breadcrumb border-top"></div>
                                 <div class="table-responsive">
                                      <div class="row ">
                                          <div class="col-md-12">
                                              <table class="table table-striped table-bordered">
                                                  <thead>
                                                      <tr>
                                                          <th>HALL</th>
                                                          <th>Standard Booth</th>
                                                            <th>Gold Sponsorship</th>
                                                            <th>Platinum Sponsorship</th>
                                                            <th>Diamond Sponsorship</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>HALL 1</td>
                                                            <td>18<input type="hidden" name="1" id="1" value="3"></td>
                                                            <td>4<input type="hidden" name="2" id="2" value="3"></td>
                                                            <td>2<input type="hidden" name="2" id="2" value="3"></td>
                                                            <td>1<input type="hidden" name="2" id="2" value="3"></td>
                                                        </tr>
                                                  </tbody>
                                                  
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
            
                                                                     
                <div class="col-md-4 form-group mb-3">     
                    <a href="exhibitordownload">
                        <button type="button" class="btn btn-outline-success btn-excel" >Download Excel</button>
                    </a>                
                </div>
                         
                         
            <div class="col-md-8 mb-3">
                <h4>  <a href="#" class="float-right"  data-toggle="modal" data-target="#CounselorModel" ><button type="button" class="btn btn-info btn-rounded m-1">Add Exhibitor</button></a><h4>
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
                    <!--<th scope="col">Event Name</th>-->
                    <th scope="col">Organisation Name<div class="divide"> E-mail </div><div class="divide"> Website Link </div></th>
                    <th scope="col">Door Name</th>
                   <th scope="col">Login Id<div class="divide"> Password </div><div class="divide"> Login URL </div></th>
                   <!--<th scope="col">Project Type</th>-->
                    <th scope="col">Participation Plan <div class="divide">Counselor Count </div></th>
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
                        <!--<td></td>-->
                        <td>{{$list->exhim_organization_name}}<div class="divide"> {{$list->exhim_contact_email}}  </div>
                            <div class="divide"> 
                                <a href="{{$list->exhim_web_link}}" target="_blank">{{$list->exhim_web_link}}</a>
                            </div>
                        </td>
                        
                        <td>{!! $list->door_name !!}</td>
                        
                         <td>{{$list->ebm_login_user}}<div class="divide">  {{$list->ebm_login_pwd}} </div>
                         <div class="divide text-primary"> https://megaspace.ai/admin/exhibitor/{{$profile_detail->bm_nickname}}  </div>
                         </td>
                         <!--<td>{!! $list->pt_text !!}</td>-->
                         
                        <td id="plan{{$list->exhim_id}}">{{$list->ppm_text}}
                              <div class="divide"> <span class="badge btn-danger" onclick="showcounselor('{{$list->exhim_id}}');" style="cursor: pointer;">{{$list->counselor }}</span> </div>
                        </td>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <!--<td>{{$list->epm_name}}</td>-->
                        
                        <td>
						@if($list->eem_status=='active')
                        
                        <label class="switch switch-success mr-3" onclick="checked('{{$list->eem_id}}','{{$list->ppm_id}}','{{$list->exhim_id}}','inactive');">
                        	<input type="checkbox" id="status_{{$list->exhim_id}}" checked="">
                            <span class="slider"></span>
                        </label>
                        @else
                        <label class="switch switch-success mr-3" onclick="checked('{{$list->eem_id}}','{{$list->ppm_id}}','{{$list->exhim_id}}','active');"> 
                            <input type="checkbox" id="status_{{$list->exhim_id}}">
                            <span class="slider"></span>
                        </label>
                        </td>
                        @endif
                        <td><a href="javascript:void(0);" class="text-success mr-2" onclick="addexhibitoruser('{{$list->exhim_id}}');">
                        <i class="nav-icon i-Pen-2 font-weight-bold"></i></a></td>
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

     <div class="col-md-6  text-right">{{$leadList->onEachSide(2)->appends(request()->except('page'))->links()}}</div>
   </div>


</div>
</div>

</div>
</div>
</div>
                <!-- end of col -->

 <!-- Courses Offered modal -->
 <div class="modal fade" id="CounselorModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add New Exhibitor</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="addneexhibitor" id="addneexhibitor" class="" action="saveuserprofile" method="post"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                              <input class="form-control" type="hidden" name="addcourse" id="addcourse" value="addcourse" />
                             <div class="card mb-4">
                             	<div class="card-body">                
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">Organisation Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        value="">
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                        
                                    </div>
                                    
                                    

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Contact E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail Address" 
                                         value="">
                                        <span class="text-danger" id="err_email" name="err_email"  style="display:none;"></span>
                                    </div>
                                    
                                   
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Designation</label>
                                        <input type="text" class="form-control"  name="designation" id="designation" placeholder="Designation" />
                                        <span class="text-danger" id="err_designation" name="err_designation"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Select Country</label>
                                        
                                         <select class="custom-select" id="country" name="country" required>

		  								     <option value="">Select Country</option>
    										 @foreach($category as $cut)
    										    <option value="{{$cut->counm_id}}" data-id="{{$cut->counm_code}}" >{{$cut->counm_name}}</option>
    		  								@endforeach
		  								</select>
                                        <span class="text-danger" id="err_country" name="err_country"  style="display:none;"></span>
                                    </div> 
                                    
                                    
                                    
                                    <div class="col-md-6 form-group mb-3">
                                    <label for="country_code">Contact No (Mobile)</label>
                                            <div class="input-group form-group position-relative">
                                               
                    							<div class="input-group-prepend" >
                    									<div class="input-group-text" style="padding: unset;
                                                                                            border: unset;
                                                                                            background: #fff;
                                                                                            /*border-top-left-radius: 50px;
                                                                                            border-bottom-left-radius: 50px;*/
                                                                                            font-size: 14px;
                                                                                            height: 35px; border:1px solid #ced4da;">
                    											<select class="custom-select" style="border: unset; margin-left: 0px;"  name="country_code" id="country_code" data-text="Select current state!" required>
                                                                <?php        
                                                                    if(!empty($category)){
                                                                        foreach($category as $key => $countryData){
                                                                            echo '<option value="'.$countryData->counm_code.'">+'.$countryData->counm_code.'</option>';
                                                                        }
                                                                    }
                                                                ?>
                    											</select>
                    									</div>
                    								</div>
                    								<input type="number" class="form-control" name="phone" id="phone"  placeholder="Mobile" value="">
                    								<span class="text-danger" id="err_contact_mobile" name="err_contact_mobile"  style="display:none;"></span>
                    								
                    							
                    						  </div>
                    					</div>
                                    
                                    
                                    
                                    
                                    
                                   
                                    
                                    <div class="col-md-6 form-group mb-3 d-none">
                                        <label for="course_fee_sem">Select State</label>
                                        
                                         <select class="form-control" id="category" name="sm_id">

		  								 <option value="">Select State</option>
										 @foreach($category as $cut)
										 <option value="{{-- $cut->sm_id --}}">{{-- $cut->sm_name --}}</option>
		  								
		  								@endforeach
		  								</select>
                                        <span class="text-danger" id="err_state" name="err_state"  style="display:none;"></span>
                                    </div> 
                                    <div class="col-md-6 form-group mb-3 d-none">
                                        <label for="course_fee_sem">Select City</label>
                                        <select class="form-control" id="subcategory" name="cm_id">
		  								 
											
										
		  								</select>
                                        <span class="text-danger" id="err_city" name="err_city"  style="display:none;"></span>
                                    </div>
           
           
                                    <div class="col-md-6 form-group mb-3" id="modal-content">
                                        <label for="plan">Booth Package</label>
                                            <select class="custom-select chosen" id="plan" name="plan" required>
                                                @foreach($plans as $plan)
                                                    <option value="{{$plan->ppm_id}}">{{$plan->ppm_text}}</option>
                                                @endforeach
                                            </select>
                                        <span class="text-danger" id="err_plan" name="err_plan"  style="display:none;"></span>
                                    </div>
                                    
                                    
                                     <div class="col-md-6 form-group mb-3" id="modal-content">
                                        <label for="exhiHallCategory">Select Door</label>
                                            <select class="custom-select chosen" id="exhiHallCategory" name="exhiHallCategory" required>
                                                @foreach($exhibitorHallCategory as $hallCategory)
                                                    <option value="{{$hallCategory->etd_id}}">{{$hallCategory->etd_name }} ( {{$hallCategory->etd_name}} )</option>
                                                @endforeach
                                            </select>
                                        <span class="text-danger" id="err_exhiHallCategory"  style="display:none;"></span>
                                    </div>
                                    
                                    
                                    
                                     <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Address</label>
                                        <textarea  class="form-control" name="address" id="address" placeholder=" Address" 
                                         value="" required></textarea>
                                        <span class="text-danger" id="err_address" name="err_address"  style="display:none;"></span>
                                    </div> 
                                    
                                    
                                    <h3 class="d-none"># SHOW BOOTH / OUR INNOVATIONS (Only )</h3>
                                    <div class="col-md-12 form-group mb-3 d-none">
                                         
                                         <div class="form-check d-none">
                                            <input type="checkbox" class="form-check-input" name="is_booth_list" id="is_booth_list"  value='Y' checked>
                                            <label class="form-check-label" for="exampleCheck1">Show Booth List</label>
                                          </div>
                                        
                                        <div class="form-check d-none">
                                            <input type="checkbox" class="form-check-input" name="is_product_list" id="is_product_list" value='Y' >
                                            <label class="form-check-label" for="exampleCheck1">Show Product List</label>
                                        </div>
                                    </div>
                                    
                                </div>
                        </div>
                        
                    		</div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="Addexhibitor()">Add Exhibitor</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
 <!--End Courses Offered modal -->

<!--start count counselor -->
<div class="modal fade" id="ex_showcounselor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="documents" style="max-width: 90%!important;">
                    <div class="modal-content" id="showcounselor_ex">
                        
            </div>
        </div>
    </div>
<!--End count counselor -->

<!-- start Edit User modal -->
        <div class="modal fade" id="Editexhibitormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->
<!-- start Edit participation plan modal -->
        <div class="modal fade" id="Editparticipationplanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit_plan">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit participation plan modal -->

            </div>
            <!-- end of row -->



@endsection

@section('page-js')

   

 <!--<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>-->
 <!--<script src="{{asset('assets/js/datatables.script.js')}}"></script>-->
  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
  <!--<script src="https://virtual.mymedex.com.my/se/public/assets/js/vendor/bootstrap-multiselect.min.js"></script>-->
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
 //--For Country Code Selected --
    $("select#country").change(function(){ 
        var selectedCountryCode = $(this).children("option:selected").attr("data-id");
        $('#country_code option[value='+selectedCountryCode+']').attr('selected', true);
        $('#office_phone_code option[value='+selectedCountryCode+']').attr('selected', true);
        $('#fax_code option[value='+selectedCountryCode+']').attr('selected', true);
    });
                
    $('#multiselect2').multiselect({
				includeSelectAllOption: false,
				nonSelectedText: 'Nature Of Your Business?' });
				
	 
				
 	//category
 	$('#category').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
        	headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
           type:"POST",
           url:"subcategorylist/"+categoryID,
           success:function(res){               
            if(res){
                $("#subcategory").empty();
                $("#subcategory").append('<option>Select City</option>');
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


 	function addexhibitoruser(exhim_id){
 		//alert('hhh');return false;
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editexhibitor',
               	data: 'exhim_id='+exhim_id,
                success: function (data) {           
                    $('#edit').html(data);
                    $('#Editexhibitormodal').modal('toggle')
                    }      
            });
        }
function addparticipationplan(exhim_id,aem_id){
 		//alert('hhh');return false;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editparticipationplan',
               	data: 'exhim_id='+exhim_id+'&aem_id='+aem_id,
                 success: function (data) {
                           
                            }     
            });
        }
      



        function Addexhibitor()
        {    	
        
          if($.trim($('#name').val())==''){
            $("#err_name").html('Pleae Enter Organisation Name');
            $("#err_name").fadeIn('fast');
            document.addneexhibitor.name.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#err_name').offset().top);
                    return false;
          }
          
        //   if($.trim($('#organisation_email').val())==''){
        //     $("#err_orgemail").html('Pleae Enter Organisation Email');
        //     $("#err_orgemail").fadeIn('fast');
        //     document.addneexhibitor.organisation_email.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_orgemail').offset().top);
        //             return false;
        //   }
          
          if($.trim($('#email').val())==''){
            $("#err_email").html('Pleae Enter Email Address');
            $("#err_email").fadeIn('fast');
            document.addneexhibitor
            .email.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#err_email').offset().top);
                    return false;
          }
          
        //   if($.trim($('#contact_person_incharge').val())==''){
        //     $("#err_cpi").html('Pleae Enter contact person in-charge');
        //     $("#err_cpi").fadeIn('fast');
        //     document.addneexhibitor
        //     .contact_person_incharge.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_cpi').offset().top);
        //             return false;
        //   }
          
          if($.trim($('#designation').val())==''){
            $("#err_designation").html('Pleae Enter Designation');
            $("#err_designation").fadeIn('fast');
            document.addneexhibitor
            .designation.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#err_designation').offset().top);
                    return false;
          }
          
          if($.trim($('#country').val())==''){
                $("#err_country").html('Pleae Select Country');
                $("#err_country").fadeIn('fast');
                document.addneexhibitor.country.focus();
                //if is any error found. then do this
                $(window).scrollTop($('#err_country').offset().top);
                return false;
            }
            
            
        //     if($('#multiselect2 option:selected').length < 1){
                               
        //         $('#err_nature').html("Please Select Nature Of Your Business!");
        //         $("#err_nature").fadeIn('fast');
        //         $('#multiselect2').focus();
        //         $(window).scrollTop($('#err_nature').offset().top);
        //         return false;
        //   }
                           
          
        //   if($.trim($('#phone').val())==''){
        //     $("#err_contact_mobile").html('Pleae Enter Mobile');
        //     $("#err_contact_mobile").fadeIn('fast');
        //     document.
        //     addneexhibitor.phone.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_contact_mobile').offset().top);
        //             return false;
        //   }

        //   var phone = document.getElementById('phone');
        //   if (phone.value.length < 6) {
        //     $("#err_contact_mobile").html('Please Enter Min 9 Digit Mobile No.');
        //     $("#err_contact_mobile").fadeIn('fast');
        //     document.
        //     addneexhibitor.phone.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_contact_mobile').offset().top);
        //             return false;
        //   }
          
          


        //   if($.trim($('#whatsApp').val())==''){
        //     $("#err_whatsapp").html('Pleae Enter Whatsapp No');
        //     $("#err_whatsapp").fadeIn('fast');
        //     document.
        //     addneexhibitor.whatsApp.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_whatsapp').offset().top);
        //             return false;
        //     }

        //     var whatsapp = document.getElementById('whatsApp');
        //     if (whatsapp.value.length < 10) {
        //     $("#err_whatsapp").html('Please Enter 10 Digit Whatsapp No.');
        //     $("#err_whatsapp").fadeIn('fast');
        //     document.
        //     addneexhibitor.whatsApp.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#err_whatsapp').offset().top);
        //             return false;
        //     }
            
            // if($.trim($('#subcategory').val())==''){
            // $("#err_city").html('Pleae Select City');
            // $("#err_city").fadeIn('fast');
            // document.
            // addneexhibitor.subcategory.focus();
            //  //if is any error found. then do this
            //  $(window).scrollTop($('#err_city').offset().top);
            //         return false;
            // }
            
            if($.trim($('#address').val())==''){
                $("#err_address").html('Pleae Enter Address');
                $("#err_address").fadeIn('fast');
                document.
                addneexhibitor.address.focus();
                 //if is any error found. then do this
                 $(window).scrollTop($('#err_address').offset().top);
                return false;
            }
            
           
            
            
            $.ajax({
				    method:"POST",
				    url:"Addexhibitor",
				    data:$('#addneexhibitor').serialize(),
				    success:function(data){
				      swal({
				          type: 'success',
				          title: 'Success!',
				          text: 'Exhibitor Added Successfully',
				          buttonsStyling: false,
				          confirmButtonClass: 'btn btn-lg btn-success'
				      })
				      setTimeout(function(){ window.location.reload(); }, 3000);
				      return false;
				    }
				  });
        	}

        function updateExhibitor(exhim_id){

        	if($.trim($('#ex_name').val())==''){
            $("#msg_name").html('Pleae Enter Name');
            $("#msg_name").fadeIn('fast');
            document.
            editexhibitor.ex_name.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg_name').offset().top);
                    return false;
          }
          if($.trim($('#ex_email').val())==''){
            $("#msg_email").html('Pleae Enter Email Address');
            $("#msg_email").fadeIn('fast');
            document.editexhibitor
            .ex_email.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg__email').offset().top);
                    return false;
          }
          
          if($.trim($('#ex_country').val())==''){
            $("#msg_country").html('Pleae Select Country');
            $("#msg_country").fadeIn('fast');
            document.
            editexhibitor.ex_country.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg_country').offset().top);
                    return false;
            }
            
        //     if($('#ex_multiselect2 option:selected').length < 1){
                               
        //         $('#err_ex_nature').html("Please Select Nature Of Your Business!");
        //         $("#err_ex_nature").fadeIn('fast');
        //         $('#ex_multiselect2').focus();
        //         $(window).scrollTop($('#err_ex_nature').offset().top);
        //         return false;
        //   }
            
            
          if($.trim($('#ex_phone').val())==''){
            $("#msg_contact").html('Pleae Enter Mobile');
            $("#msg_contact").fadeIn('fast');
            document.
            editexhibitor.ex_phone.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg_contact').offset().top);
                    return false;
          }

          var phone = document.getElementById('ex_phone');
          if (phone.value.length < 6) {
            $("#msg_contact").html('Please Enter 10 Digit Mobile No.');
            $("#msg_contact").fadeIn('fast');
            document.
            editexhibitor.ex_phone.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg_contact').offset().top);
                    return false;
          }
          
          if($.trim($('#ex_stallnumber').val())==''){
                $("#msg_stall").html('Pleae Enter Stall Number');
                $("#msg_stall").fadeIn('fast');
                document.editexhibitor.ex_stallnumber.focus();
                 //if is any error found. then do this
                 $(window).scrollTop($('#msg_stall').offset().top);
                return false;
            }
            
          	if($.trim($('#ex_address').val())==''){
            $("#msg_address").html('Pleae Enter Address');
            $("#msg_address").fadeIn('fast');
            document.
            editexhibitor.ex_address.focus();
             //if is any error found. then do this
             $(window).scrollTop($('#msg_address').offset().top);
                    return false;
            }
            
            // if($.trim($('#ex_subcategory').val())==''){
            // $("#msg_city").html('Pleae Select City');
            // $("#msg_city").fadeIn('fast');
            // document.
            // editexhibitor.ex_cm_ids.focus();
            //  //if is any error found. then do this
            //  $(window).scrollTop($('#msg_city').offset().top);
            //         return false;
            // }

        //   if($.trim($('#ex_whatsApp').val())==''){
        //     $("#msg_whatsapp").html('Pleae Enter Whatsapp No');
        //     $("#msg_whatsapp").fadeIn('fast');
        //     document.
        //     editexhibitor.ex_whatsApp.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#msg_whatsapp').offset().top);
        //             return false;
        //     }

        //     var whatsapp = document.getElementById('ex_whatsApp');
        //     if (whatsapp.value.length < 10) {
        //     $("#msg_whatsapp").html('Please Enter 10 Digit Whatsapp No.');
        //     $("#msg_whatsapp").fadeIn('fast');
        //     document.
        //     editexhibitor.ex_whatsApp.focus();
        //      //if is any error found. then do this
        //      $(window).scrollTop($('#msg_whatsapp').offset().top);
        //             return false;
        //     }
        		 $.ajax({
        		 	headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                	},
				    method:"POST",
				    url:"Addexhibitor",
				    data:$('#editexhibitor').serialize(),
				    success:function(data){
				      swal({
				          type: 'success',
				          title: 'Success!',
				          text: 'Exhibitor Update Successfully',
				          buttonsStyling: false,
				          confirmButtonClass: 'btn btn-lg btn-success'
				      }).then(function() {
                            window.location.reload();
                      });
				      //setTimeout(function(){ window.location.reload(); }, 3000);
				      return false;
				    }
				  });
        	}

        function checked(eem_id,ppm_id,exhim_id,resStatus)
            {
              //alert(ppm_id);return false;
              var s = $('#plan_content_'+exhim_id).clone();
              s.find('.chosen').addClass('swal');

              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                html: s.html(),
                title: 'Are You Sure !',
                preConfirm: function() {
                  return new Promise(function(resolve) {
                    resolve( $('.chosen.swal').val() );
                  });
                }
              }).then(function(result) {
                // reset modal overflow
                $('.swal2-modal').css('overflow', '');
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "changeStatus",
                        data: {'eem_id':eem_id,'result':result,'exhim_id':exhim_id},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                $('#plan'+exhim_id).html(data[0].ppm_text)

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
                                  $("#status_"+exhim_id).prop("checked", false);

                             }else{
                                  $("#status_"+exhim_id).prop("checked", true);
                              }
                            

                    });
              
             
              $('.chosen.swal').chosen({
                width: '35%',
                allow_single_deselect: true
              });
            }

            function showcounselor(exhim_id)
            {
                //alert(exhim_id);
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "showcounselordetail",
                        data: {'exhim_id':exhim_id},
                        success: function (data) {
                            $('#showcounselor_ex').html(data);
                            $('#ex_showcounselor').modal('toggle')  
                                
                            }
                        });
            }
            
            
            function updateVideoUrl(eewbm_id){
                return false;
                 var eewbm_video_caller_id_moderator= $("#eewbm_video_caller_id_moderator"+eewbm_id).val();
                 var eewbm_mpin=$("#eewbm_mpin"+eewbm_id).val();
                  var eewbm_ppin=$("#eewbm_ppin"+eewbm_id).val();
                //   alert(eewbm_mpin);
                //     alert(eewbm_ppin);
                   var video_call_url= $("#video_call_url"+eewbm_id).val();
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "updateVideoUrl",
                        data: "eewbm_id="+eewbm_id+"&video_call_url="+video_call_url+"&eewbm_video_caller_id_moderator="+eewbm_video_caller_id_moderator+"&eewbm_mpin="+eewbm_mpin+"&eewbm_ppin="+eewbm_ppin,
                        success: function (data) {
                           
                                swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Saved Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                            }
                        });
            }
            
            
            
        //category
        function callOrderBy(orderVal,eemId){
           
            if(eemId){
                $.ajax({
                   headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                   type:"POST",
                   url:"requesttosetorderby",
                   data: "orderVal="+orderVal+"&eemId="+eemId,
                   success:function(res){               
                                swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Saved Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                   }
                });
            }   
        }
            
            
            
 </script>

  
@endsection
