
<?php

require("connect.php");
$sql = "SELECT i.invoice_no, i.date,
		c.first_name AS 'cust_fname', c.last_name AS 'cust_lname', 
        e.first_name AS 'emp_fname', e.last_name AS 'emp_lname'
		FROM invoice i
		INNER JOIN customer c
		ON i.cust_id = c.id
		INNER JOIN employee e
		ON i.emp_id = e.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Invoice No.</th>
                <th>Date</th>
                <th>Customer</th>
				<th>Employee</th>
				</tr>";
				// <th> </th>
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['invoice_no'];
        $date = $row["date"];
        $cust_name = $row['cust_fname'] . " " . $row['cust_lname'];
        $emp_name = $row['emp_fname'] . " " . $row['emp_lname'];
	echo "<tr>
			<td onclick=popfields($id)><a href='invoice.php?id=$id'>INV_$id</a></td>
            <td>$date</td>
            <td>$cust_name</td>
            <td>$emp_name</td>
			</tr>";
			// <td><a href='delInvoice_scr.php?id=$id'>Del</a></td>

	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
