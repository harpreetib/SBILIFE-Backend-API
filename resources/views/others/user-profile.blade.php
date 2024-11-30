@extends('layouts.master')
@section('page-css')


<?php
//dd(Session::get('brand'));
$ver=rand();
?>
<?php

   if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
       $bUrl="https://";
       $bUrl.=$_SERVER['SERVER_NAME'];
       if(isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])){
          $bUrl.=$_SERVER['REQUEST_URI'];
       }
       header('Location: '.$bUrl);
       exit;
    } ?>
<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/css/custom-style.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/css/stall.css?v='.$ver)}}">



<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />



<style>
.avatar-lg {
    width: 150px;
    height: 150px;
}

.user-profile .user-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: unset;
    margin-top: -28px;
    z-index: 9;
}

.modal-lg {
    max-width: 90% !important;
}

.divide{
    border-top: 1px solid #dee2e6;
}

.frame {
        width: 100%;
        height: 800px;
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans,
          Droid Sans, Helvetica Neue, sans-serif;
        padding: 20px;
        font-size: 14px;
        border: none;
      }
      .warning {
        background-color: #df68a2;
        padding: 3px;
        border-radius: 5px;
        color: white;
      }
</style>
@endsection

@section('main-content')


<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

<?php  
    $profile_pic="/public/assets/images/faces/University-Logo.png"; 
    if(!empty($profileDetail->exhim_logo)){
        $profile_pic='/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_logo;
    }
    
?>

<div class="breadcrumb">
    <h1>Manage Profile</h1>
    <ul>
        <!--<li><a href="">Pages</a></li>-->
        <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
        <!--<li class="float-right"><a  class="btn btn-secondary"  target="_blank" href="https://virtual.smeexpo.asia/vfair/exhibitor/{{Session::get('brand')}}/{{Session::get('selectedEvent')->aem_event_nickname}}/{{base64_encode($profileDetail->exhim_id)}}"><i class="i-Video"> Preview</i></a></li> -->
    </ul>
