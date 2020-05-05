@extends('admin.dashboard.dashboard-master')
@section('title', 'Bài viết')
@section('content')
    <h1 class="template-title">Bài viết</h1>
    <ul class="post-status">
        <li @if(Request::route()->status === null) class="active" @endif>
            <a href="{{route('GET_POSTS_ROUTE')}}">Tất cả</a> <span>({{$count['all']}})</span>
        </li>
        @if($count['publish'] !== 0)
            <li @if(Request::route()->status === 'publish') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'publish')}}">Đã xuất bản</a> <span>({{$count['publish']}})</span>
            </li>
        @endif
        @if($count['draft'] !== 0)
            <li @if(Request::route()->status === 'draft') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'draft')}}">Bản nháp</a> <span>({{$count['draft']}})</span>
            </li>
        @endif
        @if($count['pending'] !== 0)
            <li @if(Request::route()->status === 'pending') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'pending')}}">Chờ duyệt</a> <span>({{$count['pending']}})</span>
            </li>
        @endif
        @if($count['trash'] !== 0)
            <li @if(Request::route()->status === 'trash') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'trash')}}">Thùng rác</a> <span>({{$count['trash']}})</span>
            </li>
        @endif
    </ul>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Bài viết
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('GET_CREATE_POST_ROUTE')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Viết bài mới
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped table-hover tnct-table {{Request::route()->status}}" id="posts">
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Chuyên mục</th>
                    <th>Thẻ</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($postData as $post)
                    <tr>
                        <td class="kt-font-bold">
                            @if($post->post_status != 'trash')
                                <a href="{{route('GET_EDIT_POST_ROUTE', $post->ID)}}">{{$post->post_title}}</a>
                            @else
                                {{$post->post_title}}
                            @endif
                            @if($post->post_status == 'draft')
                                <span class="post-status"> - Bản nháp</span>
                            @elseif($post->post_status == 'pending')
                                <span class="post-status"> - Chờ duyệt</span>
                            @endif
                            <div class="nowrap row-actions">
                                <a target="_blank" href="{{url('/')."/".$post->post_name}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md view-btn" title="Xem">
                                    <i class="la la-eye"></i>
                                </a>
                                <a href="{{route('GET_EDIT_POST_ROUTE', $post->ID)}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md edit-btn" title="Chỉnh sửa">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="{{route('GET_ACTION_RESTORE_POST_ROUTE', $post->ID)}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md restore-btn" title="Phục hồi">
                                    <i class="la la-rotate-left"></i>
                                </a>
                                @if($post->post_status != 'trash')
                                    <a href="{{route('GET_ACTION_TRASH_POST_ROUTE', $post->ID)}}"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Bỏ vào thùng rác">
                                        <i class="la la-trash"></i>
                                    </a>
                                @else
                                    <a href="{{route('GET_ACTION_DELETE_POST_ROUTE', $post->ID)}}"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Xoá vĩnh viễn">
                                        <i class="la la-trash"></i>
                                    </a>
                                @endif

                            </div>
                        </td>
                        <td>{{$post->author->name}}</td>
                        <td class="categories">
                            @foreach($post->taxonomies as $cat)
                                @if($cat->taxonomy === 'category')
                                    <a class="" href="">{{$cat->term->name}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td class="tags">
                            @foreach($post->taxonomies as $cat)
                                @if($cat->taxonomy === 'post_tag')
                                    <a class="" href="">{{$cat->term->name}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($post->post_status == 'publish')
                                Đã xuất bản
                                <br>
                                {{date_format(date_create($post->created_at),"d/m/Y")}}
                            @else
                                Sửa đổi lần cuối
                                <br>
                                {{date_format(date_create($post->updated_at),"d/m/Y")}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
@endsection
