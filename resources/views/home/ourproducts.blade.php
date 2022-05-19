
@extends('homelayout.header')

@section('title', 'Home Page')
@section('content')
<section class="innerBannerArea" style="background-image: url({{ asset('frontend/./images/productBanner.png') }});">
                <div class="overlay">
                    <div class="container">
                        <div class="subText">
                            <h2>FREE SHIPPING ON ORDERS OVER $50</h2>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="far fa-chevron-right"></i></li>
                                <li>Security Signs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            
            </section>
            <section id="content_part">
            
            <!-- START filterSecurityArea -->
            <section class="filterSecurityArea">
                <div class="container">
                    <div class="contantBox disflexArea">
                        <div class="leftSideBar">
                            <h3>Filter</h3>
                            <div class="sub">
                                <h4>Price</h4>
                                <form>
                                    <div class="form-group">
                                        <input type="checkbox" id="aluminium">
                                        <label for="aluminium">Aluminium</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="colorbond">
                                        <label for="colorbond">Colorbond</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="decal">
                                        <label for="decal">Decal</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="poly">
                                        <label for="poly">Hi Impact Poly</label>
                                    </div>                                    
                                </form>

                                <h4>Pack Size</h4>
                                <form>
                                    <div class="form-group">
                                        <input type="checkbox" id="text1">
                                        <label for="text1">1</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="text2">
                                        <label for="text2">5</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="text3">
                                        <label for="text3">10</label>
                                    </div>
                                                                       
                                </form>
                            </div>
                            <div class="sub">
                                <h4>Price</h4>
                               <ul>
                                   <li><a href="#">Asbestos Signs</a></li>
                                   <li><a href="#">Construction Signs &amp; Site Safety Signs</a></li>
                                   <li><a href="#">Danger Signs</a></li>
                                   <li><a href="#">Disabled Signs</a></li>
                                   <li><a href="#">Emergency Signs &amp; Exit Signs</a></li>
                                   <li><a href="#">Fire Safety Signs</a></li>
                                   <li><a href="#">Hazard Signs &amp; Warning Signs</a></li>
                                   <li><a href="#">Hazchem Signs: Hazard Signs</a></li>
                                   <li><a href="#">Industrial Signs</a></li>
                                   <li><a href="#">Lights &amp; Delineators</a></li>
                                   <li><a href="#">Mandatory Signs</a></li>
                                   <li><a href="#">Mining Signs</a></li>
                                   <li><a href="#">No Smoking Signs</a></li>
                                   <li><a href="#">Notice Signs</a></li>
                                   <li><a href="#">Nursing &amp; Nursing Home Signs</a></li>
                                   <li><a href="#">OHS Signs</a></li>
                                   <li><a href="#">OHS Signs &amp; Signage</a></li>
                                   <li><a href="#">Parking Signs</a></li>
                                   <li><a href="#">Prohibition Signs</a></li>
                                   <li><a href="#">Quality Signs</a></li>
                                   <li><a href="#">Recycling Signs</a></li>
                                   <li><a href="#">Reflective Tape &amp; Safety Tape</a></li>
                                   <li><a href="#">Restricted Area Signs</a></li>
                                   <li><a href="#">Road Safety Signs</a></li>
                                   <li><a href="#">Safety First Signs</a></li>
                                   <li><a href="#">Security Signs</a></li>
                                   <li><a href="#">Traffic Signs</a></li>
                               </ul>
                            </div>
                        </div>
                        <div class="rightContane">
                            <div class="subText disflexArea">
                                <h3>Security Signs</h3>
                                <div class="sortBy">
                                   <form>
                                        <select name="" id="" class="selectBox">
                                            <option value="">Display: 20 per page</option>
                                            <option value="">01</option>
                                            <option value="">02</option>                                
                                        </select>
                                        <select name="" id="" class="selectBox">
                                            <option value="">Sort by: Best selling</option>
                                            <option value="">01</option>
                                            <option value="">02</option>                                
                                        </select>
                                   </form>
                                   <ul>
                                       <li><a href="#">View</a></li>
                                       <li><a href="#"><img src="{{ asset('frontend/images/union_icon01.png') }}" alt=""></a></li>
                                       <li><a href="#"><img src="{{ asset('frontend/images/union_icon02.png') }}" alt=""></a></li>
                                   </ul>
                                </div>
                            </div>
                            <div class="securityBox disflexArea">
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img01.png') }}" alt=""></a>
                                    <h3><a href="#">SURVEILLANCE CAMERAS IN USE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img02.png')}}" alt=""></a>
                                    <h3><a href="#">ALL VISITORS MUST  REGISTER AT OFFICE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img03.png') }}" alt=""></a>
                                    <h3><a href="#">VIDEO SURVEILLANCE IN USE ON THESE PREMISES</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                   <a href="#"> <img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ONLY AUTHORISED PERSONS TO ENTER THIS SITE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img01.png') }}" alt=""></a>
                                    <h3><a href="#">SURVEILLANCE CAMERAS IN USE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ALL VISITORS MUST  REGISTER AT OFFICE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img03.png') }}" alt=""></a>
                                    <h3><a href="#">VIDEO SURVEILLANCE IN USE ON THESE PREMISES</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                   <a href="#"> <img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ONLY AUTHORISED PERSONS TO ENTER THIS SITE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img01.png') }}" alt=""></a>
                                    <h3><a href="#">SURVEILLANCE CAMERAS IN USE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ALL VISITORS MUST  REGISTER AT OFFICE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img03.png') }}" alt=""></a>
                                    <h3><a href="#">VIDEO SURVEILLANCE IN USE ON THESE PREMISES</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                   <a href="#"> <img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ONLY AUTHORISED PERSONS TO ENTER THIS SITE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img01.png') }}" alt=""></a>
                                    <h3><a href="#">SURVEILLANCE CAMERAS IN USE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ALL VISITORS MUST  REGISTER AT OFFICE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img03.png') }}" alt=""></a>
                                    <h3><a href="#">VIDEO SURVEILLANCE IN USE ON THESE PREMISES</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                   <a href="#"> <img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ONLY AUTHORISED PERSONS TO ENTER THIS SITE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img01.png') }}" alt=""></a>
                                    <h3><a href="#">SURVEILLANCE CAMERAS IN USE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ALL VISITORS MUST  REGISTER AT OFFICE</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/security_img03.png') }}" alt=""></a>
                                    <h3><a href="#">VIDEO SURVEILLANCE IN USE ON THESE PREMISES</a></h3>
                                    <span>From $13</span>
                                </div>
                                <div class="item">
                                   <a href="#"> <img src="{{ asset('frontend/images/security_img02.png') }}" alt=""></a>
                                    <h3><a href="#">ONLY AUTHORISED PERSONS TO ENTER THIS SITE</a></h3>
                                    <span>From $13</span>
                                </div>
                            </div>

                            <div class="paginationArea">
                                <ul>
                                    <li><a href="#"><i class="far fa-chevron-left"></i></a></li>
                                    <li><span>Page 1 of 13</span></li>
                                    <li><a href="#"><i class="far fa-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- END filterSecurityArea -->

             <!-- START newslatterArea -->
             <section class="newslatterArea" style="background-image: url({{ asset('frontend/./images/newlatterBg.png') }});">
                <div class="overlay">
                    <div class="container">
                        <div class="latterBox disflexArea">
                            <div class="text">
                                <h3>Signs and Mesh made by kiwis for kiwis. Quality that is affordable and fast turn arounds. Shop online today!</h3>                                
                            </div>
                            <div class="rightForm">
                                <h3>Newsletter Subscribe</h3>
                            <form>
                                <input type="text" placeholder="Email Address">
                                <button type="submit" class="btn">Subscribe</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END newslatterArea -->

            <!-- START orderShippingArea -->
            <section class="orderShippingArea" style="background-image: url({{ asset('frontend/./images/orderBg.png') }});">
                <div class="container">
                    <div class="itemBox disflexArea">
                        <div class="item">
                            <img src="{{ asset('frontend/images/order_icon01.png') }}" alt="">
                            <h3>Free shipping on <br> orders over $50</h3>
                        </div>
                        <div class="item">
                            <img src="{{ asset('frontend/images/order_icon02.png') }}" alt="">
                            <h3>Custom-made <br> safety signs</h3>
                        </div>
                        <div class="item">
                            <img src="{{ asset('frontend/images/order_icon03.png') }}" alt="">
                            <h3>New Zealand <br> made</h3>
                        </div>
                        <div class="item">
                            <img src="{{ asset('frontend/images/order_icon04.png') }}" alt="">
                            <h3>Secure payment</h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END orderShippingArea -->
            
        </section>

@endsection