</div>

            <div class="separator-breadcrumb border-top"></div>
            
           <?php
            $imgUel="/public/assets/images/faces/banner.jpg";
            if(!empty($profileDetail->exhim_banner)){
                $imgUel='/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_banner;
               
                if(!file_exists($imgUel)){
                    //$imgUel="";
                }
            }
                
           ?>

            

            <div class="card user-profile o-hidden mb-4 ">
                
                <!--old: Header Cover -->
                <div class="header-cover d-none" style="background-image: url({{ URL::to('/') }}{{$imgUel}})">
                       
                        <div class="card-img-overlay d-none">
                            <div class="p-1 text-right card-header font-weight-light d-flex">
                                <a href="#" class="btn btn-primary" onclick="bannerUpload('{{$profileDetail->exhim_id}}', '{{$profileDetail->exhim_banner}}', 'update');" data-toggle="modal" data-target="#photosmodal"> <span class="d-flex align-items-center"><i class="i-Edit mr-2"></i>Change</span></a>
                            </div>
                        </div>
              

                       

                </div>
                <!--old: logo Cover -->
                <div class="user-info d-none">
                    <div class="row"> 

                        <div class="col-3"> 
                           
                            <div class="avatar-lg mb-1" style="float: right;">
                                 <label> Logo  <em>( 330 X 150 px )</em></label>
                                
                                <div class="p-1 text-left card-header font-weight-light d-flex">
                                    
                                    <a href="#" class="btn btn-primary" onclick="logoUpload('{{$profileDetail->exhim_id}}', '{{$profileDetail->exhim_logo}}', 'update');" data-toggle="modal" data-target="#photosmodal"> 
                                        <img  class="mb-1" src="{{ URL::to('/') }}{{ $profile_pic }}" alt="" >
                                        
                                        <span class="d-flex align-items-center" ><i class="i-Edit mr-2"></i>Change Logo</span>
                                    </a>
                                </div>
                            </div>

                        </div>
            
                        <div class="col-9 py-4" style="margin-left: -28px;"> 
                          
                             <h4>Fascia Name/ Exhibitor Name </h4>
                        
                            <a href="javascript:void(0);" onclick="reqUpdateFormFields('loctionDetail','','');"> 
                               
                                <p class="m-0 text-24">{{$profileDetail->exhim_organization_name}}</p>
                                 <p class="text-muted m-0">Country: {{$profileDetail->counm_name}} </p>
                                <p class="text-muted m-0">Address: {{$profileDetail->exhim_address}} </p>
                                 
                                <!--<p class="text-muted m-0">City: {{$profileDetail->cm_name}} </p>-->
                                <!--<p class="text-muted m-0">State: {{$profileDetail->sm_name}} </p>-->

                                <span class="d-flex align-items-center" ><i class="i-Edit mr-2"></i>Change</span>
                            </a>
                            
                        </div>
    
                    </div>
                </div>






                <div class="card-body">
                    <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">Booth Setup </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#imagegallery" role="tab" aria-controls="friends" aria-selected="false">Image Gallery</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videogallery" role="tab" aria-controls="friends" aria-selected="false">Video Gallery</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="brochures-tab" data-toggle="tab" href="#brochures" role="tab" aria-controls="friends" aria-selected="false">Brochure</a>
                        </li>
                        
                        <li class="nav-item d-none">
                            <a class="nav-link " id="myavatar-tab" data-toggle="tab" href="#myavatar" role="tab" aria-controls="myavatar" aria-selected="false">My Avatar</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="convai-tab" data-toggle="tab" href="#convai_characters" role="tab" aria-controls="friends" aria-selected="false">Convai Character</a>
                        </li>
                        
                    </ul>

                    <div class="tab-content" id="profileTabContent">

                      <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                          
                          
                          <h4 class="d-none">QUICK FACTS</h4>
                          <a class="float-right d-none" href="javascript:void(0);" onclick="reqUpdateFormFields('quickFactsDetail','','');"><i class="i-Edit text-primary">Edit</i></a>

                          <div class="row d-none" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;">
                              <div class="col-md-4 col-6">
                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Type of Institute</p>
                                      <span>{{$profileDetail->exhim_type_of_institute}}</span>
                                  </div>
                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Affiliation</p>
                                      <span>{{$profileDetail->exhim_ownership}}</span>
                                  </div>

                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Estd. Year</p>
                                      <span>{{$profileDetail->exhim_estd_year}}</span>
                                  </div>
                                 
                              </div>
                              <div class="col-md-4 col-6">
                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Accreditation</p>
                                      <span>{{$profileDetail->exhim_accreditation}}</span>
                                  </div>
                                  <div class="mb-4">
                                    <p class="text-primary mb-1">Recognition</p>
                                    <span>{{$profileDetail->exhim_recognition}}</span>
                                </div>
                              </div>


                              <div class="col-md-4 col-6">
                                
                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Campus Size</p>
                                      <span>{{$profileDetail->exhim_campus_area}}</span>
                                  </div>

                                  <div class="mb-4">
                                      <p class="text-primary mb-1">Approval</p>
                                      <span>{{$profileDetail->exhim_approval}}</span>
                                  </div>


                              </div>
                          </div>

                        <!--<hr>-->
                        
                        
                        
                        <?php
                        //dd($boothdesign);
                        ?>

                        <h4>Booth Design</h4>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                        @foreach($boothdesign as $design)
                         
                             <div class="col-md-4" id="{{$design->ebm_id}}">
                                    <div class="card text-white o-hidden mb-3">
                                        <img class="card-img" src="{{ URL::to('/') }}/public/assets/images/boothdesign/{{$design->ebm_image}}" alt="" >
                                        <div class="card-img-overlay">
                                            <div class="p-1 text-left card-header font-weight-light d-flex">
                                                <a href="#" class="btn @if($design->ebm_id==$profileDetail->ebm_id) btn-success @else btn-secondary @endif" onclick="updateboothdesign('{{$design->ebm_id}}');"> <span class="d-flex align-items-center"><i class="i-Edit mr-2"></i>  @if($design->ebm_id==$profileDetail->ebm_id) selected @else Select Design @endif</span></a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           @endforeach 
                        </div>
                        <hr>
                      <h4>Booth Setup 
                     
                       <!--<a  target="_blank" href="">View My Page</a>-->
                       @php
                         $eventNickName=(isset(Session::get('selectedEvent')->aem_event_nickname) ? Session::get('selectedEvent')->aem_event_nickname : 'v1');
                       @endphp
                     
                       <span class="d-none" style="font-size:14px;">(<mark> <a href="https://liveexpo.terraterri.com/?uniqueid={{base64_encode($exhim_email)}}" target="_blank">View Booth</a></mark> ) <em><b>Open in Metaverse</b></em>
                       
                       </span>
                       
                     
                       </h4>
                       
                                @include('others.stall-design1')
                     
                        
                        
                        <hr>
                        
                         <h4 class="d-none">Standee Image & Booth Led Video</h4>
                        <div class="row d-none" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                               
                                    
                                   
                                    
                                    <div class="col-md-4 d-none">
                                        <div class="card mb-3">
                                          <form class="" name="standee2form" action="saveuserprofile" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                             <div class="col-md-12">
                                             <label>Standee 2 Image (118 X 250 px) (<em>If Booth has 2 standees</em>)</label>
                                                      <div class="input-group mb-2">
                                                           
                                                        <input type="hidden" name="standee2image" id="standee2image" value="standee2image">
                                                          <input type="file" class="form-control" id="upload2_standee" name="upload2_standee" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                                        
                                                          <div class="input-group-append">
                                                              <button class="btn btn-primary" type="submit" id="button-comment1">Change/Upload</button>
                                                          </div>
                                                      </div>
                                          </div>
                                         
                                          </form>
                                            <div class="mb-2 text-center">
                                               @if($profileDetail->exhim_right_standee)
                                             <img class="rounded mb-2" src="{{ URL::to('/') }}{{'/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_right_standee}}" alt="" style="width:118px; height:250px;"> 
 
                                            @endif
                                            </div>
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 d-none">
                                        <div class="card mb-3">
                                          <form class="" name="standeeformmobile" action="saveuserprofile" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <label>Standee Mobile Version</label>
                                          <div class="input-group mb-2">
                                               
                                            <input type="hidden" name="standeeimagemo" id="standeeimagemo" value="standeeimagemo">
                                              <input type="file" class="form-control" name="upload_standee_mo" placeholder="Change/Upload Standee Image" aria-label="Standee" accept="image/x-png,image/gif,image/jpeg" />
                                            
                                              <div class="input-group-append">
                                                  <button class="btn btn-primary" type="submit" id="button-comment1">Change/Upload</button>
                                              </div>
                                          </div>
                                         
                                          </form>
                                            <div class="mb-2">
                                             
                                            </div>
                                            @if($profileDetail->exhim_mo_standee)
                                             <img class="rounded mb-2" src="{{ URL::to('/') }}{{'/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_mo_standee}}" alt=""> 
 
                                            @endif
                                        </div>
                                    </div>
                                    
                                    
                                  
                                    
                                  
                        </div>

                             
                        
                         <hr>
                         <!--h4>Lobby Image  Or  Lobby Video</h4-->
                         <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;" >
                            
                            
                            <!--Booth: Lobby Image  -->
                                    <div class="col-md-6 d-none">
                                        <div class="card mb-3">
                                          <form class="" name="lobbyForm" action="saveuserprofile" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <div class="col-md-12">
                                                      <label>Booth: Lobby Image  <em>( 1920 X 1080 px )</em></label>
                                                      <div class="input-group mb-2">
                                                           
                                                          <input type="hidden" name="lobbyImage" id="lobbyImage" value="lobbyImage-1">
                                                          <input type="file" class="form-control" id="upload_lobbyImage" name="upload_lobbyImage" placeholder="Change/Upload Loby Image" aria-label="lobbyImage" accept="image/x-png,image/gif,image/jpeg" />
                                                        
                                                          <div class="input-group-append">
                                                              <button class="btn btn-primary" type="submit" id="button-comment1">Change/Upload</button>
                                                          </div>
                                                      </div>
                                                </div>
                                         
                                          </form>
                                          
                                            <div class="mb-2 text-center">
                                               @if($profileDetail->exhim_lobby_image)
                                                    <img class="rounded mb-2" src="{{ URL::to('/') }}{{'/public/assets/images/'.$bmid.'/'.$profileDetail->exhim_id.'/'.$profileDetail->exhim_lobby_image}}" alt="" style="height:250px;" ><!--style="width:118px; height:250px;"--> 
                                              @endif
                                            </div>
                                           
                                        </div>
                                    </div> 
                                    
                                    
                                    <!-- Booth: lobby video -->
                                    <div class="col-md-6 d-none">
                                        <div class="card mb-3">
                                             <form class="" name="lobbyvideoForm" action="saveuserprofile" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                             
                                             <div class="col-md-12">
                                                 <label>Booth: Lobby Video</label>
                                                  <div class="input-group mb-2">
                                                      <input type="hidden" name="lobbyvideo" id="lobbyvideo" value="lobbyvideo-1">
                                                      <input type="text" class="form-control" name="lobbyvideo_url" id="lobbyvideo_url" placeholder="Embed URL/Link of a Youtube Video." aria-label="video" required>
                                                      <div class="input-group-append">
                                                          <button class="btn btn-primary" type="submit" id="button-comment1" >Add/Change Video</button>
                                                      </div>
                                                  </div>
                                             </div>
                                           
                                          </form>
                                              @if(!empty($profileDetail->exhim_lobbyvideo))
                                                 <div class="col-md-12" id="exhim_stall_video">
                                                <div class="card  mb-3">
                                                    <iframe  height="250px;" src="{{$profileDetail->exhim_lobbyvideo}}" autoplay="false" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            @endif
                                         </div>
                                    </div>
                                    
                            
                         </div> 
                            
                        
                        <!--<hr>
                        <h4 class="d-none">About Us</h4>
                        <a class=" float-right" href="#" data-toggle="modal" data-target="#highlightmodal"><i class="i-Edit text-primary">Edit</i></a>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;">
                            <div class="col-md-12">
                                @if(isset($highlightDetail) && !empty($highlightDetail))
                                    @foreach($highlightDetail as $highlight)
                                       <p>{{ $highlight->ehm_highlight_text }} </p>
                                      @endforeach
                                @endif
                            
                            </div>
                            
                        </div>
                        
                        <hr>
                        
                        

                        <h4>Contact Us</h4>
                        <a class="float-right" href="javascript:void(0);" onclick="reqUpdateFormFields('contactUsDetail','','');" ><i class="i-Edit text-primary">Edit</i></a>
                        <div class="row" style="border: 1px solid #e5e5e5;padding-top: 10px;border-radius: 27px;">
                              
                            
                              
                              
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Email text-16 mr-1"></i>Industry</p>
                                      <span>{!! $profileDetail->ot_name_ae !!}</span>
                                  </div>
                              </div>
                              
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Email text-16 mr-1"></i>Exhibitor Profile</p>
                                      <span>{{$profileDetail->epm_name}}</span>
                                  </div>
                              </div>
                              
                             
                              
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Website </p>
                                      <span>{{$profileDetail->exhim_web_link}}</span>
                                  </div>
                                 
                              </div>
                               <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Facebook-2 text-16 mr-1"></i> Facebook </p>
                                      <span>{{$profileDetail->exhim_facebook_link}}</span>
                                  </div>
                                 
                              </div>
                             
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Youtube text-16 mr-1"></i> Youtube </p>
                                      <span>{{$profileDetail->exhim_youtube_link}}</span>
                                  </div>
                                 
                              </div>
                               
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Instagram text-16 mr-1"></i> Instagram </p>
                                      <span>{{$profileDetail->exhim_instagram_link}}</span>
                                  </div>
                                 
                              </div>
                            
                              <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Twitter text-16 mr-1"></i> Twitter </p>
                                      <span>{{$profileDetail->exhim_twitter_link}}</span>
                                  </div>
                                 
                              </div>
                              
                               <div class="col-md-4 col-4" >
                                  <div class="mb-4">
                                      <p class="text-primary mb-1"><i class="i-Linkedin-2 text-16 mr-1"></i> LinkedIn </p>
                                      <span>{{$profileDetail->exhim_linkedIn_link}}</span>
                                  </div>
                                 
                              </div>
                             
                              


                        </div> ---->


                      </div>

                        <div class="tab-pane fade " id="brochures" role="tabpanel" aria-labelledby="brochures-tab">
                            <ul class="timeline clearfix">
                                <li class="timeline-line"></li>
                                    <div class="timeline-card card">
                                        <div class="card-body">
                                            
                                            <form class="" name="brochureform" action="saveuserprofile" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                             <label><span class="text-danger">Note:</span> Maximum 15Mb File Upload Size Allowed</label>
                                          
                                          
                                                <div class="row input-group mb-2">
                                                    
                                                    <div class="form-group col-md-2 mb-3">
                                                        <select class="custom-select" name="etdId" id="bdoor_id">
                                                            @foreach($doorList as $detail)
                                                            <option value="{{$detail->etd_id}}">{{$detail->etd_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger" id="err_bCaption_cfy"  style="display:none;"></span>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4 mb-3">
                                                        <input type="text" class="form-control" name="brochure_caption" id="brochure_caption" placeholder="Brochure Caption" aria-label="caption" required>
                                                        <span class="text-danger" id="err_bCaption_cfy"  style="display:none;"></span>
                                                      </div>
                                                      
                                                    <div class="form-group col-md-4 mb-3">
                                                        <input type="file" class="form-control" name="upload_brochure" placeholder="Change/Upload Brochure" aria-label="Brochure" accept="application/pdf"  required/>
                                                    </div>
                                              
                                                     <div class="form-group col-md-2 mb-3">
                                                         <input type="hidden" name="brochure" id="brochure" value="brochure">
                                                          <button class="btn btn-primary" type="submit" id="button-comment1">Change/Upload</button>
                                                      </div>
                                                </div>
                                            </form>
                                           
                                            <div class="mb-2">
                                                <h4>Brochure</h4>
                                            </div>
                                            
                                            <div class="row">
                                            @if(count($galleryDetail['brochure'])!=0)
                                                @foreach($galleryDetail['brochure'] as $gallery)
                                                <div class="col-md-4" id="{{$gallery->eg_id}}">
                                                    <div class="card text-white o-hidden mb-3">
                                                        <div class="text-left">
                                                            <button class="btn btn-danger" onclick="removevideo('{{$gallery->eg_id}}');" style="margin-top: 0px;margin-left: 0px;" id="deleteBro"> 
                                                                <span class="d-flex align-items-center"><i class="i-Close-Window font-weight-bold"></i>Remove</span>
                                                            </button>
                                                            <span class="text text-primary float-center font-weight-bold ml-4 mt-2">{{$gallery->etd_name}}</span>
                                                        </div>
                                                        <div id="brochure-{{$gallery->eg_id}}">
                                                         <iframe class="rounded mb-2" src="{{ URL::to('/') }}{{'/public/assets/images/booth/'.$bmid.'/'.$profileDetail->exhim_id.'/brochure/'.$gallery->eg_name}}"
                                              width="100%" height="500" frameborder="0" align="center" >

                                                        </iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                              @else
                                                    <div class="col-md-12">
                                                        <div class="card text-dark o-hidden mb-3">
                                                           <div class="row">
                                                                 <div class="col-md-12 m-4" >
                                                                    <h3>No Brochure Added !!</h3>
                                                                </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                    
                                                @endif
                                                </div>

















                                        </div>
                                    </div>

                            </ul>

                        </div>


                        <div class="tab-pane fade" id="imagegallery" role="tabpanel" aria-labelledby="images-tab">
                            
                            <div class="row">
                                <h4> Image Gallary List</h4>
                                  <div class="col-md-12 mb-3">
                                    <h4>  <a href="#" class="float-right" onclick="uploadphotoEvnt();" data-toggle="modal" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Photo</button></a><h4>
                                  </div>
                                
                               @if(count($galleryDetail['image'])!=0)
                                    @foreach($galleryDetail['image'] as $gallery)
                                    <div class="col-md-4" id="{{$gallery->eg_id}}">
                                        <div class="card text-white o-hidden mb-3">
                                            <img class="card-img" loading="lazy" src="{{ URL::to('/') }}{{'/public/assets/images/booth'}}/{{$bmid}}/{{$profileDetail->exhim_id}}/gallery/{{$gallery->eg_name}}" alt="">
                                            <div class="card-img-overlay">
                                                <div class="p-1 text-left card-header font-weight-light d-flex">
                                                    <a href="#" class="btn btn-secondary" onclick="updatephotoEvnt('{{$gallery->eg_id}}','{{$gallery->eg_name}}','{{$gallery->eg_caption}}','{{$gallery->gcm_id}}');" data-toggle="modal" data-target="#photosmodal"> <span class="d-flex align-items-center"><i class="i-Edit mr-2"></i>Change</span></a>
                                                    <a href="#" class="btn btn-primary" onclick="removevideo('{{$gallery->eg_id}}');"> <span class="d-flex align-items-center"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>

                                                </div>
                                                 <div class="text-white float-left">Caption: {{$gallery->eg_caption}}</div>
                                                 <br>
                                                 <div class="text-white float-left"><b>Category: {{$gallery->gcm_name}}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                  @else
                                        <div class="col-md-12">
                                            <div class="card text-dark o-hidden mb-3">
                                               <div class="row">
                                                     <div class="col-md-12 m-4" >
                                                        <h3>No Photos Added !!</h3>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        
                            @endif


                            </div>
                        </div>
                        
                        
                        <div class="tab-pane fade" id="videogallery" role="tabpanel" aria-labelledby="videos-tab">
                            <div class="row">
                                
                              <label>Videos Gallery list</label>
                              
                              <div class="col-md-12 mb-3">
                                   <form class="" name="videoform" id="videoform" method="post" enctype="multipart/form-data">
                                         
                                         <div class="row input-group mb-2">
                                                  <div class="form-group col-md-4 mb-3 d-none">
                                                     <label for="video_Caption">Video Type</label>
                                                    <select class="form-control" name="vtype" id="vtype" required>
                                                        <option value='youtube'> Youtube URL Link</option>
                                                        <option value='other-MP4' selected>Other MP4 video Link</option>
                                                    </select>
                                                  </div>
                                              
                                                  <div class="form-group col-md-5 mb-3">
                                                     <label for="video_Caption">Video Caption</label>
                                                    <input type="text" class="form-control" name="video_Caption" id="video_Caption" placeholder="Video Caption" aria-label="caption" required>
                                                    <span class="text-danger" id="err_vCaption_cfy"  style="display:none;"></span>
                                                  </div>
                                          
                                          
                                                <div class="form-group col-md-4 mb-3 d-none">
                                                    <label for="video_category">Video Category <!--small>(Rs)</small--></label>
                                                    <select name="video_category" id="video_category" class="custom-select form-control">
                                                        <option value="" class="dropdown-item" >Select Category</option>
                                                        @foreach($galleryCategory as $gCategoty)
                                                        <option value="{{ $gCategoty->gcm_id }}" {{$gCategoty->gcm_id==1?'selected':''}} class="dropdown-item" >{{ $gCategoty->gcm_name }}</option>
                                                        @endforeach
                                                    </select>
                                                      
                                                    <span class="text-danger" id="err_vcategory_cfy"  style="display:none;"></span>
                                                    <!--small id="passwordHelpBlock" class="ul-form__text form-text "></small-->
                                                </div>
                                                
                                                <div class="form-group col-md-6 mb-3">
                                                     <label for="video_Caption">Video File <span class="text-danger">(Note: Max file size should be 6MB)</span></label>
                                                    <input type="file" class="form-control" name="video_file" id="video_file" accept="video/mp4,video/x-m4v,video/*" placeholder="Choose Video" aria-label="video" required>
                                                    <span class="text-danger" id="err_vVideo"  style="display:none;"></span>
                                                </div>
                                                
                                                <div class="form-group col-md-1 mt-4">
                                                    <div class="input-group-append">
                                                        <input type="hidden" name="epmId" id="epmId" value="">
                                                        <button class="btn btn-primary" type="button" id="button-comment1" onclick="addvideolink()">Add Video</button>
                                                    </div>
                                                </div>
                                        
                                        </div>
                                          
                                          <div class="input-group mb-2 d-none">
                                              <input type="hidden" name="video" id="video" value="video">
                                              <input type="text" class="form-control" name="video_url" id="video_url" placeholder="Enter Video Link" aria-label="video" value="testt">
                                              <!--<div class="input-group-append">-->
                                              <!--    <button class="btn btn-primary" type="button" id="button-comment1" onclick="addvideolink()">Add Video</button>-->
                                              <!--</div>-->
                                          </div>
                                         
                                          </form>
                              </div>

                              @if(count($galleryDetail['video'])!=0)
                                      @foreach($galleryDetail['video'] as $gallery)
                                     
                                        <div class="col-md-4" id="{{$gallery->eg_id}}" >
                                            <div class="card  mb-3">
                                                <iframe width="400" height="200" src="{{ URL::to('/') }}{{'/public/assets/images/booth'}}/{{$bmid}}/{{$profileDetail->exhim_id}}/gallery/{{$gallery->eg_name}}" autoplay="false" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                               
                                                <div class="" style="position: absolute; bottom: 0; ">
                                                    <div class="p-1 text-left card-header font-weight-light d-flex">
                                                        <a href="#" class="btn btn-primary" onclick="removevideo('{{$gallery->eg_id}}');"> <span class="d-flex align-items-center"><i class="i-Edit mr-2"></i>Remove</span></a>
                                                    </div>
                                                   
                                                     <div class="text-white float-left"><b>Caption : {{$gallery->eg_caption}}</b></div>
                                                     <br>
                                                     <div class="text-white float-left"><b>Category : {{$gallery->gcm_name}}</b></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            @else
                                        <div class="col-md-12">
                                            <div class="card text-dark o-hidden mb-3">
                                               <div class="row">
                                                     <div class="col-md-12 m-4" >
                                                        <h3>No Videos Added !!</h3>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        
                            @endif
                            </div>
                        </div>
                        
                        
                        <div class="tab-pane fade d-none" id="myavatar" role="tabpanel" aria-labelledby="myavatar-tab">
                            <ul class="timeline clearfix">
                                <li class="timeline-line"></li>
                                    <div class="timeline-card card">
                                        <div class="card-body">
                                         
                                          
                                          <iframe id="frame" class="frame" allow="camera *; microphone *; clipboard-write"></iframe>
                                          
                                            
                                            
                                             </div>
                                  
                                        </div>
                                    

                            </ul>

                        </div>
                        
                        <div class="tab-pane fade" id="convai_characters" role="tabpanel" aria-labelledby="convai-tab">
                            <ul class="timeline clearfix">
                                <li class="timeline-line"></li>
                                <div class="timeline-card card">
                                    <div class="card-body">
                                     
                                        <form class="" name="convaiform" id="convaiform" method="post">
                                         
                                         
                                          <div class="row">
                                              <div class="col-md-10">
                                                <div class="input-group mb-2">
                                                  <input type="text" class="form-control" name="convaicharid" id="convaicharid" placeholder="Enter Convai Character Id" aria-label="video" value="<?=$profileDetail->exhim_convai_character_id?>">
                                                </div>
                                              </div>
                                              <div class="col-md-2">
                                                  <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="button-convai" onclick="AddConvaiId()">Update</button>
                                                  </div>
                                              </div>
                                              </div>
                                         
                                          </form>
                                      
                                      
                              
                                    </div>
                                </div> 
                            </ul>
                        </div>
                        
                        
                         



<!--      External Links -->

  <div class="tab-pane fade" id="external" role="tabpanel" aria-labelledby="external-tab">

                            <div class="row">
                                
                                
                              <!--<label>Note: Maximum 8 videos can be uploaded</label>-->
                              <div class="col-md-12 mb-3">
                                   <form class="" name="videoform" action="saveThumbnaildata" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                         
                                         <div class="row input-group mb-2">
                                              
                                        <div class="form-group col-md-3 mb-3">
                                                     <label for="section_head">Section Heading</label>
                                                    <input type="text" class="form-control" name="section_head" id="section_head" placeholder="Section Head" aria-label="caption" value="{{$profileDetail->section_head}}" required>
            
                                        </div>
                                              
                                                  <div class="form-group col-md-3 mb-3">
                                                     <label for="video_Caption">Thumbnail Caption</label>
                                                    <input type="text" class="form-control" name="thumbnail_Caption" id="thumbnail_Caption" placeholder="Thumbnail Caption" aria-label="caption" required>
            
                                                  </div>
                                         
                                          
                                            <div class="col-md-4">
                                                      <label>Thumbnail  <em>( 480 X 320 px )</em></label>
                                                      <div class="input-group mb-2">
                                                           
                                                          <input type="hidden" name="thumbnailimg" id="thumbnailimg" value="thumbnailimg">
                                                          <input type="hidden" name="thumbnail" id="thumbnail" value="">
                                                          <input type="file" class="form-control" id="upload_thumbnail" name="upload_dthumbnail" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/gif,image/jpeg" required />
                                                        <span class="btn btn-primary" id="thumbnailcrop-result">Crop</span>
                                                         
                                                      </div>
                                                </div>
                                                  <div class="col-md-12">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="thumbnail-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                          
                                                
                                        
                                        </div>
                                          
                                          <div class="input-group mb-2">
                                              <input type="hidden" name="externallink" id="externallink" value="externallink">
                                              <input type="text" class="form-control" name="external_url" id="external_url" placeholder="Enter  Link" aria-label="External Link" required>
                                              <div class="input-group-append">
                                                  <button class="btn btn-primary" type="submit" id="button-comment3" >Add Thumbnail</button>
                                              </div>
                                          </div>
                                         
                                          </form>
                              </div>

                              @if(count($thumbnaildata)!=0)
                                      @foreach($thumbnaildata as $gallery)
                                     
                                         <div class="col-md-4" id="etd{{$gallery->etd_id}}">
                                        <div class="card text-white o-hidden mb-3">
                                            <img class="card-img" src="{{ URL::to('/') }}/public/assets/images/{{$bmid}}/{{$profileDetail->exhim_id}}/thumbnail/{{$gallery->etd_image}}" alt="">
                                            <div class="card-img-overlay">
                                                <div class="p-1 text-left card-header font-weight-light d-flex">
                                    
                                                    <a href="#" class="btn btn-primary" onclick="removethumbnail('{{$gallery->etd_id}}');"> <span class="d-flex align-items-center"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>

                                                </div>
                                                 <div class="text-white float-left">Caption: {{$gallery->etd_caption}}</div>
                                                 <br>
                                                 <div class="text-white float-left"><b>Link: {{$gallery->etd_link}}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            @else
                                        <div class="col-md-12">
                                            <div class="card text-dark o-hidden mb-3">
                                               <div class="row">
                                                     <div class="col-md-12 m-4" >
                                                        <h3>No Data Added !!</h3>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        
                            @endif
                            </div>
                        </div>


                                <?php
                                    $imgCountB=0;
                                    foreach($accessType as $aType){
                                        
                                        if($aType->pps_id==7){
                                        $imgCountB=$aType->ppsm_count;
                                            foreach($servicetaken as $addon){
                                                
                                                if($aType->pps_id==$addon->pps_id && $aType->pps_id==7){
                                                        
                                                    $imgCountB=$imgCountB+$addon->ctr;
                                                    break;
                                                }
                                            }
                                        }
                                        
                                    }
                                                   
                                ?>
                                
<div class="tab-pane fade" id="cardholdar" role="tabpanel" aria-labelledby="cardholdar-tab">

                            <div class="row">
                                
                                
                              <label type="{{$_SERVER['REMOTE_ADDR']}}">Note: Maximum {{$imgCountB}} Business Cards can be uploaded</label>
                              <div class="col-md-12 mb-3">
                                  
                                   <form class="" id="businessCardForm" name="videoform" action="saveinteractivedata" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group mb-3">
                                                     <label for="section_head">Name</label>
                                                     <input type="text" name="name" placeholder="Name" class="form-control" id="card_name" value="">
                                                     <span id="err_card_name" class="text-danger"></span>
                                                </div>
                                            </div>
                                             <div class="col-3">
                                                <div class="form-group  mb-3">
                                                     <label for="section_head">Designation</label>
                                                     <input type="text" name="designation" class="form-control" placeholder="Designation" id="card_designation" value="">
                                                     <span id="err_card_designation" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                             <div class="col-3">
                                                <div class="form-group mb-3">
                                                     <label for="section_head">Department</label>
                                                     <input type="text" name="department" placeholder="Department" class="form-control" id="department" value="">
                                                     <span id="err_depart" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-3">
                                                <div class="form-group  ">
												<label for=" " class="d-block">Choose Your Card Type</label>
                                                     <input type="radio" name="card_mode" class="" value="Landscape" id="front-card" onchange="businessCardMode(this.value)" checked>
                                                     <label for="front-card">Landscape</label>
                                                     
                                                     <input type="radio" name="card_mode" id="back-card" class="" value="Portrait" onchange="businessCardMode(this.value)">
                                                     <label for="back-card">Portrait</label>
                                                     <span id="err_depart" class="text-danger"></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div id="landscape">
                                             <div class="row ">
											 <div class="col-md-6">
											 <div class="row input-group mb-2 ">
                                                <div class="form-group col-md-10 mb-3">
                                                     <label for="imteractive_image1" class="d-flex align-items-center">Upload Front Business Card <small class="ml-auto text-danger">Please follow the format jpg,png with size 500X300px</small></label>
                                                     <input type="hidden" name="logoimage" id="logoimageCard" value="">
                                                     <input type="file" class="form-control" id="upload_photo_card" name="imteractive_image1" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/jpeg"  />
                                                    <span id="err_business_front" class="text-danger"></span>
                                                </div>
												<div class="input-group-append col-md-2 pt-2"   id="photoappendcropdivCard">
										  
                                                  <span class="btn btn-primary w-100 my-auto" id="photocrop-result-card">Crop</span>
                                                </div>
                                                <div class="col-md-12" id="photocropdivCard" >
                                                    <div class="card mb-3">
                                                	    <div class="col-md-12"  >
															<div id="photo-demo-card"></div>
														</div>
                                                    </div>
                                                </div> 
                                            
                                                
                                            </div>
										</div>	 
                                        <div class="col-md-6">
                                            <div class="row input-group mb-2">
                                                <div class="form-group col-md-10 mb-3">
                                                    <label for="imteractive_image_back" class="d-flex align-items-center">Upload Back Business Card <small class="ml-auto text-danger">Please follow the format jpg,png with size 500X300px</small></label>
                                                    <input type="hidden" name="logoimage2" id="logoimageCardBack" value="">
                                                    <input type="file" class="form-control" id="upload_photo_card_back" name="imteractive_image_back" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/jpeg"  />
                                                    <span id="err_business_back" class="text-danger"></span>
                                                </div>
                                            <div class="input-group-append col-md-2 pt-2"   id="photoappendcropdivCardBack">
                                                  <span class="btn btn-primary w-100 my-auto" id="photocrop-result-card-back">Crop</span>
                                                </div>
                                                <div class="col-md-12" id="photocropdivCardBack" >
                                                    <div class="card mb-3">
                                                	    <div class="col-md-12"   >
															<div id="photo-demo-card-back" ></div>
														</div>
                                                    </div>
                                                </div> 
                                                
                                                
                                            </div>
											</div>
                                         
                                        </div>
                                        </div>
                                        
                                        <div id="portrait" class="d-none">
											<div class="row">
												<div class="col-md-6">
													 <div class="row input-group mb-2">
														<div class="form-group col-md-10 mb-3">
															 <label for="section_head" class="d-flex align-items-center">Upload Front Business Card <small class="ml-auto text-danger">Please follow the format jpg,png with size 300X500px</small></label>
															 <input type="hidden" name="logoimageP" id="logoimageCard2" value="">
															 <input type="file" class="form-control" id="upload_photo_card2" name="imteractive_imageP" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/jpeg"  />
															<span id="err_business_front2" class="text-danger"></span>
														</div>
														<div class="input-group-append col-md-2 pt-2" id="photoappendcropdivCard2">
														  <span class="btn btn-primary w-100 my-auto" id="photocrop-result-card2">Crop</span>
														</div>
														<div class="col-md-12" id="photocropdivCard2">
															<div class="card mb-3">
																<div class="col-md-12"  >
																	<div id="photo-demo-card2"></div>
																</div>
															</div>
														</div> 
													
														
													</div>
												</div>
												<div class="col-md-6">
													<div class="row input-group mb-2">
														<div class="form-group col-md-10 mb-3">
															<label for="section_head" class="d-flex align-items-center">Upload Back Business Card <small class="ml-auto text-danger">Please follow the format jpg,png with size 300X500px</small></label>
															<input type="hidden" name="logoimagebackP" id="logoimageCardBack2" value="">
															<input type="file" class="form-control" id="upload_photo_card_back2" name="imteractive_image_backP" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/jpeg"  />
															<span id="err_business_back2" class="text-danger"></span>
														</div>
														<div class="input-group-append col-md-2 pt-2"  id="photoappendcropdivCardBack2">
														  <span class="btn btn-primary w-100 my-auto" id="photocrop-result-card-back2">Crop</span>
														</div>
														<div class="col-md-12" id="photocropdivCardBack2" >
															<div class="card mb-3">
																<div class="col-md-12">
																	<div id="photo-demo-card-back2"></div>
																</div>
															</div>
														</div> 
														
														
													</div>
												</div>
											</div>
                                        </div>
                                        
                                        
                                        
                                        
                                          <div class="input-group mb-2">
                                              <input type="hidden" name="inetractive2" id="inetractive2" value="inetractive">
                                              
                                              <div class="input-group">
                                                  <button type="button" class="btn btn-primary px-5" type="submit" id="businessCardUpload" >Submit</button>
                                              </div>
                                          </div>
                                         
                                         
                                          </form>
                              </div>
                              
                              
                              <div class="table-responsive" id="courseDataTbody">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                       <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Designation</th>
                                         <th scope="col">Department</th>
                                         <th scope="col">Mode</th>
                                         <th scope="col">Image Front
                                            <div class="divide"> Image Back </div>
                                        </th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        
                                    @php
                                        $i=1
                                        @endphp
                                        @foreach($interactivedata as $gallery)

                                            <tr>
                                                <th scope="row">{{$i++}}</th>
                                                <td>{{ucfirst($gallery->imm_name)}}</td>
                                                <td>{{ucfirst($gallery->imm_designation)}}</td>
                                                <td>{{ucfirst($gallery->imm_department)}}</td>
                                                <td>{{ucfirst($gallery->card_mode)}}</td>
                                                 <td>
                                                    @if(isset($gallery->interactive_image))
                                                        <a href="javascript:void(0);"  class="mt-0" onclick="showBusinessCard('{{$gallery->interactive_image}}');"> view</a>    
                                                    @endif
                                                    <hr>
                                                     @if(isset($gallery->interactive_image_back))
                                                        <a href="javascript:void(0);"  class="mt-0" onclick="showBusinessCard('{{$gallery->interactive_image_back}}');">View </a>    
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);"  class="mt-0" onclick="removeBusinessCard('{{$gallery->id}}');" title="Delete">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                    
                            </table>
                            </div>

                            <!--  @if(count($interactivedata)!=0)-->
                            <!--          @foreach($interactivedata as $gallery)-->
                                     
                            <!--             <div class="col-md-4" id="businessCard{{$gallery->id}}">-->
                            <!--            <div class="card text-white o-hidden mb-3">-->
                            <!--                <img class="card-img" src="{{URL::to('/')}}/public{{$gallery->interactive_image}}" alt="">-->
                            <!--                \-->
                            <!--                <div class="card-img-overlay">-->
                            <!--                    <div class="p-1 text-left card-header font-weight-light d-flex">-->
                                    
                            <!--                        <a href="#" class="btn btn-primary" onclick="removeBusinessCard('{{$gallery->id}}');"> <span class="d-flex align-items-center"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>-->
                                                
                            <!--                    </div>-->
                            <!--                    <div class="text-white float-left">Name: {{$gallery->imm_name}}</div>-->
                            <!--                     <br>-->
                            <!--                     <div class="text-white float-left"><b>Designation: {{$gallery->imm_designation}}</b></div>-->
                            <!--                     <br>-->
                            <!--                     <div class="text-white float-left"><b>Department: {{$gallery->imm_department}}</b></div>-->
                                                 
                            <!--                </div>-->
                            <!--            </div>-->
                                   
                            <!--        </div>-->
                            <!--        @endforeach-->
                            <!--@else-->
                            <!--            <div class="col-md-12">-->
                            <!--                <div class="card text-dark o-hidden mb-3">-->
                            <!--                   <div class="row">-->
                            <!--                         <div class="col-md-12 m-4" >-->
                            <!--                            <h3>No Data Added !!</h3>-->
                            <!--                        </div>-->
                            <!--                   </div>-->
                            <!--                </div>-->
                            <!--            </div>-->
                                        
                            <!--@endif-->
                            </div>
                        </div>















                        <div class="tab-pane fade" id="specialAttractions" role="tabpanel" aria-labelledby="specialAttractions-tab">
                            <div class="row">
                                
 


                                        <div class="col-md-4">
                                            <div class="card mb-4">
                                              <form name="qsigaugeform" id="qsigaugeform"  method="post"  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                    <div class="card-body" [formgroup]="radioGroup">
                                                        <div class="card-title"><img src="https://www.igauge.in/img/logo-new.png" alt="QS I-GAUGE" title="QS I-GAUGE" style="max-height: 78px;"></div>
                                                        
                                                        <label class="radio radio-outline-success">
                                                            <input type="radio" name="qs_i_gauge"   value="yes" data-toggle="modal" data-target="#QSIformmodal" formcontrolname="qs_i_gauge" <?php if(isset($profileDetail->exhim_qs_i_gauge) && $profileDetail->exhim_qs_i_gauge=='yes') echo 'checked'; ?> >
                                                            <span>YES</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="radio radio-outline-warning">
                                                            <input type="radio" name="qs_i_gauge"   onclick="QSIGAUGE();" value="no" formcontrolname="qs_i_gauge" <?php if(isset($profileDetail->exhim_qs_i_gauge) && $profileDetail->exhim_qs_i_gauge=='no') echo 'checked'; ?> >
                                                            <span>NO</span>
                                                            <span class="checkmark"></span>
                                                        </label>

                                                        <input type="hidden" name="exId" value="{{$profileDetail->exhim_id}}">
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                          <div class="col-md-4">
                                            <div class="card mb-4">
                                              <form name="nopaperform" id="nopaperform"  method="post"  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                    <div class="card-body" [formgroup]="radioGroup">
                                                        <div class="card-title"><img src="https://www.nopaperforms.com/wp-content/uploads/2020/07/logo.png" alt="NoPaperForms" title="NoPaperForms" style="max-height: 78px; background-color: #ffffff; padding: 22px;"></div>
                                                        
                                                        <label class="radio radio-outline-success">
                                                            <input type="radio" name="No_PaperForms" data-toggle="modal" data-target="#noformmodal" value="yes" formcontrolname="No_PaperForms" <?php if(isset($profileDetail->exhim_NoPaperForms) && $profileDetail->exhim_NoPaperForms=='yes') echo 'checked'; ?> >
                                                            <span>YES</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="radio radio-outline-warning">
                                                            <input type="radio" name="No_PaperForms"   onclick="NoPaper_Forms();" value="no" formcontrolname="No_PaperForms" <?php if(isset($profileDetail->exhim_NoPaperForms) && $profileDetail->exhim_NoPaperForms=='no') echo 'checked'; ?> >
                                                            <span>NO</span>
                                                            <span class="checkmark"></span>
                                                        </label>

                                                        <input type="hidden" name="exId" value="{{$profileDetail->exhim_id}}">
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-4">
                                              <form name="scholarform" id="scholarform"  method="post"  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                    <div class="card-body" [formgroup]="radioGroup">
                                                        <div class="card-title  text-centre"><h3 class="text-white" style="max-height: 78px; background-color: #2f271c; max-width: 54%; padding: 20px;">Scholarship</h3></div>
                                                
            
                                                        
                                                        <div class="form-group col-md-12 ">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group mb-3 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Upto</span>
                                                            </div>
                                                          <input type="number" class="form-control" maxlength="2" name="exhim_scholarship_percentage" id="exhim_scholarship_percentage" value="{{$profileDetail->exhim_scholarship_percentage}}" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span> <button type="button" class="btn btn-success" onclick="ScholarshipSave();">Save</button>
                                                            </div>
                                                              <span id="sch_error" class="text-danger"></span>
                                                        </div>
                                                 <input type="hidden" name="exId" value="{{$profileDetail->exhim_id}}">
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

            


                            </div>
                        </div>

    
    
    <!-- Scrollers -->

  <div class="tab-pane fade" id="scroller" role="tabpanel" aria-labelledby="scroller-tab">

                            <div class="row">
                                
                                  <label>Note: Maximum 200 Words</label>
                              <!--<label>Note: Maximum 8 videos can be uploaded</label>-->
                             
                              <div class="col-md-12 mb-3">
                                   <form class="" name="svrollerform" action="scrollerdata" method="post">
                                        {{ csrf_field() }}
                                          <div class="input-group mb-2">
                                              <input type="text" class="form-control" name="scroller" id="scrollerInput" placeholder="Enter Text" aria-label="External Link" value="{{$profileDetail->exhim_scroller_text}}" required>
                                              <div class="input-group-append">
                                                  <button class="btn btn-primary" type="submit" id="button-comment3" >Save</button>
                                              </div>
                                          </div>
                                         
                                          </form>
                              </div>
                            </div>
                        </div>
                        
                        
                        
                        <!--      External Links -->

  <div class="tab-pane fade" id="externalNew" role="tabpanel" aria-labelledby="external-tab">

                            <div class="row">
                                
                                  
                                
                                  <label>Note: Maximum 5 Social Media Links can be Added</label>
                              <!--<label>Note: Maximum 8 videos can be uploaded</label>-->
                             
                              <div class="col-md-12 mb-3">
                                    @if(count($thumbnailSocialData) < 5)  
                                   <form class="" name="videoform" action="saveThumbnailSocialdata" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                         
                                         <div class="row input-group mb-2">
                                              
                                        <div class="form-group col-md-3 mb-3">
                                                     <label for="section_head">Section Heading</label>
                                                    <input type="text" class="form-control" name="section_head" id="section_head2" placeholder="Section Head" aria-label="caption" value="{{$profileDetail->section_head}}" required>
            
                                        </div>
                                              
                                        <div class="form-group col-md-3 mb-3">
                                                     <label for="section_head">Link Type</label>
                                                        <select class="form-control"  name="linktype" required>
                                                            <option value="">Choose link type</option>
                                                            <option value="facebook.png">Facebook</option>
                                                            <option value="linked-in.png">Linked in</option>
                                                            <option value="youtube.png">Youtube</option>
                                                            <option value="instagram.png">Instagram</option>
                                                            <option value="twitter.png">Twitter</option>
                                                            <option value="web.png">Web</option>
                                                        </select>
                                                    <!-- <input type="text" class="form-control" name="section_head" id="section_head" placeholder="Section Head" aria-label="caption" value="{{$profileDetail->section_head}}" required> -->
            
                                        </div>
                                                  <div class="form-group col-md-3 mb-3">
                                                     <label for="video_Caption">Thumbnail Caption</label>
                                                    <input type="text" class="form-control" name="thumbnail_Caption" id="thumbnail_Caption2" placeholder="Thumbnail Caption" aria-label="caption" required>
            
                                                  </div>
                                                  
                                                  
                                                <!--   <div class="col-md-4">-->
                                                <!--      <label>Thumbnail  <em>( 480 X 320 px )</em></label>-->
                                                <!--      <div class="input-group mb-2">-->
                                                           
                                                <!--          <input type="hidden" name="thumbnailimg" id="thumbnailimg2" value="thumbnailimg">-->
                                                <!--          <input type="hidden" name="thumbnail" id="thumbnail2" value="">-->
                                                <!--          <input type="file" class="form-control" id="upload_thumbnail2" name="upload_dthumbnail" placeholder="Upload thumbnail" aria-label="Thumbnail" accept="image/x-png,image/gif,image/jpeg" required />-->
                                                <!--        <span class="btn btn-primary" id="thumbnailcrop-result2">Crop</span>-->
                                                         
                                                <!--      </div>-->
                                                <!--</div>-->
                                         
                                          
                                           
                                                  <div class="col-md-12 d-none">
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="thumbnail-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                          
                                                
                                        
                                        </div>
                                          
                                          <div class="input-group mb-2">
                                              <input type="hidden" name="externallink" id="externallink2" value="externallink">
                                              <input type="text" class="form-control" name="external_url" id="external_url2" placeholder="Enter  Link" aria-label="External Link" required>
                                              <div class="input-group-append">
                                                  <button class="btn btn-primary" type="submit" id="button-comment4" >Add Thumbnail</button>
                                              </div>
                                          </div>
                                         
                                          </form>
                                           @endif
                              </div>
                             

                              @if(count($thumbnailSocialData)!=0)
                                      @foreach($thumbnailSocialData as $gallery)
                                     
                                         <div class="col-md-4" id="etd{{$gallery->etd_id}}">
                                        <div class="card text-white o-hidden mb-3">
                                            <!-- <img class="card-img" src="{{ URL::to('/') }}/public/assets/images/{{$bmid}}/{{$profileDetail->exhim_id}}/thumbnail/{{$gallery->etd_image}}" alt=""> -->
                                            <img class="card-img" src="{{ URL::to('/') }}/public/assets/images/{{$bmid}}/thumbnail/{{$gallery->etd_image}}" alt="">
                                            <div class="card-img-overlay">
                                                <div class="p-1 text-left card-header font-weight-light d-flex">
                                    
                                                    <a href="#" class="btn btn-primary" onclick="removeSocialthumbnail('{{$gallery->etd_id}}');"> <span class="d-flex align-items-center"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>

                                                </div>
                                                 <div class="text-white float-left">Caption: {{$gallery->etd_caption}}</div>
                                                 <br>
                                                 <div class="text-white float-left"><b>Link: {{$gallery->etd_link}}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            @else
                                        <div class="col-md-12">
                                            <div class="card text-dark o-hidden mb-3">
                                               <div class="row">
                                                     <div class="col-md-12 m-4" >
                                                        <h3>No Data Added !!</h3>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        
                            @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>



            <!-- highlight modal -->
            <div class="modal fade" id="highlightmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2">  <h4>About Us</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="highlightform" id="highlightform" class="" action="saveuserprofile" method="post">
                              {{ csrf_field() }}
                          <!--<textarea class="ckeditor form-control form-control-lg"  name="exhim_detail" autocomplete="off" id="exhim_detail" >{{-- $profileDetail->exhim_detail --}}</textarea>-->
                              <input class="form-control" type="hidden" name="highlights" id="highlights" value="highlights" />
                            <!-- <textarea class="d-none" name="exhim_detail" id="exhim_detail"></textarea> -->
                   
                            <?php 
                             $totalloop=6;
                            if(isset($highlightDetail) && !empty($highlightDetail)){
                               
                                        $j=1;
                                        
                                        $createnewdiv=$totalloop-count($highlightDetail);
                                        foreach($highlightDetail as $highlight){ 
                                        ?>
                                        
                                            <div class="form-group">
                                                <label for="highlight{{$j}}">Paragraph - {{$j++}}</label>
                                                <input class="form-control" type="text" id="updhighlight{{$j}}" name="updhighlight[]" placeholder="Enter highlights" value="{{ $highlight->ehm_highlight_text }}" />
                                                <input class="form-control" type="hidden" id="ehm_id{{$j}}" name="ehm_id[]" value="{{ $highlight->ehm_id }}" />
                                            </div>
                                            
                                        <?php }
                                        
                                        for($k=1;$k<=$createnewdiv;$k++){ ?>
                                        
                                            <div class="form-group">
                                                <label for="highlight{{$j}}">Paragraph - {{$j++}}</label>
                                                <input class="form-control" type="text" id="inshighlight{{$j}}" name="inshighlight[]" placeholder="Enter highlights" value="" />
                                            </div> 
                                            
                                        <?php  }
                            }else{

                                for($i=1;$i<=$totalloop;$i++){ 
                                ?>
                                    <div class="form-group">
                                        <label for="highlight{{$i}}">Paragraph - {{$i}}</label>
                                        <textarea class="form-control" type="text" id="highlight{{$i}}" name="highlight[]" placeholder="Enter highlights" value="" /></textarea>
                                        
                                    </div>
                          <?php } 
                                
                            }
                           ?>
                        </div>
                        <div class="modal-footer">
                            <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Quickfaccts modal -->
            <div class="modal fade" id="quickfactsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:90%;">
                    <div class="modal-content" id="formFieldsDiv">
                      

                    </div>
                </div>
            </div>



            <!-- photos modal -->
            <div class="modal fade" id="photosmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:90%;">
                    <div class="modal-content">
                        <form name="photouploadform" id="photouploadform" class="" action="saveuserprofile" method="post"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalCenterTitle-2">  <h4 id="up-photo">Upload Photo</h4></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="restDiv();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <div class="row d-none" id="mCaption">
                                            <div class="col-md-6  form-group" >
                                                 <label>  Caption</label>
                                                 <input class="form-control " type="text" name="egcaption" id="egcaption" required/>
                                                   <!--Exhibitor Picture  <span style="color: #ed3838;">[Choose File 550 × 280 pix]</span>-->
                                                  <span class="text-danger" id="err_iCaption_cfy"  style="display:none;"></span>
                                            </div>
                                            
                                             <div class="form-group col-md-6 mb-3">
                                                    <label for="egcategory">Image Category</label>
                                                    <select name="egcategory" id="egcategory" class="custom-select form-control" required>
                                                        <option value="" class="dropdown-item" >Select Category</option>
                                                        @foreach($galleryCategory as $gCategoty){
                                                        <option value="{{ $gCategoty->gcm_id }}" class="dropdown-item" >{{ $gCategoty->gcm_name }}</option>
                                                        @endforeach
                                                    </select>
                                                      
                                                    <span class="text-danger" id="err_iCategory_cfy"  style="display:none;"></span>
                                            </div>
                                    </div>
                                    
                                  
                                    <div class="form-group">
                                        <label id="wbaner"> Web banner</label>
                                        <div class="input-group mb-2">
                                                <input class="form-control d-none" type="file" name="upload_logo" id="upload_logo" accept="image/*" required />
                                                <input class="form-control d-none" type="file" name="upload_photo" id="upload_photo" accept="image/*" required />
                                                <input type="hidden" name="logoimage" id="logoimage" value="">
                                                <input type="hidden" name="photoupload" id="photoupload" value="photoupload">
                                        </div>
                                        
                                        <input type="hidden" name="eg_id" id="eg_id" value="">
                                        <input type="hidden" name="eg_name" id="eg_name" value="">
        
                                        <div  id="instructionDiv" style="padding-top: 6px;">Note: Maximum 8 pictures can be uploaded</div>
                                    </div>
                                    
                                   <div class="col-md-12 d-none" id="logocropdiv" >
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="logo-demo"  style="overflow-y: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12 d-none" id="photocropdiv" >
                                        <div class="card mb-3">
                                 
                                        	<div class="col-md-12" id="photo-demo"  style="overflow-y: scroll; overflow-x: scroll;" ></div>
                                    
                                        </div>
                                    </div> 
                                    
                                    
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="appendcropdiv">
                                          <span class="btn btn-primary" id="logocrop-result">Crop</span>
                                      </div>
                                      
                                      <div class="input-group-append d-none" style="margin-left: 66%;" id="photoappendcropdiv">
                                          <span class="btn btn-primary" id="photocrop-result">Crop</span>
                                      </div>
                                  
                                  
                                   
                                 <div class="form-group d-none" id="mbanner">
                                     <label> mobile banner</label>
                                       <input class="form-control " type="file" name="upload_mbanner" id="upload_mbanner" />
                                       Exhibitor Picture  <span style="color: #ed3838;">[Choose File 550 × 280 pix]</span>
                                </div>

                                </div>
                                
                                
                                <div class="modal-footer">
                                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Products Offered modal -->
            <div class="modal fade" id="courseofferedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="addeditDiv">


                    </div>
                </div>
            </div>
            
            
            <!-- Products Offered modal -->
            <div class="modal fade" id="businesscardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content" id="addeditDiv2">


                    </div>
                </div>
            </div>
            
            


<!-- NoParerforms Modal -->
<div class="modal fade" id="noformmodal" tabindex="-1" role="dialog" aria-labelledby="noformmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noformmodalLongTitle">NoPaperForm Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="NoPaperFormDetails" id="NoPaperFormDetails" method="post" >
      <div class="modal-body">
        <div class="form-group mb-3">
            <label for="secret_key">Secret Key<em>*</em></label>
            <input type="text" class="form-control" name="secret_key" id="secret_key" value="{{$profileDetail->exhim_np_secret_key}}"  />
            <span id="sk_error" class="text-danger"></span>
        </div>
        <div class="form-group mb-3">
            <label for="college_id">College Id<em>*</em></label>
            <input type="text" class="form-control" name="college_id" id="college_id" value="{{$profileDetail->exhim_np_college_id}}"  />
            <span id="ci_error" class="text-danger"></span>
        </div>
      </div>
      <div class="modal-footer">

        <button type="button" onclick="SaveNoPaper_Forms();" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- QSIFORM Modal -->
<div class="modal fade" id="QSIformmodal" tabindex="-1" role="dialog" aria-labelledby="noformmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noformmodalLongTitle">QS Logos Options </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="qsigaugeFormDetails" id="qsigaugeFormDetails" method="post" >
         
      <div class="modal-body">
            <span id="qs_error" class="text-danger mb-3"></span>
        <label class="radio radio-outline-info">
            <input type="radio" name="QSLOGO" id="QSLOGO1"  value="QS Silver" formcontrolname="qs_logo" <?php if(isset($profileDetail->exhim_qs_logo) && $profileDetail->exhim_qs_logo=='QS Silver') echo 'checked'; ?> >
            <span>QS Silver</span>
            <span class="checkmark"></span>
        </label>
        <label class="radio radio-outline-warning">
            <input type="radio" name="QSLOGO" id="QSLOGO2"   value="QS Gold" formcontrolname="qs_logo" <?php if(isset($profileDetail->exhim_qs_logo) && $profileDetail->exhim_qs_logo=='QS Gold') echo 'checked'; ?> >
            <span>QS Gold</span>
            <span class="checkmark"></span>
        </label>
         <label class="radio radio-outline-danger">
            <input type="radio" name="QSLOGO"  id="QSLOGO3"    value="QS Diamond" formcontrolname="qs_logo" <?php if(isset($profileDetail->exhim_qs_logo) && $profileDetail->exhim_qs_logo=='QS Diamond') echo 'checked'; ?> >
            <span>QS Diamond</span>
            <span class="checkmark"></span>
        </label>
      </div>
      <div class="modal-footer">

        <button type="button" onclick="SaveQSIGAUGE();" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection



@section('page-js')


    <script src="{{asset('assets/js/vendor/spin.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/ladda.js')}}"></script>
    <script src="{{asset('assets/js/ladda.script.js')}}"></script>
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    

  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



</body>
</html>





    
<script type="text/javascript">

    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    function businessCardMode(mode) {
        $('#portrait').addClass('d-none');
        $('#landscape').addClass('d-none');
        if(mode == 'Landscape') {
            $('#landscape').removeClass('d-none');
        }
        else{
            $('#portrait').removeClass('d-none');
        }
    }
    
    
    //business card portrait mode
    /* STart Business Card Back */
    $photoCropCardBack2 = $('#photo-demo-card-back2').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 500,
            type: 'square'
        },
        boundary: {
            width: 350,
            height: 550
        },enableResize: false
        
    });
    
    $('#photocrop-result-card-back2').on('click', function (ev) {
    	$photoCropCardBack2.croppie('result', {
    		type: 'canvas',
    		size: 'viewport',
    		format: 'jpeg',
    		quality: 0.2
    	}).then(function (resp) {
    	    
    	    $('#logoimageCardBack2').val(resp);
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Cropped Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    
    	});
    
    });
    
    
    
    //Start Business card front
    $photoCropCard2 = $('#photo-demo-card2').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 500,
            type: 'square'
        },
        boundary: {
            width: 350,
            height: 550
        },enableResize: false
        
    });
    
    $('#photocrop-result-card2').on('click', function (ev) {
    	$photoCropCard2.croppie('result', {
    		type: 'canvas',
    		size: 'viewport',
    		format: 'jpeg',
    		quality: 0.2
    	}).then(function (resp) {
    	    
    	    $('#logoimageCard2').val(resp);
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Cropped Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    
    	});
    
    });
    
    
    $('#upload_photo_card2').on('change', function () {
  
        const fileSize = this.files[0].size / 1024 / 1024;
        if (fileSize > 1) {
            $("#err_business_front2").html('File size should be less than 1 MB.');
            $("#err_business_front2").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card2').focus();
            $('#upload_photo_card2').val('');
            return false;
        }
        else {
            $("#err_business_front2").html('');
        	var reader = new FileReader();
            reader.onload = function (e) {
            	$photoCropCard2.croppie('bind', {
            		url: e.target.result
            	}).then(function(){
            		console.log('jQuery bind complete');
            	});
            }
            reader.readAsDataURL(this.files[0]);
            
        	    
        	    swal({
                                      type: 'success',
                                      title: 'Image Crop',
                                      text: 'Please Click on "Crop button" to crop the image',
                                      buttonsStyling: false,
                                      confirmButtonClass: 'btn btn-lg btn-danger'
                                     })
        }
    });


    $('#upload_photo_card_back2').on('change', function () {
    
        const fileSize = this.files[0].size / 1024 / 1024;
        if (fileSize > 1) {
            $("#err_business_back2").html('File size should be less than 1 MB.');
            $("#err_business_back2").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card_back2').focus();
            $('#upload_photo_card_back2').val('');
            return false;
        }
        else{
             $("#err_business_back2").html('');
      
        	var reader = new FileReader();
            reader.onload = function (e) {
            	$photoCropCardBack2.croppie('bind', {
            		url: e.target.result
            	}).then(function(){
            		console.log('jQuery bind complete');
            	});
            }
            reader.readAsDataURL(this.files[0]);
            
        	    
        	    swal({
                                      type: 'success',
                                      title: 'Image Crop',
                                      text: 'Please Click on "Crop button" to crop the image',
                                      buttonsStyling: false,
                                      confirmButtonClass: 'btn btn-lg btn-danger'
                                     })
        }
    });
    
    //
    
    
