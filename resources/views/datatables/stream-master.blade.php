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
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .modal-lg {
        max-width: 90% !important;
    }
</style>
@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Manage Streams</h1>
                <ul>
                  <li>Details</li>
                  <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3">

                    <h4>  <a href="#" class="float-right"  data-toggle="modal" data-target="#CounselorModel" ><button type="button" class="btn btn-info btn-rounded m-1">Add Stream</button></a><h4>
            </div>


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table-responsive">
                              <div class="row ">
                                  <div class="col-md-12">


  <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                   <tr>
                        <th scope="col">#</th>
                        
                               
                                <th scope="col">Conference Name
                                         <div class="divide"> Background Image </div>
                                         <div class="divide"> Page Presentation Video </div>
                                         <div class="divide"> Live Chat Url </div></th>
                               
                                <th scope="col"> Video URL</th>
                        
                                <th scope="col">Action
                                        <div class="divide"> Status </div> 
                                        <div class="divide"> Set Default </div> </th>
                           
            
                    </tr>
                </thead>
                <tbody>
                  
                 @php
                    $i=1
                    @endphp
                    @if(isset($AccessList) && !empty($AccessList))
                        @foreach($AccessList as $list)
                      
                    <tr>
                        
                        <th scope="row">{{$i++}}</th>
                        
                        
                                <td>
                                        <span style="color: red;">{{ $list->mws_name}}</span>
                                        
                                        <div class="divide">
                                            <b>WithVideo: </b>
                                            <a href="{{ config('app.front-appurl') }}/vf/{{Session::get('AprofileDetail')->bm_nickname}}/v1/conference-presentation/{{base64_encode($list->mws_id)}}" target="_blank">conference-presentation/{{base64_encode($list->mws_id)}}</a>
                                            <br>
                                            <b>Direct: </b>
                                            <a href="{{ config('app.front-appurl') }}/vf/{{Session::get('AprofileDetail')->bm_nickname}}/v1/conference/{{base64_encode($list->mws_id)}}" target="_blank">conference/{{base64_encode($list->mws_id)}}</a>
                                        </div>
                                        
                                        <!------- Backgroung Image -------->
                                        <hr>
                                        
                                            @if(!empty($list->mws_background_img))
                                                <a href="javascript:void(0);" onclick="showImage('{{$list->mws_background_img }}');"> 
                                                    <img width="200px;" src="{{ URL::to('/') }}{{'/public/assets/images/'.Session('A_Session')->bm_id.'/conferencehall/'.$list->mws_background_img }}">
                                                </a>
                                            @endif
                                        
                                        
                                        <div class="divide"> 
                                           @if(!empty($list->mws_presentation_video))
                                            <a href="{{$list->mws_presentation_video}}" target="_new">View Presentation Video</a>
                                           @endif
                                        </div>
                                        <div class="divide"> {{$list->mws_live_chat_url}}</div>
                                </td>
                              
                                <td>
                                    
                                         <table style="width: 100%;">
                                    <tr>
                                        <td> <b>Vimeo URL:</b> <span style="color: blue;">{{ $list->mws_video_url}}</span></td>
                                        <td> 
                                        @if(!empty($list->mws_video_url))
                                                <?php
                                                
                                                $video='';
                                                $vstat='';
                                                
                                                if($list->mws_active_url=='live_video'){
                                                $video='checked';
                                                $vstat='disabled';
                                                }
                                                
                                                ?>
                                                
                                                <label class="switch switch-success mr-3"  <?php if($vstat!='disabled') { ?>onclick="ActivateStream('{{$list->mws_id}}','live_video');" <?php }?>>
                                                <input type="checkbox" {{$video}} {{$vstat}} id="live_video{{$list->mws_id}}">
                                                <span class="slider"></span>
                                                </label>
                                        @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td> <b>YouTube URL:</b> <span style="color: blue;">{{ $list->mws_youtube_url}}</span></td>
                                        <td> 
                                         @if(!empty($list->mws_youtube_url))
                                                <?php
                                                
                                                    $youtube='';
                                                    $ystat='';
                                                    if($list->mws_active_url=='youtube'){
                                                        $youtube='checked';
                                                         $ystat='disabled';
                                                    }
                                                
                                                ?>
                                                 <label class="switch switch-success mr-3" <?php if($ystat!='disabled') { ?>onclick="ActivateStream('{{$list->mws_id}}','youtube');" <?php }?>>
                                                    <input type="checkbox" {{$youtube}} {{$ystat}} id="youtube{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                          @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td> <b>Facebook URL:</b> <span style="color: blue;">{{ $list->mws_facebook_url}}</span></td>
                                        <td>
                                             @if(!empty($list->mws_facebook_url)) 
                                                <?php
                                                
                                                    $facebook='';
                                                    $fstat='';
                                                    if($list->mws_active_url=='facebook'){
                                                        $facebook='checked';
                                                         $fstat='disabled';
                                                    }
                                                
                                                ?>
                                                 <label class="switch switch-success mr-3"  <?php if($fstat!='disabled') { ?>onclick="ActivateStream('{{$list->mws_id}}','facebook');" <?php }?>>
                                                    <input type="checkbox" {{$facebook}} {{$fstat}} id="facebook{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td> <b>Post Webinar URL:</b> <span style="color: blue;">{{ $list->mws_webinar_finish_url}}</span> </td>
                                        <td> 
                                            @if(!empty($list->mws_webinar_finish_url)) 
                                                <?php
                                                
                                                    $after_webinar='';
                                                    $afstat='';
                                                    
                                                    if($list->mws_active_url=='after_webinar'){
                                                        $after_webinar='checked';
                                                        $afstat='disabled';
                                                    }
                                                
                                                ?>
                                                 <label class="switch switch-success mr-3" <?php if($afstat!='disabled') { ?>onclick="ActivateStream('{{$list->mws_id}}','after_webinar');" <?php }?>>
                                                    <input type="checkbox" {{$after_webinar}} {{$afstat}} id="after_webinar{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td> <b>Gallery</b> <span style="color: blue;"></span> </td>
                                        <td> 
                                           
                                                <?php
                                                
                                                    $gallery='';
                                                    $afgal='';
                                                    
                                                    if($list->mws_active_url=='gallery'){
                                                        $gallery='checked';
                                                        $afgal='disabled';
                                                    }
                                                
                                                ?>
                                                 <label class="switch switch-success mr-3" <?php if($afgal!='disabled') { ?>onclick="ActivateStream('{{$list->mws_id}}','gallery');" <?php }?>>
                                                    <input type="checkbox" {{$gallery}} {{$afgal}} id="gallery{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                           
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                    
                                    
                                </table>
                               
                                 </td>
                                 
                                
                                       
                                 <td>
                                            
                                            <a href="javascript:void(0);" class="text-success mr-2" onclick="editAccessPermission('{{$list->mws_id}}');">
                                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                                            
                                           
                                            <hr>
                                            @if($list->mws_status=='active')
                                                <label class="switch switch-success mr-3" onclick="changePerStatus('{{$list->mws_id}}','{{$list->mws_status}}');">
                                                    <input type="checkbox" checked="" id="pssh1{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch switch-success mr-3" onclick="changePerStatus('{{$list->mws_id}}','{{$list->mws_status}}');"> 
                                                    <input type="checkbox" id="pssh_che{{$list->mws_id}}" >
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                            
                                            <hr>
                                            @if($list->isDefault=='Y')
                                                <label class="switch switch-success mr-3" onclick="setDefaultStatus('{{$list->mws_id}}','N');">
                                                    <input type="checkbox" checked="" id="sdsY{{$list->mws_id}}">
                                                    <span class="slider"></span>
                                                </label>
                                            @else
                                                <label class="switch switch-success mr-3" onclick="setDefaultStatus('{{$list->mws_id}}','Y');"> 
                                                    <input type="checkbox" id="sdsN{{$list->mws_id}}" >
                                                    <span class="slider"></span>
                                                </label>
                                            @endif
                                            
                                            <hr>
                                            @if($list->mws_active_url=='gallery')
                                                 <div class="divide">
                                                    <a href="gallery?mwsid={{$list->mws_id}}" class="btn btn-success" >Manage Gallery</a>
                                                 </div>
                                            @endif
                                            
                                        
                                         
                                
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
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Add Stream Details</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                       
                        <form name="addneexhibitor" id="addneexhibitor" class="" action="AddeStreams" method="post"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                              <input class="form-control" type="hidden" name="addcourse" id="addcourse" value="addcourse" />
                             <div class="card mb-4">
                                <div class="card-body">                
                                <div class="row">
                                    
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="course_duration">Mode</label>
                                        <select class="form-control" name="mws_mode" id="mws_mode">
                                            <option value="live" selected>Live</option>
                                            <option value="gallery">Gallery</option>
                                        </select>
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                      <div class="col-md-4 form-group mb-3 ">
                                        <label for="course_duration">Has Exhibition</label>
                                        <select class="form-control" name="mws_has_exhibition" id="mws_has_exhibition">
                                            <option value="Yes"  >Yes</option>
                                            <option value="No"  >No</option>
                                        </select>
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="course_duration">Exhibition URL</label>
                                        <input type="text" class="form-control" name="mws_exhibition_url" id="mws_exhibition_url" placeholder="Exhibiton URL"
                                        value="" >
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="course_duration">Conference Name</label>
                                        <input type="text" class="form-control" name="mws_name" id="mws_name" placeholder="Name"
                                        value="">
                                        <span class="text-danger" id="err_name" name="err_name"  style="display:none;"></span>
                                    </div>
                                    
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="course_fee_sem">Vimeo URL</label>
                                        <input type="text" class="form-control" name="mws_video_url" id="mws_video_url" placeholder="Vimeo url" 
                                         value="">
                                        <span class="text-danger" id="err_phone" name="err_phone"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-4 form-group mb-3">
                                        <label for="course_fee_sem">YouTube URL</label>
                                        <input type="text" class="form-control" name="mws_youtube_url" id="mws_youtube_url" placeholder="Youtube embed url" 
                                         value="">
                                        
                                    </div>
                                     <div class="col-md-4 form-group mb-3">
                                        <label for="course_fee_sem">Facebook URL</label>
                                        <input type="text" class="form-control" name="mws_facebook_url" id="mws_facebook_url" placeholder="Facebook embed url" 
                                         value="">
                                        
                                    </div>
                                     <div class="col-md-4 form-group mb-3">
                                        <label for="course_fee_sem">Post Conference URL</label>
                                        <input type="text" class="form-control" name="mws_webinar_finish_url" id="mws_webinar_finish_url" placeholder="Post Conference url" 
                                         value="">
                                    </div>
                                    
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="liveChatUrl">Live Chat URL</label>
                                        <input type="text" class="form-control" name="liveChatUrl" id="liveChatUrl" placeholder="Live Chat url" 
                                         value="" >
                                        <span class="text-danger" id="err_liveChatUrl" name="err_liveChatUrl"  style="display:none;"></span>
                                    </div>

                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="presentationVideoUrl">Page Presentation Video Url</label>
                                         <textarea  class="form-control" name="presentationVideoUrl" id="presentationVideoUrl" placeholder="Page Presentation Video Url"></textarea> 
                                      
                                    </div>
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">Upload Background Image <span style="color:red;">[choose File 1920 * 1080 px]</span></label>
                                        <input type="file" class="form-control" name="web_bgimage" id="ImageBrowse" placeholder="Image for Background" 
                                         value="">
                                    </div>
                                    
                                    <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="pageHtml"> Page Footer Wigets HTML </label>
                                                    <textarea class="form-control" name="footer_wigets" id="footer_wigets" placeholder="Footer Wigets" style="height: 200px;"></textarea>
                                                    
                                                </div>
                                                
                                                 <div class="col-md-6 form-group mb-3 d-none">
                                                    <label for="pageHtml"> Page Custom CSS (<em>Witout style tag</em>) </label>
                                                    <textarea class="form-control" name="mws_custom_css" id="mws_custom_css" placeholder="Custom" style="height: 200px;"></textarea>
                                                    
                                                </div>
                                    <!--
                                     <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Upload Left Banner <span style="color:red;">[choose File 310 * 131 px]</span></label>
                                        <input type="file" class="form-control" name="web_leftBanner" id="web_leftBanner" placeholder="Image for Left Banner" 
                                         value="">
                                    </div>
                                    
                                     <div class="col-md-12 form-group mb-3">
                                        <label for="course_fee_sem">Upload Right Banner <span style="color:red;">[choose File 310 * 131 px]</span></label>
                                        <input type="file" class="form-control" name="web_rightBanner" id="web_rightBanner" placeholder="Image for Right Banner" 
                                         value="">
                                    </div>
                                   --> 
                                   
                                   
                                <div class="col-md-12 form-group mb-3">
                                	<label> Set As Default Page </label>
                                	<div class="form-check">
                                		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultNoMws" value="N" checked>
                                		<label class="form-check-label" for="isDefaultNoMws">
                                			No
                                		</label>
                                	</div>
                                	<div class="form-check">
                                		<input class="form-check-input" type="radio" name="isDefault" id="isDefaultYesMws" value="Y">
                                		<label class="form-check-label" for="isDefaultYesMws">
                                			Yes
                                		</label>
                                	</div>
                                	<span class="text-danger" id="err_isDefault" style="display:none;"></span>
                                </div>
                                   
                                   
                                </div>
                        </div>
                        
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" >Add </button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
 <!--End Courses Offered modal -->



