<?php

require("connect.php");

//retrieve the id from the base request
$id = $_REQUEST['id'];

$sql = "DELETE FROM employee WHERE id =" . $id;
if ($conn->query($sql) === TRUE) {
    echo "Employee deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("refresh:2; url=employees.php");
?>