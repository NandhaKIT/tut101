<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Add")
    {
        $statement = $connection->prepare("
            INSERT INTO trainees (t_kid,t_name,t_email,t_pass,t_status,t_tech,t_avail) VALUES (:t_kid, :t_name,:t_email,:t_pass,:t_status,:t_tech,:t_avail)");
        $result = $statement->execute(
            array(
                ':t_kid' =>   $_POST["t_kid"],
                ':t_name' =>   $_POST["t_name"],
                ':t_email' =>   $_POST["t_email"],
                ':t_pass' =>   $_POST["t_pass"],
                ':t_status' =>   $_POST["t_status"],
                ':t_tech' =>   $_POST["t_tech"],
                ':t_avail' =>   $_POST["t_avail"],
             
            )
        );
    }
    if($_POST["operation"] == "Edit")
    {
        $statement = $connection->prepare(
            "UPDATE trainees
            SET t_id = :t_id, t_kid = :t_kid, t_name = :t_name,t_email =:t_email, t_pass = :t_pass ,t_status = :t_status,t_avail = :t_avail, WHERE t_id = :t_id");
        $result = $statement->execute(
            array(
                ':t_id' =>   $_POST["t_id"],
                ':t_kid' =>   $_POST["t_kid"],
                ':t_name' =>   $_POST["t_name"],
                ':t_email' =>   $_POST["t_email"],
                ':t_pass' =>   $_POST["t_pass"],
                ':t_status' =>   $_POST["t_status"],
                ':t_tech' =>   $_POST["t_tech"],
                ':t_avail' =>   $_POST["t_avail"],
               
            )
        );
    }
}
?>