<?php

require_once './user/model/indexModel.php';
$user = new user('','','','','','','');
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$listUser = $user->getAllUser($current_page);


//print_r($listUser->data);
//$caca = $category->getAllCategory();
//$cc = getDatatree($caca['data'],0,0);
?>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select id="listActive" class="form-control mr-1">
                    <option>Chọn</option>
                    <option value="2"> Admin </option>
                    <option value="1"> dang hoat dong</option>
                    <option value="0"> xoa </option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary listActionUser">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Username</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $t=0;
                foreach ($listUser->data as $item) {$t++;

                    ?>
                    <tr>
                        <td><input id="check" name="check[]" type="checkbox" value="<?php echo $item->userId ?>"></td>
                        <td><?php echo $t ?></td>
                        <td><?php echo $item->fullname ?></td>
                        <td><?php echo $item->userName ?></td>
                        <td id="<?php echo $item->userId ?>"><?php if($item->isActive == 2){ echo "admin";} elseif ($item->isActive == 1) { echo "user";} else { echo "da xoa";} ?></td>
                        <td><?php echo $item->createdAt ?></td>
                        <td>
                            <a href="?view=edit-user&userId=<?php echo $item->userId?>"  class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <button href="#" id="<?php echo $item->userId ?>" class="btn btn-danger btn-sm rounded-0 text-white  btnDeleteUser" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </li>
                    <?php
                    if ($current_page > 1 && $_SESSION['total_page_user'] > 1){
                    echo ' <li class="page-item"><a class="page-link" href="?view=list-user&page='.($current_page-1).'">Prev</a>  <li class="page-item">  ';
                    }

                    // Lặp khoảng giữa
                    for ($i = 1; $i <= $_SESSION['total_page_user']; $i++){
                    // Nếu là trang hiện tại thì hiển thị thẻ span
                    // ngược lại hiển thị thẻ a
                    if ($i == $current_page){
                    echo '<span>'.$i.'</span>  ';
                    }
                    else{
                    echo ' <li class="page-item"><a class="page-link"<a href="?view=list-user&page='.$i.'">'.$i.'</a> <li class="page-item"> ';
                    }
                    }

                    if ($current_page < $_SESSION['total_page_user'] && $_SESSION['total_page_user'] > 1){
                    echo '<li class="page-item"><a class="page-link" <a href="?view=list-user&page='.($current_page+1).'">Next</a> <li class="page-item"> ';
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </div>
</div>