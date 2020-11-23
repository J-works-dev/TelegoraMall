
<?php

require("connect.php");
$sql = "SELECT id, first_name, last_name, position
		FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>";
				if(isset($_COOKIE['userid']))
				{
					echo "<th>Delete</th>";
				}		
			echo "</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $position = $row["position"];
	
	echo "<tr>
			<td onclick=popfields($id)>$id</td>
            <td>$first_name</td>
            <td>$last_name</td>
			<td>$position</td>";
			if(isset($_COOKIE['userid']))
			{
			echo "<td><a href='delEmployee_scr.php?id=$id'>Del</a></td>";
			}
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
