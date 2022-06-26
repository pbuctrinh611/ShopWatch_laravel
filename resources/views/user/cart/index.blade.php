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
                    <h1 class="page-title">Giỏ hàng</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="cart.html">Giỏ hàng</a></li>
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
                                     
                                        </tbody>
                                        @else
                                            <h3 class="text-warning">* Giỏ hàng đang trống</h3>
                                        @endif
                                    </table>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-12 text-md-right">
                                        <div class="cart-btn-group">
                                            <button type="button" class="btn btn-medium btn-style-3">Cập nhật</button>
                                        </div>
                                    </div>
                                </div> -->
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
                                                @if(session()->get('cart'))
                                                <td id="cart-total"></td>
                                                @else
                                                <td><span class="price-ammount"> đ</span></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if(Auth::check())
                                    <a href="{{route('user.checkout')}}"  class="btn btn-medium btn-style-3">Thanh toán</a>
                                @else
                                    <a href="{{route('user.show_login')}}"  class="btn btn-medium btn-style-3">Thanh toán</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main content wrapper end -->

@endsection