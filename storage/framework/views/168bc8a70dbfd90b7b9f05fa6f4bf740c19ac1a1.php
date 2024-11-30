<?php
    // echo print_r($data);die;
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


<?php $__env->startSection('page-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

<?php
    // foreach($agenda['dateWiseAgenda'] as $paramName => $value){
    //   dump($agenda['dateWiseAgenda']["$paramName"][0]->lccs_id);   
    // }
    
    // die;
?>

<?php echo $__env->make('layouts.header-lpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!--BANNER-->
<section>
    <div class="lgx-banner lgx-banner3" <?php echo $banImg?> >
        <div class="lgx-banner-style">
            <div class="lgx-inner lgx-inner-fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <div class="lgx-banner-info"> <!--lgx-banner-info-center lgx-banner-info-black lgx-banner-info-big lgx-banner-info-bg-->
                                <h3 class="subtitle" id="baner_subtitle" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php if(!empty($data[0]->baner_subtitle)): ?>
                                            <?php echo e($data[0]->baner_subtitle); ?>

                                        <?php else: ?>
                                         <?php echo e(Session::get('selectedEvent')->aem_name); ?>

                                        <?php endif; ?>
                                        
                                    <?php else: ?>
                                        You can learn anything
                                    <?php endif; ?>
                                </h3>
                                <h2 class="title" id="baner_title" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->baner_title); ?>

                                    <?php else: ?>
                                        Conference 2021
                                    <?php endif; ?>
                                </h2>
                                <h3 class="date" id="baner_date" contentEditable="true">
                                    <i class="fa fa-calendar"></i>
                                    <?php if(!empty($data[0])): ?>
                                    <?php if(!empty($data[0]->baner_date)): ?>
                                            <?php echo e($data[0]->baner_date); ?>

                                        <?php else: ?>
                                            <?php echo e(date('j',strtotime(Session::get('selectedEvent')->aem_start_date))); ?>

                                            <?php echo e(date('-j F, Y',strtotime(Session::get('selectedEvent')->aem_end_date))); ?>

                                           
                                        <?php endif; ?>
                                    <?php else: ?>
                                        23-27 September, 2021
                                    <?php endif; ?>
                                    
                                </h3>
                                <h3 class="location" id="baner_location" contentEditable="true">
                                    <i class="fa fa-map-marker"></i> 
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->baner_location); ?>

                                    <?php else: ?>
                                        21 King Street, Dhaka 1205, Bangladesh.
                                    <?php endif; ?>
                                </h3>
                                <!--<div class="action-area">-->
                                <!--    <div class="lgx-video-area">-->
                                <!--        <a class="lgx-btn lgx-btn-red" href="#" id="baner_contact">Contact</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5">
                            <div class="lgx-registration-form-box lgx-registration-banner-box"> <!--lgx-registration-banner-box-->
                                <div class="lgx-registration-form">
                                    
                                  <?php echo $__env->make('lpage.landingPageform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    </div>
    <!--<span class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#bgImageModal" >Change Banner Image</span> -->
    <input type="file" id="ban" class="hidden imageCropper" accept="image/*" />
    <label for="ban" class="btn btn-primary" style="float:right;" onclick="CropperWH(1920,935,'uploadBanner','photoUpload','');">Change Banner Image</label>
</section>
<!--BANNER END-->

    

<!--ABOUT-->
<section <?php echo e($aboutSection); ?> >
    <div id="lgx-about" class="lgx-about">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="lgx-about-content-area">
                            <div class="lgx-heading">
                                <h2 class="heading" id="about_head" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->about_head); ?>

                                    <?php else: ?>
                                    	Happy New Year 2021
                                    <?php endif; ?>
                                </h2>
                                <h3 class="subheading" id="about_subhead" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->about_subhead); ?>

                                    <?php else: ?>
                                    	Why Happy New Year 2021 ?
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="lgx-about-content">
                                <p class="text" id="about_content" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->about_content); ?>

                                    <?php else: ?>
                                    	Morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                    	Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. 
                                    	Donec eu libero sit amet quam egestas semper. 
                                    	Aenean ultricies mi vitae est. Mauris Eonec eu ribero sit amet quam egestas semper. Aenean are ultricies mi vitae.
                                    <?php endif; ?>
                                </p>
                                <!--<div class="section-btn-area">-->
                                <!--    <a class="lgx-btn" href="about.html" id="about_mrbtn">More About</a>-->
                                <!--    <a class="lgx-btn lgx-btn-red lgx-scroll" href="#lgx-registration" id="about_buytkt">Buy Ticket</a>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <span class="btn btn-primary" onclick="video();">Add New Video</span>
                        <?php if($videoData != null): ?>
                        <div class="lgx-about-video">
                            <div class="lgx-video-area">
                                <figure>
                                    <?php
                                        $YouArr = explode('embed/',$videoData->lgm_video_url);
                                        $YouThumb = $YouArr[1];
                                        // maxresdefault.jpg
                                        // hqdefault.jpg
                                    ?>
                                    <a href="#"><img src="http://img.youtube.com/vi/<?php echo e($YouThumb); ?>/maxresdefault.jpg" alt="Event Video"></a>
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
                                                <iframe id="modalvideo" src="<?php echo e($videoData->lgm_video_url); ?>" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- //.Modal-->
                            </div>
                        </div>
                        <?php else: ?>
                            <h2>NO VIDEO ADDED</h2>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div><!-- //.CONTAINER -->
        </div><!-- //.INNER -->
    </div>
