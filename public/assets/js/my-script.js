"use strict";
var PostTable = function () {
    var initTablePosts = function () {
        var table = $('#posts');

        // begin first table
        table.DataTable({
            responsive: true,
            bSort: false,
            columnDefs: [
                {
                    targets: 0,
                    orderable: false
                }
            ]
        });

    };

    return {

        //main function to initiate the module
        init: function () {
            initTablePosts();
        },

    };

}();

var CategoriesTable = function () {

    var initTableCategories = function () {
        var table = $('#categories');

        // begin first table
        table.DataTable({
            responsive: true,
            bSort: false,
            columnDefs: [
                {
                    targets: 0,
                    orderable: false
                }
            ]
        });

    };

    return {

        //main function to initiate the module
        init: function () {
            initTableCategories();
        },

    };

}();

function remove_unicode(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
    str = str.replace(/^\-+|\-+$/g, "");
    return str;
}

function slugGenerator() {
    let termName = $('form #term-name');
    let termSlug = $('form #term-slug');
    termName.blur(function () {
        let term = remove_unicode(termName.val());
        let slug = term.replace(/\ /g, "-");
        if (termSlug.val().length === 0) {
            $.ajax({
                url: '/admin/slug-generator/' + slug,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    termSlug.val(response);
                }
            });
        }
    });
}

function postNameGenerator() {
    let postName = $('form#post #post-name');
    let postTitle = $('form#post #post-title');
    postTitle.blur(function () {
        let title = remove_unicode(postTitle.val());
        let post_name = title.replace(/\ /g, "-");
        if (postName.val().length === 0) {
            $.ajax({
                url: '/admin/post-name-generator/' + post_name,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    postName.val(response);
                }
            });
        }
    });
}

function removeThumbnail() {
    let featured_image = $('.featured-image');
    let remove_btn = $('#remove-thumbnail');
    let thumbnail = $('#thumbnail_id');
    remove_btn.click(function () {
        featured_image.empty();
        thumbnail.removeAttr('value');
    });
}

function mediaSelect() {
    let attachments = $('ul.attachments');
    let media_button_select = $('.media-modal .media-button-select');
    attachments.on('click', '.attachment', function () {
        //reset status
        attachments.find('.selected').removeClass('selected');
        attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');

        $(this).addClass('selected');
        $(this).attr('aria-checked', 'true');
        if (attachments.find('.selected')) {
            media_button_select.removeAttr('disabled');
        } else {
            media_button_select.attr('disabled', 'disabled');
        }
    });
}

function featured_image_select() {
    let attachments = $('ul.attachments');
    let thumbnail_button_select = $('#featured-image-modal #thumbnail-button-select');
    let featured_image_modal = $('#featured-image-modal');
    let featured_image = $('.featured-image');
    let thumbnail = $('#thumbnail_id');

    thumbnail_button_select.click(function () {
        $.each($('#featured-image-modal li.attachment'), function (index, value) {
            if ($(this).hasClass('selected')) {
                thumbnail.attr('value', $(this).attr('data-id'));
                featured_image.empty();
                featured_image.append('<img src="' + $(this).attr('data-src') + '" />');
                attachments.find('.selected').removeClass('selected');
                attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');
                featured_image_modal.modal('hide');
            }
        });
    });
}

function lesson_select_file() {
    let insert_image_modal = $('#insert-file-modal');
    let attachments = $('ul.attachments');
    let select_file_btn = $('#file-button-select');
    let origin = window.location.origin;
    let lesson_file = $("[name='lesson_file']");
    select_file_btn.click(function () {
        $.each($('#insert-file-modal li.attachment'), function (index, value) {
            if ($(this).hasClass('selected')) {
                let file_name = origin + $(this).attr('data-src');
                lesson_file.val(file_name);
                attachments.find('.selected').removeClass('selected');
                attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');
                insert_image_modal.modal('hide');
            }
        });
    });
}