// var form = document.getElementById("highlightform"); // get form by ID
//
// form.onsubmit = function() {  var hvalue = $('#full-editor').text();
//         $('#exhim_detail').val(hvalue);
//                            }



        
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

<?php
$w='';
$h='';
$stall9a = array("91", "92", "93", "94","95");
$stall18 = array("64", "65", "66", "67","68");
$stall2A = array("112", "113", "114");
$stall7 = array("7", "8", "9","10","11","31");
 if(in_array($profileDetail->ebm_id,$stall9a)){
     $w='635';
    $h='170';
}else if(in_array($profileDetail->ebm_id,$stall18)){
     $w='480';
    $h='130';
}else if(in_array($profileDetail->ebm_id,$stall2A)){
     $w='290';
    $h='150';
}else if(in_array($profileDetail->ebm_id,$stall7)){
     $w='1024';
    $h='256';
}else{
     $w='720';
    $h='400';
}

?>

/*  backdrop image crop */
$logoCrop = $('#logo-demo').croppie({
    enableExif: true,
    viewport: {
         width: <?php if(!empty($w)) { echo ($w); } else { echo '400'; }  ?>,
        height: <?php if(!empty($h)) { echo ($h); } else { echo '210'; }  ?>,
        type: 'square'
    },
    boundary: {
        width: <?php if(!empty($w)) { echo ($w+50); } else { echo '450'; }  ?>,
        height: <?php if(!empty($w)) { echo ($h+50); } else { echo '250'; }  ?>
    },enableResize: false
    
});