</section>
<!--ABOUT END-->




    <!--MILESTONE-->
    <section <?php echo e($milestoneSection); ?> >
        <!--<span class="btn btn-warning" style="float:left;" data-toggle="modal" data-target="#bgImageMileModal" >Change Milestone Bg-Image</span>-->
        <input type="file" id="mile" class="hidden imageCropper" accept="image/*" />
        <label for="mile" class="btn btn-warning" style="float:left;" onclick="CropperWH(1920,478,'uploadMile','photoUpload','');">Change Milestone Bg-Image</label>
        <div id="lgx-milestone-about" class="lgx-milestone-about" <?php echo $mileImg?> >
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="lgx-milestone-area">
                                <div class="lgx-milestone">
                                    <div class="milestone-inner">
                                        <div class="lgx-content">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div class="lgx-counter-area">
                                                        <img src="<?php echo e(asset('l_assets/img/icons/1.png')); ?>" alt="teacher icon">
                                                        <div class="counter-text">
                                                            <span class="lgx-counter" id="count_one" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_one); ?>

                                                                <?php else: ?>
                                                                	500
                                                                <?php endif; ?>
                                                            </span>
                                                            <small id="count_one_name" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_one_name); ?>

                                                                <?php else: ?>
                                                                	Usefull Sessions
                                                                <?php endif; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div> <!--//.COL-->
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div class="lgx-counter-area">
                                                        <img src="<?php echo e(asset('l_assets/img/icons/2.png')); ?>" alt="teacher icon">
                                                        <div class="counter-text">
                                                            <span class="lgx-counter" id="count_two" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_two); ?>

                                                                <?php else: ?>
                                                                	085
                                                                <?php endif; ?>
                                                            </span>
                                                            <small id="count_two_name" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_two_name); ?>

                                                                <?php else: ?>
                                                                	Great Speakers
                                                                <?php endif; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div> <!--//.COL-->
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div class="lgx-counter-area">
                                                        <img src="<?php echo e(asset('l_assets/img/icons/3.png')); ?>" alt="teacher icon">
                                                        <div class="counter-text">
                                                            <span class="lgx-counter" id="count_three" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_three); ?>

                                                                <?php else: ?>
                                                                	7896
                                                                <?php endif; ?>
                                                            </span>
                                                            <small id="count_three_name" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_three_name); ?>

                                                                <?php else: ?>
                                                                	Regular Crowd
                                                                <?php endif; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div> <!--//.COL-->
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div class="lgx-counter-area">
                                                        <img src="<?php echo e(asset('l_assets/img/icons/4.png')); ?>" alt="teacher icon">
                                                        <div class="counter-text">
                                                            <span class="lgx-counter" id="count_four" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_four); ?>

                                                                <?php else: ?>
                                                                	600
                                                                <?php endif; ?>
                                                            </span>
                                                            <small id="count_four_name" contentEditable="true">
                                                                <?php if(!empty($data[0])): ?>
                                                                    <?php echo e($data[0]->count_four_name); ?>

                                                                <?php else: ?>
                                                                	Skilled Speakers
                                                                <?php endif; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div> <!--//.COL-->
                                            </div> <!--//.ROW-->
                                        </div> <!--//. lgx CONTENT CONTENT-->
                                    </div><!--//.lgx INNER-->
                                </div><!--//.Milestone End -->
                            </div>
                        </div>
                    </div>
                </div><!-- //.CONTAINER -->
            </div><!-- //.INNER -->
        </div>
    </section>
    <!--MILESTONE END-->





