@foreach ($taxonomy->parent_id($parent)->category()->get() as $childTerm)
    <ul class="children">
        <li>
            <label class="kt-checkbox">
                <input name="post_category[]" type="checkbox"
                       value="{{$childTerm->term_id}}" @if(in_array($childTerm->term_id, $cats)) {{'checked'}} @endif> {{$childTerm->term->name}}
                <span></span>
            </label>
            @if($childTerm->term_id != 0)
                @include('admin.components.category-children', ['parent' => $childTerm->term_id])
            @endif
        </li>
    </ul>
@endforeach
