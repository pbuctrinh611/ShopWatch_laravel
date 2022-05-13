@extends('user.master')
@section('title')
    Chi tiết sản phẩm
@endsection
@section('content')
<div class="single-products-area section-padding section-md-padding">
    <div class="container">
        <!-- Single Product Start -->
        <input type="hidden" value="" class="product_id" name="product_id">
        <section class="mirora-single-product pb--80 pb-md--60">
        <div class="row">
                <div class="col-lg-6">
                    <!-- Tab Content Start -->
                    <div class="tab-content product-details-thumb-large" id="myTabContent-3">
                        <div class="tab-pane fade show active" id="thumb-1">
                            <div class="product-details-img easyzoom">
                                <a class="popup-btn" href="">
                                    <img src="{{asset($product->image)}}" alt="product">
                                </a>
                            </div>
                        </div>
                    </div><!-- Tab Content End -->
                </div>
                <div class="col-lg-6">
                    <!-- Single Product Content Start -->
                    <div class="product-details-content">
                        <div class="product-details-top">
                            <h2 class="product-details-name">{{$product->name}}</h2>
                            <ul class="product-details-list list-unstyled">
                                @foreach($brands as $item_brand)
                                    @if($item_brand->id == $product->id_brand)
                                        <li>Thương hiệu: <a href="">{{ $item_brand->name }}</a></li>
                                    @endif
                                @endforeach
                                <li>Chống nước: {{$product->is_waterproof}}</li>
                                <li>Chất liệu kính: {{$product->glasses}}</li>
                                <li>Chất liệu dây đeo: {{$product->strap}}</li>
                                <li>Chất liệu vỏ đồng hồ: {{$product->watch_case}}</li>
                            </ul>
                            <div class="product-details-price-wrapper">
                                <span class="money" id="product-price">   
                                    {{ number_format($product->price) }} đ</span></span>
                            </div>
                            <div class="mt-3">
                                <label>Màu sắc</label>
                                <select name="id_color" id="id_color" class="product-color" form="product-cart">
                                @foreach ($product->colors as $item)
                                    <option value="{{$item->id_color}}" data-qty="{{ $item->qty }}">{{$item->color->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="product-details-bottom">
                            <p class="product-details-availability"><i class="fa fa-check-circle"></i>
                                Số lượng còn: <span id="product_qty"></span>
                            </p>
                            <div class="product-details-action-wrapper mb--20">
                                <form action="" method="post" id="product-cart">
                                    @csrf
                                    <div class="product-details-action-top d-flex align-items-center mb--20">
                                        <div class="quantity" style="width: 20rem"><span>Số lượng đặt:</span>
                                            <input type="number" class="quantity-input" name="qty" id="pro_qty" value="1" min="1">
                                        </div>
                                        <button class="btn btn-medium btn-style-2 add-to-cart">Chọn mua</button>
                                    </div>
                            </div>
                            </form>
                            <p class="product-details-tags">Tags:
                            @foreach($categories as $item_category)
                                        @if($item_category->id == $product->id_category)
                                            <a href="#">{{$item_category->name}}</a>
                                        @endif
                                    @endforeach
                            </p>
                            <div class="social-share">
                                <a href="facebook.com" class="facebook share-button">
                                    <i class="fa fa-facebook"></i><span>Like</span>
                                </a>
                                <a href="twitter.com" class="twitter share-button">
                                    <i class="fa fa-twitter"></i><span>Tweet</span>
                                </a>
                                <a href="#" class="share share-button">
                                    <i class="fa fa-plus-square"></i><span>Share</span>
                                </a>
                            </div>
                        </div>
                    </div><!-- Single Product Content End -->
                </div>
        </div>
        </section>

        <section class="product-details-tab bg--dark-4 ptb--80 ptb-md--60">
            <div class="row">
                <div class="col-12">
                    <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                        <li class="nav-item product-details-tab-item"><a class="nav-link product-details-tab-link active" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">Thông tin sản phẩm</a></li>
                    </ul>
                    <div class="product-details-tab-content tab-content">
                        <div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
                            <p class="product-details-description">{!!$product->description!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection