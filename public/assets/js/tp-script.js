"use strict"


var KTDatatablesPermission = function () {
    var initTablePermission = function () {
        var table = $('#permission');
        table.DataTable({
            responsive: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {'lengthMenu': 'Hiển thị _MENU_',},
        });
    };
    return {
        init: function () {
            initTablePermission();
        },
    };
}();

// Class definition
var KTSelect2Permission = function () {
    // Private functions
    var permission = function () {
        // multi select
        $('.admin_settings_tp_permissions').select2({
            placeholder: "  __Chọn nhóm quyền truy cập - Bạn có thể chọn nhiều option",
        });
    }

    return {
        init: function () {
            permission();
        },
    };
}();

var KTFormPermissionUpdateForRole = function () {
    var updateForRole = function () {
        var role = $('#update_permission_for_role #role').val();
        if (role != null) {
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_settings_tp_permissions").select2("destroy");
                $("#admin_settings_tp_permissions").select2();
            });
        }
    }

    var getPermisionForRole = function () {
        $('#update_permission_for_role #role').change(function () {
            var role = $('#update_permission_for_role #role').val();
            $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_settings_tp_permissions").select2("destroy");
                $("#admin_settings_tp_permissions").select2();
            });
        });
    }

    return {
        init: function () {
            updateForRole();
            getPermisionForRole();
        }
    };
}();