let insertMedia = function (context) {
    let ui = $.summernote.ui;
    let attachments = $('ul.attachments');
    let media_button_select = $('#insert-media-modal #media-button-select');
    let button = ui.button({
        contents: '<i class="note-icon-picture"/>',
        tooltip: 'Thêm Media',
        click: function () {
            let featured_image_modal = $('#insert-media-modal');
            featured_image_modal.modal('show');
            media_button_select.click(function () {
                $.each($('#insert-media-modal li.attachment'), function (index, value) {
                    if ($(this).hasClass('selected')) {
                        context.invoke('editor.insertImage', $(this).attr('data-src'));
                        attachments.find('.selected').removeClass('selected');
                        attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');
                        featured_image_modal.modal('hide');
                    }
                });
            });
        }
    });

    return button.render();   // return button as jquery object
};

$('.summernote-post-content').summernote({
    height: 500,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'media', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
        ['mybutton', ['hello']]
    ],
    buttons: {
        media: insertMedia
    }
});


function postTagGenerator() {
    let tagInput = $('#post-tag');
    let btn = $('#complete-btn');
    let tag_list = $('.tag-list');
    let tags;
    btn.click(function () {
        tagInput.focus();
        if (tagInput.val() !== '') {
            tags = tagInput.val().split(/[\s,]+/);
            tagInput.val('');
            for (let i = 0; i < tags.length; i++) {
                if (!tags.includes(tags[i])) {
                    tag_list.append(
                        '<li id="tag-' + i + '">' +
                        '<span class="remove-tag-icon kt-bg-success">' +
                        '<i class="la la-remove"></i>' +
                        '</span>' +
                        tags[i] +
                        '</li>'
                    );
                }
            }
        }
    });
}

function ajax_upload() {
    $.ajax({
        url: '/admin/get-attachment/',
        type: 'get',
        dataType: 'json',
        success: function (response) {
            let uploads_url = '/contents/uploads';
            let attachments = $('ul.attachments');
            attachments.empty();
            $.each(response, function (key, value) {
                let file_url = uploads_url + '/' + value.meta.meta_value;
                attachments.append(
                    '<li class="attachment" data-id="' + value.ID + '" data-src="' + file_url + '" data-file-name="' + value.post_name + '">' +
                    '<div class="attachment-preview">' +
                    '<div class="thumbnail">' +
                    '<span class="file-name">' + value.post_excerpt + '</span>' +
                    '<img src="' + file_url + '" alt="">' +
                    '</div>' +
                    '</div>' +
                    '</li>'
                );
            });
        }
    });
}

function confirmDelete() {
    $('.delete-term-btn').click(function (e) {
        let term_id = $(this).attr('data-term');
        let delete_url = '/admin/category/delete/' + term_id;
        swal.fire({
            title: 'Bạn sắp xoá vĩnh viễn những mục này khỏi trang web của bạn.',
            text: 'Hành động này không thể hoàn tác.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK!',
            cancelButtonText: 'Không, trở lại!',
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {

                $(location).attr('href', delete_url);
            } else if (result.dismiss === 'cancel') {

            }
        });
    });
}

function updatePosition() {
    let new_data_section = 0;
    $("#course-builder .course-builder-item").each(function (i, el) {
        let item = $(el).find('.course-builder-title');
        let section = $(el).find('[name ="section_heading"]');
        let data_section = section.attr('data-id');
        let type = item.attr('data-type');
        if (typeof data_section !== typeof undefined && data_section !== false) {
            new_data_section = data_section;
        }
        item.attr('data-position', i);
        if (type === 'lesson') {
            item.attr('data-section', new_data_section);
        }
    });
}

function positionGeneral() {
    let positionArray = [];
    $("#course-builder .course-builder-item").each(function (i, el) {
        let item = $(el).find('.course-builder-title');
        let position = item.attr('data-position');
        let title = item.val();
        let type = item.attr('data-type');
        let id = item.attr('data-id');
        let data_section = item.attr('data-section');
        if (typeof id !== typeof undefined && id !== false) {
            if (type === 'lesson') {
                positionArray.push({
                    "order": position,
                    "ID": id,
                    "post_title": title,
                    "type": type,
                    "section": data_section
                });
            } else {
                positionArray.push({
                    "order": position,
                    "ID": id,
                    "post_title": title,
                    "type": type,
                });
            }
        }
    });
    return positionArray;
}

function notification(messenger) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr.success(messenger);
}

