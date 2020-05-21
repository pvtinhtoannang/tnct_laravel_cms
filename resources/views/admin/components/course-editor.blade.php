@inject('term_relationships', 'App\TermRelationships')
@inject('taxonomy', 'App\Taxonomy')
@inject('post', 'App\Post')
<?php
$post_title = '';
$post_content = '';
$post_name = '';
$type = '';
$excerpt = '';
$cats = array();
$tags = '';
$post_status = '';
$thumbnail_url = '';
$thumbnail_id = '';
$uploads_url = url('/contents/uploads');
$course_price = 0;
$course_sale_price = 0;
$course_hot = '';
$post_id = '';
?>

@isset($postData)
    {{--    @dump($postData)--}}
    <?php
    /** @var $postData */
    $post_id = $postData['ID'];
    $post_title = $postData['post_title'];
    $post_content = $postData['post_content'];
    $post_name = $postData['post_name'];
    $excerpt = $postData['post_excerpt'];
    $post_status = $postData['post_status'];
    foreach ($postData->taxonomies as $cat) {
        if ($cat->taxonomy === 'course_cat') {
            array_push($cats, $cat['term_taxonomy_id']);
        } else if ($cat->taxonomy === 'post_tag') {
            $tags = $tags . $cat->term->name . ',';
        }
    }
    if (!is_null($postData->thumbnail)) {
        $thumbnail_id = $postData->thumbnail->meta_value;
        $thumbnail_url = $uploads_url . '/' . $postData->thumbnail->attachment->meta->meta_value;
    }
    $price = $postData->price;
    if (!is_null($price)) {
        $course_price = $price->meta_value;
    }
    $sale_price = $postData->sale_price;
    if (!is_null($sale_price)) {
        $course_sale_price = $sale_price->meta_value;
    }
    $hot = $postData->hot;
    if (!is_null($hot)) {
        $course_hot = $hot->meta_value;
    }
    ?>
@endisset
<?php
if (isset($post_type)) {
    $type = $post_type;
} else {
    $type = $postData['post_type'];
}
?>
@if (session()->has('create'))
    <div class="alert alert-success" role="alert">
        <div class="alert-text">{{session('create')}}</div>
    </div>
@endif
@if (session()->has('update'))
    <div class="alert alert-success" role="alert">
        <div class="alert-text">{{session('update')}}</div>
    </div>
