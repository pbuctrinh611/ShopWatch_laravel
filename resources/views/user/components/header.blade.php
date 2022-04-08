<!-- Header Area Start -->
<header class="header headery-style-1">
    <div class="header-middle header-top-1">
        <div class="container">
            <div class="row no-gutters align-items-center justify-content-between">
                <div>
                    <a href="{{route('user.index')}}" class="logo-box mb-md--30">
                        <img src="{{ asset('user/img/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div>
                    <div class="header-toolbar">
                        <div class="search-form-wrapper search-hide">
                            <form action="" class="search-form">
                                <input type="text" name="q" id="search" class="search-form__input" 
                                placeholder="Tên sản phẩm.." style="width: initial">
                                <button type="submit" class="search-form__submit"><i class="icon_search"></i></button>
                            </form>
                        </div>
                        <ul class="header-toolbar-icons">
                            <li class="search-box">
                                <a href="#" class="bordered-icon search-btn" aria-expanded="false">
                                    <i class="icon_search"></i>
                                </a>
                            </li>
                            <li class="mini-cart-icon">
                                <div class="mini-cart mini-cart--1">
                                    <a class="mini-cart__dropdown-toggle bordered-icon" id="cartDropdown">
                                        <span class="mini-cart__count"></span><i class="icon_cart_alt mini-cart__icon"></i>
                                    </a>
                                    <div class="mini-cart__dropdown-menu">
                                        <div class="mini-cart__content" id="miniCart">
                                            <div class="mini-cart__item">
                                                <div class="mini-cart__item--single">
                                                    <div class="mini-cart__item--image">
                                                        <img src="" alt="product">
                                                    </div>
                                                    <div class="mini-cart__item--content">
                                                        <h4 class="mini-cart__item--name">
                                                            <a href=""></a>
                                                        </h4>
                                                        <p class="mini-cart__item--quantity"></p>
                                                        <p class="mini-cart__item--price">đ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mini-cart__calculation">
                                                <p>
                                                    <span class="mini-cart__calculation--item">Tổng tiền:</span>
                                                    <span class="mini-cart__calculation--ammount">đ</span>
                                                </p>
                                            </div>
                                            <div class="mini-cart__btn">
                                                <a href="" class="btn btn-fullwidth btn-style-1">Đến giỏ hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="user-info header-top-nav__item d-flex align-items-center">
                            @if(!Auth::check())
                                <div class="dropdown header-top__dropdown">
                                    <a class="dropdown-toggle" id="userID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                         Tài khoản<i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userID">
                                        <a class="dropdown-item" href="#">Đăng ký</a>
                                        <a class="dropdown-item" href="{{route('user.login')}}">Đăng nhập</a>
                                    </div>
                                </div>
                            @else
                            <div class="dropdown header-top__dropdown"><a class="dropdown-toggle" id="userID"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}  <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu" aria-labelledby="userID">
                                    <a class="dropdown-item" href="">Thay đổi mật khẩu</a>
                                    <a class="dropdown-item" href="">Cập nhật thông tin</a>
                                    <a class="dropdown-item" href="{{route('user.logout')}}">Đăng xuất</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-top-1 position-relative navigation-wrap fixed-header">
        <div class="container position-static">
            <div class="row">
                <div class="col-12 position-static text-center">
                    <nav class="main-navigation">
                        <ul class="mainmenu">
                            <li class="mainmenu__item">
                                <a href="{{route('user.index')}}" class="mainmenu__link">Trang chủ</a>
                            </li>
                            <li class="mainmenu__item">
                                <a href="" class="mainmenu__link">Sản phẩm</a>
                            </li>
                            <li class="mainmenu__item">
                                <a href="" class="mainmenu__link">Bài viết</a>
                            </li>
                            <li class="mainmenu__item menu-item-has-children has-children">
                                <a href="#" class="mainmenu__link">Trang</a>
                                <ul class="sub-menu">
                                    <li><a href="">Giỏ hàng</a></li>
                                    <li><a href="">Thanh toán</a></li>
                                </ul>
                            </li>
                            <li class="mainmenu__item">
                                <a href="#" class="mainmenu__link">Liên hệ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header><!-- Header Area End -->
