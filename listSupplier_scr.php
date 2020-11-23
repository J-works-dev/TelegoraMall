
<?php

require("connect.php");
$sql = "SELECT id, name, phone, email 
		FROM supplier";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Supplier ID</th>
                <th>Full Name</th>
                <th>Phone</th>
				<th>Email</th>";
				if(isset($_COOKIE['userid']))
				{
					echo "<th>Delete</th>";
				}		
			echo "</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
        $name = $row["name"];
        $phone = $row["phone"];
		$email = $row["email"];
	echo "<tr>
			<td onclick=popfields($id)>$id</td>
            <td>$name</td>
            <td>$phone</td>
            <td>$email</td>";
			if(isset($_COOKIE['userid']))
			{
			echo "<td><a href='delSupplier_scr.php?id=$id'>Del</a></td>";
			}
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
