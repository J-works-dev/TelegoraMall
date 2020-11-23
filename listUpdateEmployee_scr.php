
<?php

require("connect.php");
$sql = "SELECT id, first_name, last_name, position, dob, tfn, start_date
		FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Date of Birth</th>
                <th>Tax File Number</th>
                <th>Start Date</th>
				<th> </th>
			</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $position = $row["position"];
		$dob = $row["dob"];
		$tfn = $row["tfn"];
		$start_date = $row["start_date"];
	
	echo "<tr>
			<td onclick=popfields($id)>$id</td>
            <td>$first_name</td>
            <td>$last_name</td>
            <td>$position</td>
            <td>$dob</td>
			<td>$tfn</td>
			<td>$start_date</td>
			<td><a href='deleteData/delEmployee_scr.php?id=$id'>Del</a></td>
		</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
