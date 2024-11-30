<?php

    $aboutSection = '';
    $milestoneSection = '';
    $speakerSection = '';
    $agendaSection = '';
    $sponsorSection = '';
    $gallerySection = '';
    $footerSection = '';
    $videoSection = '';
    
    
    foreach($sectionIsEnabled as $sie){
        if($sie->sm_internal_name == 'about' && $sie->smm_status == 'inactive'){
            $aboutSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'milestone' && $sie->smm_status == 'inactive'){
            $milestoneSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'speaker' && $sie->smm_status == 'inactive'){
            $speakerSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'agenda' && $sie->smm_status == 'inactive'){
            $agendaSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'sponsor' && $sie->smm_status == 'inactive'){
            $sponsorSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'gallery' && $sie->smm_status == 'inactive'){
            $gallerySection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'footer' && $sie->smm_status == 'inactive'){
            $footerSection = "style=display:none;";
        }
        if($sie->sm_internal_name == 'video' && $sie->smm_status == 'inactive'){
            $videoSection = "style=display:none;";
        }
    }

    if(!empty($bannerImg[0])){
        $assetUrlBan = asset($bannerImg[0]->lgm_name);
        $banImg = 'style="background-image: url('.$assetUrlBan.');"';
    }else{
        $banImg = '';
    }
    
    if(!empty($milestoneImg[0])){
        $assetUrlMile = asset($milestoneImg[0]->lgm_name);
        $mileImg = 'style="background-image: url('.$assetUrlMile.');"';
    }else{
        $mileImg = '';
    }
    
    if(!empty($sponsorBgImg[0])){
        $assetUrlSpon = asset($sponsorBgImg[0]->lgm_name);
        $sponBgImg = 'style="background-image: url('.$assetUrlSpon.');"';
    }else{
        $sponBgImg = '';
    }
    
?>


@extends('layouts.lpage-master')

@section('main-content')

@include('layouts.header-lpage')

<!--BANNER-->
<section>
    <div class="lgx-banner lgx-banner6" <?php echo $banImg?> >
        <div class="lgx-banner-style">
            <div class="lgx-inner lgx-inner-fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-banner-info"> <!--lgx-banner-info-center lgx-banner-info-black lgx-banner-info-big lgx-banner-info-bg-->
                                <h3 class="subtitle" id="baner_subtitle" contentEditable="true">
                                    @if(!empty($data[0]))
                                        
                                         @if(!empty($data[0]->baner_subtitle))
                                            {{$data[0]->baner_subtitle}}
                                        @else
                                         {{Session::get('selectedEvent')->aem_name}}
                                        @endif
                                    @else
                                        You can learn anything
                                    @endif
                                </h3>
                                <h2 class="title" id="baner_title" contentEditable="true">
                                    @if(!empty($data[0]))
                                        
                                        @if(!empty($data[0]->baner_title))
                                            {{$data[0]->baner_title}}
                                        @else
                                         {{Session::get('selectedEvent')->aem_name}}
                                        @endif
                                    @else
                                        Conference 2021
                                    @endif
                                </h2>
                                <h3 class="date" id="baner_date" contentEditable="true">
                                    <i class="fa fa-calendar"></i>
                                    @if(!empty($data[0]))
                                       
                                         @if(!empty($data[0]->baner_date))
                                            {{$data[0]->baner_date}}
                                        @else
                                            {{date('j',strtotime(Session::get('selectedEvent')->aem_start_date))}}
                                            {{date('-j F, Y',strtotime(Session::get('selectedEvent')->aem_end_date))}}
                                           
                                        @endif
                                    @else
                                        23-27 September, 2021
                                    @endif
                                    
                                </h3>
                                <h3 class="location" id="baner_location" contentEditable="true">
                                    <i class="fa fa-map-marker"></i> 
                                    @if(!empty($data[0]))
                                        {{$data[0]->baner_location}}
                                    @else
                                        21 King Street, Dhaka 1205, Bangladesh.
                                    @endif
                                </h3>
                                <!--<div class="action-area">-->
                                <!--    <div class="lgx-video-area">-->
                                <!--        <a class="lgx-btn lgx-btn-red" href="#">Buy Ticket</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <!--//.ROW-->
                </div>
                <!-- //.CONTAINER -->
            </div>
            <!-- //.INNER -->
        </div>
    </div>
    <!--<span class="btn btn-primary" style="float:left;" data-toggle="modal" data-target="#bgImageModal" >Change Banner Image</span>-->
    <input type="file" id="ban" class="hidden imageCropper" accept="image/*" />
    <label for="ban" class="btn btn-primary" style="float:left;" onclick="CropperWH(1920,935,'uploadBanner','photoUpload','');">Change Banner Image</label>
