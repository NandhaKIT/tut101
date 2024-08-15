<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Add")
    {
        $statement = $connection->prepare("
            INSERT INTO member (name, email, phone) VALUES (:name, :email, :phone)");
        $result = $statement->execute(
            array(
                ':name' =>   $_POST["name"],
                ':email'    =>   $_POST["email"],
                ':phone'    =>   $_POST["phone"]
            )
        );
    }
    if($_POST["operation"] == "Edit")
    {
        $statement = $connection->prepare(
            "UPDATE member
            SET name = :name, email = :email, phone = :phone WHERE id = :id");
        $result = $statement->execute(
            array(
                ':name' =>   $_POST["name"],
                ':email'    =>   $_POST["email"],
                ':phone'    =>   $_POST["phone"],
                ':id'           =>   $_POST["member_id"]
            )
        );
    }
}
?>