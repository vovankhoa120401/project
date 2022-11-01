//postTitle, content, categoryId, uploadFile, status
<?php
        include './category/product/model/indexModel.php';
        include './post/model/indexModel.php';
        $category = new category("sfdsdf","adas","dsadas");
        $product = new post(0,0,"","","");
        $caca = $category->getAllCategory();
        $cc = getDatatree($caca['data'],0,0);
    ?>
    
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="<?php echo $config['baseUrl']?>/admin/post/controller/indexController.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="postTitle" id="name">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="categoryId" id="">
                        <option>Chọn danh mục</option>
                        <?php
                        foreach ($cc as $item) {
                        ?>
                            <option value="<?php echo $item['categoryId'] ?>"><?php echo str_repeat('---', $item['level']) . $item['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="intro">Hinh</label>
                    <input type="file" name="uploadFile">
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>



                <button type="submit" name="addPost" class="btn btn-primary addPost">Thêm mới</button>
            </form>
        </div>
    </div>
</div>