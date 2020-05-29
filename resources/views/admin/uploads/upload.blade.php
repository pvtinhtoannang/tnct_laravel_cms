@extends('admin.dashboard.dashboard-master')
@section('title', 'Thư viện')
@section('content')
    <h1 class="template-title">Thư viện</h1>
    <ul class="attachments upload-template">

    </ul>
    <div class="modal fade media-modal" id="media-modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết đính kèm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="attachment-media-wrapper">
                        <div class="left-content">
                            <div class="attachment-media-view">
                                <div class="thumbnail-image">
                                    <img class="details-image" src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="right-content">
                            <div class="attachment-info">
                                <ul class="info">

                                </ul>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Tiêu đề</label>
                                            <div class="col-9">
                                                <input class="form-control" type="text" id="attachment-name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-3 col-form-label">Chú thích</label>
                                            <div class="col-9">
                                                <input class="form-control" type="text" id="attachment-caption">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-email-input" class="col-3 col-form-label">Mô tả</label>
                                            <div class="col-9">
                                                <input class="form-control" type="text" id="attachment-description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-3 col-form-label">Tải lên bởi</label>
                                            <div class="col-9">
                                                <input class="form-control" type="url" id="attachment-upload-by" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-url-input" class="col-3 col-form-label">Sao chép liên kết</label>
                                            <div class="col-9">
                                                <input class="form-control" type="url" id="attachment-url" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="reset" class="btn btn-success">Cập nhật</button>
                                            <button type="reset" class="btn btn-outline-danger">Xoá</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
