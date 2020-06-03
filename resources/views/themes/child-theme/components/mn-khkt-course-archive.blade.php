<section class="mn-khkt-course-archive">
    <div class="container">
        <h1 class="archive-title">@if(isset($term)) {{$term->name}} @else Các khoá học  @endif</h1>
        <div class="row">
            @if(sizeof($posts)>=1)
                @foreach($posts as $post)
                    <div class="col-xs-12 col-sm-6 col-md-4 padding-mobile">
                        <div class="khoahoc-item khoahoc-bottom ">
                            <div class="box-img">
                                <img src="{{ get_thumbnail_src($post) }}" alt="{{ $post->post_title }}">
                            </div>

                            <div class="box-information">
                                <h3 class="title-kh"><a href="/{{ $post->post_name }}"
                                                        title="{{ $post->post_title }}"><span>[VIP]</span>{{ $post->post_title }}
                                    </a></h3>
                                <div class="info-left">
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
                                <div class="info-right">
                                    <div class="box-avatar">
                                        <img src="/component-assets/images/avatar.jpg" alt="">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        Nội dung đang được cập nhật!
                    </div>
                </div>
            @endif
        </div>
        {{ $posts->links() }}
    </div>
</section>