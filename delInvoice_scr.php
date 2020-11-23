<?php

require("connect.php");

//retrieve the id from the base request
$id = $_REQUEST['id'];

$sql = "DELETE FROM invoice WHERE invoice_no =" . $id;
if ($conn->query($sql) === TRUE) {
    echo "Invoice deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("refresh:2; url=invoices.php");
?>