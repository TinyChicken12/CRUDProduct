<?php
define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DBNAME", "crudproduct");

try{
    $connection= new PDO("mysql:host=". HOST. ";dbname=". DBNAME, USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "success";

} catch (PDOException $exception) {
    $exception->getMessage();
}