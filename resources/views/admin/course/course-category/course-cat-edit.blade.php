@extends('admin.dashboard.dashboard-master')
@section('title', 'Chỉnh sửa chuyên mục')
@section('content')
    <h1 class="template-title">Chỉnh sửa chuyên mục</h1>
    <div class="row">
        <div class="col-md-5">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__body">
                    <h2 class="template-sub-title">Thêm chuyên mục</h2>
                    <form class="kt-form" id="category" method="post">
                        <div class="form-group">
                            <label for="term-name">Tên</label>
                            <input type="text" class="form-control" id="term-name" name="category_name" value="{{$categoryData->term->name}}" required>
                            <span class="form-text text-muted">Tên riêng sẽ hiển thị trên trang mạng của bạn.</span>
                        </div>
                        <div class="form-group">
                            <label for="term-slug">Chuỗi cho đường dẫn tĩnh</label>
                            <input type="text" class="form-control" id="term-slug" name="category_slug" value="{{$categoryData->term->slug}}" required>
                            <span class="form-text text-muted">Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</span>
                        </div>
                        <div class="form-group">
                            <label for="category-parent">Chuyên mục hiện tại</label>
                            <select class="form-control" id="category-parent" name="category_parent">
                                <option value="0">Trống</option>
                                @foreach($categories as $category)
                                    <option value="{{$category['term_id']}}"
                                            @if($categoryData->parent == $category['term_id']) selected @endif>{{$category['name']}}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-muted">Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục. Ví dụ: Trong chuyên mục nhạc, bạn có chuyên mục con là nhạc Pop, nhạc Jazz. Việc này hoàn toàn là tùy theo ý bạn.</span>
                        </div>
                        <div class="form-group">
                            <label for="category-description">Mô tả</label>
                            <textarea class="form-control" id="category-description" name="category_description"
                                      rows="5">{{$categoryData->description}}</textarea>
                        </div>
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection