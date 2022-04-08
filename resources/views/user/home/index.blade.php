@extends('user.master')
@section('title')
    Trang chủ
@endsection
@section('content')
    <!-- Slider area Start -->
    <div class="slider-area">
        <div class="homepage-slider">
            <div class="single-slider content-v-center"
                 style="background-image: url({{ asset('user/img/slider/slider1-mirora1-1920x634.jpg') }})">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content">
                                <h1 data-animation="fadeInDown" data-duration=".8s" data-delay=".2s">
                                  
                                </h1>
                                <p class="mb--50 mb-sm--20" data-animation="fadeInDown" data-duration=".8s" data-delay=".2s">
                                    <strong> đ</strong>
                                </p>
                                <div class="slide-btn-group" data-animation="fadeInUp" data-duration="1s" data-delay=".3s">
                                    <a href="" class="btn btn-bordered btn-style-1">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-slider content-v-center"
                 style="background-image: url({{ asset('user/img/slider/slider2-mirora1-1920x634.jpg') }})">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content">
                                <h5 data-animation="rollIn" data-duration=".8s" data-delay=".5s">Exclusive Offer-20% Off This Week</h5>
                                <h1 data-animation="fadeInDown" data-duration=".8s" data-delay=".2s">H-VaultClassico</h1>
                                <p class="mb--30 mb-sm--20" data-animation="fadeInDown" data-duration=".8s" data-delay=".2s">
                                    H-Vault Watches Are A Lot Like Classic American Muscle Cars
                                    - Expect For The American Part That Is.
                                </p>
                                <p class="mb--50 mb-sm--20" data-animation="fadeInDown" data-duration=".8s" data-delay=".2s">Starting At 
                                    <strong>$1.499.00</strong>
                                </p>
                                <div class="slide-btn-group" data-animation="fadeInUp" data-duration="1s" data-delay=".3s">
                                    <a href="" class="btn btn-bordered btn-style-1">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-slider content-v-center"
                 style="background-image: url({{ asset('user/img/slider/slider2-mirora1-1920x634.jpg') }})">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content">
                                <h5 data-animation="rollIn" data-duration=".3s" data-delay=".5s">Exclusive Offer
                                    -20% Off This Week</h5>
                                <h1 data-animation="fadeInDown" data-duration=".8s" data-delay=".3s">H-Vault
                                    Classico</h1>
                                <p class="mb--30 mb-sm--20" data-animation="fadeInDown" data-duration=".8s"
                                   data-delay=".3s">H-Vault Watches Are A Lot Like Classic American Muscle Cars
                                    - Expect For The American Part That Is.</p>
                                <p class="mb--50 mb-sm--20" data-animation="fadeInDown" data-duration=".8s"
                                   data-delay=".3s">Starting At <strong>$1.499.00</strong></p>
                                <div class="slide-btn-group" data-animation="fadeInUp" data-duration="1s"
                                     data-delay=".3s"><a href=""
                                                         class="btn btn-bordered btn-style-1">Shop Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Slider area End -->
    <!-- Products Tab area Start -->
    <div class="product-tab pt--80 pb--60 pt-md--60 pb-md--45">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="nav nav-tabs product-tab__head" id="product-tab" role="tablist">
                        <li class="product-tab__item nav-item active"><a
                                class="product-tab__link nav-link active" id="nav-featured-tab"
                                data-toggle="tab" href="#nav-featured" role="tab"
                                aria-selected="true">Hàng mới về</a></li>
                        <li class="product-tab__item nav-item"><a class="product-tab__link nav-link"
                                                                  id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab"
                                                                  aria-selected="false">Khuyến mãi</a></li>
                        <li class="product-tab__item nav-item"><a class="product-tab__link nav-link"
                                                                  id="nav-bestseller-tab" data-toggle="tab" href="#nav-bestseller" role="tab"
                                                                  aria-selected="false">Bán chạy</a></li>
                    </ul>
                    <div class="tab-content product-tab__content" id="product-tabContent">
                        <div class="tab-pane fade show active" id="nav-featured" role="tabpanel">
                            <div class="product-carousel js-product-carousel">
                               
                                    <div class="product-carousel-group">
                                        <div class="mirora-product mb-md--10">
                                            <div class="product-img"><img src=""
                                                                          alt="Product" class="primary-image" />
                                               
                                                    <img src="" alt="Product"
                                                         class="secondary-image" />
                                             
                                            </div>
                                            <div class="product-content text-center">
                                                <span></span>
                                                <h4><a href=""></a></h4>
                                                <span class="money" style="color: #a8741a; font-size: 1.8rem; font-weight: 500;">
                                                     đ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                               

                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-new" role="tabpanel">
                            <div class="product-carousel js-product-carousel">
                               
                                    <div class="product-carousel-group">
                                        <div class="mirora-product mb-md--10">
                                            <div class="product-img"><img src=""
                                                                          alt="Product" class="primary-image" />
                                              
                                                    <img src="" alt="Product"
                                                         class="secondary-image" />
                                                
                                            </div>
                                            <div class="product-content text-center">
                                                <span></span>
                                                <h4><a href=""></a></h4>
                                                <span class="money" style="color: #a8741a; font-size: 1.8rem; font-weight: 500;">
                                                     đ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-bestseller" role="tabpanel">
                            <div class="product-carousel js-product-carousel">
                               
                                <div class="product-carousel-group">
                                    <div class="mirora-product mb-md--10">
                                        <div class="product-img"><img src=""
                                                                    alt="Product" class="primary-image" />
                                         
                                                <img src="" alt="Product"
                                                    class="secondary-image" />
                                            
                                        </div>
                                        <div class="product-content text-center">
                                            <span></span>
                                            <h4><a href=""></a></h4>
                                            <span class="money" style="color: #a8741a; font-size: 1.8rem; font-weight: 500;">
                                              đ
                                            </span>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Products Tab area End -->

    <section class="blog-area pt--80 pb--40 pt-md--60 pb-md--30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title mb--30">
                        <h2>Bài viết của chúng tôi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel nav-top slick-item-gutter">
                     
                            <article class="blog">
                                <a href="" class="blog__thumb">
                                    <img src="" alt="Blog">
                                </a>
                                <div class="blog__content">
                                    <div class="blog__meta">
                                        <p class="blog__date"><a href=""></a></p>
                                    </div>
                                    <h3 class="blog__title">
                                        <a href=""></a>
                                    </h3>
                                    <div class="blog__text">
                                        <p class="intro"></p>
                                        <a class="read-more" href="">Đọc tiếp</a>
                                    </div>
                                </div>
                            </article>
                     

                    </div>
                </div>
            </div>
            <div class="row mt--35 mt-md--25">
                <div class="col-12 text-center"><a href="instagram.com" class="btn btn-medium btn-style-2"><i
                            class="fa fa-instagram"></i>Instagram</a></div>
            </div>
        </div>
    </section>

@endsection
