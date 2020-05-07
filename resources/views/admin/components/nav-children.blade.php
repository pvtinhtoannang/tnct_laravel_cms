
<li class="dd-item" data-id="{{$menu['id']}}">
    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>
    <span class="dd3-content">
                    <span data-id="{{$menu['id']}}">{{$menu['label']}}</span>
                    <a class="edit-button" data-id="{{$menu['id']}}"
                       data-label="{{$menu['label']}}" href="javascript:;"
                       data-link="{{$menu['link']}}" data-toggle="modal"
                       data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>
                    <a class="del-button" href="javascript:;" data-id="{{$menu['id']}}"><i
                            class="flaticon-delete"></i></a>
                </span>
    @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
        <ol class="dd-list">
            @foreach ($menu->childrenMenus as $menu_sub)
                @include('admin.components.nav-children', ['menu' => $menu_sub])
            @endforeach
        </ol>
    @endif
</li>
