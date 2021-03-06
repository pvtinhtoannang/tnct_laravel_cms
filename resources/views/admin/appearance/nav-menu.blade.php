@extends('admin.dashboard.dashboard-master')
@section('title', 'Quản lý menu')
@section('content')
    @if(!empty($menu_id))
        <input type="hidden" id="postion_menu" value="{{ $menu_id }}">
    @else
        <input type="hidden" id="postion_menu" value="{{ $menus_editing->id }}">
    @endif
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <div class="form-group ">
                <label for="menus_group">Chọn menu để sửa</label>
                <div class="input-group">
                    <select name="#" class="form-control" id="menus_group">
                        @foreach($position_menu as $menus_item_pos)
                            <option value="{{$menus_item_pos->id}}"
                                    @if(!empty($menu_id) && $menu_id == $menus_item_pos->id) selected
                                @endif>{{$menus_item_pos->display_name}} - {{ $menus_item_pos->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-edit-menu" type="button">Sửa!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-brand" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#menu_tab_1" role="tab"><i
                    class="flaticon-cogwheel-1"></i>
                Sửa menu</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu_tab_2" role="tab"><i class="flaticon-layers"></i>
                Quản lý vị trí menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu_tab_3" role="tab"><i class="flaticon-support"></i>
                Hướng dẫn</a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="menu_tab_1" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Thêm liên kết
                                </h3>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <!--begin::Accordion-->
                            <div class="accordion  accordion-toggle-arrow" id="side-sortables">
                                <div class="card">
                                    <div class="card-header" id="headingOne4">
                                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne4"
                                             aria-expanded="true" aria-controls="collapseOne4">
                                            <i class="flaticon2-layers-1"></i> Trang
                                        </div>
                                    </div>
                                    <div id="collapseOne4" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <!--begin::Portlet-->
                                                <label for="menu_pages">Chọn một hoặc nhiều trang</label>
                                                <select multiple class="form-control m-select2" id="menu_pages"
                                                        name="menu_pages[]">
                                                    <option></option>
                                                    @foreach($pages as $page)
                                                        <option
                                                            value="{{ $page->post_name }}">{{ $page->post_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-brand btn-elevate btn-elevate-air btn-add-pages-to-menu">
                                                Thêm vào menu
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingTwo4">
                                        <div class="card-title collapsed" data-toggle="collapse"
                                             data-target="#collapseTwo4" aria-expanded="false"
                                             aria-controls="collapseTwo4">
                                            <i class="flaticon2-copy"></i> Bài viết
                                        </div>
                                    </div>
                                    <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo1"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <!--begin::Portlet-->
                                                <label for="menu_posts">Chọn một hoặc nhiều bài viết</label>

                                                <select multiple="multiple" class="form-control m-select2 d-block"
                                                        style="width: 100%" id="menu_posts" name="menu_posts[]">
                                                    <option></option>
                                                    @foreach($posts as $post)
                                                        <option
                                                            value="{{ $post->post_name }}">{{ $post->post_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-brand btn-elevate btn-elevate-air btn-add-post-to-menu">
                                                Thêm
                                                vào menu
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree4">
                                        <div class="card-title collapsed" data-toggle="collapse"
                                             data-target="#collapseThree4" aria-expanded="false"
                                             aria-controls="collapseThree4">
                                            <i class="flaticon2-link"></i> Liên kết tự tạo
                                        </div>
                                    </div>
                                    <div id="collapseThree4" class="collapse" aria-labelledby="headingThree1"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="custom_link_url">URL</label>
                                                <input id="custom_link_url" name="custom_link_url" type="text"
                                                       class="form-control" aria-describedby="custom link"
                                                       placeholder="https://">
                                            </div>
                                            <div class="form-group">
                                                <label for="custom_link_name">Tên đường dẫn</label>
                                                <input id="custom_link_name" type="text" name="custom_link_name"
                                                       class="form-control" aria-describedby="name"
                                                       placeholder="Tên đường dẫn">
                                            </div>
                                            <button type="button"
                                                    class="btn btn-brand btn-elevate btn-elevate-air btn-add-custom-link-to-menu">
                                                Thêm
                                                vào menu
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree5">
                                        <div class="card-title collapsed" data-toggle="collapse"
                                             data-target="#collapseThree5" aria-expanded="false"
                                             aria-controls="collapseThree5">
                                            <i class="flaticon-notes"></i> Danh mục sản phẩm
                                        </div>
                                    </div>
                                    <div id="collapseThree5" class="collapse" aria-labelledby="headingThree1"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            CHƯA CÓ CÁI GÌ Ở ĐÂY
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree6">
                                        <div class="card-title collapsed" data-toggle="collapse"
                                             data-target="#collapseThree6" aria-expanded="false"
                                             aria-controls="collapseThree6">
                                            <i class="flaticon-price-tag"></i> Thẻ
                                        </div>
                                    </div>
                                    <div id="collapseThree6" class="collapse" aria-labelledby="headingThree1"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <!--begin::Portlet-->
                                                <select class="form-control m-select2 d-block"
                                                        style="width: 100%" multiple id="menu_tags"
                                                        name="menu_tags[]">
                                                    <option></option>
                                                    @foreach($tags as $tag)
                                                        <option
                                                            value="{{ $tag->term->slug }}">{{ $tag->term->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-brand btn-elevate btn-elevate-air btn-add-tag-to-menu">
                                                Thêm
                                                vào menu
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingTwo7">
                                        <div class="card-title collapsed" data-toggle="collapse"
                                             data-target="#collapseTwo7" aria-expanded="false"
                                             aria-controls="collapseTwo7">
                                            <i class="flaticon-list"></i> Chuyên mục
                                        </div>
                                    </div>
                                    <div id="collapseTwo7" class="collapse" aria-labelledby="headingTwo1"
                                         data-parent="#side-sortables">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <!--begin::Portlet-->
                                                <select class="form-control m-select2 d-block"
                                                        style="width: 100%" multiple id="menu_categories"
                                                        name="menu_categories[]">

                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->term->slug }}">{{ $category->term->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button"
                                                    class="btn btn-brand btn-elevate btn-elevate-air btn-add-category-to-menu">
                                                Thêm
                                                vào menu
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end::Accordion-->
                        </div>
                    </div>

                    <!--end::Portlet-->

                </div>
                <div class="col-xs-12 col-md-9">
                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Cấu trúc menu -
                                    {{ $menus_editing->display_name }}
                                </h3>
                            </div>
                        </div>
                        <input type="hidden" id="nestable-output">
                        <style>
                            .dd ol {
                                list-style: none;
                            }

                            .dd-item {
                                border: 1px solid #f2f3f8;
                                padding: 5px 0 5px 30px;
                                background: #f2f3f8;
                                margin-bottom: 5px;
                                font-weight: 700;
                                cursor: move;
                                -webkit-transition: all .3s ease-in-out;
                                -moz-transition: all .3s ease-in-out;
                                -ms-transition: all .3s ease-in-out;
                                -o-transition: all .3s ease-in-out;
                                transition: all .3s ease-in-out;
                                position: relative;
                                line-height: 40px;
                                border-radius: 4px;
                            }

                            .dd-handle {
                            }

                            .dd-item button {
                                background: transparent;
                                border: magenta;
                                position: absolute;
                                float: right;
                                right: 65px;
                                font-size: 20px;
                                top: 0;
                            }

                            .dd-placeholder {
                                background-color: #f2f3f8;
                            }

                            .dd-item a {
                                float: right;
                                padding: 0 10px;
                            }

                            .dd-item .dd-item {
                                background: #5c78ff;
                                color: #FFF;
                            }

                            .dd-item .dd-item a {
                                color: #FFF;
                            }

                            .dd > .dd-list {
                                padding-left: 0;
                            }
                        </style>
                        <div class="kt-portlet__body">
                            <div class="form-group">

                                <div class="dd">
                                    <ol class="dd-list dd-list-parent">
                                        @foreach($menus as $menu)
                                            <li data-SortOrder="{{ $menu['sort'] }}" class="dd-item"
                                                data-id="{{$menu['id']}}">
                                                <span class="dd-handle"><i class="fa fa-arrows-alt"></i></span>
                                                <span class="dd3-content">
                                                    <span data-id="{{$menu['id']}}">{{$menu['label']}}</span>
                                                        <a class="edit-button" data-id="{{$menu['id']}}"
                                                           data-label="{{$menu['label']}}" href="javascript:;"
                                                           data-link="{{$menu['link']}}" data-toggle="modal"
                                                           data-target="#modalEditMenuItem"><i
                                                                class="flaticon-edit"></i></a>
                                                        <a class="del-button" href="javascript:;"
                                                           data-id="{{$menu['id']}}"><i
                                                                class="flaticon-delete"></i></a>
                                                </span>
                                                @if(!empty($menu->childrenMenus)  && sizeof($menu->childrenMenus) > 0)
                                                    <ol class="dd-list">
                                                        @foreach ($menu->childrenMenus->sortBy('sort') as $menu_sub)
                                                            @include('admin.components.nav-children', ['menu' => $menu_sub])
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Modal-->
                    <div class="modal fade" id="modalEditMenuItem" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form id="editMenuItem">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sửa menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="menu-id" class="form-control-label">Menu ID</label>
                                            <input type="text" class="form-control" readonly id="menu-id" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="menu-url" class="form-control-label">Menu URL</label>
                                            <input type="text" class="form-control" id="menu-url" value="">
                                            <span class="form-text text-muted kt-font-danger">Lưu ý: Nên cân nhắc việc thay đổi đường dẫn có thể ảnh hưởng đến liên kết SEO cũng như có thể phát sinh lỗi không tìm thấy trang (404 Not Found)</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="url-name" class="form-control-label">Tên đường dẫn</label>
                                            <input type="text" value="" class="form-control" id="url-name">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                        </button>
                                        <button type="button" class="btn btn-primary btn-save-editMenuItem">Lưu lại
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end::Modal-->
                    <!--end::Portlet-->

                </div>
            </div>
        </div>
        <div class="tab-pane " id="menu_tab_2" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Thêm vị trí mới</h2>
                    <form class="kt-form" method="POST" action="{{route('POST_ADD_NEW_MENU_POSITION')}}">
                        @csrf
                        <div class="hidden"></div>
                        <div class="kt-portlet__body">
                            <div class="form-group form-group-last">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($message = Session::get('messages'))
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                                        <div class="alert-text">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Nhãn</label>
                                <input id="name" type="text"
                                       name="name" class="form-control"
                                       aria-describedby="name"
                                       value="{{ old('name') }}"
                                       placeholder="Nhập tên, hông có được viết dấu, ex: primary_menu, primary-menu">
                            </div>
                            <div class="form-group">
                                <label for="display_name">Tên hiển thị</label>
                                <input id="display_name" type="text"
                                       name="display_name" class="form-control"
                                       aria-describedby="display_name"
                                       value="{{ old('display_name') }}"
                                       placeholder="Nhập tên, viết dấu cho dễ đọc, ex: Menu chính">
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-md-8">

                    <!-- begin:: Content -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Danh sách menu
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Trở lại trang trước
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">

                                <table class="table table-striped table-hover tnct-table" id="permission">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nhãn</th>
                                        <th>Tên hiển thị</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($position_menu as $key => $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td class="kt-font-bold">{{$value->name}}
                                                <div class="nowrap row-actions">
                                                    <a href="{{ route('GET_NAV_MENU_BY_ID', $value->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="Xem">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-edit-menu-position btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="Chỉnh sửa" data-toggle="modal" data-id="{{ $value->id }}"
                                                       data-target="#kt_modal_update_users">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="#"
                                                       class="btn btn-sm btn-clean btn-icon btn-icon-md "
                                                       title="Xoá">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{$value->display_name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Modal-->
                        <div class="modal fade" id="kt_modal_update_users" tabindex="-1" role="dialog"
                             aria-labelledby="modalUpdatePermission" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateUserLabelHeading">Cập nhật vị trí menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="hidden"></div>
                                        <div class="kt-portlet__body">

                                            <div class="form-group">
                                                <label for="update_name">Nhãn</label>
                                                <input required id="update_name" type="text"
                                                       name="name" class="form-control"
                                                       aria-describedby="name"
                                                       value=""
                                                       placeholder="Nhập tên, hông có được viết dấu, ex: primary_menu, primary-menu">
                                            </div>
                                            <div class="form-group">
                                                <label for="update_display_name">Tên hiển thị</label>
                                                <input required id="update_display_name" type="text"
                                                       name="display_name" class="form-control"
                                                       aria-describedby="display_name"
                                                       value=""
                                                       placeholder="Nhập tên, viết dấu cho dễ đọc, ex: Menu chính">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="" id="update_id" name="id">
                                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng
                                        </button>
                                        <button class="btn btn-primary btn-save-menu-position">Lưu lại
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--end::Modal-->
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>
        </div>

        <div class="tab-pane" id="menu_tab_3" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Chọn menu để sửa
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <ul>
                                <li>Menu mặc định là menu cuối cùng được tạo</li>
                                <li>Chọn danh sách menu đang có của website và bấm sửa để sửa lại menu mong muốn</li>
                                <li>Lưu ý: Mọi hành động sẽ tự động lưu lại</li>
                            </ul>
                        </div>
                    </div>

                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Sửa menu
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <ul>
                                <li><strong>Thêm liên kết</strong></li>
                                <li>
                                    <ul>
                                        <li>Trang: Bấm vào input để tìm một hoặc nhiều trang sau đó bấm <strong
                                                class="kt-font-danger">Thêm vào menu</strong></li>
                                        <li>Bài viết: Bấm vào input để tìm một hoặc nhiều bài viết sau đó bấm <strong
                                                class="kt-font-danger">Thêm vào menu</strong></li>
                                        <li>Thẻ: Bấm vào input để tìm một hoặc nhiều Thẻ sau đó bấm <strong
                                                class="kt-font-danger">Thêm vào menu</strong></li>
                                        <li>Chuyên mục: Bấm vào input để tìm một hoặc nhiều chuyên mục sau đó bấm
                                            <strong class="kt-font-danger">Thêm vào menu</strong></li>
                                        <li>Liên kết tự tạo: Điền URL và tên đường dẫn sau đó bấm <strong
                                                class="kt-font-danger">Thêm vào menu</strong></li>
                                    </ul>
                                </li>
                                <li><strong>Cấu trúc menu</strong></li>
                                <li>
                                    <ul>
                                        <li>Cấu trúc menu có thể kéo lên xuống</li>
                                        <li>Muốn kéo được bạn vui lòng bấm chuột vào muỗi tên 4 góc và bắt đầu kéo</li>
                                        <li>Kéo 1 menu từ dưới lên trên và qua phải một tí để tạo thành menu cấp 2 và
                                            cấp 3
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Quản lý vị trí menu
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <ul>
                                <li>Cột trái có thể thêm vị trí menu mới</li>
                                <li>Lưu ý các vị trí cần có nhãn và tên hiển thị, các nhãn lập trình viên sẽ dùng</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
