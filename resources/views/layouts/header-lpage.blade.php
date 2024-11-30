<!--HEADER-->
<header id="header">
    <div id="lgx-header" class="lgx-header">
        <div class="lgx-header-position lgx-header-position-white lgx-header-position-fixed "> <!--lgx-header-position-fixed lgx-header-position-white lgx-header-fixed-container lgx-header-fixed-container-gap lgx-header-position-white-->
            <div class="lgx-container"> <!--lgx-container-fluid-->
                <nav class="navbar navbar-default lgx-navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <div class="lgx-logo">
                            <input type="file" id="logo" class="hidden imageCropper" accept="image/*" />
                            <label for="logo" onclick="CropperWH(160,81,'uploadlogo','logoUpload','');">
                                <!--<a href="#" class="lgx-scroll">-->
                                @if(!empty($data[0]) && $data[0]->logo_image != null)
                                    <img src="{{asset($data[0]->logo_image)}}" alt="Emeet Logo"/>
                                @else
                                    <img src="{{asset('l_assets/img/logo.png')}}" alt="Emeet Logo"/>
                                @endif
                                    
                                <!--</a>-->
                            </label>    
                        </div>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <div class="lgx-nav-right navbar-right">
                            <div class="lgx-cart-area">
                                <a class="lgx-btn lgx-btn-red" href="javascript:void(0);" onclick="saveAll();">Save</a>
                            </div>
                        </div>
                        <ul class="nav navbar-nav lgx-nav navbar-right" id="">
                            <!--<li>-->
                            <!--    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>-->
                            <!--    <ul class="dropdown-menu multi-level">-->
                            <!--        <li><a href="#">Home (Default Simple)</a></li>-->
                            <!--        <li><a href="#">Box Layout</a></li>-->
                            <!--        <li><a href="#">Home Parallax</a></li>-->
                            <!--        <li><a href="#">Home Four</a></li>-->
                            <!--        <li><a href="#">Home Typed</a></li>-->
                            <!--        <li><a href="#">Home Six</a></li>-->
                            <!--        <li><a href="#">Home Seven</a></li>-->
                            <!--        <li><a href="#">Home Eight</a></li>-->
                            <!--        <li><a href="#">Home Registration</a></li>-->
                            <!--        <li><a href="#">Home Registration2</a></li>-->
                            <!--        <li><a href="#">Home Eleven</a></li>-->
                            <!--        <li><a href="#">Home Twelve</a></li>-->
                            <!--        <li><a href="#">Home Slider</a></li>-->
                            <!--        <li><a href="#">Home Slider2</a></li>-->
                            <!--        <li><a href="#">Home Music</a></li>-->
                            <!--        <li><a href="#">Home Sixteen</a></li>-->
                            <!--        <li><a href="#">Home Christmas</a></li>-->
                            <!--        <li><a href="#">Home Comingsoon</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>-->
                            <!--    <ul class="dropdown-menu multi-level">-->
                            <!--        <li><a href="#">About</a></li>-->
                            <!--        <li><a href="schedules.html">Schedule</a></li>-->
                            <!--        <li class="dropdown-submenu">-->
                            <!--            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Speakers <span class="caret"></span></a>-->
                            <!--            <ul class="dropdown-menu">-->
                            <!--                <li><a href="speakers.html">Speakers List</a></li>-->
                            <!--                <li><a href="speaker.html">Speaker Single</a></li>-->
                            <!--            </ul>-->
                            <!--        </li>-->
                            <!--        <li><a href="sponsors.html">Sponsors List</a></li>-->
                            <!--        <li><a href="registration.html">Registration</a></li>-->
                            <!--        <li><a href="gallery.html">Photo Gallery</a></li>-->
                            <!--        <li><a href="contact.html">Contact</a></li>-->
                            <!--        <li class="dropdown-submenu">-->
                            <!--            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News <span class="caret"></span></a>-->
                            <!--            <ul class="dropdown-menu">-->
                            <!--                <li><a href="news.html">News</a></li>-->
                            <!--                <li><a href="news-single.html">News Single</a></li>-->
                            <!--            </ul>-->
                            <!--        </li>-->
                            <!--        <li><a href="contact.html">Contact</a></li>-->
                            <!--        <li class="dropdown-submenu">-->
                            <!--            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
                            <!--            <ul class="dropdown-menu">-->
                            <!--                <li class="dropdown-submenu">-->
                            <!--                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown Two<span class="caret"></span></a>-->
                            <!--                    <ul class="dropdown-menu">-->
                            <!--                        <li><a href="#">Dropdown Three</a></li>-->
                            <!--                        <li><a href="#">Dropdown Three</a></li>-->
                            <!--                    </ul>-->
                            <!--                </li>-->
                            <!--                <li><a href="#">Dropdown Two</a></li>-->
                            <!--                <li><a href="#">Dropdown Two</a></li>-->
                            <!--            </ul>-->
                            <!--        </li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            <li><a class="lgx-scroll" href="#">Home</a></li>
                            <li><a class="lgx-scroll" href="#lgx-speakers">Speaker</a></li>
                            <li><a class="lgx-scroll" href="#lgx-schedule">Schedule</a></li>
                            <li><a class="lgx-scroll" href="#lgx-sponsors">Sponsors</a></li>
                            <!--<li><a class="lgx-scroll" href="#lgx-news">News</a></li>-->
                            <!--<li><a class="lgx-scroll" href="contact.html">Contact</a></li>-->
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#toggleModal">Toggle</a></li>
                            <li><a href="javascript:void(0)" onclick="openNav()">Choose Template</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </nav>
            </div>
            <!-- //.CONTAINER -->
        </div>
    </div>
</header>
<!--HEADER END-->