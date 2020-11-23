
<?php

require("connect.php");
$sql = "SELECT p.id, p.name, p.description, p.cost_price, p.size, s.name AS 'supplier', c.name AS 'category'
		FROM product p
		INNER JOIN category c
			ON p.cat_id = c.id
		INNER JOIN supplier s
			ON p.supp_id = s.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Product ID</th>
                <th>Name</th>
				<th>Description</th>
				<th>Cost Price</th>
				<th>Size</th>
                <th>Supplier</th>
                <th>Category</th>";
				if(isset($_COOKIE['userid']))
				{
					echo "<th>Delete</th>";
				}		
			echo "</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
        $name = $row["name"];
        $description = $row["description"];
		$cost_price = $row["cost_price"];
		$size = $row["size"];
		$supplier = $row["supplier"];
        $category = $row["category"];
	echo "<tr>
			<td onclick=popfields($id)>$id</td>
            <td>$name</td>
            <td>$description</td>
			<td>$cost_price </td>
			<td>$size</td>
            <td>$supplier</td>
            <td>$category</td>";
			if(isset($_COOKIE['userid']))
			{
			echo "<td><a href='delProduct_scr.php?id=$id'>Del</a></td>";
			}
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
