<style>
    .repeater_image_list_parent {
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

<div class="repeater_image_list_parent" id="repeater-image-list-group" style="display:none; ">
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

                </div>
                <div class="add-item">
                    <a class="btn btn-info btn-add-item-images kt-font-light" data-last-id="1"><i
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