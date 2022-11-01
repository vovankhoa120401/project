



<div id="content" class="container-fluid">
    <?php 
        require_once './category/product/model/indexModel.php';
        require_once './product/model/indexModel.php';
        $category = new category("sfdsdf","adas","dsadas");
        $product = new product(0,0,"","","","",0,0);
        $caca = $category->getAllCategory();
        $cc = getDatatree($caca['data'],0,0);
    ?>
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form id="form-upload-single"  action="" enctype="multipart/form-data" method="post">
                <div class="form_group clearfix">
                    <label for="detail">Hình ảnh</label><br/><br/>
                    <input type="file" name="file[]" id="file"><br/><br/>
                    <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                    <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                    <div id="show_list_file">
                    </div>
                </div>
            </form>
            <form action="<?php echo $config['baseUrl']?>/admin/product/controller/indexController.php" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="productName" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Size</label>
                    <select class="form-control" name="size" id="">
                        <option>Chọn Size</option>
                        <option value="22">22</option>
                        <option value="24">24</option>
                        <option value="26">26</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="decription" class="form-control decription" id="decription" cols="30" rows="5"></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="categoryId" id="">
                        <option>Chọn danh mục</option>
                        <?php
                            foreach($cc as $item){
                        ?>
                        <option value="<?php echo $item['categoryId'] ?>"><?php echo str_repeat('---', $item['level'] ).$item['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>



                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isActive" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isActive" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="addProduct">Thêm mới</button>
            </form>
            <script>
                    CKEDITOR.replace( 'decription' );
            </script>
        </div>
    </div>
</div>
