<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
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
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody id = "listProduct">
                    <tr class="">
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>1</td>
                        <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                        <td><a href="#">Samsung Galaxy A51 (8GB/128GB)</a></td>
                        <td>7.790.000₫</td>
                        <td>Điện thoại</td>
                        <td>26:06:2020 14:00</td>
                        <td><span class="badge badge-success">Còn hàng</span></td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
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

<script>
    function GetProductsByCatIdInAdmin(name, price,status, image, productId, categoryId, createdAt) {
        let td = document.createElement('tr');
        td.innerHTML = `
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>1</td>
                        <td><img src="../../img/product/${image}" alt=""></td>
                        <td><a href="">${name}</a></td>
                        <td>${price}₫</td>
                        <td>${categoryId}</td>
                        <td>${createdAt}</td>
                        <td><span class="badge badge-success">${status}</span></td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    `;
        return td;
    }
    let tbody = document.getElementById("listProduct");
    var getAllProduct = "isGet";
        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "POST",
            data: {
                getAllProduct: getAllProduct,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    for (let i = 0; i <= result['data'].length; i++) {
                        if(result['data'][i]['status'] == "1")
                        {
                            result['data'][i]['status'] = "còn hàng";
                        }
                        else
                        {
                            result['data'][i]['status'] = "hết hàng";
                        }
                        tbody.append(GetProductsByCatIdInAdmin(result['data'][i]['productName']
                            , result['data'][i]['price']
                            , result['data'][i]['status']
                            , result['data'][i]['image']
                            , result['data'][i]['productId']
                            , result['data'][i]['categoryId']
                            , result['data'][i]['createdAt']
                        ));
                    }

                } else {
                }
            }
        });
</script>