<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora - Invoice</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:ital,wght@0,400;0,700;1,300&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php

    require("connect.php");
    $id = $_REQUEST['id'];
    // same as this. working perfectly same. $id = $_GET['id'];
    $sql = "SELECT il.invoice_no, il.prod_id, il.qty AS 'quantity', i.date AS 'date', 
            c.first_name AS 'cust_fname', c.last_name AS 'cust_lname', 
            e.first_name AS 'emp_fname', e.last_name AS 'emp_lname',
            p.name AS 'product', p.cost_price AS 'unit_price'
            FROM invoice_line il
            INNER JOIN product p
            ON il.prod_id = p.id
            INNER JOIN invoice i
            ON il.invoice_no = i.invoice_no
            INNER JOIN customer c
            ON i.cust_id = c.id
            INNER JOIN employee e
            ON i.emp_id = e.id
            WHERE il.invoice_no = '$id'";

    $result = $conn->query($sql);

    ?>
    <section class="center row">
        <article id="home" >
                       
            <?php
            if ($result->num_rows > 0) {
                //open table
                echo "<h2 class='text-center'>Invoice No: INV_$id</h2>";
                echo '<table class="table table-striped" id="outTable">';
                echo "<tr>
                        <th>Customer Name</th>
                        <th>Employee Name</th>
                        <th>Date</th>
                        </tr>";

                $row = $result->fetch_assoc();

                $cust_name = $row['cust_fname'] . " " . $row['cust_lname'];
                $emp_name = $row['emp_fname'] . " " . $row['emp_lname'];
                $date = $row['date'];
                echo "<tr>
                        <td>$cust_name</td>
                        <td>$emp_name</td>
                        <td>$date</td>
                        </tr>
                        </table>";


                $prod_name = $row['product'];
                $unit_price = $row['unit_price'];
                $qty = $row['quantity'];
                $amount = $unit_price * $qty;
                echo '<table class="table table-striped" id="outTable">';
                echo "<tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        </tr>";
                        echo "<tr>
                        <td>$prod_name</td>
                        <td>$unit_price</td>
                        <td>$qty</td>
                        <td>$amount</td>
                        </tr>";
                $total = $amount;
                while($row = $result->fetch_assoc()) {
                    $prod_name = $row['product'];
                    $unit_price = $row['unit_price'];
                    $qty = $row['quantity'];
                    $amount = $unit_price * $qty;
                    echo "<tr>
                        <td>$prod_name</td>
                        <td>$unit_price</td>
                        <td>$qty</td>
                        <td>$amount</td>
                        </tr>";
                    $total += $amount;
                }
                echo "<tr>
                        <td></td>
                        <td></td>
                        <td>TOTAL AMOUNT</td>
                        <td>$total</td>
                        </tr>";
                echo "</table>";
            } else {
                echo "0 results";
            }

            // $sql = "SELECT name, cost_price
            //         FROM product
            //         WHERE ";
            // $result = $conn->query($sql);

            // if ($result->num_rows > 0) {
            //     //open table
            //     echo '<table class="table table-striped" id="outTable">';
            //     echo     "<tr>
            //                 <th>Product ID</th>
            //                 <th>Name</th>
            //                 <th>Description</th>
            //                 <th>Cost Price</th>
            //                 <th>Size</th>
            //                 <th>Supplier</th>
            //                 <th>Category</th>
            //                 <th> </th>
            //             </tr>";
            //     // output data of each row
            //     while($row = $result->fetch_assoc()) {
            //         $id = $row['id'];
            //         $name = $row["name"];
            //         $description = $row["description"];
            //         $cost_price = $row["cost_price"];
            //         $size = $row["size"];
            //         $supplier = $row["supplier"];
            //         $category = $row["category"];
            //     echo "<tr>
            //             <td onclick=popfields($id)>$id</td>
            //             <td>$name</td>
            //             <td>$description</td>
            //             <td>$cost_price </td>
            //             <td>$size</td>
            //             <td>$supplier</td>
            //             <td>$category</td>
            //             <td><a href='delProduct_scr.php?id=$id'>Del</a></td>
            //         </tr>";

            //     }
            //     echo "</table>";
            // } else {
            //     echo "0 results";
            // }

            $conn->close();
            ?>
        </article>
    </section>
</body>
</html>