$('#upload_logo').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$logoCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});


$('#logocrop-result').on('click', function (ev) {
	$logoCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#logoimage').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});  

/* STart Business Card Back */
$photoCropCardBack = $('#photo-demo-card-back').croppie({
    enableExif: true,
    viewport: {
        width: 500,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 550,
        height: 350
    },enableResize: false
    
});

$('#photocrop-result-card-back').on('click', function (ev) {
	$photoCropCardBack.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#logoimageCardBack').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});

$('#businessCardUpload').on('click', function() {
    if($('#card_name').val()=='') {
        $("#err_card_name").html('Please enter name to continue!');
        $("#err_card_name").fadeIn('fast');
        $("#courseofferedmodal").scrollTop('0');
        $('#card_name').focus();
        return false;
    }
    else if($('#card_designation').val()=='') {
        $("#err_card_designation").html('Please enter designation to continue!');
        $("#err_card_designation").fadeIn('fast');
        $("#courseofferedmodal").scrollTop('0');
        $('#card_designation').focus();
        return false;
    }
    else if($('#department').val()=='') {
        $("#err_depart").html('Please enter department to continue!');
        $("#err_depart").fadeIn('fast');
        $("#courseofferedmodal").scrollTop('0');
        $('#department').focus();
        return false;
    }
    else if($('input[name="card_mode"]:checked').val()=='Landscape') {
        if($('#upload_photo_card').val()=='') {
            $("#err_business_front").html('Please Upload Business Card Front Image');
            $("#err_business_front").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card').focus();
            return false;
        }
        else if($('#logoimageCard').val() == '') {
            swal({
              type: 'error',
              title: 'Image Crop',
              text: 'Please Click on "Crop button" to crop the front image',
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-lg btn-danger'
             })
        }
        else if($('#upload_photo_card_back').val()=='') {
            $("#err_business_back").html('Please Upload Business Card Back Image');
            $("#err_business_back").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card_back').focus();
            return false;
        }
        else if($('#logoimageCardBack').val() == '') {
            swal({
              type: 'error',
              title: 'Image Crop',
              text: 'Please Click on "Crop button" to crop the back image',
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-lg btn-danger'
             })
        }
        else{
            if("{{count($interactivedata)}}" < "{{$imgCountB}}") {
                $('#businessCardForm').submit();
            }
            else{
                swal('Failed', 'Maximum 5 Business Cards already has been added!', 'error');
            }
        }
    }
    else if($('input[name="card_mode"]:checked').val()=='Portrait') {
        if($('#upload_photo_card2').val()=='') {
            $("#err_business_front2").html('Please Upload Business Card Front Image');
            $("#err_business_front2").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card2').focus();
            return false;
        }
        else if($('#logoimageCard2').val() == '') {
            swal({
              type: 'error',
              title: 'Image Crop',
              text: 'Please Click on "Crop button" to crop the front image',
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-lg btn-danger'
             })
        }
        else if($('#upload_photo_card_back2').val()=='') {
            $("#err_business_back2").html('Please Upload Business Card Back Image');
            $("#err_business_back2").fadeIn('fast');
            $("#courseofferedmodal").scrollTop('0');
            $('#upload_photo_card_back2').focus();
            return false;
        }
        else if($('#logoimageCardBack2').val() == '') {
            swal({
              type: 'error',
              title: 'Image Crop',
              text: 'Please Click on "Crop button" to crop the back image',
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-lg btn-danger'
             })
        }
        else{
            if("{{count($interactivedata)}}" < "{{$imgCountB}}") {
                $('#businessCardForm').submit();
            }
            else{
                swal('Failed', 'Maximum 5 Business Cards already has been added!', 'error');
            }
        }
        
    }
    else{
        
        if("{{count($interactivedata)}}" < "{{$imgCountB}}") {
            $('#businessCardForm').submit();
        }
        else{
            swal('Failed', 'Maximum 5 Business Cards already has been added!', 'error');
        }
         
    }
})

$('#upload_photo_card_back').on('change', function () {
    
    const fileSize = this.files[0].size / 1024 / 1024;
    if (fileSize > 1) {
        $("#err_business_back").html('File size should be less than 1 MB.');
        $("#err_business_back").fadeIn('fast');
        $("#courseofferedmodal").scrollTop('0');
        $('#upload_photo_card_back').focus();
        $('#upload_photo_card_back').val('');
        return false;
    }
    else{
         $("#err_business_back").html('');
  
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCropCardBack.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
        }
        reader.readAsDataURL(this.files[0]);
        
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Please Click on "Crop button" to crop the image',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    }
});

/*  End Business card upload back*/
 

/*  photo image crop */
$photoCropCard = $('#photo-demo-card').croppie({
    enableExif: true,
    viewport: {
        width: 500,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 550,
        height: 350
    },enableResize: false
    
});


/*  photo image crop */
$photoCrop = $('#photo-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1000,
        height: 565,
        type: 'square'
    },
    boundary: {
        width: 1100,
        height: 600
    },enableResize: false
    
});

$('#photocrop-result-card').on('click', function (ev) {
	$photoCropCard.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#logoimageCard').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});

$('#upload_photo_card').on('change', function () {
  
    const fileSize = this.files[0].size / 1024 / 1024;
    if (fileSize > 1) {
        $("#err_business_front").html('File size should be less than 1 MB.');
        $("#err_business_front").fadeIn('fast');
        $("#courseofferedmodal").scrollTop('0');
        $('#upload_photo_card').focus();
        $('#upload_photo_card').val('');
        return false;
    }
    else {
        $("#err_business_front").html('');
    	var reader = new FileReader();
        reader.onload = function (e) {
        	$photoCropCard.croppie('bind', {
        		url: e.target.result
        	}).then(function(){
        		console.log('jQuery bind complete');
        	});
        }
        reader.readAsDataURL(this.files[0]);
        
    	    
    	    swal({
                                  type: 'success',
                                  title: 'Image Crop',
                                  text: 'Please Click on "Crop button" to crop the image',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-danger'
                                 })
    }
});


$('#upload_photo').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$photoCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});



$('#photocrop-result').on('click', function (ev) {
	$photoCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#logoimage').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});  



/*  Thumbnail image crop */
$thumbnailCrop = $('#thumbnail-demo').croppie({
    enableExif: true,
    viewport: {
        width: 480,
        height: 320,
        type: 'square'
    },
    boundary: {
        width: 600,
        height: 550
    },enableResize: false
    
});


$('#upload_thumbnail').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$thumbnailCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});


$('#thumbnailcrop-result').on('click', function (ev) {
	$thumbnailCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport',
		format: 'jpeg',
		quality: 0.2
	}).then(function (resp) {
	    
	    $('#thumbnail').val(resp);
	    
	    swal({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});



   
                                          
                                          
                                          




function bannerUpload(id,name,action){
    if(action=='update'){
        $('#up-photo').html('Change Banner');
        $('#photoupload').val('UpdateBanner');
        
        $('#instructionDiv').html('Exhibitor Picture <span style="color: #ed3838;">[Choose File 1160 x 330 pix]</span>');
          $('#mbanner').removeClass('d-none');
           $('#wbaner').removeClass('d-none');
          
        $('#eg_id').val(id);
        $('#eg_name').val(name);
    }else{
        $('#up-photo').html('Add Banner');
        $('#photoupload').val('AddBanner');
        $('#mbanner').removeClass('d-none');
         $('#wbaner').removeClass('d-none');
        $('#instructionDiv').html('Exhibitor Picture <span style="color: #ed3838;">[Choose File 1160 x 330 pix]</span>');

        $('#eg_id').val(id);
        $('#eg_name').val(name);
    }
 
}

	
	function deleteCourse(epmId)
    {
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
                        type: "post",
                        url: 'deletecourse',
                        data: 'epmId='+epmId,
                        success: function (data) {
                                 swal({
                                        type: 'success',
                                        title: 'Deleted!',
                                        text: 'Deleted Successfully',
                                        buttonsStyling: false,
                                        confirmButtonClass: 'btn btn-lg btn-danger'
                                    });
                                    setTimeout(function(){ window.location.reload(); }, 3000);
				                    return false;
                
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
                            });
        }
				
				
				
				function removeBrochure(exhim_id)
                    {
                        //alert('tst');
                        $.ajax({
                             headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                                method:"POST",
                                url: "removeBrochure",
                                data: {exhim_id:exhim_id},
                                success: function (data) {
                                             $('#'+exhim_id).remove();
                                             $('#deleteBro').remove();
                                                swal({
                                                    type: 'success',
                                                    title: 'Success!',
                                                    text: 'Brochure Deleted Successfully',
                                                    buttonsStyling: false,
                                                    confirmButtonClass: 'btn btn-lg btn-success'
                                                });
                                                
                                                 setTimeout(function(){ window.location.reload(); }, 3000);
				                    return false;
                    
                                }
                            });
                    }
                    



function logoUpload(id,name,action){
    restDiv();
    if(action=='update'){
            $('#up-photo').html('Change Logo');
            $('#photoupload').val('UpdateLogo');
            $('#mbanner').addClass('d-none');
            $('#wbaner').addClass('d-none');
            $('#logocropdiv').removeClass('d-none');
            $('#photocropdiv').addClass('d-none');
            $('#upload_logo').removeClass('d-none');
            $('#upload_logo').attr('required', true);
            $('#upload_photo').addClass('d-none');
            $('#upload_photo').attr('required', false);
            $('#appendcropdiv').removeClass('d-none');
            $('#photoappendcropdiv').addClass('d-none');
            
            
            $('#instructionDiv').html('Exhibitor Logo <span style="color: #ed3838;">[Choose File <?php if(!empty($w)) { echo ($w); } else { echo '300'; }  ?> x <?php if(!empty($h)) { echo ($h); } else { echo '100'; }  ?>, pix]</span>');
            
            $('#eg_id').val(id);
            $('#eg_name').val(name);
    }else{
            $('#up-photo').html('Add Logo');
            $('#photoupload').val('AddLogo');
            $('#mbanner').addClass('d-none');
            $('#wbaner').addClass('d-none');
            $('#logocropdiv').removeClass('d-none');
            $('#photocropdiv').addClass('d-none');
            $('#upload_logo').attr('required', true);
            $('#upload_logo').removeClass('d-none');
            $('#upload_photo').addClass('d-none');
            $('#appendcropdiv').removeClass('d-none');
            $('#photoappendcropdiv').addClass('d-none');
            $('#upload_photo').attr('required', false);
            $('#instructionDiv').html('Exhibitor Logo <span style="color: #ed3838;">[Choose File 400 x 210 pix]</span>');
            
            $('#eg_id').val(id);
            $('#eg_name').val(name);
    }
}

function restDiv(){
    $('#mCaption').addClass('d-none');
    $('#egcaption').attr('required', false);
    $('#egcategory').attr('required', false);
}

function updatephotoEvnt(id,name,caption,gcm_id){
        $('#up-photo').html('Change Photo');
        $('#photoupload').val('photoupdate');
        $('#instructionDiv').html('Gallery Image <span style="color: #ed3838;">[Choose File 1000 x 685 pix]</span>');
        $('#mCaption').removeClass('d-none');
        $('#logocropdiv').addClass('d-none');
        $('#photocropdiv').addClass('d-none');
        $('#upload_logo').addClass('d-none');
        $('#upload_logo').attr('required', false);
        $('#upload_photo').addClass('d-none');
        $('#upload_photo').attr('required', false);
        $('#appendcropdiv').addClass('d-none');
        $('#photoappendcropdiv').addClass('d-none');
        $('#egcaption').attr('required', true);
        $('#egcategory').attr('required', true);
        $('#egcaption').val(caption);
        $('#egcategory').val(gcm_id);
        
        $('#wbaner').html('Choose Image');
        $('#wbaner').removeClass('d-none');
        
        
        $('#eg_id').val(id);
        $('#eg_name').val(name);
}


function uploadphotoEvnt(){
    $('#up-photo').html('Upload Photo');
    $('#photoupload').val('photoupload');
    $('#instructionDiv').html('Gallery Image <span style="color: #ed3838;">[Choose File 1000 x 685 pix]</span>');
     $('#upload_logo').addClass('d-none');
      $('#upload_logo').attr('required', false);
    $('#mCaption').removeClass('d-none');
    $('#egcaption').attr('required', true);
    $('#egcategory').attr('required', true);
   $('#logocropdiv').addClass('d-none');
     $('#photocropdiv').removeClass('d-none');
    $('#upload_photo').removeClass('d-none');
    $('#upload_photo').attr('required', true);
    $('#appendcropdiv').addClass('d-none');
     $('#photoappendcropdiv').removeClass('d-none');
    $('#wbaner').html('Choose Image');
    $('#wbaner').removeClass('d-none');
  
    $('#eg_id').val();
    $('#eg_name').val();
}

function getcourses(ppm_id,isOthers=null){
        
        var productName = $('#new_course').val();
    
        Showotherinputstream(ppm_id,isOthers);
        
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        url:"getcourses",
        data:{ppm_id:ppm_id},
        success:function(data){
          $('#courses_div').html("");
            $('#courses_div').html(data);
            $('#new_course').val(productName);
        }
        });
}
function Showotherinput(val){
  if(val=='other'){
      $('#new_course').removeClass('d-none');
  }else{
      $('#new_course').addClass('d-none');
      $('#new_course').val('');
  }

}

function Showotherinputstream(val,isOthers=null){
  if(isOthers=='Y'){
      $('#new_stream').removeClass('d-none');
  }else{
      $('#new_stream').addClass('d-none');
      $('#new_stream').val('');
  }

}


function AddCourseOffered(ele){
        
        if($('input[name=Course]').val()=='other' && $.trim($('#new_course').val())==''){
            $("#err_msg_nc").html('Please Enter Project Name');
            $("#err_msg_nc").fadeIn('fast');
            document.courseaddform.new_course.focus();
            
            return false;
        }

        if($.trim($('#course_fee_year').val())==''){
            $("#err_msg_cfy").html('Please Enter Product price');
            $("#err_msg_cfy").fadeIn('fast');
            document.courseaddform.course_fee_year.focus();
            return false;
        }
        if($.trim($('#epm_additional_details').val())==''){
            $("#err_msg_pdc").html('Please Enter Product Detail/Description');
            $("#err_msg_pdc").fadeIn('fast');
            document.courseaddform.epm_additional_details.focus();

            return false;
        }
        
            $.ajax({
                type: 'POST',
                url: 'AddCourseOffered',
                data: new FormData(ele),
                //dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                      
                  
                   $('#courseDataTbody').html(data);
                    

                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: ' Added Successfully',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-lg btn-success'
                    }).then(function(){
                        $('#courseofferedmodal').modal('toggle');
                    });
                            setTimeout(function(){
                                window.location.reload(); 
                            }, 2000);
                    		return false;
                }
            });

            return false;
}




