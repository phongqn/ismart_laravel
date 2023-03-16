@extends('layouts.guest.header')
@section('title', 'Trang chủ')
@section('content')
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach ($list_sliders as $item)
                        <div class="item">
                            <img src="{{ url($item->slider_link) }}" alt="">
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('guest/images/icon-1.png') }}">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('guest/images/icon-2.png') }}">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('guest/images/icon-3.png') }}">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('guest/images/icon-4.png') }}">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ asset('guest/images/icon-5.png') }}">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($outstanding_product as $item)
                            <li>
                                <a href="?page=detail_product" title="" class="thumb"
                                    style="display:flex; justify-content:center;">
                                    <img src="{{ url($item->product_thumb) }}" style="with:190px; height:130px;">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name"
                                    style="height: 34px; overflow:hidden ;">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">
                                        @if ($item->price_sale == 0)
                                            {{ number_format($item->original_price, 0, 0, ',') }} đ
                                        @else
                                            {{ number_format($item->price_sale, 0, 0, ',') }} đ
                                        @endif
                                    </span>
                                    <span class="old">{{ number_format($item->original_price) }}</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>

                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_phone as $item)
                            <li>
                                <a href="" title="" class="thumb"
                                    style="display:flex; justify-content:center;">
                                    <img src="{{ url($item->product_thumb) }}" style="with:190px; height:130px;">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name"
                                    style="height: 34px; overflow:hidden ;">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">
                                        @if ($item->price_sale == 0)
                                            {{ number_format($item->original_price, 0, 0, ',') }} đ
                                        @else
                                            {{ number_format($item->price_sale, 0, 0, ',') }} đ
                                        @endif
                                    </span>
                                    <span class="old">{{ number_format($item->original_price) }}</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                        @endforeach
                        </li>
                    </ul>
                </div>

            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_lap as $item)
                            <li>
                                <a href="" title="" class="thumb"
                                    style="display:flex; justify-content:center;">
                                    <img src="{{ url($item->product_thumb) }}" style="with:190px; height:130px;">
                                </a>
                                <a href="?page=detail_product" title="" class="product-name">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">
                                        @if ($item->price_sale == 0)
                                            {{ number_format($item->original_price, 0, 0, ',') }} đ
                                        @else
                                            {{ number_format($item->price_sale, 0, 0, ',') }} đ
                                        @endif
                                    </span>
                                    <span class="old">{{ number_format($item->original_price) }}</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach ($categories as $item)
                            <li>
                                <a href="?page=category_product" title="">
                                    @if ($item->parent_id == 0)
                                        {{ $item->name }}
                                    @endif
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title=""></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="?page=category_product" title="">Iphone 8 Plus</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($product_selling as $item)
                            <li class="clearfix">
                                <a href="" title="" class="thumb fl-left">
                                    <img src="{{ $item->product_thumb }}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title=""
                                        class="product-name">{{ $item->name }}</a>
                                    <div class="price">
                                        <span class="new">
                                            @if ($item->price_sale == 0)
                                                {{ number_format($item->original_price, 0, 0, ',') }} đ
                                            @else
                                                {{ number_format($item->price_sale, 0, 0, ',') }} đ
                                            @endif
                                        </span>
                                        <span class="old">{{ number_format($item->original_price) }}</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    @foreach ($list_ads as $item)
                        <a href="{{ $item->link }}" title="{{ $item->name }}" class="thumb">
                            <img src="{{ url($item->thumb) }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
