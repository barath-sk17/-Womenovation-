<?php
include 'dB.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO register (username, email, password, creation_date)
VALUES ('".$username."', '".$email."', '".$password."', NOW())";

if ($conn->query($sql) === TRUE) {
  header("location:index.html");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>