
<?php

require("connect.php");
$sql = "SELECT id, first_name, last_name
		FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<option value='' disabled selected>Choose option</option>";
while($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $customer = $row["first_name"] . " " . $row["last_name"];
    echo "<option value='$customer' id='$id'>$customer</option>";
}
} else {
	echo "0 results";
}
$conn->close();
?>

