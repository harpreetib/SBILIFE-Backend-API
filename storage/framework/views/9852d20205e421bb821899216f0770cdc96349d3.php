<!-- ============ Vetical SIdebar Layout start ============= -->

<div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
    <?php echo $__env->make('layouts.vertical-sidebar.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-content-wrap  mobile-menu-content bg-off-white m-0 d-flex flex-column  flex-grow-1">
        <?php echo $__env->make('layouts.vertical-sidebar.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <div class="main-content pt-4">
            <?php echo $__env->yieldContent('main-content'); ?>
        </div>

        <div class="flex-grow-1"></div>
        <?php echo $__env->make('layouts.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <div class="sidebar-overlay open"></div>
</div>




<!-- ============ Vetical SIdebar Layout End ============= --><?php /**PATH /home/ibentosroot/public_html/events/admin/resources/views/layouts/vertical-sidebar/master.blade.php ENDPATH**/ ?>