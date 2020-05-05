@inject('term_relationships', 'App\TermRelationships')
@inject('taxonomy', 'App\Taxonomy')
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
        if ($cat->taxonomy === 'category') {
            array_push($cats, $cat['term_taxonomy_id']);
        } else if ($cat->taxonomy === 'post_tag') {
            $tags = $tags . $cat->term->name . ',';
        }
    }
    if ($postData->thumbnail !== null) {
        $thumbnail_id = $postData->thumbnail->meta_value;
        $thumbnail_url = $uploads_url . '/' . $postData->thumbnail->attachment->meta->meta_value;
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
                <label for="post_title" hidden>Đường dẫn tĩnh: </label>
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
            @if($type === 'post')
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
            @if($type === 'post')
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
                                    @foreach($taxonomy->parent_id(0)->category()->get() as $term)
                                        <li>
                                            <label class="kt-checkbox">
                                                <input name="post_category[]" type="checkbox"
                                                       value="{{$term->term_id}}" @if(in_array($term->term_id, $cats)) {{'checked'}} @endif> {{$term->term->name}}
                                                <span></span>
                                            </label>
                                            @include('admin.components.category-children', ['parent' => $term->term_id])
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Thẻ</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last">
                            <label for="post-tag" hidden>Thêm thẻ</label>
                            <input type="text" class="form-control" id="post-tag" name="post_tag" data-role="tagsinput"
                                   value="{{$tags}}">
                            <span class="form-text text-muted">Phân cách các thẻ bằng dấu phẩy (,).</span>
                        </div>
                    </div>
                </div>
            @endif

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
    {{ csrf_field() }}
</form>
