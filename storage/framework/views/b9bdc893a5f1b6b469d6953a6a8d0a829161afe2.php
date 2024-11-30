<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            
             <li class="nav-item  <?php if(basename($_SERVER['REQUEST_URI'])=='dashboard'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="<?php echo e(url('dashboard')); ?>">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            
              <li class="nav-item  <?php if(basename($_SERVER['REQUEST_URI'])=='prospects'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="<?php echo e(url('prospects')); ?>">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Customers</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item d-none  <?php if(basename($_SERVER['REQUEST_URI'])=='exhibitor'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="<?php echo e(url('exhibitor')); ?>">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Manage Exhibitors</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['REQUEST_URI'])=='templates'): ?> active <?php endif; ?>" >
                <a class="nav-item-hold" href="<?php echo e(route('templates')); ?>">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Manage Templates</span>
                </a>
                <div class="triangle"></div>
            </li>
            
          <li class="nav-item d-none <?php if(basename($_SERVER['REQUEST_URI'])=='Campaign'): ?> active <?php endif; ?> " data-item="campaign">
                <a class="nav-item-hold" href="<?php echo e(url('Campaign')); ?>">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Campaign Manager</span>
                </a>
                <div class="triangle"></div>
            </li>
            
             <!--
            <li class="nav-item <?php echo e(request()->is('dashboard/*') ? 'active' : ''); ?>" data-item="dashboard">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
          
            <li class="nav-item <?php echo e(request()->is('uikits/*') ? 'active' : ''); ?>" data-item="uikits">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">UI kits</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php echo e(request()->is('extrakits/*') ? 'active' : ''); ?>" data-item="extrakits">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Extra kits</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php echo e(request()->is('apps/*') ? 'active' : ''); ?>" data-item="apps">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Computer-Secure"></i>
                    <span class="nav-text">Apps</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php echo e(request()->is('forms/*') ? 'active' : ''); ?>" data-item="forms">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item <?php echo e(request()->is('widgets/*') ? 'active' : ''); ?>" data-item="widgets">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Windows-2"></i>
                    <span class="nav-text">widgets</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item <?php echo e(request()->is('charts/*') ? 'active' : ''); ?>" data-item="charts">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item <?php echo e(request()->is('datatables/*') ? 'active' : ''); ?>">
                <a class="nav-item-hold" href="<?php echo e(route('basic-tables')); ?>">
                    <i class="nav-icon i-File-Horizontal-Text"></i>
                    <span class="nav-text">Datatables</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php echo e(request()->is('sessions/*') ? 'active' : ''); ?>" data-item="sessions">
                <a class="nav-item-hold" href="/test.html">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Sessions</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?php echo e(request()->is('others/*') ? 'active' : ''); ?>" data-item="others">
                <a class="nav-item-hold" href="">
                    <i class="nav-icon i-Double-Tap"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item">
                <a class="nav-item-hold" href="http://demos.ui-lib.com/gull-html-doc/" target="_blank">
                    <i class="nav-icon i-Safe-Box1"></i>
                    <span class="nav-text">Doc</span>
                </a>
                <div class="triangle"></div>
            </li>
            -->
            
           
        </ul>
    </div>
  <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
         <!--Submenu Dashboards -->
        <ul class="childNav" data-parent="dashboard">
            <li class="nav-item ">
                <a class="<?php echo e(Route::currentRouteName()=='dashboard_version_1' ? 'open' : ''); ?>"
                    href="<?php echo e(route('dashboard_version_1')); ?>">
                    <i class="nav-icon i-Clock-3"></i>
                    <span class="item-name">Version 1</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('dashboard_version_2')); ?>"
                    class="<?php echo e(Route::currentRouteName()=='dashboard_version_2' ? 'open' : ''); ?>">
                    <i class="nav-icon i-Clock-4"></i>
                    <span class="item-name">Version 2</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='dashboard_version_3' ? 'open' : ''); ?>"
                    href="<?php echo e(route('dashboard_version_3')); ?>">
                    <i class="nav-icon i-Over-Time"></i>
                    <span class="item-name">Version 3</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='dashboard_version_4' ? 'open' : ''); ?>"
                    href="<?php echo e(route('dashboard_version_4')); ?>">
                    <i class="nav-icon i-Clock"></i>
                    <span class="item-name">Version 4</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="forms">

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='forms-basic' ? 'open' : ''); ?>" href="<?php echo e(route('forms-basic')); ?>">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Basic Elements</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='basic-action-bar' ? 'open' : ''); ?>"
                    href="<?php echo e(route('basic-action-bar')); ?>">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Basic action bar </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='form-layouts' ? 'open' : ''); ?>"
                    href="<?php echo e(route('form-layouts')); ?>">
                    <i class="nav-icon i-Split-Vertical"></i>
                    <span class="item-name">Form Layouts</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='multi-column-forms' ? 'open' : ''); ?>"
                    href="<?php echo e(route('multi-column-forms')); ?>">
                    <i class="nav-icon i-Split-Vertical"></i>
                    <span class="item-name">Multi column forms</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='form-input-group' ? 'open' : ''); ?>"
                    href="<?php echo e(route('form-input-group')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Input Groups</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='form-validation' ? 'open' : ''); ?>"
                    href="<?php echo e(route('form-validation')); ?>">
                    <i class="nav-icon i-Close-Window"></i>
                    <span class="item-name">Form Validation</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='smartWizard' ? 'open' : ''); ?>" href="<?php echo e(route('smartWizard')); ?>">
                    <i class="nav-icon i-Width-Window"></i>
                    <span class="item-name">Smart Wizard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='tagInput' ? 'open' : ''); ?>" href="<?php echo e(route('tagInput')); ?>">
                    <i class="nav-icon i-Tag-2"></i>
                    <span class="item-name">Tag Input</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='form-editor' ? 'open' : ''); ?>" href="<?php echo e(route('form-editor')); ?>">
                    <i class="nav-icon i-Pen-2"></i>
                    <span class="item-name">Rich Editor</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="widgets">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='widget-card' ? 'open' : ''); ?>" href="<?php echo e(route('widget-card')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">widget card</span>
                </a>
            </li>
            <li class="nav-item">


                <a class="<?php echo e(Route::currentRouteName()=='widget-statistics' ? 'open' : ''); ?>"
                    href="<?php echo e(route('widget-statistics')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">widget statistics</span>
                </a>
            </li>

            <li class="nav-item">


                <a class="<?php echo e(Route::currentRouteName()=='widget-list' ? 'open' : ''); ?>" href="<?php echo e(route('widget-list')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Widget List <span class="ml-2 badge badge-pill badge-danger">
                            New</span></span>
                </a>
            </li>

            <li class="nav-item">


                <a class="<?php echo e(Route::currentRouteName()=='widget-app' ? 'open' : ''); ?>" href="<?php echo e(route('widget-app')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Widget App <span class="ml-2 badge badge-pill badge-danger"> New</span>
                    </span>
                </a>
            </li>
            <li class="nav-item">


                <a class="<?php echo e(Route::currentRouteName()=='widget-weather-app' ? 'open' : ''); ?>"
                    href="<?php echo e(route('widget-weather-app')); ?>">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name"> Weather App <span class="ml-2 badge badge-pill badge-danger"> New</span>
                    </span>
                </a>
            </li>

        </ul>


  <ul class="childNav" data-parent="campaign">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='echarts' ? 'open' : ''); ?>" href="<?php echo e(url('Campaign')); ?>">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">URL Builder</span>
                </a>
            </li>
            <!--<li class="nav-item">-->
            <!--    <a class="<?php echo e(Route::currentRouteName()=='chartjs' ? 'open' : ''); ?>" href="<?php echo e(route('chartjs')); ?>">-->
            <!--        <i class="nav-icon i-File-Clipboard-Text--Image"></i>-->
            <!--        <span class="item-name">ChartJs</span>-->
            <!--    </a>-->
            <!--</li>-->
            <!--<li class="nav-item dropdown-sidemenu">-->
            <!--    <a>-->
            <!--        <i class="nav-icon i-File-Clipboard-Text--Image"></i>-->
            <!--        <span class="item-name">Apex Charts</span>-->
            <!--        <i class="dd-arrow i-Arrow-Down"></i>-->
            <!--    </a>-->
            <!--    <ul class="submenu">-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexAreaCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexAreaCharts')); ?>">Area Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexBarCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexBarCharts')); ?>">Bar Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexBubbleCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexBubbleCharts')); ?>">Bubble Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexColumnCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexColumnCharts')); ?>">Column Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexCandleStickCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexCandleStickCharts')); ?>">CandleStick Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexLineCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexLineCharts')); ?>">Line Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexMixCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexMixCharts')); ?>">Mix Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexPieDonutCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexPieDonutCharts')); ?>">PieDonut Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexRadarCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexRadarCharts')); ?>">Radar Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexRadialBarCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexRadialBarCharts')); ?>">RadialBar Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexScatterCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexScatterCharts')); ?>">Scatter Charts</a></li>-->
            <!--        <li><a class="<?php echo e(Route::currentRouteName()=='apexSparklineCharts' ? 'open' : ''); ?>"-->
            <!--                href="<?php echo e(route('apexSparklineCharts')); ?>">Sparkline Charts</a></li>-->

            <!--    </ul>-->
            <!--</li>-->

        </ul>
        <ul class="childNav" data-parent="charts">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='echarts' ? 'open' : ''); ?>" href="<?php echo e(route('echarts')); ?>">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">echarts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='chartjs' ? 'open' : ''); ?>" href="<?php echo e(route('chartjs')); ?>">
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">ChartJs</span>
                </a>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                    <span class="item-name">Apex Charts</span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexAreaCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexAreaCharts')); ?>">Area Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexBarCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexBarCharts')); ?>">Bar Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexBubbleCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexBubbleCharts')); ?>">Bubble Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexColumnCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexColumnCharts')); ?>">Column Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexCandleStickCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexCandleStickCharts')); ?>">CandleStick Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexLineCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexLineCharts')); ?>">Line Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexMixCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexMixCharts')); ?>">Mix Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexPieDonutCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexPieDonutCharts')); ?>">PieDonut Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexRadarCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexRadarCharts')); ?>">Radar Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexRadialBarCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexRadialBarCharts')); ?>">RadialBar Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexScatterCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexScatterCharts')); ?>">Scatter Charts</a></li>
                    <li><a class="<?php echo e(Route::currentRouteName()=='apexSparklineCharts' ? 'open' : ''); ?>"
                            href="<?php echo e(route('apexSparklineCharts')); ?>">Sparkline Charts</a></li>

                </ul>
            </li>





        </ul>

        <ul class="childNav" data-parent="apps">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='invoice' ? 'open' : ''); ?>" href="<?php echo e(route('invoice')); ?>">
                    <i class="nav-icon i-Add-File"></i>
                    <span class="item-name">Invoice</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='inbox' ? 'open' : ''); ?>" href="<?php echo e(route('inbox')); ?>">
                    <i class="nav-icon i-Email"></i>
                    <span class="item-name">Inbox</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='chat' ? 'open' : ''); ?>" href="<?php echo e(route('chat')); ?>">
                    <i class="nav-icon i-Speach-Bubble-3"></i>
                    <span class="item-name">Chat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='calendar' ? 'open' : ''); ?>" href="<?php echo e(route('calendar')); ?>">
                    <i class="nav-icon i-Calendar-4"></i>
                    <span class="item-name">Calendar</span>
                </a>
            </li>
            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Receipt"></i>
                    <span class="item-name">Task Manager <span
                            class=" ml-2 badge badge-pill badge-danger">New</span></span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='task-manager' ? 'open' : ''); ?>"
                            href="<?php echo e(route('task-manager')); ?>">
                            <i class="nav-icon i-Receipt"></i>
                            <span class="item-name">Task manager</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='task-manager-list' ? 'open' : ''); ?>"
                            href="<?php echo e(route('task-manager-list')); ?>">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Task manager list</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='toDo' ? 'open' : ''); ?>" href="<?php echo e(route('toDo')); ?>">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Minimal ToDo</span>
                        </a>
                    </li>
                    <li></li>
                </ul>
            </li>

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Cash-Register"></i>
                    <span class="item-name">Ecommerce <span
                            class=" ml-2 badge badge-pill badge-danger">New</span></span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='ecommerce-products' ? 'open' : ''); ?>"
                            href="<?php echo e(route('ecommerce-products')); ?>">
                            <i class="nav-icon i-Shop-2"></i>
                            <span class="item-name">Products</span>
                        </a>
                    </li>


                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='ecommerce-product-details' ? 'open' : ''); ?>"
                            href="<?php echo e(route('ecommerce-product-details')); ?>">
                            <i class="nav-icon i-Tag-2"></i>
                            <span class="item-name">Product Details</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='ecommerce-cart' ? 'open' : ''); ?>"
                            href="<?php echo e(route('ecommerce-cart')); ?>">
                            <i class="nav-icon i-Add-Cart"></i>
                            <span class="item-name">Cart</span>
                        </a>
                    </li>

                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='ecommerce-checkout' ? 'open' : ''); ?>"
                            href="<?php echo e(route('ecommerce-checkout')); ?>">
                            <i class="nav-icon i-Cash-register-2"></i>
                            <span class="item-name">Checkout</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown-sidemenu">
                <a>
                    <i class="nav-icon i-Business-ManWoman"></i>
                    <span class="item-name">Contacts<span class=" ml-2 badge badge-pill badge-danger">New</span></span>
                    <i class="dd-arrow i-Arrow-Down"></i>
                </a>
                <ul class="submenu">

                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='contact-list-table' ? 'open' : ''); ?>"
                            href="<?php echo e(route('contact-list-table')); ?>">
                            <i class="nav-icon i-Business-Mens"></i>
                            <span class="item-name">Contact Table
                                
                            </span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='contacts-lists' ? 'open' : ''); ?>"
                            href="<?php echo e(route('contacts-lists')); ?>">
                            <i class="nav-icon i-Business-Mens"></i>
                            <span class="item-name">Contact Lists</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='contacts-grid' ? 'open' : ''); ?>"
                            href="<?php echo e(route('contacts-grid')); ?>">
                            <i class="nav-icon i-Conference"></i>
                            <span class="item-name">Contact Grid</span>
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo e(Route::currentRouteName()=='contact-details' ? 'open' : ''); ?>"
                            href="<?php echo e(route('contact-details')); ?>">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Contact Details</span>
                        </a>
                    </li>



                </ul>
            </li>


        </ul>
        <ul class="childNav" data-parent="extrakits">

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='dropDown' ? 'open' : ''); ?>" href="<?php echo e(route('dropDown')); ?>">
                    <i class="nav-icon i-Arrow-Down-in-Circle"></i>
                    <span class="item-name">Dropdown</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='imageCroper' ? 'open' : ''); ?>" href="<?php echo e(route('imageCroper')); ?>">
                    <i class="nav-icon i-Crop-2"></i>
                    <span class="item-name">Image Cropper</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='loader' ? 'open' : ''); ?>" href="<?php echo e(route('loader')); ?>">
                    <i class="nav-icon i-Loading-3"></i>
                    <span class="item-name">Loaders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='laddaButton' ? 'open' : ''); ?>" href="<?php echo e(route('laddaButton')); ?>">
                    <i class="nav-icon i-Loading-2"></i>
                    <span class="item-name">Ladda Buttons</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='toastr' ? 'open' : ''); ?>" href="<?php echo e(route('toastr')); ?>">
                    <i class="nav-icon i-Bell"></i>
                    <span class="item-name">Toastr</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='sweetAlert' ? 'open' : ''); ?>" href="<?php echo e(route('sweetAlert')); ?>">
                    <i class="nav-icon i-Approved-Window"></i>
                    <span class="item-name">Sweet Alerts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='tour' ? 'open' : ''); ?>" href="<?php echo e(route('tour')); ?>">
                    <i class="nav-icon i-Plane"></i>
                    <span class="item-name">User Tour</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='upload' ? 'open' : ''); ?>" href="<?php echo e(route('upload')); ?>">
                    <i class="nav-icon i-Data-Upload"></i>
                    <span class="item-name">Upload</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="uikits">
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='alerts' ? 'open' : ''); ?>" href="<?php echo e(route('alerts')); ?>">
                    <i class="nav-icon i-Bell1"></i>
                    <span class="item-name">Alerts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='accordion' ? 'open' : ''); ?>" href="<?php echo e(route('accordion')); ?>">
                    <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                    <span class="item-name">Accordion</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='badges' ? 'open' : ''); ?>" href="<?php echo e(route('badges')); ?>">
                    <i class="nav-icon i-Medal-2"></i>
                    <span class="item-name">Badges</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='buttons' ? 'open' : ''); ?>" href="<?php echo e(route('buttons')); ?>">
                    <i class="nav-icon i-Cursor-Click"></i>
                    <span class="item-name">Buttons</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='bootstrap-tab' ? 'open' : ''); ?>"
                    href="<?php echo e(route('bootstrap-tab')); ?>">
                    <i class="nav-icon i-Cursor-Click"></i>
                    <span class="item-name">Bootstrap tab</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='cards' ? 'open' : ''); ?>" href="<?php echo e(route('cards')); ?>">
                    <i class="nav-icon i-Line-Chart-2"></i>
                    <span class="item-name">Cards</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='cards-metrics' ? 'open' : ''); ?>"
                    href="<?php echo e(route('cards-metrics')); ?>">
                    <i class="nav-icon i-ID-Card"></i>
                    <span class="item-name">Card Metrics</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='carousel' ? 'open' : ''); ?>" href="<?php echo e(route('carousel')); ?>">
                    <i class="nav-icon i-Video-Photographer"></i>
                    <span class="item-name">Carousels</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='collapsible' ? 'open' : ''); ?>" href="<?php echo e(route('collapsible')); ?>">
                    <i class="nav-icon i-Video-Photographer"></i>
                    <span class="item-name">Collapsibles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='lists' ? 'open' : ''); ?>" href="<?php echo e(route('lists')); ?>">
                    <i class="nav-icon i-Belt-3"></i>
                    <span class="item-name">Lists</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='pagination' ? 'open' : ''); ?>" href="<?php echo e(route('pagination')); ?>">
                    <i class="nav-icon i-Arrow-Next"></i>
                    <span class="item-name">Paginations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='popover' ? 'open' : ''); ?>" href="<?php echo e(route('popover')); ?>">
                    <i class="nav-icon i-Speach-Bubble-2"></i>
                    <span class="item-name">Popover</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='progressbar' ? 'open' : ''); ?>" href="<?php echo e(route('progressbar')); ?>">
                    <i class="nav-icon i-Loading"></i>
                    <span class="item-name">Progressbar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='tables' ? 'open' : ''); ?>" href="<?php echo e(route('tables')); ?>">
                    <i class="nav-icon i-File-Horizontal-Text"></i>
                    <span class="item-name">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='tabs' ? 'open' : ''); ?>" href="<?php echo e(route('tabs')); ?>">
                    <i class="nav-icon i-New-Tab"></i>
                    <span class="item-name">Tabs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='tooltip' ? 'open' : ''); ?>" href="<?php echo e(route('tooltip')); ?>">
                    <i class="nav-icon i-Speach-Bubble-8"></i>
                    <span class="item-name">Tooltip</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='typography' ? 'open' : ''); ?>" href="<?php echo e(route('typography')); ?>">
                    <i class="nav-icon i-Letter-Open"></i>
                    <span class="item-name">Typography</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='modals' ? 'open' : ''); ?>" href="<?php echo e(route('modals')); ?>">
                    <i class="nav-icon i-Duplicate-Window"></i>
                    <span class="item-name">Modals</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='NoUislider' ? 'open' : ''); ?>" href="<?php echo e(route('NoUislider')); ?>">
                    <i class="nav-icon i-Width-Window"></i>
                    <span class="item-name">Sliders</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="sessions">
            <li class="nav-item">
                <a href="<?php echo e(route('signIn')); ?>">
                    <i class="nav-icon i-Checked-User"></i>
                    <span class="item-name">Sign in</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('signUp')); ?>">
                    <i class="nav-icon i-Add-User"></i>
                    <span class="item-name">Sign up</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('forgot')); ?>">
                    <i class="nav-icon i-Find-User"></i>
                    <span class="item-name">Forgot</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="others">
            <li class="nav-item">
                <a href="<?php echo e(route('notFound')); ?>">
                    <i class="nav-icon i-Error-404-Window"></i>
                    <span class="item-name">Not Found</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='pricing-table' ? 'open' : ''); ?>"
                    href="<?php echo e(route('pricing-table')); ?>">
                    <i class="nav-icon i-Billing"></i>
                    <span class="item-name">Pricing Table <span
                            class="ml-2 badge badge-pill badge-danger">New</span></span>
                </a>
            </li>

            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='search-result' ? 'open' : ''); ?>"
                    href="<?php echo e(route('search-result')); ?>">
                    <i class="nav-icon i-File-Search"></i>
                    <span class="item-name">Search Result <span class="badge badge-pill badge-danger">New</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='user-profile' ? 'open' : ''); ?>"
                    href="<?php echo e(route('user-profile')); ?>">
                    <i class="nav-icon i-Male"></i>
                    <span class="item-name">User Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='faq' ? 'open' : ''); ?>" href="<?php echo e(route('faq')); ?>" class="open">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">faq</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(Route::currentRouteName()=='starter' ? 'open' : ''); ?>" href="<?php echo e(route('starter')); ?>"
                    class="open">
                    <i class="nav-icon i-File-Horizontal"></i>
                    <span class="item-name">Blank Page</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================--><?php /**PATH /home/megaspace/public_html/sbilife/console/resources/views/layouts/large-vertical-sidebar/sidebar.blade.php ENDPATH**/ ?>