<!-- start Edit User modal -->
        <div class="modal fade" id="EditStreamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->


            </div>
            <!-- end of row -->



@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
 <script src="{{asset('assets/js/datatables.script.js')}}"></script>
  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
 <script type="text/javascript">
   

        function showImage(imgUrl)
        {
                var htmlCreat="";
                    htmlCreat +='<div class="modal-header">';
                    htmlCreat +='   <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Background Image</h4></h5>';
                    htmlCreat +='   <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    htmlCreat +='       <span aria-hidden="true">&times;</span>';
                    htmlCreat +='   </button>';
                    htmlCreat +='</div>';
                    htmlCreat +='<div class="modal-body">';
                    htmlCreat +='  <img  src="{{ URL::to('/') }}/public/assets/images/{{Session::get('AprofileDetail')->bm_id}}/conferencehall/'+imgUrl+'">';
                    htmlCreat +='</div>';

        		        
		        
            $('#edit').html('');
            $('#edit').html(htmlCreat);
            $('#EditStreamModal').modal('toggle');
            
        }

        $(document).ready(function (e) {
                $('#addneexhibitor').on('submit',(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var urlAction = $(this).attr('action');
                    addeditwebinarst(urlAction, formData);
                }));
        });

        function addeditwebinarst(setUrl, forData){
                $.ajax({
                    type:'POST',
                    url: setUrl,
                    data:forData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Stream Added Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                             setTimeout(function(){ window.location.reload(); }, 3000);
                             return false;
                        //console.log("success");
                        //console.log(data);
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                });
        }




        function AddeAccessPermission()
        {       
                          if($.trim($('#mws_name').val())==''){
                            $("#err_name").html('Pleae Enter Conference Name');
                            $("#err_name").fadeIn('fast');
                            document.
                            addneexhibitor.mws_name.focus();
                             $(window).scrollTop($('#err_name').offset().top);
                                    return false;
                          }
                          if($.trim($('#mws_video_url').val())==''){
                            $("#err_phone").html('Pleae Enter Vimeo Url');
                            $("#err_phone").fadeIn('fast');
                            document.addneexhibitor
                            .mws_video_url.focus();
                             $(window).scrollTop($('#err_phone').offset().top);
                                    return false;
                          }
         
                        $.ajax({
                            method:"POST",
                            url:"AddeStreams",
                            data:$('#addneexhibitor').serialize(),
                            success:function(data){
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Stream Added Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                              setTimeout(function(){ window.location.reload(); }, 3000);
                              return false;
                            }
                        });
            }

        function editAccessPermission(mws_id)
        {
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editStreams',
                data: 'mws_id='+mws_id,
                success: function (data) {           
                    $('#edit').html(data);
                    $('#EditStreamModal').modal('toggle')
                    }      
            });
        }

        function updateAccessPermission(mws_id){
                 $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:"POST",
                    url:"updateStreams",
                    data:$('#editStream').serialize(),
                    success:function(data){
                      swal({
                          type: 'success',
                          title: 'Success!',
                          text: 'Stream details Updated Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                      setTimeout(function(){ window.location.reload(); }, 3000);
                      return false;
                    }
                  });
            }
            
            function ActivateStream(mws_id,mws_active_url){
                 var status='active';
                  var setText="set";

              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'Are you sure you want to Changed ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "ActivateStream",
                        data: {'mws_id':mws_id,'mws_active_url':mws_active_url},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                               
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){ 
                   
                       
                         $("#"+mws_active_url+mws_id).prop("checked", false); 
                           
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
                  
            }

        function changePerStatus(mws_id,mws_status)
            {
             
             var setText="unset";
                        var status='active';
                        if(mws_status=='active'){
                            setText="set";
                            status='inactive';
                        }
              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'Are you sure you want to Changed ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "changeStreamStatus",
                        data: {'mws_id':mws_id},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                // setTimeout(function(){ window.location.reload(); }, 1000);
                                // return false;
                               
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){ 
                      if(mws_status=='active'){
                       
                          $("#pssh1"+mws_id).prop("checked", true);
                        }else{
                         
                          $("#pssh_che"+mws_id).prop("checked", false); 
                        }       
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
            }
            
            
            
            
function setDefaultStatus(mws_id,isDefault){
    if(mws_id){
        swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'You want to Change ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "setDefaultStatusMws",
                        data: {'mws_id':mws_id,'isDefault':isDefault},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){
                      if(isDefault=='Y'){
                          $("#sdsN"+mws_id).prop("checked", false);
                        }else{
                          $("#sdsY"+mws_id).prop("checked", true); 
                        }
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");
                      }
                  });   
    }
}

            
 </script>

  
@endsection
