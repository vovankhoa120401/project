<?php 
        require_once './order/model/indexModel.php';
        $order = new order("sfdsdf","adas","dsadas","asd", '', '', '');
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $listOrder = $order->getAllOrder()->data;
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'showProcessingOrder') {
            $listOrder = $order->showProcessingOrder();
            $countProcessingOrder = count($listOrder->data);
        } else if($_GET['action'] == 'showAccomplishedOrder'){
            $listOrder = $order->showAccomplishedOrder();
            $countAccomplishedOrder= count($listOrder->data);
        } else {
            $listOrder = $order->showDelOrder();
            $countDelOrder = count($listOrder->data);
        }
    }
?>
<div id="content" class="container-fluid">
    
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="?view=list-product&action=showProcessingOrder" class="text-primary">Đang xử lý<span class="text-muted">(<?php if(isset($countProcessingOrder)) echo $countProcessingOrder ?>)</span></a>
                <a href="?view=list-product&action=showAccomplishedOrder" class="text-primary">Đã hoàn thành<span class="text-muted">(<?php if(isset($countAccomplishedOrder)) echo $countAccomplishedOrder ?>)</span></a>
                <a href="?view=list-product&action=showDelOrder" class="text-primary">Đã xóa<span class="text-muted">(<?php if(isset($countDelOrder)) echo $countDelOrder ?>)</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="listActive">
                    <option>Chọn</option>
                    <option value="0">Đang xử lý</option>
                    <option value="1">Đã hoàn thành</option>
                    <option value="2">Đã hủy</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary listActionOrder">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">username</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $t = 0 ;
                    foreach($listOrder as $item) { 
                    $t++;
                        ?>
                    <tr>
                    <td><input name="check[]" type="checkbox" value="<?php echo $item->orderId ?>"></td>

                        <td><?php echo $t ?></td>
                        <td><?php echo $item->username ?></td>
                        <td>
                            <?php echo $item->fullname ?>
                            <?php echo $item->phone_number ?>
                        </td>
                        <?php  $firstProduct = json_decode($item->product, true);
                        $firstProduct = reset($firstProduct);?>
                        <td><a href="?view=edit-product&productId=<?php echo $firstProduct['id']?>"><?php
                        echo $firstProduct['name'];
                        ?></a></td>
                        <td><?php echo $item->totalPrice ?></td>
                        <td><span id="<?php echo $item->orderId ?>" class="badge badge-warning"><?php if($item->status == '1') {
                            echo "đã hoàn thành";
                        } else if($item->status == '0'){
                            echo "đang xử lý";
                        } else {
                            echo "đã hủy";
 
                        } ?></span></td>
                        <td><?php echo $item->createdAt ?></td>
                        <td>
                            <a href="?view=detail-order&orderId=<?php echo $item->orderId ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i id="<?php echo $item->orderId?>" class="fa fa-trash btnDeleteOrder"></i></button>
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
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>