function fillCityList(stateId){

   $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'citylist',
        data: 'state='+stateId,
        success: function (data) {
            var obj=jQuery.parseJSON(data);
            if(obj.code==='200'){
                $('#cityList').html(obj.htmlAppend);

            }
                
        }   
    });
}

function addeditcoursedetails(epmId,ppmmId=null){
    $('#addeditDiv').html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: 'addeditcourse',
        data: 'epmId='+epmId,
        success: function (data) {
                $('#addeditDiv').html(data);
                $('#courseofferedmodal').modal('toggle')
                
                var ppm_id = $('input[name="stream"]:checked').val();
                
                getproductsubcategoryList(ppm_id,ppmmId);

            }      
    });
}

function getproductsubcategoryList(ppm_id,ppmm_id=null) {
    if(ppm_id != '') {
        $('#subcatediv').removeClass('d-none');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'getparentproductsubcategory',
            data: 'ppm_id='+ppm_id+'&ppmm_id='+ppmm_id,
            success: function (data) {
                $('#parentSubCatDiv').html(data);
            }      
        });
    }
}

function showBrochure(brochureName){

        var screenHeight =parseFloat(document.body.clientHeight)-30;
        var screenWidth =parseFloat(document.body.clientWidth);
    
        //var srcurl="{{URL::to('/')}}/public/assets/images/{{Session('session')[0]->bm_id}}/{{Session('profileDetail')->exhim_id}}/brochure/"+brochureName;
        var srcurl=brochureName;
        $('#addeditDiv').html("<embed src="+srcurl+" style='height:"+screenHeight+"px;' frameborder='0'>");
        $('#courseofferedmodal').modal('toggle');

}

