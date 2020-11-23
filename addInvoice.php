<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora - Add Invoice</title>
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
                        <li><a href="invoiceByCust.php">Invoice by Customer</a></li>
                        <li><a href="invoiceByEmp.php">Invoice by Employee</a></li>
                        <li class="active"><a href="addInvoice.php">Add Invoice</a></li>
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
            <article class="col-lg-12">
				<h2>Add Invoice</h2>
                    <?php
                    $count = 0;
					if(!isset($_POST['submit']))
					{
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="employee">Employee:</label>
                                <input list="employee" class="form-control" name="employee">
                                    <datalist id="employee">
                                        <?php include 'listEmployees_scr.php'; ?>
                                    </datalist>
                            </div>
                            <div class="form-group">
                                <label for="customer">Customer:</label>
                                <input list="customer" class="form-control" name="customer">
                                    <datalist id="customer">
                                        <?php include 'listCustomers_scr.php'; ?>
                                    </datalist>
                            </div>
                            <div class="form-group">
                            <table class="table table-striped" id="outTable">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                </tr>
                                <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<tr>
                                                <td><input list='product$i' class='form-control' name='product$i'>
                                                <datalist id='product$i'>";
                                                    include 'listProducts_scr.php';
                                        echo "</datalist></td>
                                                <td><input type='text' class='form-control' id='quantity$i' name='quantity$i'></td>
                                                </tr>";
                                    }
                                ?>
                            </table>
                            </div>
							
							<button type="submit" name = "submit" class="btn btn-default">Add</button>
						</form>
						<?php
					}
					else
					{
						//initialise an empty string so we can add to it if needed
						$error_msg = ""; // can use us $error_msg = string.empty =
                        
						for ($i = 0; $i < 5; $i++) {
                            if(!empty($_POST["product$i"]))
                            {
                                $product[$i] = $_POST["product$i"];
                                $count++;
                            }
                            else
                            {
                                break;
                            }
                        }
                        
                        for ($i = 0; $i < 5; $i++) {
                            if(!empty($_POST["quantity$i"]))
                            {
                                $quantity[$i] = $_POST["quantity$i"];
                                //remove any unwanted characters
                                $quantity[$i] = preg_replace('/[^0-9]/', '', $quantity[$i]);
                            }
                            else
                            {
                                break;
                                $error_msg .= "<p>Quantity is required</p>";
                            }
                        }

						if(!empty($error_msg))
						{
							echo "<p>Error: </p>" . $error_msg;

							echo "<p>Please go <a href='javascript:history.go(-1)'>back</a> and try again</p>";
						}
						else
						{
                            // for ($i = 0; $i < $count; $i++) {
                            //     echo $product[$i] . $quantity[$i];
                            // }
                            $selectedCus = $_POST['customer'];
                            $selectedEmp = $_POST['employee'];

                            require("connect.php");

                            $fullname = explode(" ", $selectedCus);
                            $first_name = $fullname[0];
                            $sql = "SELECT id
                                    FROM customer
                                    WHERE first_name = '$first_name'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $cust_id = $row["id"];
                            // $cust_id = $conn->query($sql);
                            $conn->close();

                            require("connect.php");

                            $fullname = explode(" ", $selectedEmp);
                            $first_name = $fullname[0];
                            $sql = "SELECT id
                                    FROM employee
                                    WHERE first_name = '$first_name'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $emp_id = $row["id"];
                            // $emp_id = $conn->query($sql);
                            $conn->close();

                            require("connect.php");

                            $sql = "INSERT INTO invoice
									(date, cust_id, emp_id)
									VALUES
									(now(), '$cust_id', '$emp_id')";
                            $conn->query($sql);
                            $conn->close();

                            require("connect.php");
                            
                            $sql = "SELECT invoice_no
                                    FROM invoice
                                    WHERE cust_id = '$cust_id' AND emp_id = '$emp_id'
                                    ORDER BY date DESC
                                    LIMIT 1";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $invoice_no = $row["invoice_no"];
                            $conn->close();
                            
							//get the connection script
							require("connect.php");

                            for ($i = 0; $i < $count; $i++) {
                                // $product = mysqli_real_escape_string($conn, $product[$i]);
                                // $quantity = mysqli_real_escape_string($conn, $quantity[$i]);
    
                                require("connect.php");

                                $sql = "SELECT id
                                        FROM product
                                        WHERE name = '$product[$i]'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $prod_id = $row["id"];
                                // $prod_id = $conn->query($sql);
                                
                                $sql = "INSERT INTO invoice_line
                                        (invoice_no, prod_id, qty)
                                        VALUES
                                        ($invoice_no, $prod_id, $quantity[$i])";
                                $conn->query($sql);
                                $done = true;
                                $conn->close();
                            }
                            // if all fields are filled then we can add the data to the db
							if($done)
							{
                                echo "<p>success! The Page will be move to Invoice Home</p>";
                                // header("refresh:2; url=invoices.php");
							}
							else
							{
								echo "error: " . $conn->error;
							}
						}
					}
                    ?>
                </article>
                <article id="home"class="col-lg-12">
                    <h2>Invoice List</h2>
                    <?php include 'listInvoice_scr.php'; ?>
                </article>
            </main>
        </section>
    </div>
</body>
</html>