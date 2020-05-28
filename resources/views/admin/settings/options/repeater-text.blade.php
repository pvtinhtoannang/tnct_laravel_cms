<style>
    .repeater_list_parent {
        border: 1px solid #CCC;
        padding: 10px 15px 10px 30px;
        margin-bottom: 30px;
    }

    .repeater-list-children {
        margin-top: 15px;
        border: 1px solid #CCC;
        padding: 10px 15px;
    }

    .repeater-list-group {
        padding: 10px 15px;
        margin-bottom: 15px;
    }
</style>
<div class="repeater_list_parent repeater_list_parent_add" id="repeater-list-group" style="display:none; ">
    <div class="append-repeater_list_parent">

        <div class="repeater-list-children" data-parent-id="1">
            <div class="form-group">
                <label for="option_label">Tiêu đề <code>option_value_label</code></label>
                <input type="text"
                       name="repeater[label]" class="form-control reset-input"
                       aria-describedby="option_label"
                       value=""
                       placeholder="">
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
            <div class="form-group">
                <label for="option_name">Slug <code>option_value_name</code></label>
                <input type="text"
                       name="repeater[name]" class="form-control reset-input"
                       aria-describedby="option_name"
                       value=""
                       placeholder="ex: tieu_de">
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
            <div class="repeater-list-group repeater-list-group-repeater-text">
                <div class="repeater-list-input">
                    <div class="form-group row align-items-center repeater-item-text repeater-item-text-0"
                         data-id="1">
                        <div class="col-xs-12 col-md-12">
                            <span>Vui lòng điền đầy đủ thông tin, không được bỏ trống!</span>
                        </div>
                        <div class="col-md-5">
                            <div class="kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Label</label>
                                </div>
                                <div class="kt-form__control">
                                    <input type="text" class="form-control reset-input input-label-repeater-text"
                                           name="repeater[column][0][repeater_label]"
                                           placeholder="">
                                    <input type="hidden" class="form-control reset-input input-value-repeater-text"
                                           name="repeater[column][1][repeater_value]"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="d-md-none kt-margin-b-10"></div>
                        </div>
                        <div class="col-md-5">
                            <div class="kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Name</label>
                                </div>
                                <div class="kt-form__control">
                                    <input type="text" class="form-control reset-input input-slug-repeater-text"
                                           name="repeater[column][2][repeater_slug]"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="d-md-none kt-margin-b-10"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="kt-form__label">
                                <label>Xoá</label>
                            </div>
                            <a class="btn-sm btn btn-danger btn-pill btn-delete-item-input kt-font-light"
                               data-id="1">
                                            <span>
                                                <i class="la la-trash-o"></i>
                                            </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="add-item">
                    <a class="btn btn-info btn-add-item-repeater-text kt-font-light">
                        <i class="fa fa-plus-circle"></i> <span>Thêm mới </span>
                    </a>
                </div>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
        </div>
    </div>

</div>