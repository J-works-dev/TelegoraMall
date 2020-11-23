
<?php

require("connect.php");
$sql = "SELECT name
		FROM supplier";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $supplier = $row["name"];
    echo "<option value=\"$supplier\"></option>";
}
} else {
	echo "0 results";
}
$conn->close();
?>