function showBusinessCard(brochureName){

        var screenHeight =parseFloat(document.body.clientHeight)-30;
        var screenWidth =parseFloat(document.body.clientWidth);
    
        var srcurl="{{URL::to('/')}}/public"+brochureName;
        console.log(srcurl);
        $('#addeditDiv2').html("<embed src="+srcurl+" frameborder='0'>");
        $('#businesscardmodal').modal('toggle');

}


function reqUpdateFormFields(reqformName,w,h){
    $('#formFieldsDiv').html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "profile",
        data: {'ajaxRequset':reqformName,'width':w,'height':h},
        success: function (data) {
                $('#formFieldsDiv').html(data);
                $('#quickfactsmodal').modal('toggle')
            }      
    });
}

function QSIGAUGE() {
    
        $.ajax({
            url: "saveexhibitordata",
            data: $('#qsigaugeform').serialize()+'&'+$('#qsigaugeFormDetails').serialize(),
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){

                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Updated Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                    }
            }
        });

}


$(document).ready(function(){

    var _URL = window.URL || window.webkitURL;
    $('#upload_standee').change(function () {
        var file = $(this)[0].files[0];
    
                img = new Image();
                var imgwidth = 0;
                var imgheight = 0;
                var maxwidth = 340;
                var maxheight = 800;
            
            
                img.src = _URL.createObjectURL(file);
            img.onload = function() {
                imgwidth = this.width;
                imgheight = this.height;
                
                $("#width").text(imgwidth);
                $("#height").text(imgheight);
                
               if(imgwidth <= maxwidth && imgheight <= maxheight){
                   //
               }else{
                  // $("#response").text("Image size must be "+maxwidth+"X"+maxheight);
                   $('#upload_standee').val('');
                   swal({
                        type: 'error',
                        title: 'Alert!',
                        text: "Image size must be "+maxwidth+"X"+maxheight,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-lg btn-success'
                    });
               }
            }
      });
  
  
    $('#upload2_standee').change(function () {
      var file = $(this)[0].files[0];
    
      img = new Image();
      var imgwidth = 0;
      var imgheight = 0;
      var maxwidth = 118;
      var maxheight = 250;
    
      img.src = _URL.createObjectURL(file);
      img.onload = function() {
            imgwidth = this.width;
            imgheight = this.height;
            
            $("#width").text(imgwidth);
            $("#height").text(imgheight);
            if(imgwidth <= maxwidth && imgheight <= maxheight){
               //
            }else{
                  // $("#response").text("Image size must be "+maxwidth+"X"+maxheight);
                  $('#upload_standee').val('');
                  swal({
                        type: 'error',
                        title: 'Alert!',
                        text: "Image size must be "+maxwidth+"X"+maxheight,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-lg btn-success'
                    });
            }
        }
    });
  
  
});






