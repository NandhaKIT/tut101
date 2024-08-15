<?php
include('db.php');
include('function.php');
if(isset($_POST["t_id"]))
{
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM trainees WHERE t_id = '".$_POST["t_id"]."' LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["t_kid"] = $row["t_kid"];
        $output["t_name"] = $row["t_name"];
        $output["t_email"] = $row["t_email"];
        $output["t_pass"] = $row["t_pass"];
        $output["t_status"] = $row["t_status"];
        $output["t_tech"] = $row["t_tech"];
        $output["t_avail"] = $row["avail"];
        
    }
    echo json_encode($output);
}
?>