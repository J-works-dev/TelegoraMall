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
    <div class="container">
        <header class="row">
            <div class="header-box col-lg-11">
                <div class="header-logo">
                    <span><img src="logo.jpg" alt="Telegora Mall Logo"></span>
                </div>
                <div class="header-title">
                    <span><h1>Telegora Mall</h1></span>
                </div>
            </div>
            <div class="header-box">
                <?php
                    if(!isset($_COOKIE['userid']))
                    {
                        ?>
                        <div><a href="login.php"> log in</a></div>
                        <!-- id="login" name="login" -->
                        <?php
                    }
                    else
                    {
                        ?>
                        <div>Hi! <?=$_COOKIE['userid']?><a href="logout.php"> log out</a></div>
                        <?php
                    }
                ?>
            </div>
        </header>
        
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="customers.php">Customers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="suppliers.php">Suppliers</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li class="active"><a href="invoices.php">Invoice</a></li>
                </ul>
            </div>
        </nav>

        <section class="row">
            <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="invoiceByCust.php">Invoice by Customer</a></li>
                        <li><a href="invoiceByEmp.php">Invoice by Employee</a></li>
                        <?php
                        if(isset($_COOKIE['userid']))
                        {
                            ?>
                        <li><a href="addInvoice.php">Add Invoice</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
            <article id="home"class="col-lg-12">
                <?php 
                if(!isset($_POST['submit']))
                {
                    ?>
                    <h2>Customers</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <!-- <div class="form-group"> -->
                        <label for="customer">Choose Customer: </label>
                        <input list="customer" name="customer">
                        <datalist id="customer">
                            <?php include 'listCustomers_scr.php'; ?>
                        </datalist>
                        <!-- </div> -->
                        
                        <button type="submit" name = "submit" class="btn btn-default">Submit</button>
                    </form>
                    <?php
                }
                else
                {
                    ?>
                    </article>
                    <article id="home"class="col-lg-12">
                    <?php
                    if(isset($_POST['submit']))
                    {
                        if(!empty($_POST['customer']))
                        {
                            $selected = $_POST['customer'];
                            // header($_SERVER['PHP_SELF']);
                            require("connect.php");

                            // $customer = $_POST['submit'];
                            $fullname = explode(" ", $selected);
                            $first_name = $fullname[0];

                            $sql = "SELECT invoice_no, date
                                    FROM invoice i
                                    INNER JOIN customer c
                                        ON i.cust_id = c.id
                                    WHERE c.first_name = '$first_name'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                //open table
                                $row = $result->fetch_assoc();
                                // $customer = $row["customer"];
                                // $cat_des = $row["cat_des"];
                                echo "<h2>$selected</h2>";
                                // echo "<p>$cat_des</p>";
                                echo '<table class="table table-striped table-margin" id="outTable">';
                                echo     "<tr>
                                            <th>Invoice NO</th>
                                            <th>Date</th>
                                        </tr>";
                                    $id = $row['invoice_no'];
                                    $date = $row["date"];
                                echo "<tr>
                                        <td onclick=popfields($id)><a href='invoice.php?id=$id'>INV_$id</a></td>
                                        <td>$date</td>
                                    </tr>";
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $id = $row['invoice_no'];
                                    $date = $row["date"];
                                echo "<tr>
                                        <td onclick=popfields($id)><a href='invoice.php?id=$id'>INV_$id</a></td>
                                        <td>$date</td>
                                    </tr>";

                                }
                                echo "</table>";
                            } else {
                                echo "There are currently no products for that Customer";
                            }
                            $conn->close();
                        } else {
                            echo "Please select the value.";
                        }
                    }
                }
                ?>
            </article>
            </main>
        </section>
    </div>
</body>
</html>