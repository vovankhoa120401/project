
<?php
require_once './user/model/indexModel.php';
$user = new user(0,0,0,0,0,0,0);
$user = $user->getUserById($_GET['userId'])->data[0];
print_r($user);
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="<?php echo $config['baseUrl']?>/admin/user/controller/indexController.php" method="post">
                <div class="form-group">
                    <label for="name">username</label>
                    <input class="form-control" type="text" name="userName" id="userName" value="<?php echo $user->userName ?>">
                </div>

                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="fullname" id="fullname" value="<?php echo $user->fullname ?>">
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ</label>
                    <input class="form-control" type="text" name="address" id="address" value="<?php echo $user->address ?>">
                </div>

                <div class="form-group">
                    <label for="email">Ngày sinh</label>
                    <input class="form-control" type="date" name="birthday" id="birthday" value="<?php echo $user->birthday?>">
                </div>

                <div class="form-group">
                    <label for="email">số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number" value="<?php echo $user->phone_number ?>">
                </div>

                <button type="submit" class="btn btn-primary" name="updateUser">Cập nhật</button>
            </form>
        </div>
    </div>
</div>