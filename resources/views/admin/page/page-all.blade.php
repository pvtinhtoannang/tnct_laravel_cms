@extends('admin.dashboard.dashboard-master')
@section('title', 'Trang')
@section('content')
    <h1 class="template-title">Trang</h1>
    <ul class="post-status">
        <li @if(Request::route()->status === null) class="active" @endif>
            <a href="{{route('GET_PAGES_ROUTE')}}">Tất cả</a> <span>({{$count['all']}})</span>
        </li>
        @if($count['publish'] !== 0)
            <li @if(Request::route()->status === 'publish') class="active" @endif>
                <a href="{{route('GET_PAGES_ROUTE', 'publish')}}">Đã xuất bản</a> <span>({{$count['publish']}})</span>
            </li>
        @endif
        @if($count['draft'] !== 0)
            <li @if(Request::route()->status === 'draft') class="active" @endif>
                <a href="{{route('GET_PAGES_ROUTE', 'draft')}}">Bản nháp</a> <span>({{$count['draft']}})</span>
            </li>
        @endif
        @if($count['pending'] !== 0)
            <li @if(Request::route()->status === 'pending') class="active" @endif>
                <a href="{{route('GET_PAGES_ROUTE', 'pending')}}">Chờ duyệt</a> <span>({{$count['pending']}})</span>
            </li>
        @endif
        @if($count['trash'] !== 0)
            <li @if(Request::route()->status === 'trash') class="active" @endif>
                <a href="{{route('GET_PAGES_ROUTE', 'trash')}}">Thùng rác</a> <span>({{$count['trash']}})</span>
            </li>
        @endif
    </ul>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Trang
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('GET_CREATE_PAGE_ROUTE')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Thêm trang mới
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
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td class="kt-font-bold">
                            @if($page->post_status != 'trash')
                                <a href="{{route('GET_EDIT_PAGE_ROUTE', $page->ID)}}">{{$page->post_title}}</a>
                            @else
                                {{$page->post_title}}
                            @endif
                            @if($page->post_status == 'draft')
                                <span class="post-status"> - Bản nháp</span>
                            @elseif($page->post_status == 'pending')
                                <span class="post-status"> - Chờ duyệt</span>
                            @endif
                            <div class="nowrap row-actions">
                                <a target="_blank" href="{{url('/')."/".$page->post_name}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md view-btn" title="Xem">
                                    <i class="la la-eye"></i>
                                </a>
                                <a href="{{route('GET_EDIT_PAGE_ROUTE', $page->ID)}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md edit-btn" title="Chỉnh sửa">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="{{route('GET_ACTION_RESTORE_PAGE_ROUTE', $page->ID)}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md restore-btn" title="Phục hồi">
                                    <i class="la la-rotate-left"></i>
                                </a>
                                @if($page->post_status != 'trash')
                                    <a href="{{route('GET_ACTION_TRASH_PAGE_ROUTE', $page->ID)}}"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Bỏ vào thùng rác">
                                        <i class="la la-trash"></i>
                                    </a>
                                @else
                                    <a href="{{route('GET_ACTION_DELETE_PAGE_ROUTE', $page->ID)}}"
                                       class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Xoá vĩnh viễn">
                                        <i class="la la-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>{{$page->author->name}}</td>
                        <td>
                            @if($page->post_status == 'publish')
                                Đã xuất bản
                                <br>
                                {{date_format(date_create($page->created_at),"d/m/Y")}}
                            @else
                                Sửa đổi lần cuối
                                <br>
                                {{date_format(date_create($page->updated_at),"d/m/Y")}}
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
