



<div id="content" class="container-fluid">
    <?php 
        require_once './category/product/model/indexModel.php';
        require_once './post/model/indexModel.php';
        $category = new category("sfdsdf","adas","dsadas");
        $post = new post(0,0,"","","");
        $postEditDetail = $post->getPostById($_GET['postId'])->data[0];
        $caca = $category->getAllCategory();
        echo '<pre>';
        print_r($caca);
        echo '</pre>';
        $cc = getDatatree($caca['data'],0,0);
    ?>
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa sản phẩm
        </div>
        <div class="card-body">
            <form action="<?php echo $config['baseUrl']?>/admin/post/controller/indexController.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="postTitle" value ="<?php echo $postEditDetail->postTitle ?>" id="name">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"><?php echo $postEditDetail->content ?></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="categoryId" id="">
                        <option>Chọn danh mục</option>
                        <?php
                        foreach ($cc as $item) {
                            ?>
                            <option value="<?php echo $item['categoryId'] ?>"<?php  if ($postEditDetail->categoryId  == $item['categoryId'] ) { echo ' selected="selected"'; } ?>><?php echo str_repeat('---', $item['level']) . $item['categoryName']; ?></option>
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



                <button type="submit" value="<?php echo $postEditDetail->postId ?>" name="updatePost" class="btn btn-primary" >Thêm mới</button>
            </form>
            <script>
                    CKEDITOR.replace( 'decription' );
            </script>
        </div>
    </div>
</div>