</section>
<!--BANNER END-->

    

<!--ABOUT-->
<section {{$aboutSection}} >
    <div id="lgx-about" class="lgx-about">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="lgx-about-content-area">
                            <div class="lgx-heading">
                                <h2 class="heading" id="about_head" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->about_head}}
                                    @else
                                    	Happy New Year 2021
                                    @endif
                                </h2>
                                <h3 class="subheading" id="about_subhead" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->about_subhead}}
                                    @else
                                    	Why Happy New Year 2021 ?
                                    @endif
                                </h3>
                            </div>
                            <div class="lgx-about-content">
                                <p class="text" id="about_content" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->about_content}}
                                    @else
                                    	Morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                    	Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. 
                                    	Donec eu libero sit amet quam egestas semper. 
                                    	Aenean ultricies mi vitae est. Mauris Eonec eu ribero sit amet quam egestas semper. Aenean are ultricies mi vitae.
                                    @endif
                                </p>
                                <!--<div class="section-btn-area">-->
                                <!--    <a class="lgx-btn" href="about.html">More About</a>-->
                                <!--    <a class="lgx-btn lgx-btn-red lgx-scroll" href="#lgx-registration">Buy Ticket</a>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="lgx-registration-form-box lgx-about-registration-box">
                            <h3 class="title">Registration</h3>
                            <div class="lgx-registration-form">
                                 @include('lpage.landingPageform')
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section>
<!--ABOUT END-->



<!--VIDEO-->
<section {{$videoSection}} >
    <span class="btn btn-primary" style="float:right;" onclick="video();">Add New Video</span>
    @if($videoData != null)
    <div id="lgx-video" class="lgx-video lgx-video2">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--<h2 class="lgx-video-title"><span>Watch Our Promo video!</span>How to make an online order</h2>-->
                        <div class="lgx-video-area">
                            <figure>
                                <?php
                                    $YouArr = explode('embed/',$videoData->lgm_video_url);
                                    $YouThumb = $YouArr[1];
                                    // maxresdefault.jpg
                                    // hqdefault.jpg
                                ?>
                                <a href="#"><img src="http://img.youtube.com/vi/{{$YouThumb}}/maxresdefault.jpg" alt="Event Video"></a>
                                <figcaption>
                                    <div class="video-icon">
                                        <div class="lgx-vertical">
                                            <a id="myModalLabel" class="icon" href="#" data-toggle="modal" data-target="#lgx-modal">
                                                <i class="fa fa-play " aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                            <!-- Modal-->
                            <div id="lgx-modal" class="modal fade lgx-modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="modalvideo" src="{{$videoData->lgm_video_url}}" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- //.Modal-->
                        </div>
                    </div>
                </div>
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
     @else
        <h2>NO VIDEO ADDED</h2>
    @endif
</section>
<!--//.VIDEO END-->




