<?php
    $selectedEvent=Session('selectedEvent');
   $tm_id= empty($selectedEvent->tm_id) ? ''  : $selectedEvent->tm_id;
?>

<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item @if(basename($_SERVER['REQUEST_URI'])=='my-leads') active @endif " >
                <a class="nav-item-hold" href="my-leads">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">My Leads</span>
                </a>
                <div class="triangle"></div>
            </li>
            
            <li class="nav-item  @if(basename($_SERVER['REQUEST_URI'])=='profile') active @endif " >
                <a class="nav-item-hold" href="{{route('profile',Session('brand'))}}">
                    <i class="nav-icon i-Gear"></i>
                    <span class="nav-text">Manage Profile</span>
                </a>
                <div class="triangle"></div>
            </li>
          
            <li class="nav-item {{ request()->is('reports/*') ? 'active' : '' }}" data-item="reports">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <div class="triangle"></div>
            </li>
          
           
        </ul>
    </div>
    
    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="childNav" data-parent="reports">
            <li class="nav-item">
                <a class="{{ Route::currentRouteName()=='forms-basic' ? 'open' : '' }}" href="activityreport">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Activity Report</span>
                </a>
            </li>
        </ul>
    </div>
  
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->