<!--SPEAKERS-->
<section <?php echo e($speakerSection); ?> >
    <div id="lgx-speakers" class="lgx-speakers">
        <div class="lgx-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading" id="speaker_title" contentEditable="true">
                                <?php if(!empty($data[0])): ?>
                                    <?php echo e($data[0]->speaker_title); ?>

                                <?php else: ?>
                                    Who’s Speaking
                                <?php endif; ?>
                            </h2>
                            <h3 class="subheading" id="speaker_subtitle" contentEditable="true">
                                <?php if(!empty($data[0])): ?>
                                    <?php echo e($data[0]->speaker_subtitle); ?>

                                <?php else: ?>
                                    Welcome to the dedicated to building remarkable Speakers!
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <!--//.ROW-->
                <!--<span class="btn btn-primary float-right" onclick="addSpeaker();">Add New Speaker</span>-->
                <input type="file" id="speakerSec" class="hidden imageCropper" accept="image/*" />
                <label for="speakerSec" class="btn btn-primary" style="float:right;" onclick="CropperWH(800,860,'addSpeaker','photoUpload','Speaker');">Add New Speaker</label>
                <div class="row">
                    <div class="col-xs-12">
                        
                        <?php if($spkData != null): ?>
                        <?php
                            foreach($spkData as $spk){
                        ?>
                        <div class="lgx-col4 lgx-single-speaker2">
                            <figure>
                                <a class="profile-img" href="#"><img src="<?php echo e(asset($spk->lgm_name)); ?>" alt="Speaker"/></a>
                                <figcaption>
                                    <div class="social-group">
                                        <a href="#" onclick="removeGallery(`<?php echo e($spk->lgm_id); ?>`)"><i>REMOVE</i></a>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="title"><a href="#"><?php echo e($spk->lgm_spk_name); ?></a></h3>
                                        <h4 class="subtitle"><?php echo e($spk->lgm_spk_des); ?></h4>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <?php
                            }
                        ?>
                        <?php else: ?>
                        <h2>NO SPEAKER ADDED</h2>
                        <?php endif; ?>
                        
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





