<div id="content" class="container-fluid">
    <?php
    require_once './post/model/indexModel.php';
    include './category/post/model/indexModel.php';
    $Post = new post(0, 0, "", "", "", "", 0, 0);
    $category = new category("sfdsdf", "adas", "dsadas");
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $listPost = $Post->getAllPost($current_page);
    echo '<pre>';
    print_r($listPost);
    echo '</pre>';
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'showDeletePost') {
            $listPost = $Post->showDeletePost();
            $countDelPost = count($listPost->data);
        } else if($_GET['action'] == 'showActivePost'){
            $listPost = $Post->showActivePost();
            $countActivePost = count($listPost->data);
        } else {
            $listPost = $Post->showPendingPost();
            $countPendingPost = count($listPost->data);
        }
    }

    ?>
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
            <a href="?view=list-post&action=showPendingPost" class="text-primary">Chờ Duyệt<span class="text-muted">(<?php if (isset($countPendingPost)) echo $countPendingPost ?>)</span></a>
            <a href="?view=list-post&action=showActivePost" class="text-primary">Công Khai<span class="text-muted">(<?php if (isset($countActivePost)) echo $countActivePost ?>)</span></a>
            <a href="?view=list-post&action=showDeletePost" class="text-primary">Đã Xóa<span class="text-muted">(<?php if (isset($countDelPost)) echo $countDelPost ?>)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" name="listAction" id="listActive">
                    <option">Chọn</option>
                        <option value="0">Chờ duyệt</option>
                        <option value="1">Công khai</option>
                        <option value="2">đã xóa</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary listActionPost">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên Bài viết</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $t = 0;
                    foreach ($listPost->data as $Post) {
                        $t++
                    ?>

                        <tr class="table-primary">
                            <td><input name="check[]" type="checkbox" value="<?php echo $Post->postId ?>"></td>
                            <td><?php echo $t ?></td>
                            <td><img width="100px" height="100px" id="<?php echo "image" . $Post->postId ?>" class="image" src="<?php  echo $config['baseUrl']."/admin/public/image/" . $Post->image ?>" alt=""></td>
                            <td id="<?php echo "title" . $Post->postId ?>"><?php echo $Post->postTitle ?></td>
                            <td id="<?php echo "categoryId" . $Post->postId ?>"><?php echo $Post->categoryName ?></td>
                            <td id="<?php echo "createdAt" . $Post->postId ?>"><?php echo $Post->createdAt ?></td>
                            <td id="<?php echo  $Post->postId ?>"><?php if ($Post->status == '1') {
                                                                        echo "đã đăng";
                                                                    } else if ($Post->status == '0') {
                                                                        echo "chờ duyệt";
                                                                    } else {
                                                                        echo "đã xóa";
                                                                    }?></td>
                            <td>
                                <a href="?view=edit-post&postId=<?php echo $Post->postId ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <button id="<?php echo $Post->postId ?>" class="btn btn-danger btn-sm rounded-0 text-white btnDeletePost" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
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
                    if ($current_page > 1 && $_SESSION['total_page_post'] > 1) {
                        echo ' <li class="page-item"><a class="page-link" href="?view=list-post&page=' . ($current_page - 1) . '">Prev</a>  <li class="page-item">  ';
                    }

                    // Lặp khoảng giữa
                    for ($i = 1; $i <= $_SESSION['total_page_post']; $i++) {
                        // Nếu là trang hiện tại thì hiển thị thẻ span
                        // ngược lại hiển thị thẻ a
                        if ($i == $current_page) {
                            echo '<span>' . $i . '</span>  ';
                        } else {
                            echo ' <li class="page-item"><a class="page-link"<a href="?view=list-post&page=' . $i . '">' . $i . '</a> <li class="page-item"> ';
                        }
                    }

                    if ($current_page < $_SESSION['total_page_post'] && $_SESSION['total_page_post'] > 1) {
                        echo '<li class="page-item"><a class="page-link" <a href="?view=list-product&page=' . ($current_page + 1) . '">Next</a> <li class="page-item"> ';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>