function updateboothdesign(ebm_id) {
    
        $.ajax({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
           
            url: "saveexhibitordata",
            data: {ebm_id:ebm_id},
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){

                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Booth Design Selected Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                               setTimeout(function(){ window.location.reload(); }, 2000);
                    							return false;
                    }
            }
        });

}


function SaveQSIGAUGE() {
  
    if ($('input[name="QSLOGO"]:checked').length == 0) {
         $("#qs_error").html('Please select atleast one option');
            $("#qs_error").fadeIn('fast');
            $('#QSLOGO1').focus();
        return false;
    }
        $.ajax({
            url: "saveexhibitordata",
            data: $('#qsigaugeform').serialize()+'&'+$('#qsigaugeFormDetails').serialize(),
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){
                $('#QSIformmodal').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Updated Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                    }
            }
        });

}


function NoPaper_Forms() {
    
        $.ajax({
            url: "saveexhibitordata",
            data: $('#nopaperform').serialize()+'&'+$('#NoPaperFormDetails').serialize(),
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){

                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Updated Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                    }
            }
        });

}

function SaveNoPaper_Forms() {
    
    if($.trim($('#secret_key').val())==''){
            $("#sk_error").html('Please Enter Your NoPaperForms Secret Key');
            $("#sk_error").fadeIn('fast');
            $('#secret_key').focus();
            return false;
        
    }if($.trim($('#college_id').val())==''){
        $("#ci_error").html('Please Enter Your NoPaperForms College Id');
            $("#ci_error").fadeIn('fast');
            $('#college_id').focus();
            return false;
    }
    
        $.ajax({
            url: "saveexhibitordata",
            data: $('#nopaperform').serialize()+'&'+$('#NoPaperFormDetails').serialize(),
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){
                $('#noformmodal').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Updated Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                    }
            }
        });

}


