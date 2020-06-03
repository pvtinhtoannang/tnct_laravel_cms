@php
    $option = new \App\Option();
    $dataInfoAddress = $option->getField('thong_tin_lien_he');
    $ft_website_name = $option->getField('ft_website_name');
    $ft_phone_number = $option->getField('ft_phone_number');
    $ft_fanpage_url = $option->getField('ft_fanpage_url');
    $ft_social_network_facebook = $option->getField('ft_social_network_facebook');
    $ft_social_network_youtube = $option->getField('ft_social_network_youtube');
    $ft_social_network_zalo = $option->getField('ft_social_network_zalo');
    $ft_social_network_vimeo = $option->getField('ft_social_network_vimeo');

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
                        <h3>{{ $ft_website_name }}</h3>
                        <span>{{ $ft_phone_number }}</span>
                    </div>
                </div>
                <div class="address-company">
                    @if(count($dataInfoAddress)>0)
                        @foreach($dataInfoAddress as $value)
                            <div class="address"><strong>{{$value['lien_he']['title']}}
                                    : </strong>{{$value['lien_he']['content']}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="footer-item">
                <h2 class="title-footer text-uppercase">DANH MỤC</h2>
                <nav class="menu-footer">
                    <ul>
                        <?php
                        $footer_menu_1 = get_data_menu('footer_menu_1');
                        ?>
                        @if(count($footer_menu_1)>0)
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
                        @endif

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
                        @if(count($footer_menu_2)>0)
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
                        @endif
                    </ul>
                </nav>
            </div>

            <div class="footer-item">
                <div class="box-fanpage">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous"
                            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
                    <div class="fb-page" data-href="{{ $ft_fanpage_url }}" data-tabs="timeline"
                         data-width="" data-height="190" data-small-header="false" data-adapt-container-width="true"
                         data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="{{ $ft_fanpage_url }}" class="fb-xfbml-parse-ignore"><a
                                    href="{{ $ft_fanpage_url }}">Đại Lý Thuế Gia Minh</a></blockquote>
                    </div>

                    <p>Theo dõi chúng tôi</p>

                    <div class="list-socials-network">
                        <ul>
                            <li><a title="{{$ft_social_network_facebook}}" href="{{ $ft_social_network_facebook }}" target="_blank"><img src="/component-assets/images/facebook-letter-logo.png" alt="{{ $ft_social_network_facebook }}"></a>
                            </li>
                            <li><a title="{{$ft_social_network_youtube}}" href="{{ $ft_social_network_youtube }}" target="_blank"><img src="/component-assets/images/youtube-icon.png" alt="{{ $ft_social_network_youtube }}"></a></li>
                            <li><a title="{{$ft_social_network_zalo}}" href="{{ $ft_social_network_zalo }}" target="_blank"><img src="/component-assets/images/zalo.png" alt="{{ $ft_social_network_zalo }}"></a></li>
                            <li><a title="{{$ft_social_network_vimeo}}" href="{{ $ft_social_network_vimeo }}" target="_blank"><img src="/component-assets/images/vimeo.png" alt="{{ $ft_social_network_vimeo }}"></a></li>
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