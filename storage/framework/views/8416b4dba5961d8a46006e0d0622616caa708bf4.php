<?php
    $selectedEvent=Session('selectedEvent');
   $tm_id= empty($selectedEvent->tm_id) ? ''  : $selectedEvent->tm_id;
   $featurelist=Session::get('featurelist');
   //print_r($featurelist);die;
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
            
            <li class="nav-item <?php echo e(request()->is('contents/*') ? 'active' : ''); ?>" data-item="contents">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Manage Megaspace</span>
                </a>
                <div class="triangle"></div>
            </li>
            
            <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='manageevents'): ?> active <?php endif; ?>">
                <a class="nav-item-hold" href="manageevents">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Manage Events</span>
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
            <li class="nav-item d-none  <?php if(basename($_SERVER['REQUEST_URI'])=='exhibitor'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="exhibitor">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Manage Exhibitors</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php if(!empty($featurelist) && isset($featurelist['selfie-wall']) && $featurelist['selfie-wall'] == 'active'): ?>
            <li class="nav-item  <?php if(basename($_SERVER['REQUEST_URI'])=='selfiewall'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="selfiewall">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Selfie Wall</span>
                </a>
                <div class="triangle"></div>
            </li>
            <?php endif; ?>
            
          <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='Campaign'): ?> active <?php endif; ?> " data-item="campaign">
                <a class="nav-item-hold" href="Campaign">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Campaign Manager</span>
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
            <?php if(!empty($featurelist) && isset($featurelist['treasure-hunt']) && $featurelist['treasure-hunt'] == 'active'): ?>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="treasurehuntreport">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Treasure Hunt</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        
        <ul class="childNav" data-parent="contents">
        
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="choosetemplates">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Choose Template</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managehomepage">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Home Page</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="manageunitycontent">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Manage Content</span>
                </a>
            </li>
            
            <li class="nav-item d-none">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="managetemplatebanners">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Asset Library</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================--><?php /**PATH /home/megaspace/public_html/sbilife/admin/resources/views/layouts/large-vertical-sidebar/admin-sidebar.blade.php ENDPATH**/ ?>