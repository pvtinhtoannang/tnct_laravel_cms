@if(is_page('tai-khoan'))
    @include ('themes.child-theme.components.mn-khkt-mn-khkt-my-acount')
@elseif(is_page('khoa-hoc-cua-toi'))
    @include ('themes.child-theme.components.mn-khkt-my-courses')
@elseif(is_page('mat-khau-moi'))
    @include ('themes.child-theme.components.mat-khau-moi')
@else
    @include ('themes.child-theme.components.mn-khkt-single')
@endif