<!--SCHEDULE-->
<section <?php echo e($agendaSection); ?> >
    <div id="lgx-schedule" class="lgx-schedule">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading lgx-heading-white">
                            <h2 class="heading" id="event_title" contentEditable="true">
                                <?php if(!empty($data[0])): ?>
                                    <?php echo e($data[0]->event_title); ?>

                                <?php else: ?>
                                    Event Schedule
                                <?php endif; ?>
                            </h2>
                            <h3 class="subheading" id="event_subtitle" contentEditable="true">
                                <?php if(!empty($data[0])): ?>
                                    <?php echo e($data[0]->event_subtitle); ?>  
                                <?php else: ?>
                                    Welcome to the dedicated to building remarkable Schedule!
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <span class="btn btn-warning" style="float:right;" data-toggle="modal" data-target="#agendaModal" >Add New Agenda</span>
                    <div class="col-xs-12">
                        <div class="lgx-tab">
                            <ul class="nav nav-pills lgx-nav">
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $agenda['dateWiseAgenda']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paramName => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo ($loop->first) ? 'active' : ' '?>"><a data-toggle="pill" href="#home<?php echo e($i); ?>"><h3><span>Day <?php echo e($i); ?></span></h3> <p><?php echo e(date("F jS, Y", strtotime($paramName  ))); ?></p></a></li>
                                <?php
                                    $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!--<li><a data-toggle="pill" href="#menu1"><h3>Second <span>Day</span></h3> <p><span>28 </span>Jul, 2022</p></a></li>-->
                                <!--<li><a data-toggle="pill" href="#menu2"><h3>Third <span>Day</span></h3> <p><span>29 </span>Nov, 2022</p></a></li>-->
                                <!--<li><a data-toggle="pill" href="#menu3"><h3>Fourth <span>Day</span></h3> <p><span>30 </span>Dec, 2022</p></a></li>-->
                            </ul>
                            <div class="tab-content lgx-tab-content">

                            <?php
                            $i=1;
                            ?>
                            <?php $__currentLoopData = $agenda['dateWiseAgenda']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paramName => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div id="home<?php echo e($i); ?>" class="tab-pane fade in <?php echo ($loop->first)? 'active' : ' '?>">

                                    <div class="panel-group" id="accordion<?php echo e($i); ?>" role="tablist" aria-multiselectable="true">
                                        
                                        <!-- SINGLE START -->
                                        
                                            <?php $__currentLoopData = $agenda['dateWiseAgenda']["$paramName"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $age): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="panel panel-default lgx-panel">
                                            <div class="panel-heading" role="tab" id="headingOne<?php echo e($age->lccs_id); ?>">
                                                <div class="panel-title">
                                                    <a role="button" data-toggle="collapse<?php echo e($age->lccs_id); ?>" data-parent="#accordion<?php echo e($i); ?>" href="#collapseOne<?php echo e($age->lccs_id); ?>" aria-expanded="true" aria-controls="collapseOne<?php echo e($age->lccs_id); ?>">
                                                        <div class="lgx-single-schedule">
                                                            <?php
                                                                $spk_img = $age->spk_img_name;
                                                                $spk_img_arr = explode(",",$spk_img);
                                                            ?> 
                                                            <?php if(count($spk_img_arr) < 2): ?>
                                                            <div class="author">
                                                                <?php $__currentLoopData = $spk_img_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset($img)); ?>" alt="Speaker"/>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                            <?php else: ?>
                                                            <div class="author author-multi">
                                                                <?php $__currentLoopData = $spk_img_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img src="<?php echo e(asset($img)); ?>" alt="Speaker"/>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="schedule-info">
                                                                <div style="float:right">
                                                                    <a href="javascript:void(0)"  onclick="editCounselor(`<?php echo e($age->lccs_id); ?>`);"><i class="fa fa-pencil fa-lg" style="color:black"></i></a>
                                                                    <a href="javascript:void(0)"  onclick="deleteCounselor(`<?php echo e($age->lccs_id); ?>`);"><i class="fa fa-trash fa-lg" style="color:black"></i></a>    
                                                                </div>
                                                                
                                                                <h4 class="time"><?php echo e(date("h:i a", strtotime($age->lccs_start_datewtime))); ?> - <?php echo e(date("h:i a", strtotime($age->lccs_end_datewtime))); ?></h4>
                                                                <h3 class="title"><?php echo e($age->lccs_name); ?></h3>
                                                                <h4 class="author-info">By <span><?php echo e($age->spk_name); ?></span>
                                                                <!--,-->
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="collapseOne<?php echo e($age->lccs_id); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne<?php echo e($age->lccs_id); ?>">
                                                <div class="panel-body">
                                                    <p class="text">
                                                        <?php echo e($age->lccs_sub_title); ?>

                                                    </p>
                                                    <h4 class="location"><strong>Location:</strong>  <?php echo e($age->lccs_type); ?> </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!-- SINGLE END -->
                                    </div>

                                </div>
                                
                                <?php
                                    $i++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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



