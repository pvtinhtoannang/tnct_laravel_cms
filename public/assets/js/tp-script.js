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
            placeholder: "Chọn một hoặc chuyên mục"
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
    var handleAddMenuItemForPages = function () {
        $('.btn-add-pages-to-menu').click(function () {
            var data = $('#menu_pages').select2('data');
            var __token = $('form#editMenuItem input[name="_token"]').val();
            $.each(data, function (key, value) {
                var label = value.text;
                var link = value.id;
                var html = '';
                $.ajax({
                    method: "POST",
                    url: "/admin/ajax-add-menu",
                    data: {_token: __token, label: label, link: link, position: 1}
                })
                    .done(function (res) {
                        var id_html = res.id;
                        var label_html = res.label;
                        var label_link = res.link;
                        console.log(id_html);
                        if(id_html !== undefined){
                            html = '<li class="dd-item" data-id="' + id_html + '">\n' +
                                '    <span class="dd-handle"><i class="fa fa-list"></i></span>\n' +
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
            }

        });
    }


    return {
        init: function () {
            createSelect2MenuPages();
            createSelect2MenuPosts();
            createSelect2MenuTags();
            createSelect2MenuCategories();
            createStructMenu();
            handleAddMenuItemForPages();
            handleEditMenuItem();
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
});


