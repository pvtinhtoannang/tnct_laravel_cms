Xin chào <i>{{ $requestEmail->email }}</i>,
<p>Liên kết dưới đây là liên kết dùng để khôi phục lại mật khẩu của bạn tại Website Khoá Học Kế Toán:</p>
<p>Bấm vào liên kết này để khôi phục mật khẩu <a href="{{ $requestEmail->link  }}">{{ $requestEmail->link  }}</a></p>
<div>
    <p>Nếu không phải là bạn yêu cầu vui lòng bỏ qua email này!</p>
</div>
Cảm ơn!,
<br/>