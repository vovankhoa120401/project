
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="<?php echo $config['baseUrl']?>/admin/user/controller/indexController.php" method="post">
                <div class="form-group">
                    <label for="name">username</label>
                    <input class="form-control" type="text" name="userName" id="userName">
                </div>

                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="fullname" id="fullname">
                </div>

                <div class="form-group">
                    <label for="email">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ</label>
                    <input class="form-control" type="text" name="address" id="address">
                </div>

                <div class="form-group">
                    <label for="email">Ngày sinh</label>
                    <input class="form-control" type="date" name="birthday" id="birthday">
                </div>

                <div class="form-group">
                    <label for="email">số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number">
                </div>

                <button type="submit" class="btn btn-primary" name="addUser">Thêm mới</button>
            </form>
        </div>
    </div>
</div>