function ScholarshipSave() {
     $("#sch_error").fadeOut('fast');
    if($.trim($('#exhim_scholarship_percentage').val())==''){
            $("#sch_error").html('Please Enter Scholarship Percentage ');
            $("#sch_error").fadeIn('fast');
            $('#exhim_scholarship_percentage').focus();
            return false;
        
    }
    
        $.ajax({
            url: "saveexhibitordata",
            data: $('#scholarform').serialize(),
            success: function (data) {

                    var obj=jQuery.parseJSON(data);
                    if(obj.code=='200'){
                $('#noformmodal').modal('hide');
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Saved Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                    }
            }
        });

}

function addvideolink(){
    var video_url=$('#video_url').val();
    var videoCaption=$('#video_Caption').val();
    var videoCategory=$('#video_category').val();
    var epmId=$('#epmId').val();
    var vtype=$('#vtype').val();
    
    if($.trim(videoCaption)==''){
        alert('Please Fill video Caption');
        $('#video_Caption').focus();
        return false;
    }
    if($.trim(videoCategory)==''){
        alert('Please Choose video Category');
        return false;
    }
    if($.trim(video_url)==''){
        alert('Please Add Video Url');
        return false;
    }
    
    if ($('#video_file').get(0).files.length === 0) {
        alert("Please select file.");
        return false;
    }
    
    var fd = new FormData();
    var files = $('#video_file')[0].files;
    // Check file selected or not
    if(files.length > 0 ){
      fd.append('video_file',files[0]);
    }
    fd.append('vtype',vtype);
    fd.append('video_url',video_url);
    fd.append('video_caption',videoCaption);
    fd.append('video_category',videoCategory);
    fd.append('epmId',epmId)
    
     $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"POST",
            url: "saveuserprofile",
            data: fd,
            contentType: false,
            cache: false,
            processData:false,
                
            success: function (data) {
                
                console.log(data);
                var res = JSON.parse(data);
                console.log(res);
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Video Added Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                });
                setTimeout(function(){ window.location.reload(); }, 2000);
                return false;
            }
        });
    
}

function AddConvaiId()
{
    var convaiId = $('#convaicharid').val();
    if(convaiId=='')
    {
        $('#convaicharid').focus();
        return false;
    }
    else{

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"POST",
            url: "saveconvaiid",
            data: "convai_id="+convaiId+"&boothId=<?=$profileDetail->exhim_id?>",
            success: function (data) {
                console.log(data);
                swal({
                    type: 'success',
                    title: 'Success!',
                    text: 'Convai Id Updated Successfully',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-success'
                });
                setTimeout(function(){ window.location.reload(); }, 2000);
                return false;
            }
        });
    }
}

function removevideo(egid){
   
     $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            method:"POST",
            url: "removegalleryitem",
            data: {egid:egid},
            success: function (data) {
                         $('#'+egid).remove();
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Deleted Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });

            }
        });
    
}

function removeBusinessCard(immId) {
    if(immId!='') {
        $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                method:"POST",
                url: "removebusinesscarditem",
                data: {immId:immId},
                success: function (data) {
                             $('#businessCard'+immId).remove();
                                swal({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Deleted Successfully',
                                    buttonsStyling: false,
                                    confirmButtonClass: 'btn btn-lg btn-success'
                                });
                                setTimeout(function(){ window.location.reload(); }, 3000);
    
                }
        });
    }
}


function removethumbnail(etdid){
   
     $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            method:"POST",
            url: "removethumbnail",
            data: {etdid:etdid},
            success: function (data) {
                         $('#etd'+etdid).remove();
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Deleted Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });

            }
        });
    
}


function removeSocialthumbnail(etdid){
   
     $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            method:"POST",
            url: "removeSocialthumbnail",
            data: {etdid:etdid},
            success: function (data) {
                         $('#etd'+etdid).remove();
                            swal({
                                type: 'success',
                                title: 'Success!',
                                text: 'Deleted Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });

            }
        });
    
}


	//this function add in user-profile.blade.php

				$(function() {				  
				  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				    localStorage.setItem('lastTab', $(this).attr('href'));
				  });
				  var lastTab = localStorage.getItem('lastTab');			  
				  if (lastTab) {
				    $('[href="' + lastTab + '"]').tab('show');
				  }
				  
				});
				
				
				
				
				


</script>

<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<script>
    /*
    const subdomain = 'ibentos';
    const frame = document.getElementById('frame');
    
    frame.src = `https://${subdomain}.readyplayer.me/avatar?frameApi`;
    
    window.addEventListener('message', subscribe);
    document.addEventListener('message', subscribe); */

      function subscribe(event) {
        const json = parse(event);

        if (json?.source !== 'readyplayerme') {
          return;
        }

        if (json.eventName === 'v1.frame.ready') {
          frame.contentWindow.postMessage(
            JSON.stringify({
              target: 'readyplayerme',
              type: 'subscribe',
              //method: "clearCache",
              eventName: 'v1.**'
            }),
            '*'
          );
        }

        if (json.eventName === 'v1.avatar.exported') {
            SaveModifyAvatar(`${json.data.url}`);
        }

        if (json.eventName === 'v1.user.set') {
        }
      }

      function parse(event) {
        try {
          return JSON.parse(event.data);
        } catch (error) {
          return null;
        }
      }

      function displayIframe() {
        document.getElementById('frame').hidden = false;
      }
        
        function RpmStart()
        {
            document.getElementById('frame').hidden = false;
            $('#myModal').modal('show');
        }
        
        function SaveModifyAvatar(url)
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method:"POST",
                url: "saveuserprofile",
                data: {'avatar_url':url},
                success: function (data) {
    
                    swal({
                        type: 'success',
                        title: 'Success!',
                        text: 'Avatar Created Successfully',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-lg btn-success'
                                        });
                    setTimeout(function(){ window.location.reload(); }, 2000);
                    return false;
                }
            });
            
        }
</script>

@endsection
