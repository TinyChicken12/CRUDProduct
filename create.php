<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
include_once "config.php";

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">
                <br>
                <div class="form-group"><label>Product title: </label><input type="text" name="product_title"
                                                                             class="form-control"></div>
                <div class="form-group">
                    <label for="Product describe">Product describe:</label>
                    <textarea class="form-control" rows="5" name="product_desc"></textarea>
                </div>
                <div class="form-group"><label>Created: </label><input type="date" name="created" class="form-control">
                </div>
                <div class="form-group"><label>Price: </label><input type="number" name="price" class="form-control">
                </div>
                <div class="form-group"><label>Quantity: </label><input type="number" name="quantity" class="form-control">
                </div>
                <div class="form-group"><label>Status: </label>
                    <input type="radio" name="status" value="1" class="form-control">Xuat ban
                    <input type="radio" name="status" value="0" class="form-control">Khong xuat ban
                </div>
                <div class="form-group"><input type="submit" value="Them san pham" class="btn btn-success"
                                               class="form-control">
                    <a href="index.php" class="btn btn-success">Trang chu</a></div>
            </form>
        </div>
    </div>
</div>

<?php
$errors = array();

//Kiểm tra khi bất cứ 1 trường nào dk điền
$flag = "";
if (isset($_POST) && !empty($_POST)) {
    if (!isset($_POST["product_title"]) || empty($_POST["product_title"])) {
        $errors[] = "Vui long nhap ten san pham"; //Cú pháp thêm phần tử vào cuối mảng
    }

    if (!isset($_POST["product_desc"]) || empty($_POST["product_desc"])) {
        $errors[] = "Vui long nhap mo ta san pham";
    }

    if (!isset($_POST["created"]) || empty($_POST["created"])) {
        $errors[] = "Vui long nhap ngay tao";
    }

    if (!isset($_POST["price"]) || empty($_POST["price"])) {
        $errors[] = "Vui long nhap gia";
    }

    if (!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
        $errors[] = "Vui long nhap so luong";
    }

    if (!isset($_POST["status"]) || empty($_POST["status"])) {
        $errors[] = "Vui long nhap trang thai";
    }

    echo implode("<br>",$errors);  //Hàm chuyển array thành string và phân cách bởi dấu xuống dòng

    $flag = true;  //Đặt flag ở đây để đỡ phải khai báo lại biến của các trường kiểm tra các trường đã được nhập
}

if ($flag && empty($errors)) {
    $product_title = $_POST["product_title"];
    $product_desc = $_POST["product_desc"];
    $created = $_POST["created"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $status = $_POST["status"];
    $sqlInsert = "INSERT INTO `products`(`product_title`, `product_desc`, `created`, `price`, `quantity`, `status`) 
VALUES ('$product_title', '$product_desc', '$created', $price, $quantity, $status)";
    $result = $connection->query($sqlInsert);
    echo "Them moi thanh cong";
}

if(!empty($errors)){
    echo "<br>" . "Them moi that bai";
}

?>
</body>
</html>
