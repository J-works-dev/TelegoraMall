
<?php

require("connect.php");
$sql = "SELECT name
		FROM category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<option value='' disabled selected>Choose option</option>";
while($row = $result->fetch_assoc()) {
    $category = $row["name"];
    echo "<option value='$category'>$category</option>";
}
} else {
	echo "0 results";
}
$conn->close();
?>
