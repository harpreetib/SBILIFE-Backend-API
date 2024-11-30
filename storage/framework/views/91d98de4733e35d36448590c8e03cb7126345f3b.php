<div class="main-header">
    <div class="logo">
        <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="d-flex align-items-center"></div>

    <div style="margin: auto"></div>

    <div class="header-part-right">

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="<?php echo e(asset('assets/images/faces/1.jpg')); ?>" id="userDropdown" alt="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> Timothy Carlson
                    </div>
                    <!--<a class="dropdown-item">Account settings</a>-->
                    <!--<a class="dropdown-item">Billing history</a>-->
                    <a class="dropdown-item" href="<?php echo e(route('manage-stream')); ?>">Manage Events</a>
                    <a class="dropdown-item" href="<?php echo e(route('packages')); ?>">Manage Packages</a>
                    <a class="dropdown-item" href="<?php echo e(route('manage-app-setting')); ?>">Manage App Setting</a>
                    <a class="dropdown-item" href="<?php echo e(route('manage-feature')); ?>">Manage Features</a>
                    <a class="dropdown-item" href="<?php echo e(route('manage-gesture')); ?>">Manage Gestures</a>
                    <a class="dropdown-item" href="<?php echo e(route('manage-activity')); ?>">Manage Activities</a>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Sign out</a>
                </div>
            </div>
        </div>
    </div>
  

</div>
<!-- header top menu end --><?php /**PATH /home/megaspace/public_html/sbilife/admin/resources/views/layouts/large-vertical-sidebar/header.blade.php ENDPATH**/ ?>