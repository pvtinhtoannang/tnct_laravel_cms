<li class="dd-item" data-id="{{$child_menu['id']}}">
    <span class="dd-handle"><i class="fa fa-list"></i></span>
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
