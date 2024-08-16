<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM trainees ";
if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE t_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR t_email LIKE "%'.$_POST["search"]["value"].'%" ';
} 
 
if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY t_id ASC ';
}
 
if($_POST["length"] != -1)
{
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
} 

//echo $query;
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    $sub_array = array();
     
 
    
    $sub_array[] = $row["t_kid"];
    $sub_array[] = $row["t_name"];
    $sub_array[] = $row["t_email"];
    $sub_array[] = $row["t_pass"];
    $sub_array[] = $row["t_status"];
    $sub_array[] = $row["t_tech"];
    $sub_array[] = $row["t_avail"];
   
    $sub_array[] = '<button type="button" name="update" id="'.$row["t_id"].'" class="btn btn-primary btn-sm update">Edit</button></button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["t_id"].'" class="btn btn-danger btn-sm delete">Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"              =>   intval($_POST["draw"]),
    "recordsTotal"      =>   $filtered_rows,
    "recordsFiltered"   =>   get_total_all_records(),
    "data"              =>   $data
);
echo json_encode($output);
?>