@endif
<form class="kt-form" id="post" method="post">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="post-title" hidden>Đường dẫn tĩnh: </label>
                <input type="text" name="post_title" id="post-title" class="form-control" placeholder="Thêm tiêu đề"
                       required value="{{$post_title}}">
            </div>
            <div class="form-group row post-link-row">
                <label for="post-name" class="col-form-label">Đường dẫn tĩnh: </label>
                <span class="post-link">{{url('/')}}/</span>
                <div class="col-6">
                    <input class="form-control" type="text" id="post-name" name="post_name" value="{{$post_name}}"
                           readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="post_content" hidden>Nội dung</label>
                <textarea class="summernote-post-content" id="post_content"
                          name="post_content">{{$post_content}}</textarea>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head kt-bg-primary">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Mô tả ngắn</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group form-group-last">
                        <label for="excerpt" hidden>Mô tả ngắn</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="4">{{$excerpt}}</textarea>
                    </div>
                </div>
            </div>
            @isset($postData)
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Xây dựng khoá học</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="ui-sortable" id="course-builder">
                            <?php
                            $course_builder = $postData->builder;
                            ?>
                            @if($course_builder)
                                <?php
                                $builderArray = json_decode($course_builder->meta_value, true);
                                ?>
                                @if(!is_null($builderArray))
                                    @foreach($builderArray as $builder)
                                        <?php
                                        /** @var $builder */
                                        $post_data = $post->find($builder['ID']);
                                        if ($post_data->post_type === 'section_heading') {
                                            $section_id = $post_data->ID;
                                        }
                                        ?>
                                        <div class="rkt-margin-b-10 course-builder-item">
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <label>
                                                        @if($post_data->post_type === 'lesson')
                                                            {{'Bài học'}}
                                                        @else
                                                            {{'Chương'}}
                                                        @endif
                                                    </label>
                                                </div>
                                                <div class="col-lg-10">
                                                    <input name="@if($post_data->post_type === 'lesson'){{'lesson'}}@else{{'section_heading'}}@endif"
                                                           type="text"
                                                           class="form-control form-control-danger course-builder-title"
                                                           placeholder="Nhập tiêu đề"
                                                           data-type="@if($post_data->post_type === 'lesson'){{'lesson'}}@else{{'section_heading'}}@endif"
                                                           data-post-name="{{$post_data->post_name}}"
                                                           data-id="{{$post_data->ID}}"
                                                           value="{{$post_data->post_title}}">
                                                </div>
                                                <div class="col-lg-2">
                                                         <span class="btn btn-danger btn-icon  @if($post_data->post_type === 'lesson') save-lesson @else save-section-heading @endif">
                                                            <i class="la la-save"></i>
                                                         </span>
                                                    <span class="btn btn-danger btn-icon sort-action">
                                                                   <i class="la la-arrows-alt"></i>
                                                        </span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="nowrap row-actions">
                                                        @if($post_data->post_type === 'lesson')
                                                            <a target="_blank"
                                                               href="{{url('/')."/".$post_data->post_name}}"
                                                               class="btn btn-sm btn-clean btn-icon btn-icon-md view-btn"
                                                               title="Xem">
                                                                <i class="la la-eye"></i>
                                                            </a>
                                                            <a target="_blank"
                                                               href="{{route('GET_EDIT_LESSON_ROUTE', $post_data->ID)}}"
                                                               class="btn btn-sm btn-clean btn-icon btn-icon-md edit-btn"
                                                               title="Chỉnh sửa">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                        @endif
                                                        <a href="javascript:;"
                                                           class="btn btn-sm btn-clean btn-icon btn-icon-md @if($post_data->post_type === 'lesson') delete-lesson @else delete-section-heading @endif"
                                                           title="Xoá">
                                                            <i class="la la-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                        <div class="d-block">
                            <div class="d-inline-block btn btn-primary" id="add-section-heading">Thêm chương</div>
                            <div class="d-inline-block btn btn-primary" id="add-lesson">Thêm bài học</div>
                            <div class="d-inline-block btn btn-success" id="save-builder">Lưu cấu trúc</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-3">
            <div class="kt-portlet">
                <div class="kt-portlet__head kt-bg-primary">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Đăng</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group">
                        <label for="post-status">Trạng thái</label>
                        <select class="form-control" id="post-status" name="post_status">
                            <option value="publish" @if($post_status === 'publish') {{'selected'}} @endif>Đã xuất bản
                            </option>
                            <option value="pending" @if($post_status === 'pending') {{'selected'}} @endif>Chờ duyệt
                            </option>
                            <option value="draft" @if($post_status === 'draft') {{'selected'}} @endif>Bản nháp</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="course-price">Giá</label>
                        <input class="form-control" type="number" id="course-price" name="course_price"
                               value="{{$course_price}}" min="0">
                    </div>
                    <div class="form-group">
                        <label for="course-sale-price">Giá khuyến mãi</label>
                        <input class="form-control" type="number" id="course-sale-price" name="course_sale_price"
                               value="{{$course_sale_price}}" min="0">
                    </div>
                    <div class="form-group-last">
                        <label class="kt-checkbox">
                            <input name="course_hot" type="checkbox" value="hot"
                                   @if($course_hot === 'hot') checked @endif> Dánh dấu nổi bật
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                    <button class="btn btn-primary" type="submit">
                        @if(!isset($postData))
                            Đăng
                        @else
                            Cập nhật
                        @endif
                    </button>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head kt-bg-primary">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Chuyên mục</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-checkbox-list">
                        <div id="category-list">
                            <ul class="categorychecklist">
                                @foreach($taxonomy->parent_id(0)->name('course_cat')->get() as $term)
                                    <li>
                                        <label class="kt-checkbox">
                                            <input name="post_category[]" type="checkbox"
                                                   value="{{$term->term_id}}" @if(in_array($term->term_id, $cats)) {{'checked'}} @endif> {{$term->term->name}}
                                            <span></span>
                                        </label>
                                        @include('admin.components.course-cat-children', ['parent' => $term->term_id])
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-bg-primary">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Ảnh đại diện</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions">
                            <a href="#" data-toggle="modal" data-target="#featured-image-modal"
                               class="btn btn-outline-light btn-sm btn-icon btn-icon-md">
                                <i class="flaticon2-add-1"></i>
                            </a>
                            <a id="remove-thumbnail" href="#" data-toggle="modal"
                               class="btn btn-outline-light btn-sm btn-icon btn-icon-md">
                                <i class="flaticon2-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="featured-image">
                        @if($thumbnail_url !== '')
                            <img src="{{$thumbnail_url}}"/>
                        @endif
                    </div>
                    <input type="hidden" id="thumbnail_id" name="thumbnail_id" value="{{$thumbnail_id}}">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="post_type" value="{{$type}}">
    <input type="hidden" id="course_id" value="{{$post_id}}">
    {{ csrf_field() }}
</form>
