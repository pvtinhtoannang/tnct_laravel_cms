@if($users_data)
    <form action="{{ route('UPDATE_PASSWORD') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email_update_password">Email của bạn</label>
            <input type="email" id="email_update_password" name="email" value="{{ $users_data->email }}"
                   class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="password_update">Mật khẩu mới</label>
            <input type="password" required minlength="8" id="password_update" name="password" value=""
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirm_update">Xác nhận mật khẩu mới</label>
            <input type="password" required minlength="8" id="password_confirm_update" name="password_confirm" value=""
                   class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
@endif