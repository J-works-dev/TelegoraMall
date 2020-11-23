
<?php

require("connect.php");
$sql = "SELECT id, first_name, last_name
		FROM employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $employee = $row["first_name"] . " " . $row["last_name"];
    echo "<option value='$employee'>$employee</option>";
}
} else {
	echo "0 results";
}
$conn->close();
?>
