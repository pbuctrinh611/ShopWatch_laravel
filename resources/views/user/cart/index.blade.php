@extends('user.master')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <!-- Breadcumb area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Cart</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="cart.html">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- Breadcumb area End -->
    <!-- Main content wrapper start -->
    <div class="main-content-wrapper">
        <div class="cart-area pt--40 pb--80 pt-md--30 pb-md--60">
            <div class="container">
                <div class="cart-wrapper bg--2 mb--80 mb-md--60">
                    <div class="row">
                        <div class="col-12">
                            <!-- Cart Area Start -->
                            <form action="#" class="form cart-form">
                                <div class="cart-table table-content table-responsive">
                                    <table class="table mb--30">
                                        <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Màu</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        @if(session()->get('cart'))
                                        <tbody id="cart-content">
                                        <?php 
                                                 $total = 0;
                                            ?>
                                            @foreach(session()->get('cart') as $key => $item)
                                            <?php 
                                                 $subtotal = $item['product_qty'] * $item['product_price'];
                                                 $total += $subtotal;
                                            ?>
                                                <tr class="row-cart">
                                                    <td>
                                                        <input type="hidden" name="id" value="{{$item['id']}}">
                                                        <a href="product-details.html">
                                                            <img src="{{asset($item['product_image'])}}" alt="product"></a>
                                                    </td>
                                                    <td class="wide-column">
                                                        <h3><a href="">{{$item['product_name']}}</a></h3>
                                                    </td>
                                                    <td class="cart-product-color"><strong>{{$item['product_color']}}</strong></td>
                                                    <td class="cart-product-price">
                                                        <strong>{{number_format($item['product_price'])}} đ</strong>
                                                    </td>
                                                    <td>
                                                        <div class="quantity"><input type="number"
                                                            class="quantity-input" name="qty" value="{{$item['product_qty']}}"
                                                            min="1"></div>
                                                    </td>
                                                    <td class="cart-product-price">
                                                        <strong>{{ number_format($item['product_price'] * $item['product_qty']) }} đ</strong>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="remove-from-cart" data-id="{{$item['id']}}"><i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                        @else
                                            <h3 class="text-warning">* Giỏ hàng đang trống</h3>
                                        @endif
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-md-right">
                                        <div class="cart-btn-group">
                                        <div class="quantity"><input type="number"
                                                                class="quantity-input" name="qty" value="2"
                                                                min="1"></div>
                                            <a href="#" class="btn btn-medium btn-style-3" id="btn-save">Cập nhật</a></div>
                                            
                                    </div>
                                </div>
                            </form><!-- Cart Area End -->
                        </div>
                    </div>
                </div>
                <div class="cart-page-total-wrapper">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="cart-page-total bg--dark-3">
                                <h2>Tổng tiền giỏ hàng</h2>
                                <div class="cart-calculator-table table-content table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="cart-total">
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><a href="#" class="btn btn-medium btn-style-3">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main content wrapper end -->

@endsection