var PvtinhPermissionModal = function () {
    var deletePermission = function () {
        $('.kt_sweetalert_delete_permission').click(function (e) {
            swal.fire({
                title: "Xoá quyền truy cập!",
                text: "Bạn nên chỉnh sửa một quyền truy cập nào đó thay vì xoá nó đi, khi xoá có thể làm ảnh hưởng đến một số chức năng nhất định!",
                type: "success",
                confirmButtonText: "Xác nhận!",
                confirmButtonClass: "btn btn-focus--pill--air"
            });
        });
    }

    var updatePermission = function () {
        $('.btn-edit-permission').click(function () {
            var permission = parseInt($(this).attr('data-id'));
            if (permission != null) {
                $.ajax({
                    url: "/admin/ajax-permission-by-id/" + permission,
                    method: "GET"
                }).done(function (data) {
                    $('#kt_modal_update_permission_settings #update_name').val(data.name);
                    $('#kt_modal_update_permission_settings #update_id').val(data.id);
                    $('#kt_modal_update_permission_settings #update_display_name').val(data.display_name);
                    $('#kt_modal_update_permission_settings #update_group_id option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        option_ele.removeAttr('selected');
                        if (option_value === data.group_id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
            }
        });
    }
    return {
        init: function () {
            deletePermission();
            updatePermission();
        }
    }
}();


var PvtinhPermissionForUser = function () {
    var tb_tab3_user = function () {
        // multi select
        $('#tb_tab3_user').select2({
            placeholder: "Chọn người dùng",
        });
    }

    var getTabPermissionByUserID = function () {
        var user_id = $('#tb_tab3_user').val();
        if (user_id != null) {
            $('#admin_add_user_permission optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });
            $.ajax({
                url: "/admin/ajax-update-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });
            $.ajax({
                url: "/admin/ajax-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });


        }
    }

    var getPermissionByUserIDAfterChangeUser = function () {
        $('#tb_tab3_user').change(function () {
            var user_id = $(this).val();
            $('#admin_add_user_permission optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });

            $.ajax({
                url: "/admin/ajax-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });
        });
    }
    return {
        init: function () {
            tb_tab3_user();
            getTabPermissionByUserID();
            getPermissionByUserIDAfterChangeUser();
        }
    }
}();

var PvtinhUserManagement = function () {
    var updateUserByID = function () {
        $('.btn-edit-user').click(function () {
            var id_user = $(this).attr('data-id');

            if (id_user != null) {
                $('#kt_modal_update_users option').each(function (i) {
                    $(this).removeAttr('selected');
                });
                $.ajax({
                    url: "/admin/ajax-get-user-by-id/" + id_user,
                    method: "GET"
                }).done(function (data) {
                    var role_id = data[0][0]['id'];
                    $('#kt_modal_update_users  #update_group_id option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === role_id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });

                    var data_user = data[1];
                    $('#update_id').val(data_user.id);
                    $('#update_name').val(data_user.name);
                    $('#update_email').val(data_user.email);
                });
            }

        });
    }

    return {
        init: function () {
            updateUserByID();
        }
    }
}();
var PvtinhMenuManagement = function () {

    var createSelect2MenuCategoriesCourse = function () {
        $('#menu_course_cat').select2({
            placeholder: "Chọn một hoặc nhiều chuyên mục khoá học"
        });
    }
    var createSelect2MenuCourse = function () {
        $('#menu_course').select2({
            placeholder: "Chọn một hoặc nhiều khoá học"
        });
    }
    var handleAddMenuItemForCategoryCourse = function () {
        $('.btn-add-course-cat-to-menu').click(function () {
            var data = $('#menu_course_cat').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();

            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_categories').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }

        });
    }
    var handleAddMenuItemForCourse = function () {
        $('.btn-add-course-to-menu').click(function () {
            var data = $('#menu_course').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();

            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_posts').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }

        });
    }

    var createSelect2MenuPages = function () {
        $('#menu_pages').select2({
            placeholder: "Chọn một hoặc nhiều trang"
        });
    }
    var createSelect2MenuPosts = function () {
        $('#menu_posts').select2({
            placeholder: "Chọn một hoặc nhiều bài viết",
        });
    }
    var createSelect2MenuTags = function () {
        $('#menu_tags').select2({
            placeholder: "Chọn một hoặc nhiều thẻ"
        });
    }
    var createSelect2MenuCategories = function () {
        $('#menu_categories').select2({
            placeholder: "Chọn một hoặc nhiều chuyên mục"
        });
    }

    var createStructMenu = function () {
        $('.dd').nestable({ /* config options */});
    }
    var handleEditMenuItem = function () {
        $('a.edit-button').click(function () {
            var inputUrlName = $('form#editMenuItem #url-name');
            var inputMenuID = $('form#editMenuItem #menu-id');
            var inputMenuUrl = $('form#editMenuItem #menu-url');
            var label = $(this).attr('data-label');
            var id = $(this).attr('data-id');
            var link = $(this).attr('data-link');

            inputUrlName.val('');
            inputMenuID.val('');
            inputMenuUrl.val('');
            inputUrlName.val(label);
            inputMenuID.val(id);
            inputMenuUrl.val(link);
        });

        $('button.btn-save-editMenuItem').click(function () {

            var id, label, link, __token;
            id = $('form#editMenuItem #menu-id').val();
            label = $('form#editMenuItem #url-name').val();
            link = $('form#editMenuItem #menu-url').val();
            __token = $('form#editMenuItem input[name="_token"]').val();
            $.ajax({
                method: "POST",
                url: "/admin/ajax-update-menu",
                data: {_token: __token, id: id, label: label, link: link}
            })
                .done(function (msg) {
                    if (msg === 'true') {
                        $('ol.dd-list li.dd-item').each(function (i) {
                            if ($(this).attr('data-id') === id) {
                                $(this).find('.dd3-content span').text(label);
                                $(this).find('.dd3-content a.edit-button').attr('data-label', label);
                                $(this).find('.dd3-content a.edit-button').attr('data-link', link);
                                console.log('da luu menu thanh cong');
                                swal.fire("Hoàn thành!", "Menu này đã được cập nhật", "success");
                            }
                        });
                    } else {
                        swal.fire("Lỗi rồi!", "Kiểm tra lại thông tin bạn vừa nhập nhé!", "error");
                        $('form#editMenuItem input').css('border', '1px solid #F40000');
                    }
                });

        });
    }

    var alertSuccessAddMenuItem = function () {
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

        toastr.success("Menu đã thêm vào!");

        /*reload để có thể chỉnh sửa menu ở dưới cùng*/
        window.location.reload();
    }
    var alertUpdateMenuItem = function () {
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

        toastr.info("Menu đã được thay đổi!");
    }

    var alertDeleteMenuItem = function () {
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

        toastr.warning("Menu đã được xoá thành công!");
    }

    var alertErrorAddMenuItem = function () {
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

        toastr.error("Có lỗi xảy ra rồi!");
    }

    var handleAddMenuItemForPages = function () {
        $('.btn-add-pages-to-menu').click(function () {
            var data = $('#menu_pages').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();
            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_pages').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }

        });
    }

    var handleAddMenuItemForPosts = function () {
        $('.btn-add-post-to-menu').click(function () {
            var data = $('#menu_posts').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();

            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_posts').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }

        });
    }

    var handleAddMenuItemForCategory = function () {
        $('.btn-add-category-to-menu').click(function () {
            var data = $('#menu_categories').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();

            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_categories').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }

        });
    }

    var handleAddMenuItemForTags = function () {
        $('.btn-add-tag-to-menu').click(function () {
            var data = $('#menu_tags').select2('data');
            var __token = $('meta[name="csrf-token"]').attr('content');
            var position = $('#postion_menu').val();

            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });
            });
            $('#menu_tags').val(null).trigger('change');

            if (data !== null) {
                alertSuccessAddMenuItem();
            }
        });
    }

    var handleAddMenuItemForCustomLink = function () {
        $('.btn-add-custom-link-to-menu').click(function () {
            var label = $.trim($('#custom_link_name').val());
            var link = $.trim($('#custom_link_url').val());
            var __token = $('meta[name="csrf-token"]').attr('content');
            var html = '';
            var position = $('#postion_menu').val();

            if (label.length === 0 || link.length === 0) {
                alertErrorAddMenuItem();
            } else {
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: position}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = $.text(res.label);
                        var label_link = res.link;
                        console.log(id_html);
                        if (id_html !== undefined) {
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>\n' +
                                '    <span class="dd3-content">\n' +
                                '        <span data-id="' + id_html + '">' + label_html + '</span>\n' +
                                '        <a class="edit-button" data-id="' + id_html + '"\n' +
                                '        data-label="' + label_html + '" href="javascript:;"\n' +
                                '        data-link="' + label_link + '" data-toggle="modal"\n' +
                                '        data-target="#modalEditMenuItem"><i class="flaticon-edit"></i></a>\n' +
                                '        <a class="del-button" href="javascript:;" data-id="' + id_html + '"><i\n' +
                                '        class="flaticon-delete"></i></a>\n' +
                                '    </span>\n' +
                                '</li>';
                            $('ol.dd-list-parent').append(html);
                        }
                    });


                alertSuccessAddMenuItem();
                $('#custom_link_name').val('');
                $('#custom_link_url').val('');
            }
        });
    }

    var redirectToMenuByID = function () {
        $('.btn-edit-menu').click(function () {
            var nav_menu = $('#menus_group').val();
            var url = "/admin/nav-menu/" + nav_menu;
            $(location).attr('href', url);
        });
    }

    var saveMenuItemToMenuPosition = function () {
        $('.dd').on('change', function () {
            $("#load").show();
            var __token = $('meta[name="csrf-token"]').attr('content');
            var data = $('.dd').nestable('serialize');
            console.log(data);
            $.ajax({
                type: "POST",
                url: "/admin/ajax-save-menu",
                data: {_token: __token, data: data},
                cache: false,
                success: function (data) {
                    alertUpdateMenuItem();
                }, error: function (xhr, status, error) {
                    alertErrorAddMenuItem();
                },
            });
        });
    }

    var deleteMenuItem = function () {
        $('.del-button').click(function () {
            var __token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "/admin/ajax-delete-menu-item",
                data: {_token: __token, id: id},
                cache: false,
                success: function (data) {
                    alertDeleteMenuItem();
                    window.location.reload();
                }, error: function (xhr, status, error) {
                    alertErrorAddMenuItem();
                },
            });
        });
    }

    var updatePositionMenu = function () {
        $('.btn-edit-menu-position').click(function () {
            var id = $(this).data('id');
            var url = '/admin/ajax-get-menu-position/' + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $('#update_name').val(data.name);
                    $('#update_display_name').val(data.display_name);
                    $('#update_id').val(data.id);

                }, error: function (xhr, status, error) {
                    alertErrorAddMenuItem();
                },
            });
        });

        $('.btn-save-menu-position').click(function () {
            var id = $('#update_id').val();
            var update_name = $('#update_name').val();
            var update_display_name = $('#update_display_name').val();
            var __token = $('meta[name="csrf-token"]').attr('content');

            var url = 'ajax-update-postion-menu';

            $.ajax({
                type: "POST",
                url: url,
                data: {_token: __token, id: id, name: update_name, display_name: update_display_name},
                success: function (res) {
                    $('#update_name').val(data.name);
                    $('#update_display_name').val(data.display_name);
                    $('#update_id').val(data.id);

                }, error: function (xhr, status, error) {
                    alertErrorAddMenuItem();
                },
            });
        });
    }


    return {
        init: function () {
            createSelect2MenuPages();
            createSelect2MenuPosts();
            createSelect2MenuTags();
            createSelect2MenuCategories();
            createStructMenu();
            handleEditMenuItem();
            handleAddMenuItemForPages();
            handleAddMenuItemForPosts();
            handleAddMenuItemForCategory();
            handleAddMenuItemForTags();
            handleAddMenuItemForCustomLink();
            redirectToMenuByID();
            saveMenuItemToMenuPosition();
            deleteMenuItem();
            updatePositionMenu();
            createSelect2MenuCategoriesCourse();
            createSelect2MenuCourse();
            handleAddMenuItemForCategoryCourse();
            handleAddMenuItemForCourse();
        }
    }
}();
var PvtinhSliderManagement = function () {
    var RepeaterSlider = function () {
        $('#kt_repeater_1').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    var addNewSlide = function () {
        $('.btn-add-slide-item').click(function () {
            var indexB = 0;
            $.each($('.item-repeater'), function (index, value) {
                indexB = index + 1;
                $(this).attr("data-repeat-item", indexB);
                $(this).find('.btn-choose-file').attr('data-repeat', indexB);
            });

            $('#name').val(JSON.stringify($('.repeater').repeaterVal()));
        });
    }
    var featured_image_select = function () {
        var data_id = 0;
        $(document).on("click", "button.btn-choose-file", function () {
            let featured_image_modal = $('#insert-media-modal');
            featured_image_modal.modal('show');
            data_id = $(this).attr('data-repeat');
        });

        let attachments = $('ul.attachments');
        let media_button_select = $('#insert-media-modal #media-button-select');
        media_button_select.click(function () {
            let featured_image_modal = $('#insert-media-modal');
            featured_image_modal.modal('show');
            $.each($('#insert-media-modal li.attachment'), function (index, value) {
                if ($(this).hasClass('selected')) {
                    var src = $(this).attr('data-src');
                    var id = $(this).attr('data-id');
                    $.each($('.item-repeater'), function (index, value) {
                        let indexB = index * 1 + 1;
                        let dataIdB = data_id * 1;
                        if (indexB === dataIdB) {
                            $(this).find('.slide-image').empty();
                            $(this).find('.slide-image').append('<img src="' + src + '" />');
                            $(this).find('.id-images').val(id);
                        }
                    });
                    attachments.find('.selected').removeClass('selected');
                    attachments.find('[aria-checked="true"]').attr('aria-checked', 'false');
                    featured_image_modal.modal('hide');
                }
            });
        });
    }
    var saveAllSlide = function () {

        $('.btn-save-slide').click(function () {
            var data = $('.repeater').repeaterVal();
            console.log(data);
            var errors = 0;
            var id_slider = $(this).data('id');
            var post_title = $(this).data('title');
            var post_status = 'publish';
            var post_name = $(this).data('name');
            var post_type = 'slider';
            var post_content;

            $.each(data, function (index, value) {
                post_content = value;
                $.each(value, function (i, item) {
                    if (item.slide_url === '') {
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

                        toastr.warning("Bạn quên nhập liên kết");
                        errors = 1;
                    }
                    if (item.slide_title === '') {
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
                        toastr.warning("Bạn quên nhập tiêu đề");
                        errors = 1;
                    }
                    if (item.slide_id_images === '') {
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
                        toastr.error("Bạn quên nhập hình ảnh!");
                        errors = 1;
                    } else {
                        errors = 0;
                    }
                });
            });
            if (errors === 1) {
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
                toastr.error("Vui lòng nhập hình ảnh cho slide vừa thêm!");
            } else {
                var __token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: '/admin/slider/' + id_slider,
                    data: {
                        _token: __token,
                        post_content: post_content,
                        post_title: post_title,
                        post_status: post_status,
                        post_name: post_name,
                        post_type: post_type,
                    },
                    success: function (res) {
                        errors = 0;
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
                        toastr.success("Slider đã thêm vào!!!");
                    }, error: function (xhr, status, error) {
                        alertErrorAddMenuItem();
                    },
                });

            }
        });
    }
    return {
        init: function () {
            RepeaterSlider();
            addNewSlide();
            featured_image_select();
            saveAllSlide();
        }
    }
}();

