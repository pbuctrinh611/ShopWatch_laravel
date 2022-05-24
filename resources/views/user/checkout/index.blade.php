@extends('user.master')
@section('title')
    Thanh toán
@endsection
@section('content')
    <div class="checkout-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="user-actions">
                        <div class="row">
                            <div class="col-12">
                                <div class="user-actions__single user-actions__coupon">
                                    <h3>
                                        <i class="fa fa-cube"></i>Bạn có mã giảm giá?
                                        <span class="expand_action" data-attr="#coupon_info">Kích vào đây để nhập mã</span>
                                    </h3>
                                    <div id="coupon_info" class="user-actions__form user-actions--coupon hide-in-default">
                                        <form action="#" class="form">
                                            <div class="form__group d-flex">
                                                <input type="text" name="coupon" id="coupon" class="form__input form__input--2 form__input--w285 mr--20"
                                                placeholder="Coupon Code">
                                                <button type="submit" class="btn btn-medium btn-style-3">Áp dụng mã</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="checkout-wrapper bg--2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout-title">
                                    <h2>Thông tin vận chuyển</h2>
                                </div>
                                <div class="checkout-form">
                                    <form action="#" class="form">
                                        <div class="form-row mb--30">
                                            <div class="form__group col-12">
                                                <label for="billing_fname" class="form__label">Họ tên<span>*</span></label>
                                                <input type="text" name="billing_fname" id="billing_fname" class="form__input form__input--2">
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="form__group col-12">
                                                <label for="billing_streetAddress" class="form__label">Địa chỉ</label>
                                                <input type="text" name="billing_streetAddress" id="billing_streetAddress" class="form__input form__input--2">
                                            </div>
                                        </div>
                                        <div class="form-row mb--30">
                                            <div class="form__group col-md-6 mb-sm--30">
                                                <label for="billing_phone" class="form__label">Số điện thoại</label>
                                                <input type="text" name="billing_phone" id="billing_phone" class="form__input form__input--2">
                                            </div>
                                            <div class="form__group col-md-6">
                                                <label for="billing_email" class="form__label">Email
                                                    <span>*</span>
                                                </label>
                                                <input type="email" name="billing_email" id="billing_email" class="form__input form__input--2">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form__group col-12">
                                                <label for="orderNotes" class="form__label">Ghi chú</label>
                                                <textarea class="form__input form__input--2 form__input--textarea" id="orderNotes" name="orderNotes"
                                                placeholder="Notes about your order, e.g. special notes for delivery.">
                                                </textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-md--30">
                                <div class="order-details">
                                    <h3 class="heading-tertiary">Đơn hàng của bạn</h3>
                                    <div class="order-table table-content table-responsive mb--30">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody class="checkout-content">
                                               
                                            </tbody>
                                            <tfoot class="checkout-money">
                                               
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="checkout-payment">
                                        <form action="#" class="payment-form">
                                            <div class="payment-group">
                                                <div class="custom-radio payment-radio">
                                                    <input type="radio" name="payment-method" id="cash">
                                                    <label class="payment-label" for="cash">Thanh toán khi giao hàng</label>
                                                </div>
                                                <div class="payment-info">
                                                    <p>Thanh toán bằng tiền mặt khi giao hàng.</p>
                                                </div>
                                            </div>
                                            <div class="payment-group">
                                                <div class="custom-radio payment-radio">
                                                    <input type="radio" value="paypal" name="payment-method" id="paypal">
                                                    <label class="payment-label" for="paypal"> Paypal<img
                                                            src="user/img/others/AM_mc_vs_ms_ae_UK.png"
                                                            alt="payment"><a
                                                            href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">Pay   pal là gì?</a>
                                                    </label>
                                                </div>
                                                <div class="payment-info paypal">
                                                    <p>Thanh toán bằng paypal</p>
                                                </div>
                                             
                                            </div>
                                            <hr style="background-color:aliceblue;">
                                            <div class="payment-btn-group d-flex justify-content-center">
                                                <button type="submit" class="btn btn-style-3 mt-2 btn-order">Đặt hàng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
