@php
    $option = new \App\Option();
    $dataInfoAddress = $option->getField('thong_tin_lien_he');
@endphp
<section class="pvtinh_khkt_footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-item">
                <div class="footer-logo">
                    <div class="logo">
                        <a href="/">
                            <img src="/component-assets/images/logo-footer.png"
                                 alt="/component-assets/images/logo-footer.png">
                        </a>
                    </div>
                    <div class="title-footer-logo">
                        <h3>DAILYTHUEGIAMINH.COM</h3>
                        <span>HOTLINE: 090 133 4444</span>
                    </div>
                    @php

                            @endphp
                </div>
                <div class="address-company">
                    @foreach($dataInfoAddress as $value)

                        <div class="address"><strong>{{$value['lien_he']['title']}}
                                : </strong>{{$value['lien_he']['content']}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="footer-item">
                <h2 class="title-footer text-uppercase">DANH MỤC</h2>
                <nav class="menu-footer">
                    <ul>
                        <?php
                        $footer_menu_1 = get_data_menu('footer_menu_1');
                        ?>
                        @foreach($footer_menu_1 as $item)
                            <li>
                                <a href="{{ $item->link }}">{{ $item->label }}</a>
                                @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
                                    <ul>
                                        @foreach ($menu->childrenMenus->sortBy('sort') as $menu_sub)
                                            @include('themes.child-theme.menu-children', ['menu' => $menu_sub])
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="footer-item">
                <h2 class="title-footer text-uppercase">ĐIỀU KHOẢN SỬ DỤNG</h2>
                <nav class="menu-footer">
                    <ul>
                        <?php
                        $footer_menu_2 = get_data_menu('footer_menu_2');
                        ?> 
                        @foreach($footer_menu_2 as $item)
                            <li>
                                <a href="{{ $item->link }}">{{ $item->label }}</a>
                                @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
                                    <ul>
                                        @foreach ($menu->childrenMenus->sortBy('sort') as $menu_sub)
                                            @include('themes.child-theme.menu-children', ['menu' => $menu_sub])
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="footer-item">
                <div class="box-fanpage">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous"
                            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
                    <div class="fb-page" data-href="https://www.facebook.com/thuegiaminh" data-tabs="timeline"
                         data-width="" data-height="190" data-small-header="false" data-adapt-container-width="true"
                         data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/thuegiaminh" class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/thuegiaminh">Đại Lý Thuế Gia Minh</a></blockquote>
                    </div>

                    <p>Theo dõi chúng tôi</p>

                    <div class="list-socials-network">
                        <ul>
                            <li><a href="#"><img src="/component-assets/images/facebook-letter-logo.png" alt=""></a>
                            </li>
                            <li><a href="#"><img src="/component-assets/images/youtube-icon.png" alt=""></a></li>
                            <li><a href="#"><img src="/component-assets/images/zalo.png" alt=""></a></li>
                            <li><a href="#"><img src="/component-assets/images/vimeo.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="pvtinh-khkt-copyright">
    <div class="container">
        <p class="text-center"><a
                    href="https://toannangcantho.com/" target="_blank">2020 © KHOA HOC KE TOAN All Rights Reserved.
                Designed by Toannangcantho.com</a></p>
    </div>
</div>