function saveCourseBuilder() {
    let course = $('#course_id').val();
    // console.log(positionGeneral());
    $.ajax({
        url: '/admin/save-course-builder',
        type: 'post',
        data: {
            course: course,
            position: positionGeneral(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            notification('Cấu trúc khoá học đã được lưu.');
        }
    });
}

jQuery(function ($) {
    try {
        $(document).ready(function () {
            PostTable.init();
            CategoriesTable.init();
            slugGenerator();
            postNameGenerator();
            featured_image_select();
            postTagGenerator();
            removeThumbnail();
            mediaSelect();
            ajax_upload();
            lesson_select_file();
            $('#browse-btn').on('click', function () {
                ajax_upload();
            });
            $('#featured-browse-btn').on('click', function () {
                ajax_upload();
            });
            confirmDelete();
            $('#course-select').select2({
                placeholder: "Select a state"
            });
            $.validator.addMethod("check_sale_price", function (value, element, param) {
                let price = $("#course-price").val();
                if ((value * 1) === 0 && (price * 1) === 0 || (value * 1) < (price * 1)) {
                    return true;
                }
            }, "Giá khuyến mãi phải thấp hơn giá gốc.");
            $("#post").validate({
                rules: {
                    course_sale_price: {
                        number: true,
                        check_sale_price: true,
                        digits: true
                    }
                }
            });
        });

        $('#save-builder').click(function () {
            saveCourseBuilder();
        });

        $(document).on('click', '.save-section-heading', function () {
            // console.log($(this).parent().parent().find('.course-builder-title').val());
            let current = $(this).parent().parent().find('.course-builder-title');
            let id = current.attr('data-id');
            let post_title = current.val();
            let author = $('meta[name=admin-id]').attr("content");
            let post_name = current.attr('data-post-name');
            let course = $('#course_id').val();
            if (typeof id === typeof undefined || id === false) {
                // alert('create section heading');
                let post_data = {
                    'post_author': author,
                    'post_content': '',
                    'post_title': post_title,
                    'post_excerpt': '',
                    'post_status': 'inherit',
                    'post_name': '',
                    'post_type': 'section_heading'
                };
                $.ajax({
                    url: '/admin/create-section-heading',
                    type: 'post',
                    data: {course: course, post_data: post_data, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        current.attr({
                            'data-id': response.ID,
                            'data-post-name': response.post_name
                        });
                        notification('Chương đã được tạo.');
                        saveCourseBuilder();
                    }
                });
            } else {
                // alert('update section heading');
                let post_data = {
                    'post_author': author,
                    'post_content': '',
                    'post_title': post_title,
                    'post_excerpt': '',
                    'post_status': 'inherit',
                    'post_name': post_name,
                    'post_type': 'section_heading'
                };
                $.ajax({
                    url: '/admin/update-section-heading',
                    type: 'post',
                    data: {id: id, post_data: post_data, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        current.attr({
                            'data-id': response.ID,
                            'data-post-name': response.post_name
                        });
                        notification('Chương đã được cập nhật.');
                        saveCourseBuilder();
                    }
                });
            }
        });

        $(document).on('click', '.delete-section-heading', function () {
            let current = $(this).parent().parent().parent();
            let id = current.find('.course-builder-title').attr('data-id');
            // console.log(id);
            $.ajax({
                url: '/admin/delete-section-heading',
                type: 'post',
                data: {id: id, _token: $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    notification('Chương đã được xoá.');
                    current.remove();
                    saveCourseBuilder();
                }
            });
        });

        $(document).on('click', '.delete-lesson', function () {
            let current = $(this).parent().parent().parent();
            let id = current.find('.course-builder-title').attr('data-id');
            // console.log(id);
            $.ajax({
                url: '/admin/delete-lesson',
                type: 'post',
                data: {id: id, _token: $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    notification('Bài học đã được xoá.');
                    current.remove();
                    saveCourseBuilder();
                }
            });
        });

        $(document).on('click', '.save-lesson', function () {
            // console.log($(this).parent().parent().find('.course-builder-title').val());
            let current = $(this).parent().parent().find('.course-builder-title');
            let id = current.attr('data-id');
            let post_title = current.val();
            let author = $('meta[name=admin-id]').attr("content");
            let post_name = current.attr('data-post-name');
            let course = $('#course_id').val();
            if (typeof id === typeof undefined || id === false) {
                // alert('create lesson');
                let post_data = {
                    'post_author': author,
                    'post_content': '',
                    'post_title': post_title,
                    'post_excerpt': '',
                    'post_status': 'publish',
                    'post_name': '',
                    'post_type': 'lesson'
                };
                $.ajax({
                    url: '/admin/create-lesson',
                    type: 'post',
                    data: {course: course, post_data: post_data, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        current.attr({
                            'data-id': response.ID,
                            'data-post-name': response.post_name
                        });
                        notification('Bài học đã được tạo.');
                        saveCourseBuilder();
                    }
                });
            } else {
                // alert('update lesson');
                let post_data = {
                    'post_author': author,
                    'post_content': '',
                    'post_title': post_title,
                    'post_excerpt': '',
                    'post_status': 'publish',
                    'post_name': post_name,
                    'post_type': 'lesson'
                };
                $.ajax({
                    url: '/admin/update-lesson',
                    type: 'post',
                    data: {id: id, post_data: post_data, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        current.attr({
                            'data-id': response.ID,
                            'data-post-name': response.post_name
                        });
                        notification('Bài học đã được cập nhật.');
                        saveCourseBuilder();
                    }
                });
            }
        });

        $('#add-section-heading').click(function () {
            $('#course-builder').append(
                '<div class="rkt-margin-b-10 course-builder-item">\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <div class="col-lg-12">\n' +
                '                                            <label>Chương</label>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-lg-10">\n' +
                '                                            <input name="section_heading" type="text"\n' +
                '                                                   class="form-control form-control-danger course-builder-title"\n' +
                '                                                   placeholder="Nhập tiêu đề" data-type="section_heading">\n' +
                '                                        </div>\n' +
                '                                        <div class="col-lg-2">\n' +
                '                                            <span class="btn btn-danger btn-icon save-section-heading">\n' +
                '                                                        <i class="la la-save"></i>\n' +
                '                                                        </span>\n' +
                '                                            <span class="btn btn-danger btn-icon sort-action">\n' +
                '                                                        <i class="la la-arrows-alt"></i>\n' +
                '                                                        </span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>'
            );
            updatePosition();
        });

        $('#add-lesson').click(function () {
            $('#course-builder').append(
                '<div class="rkt-margin-b-10 course-builder-item">\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <div class="col-lg-12">\n' +
                '                                            <label>Bài học</label>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-lg-10">\n' +
                '                                            <input name="lesson" type="text"\n' +
                '                                                   class="form-control form-control-danger course-builder-title"\n' +
                '                                                   placeholder="Nhập tiêu đề" data-type="lesson">\n' +
                '                                        </div>\n' +
                '                                        <div class="col-lg-2">\n' +
                '                                            <span class="btn btn-danger btn-icon save-lesson">\n' +
                '                                                        <i class="la la-save"></i>\n' +
                '                                                        </span>\n' +
                '                                            <span class="btn btn-danger btn-icon sort-action">\n' +
                '                                                        <i class="la la-arrows-alt"></i>\n' +
                '                                                        </span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>'
            );
            updatePosition();
        });
        $("#course-builder").sortable({
            connectWith: "#course-builder",
            items: ".course-builder-item",
            opacity: 0.8,
            handle: '.sort-action',
            coneHelperSize: true,
            placeholder: 'course-builder-sortable',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".course-builder-sortable-empty", // cancel dragging if portlet is in fullscreen mode
            revert: 250, // animation in milliseconds
            start: function (event, ui) {
                // console.log('start: ' + ui.item.index())
            },
            update: function (event, ui) {
                if (ui.item.prev().hasClass("course-building-sortable-empty")) {
                    ui.item.prev().before(ui.item);
                }
                // console.log('update: ' + ui.item.index())
            },
            stop: function (event, ui) {
                $("#course-builder .course-builder-item").each(function (i, el) {
                    $(el).find('.course-builder-title').attr('data-position', $(el).index());
                });
            }
        });
        updatePosition();
    } catch (e) {
        console.log(e);
    }
});
