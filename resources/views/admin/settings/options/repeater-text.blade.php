<style>
    .repeater_list_parent {
        border: 1px solid #CCC;
        padding: 10px 15px 10px 30px;
        margin-bottom: 30px;
    }

    .repeater-list-children {
        margin-top: 15px;
    }

    .repeater-list-group {
        padding: 10px 15px;
        border: 1px solid #CCC;
        margin-bottom: 15px;
    }
</style>
<div class="repeater_list_parent" id="repeater-list-group" style="display:none; ">
    <div class="append-repeater_list_parent">
        <div class="repeater-list-children" data-parent-id="1">
            <div class="form-group">
                <label for="option_label">Tiêu đề cho repeater</label>
                <input type="text"
                       name="option_label_parent[label][]" class="form-control reset-input"
                       aria-describedby="option_label"
                       value=""
                       placeholder="Nhập tiêu đề, ex: Tên website">
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
            <div class="form-group">
                <label for="option_name">Slug cho repeater</label>
                <input type="text"
                       name="option_slug_parent[slug][]" class="form-control reset-input"
                       aria-describedby="option_name"
                       value=""
                       placeholder="Slug viết không dấu và có dấu _ ở dưới, ex: tieu_de">
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
            <div class="repeater-list-group">
                <div class="repeater-list-input">
                    <div class="form-group row align-items-center repeater-item-text"
                         data-id="1">
                        <div class="col-xs-12 col-md-12"><span>Vui lòng điền đầy đủ thông tin, không được bỏ trống!</span>
                        </div>
                        <div class="col-md-7">
                            <div class="kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Nội dung:</label>
                                </div>
                                <div class="kt-form__control">
                                    <input type="text" class="form-control reset-input"
                                           name="option_label_parent[label][][label]"
                                           placeholder="Nhập nội dung">
                                </div>
                            </div>
                            <div class="d-md-none kt-margin-b-10"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Slug Sub - dùng cho dev</label>
                                </div>
                                <div class="kt-form__control">
                                    <input type="text" class="form-control reset-input"
                                           name="option_slug_parent[slug][][slug]"
                                           placeholder="Nhập slug">
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
                    <a class="btn btn-info btn-add-item kt-font-light" data-last-id="1"><i
                                class="fa fa-plus-circle"></i> Thêm mới
                    </a>
                </div>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
            </div>
        </div>
    </div>
    <div class="add-item">
        <a class="btn btn-info btn-add-item-parent kt-font-light" data-parent-last-id="1"><i
                    class="fa fa-plus-circle"></i> Thêm mới
        </a>
    </div>
</div>