<!--SPONSORED-->
<section <?php echo e($sponsorSection); ?> >
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
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->sponsor_title); ?>  
                                    <?php else: ?>
                                        Sponsores
                                    <?php endif; ?>
                                </h2>
                                <h3 class="subheading" id="sponsor_subtitle" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->sponsor_subtitle); ?>

                                    <?php else: ?>
                                        Welcome to the dedicated to building remarkable Sponsores!
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--//main row-->
                    <div class="row">
                        <div class="col-xs-12">
                            <!--<span class="btn btn-primary" onclick="gSponsor();">Add Gold Sponsor</span>-->
                            <input type="file" id="gSpon" class="hidden imageCropper" accept="image/*" />
                            <label for="gSpon" class="btn btn-primary" style="float:left;" onclick="CropperWH(467,190,'uploadgSponsor','photoUpload','');">Add Gold Sponsor</label>
                            <h3 class="sponsored-heading first-heading">Gold Sponsors</h3>
                            <div class="sponsors-area sponsors-area-bg">
                                <?php
                                    foreach($goldSponsor as $gs){
                                ?>
                                <div class="single">
                                    <a class="" href="#"><img src="<?php echo e(asset($gs->lgm_name)); ?>" alt="sponsor"/></a>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`<?php echo e($gs->lgm_id); ?>`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
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
                                    <a class="" href="#"><img src="<?php echo e(asset($ss->lgm_name)); ?>" alt="sponsor"/></a>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`<?php echo e($ss->lgm_id); ?>`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
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
    <section <?php echo e($gallerySection); ?> >
        <div id="lgx-photo-gallery" class="lgx-gallery-popup lgx-photo-gallery-normal">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading">
                                <h2 class="heading" id="gallery_title" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->gallery_title); ?>

                                    <?php else: ?>
                                        Photo Gallery
                                    <?php endif; ?>
                                </h2>
                                <h3 class="subheading" id="gallery_subtitle" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->gallery_subtitle); ?>

                                    <?php else: ?>
                                        Welcome to the dedicated to building remarkable Sponsores!
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--<span data-toggle="modal" data-target="#galleryModal" id="addGallery" class="btn btn-primary">Add New Photo</span>-->
                        <input type="file" id="gallery" class="hidden imageCropper" accept="image/*" />
                        <label for="gallery" class="btn btn-primary" style="float:left;" onclick="CropperWH(500,500,'uploadphoto','photoUpload','');">Add New Photo</label>
                        <div class="col-xs-12">
                            
                            <div class="lgx-gallery-area">
                                
                                <?php
                                    foreach($galleryData as $gd){
                                ?>
                                <div  class="lgx-gallery-single">
                                    <figure>
                                        <img title="Memories One" src="<?php echo e(asset($gd->lgm_name)); ?>" alt="Memories one"/>
                                        <figcaption class="lgx-figcaption">
                                            <div class="lgx-hover-link">
                                                <div class="lgx-vertical">
                                                    <a title="Memories One" href="<?php echo e(asset($gd->lgm_name)); ?>">
                                                        <i class="fa fa-chain-broken" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                    <a href="#" class="btn btn-danger" onclick="removeGallery(`<?php echo e($gd->lgm_id); ?>`)"> <span class="d-flex align-items-right"><i class="i-Close-Window font-weight-bold"></i>Remove</span></a>
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


    <!--News-->
    <section style="display:none;">
        <div id="lgx-news" class="lgx-news">
            <div class="lgx-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="lgx-heading">
                                <h2 class="heading" id="blog_title" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->blog_title); ?>

                                    <?php else: ?>
                                        From Our Blog
                                    <?php endif; ?>
                                </h2>
                                <h3 class="subheading" id="blog_subtitle" contentEditable="true">
                                    <?php if(!empty($data[0])): ?>
                                        <?php echo e($data[0]->blog_subtitle); ?>

                                    <?php else: ?>
                                        Conferences dedicated to building remarkable events.
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="lgx-single-news">
                                <figure>
                                    <a href="news-single.html"><img src="<?php echo e(asset('l_assets/img/news/news1.jpg')); ?>" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2022</span>
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
                                    <a href="news-single.html"><img src="<?php echo e(asset('l_assets/img/news/news2.jpg')); ?>" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2022</span>
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
                                    <a href="news-single.html"><img src="<?php echo e(asset('l_assets/img/news/news3.jpg')); ?>" alt=""></a>
                                </figure>
                                <div class="single-news-info">
                                    <div class="meta-wrapper">
                                        <span>April 25, 2022</span>
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




    <!--Instagram GALLERY-->
    <section style="display:none;">
        <div id="lgx-instagram" class="lgx-instagram">
            <div class="lgx-inner">
                <div class="lgx-instagram-area">
                    <div class="insta-text">
                        <div class="lgx-hover-link">
                            <div class="lgx-vertical">
                                <h2 class="text">Instagram Area</h2>
                            </div>
                        </div>
                    </div>
                    <div id="instafeed">
                    </div>
                </div>
            </div><!--l//#lgx-OWL NEWS-->
        </div>
    </section>
    <!--InstagramY END-->


