<?php 
        require_once './order/model/indexModel.php';
        $order = new order("sfdsdf","adas","dsadas","asd", '', '', '');
        $orderDetail = $order->getOrderById($_GET['orderId'])->data;
        $listProdcut = json_decode($orderDetail[0]->product, true);

?>
<table style="width: 850px; margin: auto">
  <tbody>
    <!-- Detail Order -->
    <tr>
      <td colspan="3" class="left"><br />Thời gian: <b>2021-03-03 11:51:05</b> </td>
    </tr>
    <!-- Items -->
    <tr>
      <td colspan="6">
        <table>
<!-- <caption>Productos</caption> -->
          <thead>
            <tr>
            <th scope="col">#</th>
                        <th scope="col">ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">số lượng</th>
                        <th scope="col">thành tiền</th>
            </tr>
          </thead>
          <tbody>
              <?php
              $t = 0;
              foreach($listProdcut as $item) {
                $t++;
                ?>
            <tr>

              <td><?php echo $t ?></td>

              <td><img width="80px" height="80px" class = "image" src="<?php echo $item['picture'] ?>" alt=""></td>

              <td><?php echo $item['name'] ?> </td>
              <td><?php echo $item['amount'] ?>

              <td><?php echo $item['price'] ?></td>
               
            </tr>
            <?php } ?>
          </tbody>
          <tfooter>
            <tr>
              <th scope="col"></th>

              <th scope="col">Total</th>

              <th scope="col"><?php echo $orderDetail[0]->totalPrice ?></th>


            </tr>
          </tfooter>
        </table>
      </td>
    </tr>
    
    <!-- Data User -->
    <tr>
      <td colspan="3">
        <table>
          <caption>Thông tin khách hàng</caption>
          <tbody>
            <tr>
              <td>
                Tên khách hàng:</td>

              <td> <?php echo $orderDetail[0]->fullname ?>
              </td>
            </tr>
            <tr>
              <td>Địa Chỉ:</td>

              <td> <?php echo $orderDetail[0]->address ?>
              </td>
            </tr>
            <tr>
              <td>
                Số điện thoại: </td>

              <td> <?php echo $orderDetail[0]->phone_number ?>
              </td>
            </tr>
            <tr>
              <td>
                Note</td>

              <td> <?php echo $orderDetail[0]->note ?>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td colspan="3">
        <table>
          <tbody>
              <td id="status-order" class="<?php echo $orderDetail[0]->orderId ?>"><?php if($orderDetail[0]->status == "1"){
                  echo "Đã hoàn thành";
              } else {
                  echo "Đang xử lý";
              } ?></td>
          </tbody>
          <caption>Trạng thái đơn hàng</caption>
            
        </table>
      </td>
    </tr>
    
  </tbody>
</table>