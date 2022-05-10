@extends('user.master')
@section('title')
Sản phẩm
@endsection
@section('content')
<div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-2 mb-md--30">
                <div class="shop-product-wrap row no-gutters grid gridview-3">
                   
                </div><!-- Main Shop wrapper End -->
                <!-- Pagination Start -->

            </div>
            <div class="col-lg-3 order-lg-1">
                <aside class="shop-sidebar">
                    <div class="search-filter">
                        <div class="filter-categories">
                            <h3 class="filter-heading">Danh mục</h3>
                            <ul class="filter-list">
                                @foreach($categories as $key => $item)
                                <li>
                                    <div class="filter-input filter-checkbox filter-category">
                                        <input type="checkbox" name="category_checkbox[]" id="category_checkbox" value="{{$item->id}}">
                                        <label for="category_checkbox">{{$item->name}}</label>
                                    </div>
                                </li>
                                @endforeach 
                            </ul>
                        </div>
                        <div class="filter-brand">
                            <h3 class="filter-heading">Thương hiệu</h3>
                            <ul class="filter-list">
                                @foreach($brands as $key => $item)
                                <li>
                                    <div class="filter-input filter-checkbox">
                                        <input type="checkbox" name="ferragamo" id="ferragamo">
                                        <label for="ferragamo">{{$item->name}}</label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter-color">
                            <h3 class="filter-heading">Màu sắc</h3>
                            <ul class="filter-list">
                                @foreach($colors as $key => $item)
                                <li>
                                    <div class="filter-input filter-checkbox">
                                        <input type="checkbox" name="category1" id="category1">
                                        <label for="category1">{{$item->name}}</label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection