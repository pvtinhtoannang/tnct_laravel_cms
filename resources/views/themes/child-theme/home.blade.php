<form action="{{route('ADD_FORM_DATA', 1)}}" class="contact-form-home" method="POST">
    @csrf
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
        </div>
        <input type="text" name="name" class="form-control" id="full_name_contact" placeholder="Họ tên:">
    </div>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></div>
        </div>
        <input type="text" name="phone" class="form-control" id="phone_contact" placeholder=" Số điện thoại:   ">
    </div>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
        </div>
        <input type="text" name="email" class="form-control" id="email_contact" placeholder="Email:">
    </div>

    <div class="form-group">
        <input type="text" name="company_name" id="companyName" placeholder="Tên công ty:" class="form-control"
               aria-describedby="companyName">
    </div>
    <div class="form-group">
        <input type="text" name="position" id="position" placeholder="Chức danh: " class="form-control"
               aria-describedby="position">
    </div>
    <div class="form-group">
        <input type="text" name="address" id="address" placeholder="Địa chỉ: " class="form-control"
               aria-describedby="address">
    </div>
    <div class="form-group">
        <input type="hidden" name="content_form">
        <select name="course" class="form-control">
            <option value="">Khoá học mong muốn:</option>
            <option value="Tên khoá học">Default 1</option>
            <option value="Tên khoá học">Default 2</option>
        </select>
    </div>
    <button type="submit">Hoàn tất</button>
</form>