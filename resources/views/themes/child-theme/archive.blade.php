@if(is_tax('course_cat'))
    @include ('themes.child-theme.components.mn-khkt-course-archive')
@else
    @include ('themes.child-theme.components.mn-khkt-archive')
@endif