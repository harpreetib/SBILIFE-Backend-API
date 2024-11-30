<?php 
    $SAsession=Session::get('SA_Session');
    $Asession=Session::get('A_Session');
    $profileDetail=Session::get('AprofileDetail');
    //$profileDetail=Session::get('profileDetail');
    $evntDetail=Session::get('evntDetail');
    $selectedEvent=Session::get('selectedEvent');
    
    $featurelist = Session::get('featurelist');
    $ver = 'v'.rand(10000,99999);
?>
<div class="main-header">
    <div class="logo">
        <img src="{{asset('assets/images/logo.png')}}?<?=$ver?>" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="d-none align-items-center">
       
             <div class="dropdown">
                    <div  class="user col align-self-end">
                    
                    
                       <a id="eventDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="nav-icon  mr-2 i-Belt-3"></i> Choose  Fair<br>
                            
                        </a>
                        
                                       

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="eventDropdown">
                            @if(basename($_SERVER['REQUEST_URI'])=='dashboard' || basename($_SERVER['REQUEST_URI'])=='all-leads')
                                    @if($profileDetail->at_id=='1' || $profileDetail->at_id=='2' || $profileDetail->at_id=='5' || $profileDetail->at_id=='3')
                                        <a class="dropdown-item" href="changeevent/all/{{base64_encode(Request::path())}}">
                                           <span class="item-name"></span> <i class="nav-icon mr-2 i-Line-Chart-2"></i>
                                            All Locations</span>
                                        </a>
                                    @endif
                                 @endif

                        @if(isset($evntDetail))
                            @foreach($evntDetail as $key => $evntList)
                                    <a class="dropdown-item" href="changeevent/{{$evntList->aem_id}}/{{base64_encode(Request::path())}}" ><span class="item-name"> <i class="nav-icon mr-2 i-Line-Chart-2"></i>{{$evntList->aem_name}}</span></a>
                            @endforeach
                        @endif
                           
                        </div>
                        
                    </div>
                </div>
    </div>
    

    <div style="margin: auto"></div>

    <div class="header-part-right">

         <!--User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{asset('assets/images/faces/1.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> {{$profileDetail->user_name}}
                    </div>
                    <a class="dropdown-item" href="settings"><i class="i-Gear spin mr-1"></i>Account settings</a>
                    @if(!empty($featurelist) && isset($featurelist['package-subscription']) && $featurelist['package-subscription'] == 'active')
                    <a class="dropdown-item" href="mysubscription"><i class="i-Gear spin mr-1"></i>My Subscription</a>
                    @endif
                    <a class="dropdown-item" href="dashboard-settings"><i class="i-Gear spin mr-1"></i>Dashboard settings</a>
                    <a class="dropdown-item" href="manage-convai-appid"><i class="i-Gear spin mr-1"></i>Manage Convai AppId</a>
                    <a class="dropdown-item" href="manage-convai-character-id"><i class="i-Gear spin mr-1"></i>Manage Convai CharacterId</a>
                    <a class="dropdown-item d-none" href="streammaster"><i class="i-Gear spin mr-1"></i>Manage Streams</a>
                     <a class="dropdown-item" href="notifyhere"><i class="i-Gear spin mr-1"></i>Notifications</a>
                    <a class="dropdown-item" href="logout">Sign out</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- header top menu end -->