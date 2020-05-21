<section class="mn-khkt-course">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card-wrapper">
                    <h1 class="course-name">{{$post->post_title}}</h1>
                    <div class="course-description">Hướng dẫn bán hàng qua kênh thương mại điện tử</div>
                </div>
                <div class="card-wrapper entry-content">
                    {!! $post->post_content !!}
                </div>
                @if($builder !== null)
                    <div class="card-wrapper lesson-container">
                        <div class="card-title">Giáo trình</div>
                        <div class="chapter-container">
                            <div id="chapter-accordion">
                                @foreach($builder as $i => $section)
                                    <div class="chapter-wrapper">
                                        <div class="section-heading" id="section-heading-{{$i}}" data-toggle="collapse"
                                             data-target="#collapse-{{$i}}" aria-expanded="true"
                                             aria-controls="collapse-{{$i}}">
                                            <h5 class="section-heading-text">
                                            <span>
                                                {{$section['post_title']}}
                                            </span>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{$i}}" class="collapse @if($i === 0) show @endif"
                                             aria-labelledby="heading-{{$i}}"
                                             data-parent="#chapter-accordion">
                                            <ul class="lesson-list">
                                                @if(!is_null($section['lessons']) && !empty($section['lessons']))
                                                    @foreach($section['lessons'] as $x => $lesson)
                                                        <li class="lesson-item">
                                                            <span>{{$lesson['post_title']}}</span>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card-wrapper sidebar-area sidebar-sticky">
                    <div class="course-featured-image">
                        @if($post->thumbnail)
                            <img src="{{get_thumbnail_src($post)}}" alt="{{$post->post_title}}">
                        @endif
                    </div>
                    <div class="checkout-course-detail">
                        @if($post->sale_price && $post->price)
                            @if((integer)$post->sale_price->meta_value !== 0 && (integer)$post->price->meta_value !== 0)
                                <div class="old-price">{{number_format($post->price->meta_value, 0, '.', '.')}}₫</div>
                                <div class="price">{{number_format($post->sale_price->meta_value, 0, '.', '.')}} ₫</div>
                            @elseif((integer)$post->price->meta_value !== 0)
                                <div class="price">{{number_format($post->price->meta_value, 0, '.', '.')}} ₫</div>
                            @endif
                        @endif
                    </div>
                    <div class="course-add-form">
                        <form action="{{route('ADD_TO_CART')}}" method="post">
                            <input type="hidden" name="course" value="{{$post->ID}}">
                            <input type="hidden" name="course_name" value="{{$post->post_title}}">
                            @if($post->sale_price && $post->price)
                                @if((integer)$post->sale_price->meta_value !== 0 && (integer)$post->price->meta_value !== 0)
                                    <input type="hidden" name="price" value="{{$post->sale_price->meta_value}}">
                                @elseif((integer)$post->price->meta_value !== 0)
                                    <input type="hidden" name="price" value="{{$post->price->meta_value}}">
                                @endif
                            @endif
                            <button type="submit" id="buy-now" class="buy-now-button">Mua ngay</button>
                            <div class="btn-wrapper">
                                <a href="javascript:;" class="cart-btn" id="add-to-cart">Thêm giỏ hàng</a>
                                <a href="" class="student-ask-support-label cart-btn">Tôi cần tư vấn</a>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