var PvtinhOptionManagement = function () {

    let slideUpOptionValue = function () {
        $('#content_option_default').slideUp('slow');
        $('#content_option_course').slideUp('slow');
        $('#content_option_course_cat').slideUp('slow');
        $('#repeater-list-group').slideUp('slow');
        $('#repeater-image-list-group').slideUp('slow');
    }

    let resetInput = function () {
        $('.reset-input').val('');
        $('.reset-input').text('');
        $('.repeater-item-text').find('input').val('');
    }
    let resetSelect2 = function () {
        $('#option_value_courses').val('null').trigger('change');
        $('#option_value_course_cat').val('null').trigger('change');
        $('#option_value_courses').select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Chọn một khoá học'
            }
        });
        $('.select2-course-update').select2({

        });
        $('#option_value_course_cat').select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Chọn một danh mục khoá học'
            }
        });
    }
    resetSelect2();
    let RepeaterOptions = function () {
        $('.form-new-option #option_type').change(function () {
            let option_value = $(this).val();
            resetSelect2();
            resetInput();
            if (option_value === 'course') {
                slideUpOptionValue();
                resetSelect2();
                $('#content_option_course').slideDown('slow');
            } else if (option_value === 'course_cat') {
                slideUpOptionValue();
                resetSelect2();
                $('#content_option_course_cat').slideDown('slow');
            } else if (option_value === 'repeater_text') {
                slideUpOptionValue();
                resetSelect2();
                $('#repeater-list-group').slideDown('slow');
            } else if (option_value === 'repeater_image') {
                slideUpOptionValue();
                resetSelect2();
                $('#repeater-list-group').slideDown('slow');
            } else {
                slideUpOptionValue();
                $('#content_option_default').slideDown('slow');
            }
        });
    };
    var createNameInputForRepeaterText = function () {
        var label = '';
        var slug = '';
        var value = '';
        $('.repeater-list-group-repeater-text .repeater-item-text').each(function (i) {
            if (i == '0') {
                $(this).find('.btn-delete-item-input').addClass('disabled')
            }
            label = 'repeater[column][' + i + '][repeater_label]';
            slug = 'repeater[column][' + i + '][repeater_slug]';
            value = 'repeater[column][' + i + '][repeater_value]';
            $(this).find('.input-label-repeater-text').attr('name', label);
            $(this).find('.input-slug-repeater-text').attr('name', slug);
            $(this).find('.input-value-repeater-text').attr('name', value);

            if (i >= '1') {
                $(this).removeClass('repeater-item-text-0');
                $(this).find('.btn-delete-item-input').removeClass('disabled')
            }
        });
    }
    var notifcationDeleted = function () {
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
        toastr.success("Đã xoá!!!");
    }
    var notifcationAdded = function () {
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
        toastr.success("Đã thêm!!!");
    }

    var createNewInputForRepeaterText = function () {
        $(document).on('click', 'a.btn-add-item-repeater-text', function () {
            var html_item_input_text = $(this).parents('.repeater-list-group-repeater-text').find('.repeater-item-text-0').clone();
            $(this).parents('.repeater-list-group-repeater-text').find('.repeater-list-input').append(html_item_input_text);
            console.log(html_item_input_text);
            createNameInputForRepeaterText();
            console.log('Đã thêm mới');
            notifcationAdded();
        });
    }
    var deleteInputForRepeaterText = function () {
        $(document).on('click', 'a.btn-delete-item-input', function () {
            $(this).parents('.repeater-item-text').remove();
            createNameInputForRepeaterText();
            console.log('Đã xoá');
            notifcationDeleted();
        });
    }
    var createInputUpdate = function () {
        $(document).on('click', 'a.btn-add-item-update', function () {
            let repeater_list_input = $(this).parents('.repeater_update_parent').find('.repeater-list-input-0').clone();
            $(this).parents('.repeater_update_parent').find('.repeater-list-group-repeater-text-update').append(repeater_list_input);
            var label = '';
            var slug = '';
            var value = '';
            let indexOption = $(this).data('index-option');
            $(this).parents('.repeater_update_parent').find('.repeater-list-group-repeater-text-update .repeater-list-input').each(function (i) {

                if (i === '0') {
                    $(this).find('.btn-delete-item-input').addClass('disabled')
                }
                var option_name = $(this).find('.input-label-repeater-text').data('name');
                console.log(option_name);
                $(this).find('.input-label-repeater-text').attr('name', 'option[' + indexOption + '][' + option_name + '][0][label]');
                $(this).find('.input-label-repeater-text').attr('name', 'option[' + indexOption + '][' + option_name + '][0][name]');
                $(this).find('.input-label-parent-repeater').attr('name', 'option[' + indexOption + '][' + option_name + '][' + i + '][label]');
                $(this).find('.input-name-parent-repeater').attr('name', 'option[' + indexOption + '][' + option_name + '][' + i + '][name]');

                label = 'option[' + indexOption + '][' + $(this).find('.input-label-repeater-text').data('name') + ']['+i+'][column]['+i+'][repeater_label]';
                slug = 'option[' + indexOption + '][' + $(this).find('.input-value-repeater-text').data('name') + ']['+i+'][column]['+i+'][repeater_slug]';
                value = 'option[' + indexOption + '][' + $(this).find('.input-slug-repeater-text').data('name') + ']['+i+'][column]['+i+'][repeater_value]';

                $(this).find('.repeater-item-text').each(function (j) {
                    label = 'option[' + indexOption + '][' + $(this).find('.input-label-repeater-text').data('name') + ']['+i+'][column]['+j+'][repeater_label]';
                    slug = 'option[' + indexOption + '][' + $(this).find('.input-value-repeater-text').data('name') + ']['+i+'][column]['+j+'][repeater_slug]';
                    value = 'option[' + indexOption + '][' + $(this).find('.input-slug-repeater-text').data('name') + ']['+i+'][column]['+j+'][repeater_value]';
                    $(this).find('.input-label-repeater-text').attr('name', label);
                    $(this).find('.input-slug-repeater-text').attr('name', slug);
                    $(this).find('.input-value-repeater-text').attr('name', value);
                });

                if (i >= 1) {
                    console.log($(this));
                    $(this).removeClass('repeater-list-input-0');
                    $(this).find('.btn-delete-item-input').removeClass('disabled')
                }
            });
            console.log('Đã thêm mới');
            notifcationAdded();
        });

        $(document).on('click', 'a.delete-item-repeate-update', function () {
            $(this).parents('.repeater-list-input').remove();
            console.log('Đã xoá');
            notifcationDeleted();
        });
        var portlet = new KTPortlet('.custom_kt-portlet');
    }


    var resetDataUpdateParentID = function () {
        $('.repeater_update_parent .append-repeater_list_parent .repeater-list-children').each(function (i) {
            $(this).attr('data-parent-id', i);
            $(this).find('.repeater-item-text').attr('data-id', i + i);
            $(this).find('.btn-add-item').attr('data-id', i + i);
            $(this).find('.btn-delete-item-input').attr('data-id', i + i);
            $(this).find('.btn-delete-item-parent').attr('data-parent-id', i);

            if (i > 0) {
                $(this).removeClass('repeater-list-children-0');
                $(this).find('.btn-delete-item-parent').removeClass('disabled');
            }
        });
    }
    var resetDataUpdateChildrenID = function () {
        $('.repeater_update_parent .repeater-item-text').each(function (i) {
            $(this).attr('data-id', i);
            $(this).find('.btn-delete-item-input').attr('data-id', i);
            if (i > 0) {
                $(this).removeClass('repeater-item-text-0');
                $(this).find('.btn-delete-item-input').removeClass('disabled');
            }
        });
    }

    $('.repeater_update_parent .append-repeater_list_parent').each(function (i) {
        $(this).attr('data-parent-id', i);
        $(this).find('.repeater-item-text').attr('data-id', i + i);
        $(this).find('.btn-add-item').attr('data-id', i + i);
        $(this).find('.btn-delete-item-input').attr('data-id', i + i);
        $(this).find('.btn-delete-item-parent').attr('data-parent-id', i);
    });
    let addNewItemRepeatImage = function () {
        $(document).on('click', 'a.btn-add-item-images', function () {
            var html_repeater = $('#hidden-input-image').find('.repeater-item-text').clone();
            $(this).parents('.repeater-list-group').find('repeater-list-input').append(html_repeater);
        });
    }
    return {
        init: function () {
            RepeaterOptions();
            createNewInputForRepeaterText();
            deleteInputForRepeaterText();
            createInputUpdate();
            addNewItemRepeatImage();
        }
    }
}();

jQuery(document).ready(function () {
    KTDatatablesPermission.init();
    KTSelect2Permission.init();
    KTFormPermissionUpdateForRole.init();
    PvtinhPermissionModal.init();
    PvtinhPermissionForUser.init();
    PvtinhUserManagement.init();
    PvtinhMenuManagement.init();
    PvtinhSliderManagement.init();
    PvtinhOptionManagement.init();
});


