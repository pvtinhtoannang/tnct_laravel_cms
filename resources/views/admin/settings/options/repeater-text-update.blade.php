<style>
    .repeater_update_parent {
        border: 1px solid #CCC;
        padding: 10px 15px 10px 30px;
        margin-bottom: 30px;
    }

    .repeater_update_parent .repeater-list-input{
        border-top: 1px solid;
        border-bottom: 1px solid;
    }
    .repeater-list-group {
        padding: 10px 15px;
        margin-bottom: 15px;
    }
</style>
<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--collapsed custom_kt-portlet" data-ktportlet="true" id="{{ $option['option_name'] }}">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ $option['option_label'] }}
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-group">
                <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-portlet__content">

            <div class="repeater_update_parent">
                <div class="append-repeater_list_parent">

                    <div class="alert alert-primary" role="alert">
                        <div class="alert-text">{{ $option['option_label'] }} <code>{{ $option['option_name'] }}</code></div>
                        <input type="hidden" class="" name="option[{{$indexOption}}][{{ $option['option_name'] }}]"
                               value="{{ $option['option_name'] }}">

                    </div>
                    <div class="repeater-list-group repeater-list-group-repeater-text-update">
                        @php
                            $value_option = json_decode($option['option_value']);
                            $label = '';
                            $name = '';
                        @endphp


                        @foreach($value_option as $index => $column)
                            @php
                                $label = $column->label;
                                $name = $column->name;
                            @endphp
                            <div class="repeater-list-input @if($index == 0) repeater-list-input-0 @endif">
                                <div class="alert-text">{{ $column->label }}  <a href="javascript:;" class="kt-font-danger delete-item-repeate-update">Xoá group này</a></div>
                                <div class="d-none">
                                    <input type="text" class="input-label-parent-repeater"
                                           data-option-name="{{ $option['option_name'] }}"
                                           name="option[{{$indexOption}}][{{ $option['option_name'] }}][{{$index}}][label]"
                                           value="{{ $label }}">
                                    <input type="text" class="input-name-parent-repeater"
                                           data-option-name="{{ $option['option_name'] }}"
                                           name="option[{{$indexOption}}][{{ $option['option_name'] }}][{{$index}}][name]"
                                           value="{{ $name }}">
                                </div>

                                @php $i =0; @endphp

                                @foreach($column->column as $key=>$item)
                                    <div class="form-group row align-items-center repeater-item-text repeater-item-text-update repeater-item-text-{{$i}}">

                                        <div class="d-none">
                                            <div class="col-md-5">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>{{ $column->label }} - hidden input sau khi code xong</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input type="text"
                                                               class="form-control reset-input input-label-repeater-text"
                                                               data-name="{{  $option['option_name'] }}"
                                                               name="option[{{$indexOption}}][{{ $option['option_name'] }}][{{$index}}][column][{{$i}}][repeater_label]"
                                                               placeholder="" value="{{ $item->repeater_label }}">
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>{{ $item->repeater_slug }} - hidden input sau khi code xong</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input type="text" class="form-control reset-input input-slug-repeater-text"
                                                               data-name="{{  $option['option_name'] }}"
                                                               name="option[{{$indexOption}}][{{ $option['option_name'] }}][{{$index}}][column][{{$i}}][repeater_slug]"
                                                               placeholder="" value="{{ $item->repeater_slug }}">
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Giá trị: <code>{{ $item->repeater_label }}</code> || <code><span>Vui lòng điền đầy đủ thông tin, không được bỏ trống!</span></code> </label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <input type="text" class="form-control reset-input input-value-repeater-text"
                                                           data-name="{{  $option['option_name'] }}"
                                                           name="option[{{$indexOption}}][{{ $option['option_name'] }}][{{$index}}][column][{{$i}}][repeater_value]"
                                                           placeholder="" value="{{ $item->repeater_value }}">
                                                </div>
                                            </div>
                                            <div class="d-md-none kt-margin-b-10"></div>
                                        </div>
                                    </div>

                                    @php $i++; @endphp
                                @endforeach
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="add-item">
                    <a class="btn btn-info btn-add-item-update kt-font-light" data-index-option="{{ $indexOption }}"><i
                                class="fa fa-plus-circle"></i> Thêm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