<!--SCHEDULE-->
<section {{$agendaSection}} >
    <div id="lgx-schedule" class="lgx-schedule lgx-schedule2 lgx-schedule-white">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading" id="event_title" contentEditable="true">
                                @if(!empty($data[0]))
                                    {{$data[0]->event_title}}
                                @else
                                    Event Schedule
                                @endif
                            </h2>
                            <h3 class="subheading" id="event_subtitle" contentEditable="true">
                                @if(!empty($data[0]))
                                    {{$data[0]->event_subtitle}}  
                                @else
                                    Welcome to the dedicated to building remarkable Schedule!
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <span class="btn btn-warning" style="float:right;" data-toggle="modal" data-target="#agendaModal" >Add New Agenda</span>
                    <div class="col-xs-12">
                        <div class="lgx-tab lgx-tab2"> <!--lgx-tab2-->
                            <ul class="nav nav-pills lgx-nav lgx-nav-nogap"> <!--lgx-nav-nogap lgx-nav-colorful-->
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($agenda['dateWiseAgenda'] as $paramName => $value)
                                <li class="<?php echo ($loop->first) ? 'active' : ' '?>"><a data-toggle="pill" href="#home{{$i}}"><h3><span>Day {{$i}}</span></h3> <p>{{date("F jS, Y", strtotime($paramName  ));}}</p></a></li>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                                <!--<li class="active"><a data-toggle="pill" href="#home"><h3>First <span>Day</span></h3> <p><span>29 </span>Nov, 2021</p></a></li>-->
                                <!--<li><a data-toggle="pill" href="#menu1"><h3>Second <span>Day</span></h3> <p><span>28 </span>Jul, 2021</p></a></li>-->
                                <!--<li><a data-toggle="pill" href="#menu2"><h3>Third <span>Day</span></h3> <p><span>29 </span>Nov, 2021</p></a></li>-->
                                <!--<li><a data-toggle="pill" href="#menu3"><h3>Fourth <span>Day</span></h3> <p><span>30 </span>Dec, 2021</p></a></li>-->
                            </ul>
                            <div class="tab-content lgx-tab-content">

                        @php
                        $i=1;
                        @endphp
                        @foreach($agenda['dateWiseAgenda'] as $paramName => $value)
                            <div id="home{{$i}}" class="tab-pane fade in <?php echo ($loop->first)? 'active' : ' '?>">

                                <div class="panel-group" id="accordion{{$i}}" role="tablist" aria-multiselectable="true">
                                    
                                <!-- SINGLE START -->
                                        @foreach($agenda['dateWiseAgenda']["$paramName"] as $age)
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingOne{{$age->lccs_id}}">
                                                <div class="panel-title">
                                                    <a role="button" data-toggle="collapse{{$age->lccs_id}}" data-parent="#accordion{{$i}}" href="#collapseOne{{$age->lccs_id}}" aria-expanded="true" aria-controls="collapseOne{{$age->lccs_id}}">
                                                        <div class="lgx-single-schedule">
                                                            <?php
                                                                $spk_img = $age->spk_img_name;
                                                                $spk_img_arr = explode(",",$spk_img);
                                                            ?> 
                                                            @if(count($spk_img_arr) < 2)
                                                            <div class="author">
                                                                @foreach($spk_img_arr as $img)
                                                                <img src="{{asset($img)}}" alt="Speaker"/>
                                                                @endforeach
                                                            </div>
                                                            @else
                                                            <div class="author author-multi">
                                                                @foreach($spk_img_arr as $img)
                                                                <img src="{{asset($img)}}" alt="Speaker"/>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                            <div class="schedule-info">
                                                                <div style="float:right">
                                                                    <a href="javascript:void(0)"  onclick="editCounselor(`{{$age->lccs_id}}`);"><i class="fa fa-pencil fa-lg" style="color:black"></i></a>
                                                                    <a href="javascript:void(0)"  onclick="deleteCounselor(`{{$age->lccs_id}}`);"><i class="fa fa-trash fa-lg" style="color:black"></i></a>    
                                                                </div>
                                                                <h4 class="time">{{date("h:i a", strtotime($age->lccs_start_datewtime));}} - {{date("h:i a", strtotime($age->lccs_end_datewtime));}}</h4>
                                                                <h3 class="title">{{$age->lccs_name}}</h3>
                                                                <h4 class="author-info">By <span>{{$age->spk_name}}</span>
                                                                <!--,{{--$age->spk_cmp_name--}}-->
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="collapseOne{{$age->lccs_id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne{{$age->lccs_id}}">
                                                <div class="panel-body">
                                                    <p class="text">
                                                        {{$age->lccs_sub_title}}
                                                    </p>
                                                    <h4 class="location"><strong>Location:</strong>  {{$age->lccs_type}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- SINGLE END -->
                                    </div>

                                </div>
                                
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--//.ROW-->
            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.INNER -->
    </div>
</section>
<!--SCHEDULE END-->


<!--SPEAKERS-->
<section {{$speakerSection}} >
    <div id="lgx-speakers" class="lgx-speakers">
        <div class="lgx-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading" id="speaker_title" contentEditable="true">
                                @if(!empty($data[0]))
                                    {{$data[0]->speaker_title}}
                                @else
                                    Who’s Speaking
                                @endif
                            </h2>
                            <h3 class="subheading" id="speaker_subtitle" contentEditable="true">
                                @if(!empty($data[0]))
                                    {{$data[0]->speaker_subtitle}}
                                @else
                                    Welcome to the dedicated to building remarkable Speakers!
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                <!--//.ROW-->
                <!--<span class="btn btn-primary float-right" onclick="addSpeaker();">Add New Speaker</span>-->
                <input type="file" id="speaker" class="hidden imageCropper" accept="image/*" />
                <label for="speaker" class="btn btn-primary" style="float:right;" onclick="CropperWH(800,860,'addSpeaker','photoUpload','Speaker');">Add New Speaker</label>
                <div class="row">
                    <div class="col-xs-12">
                        
                        @if($spkData != null)
                        <?php
                            foreach($spkData as $spk){
                        ?>
                        <div class="lgx-col5 lgx-single-speaker2">
                            <figure>
                                <a class="profile-img" href="#"><img src="{{asset($spk->lgm_name)}}" alt="Speaker"/></a>
                                <figcaption>
                                    <div class="social-group">
                                        <a href="#" onclick="removeGallery(`{{$spk->lgm_id}}`)"><i>REMOVE</i></a>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="title"><a href="#">{{$spk->lgm_spk_name}}</a></h3>
                                        <h4 class="subtitle">{{$spk->lgm_spk_des}}</h4>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <?php
                            }
                        ?>
                        @else
                        <h2>NO SPEAKER ADDED</h2>
                        @endif
                        
                    </div>
                </div>
                <!--//.ROW-->
            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.INNER -->
    </div>
</section>
<!--SPEAKERS END-->



<!--SPONSORED-->
<section {{$sponsorSection}} >
    <!--<span class="btn btn-warning" style="float:right;" data-toggle="modal" data-target="#bgImageSponModal" >Change Sponsors Bg-Image</span>-->
    <input type="file" id="sponBg" class="hidden imageCropper" accept="image/*" />
    <label for="sponBg" class="btn btn-warning" style="float:right;" onclick="CropperWH(1920,935,'uploadSpon','photoUpload','');">Change Sponsors Bg-Image</label>
    <div id="lgx-sponsors" class="lgx-sponsors lgx-sponsors-black" <?php echo $sponBgImg?> >
        <div class="lgx-inner-bg">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading lgx-heading-white">
                                <h2 class="heading" id="sponsor_title" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->sponsor_title}}  
                                    @else
                                        Sponsores
                                    @endif
                                </h2>
                                <h3 class="subheading" id="sponsor_subtitle" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->sponsor_subtitle}}
                                    @else
                                        Welcome to the dedicated to building remarkable Sponsores!
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--//main row-->
                    <div class="row">
                        <div class="col-xs-12">
                            <!--<span class="btn btn-primary float-right" onclick="gSponsor();">Add Gold Sponsor</span>-->
                            <input type="file" id="gSpon" class="hidden imageCropper" accept="image/*" />
                            <label for="gSpon" class="btn btn-primary" style="float:left;" onclick="CropperWH(467,190,'uploadgSponsor','photoUpload','');">Add Gold Sponsor</label>
                            <h3 class="sponsored-heading first-heading">Gold Sponsors</h3>
                            <div class="sponsors-area sponsors-area-bg">
                                <?php
                                    foreach($goldSponsor as $gs){
                                ?>
                                <div class="single">
                                    <a class="" href="#"><img src="{{asset($gs->lgm_name)}}" alt="sponsor"/></a>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`{{$gs->lgm_id}}`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                    <div class="row">
                        <div class="col-xs-12">
                            <!--<span class="btn btn-primary float-right" onclick="sSponsor();">Add Silver Sponsor</span>-->
                            <input type="file" id="sSpon" class="hidden imageCropper" accept="image/*" />
                            <label for="sSpon" class="btn btn-primary" style="float:left;" onclick="CropperWH(467,190,'uploadsSponsor','photoUpload','');">Add Silver Sponsor</label>
                            <h3 class="sponsored-heading secound-heading">Silver Sponsors</h3>
                            <div class="sponsors-area sponsors-area-bg">
                                <?php
                                    foreach($silverSponsor as $ss){
                                ?>
                                <div class="single">
                                    <a class="" href="#"><img src="{{asset($ss->lgm_name)}}" alt="sponsor"/></a>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`{{$ss->lgm_id}}`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                    <div class="section-btn-area">
                        <a class="lgx-btn" href="#">Become A Sponsor</a>
                    </div>
                </div>
                <!--//container-->
            </div>
        </div>
        <!--//lgx-inner-->
    </div>
</section>
<!--SPONSORED END-->





    <!--PHOTO GALLERY-->
    <section {{$gallerySection}} >
        <div id="lgx-photo-gallery" class="lgx-gallery-popup lgx-photo-gallery-normal">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading">
                                <h2 class="heading" id="gallery_title" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->gallery_title}}
                                    @else
                                        Photo Gallery
                                    @endif
                                </h2>
                                <h3 class="subheading" id="gallery_subtitle" contentEditable="true">
                                    @if(!empty($data[0]))
                                        {{$data[0]->gallery_subtitle}}
                                    @else
                                        Welcome to the dedicated to building remarkable Sponsores!
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<span data-toggle="modal" data-target="#galleryModal" id="addGallery" class="btn btn-primary float-right">Add New Photo</span>-->
                        <input type="file" id="gallery" class="hidden imageCropper" accept="image/*" />
                        <label for="gallery" class="btn btn-primary" style="float:left;" onclick="CropperWH(500,500,'uploadphoto','photoUpload','');">Add New Photo</label>
                        <div class="col-xs-12">
                            <div class="lgx-gallery-area">
                                
                                <?php
                                    foreach($galleryData as $gd){
                                ?>
                                <div  class="lgx-gallery-single">
                                    <figure>
                                        <img title="Memories One" src="{{asset($gd->lgm_name)}}" alt="Memories one"/>
                                        <figcaption class="lgx-figcaption">
                                            <div class="lgx-hover-link">
                                                <div class="lgx-vertical">
                                                    <a title="Memories One" href="{{asset($gd->lgm_name)}}">
                                                        <i class="fa fa-chain-broken" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`{{$gd->lgm_id}}`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
                                </div>

                                <?php
                                    }
                                ?>
                                
                                <!--Single photo-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--PHOTO GALLERY END-->



    <!--News-->
    <section style="display:none;">
        <div id="lgx-news" class="lgx-news">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading">
                                <h2 class="heading">From Our Blog</h2>
                                <h3 class="subheading">Conferences dedicated to building remarkable events.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="news-single.html"><img src="http://placehold.it/1144x690" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2021</span>
                                        <span>by <a href="#">Riazsagar</a></span>
                                        <span><a href="#">Design</a></span>
                                    </div>
                                    <h3 class="title"><a href="news-single.html">Brooklyn Beta was the most important conferen best tristique</a></h3>
                                    <a class="lgx-btn lgx-btn-white lgx-btn-sm" href="#"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="news-single.html"><img src="http://placehold.it/1144x690" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2021</span>
                                        <span>by <a href="#">Riazsagar</a></span>
                                        <span><a href="#">Design</a></span>
                                    </div>
                                    <h3 class="title"><a href="news-single.html">Brooklyn Beta was the most important conferen best tristique</a></h3>
                                    <a class="lgx-btn lgx-btn-white lgx-btn-sm" href="#"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="news-single.html"><img src="http://placehold.it/1144x690" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2021</span>
                                        <span>by <a href="#">Riazsagar</a></span>
                                        <span><a href="#">Design</a></span>
                                    </div>
                                    <h3 class="title"><a href="news-single.html">Brooklyn Beta was the most important conferen best tristique</a></h3>
                                    <a class="lgx-btn lgx-btn-white lgx-btn-sm" href="#"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-btn-area">
                        <a class="lgx-btn" href="news.html">View More Blogs</a>
                    </div>
                </div><!-- //.CONTAINER -->
            </div><!-- //.INNER -->
        </div>
    </section>
    <!--News END-->







