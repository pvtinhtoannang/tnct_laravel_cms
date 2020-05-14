<div class="row">
    <div class="col-md-5">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <h2 class="template-sub-title">Thêm chuyên mục</h2>
                <form class="kt-form" id="category" method="post">
                    <div class="form-group">
                        <label for="term-name">Tên</label>
                        <input type="text" class="form-control" id="term-name" name="category_name" required>
                        <span class="form-text text-muted">Tên riêng sẽ hiển thị trên trang mạng của bạn.</span>
                    </div>
                    <div class="form-group">
                        <label for="term-slug">Chuỗi cho đường dẫn tĩnh</label>
                        <input type="text" class="form-control" id="term-slug" name="category_slug" required>
                        <span class="form-text text-muted">Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</span>
                    </div>
                    <div class="form-group">
                        <label for="category-parent">Chuyên mục hiện tại</label>
                        <select class="form-control" id="category-parent" name="category_parent">
                            <option value="0">Trống</option>
                            @foreach($categories as $category)
                                <option value="{{$category['term_id']}}"
                                        @if(old('category_parent') == $category['term_id']) selected @endif>{{$category['name']}}</option>
                            @endforeach
                        </select>
                        <span class="form-text text-muted">Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục. Ví dụ: Trong chuyên mục nhạc, bạn có chuyên mục con là nhạc Pop, nhạc Jazz. Việc này hoàn toàn là tùy theo ý bạn.</span>
                    </div>
                    <div class="form-group">
                        <label for="category-description">Mô tả</label>
                        <textarea class="form-control" id="category-description" name="category_description"
                                  rows="5"></textarea>
                    </div>
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Thêm chuyên mục</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped table-hover tnct-table" id="categories">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Chuỗi cho đường dẫn tĩnh</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="kt-font-bold">{{$category['name']}}
                                <div class="nowrap row-actions">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-trash"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                @if($category['description'] == '')
                                    {{'Không có mô tả'}}
                                @else
                                    {{$category['description']}}
                                @endif
                            </td>
                            <td>{{$category['slug']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