<!--FOOTER-->
<footer <?php echo e($footerSection); ?> >
    <div id="lgx-footer" class="lgx-footer lgx-footer-black"> <!--lgx-footer-black-->
        <div class="lgx-inner-footer">
            <div class="lgx-subscriber-area"> <!--lgx-subscriber-area-indiv-->
                <div class="container">
                    <div class="lgx-subscriber-inner">  <!--lgx-subscriber-inner-indiv-->
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
                        <input type="file" id="logoFoo" class="hidden imageCropper" accept="image/*" />
                        <label for="logoFoo" onclick="CropperWH(200,219,'uploadlogoFoo','logoUpload','');">
                            <?php if(!empty($data[0]) && $data[0]->logo_foo_image != null): ?>
                                <img src="<?php echo e(asset($data[0]->logo_foo_image)); ?>" alt="Logo">
                            <?php else: ?>
                                <img src="<?php echo e(asset('l_assets/img/footer-logo.png')); ?>" alt="Logo">
                            <?php endif; ?>
                        </label>
                    </div> <!--//footer-area-->
                    <div class="lgx-footer-single">
                        <h3 class="footer-title" id="foo_title" contentEditable="true">
                            <?php if(!empty($data[0])): ?>
                                <?php echo e($data[0]->foo_title); ?>

                            <?php else: ?>
                                Venue Location
                            <?php endif; ?>
                        </h3>
                        <h4 class="date" id="foo_date" contentEditable="true">
                            <?php if(!empty($data[0])): ?>
                                <?php echo e($data[0]->foo_date); ?>

                            <?php else: ?>
                                18 - 21 December, 2022
                            <?php endif; ?>
                        </h4>
                        <address id="foo_address" contentEditable="true">
                            <?php if(!empty($data[0])): ?>
                                <?php echo e($data[0]->foo_address); ?>

                            <?php else: ?>
                                85 Golden Street, Darlinghurst
                                ERP 2022, United States
                            <?php endif; ?>
                        </address>
                        <a id="myModalLabel2" data-toggle="modal" data-target="#lgx-modal-map" class="map-link" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> View Map location</a>
                    </div>
                    <div class="lgx-footer-single">
                        <h3 class="footer-title" id="social_title" contentEditable="true">
                            <?php if(!empty($data[0])): ?>
                                <?php echo e($data[0]->social_title); ?>

                            <?php else: ?>
                                Social Connection
                            <?php endif; ?>
                        </h3>
                        <p class="text" id="social_subtitle" contentEditable="true">
                            <?php if(!empty($data[0])): ?>
                                <?php echo e($data[0]->social_subtitle); ?>

                            <?php else: ?>
                                You should connect social area
                                for Any update
                            <?php endif; ?>
                        </p>
                        <ul class="list-inline lgx-social-footer">
                            <?php if(!empty($data[0])): ?>
                                <li><a href="<?php echo e($data[0]->facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo e($data[0]->twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo e($data[0]->instagram); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
                            <?php else: ?>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>-->
                                <!--<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>-->
                            <?php endif; ?>
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
                        <p> <span>©</span> 2022 Emeet is powered by <a href="https://ibentos.com/">iBentos LLP.</a></p>
                    </div>
                </div>

            </div>
            <!-- //.CONTAINER -->
        </div>
        <!-- //.footer Middle -->
    </div>
</footer>
<!--FOOTER END-->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.lpage-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/lpage/landingPage.blade.php ENDPATH**/ ?>