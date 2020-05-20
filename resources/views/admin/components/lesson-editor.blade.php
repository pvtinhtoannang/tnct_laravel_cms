@inject('term_relationships', 'App\TermRelationships')
@inject('taxonomy', 'App\Taxonomy')
@inject('course', 'App\Course')
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
$course_id = '';
$uploads_url = url('/contents/uploads');
$video_link = '';
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
    if ($postData->thumbnail !== null) {
        $thumbnail_id = $postData->thumbnail->meta_value;
        $thumbnail_url = $uploads_url . '/' . $postData->thumbnail->attachment->meta->meta_value;
    }
    $course_id = $postData->meta()->where('meta_key', 'course_id')->first()->meta_value;
    $video = $postData->meta()->where('meta_key', 'video_link')->first();
    if (!is_null($video)) {
        $video_link = $video->meta_value;
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
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Dữ liệu bài học</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="form-group form-group-last">
                        <label for="video-link">Liên kết video</label>
                        <input class="form-control" type="text" id="video-link" name="video_link"
                               value="{{$video_link}}">
                    </div>
                </div>
            </div>
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
                        <?php
                        $in_course = $course->find($course_id);
                        if ($in_course) { ?>
                        <label>Khoá học: </label>
                        <h6 class="d-inline-block">{{$in_course->post_title}}</h6>
                        <?php } ?>
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
        </div>
    </div>
    <input type="hidden" name="post_type" value="{{$type}}">
    {{ csrf_field() }}
</form>
