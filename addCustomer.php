<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora</title>
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
                    <li class="active"><a href="customers.php">Customers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="suppliers.php">Suppliers</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="invoices.php">Invoice</a></li>
                </ul>
            </div>
        </nav>

        <section class="row">
            <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="addCustomer.php">Add Customer</a></li>
                        <li><a href="updateCustomer.php">Update Customer</a></li>
                        <!-- <li><a href="#where">Customer Detail</a></li> -->
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
            <article class="col-lg-12">
				<h2>Add Customer</h2>
                    <?php 
					if(!isset($_POST['submit']))
					{
						?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<div class="form-group">
								<label for="first_name">First Name:</label>
								<input type="text" class="form-control" id="first_name" name="first_name">
							</div>
							<div class="form-group">
								<label for="last_name">Last Name:</label>
								<input type="text" class="form-control" id="last_name" name="last_name">
							</div>
							<div class="form-group">
								<label for="phone">Phone:</label>
								<input type="text" class="form-control" id="phone" name="phone">
							</div>
							<div class="form-group">
								<label for="address">Address:</label>
								<input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
								<label for="suburb">Suburb:</label>
								<input type="text" class="form-control" id="suburb" name="suburb">
							</div>
							<div class="form-group">
								<label for="post_code">Post Code:</label>
								<input type="text" class="form-control" id="post_code" name="post_code">
							</div>
							<button type="submit" name = "submit" class="btn btn-default">Add</button>
						</form>
						<?php
					}
					else
					{
						//initialise an empty string so we can add to it if needed
						$error_msg = ""; // can use us $error_msg = string.empty =
						
						// get the first name
						if(!empty($_POST['first_name']))
						{
							$first = $_POST['first_name'];
							//remove any unwanted characters
							$first = filter_var($first, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>First Name is required</p>";
						}
						// get the last name
						if(!empty($_POST['last_name']))
						{
							$last = $_POST['last_name'];
							//remove any unwanted characters
							$last = filter_var($last, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Last Name is required</p>";
                        }
                        // get the Phone
						if(!empty($_POST['phone']))
						{
							$phone = $_POST['phone'];
							//remove any unwanted characters
							$phone = preg_replace('/[^0-9]/', '', $phone);
						}
						else
						{
							$error_msg .= "<p>Phone is required</p>";
						}
						// get the Address
						if(!empty($_POST['address']))
						{
							$address = $_POST['address'];
							//remove any unwanted characters
							$address = filter_var($address, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Address is required</p>";
						}
						// get the suburb
						if(!empty($_POST['suburb']))
						{
							$suburb = $_POST['suburb'];
							//remove any unwanted characters
							$suburb = filter_var($suburb, FILTER_SANITIZE_STRING);
							//note here we have condensed it to one line
						}
						else
						{
							$error_msg .= "<p>Suburb is required</p>";
						}
						// get the Post Code
						if(!empty($_POST['post_code']))
						{
							$post_code = $_POST['post_code'];
							//remove any unwanted characters
							$post_code = preg_replace('/[^0-9]/', '', $post_code);
						}
						else
						{
							$error_msg .= "<p>Post Code is required</p>";
						}

						if(!empty($error_msg))
						{
							echo "<p>Error: </p>" . $error_msg;

							echo "<p>Please go <a href='javascript:history.go(-1)'>back</a> and try again</p>";
						}
						else
						{
							//get the connection script
							require("connect.php");

							//if all fields are filled then we can add the data to the db
							$first = mysqli_real_escape_string($conn, $first);
							$last = mysqli_real_escape_string($conn, $last);
							$phone = mysqli_real_escape_string($conn, $phone);
							$address = mysqli_real_escape_string($conn, $address);
							$suburb = mysqli_real_escape_string($conn, $suburb);
							$post_code = mysqli_real_escape_string($conn, $post_code);

							$sql = "INSERT INTO customer
									(first_Name, last_Name, phone, address, suburb, post_code)
									VALUES
									('$first', '$last', '$phone', '$address', '$suburb', '$post_code')";
							
							if($conn->query($sql)===true)
							{
                                echo "<p>success! The Page will be move to Customer Home</p>";
                                header("refresh:2; url=customers.php");
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
                    <h2>Customer List</h2>
                    <?php include 'listCustomer_scr.php'; ?>
                </article>
            </main>
        </section>
    </div>
</body>
</html>