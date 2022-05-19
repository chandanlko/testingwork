
@extends('homelayout.header')

@section('title', 'Home Page')
@section('content')

           <!-- START bannerArea -->
           <section class="bannerArea">
            <div class="bannerSlide">

                
                <div class="bannetPart" style="background-image: url({{ asset('frontend/images/banner_slide01.png') }});">
                    <div class="ovarlay">
                        <div class="container">
                            <div class="bannerContent">
                                <h2>Construction
                                    Signage</h2>
                                <p>Select from our extensive range of Powerpac Signs</p>
                                <div class="button_group">
                                    <a href="#" class="btn">Shop Now</a>                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bannetPart" style="background-image: url({{ asset('frontend/images/banner_slide01.png') }});">
                    <div class="ovarlay">
                        <div class="container">
                            <div class="bannerContent">
                                <h2>Construction
                                    Signage</h2>
                                <p>Select from our extensive range of Powerpac Signs</p>
                                <div class="button_group">
                                    <a href="#" class="btn">Shop Now</a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bannetPart" style="background-image: url({{ asset('frontend/images/banner_slide01.png') }});">
                    <div class="ovarlay">
                        <div class="container">
                            <div class="bannerContent">
                                <h2>Construction
                                    Signage</h2>
                                <p>Select from our extensive range of Powerpac Signs</p>
                                <div class="button_group">
                                    <a href="#" class="btn">Shop Now</a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            
        </section>
        <!-- END bannerArea -->

        <!-- START content_part-->
        <section id="content_part">
            
            <!-- START shopOnlineArea  -->
            <section class="shopOnlineArea">
                <div class="container">
                    <div class="itemBox disflexArea">
                        <div class="item">
                            <div class="disflexArea">
                                <div class="leftimage">
                                    <img src="{{ asset('frontend/images/subtractionsmallBg.png') }}" alt="">
                                </div>
                                <div class="rightimage">
                                    <img src="{{ asset('frontend/images/shop_img01.png') }}" alt="">
                                </div>
                            </div>
                            <div class="overlayText">
                                <div class="sub">
                                    <h3>Custom Signs</h3>
                                    <p>We have 1000’s of
                                        templates to choose from
                                        or make your own.</p>
                                    <a href="#" class="btn">Build Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="disflexArea">
                                <div class="leftimage">
                                    <img src="{{ asset('frontend/images/subtractionsmallBg.png') }}" alt="">
                                </div>
                                <div class="rightimage">
                                    <img src="{{ asset('frontend/images/shop_img02.png') }}" alt="">
                                </div>
                            </div>
                            <div class="overlayText">
                                <div class="sub">
                                    <h3>Shop Online</h3>
                                    <p>Shop a wide range of
                                        quality powerpac signs
                                        online</p>
                                    <a href="#" class="btn">Build Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="disflexArea">
                                <div class="leftimage">
                                    <img src="{{ asset('frontend/images/subtractionsmallBg.png') }}" alt="">
                                </div>
                                <div class="rightimage">
                                    <img src="{{ asset('frontend/images/shop_img03.png') }}" alt="">
                                </div>
                            </div>
                            <div class="overlayText">
                                <div class="sub">
                                    <h3>FAQ's</h3>
                                    <p>Find out more about
                                        Safety Signs products and
                                        services.</p>
                                    <a href="#" class="btn">Build Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END shopOnlineArea  -->

            <!-- start NewZealandArea -->
            <section class="newZealandArea" style="background-image: url({{ asset('frontend/./images/subtractionBigBg.png') }});">

                <!-- START ourDiscoverArea -->
                <section class="ourDiscoverArea">
                    <div class="container">
                        <div class="itemBox disflexArea">
                            <div class="subText">
                                <h3>Discover our range of custom made <br> signs and printed mesh. We offer fast and <strong>affordable shipping</strong> throughout <strong>New Zealand</strong></h3>
                                <p>Powerpac Signs is kiwi owned and operated, offering premium quality signage and printed mesh to suit the needs of a diverse range of industries. </p>
                                <p>Because we produce all of our items in-house, we control the quality and lead times, and we have a vast amount of experience across different industries, talk to us now regarding your project for free advice..</p>
                            </div>
                            <div class="contentBox disflexArea">
                                <div class="item">
                                    <img src="{{ asset('frontend/images/new_zealand_icon01.png') }}" alt="">
                                    <h3>New Zealand Manufactured</h3>
                                    <p>Quality you can trust with Australian made products from experienced sign making professionals.</p>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('frontend/images/new_zealand_icon02.png') }}" alt="">
                                    <h3>On Time, On Budget <br> And Beyond Expectations</h3>
                                    <p>We deliver what we promise — premium quality handmade signs that stand the test of time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END ourDiscoverArea -->

                <!-- START ourSignsArea -->
                <section class="ourSignsArea" style="background-image: url({{ asset('frontend/./images/signsBg.png') }});"> 
                    <div class="overlay">
                        <div class="container">
                            <div class="heading">
                                <h2>Our Signs</h2>
                            </div>
                            <div class="itemBox disflexArea">
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img01.png') }}" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img02.png') }}" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img03.png') }}" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img04.png') }}" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img05.png') }}" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('frontend/images/sings_img06.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="btnGroup">
                                <a href="#" class="btn">View all categories</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END ourSignsArea -->

                <!-- START customSignArea -->
                <section class="customSignArea">
                    <div class="container">
                        <div class="cutomBox disflexArea">
                            <div class="image">
                                <img src="{{ asset('frontend/images/custom_img.png') }}" alt="">
                            </div>
                            <div class="subText">
                                <h3>Custom Signage</h3>
                                <p>Need some help designing that sign? Use one of our free templates or upload an image and we'll create it for you. Our nerds are pretty creative, so don&#39;t worry if you can’t find exactly what you're looking for – just let them go wild and expect a master piece.</p>
                                <a href="#" class="btn">View all categories</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END customSignArea -->

            </section>
            <!-- END NewZealandArea -->

             <!-- START newslatterArea -->
             <section class="newslatterArea" style="background-image: url({ asset('./images/newlatterBg.png') }});">
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
            <section class="orderShippingArea" style="background-image: url({ asset('frontend/./images/orderBg.png') }});">
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
        <!-- end content_part-->            
@endsection