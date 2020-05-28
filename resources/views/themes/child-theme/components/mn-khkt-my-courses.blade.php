@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    @if($users_data)
        <section class="mn-khkt-my-courses">
            <div class="container">
                @if(count($course) > 0)
                    <div class="row">
                        @foreach($course as $key=>$post)
                            <div class=" col-xs-12 col-sm-6 col-md-6 padding-mobile">
                                <div class="khoahoc-item khoahoc-top">
                                    <div class="box-img">
                                        <img src="{{ get_thumbnail_src($post) }}" alt="{{ $post->post_title }}">
                                        <span class="label-hot">HOT</span>
                                    </div>

                                    <div class="box-information">
                                        <div class="info-left">
                                            <div class="box-avatar">
                                                <img src="/component-assets/images/avatar.jpg"
                                                     alt="{{ $post->post_title }}">
                                            </div>
                                            <div class="information-author">
                                                <div class="name">Th.S Ngô Tuấn Hà</div>
                                                <ul class="rates">
                                                    <li class="fa fa-star"></li>
                                                    <li class="fa fa-star"></li>
                                                    <li class="fa fa-star"></li>
                                                    <li class="fa fa-star"></li>
                                                    <li class="fa fa-star"></li>
                                                </ul>
                                                <span class="avg-rate">4.6</span>
                                            </div>
                                        </div>
                                        <div class="info-right">
                                            <h3 class="title-kh"><a href="/khoa-hoc/{{ $post->post_name }}"
                                                                    title="{{ $post->post_title }}"><span>[VIP]</span>{{ $post->post_title }}
                                                </a></h3>
                                            <div class="price">
                                                @php
                                                    $post_price = $post->meta->where('meta_key', 'course_price')->where('post_id', $post->ID)->first();
                                                    $post_sale_price = $post->meta->where('meta_key', 'course_sale_price')->where('post_id', $post->ID)->first();
                                                @endphp
                                                @if($post_price && $post_sale_price)
                                                    @if((integer)$post_sale_price->meta_value !== 0 && (integer)$post_price->meta_value !== 0)
                                                        <ins>{{number_format($post_sale_price->meta_value, 0, '.', '.')}}
                                                            <sup>đ</sup></ins>
                                                        <del>{{number_format($post_price->meta_value, 0, '.', '.')}}
                                                            <sup>đ</sup></del>
                                                    @elseif((integer)$post_price->meta_value !== 0)
                                                        <ins>{{number_format($post_price->meta_value, 0, '.', '.')}}
                                                            <sup>đ</sup></ins>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @else
                    <div class="alert alert-primary" role="alert">
                        Bạn chưa có khóa học nào
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection