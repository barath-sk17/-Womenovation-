<?php
include 'dB.php';


if($_GET['act']=="login"){

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select count(id)cnt from register where email = '".$username."' and password= '".$password."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$cnt= $row['cnt'];

echo $cnt;

}
$conn->close();

?>