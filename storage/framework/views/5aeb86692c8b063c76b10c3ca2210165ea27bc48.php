<?php 
    $SAsession=Session::get('SA_Session');
    $Asession=Session::get('A_Session');
?>

<!-- ============ Large SIdebar Layout start ============= -->

<div class="app-admin-wrap layout-sidebar-large clearfix">
    
    <?php if(null==request('brand')): ?>
        <?php echo $__env->make('layouts.large-vertical-sidebar.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <!-- ============ end of header menu ============= -->
    
        <?php echo $__env->make('layouts.large-vertical-sidebar.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <!-- ============ end of left sidebar ============= -->
    
    <?php endif; ?>
    
    
    
     <?php if(null!==request('brand')): ?>
        <?php echo $__env->make('layouts.large-vertical-sidebar.admin-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <!-- ============ end of header menu ============= -->
    
        <?php echo $__env->make('layouts.large-vertical-sidebar.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- ============ end of left sidebar ============= -->
    
    <?php endif; ?>
    
    

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column flex-grow-1">

        <div class="main-content">
            <?php echo $__env->yieldContent('main-content'); ?>
        </div>

        <div class="flex-grow-1"></div>
        <?php echo $__env->make('layouts.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
<?php echo $__env->make('layouts.common.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- ============ Search UI End ============= -->




<!-- ============ Large Sidebar Layout End ============= --><?php /**PATH /home/metagraha/public_html/induction_testing/admin/resources/views/layouts/large-vertical-sidebar/master.blade.php ENDPATH**/ ?>