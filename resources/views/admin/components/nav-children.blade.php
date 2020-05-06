<ol class="dd-list">
    <li class="dd-item" data-id="{{$child_menu['id']}}">
        <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>
        <span class="dd3-content"><span
                data-id="{{$child_menu['id']}}">{{$child_menu['label']}}</span>
                                                <a class="edit-button" data-id="{{$child_menu['id']}}"
                                                   data-label="{{$child_menu['label']}}" href="javascript:;"
                                                   data-link="{{$child_menu['link']}}" data-toggle="modal"
                                                   data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>
                                                <a class="del-button" href="javascript:;"
                                                   data-id="{{$child_menu['id']}}"><i
                                                        class="flaticon-delete"></i></a></span>
        @if(!empty($child_menu->childrenMenus)  && sizeof($child_menu->childrenMenus) > 0)
            <ol class="dd-list">

                @foreach($child_menu->childrenMenus as $menu_children_sub)
                    <li class="dd-item" data-id="{{$child_menu['id']}}">
                        <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>
                        <span class="dd3-content">
                            <span data-id="{{$child_menu['id']}}">{{$child_menu['label']}}</span>
                            <a class="edit-button" data-id="{{$child_menu['id']}}"
                               data-label="{{$child_menu['label']}}" href="javascript:;"
                               data-link="{{$child_menu['link']}}" data-toggle="modal"
                               data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>
                            <a class="del-button" href="javascript:;" data-id="{{$child_menu['id']}}"><i
                                    class="flaticon-delete"></i></a>
                        </span>
                    </li>
                @endforeach

            </ol>
        @endif
    </li>

</ol>

