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

    thumbnail_button_select.click(function () {
        $.each($('#featured-image-modal li.attachment'), function (index, value) {
            if ($(this).hasClass('selected')) {
                featured_image.empty();
                featured_image.append('<img src="' + $(this).attr('data-src') + '" />');
                attachments.find('.selected').removeClass('selected');
                attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');
                featured_image_modal.modal('hide');
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
                    '<li class="attachment" data-id="' + value.ID + '" data-src="' + file_url + '">' +
                    '<div class="attachment-preview">' +
                    '<div class="thumbnail">' +
                    '<img src="' + file_url + '" alt="">' +
                    '</div>' +
                    '</div>' +
                    '</li>'
                );
            });
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
            $('#browse-btn').on('click', function () {
                ajax_upload();
            });
            $('#featured-browse-btn').on('click', function () {
                ajax_upload();
            });
        });
    } catch (e) {
        console.log(e);
    }
});