<!--FOOTER-->
<footer {{$footerSection}} >
    <div id="lgx-footer" class="lgx-footer"> <!--lgx-footer-white-->
        <div class="lgx-inner-footer">
            <div class="lgx-subscriber-area lgx-subscriber-area-indiv lgx-subscriber-area-black"> <!--lgx-subscriber-area-indiv-->
                <div class="container">
                    <div class="lgx-subscriber-inner lgx-subscriber-inner-indiv">  <!--lgx-subscriber-inner-indiv-->
                        <h3 class="subscriber-title">Join Newsletter</h3>
                        <form class="lgx-subscribe-form" >
                            <div class="form-group form-group-email">
                                <input type="email" id="subscribe" placeholder="Enter your email Address  ..." class="form-control lgx-input-form form-control"  />
                            </div>
                            <div class="form-group form-group-submit">
                                <button type="submit" name="lgx-submit" id="lgx-submit" class="lgx-btn lgx-submit"><span>Subscribe</span></button>
                            </div>
                        </form> <!--//.SUBSCRIBE-->
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="lgx-footer-area">
                    <div class="lgx-footer-single">
                        <h3 class="footer-title" id="foo_title" contentEditable="true">
                            @if(!empty($data[0]))
                                {{$data[0]->foo_title}}
                            @else
                                Venue Location
                            @endif
                        </h3>
                        <h4 class="date" id="foo_date" contentEditable="true">
                            @if(!empty($data[0]))
                                {{$data[0]->foo_date}}
                            @else
                                18 - 21 December, 2022
                            @endif
                        </h4>
                        <address id="foo_address" contentEditable="true">
                            @if(!empty($data[0]))
                                {{$data[0]->foo_address}}
                            @else
                                85 Golden Street, Darlinghurst
                                ERP 2022, United States
                            @endif
                        </address>
                        <a id="myModalLabel2" data-toggle="modal" data-target="#lgx-modal-map" class="map-link" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> View Map location</a>
                    </div>
                    <div class="lgx-footer-single">
                        <h2 class="footer-title">Instagram Feed</h2>
                        <div id="instafeed">
                        </div>
                    </div>
                    <div class="lgx-footer-single">
                        <h3 class="footer-title" id="social_title" contentEditable="true">
                            @if(!empty($data[0]))
                                {{$data[0]->social_title}}
                            @else
                                Social Connection
                            @endif
                        </h3>
                        <p class="text" id="social_subtitle" contentEditable="true">
                            @if(!empty($data[0]))
                                {{$data[0]->social_subtitle}}
                            @else
                                You should connect social area
                                for Any update
                            @endif
                        </p>
                        <ul class="list-inline lgx-social-footer">
                            @if(!empty($data[0]))
                                <li><a href="{{$data[0]->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="{{$data[0]->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="{{$data[0]->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
                            @else
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
                            @endif
                        </ul>
                        <a href="#" onclick="social();" data-toggle="modal" data-target="#socialModal"><i class="fa fa-pencil fa-lg"></i></a>
                    </div>
                </div>
                <!-- Modal-->
                <div id="lgx-modal-map" class="modal fade lgx-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="lgxmapcanvas map-canvas-default" id="map_canvas"> </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- //.Modal-->

                <div class="lgx-footer-bottom">
                    <div class="lgx-copyright">
                        <p> <span>©</span> 2021 Emeet is powered by <a href="http://www.themearth.com/">themearth.</a> The property of their owners.</p>
                    </div>
                </div>

            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.footer Middle -->
    </div>
</footer>
<!--FOOTER END-->

@endsection