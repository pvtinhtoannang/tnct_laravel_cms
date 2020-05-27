<style>
    .repeater_update_parent {
        border: 1px solid #CCC;
        padding: 10px 15px 10px 30px;
        margin-bottom: 30px;
    }

    .repeater-list-children {
        margin-top: 15px;
    }

    .repeater-list-group {
        padding: 10px 15px;
        margin-bottom: 15px;
    }
</style>

<div class="repeater_update_parent">
    <div class="append-repeater_list_parent">
        @foreach(json_decode($option['option_value']) as $index => $value)
            <div class="repeater-list-children @if($index == 0) repeater-list-children-0 @endif"
                 data-parent-id="{{ $index }}">
                <a class="btn btn-danger btn-delete-item-parent kt-font-light  @if($index == 0)  disabled  @endif"
                   data-parent-id="1"><i
                            class="fa fa-trash-alt"></i> Xoá nhóm
                </a>
                <div class="form-group">
                    <label for="option_label">Tiêu đề cho repeater</label>
                    <input type="text"
                           name="option[{{ $option['option_name']}}][option_label_parent][]"
                           class="form-control"
                           aria-describedby="option_label"
                           value="@if(isset($value->label)){{ $value->label }}@endif"
                           placeholder="Nhập tiêu đề, ex: Tên website">
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                </div>
                <div class="form-group">
                    <label for="option_name">Slug cho repeater</label>
                    <input type="text"
                           name="option[{{ $option['option_name'] }}][option_slug_parent][]"
                           class="form-control"
                           aria-describedby="option_name"
                           value="@if(isset($value->slug)){{ $value->slug }}@endif"
                           placeholder="Slug viết không dấu và có dấu _ ở dưới, ex: tieu_de">
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                </div>
                <div class="repeater-list-group">
                    <div class="repeater-list-input">
                        @php

                            if(isset($value->children)){
                                $slug = $value->children->slug;
                                $label = $value->children->label;
                            }else{
                                $slug = '' ;
                            }
                        @endphp
                        @if(is_array($slug))
                            @for($i = 0; $i < sizeof($slug); $i++)
                                <div class="form-group row align-items-center repeater-item-text repeater-item-text-{{$i}}"
                                     data-id="{{ $i }}">
                                    <div class="col-xs-12 col-md-12"><span>Vui lòng điền đầy đủ thông tin, không được bỏ trống và phải nhập đúng cấu trúc!</span>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Nội dung:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <input type="text"
                                                       class="form-control"
                                                       name="option[{{ $option['option_name'] }}][option_label_parent][][label]"
                                                       placeholder="Nhập nội dung"
                                                       value="{{ $label[$i]->label  }}"
                                                >
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Slug Sub - dùng cho
                                                    dev</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <input type="text"
                                                       class="form-control "
                                                       name="option[{{ $option['option_name'] }}][option_slug_parent][][slug]"
                                                       placeholder="Nhập slug"
                                                       value="{{ $slug[$i]->slug  }}"
                                                >
                                            </div>
                                        </div>
                                        <div class="d-md-none kt-margin-b-10"></div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="kt-form__label">
                                            <label>Xoá</label>
                                        </div>
                                        <a class="btn-sm btn btn-danger btn-pill btn-delete-item-input kt-font-light @if($i == 0) disabled @endif"
                                           data-id="{{ $i }}">
                                                                    <span>
                                                                        <i class="la la-trash-o"></i>
                                                                    </span>
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        @else
                            @php
                                $i = 1;
                            @endphp
                            <div class="form-group row align-items-center repeater-item-text repeater-item-text-0"
                                 data-id="{{ $i }}">
                                <div class="col-xs-12 col-md-12"><span>Vui lòng điền đầy đủ thông tin, không được bỏ trống và phải nhập đúng cấu trúc!</span>
                                </div>
                                <div class="col-md-7">
                                    <div class="kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Nội dung:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text"
                                                   class="form-control reset-input"
                                                   name="option[{{ $option['option_name'] }}][option_label_parent][][label]"
                                                   placeholder="Nhập nội dung"
                                                   value="{{ $value->label  }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Slug Sub - dùng cho
                                                dev</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text"
                                                   class="form-control reset-input"
                                                   name="option[{{ $option['option_name'] }}][option_slug_parent][][slug]"
                                                   placeholder="Nhập slug"
                                                   value="{{ $value->slug  }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-2">
                                    <div class="kt-form__label">
                                        <label>Xoá</label>
                                    </div>
                                    <a class="btn-sm btn btn-danger btn-pill btn-delete-item-input disabled kt-font-light"
                                       data-id="{{ $i }}">
                                                                    <span>
                                                                        <i class="la la-trash-o"></i>
                                                                    </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="add-item">
                        <a class="btn btn-info btn-add-item-update kt-font-light"
                           data-last-id="{{ $i }}"><i
                                    class="fa fa-plus-circle"></i> Thêm mới
                        </a>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="add-item">
        <a class="btn btn-info btn-add-item-parent-update kt-font-light"><i
                    class="fa fa-plus-circle"></i> Thêm mới
        </a>
    </div>
</div>
