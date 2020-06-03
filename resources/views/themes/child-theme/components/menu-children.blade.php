<li>
    {{ $item->label }}
    @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
        <ul>
            @foreach ($menu->childrenMenus->sortBy('sort') as $menu_sub)
                @include('themes.child-theme.menu-children', ['menu' => $menu_sub])
            @endforeach
        </ul>
    @endif
</li>
