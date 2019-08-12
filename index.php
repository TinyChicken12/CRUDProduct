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
$sqlSelect = "SELECT * FROM products";
$result = $connection->query($sqlSelect);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1> Liet ke danh sach san pham</h1>
            <p><a href="create.php" class="btn btn-success">Them san pham</a></p>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product title</th>
                    <th>Product describe</th>
                    <th>Created</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["product_title"] ?></td>
                            <td><?php echo $row["product_desc"] ?></td>
                            <td><?php echo $row["created"] ?></td>
                            <td><?php echo $row["price"] ?></td>
                            <td><?php echo $row["quantity"] ?></td>
                            <td><?php echo $row["status"] ?></td>
                            <td>
                                <p><a class="btn btn-warning" href="edit.php?id=<?php echo $row["id"]?>" >Sua san pham</a></p>
                                <p><a class="btn btn-danger" href="delete.php?id=<?php echo $row["id"]?>">Xoa san pham</a></p>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>