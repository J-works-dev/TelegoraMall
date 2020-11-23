
<?php

require("connect.php");
$sql = "SELECT name
		FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $product = $row["name"];
    echo "<option value='$product'></option>";
}
} else {
	echo "0 results";
}
$conn->close();
?>
