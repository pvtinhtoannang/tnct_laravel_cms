@extends('themes.parent-theme.initialize')
@section('header')
    @include('themes.child-theme.header')
@endsection
@section('content')
    @if($users_data)
        <section class="mn-khkt-account">
            <div class="container">
                @if ($message = Session::get('messages'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('errors'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="col-left-account">
                            <div class="user-avatar">
                                <div class="user-avatar-inner">
                                    @if(!empty($users_data->avatar))
                                        <img src="/assets/media/users/100_1.jpg" alt="">
                                    @else
                                        <span>{{ $avatar_text }}</span>
                                    @endif
                                </div>
                            </div>
                            <p class="text-center user-name">{{ $users_data->name }}</p>


                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                   role="tab" aria-controls="v-pills-home" aria-selected="true">Tài khoản</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                   role="tab" aria-controls="v-pills-profile" aria-selected="false">Đổi mật khẩu</a>
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                   href="#v-pills-messages"
                                   role="tab" aria-controls="v-pills-messages" aria-selected="false">Tin nhắn</a>
                                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill"
                                   href="#v-pills-settings"
                                   role="tab" aria-controls="v-pills-settings" aria-selected="false">Cài đặt</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="col-right-account">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                     aria-labelledby="v-pills-home-tab">
                                    <h2 class="title-account text-center">Tài khoản</h2>
                                    <form action="">
                                        <div class="form-group">
                                            <label for="name">Tên của bạn</label>
                                            <input type="text" name="name" value="{{ $users_data->name  }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email của bạn</label>
                                            <input type="email" name="email" value="{{ $users_data->email  }}"
                                                   class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Ảnh đại diện</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" accept="image/*"
                                                       value="{{ $users_data->avatar }}" id="customFile">
                                                <label class="custom-file-label"
                                                       for="customFile">
                                                    @if(!empty($users_data->avatar))
                                                        {{ $users_data->avatar }}
                                                    @else
                                                        Chọn file
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                     aria-labelledby="v-pills-profile-tab">
                                    <h2 class="title-account text-center">Đổi mật khẩu</h2>
                                    @include ('themes.child-theme.components.update-password')
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                     aria-labelledby="v-pills-messages-tab">
                                    <div class="alert alert-primary" role="alert">
                                        This is a primary alert—check it out!
                                    </div>
                                    <div class="alert alert-secondary" role="alert">
                                        This is a secondary alert—check it out!
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        This is a success alert—check it out!
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                        This is a danger alert—check it out!
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        This is a warning alert—check it out!
                                    </div>
                                    <div class="alert alert-info" role="alert">
                                        This is a info alert—check it out!
                                    </div>
                                    <div class="alert alert-light" role="alert">
                                        This is a light alert—check it out!
                                    </div>
                                    <div class="alert alert-dark" role="alert">
                                        This is a dark alert—check it out!
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                     aria-labelledby="v-pills-settings-tab">
                                    <div class="alert alert-primary" role="alert">
                                        This is a primary alert—check it out!
                                    </div>
                                    <div class="alert alert-secondary" role="alert">
                                        This is a secondary alert—check it out!
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        This is a success alert—check it out!
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                        This is a danger alert—check it out!
                                    </div>
                                    <div class="alert alert-warning" role="alert">
                                        This is a warning alert—check it out!
                                    </div>
                                    <div class="alert alert-info" role="alert">
                                        This is a info alert—check it out!
                                    </div>
                                    <div class="alert alert-light" role="alert">
                                        This is a light alert—check it out!
                                    </div>
                                    <div class="alert alert-dark" role="alert">
                                        This is a dark alert—check it out!
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('footer')
    @include('themes.child-theme.footer')
@endsection