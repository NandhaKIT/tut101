<?php
include('db.php');
include('function.php');
 
if(isset($_POST["member_id"]))
{
    $statement = $connection->prepare(
        "DELETE FROM trainees WHERE t_id = :t_id"
    );
    $result = $statement->execute(
 
        array(':t_id' =>   $_POST["member_id"])
         
        );
}
?>