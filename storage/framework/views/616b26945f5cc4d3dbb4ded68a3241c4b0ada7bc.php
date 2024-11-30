<?php
    $selectedEvent=Session('selectedEvent');
   $tm_id= empty($selectedEvent->tm_id) ? ''  : $selectedEvent->tm_id;
//   echo print_r($selectedEvent);
?>

<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            
             <li class="nav-item  <?php if(basename($_SERVER['REQUEST_URI'])=='dashboard'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="dashboard">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='Events'): ?> active <?php endif; ?> " >
                <a class="nav-item-hold" href="Events">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">Event Manager</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php if(!empty($selectedEvent)): ?>
                 <li class="nav-item  <?php if(basename($_SERVER['REQUEST_URI'])=='landingPage?template=<?php echo e(base64_encode($selectedEvent->tm_id)); ?>'): ?> active <?php endif; ?>" >
                    <a class="nav-item-hold" target="_blank" href="landingPage?template=<?php echo e(base64_encode($selectedEvent->tm_id)); ?>">
                        <i class="nav-icon i-Suitcase"></i>
                        <span class="nav-text">Landing Page Setup</span>
                    </a>
                    <div class="triangle"></div>
                </li>
                
                <li class="nav-item <?php if(basename($_SERVER['REQUEST_URI'])=='manageregistrationpage'): ?> active <?php endif; ?> ">
                    <a class="nav-item-hold" href="manageregistrationpage">
                        <i class="nav-icon i-File-Clipboard-File--Text"></i>
                        <span class="nav-text">Registration Page Setup</span>
                    </a>
                    <div class="triangle"></div>
                </li>
            <?php endif; ?>
            <li class="nav-item <?php if(basename($_SERVER['REQUEST_URI'])=='all-leads'): ?> active <?php endif; ?> " >
                <a class="nav-item-hold" href="all-leads">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">Manage Registrations</span>
                </a>
                <div class="triangle"></div>
            </li>
          <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='Campaign'): ?> active <?php endif; ?> " data-item="campaign">
                <a class="nav-item-hold" href="Campaign">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Campaign Manager</span>
                </a>
                <div class="triangle"></div>
            </li>
            
            <li class="nav-item <?php echo e(request()->is('contents/*') ? 'active' : ''); ?>" data-item="contents">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Manage Contents</span>
                </a>
                <div class="triangle"></div>
            </li>
            
            <li class="nav-item <?php echo e(request()->is('reports/*') ? 'active' : ''); ?>" data-item="reports">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <div class="triangle"></div>
            </li>
          
            <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='settings'): ?> active <?php endif; ?> " >
                <a class="nav-item-hold" href="settings">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">Settings</span>
                </a>
                <div class="triangle"></div>
            </li>
           
        </ul>
    </div>
  <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">

        <ul class="childNav" data-parent="campaign">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='echarts' ? 'open' : ''); ?>" href="Campaign">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">URL Builder</span>
                </a>
            </li>
        </ul>
        
        <ul class="childNav" data-parent="reports">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="attendancereport">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Attendance</span>
                </a>
            </li>
        </ul>
        
        <ul class="childNav" data-parent="contents">
        
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managehomepage">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Home Page</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managetemplates">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Change Template</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managelandingarea">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Landing Area</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managelobby">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Lobby</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manageaudi">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Auditorium</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manageassetlibrary">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Asset Library</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manageexpohall">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Expo Hall</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managetemplatebanners">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Template Banners</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manageunitycontent">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Unity Content</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="Banners">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Manage Banners</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manage-conference-video">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Conference Video</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="company-logo">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Company Logo</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="company-branding-logo">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Company Branding Logo</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="Gestures">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Gestures</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="user-scores">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Manage Quiz Scores</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="user-game-images">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Snowman Game Images</span>
                </a>
            </li>
        </ul>
       
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================--><?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/layouts/large-vertical-sidebar/admin-sidebar.blade.php ENDPATH**/ ?>