<?php 
    $SAsession=Session::get('SA_Session');
    $Asession=Session::get('A_Session');
    $profileDetail=Session::get('profileDetail');
    
    $uType=Session::get('u_type');
    
?>

<!-- ============ Large SIdebar Layout start ============= -->

<div class="app-admin-wrap layout-sidebar-large clearfix">
    
    @if(null==request('brand'))
        @include('layouts.large-vertical-sidebar.header')
    
        <!-- ============ end of header menu ============= -->
    
        @include('layouts.large-vertical-sidebar.sidebar')
    
        <!-- ============ end of left sidebar ============= -->
    
    @endif
    
    
    
     @if(null!==request('brand') && $uType==null)
     
        @include('layouts.large-vertical-sidebar.admin-header')
    
        <!-- ============ end of header menu ============= -->
    
        @include('layouts.large-vertical-sidebar.admin-sidebar')

        <!-- ============ end of left sidebar ============= -->
    
    @endif
    
    @if(null!==request('brand') && $uType!=null)
     
        @include('layouts.large-vertical-sidebar.exhibitor-header')
    
        <!-- ============ end of header menu ============= -->
    
        @include('layouts.large-vertical-sidebar.exhibitor-sidebar')

        <!-- ============ end of left sidebar ============= -->
    
    @endif
    
    
    
    

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column flex-grow-1">

        <div class="main-content">
            @yield('main-content')
        </div>

        <div class="flex-grow-1"></div>
        @include('layouts.common.footer')
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
@include('layouts.common.search')
<!-- ============ Search UI End ============= -->




<!-- ============ Large Sidebar Layout End ============= -->