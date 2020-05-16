@if(is_page('tai-khoan'))
    @include ('themes.child-theme.components.mn-khkt-mn-khkt-my-acount')
@elseif(is_page('khoa-hoc-cua-toi'))
    @include ('themes.child-theme.components.mn-khkt-my-courses')
@endif
@extends('themes.parent-theme.initialize')
@section('content')
    {{'page'}}
@endsection 