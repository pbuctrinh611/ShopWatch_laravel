@extends('user.master')
@section('title')
    Lịch sử đặt hàng
@endsection
@section('content')
    <!-- Breadcumb area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">Lịch sử đặt hàng</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="index.html">Home</a></li>
                        <li class="current"><a href="cart.html">Lịch sử đặt hàng</a></li>
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
                                            <th>Mã đơn hàng</th>
                                            <th>Địa chỉ nhận hàng</th>
                                            <th>Thời gian đặt</th>
                                            <th>Tình trạng</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Ghi chú</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody id="order-history__content">
                                     
                                        </tbody>
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
            </div>
        </div>
    </div><!-- Main content wrapper end -->

@endsection