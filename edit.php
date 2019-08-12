<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<?php
/**
 * Nạp kết nối CSDL
 */
include_once "config.php";
/**
 * Lấy id từ trên url xuống
 */
$id = (int) $_GET["id"];

var_dump($id);
$sqlSelect = "SELECT * FROM products WHERE id=".$id;

$result = $connection->query($sqlSelect);

$row = $result->fetch(PDO::FETCH_ASSOC);

/*echo "<pre>";
print_r($row);
echo "</pre>";
*/?>




<?php
/**
 * Kiểm tra xem có dữ liệu submit đi hay không
 * !empty($_POST) có nghĩa là không rỗng tức là có dữ liệu trong mảng này
 * isset($_POST) dùng để kiểm tra biến có tồn tại hay không
 */
if (isset($_POST) && !empty($_POST) && isset($_POST["product_id"])) {

    /**
     * Tạo ra 1 biến để check lỗi mặc định là rỗng
     */
    $errors = array();

    /**
     * !isset($_POST["name"]) => không tồn tại
     *  empty($_POST["name"]) => rỗng
     */
    if (!isset($_POST["product_title"]) || empty($_POST["product_title"])) {
        $errors[] = "Tên san pham không hợp lệ";
    }

    if (!isset($_POST["product_desc"]) || empty($_POST["product_desc"])) {
        $errors[] = "Mo ta không hợp lệ";
    }

    if (!isset($_POST["created"]) || empty($_POST["created"])) {
        $errors[] = "Ngay tao không hợp lệ";
    }

    if (!isset($_POST["price"]) || empty($_POST["price"])) {
        $errors[] = "Gia san pham không hợp lệ";
    }

    if (!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
        $errors[] = "So luong san pham không hợp lệ";
    }

   /* if (!isset($_POST["status"]) || empty($_POST["status"])) {
        $errors[] = "Trang thai san pham không hợp lệ";
    }*/

    /**
     * $errors rỗng tức là không có lỗi
     */
    if (empty($errors)) {
        $id = (int) $_POST["product_id"];
        $product_title= $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $created = $_POST['created'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];

        $sqlUpdate = "UPDATE products 
SET product_title='$product_title',product_desc='$product_desc',created=$created, price = $price,quantity=$quantity,status=$status
 WHERE id=$id";
        // Thực hiện câu SQL

        echo $sqlUpdate;
        $result = $connection->query($sqlUpdate);

        if ($result == true) {
            echo "<div class='alert alert-success'>
Sửa san pham thành công ! <a href='index.php'>Trang chủ</a>
</div>";
        } else {
            echo "<div class='alert alert-danger'>
Sua san pham thất bại !
</div>";
        }
    }else{
        /**
         * Chuyển mảng $errors thành chuỗi = hàm implode()
         */
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>$errors_string</div>";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Sửa san pham</h1>
            <form name="edit" action="" method="post">

                <input type="hidden" name="product_id" value="<?php echo $row["id"] ?>">

                <div class="form-group">
                    <label>Tên san pham:</label>
                    <input type="text" name="product_title" class="form-control" value="<?php echo $row["product_title"] ?>">
                </div>
                <div class="form-group">
                    <label for="Product describe">Mo ta san pham:</label>
                    <textarea class="form-control" rows="5" name="product_desc"> <?php echo $row["product_desc"] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Ngay tao:</label>
                    <input type="date" name="created" class="form-control" value="<?php
                   //$date = str_replace('-', '/', $row['created']);
                    //$date = strtotime(date($row['created'],mm/dd/yy));
                    $date = strtotime($row['created']);
                    echo $date2 = date('Y-m-d',$date);
                   //echo $row['created'];
                    ?>">
                </div>
                <div class="form-group">
                    <label>Gia:</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $row["price"] ?>">
                </div>
                <div class="form-group">
                    <label>So luong:</label>
                    <input type="text" name="quantity" class="form-control" value="<?php echo $row["quantity"] ?>">
                </div>
                <div class="form-group"><label>Trang thai: </label>
                    <?php
                    if($row["status"] == 1){
                        echo "<input type=\"radio\" name=\"status\" value=\"1\" checked=\"checked\">Xuat ban
                        <input type=\"radio\" name=\"status\" value=\"0\" >Khong xuat ban";
                    } else echo "
                    <input type=\"radio\" name=\"status\" value=\"1\" >Xuat ban
                        <input type=\"radio\" name=\"status\" value=\"0\" checked=\"checked\" >Khong xuat ban
                    "
                    ?>
                </div>
                <button type="submit" class="btn btn-warning">sửa san pham</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>