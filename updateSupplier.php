<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora Mall - Update Supplier</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:ital,wght@0,400;0,700;1,300&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
       // function to populate the input fields when a row in the table is clicked
       function popfields(x){
              var tabRows = document.getElementById("outTable").rows.length;
              for (var i = 1; i<tabRows; i++){
                     if (document.getElementById("outTable").rows[i].cells[0].innerHTML==x){
                            document.forms["inputform"]["id"].value = document.getElementById("outTable").rows[i].cells[0].innerHTML;
                            document.forms["inputform"]["full_name"].value = document.getElementById("outTable").rows[i].cells[1].innerHTML;
                            document.forms["inputform"]["phone"].value = document.getElementById("outTable").rows[i].cells[2].innerHTML;
                            document.forms["inputform"]["email"].value = document.getElementById("outTable").rows[i].cells[3].innerHTML;
                     }
              }
       }
    </script>
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
                    <li class="active"><a href="suppliers.php">Suppliers</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="invoices.php">Invoice</a></li>
                </ul>
            </div>
        </nav>

        <section class="row">
            <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="addSupplier.php">Add Supplier</a></li>
                        <li class="active"><a href="updateSupplier.php">Update Supplier</a></li>
                        <!-- <li><a href="#where">Customer Detail</a></li> -->
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
                <article class="col-lg-12">
                    <h2>Update Supplier</h2>
                    <p>Click ID to update</p>
					<?php
					if(!isset($_POST['submit']))
					{
						?>
						<form name="inputform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
								<label for="id">Supplier ID:</label>
								<input type="text" class="form-control" id="id" name="id" readonly>
							</div>
							<div class="form-group">
								<label for="full_name">Full Name:</label>
								<input type="text" class="form-control" id="full_name" name="full_name">
							</div>
							<div class="form-group">
								<label for="phone">Phone:</label>
								<input type="text" class="form-control" id="phone" name="phone">
							</div>
							<div class="form-group">
								<label for="address">Email:</label>
								<input type="email" class="form-control" id="email" name="email">
                            </div>
							<button type="submit" name = "submit" class="btn btn-default">Update</button>
                        </form>
                        
                        </article>
                        <article class="col-lg-12">
                            <h2>Supplier List</h2>
                            <?php include 'listSupplier_scr.php'; ?>
                        </article>
                        <?php
					}
					else
					{
						
						?>
						<article class="col-lg-12">
							
						
						<?php

						//initialise an empty string so we can add to it if needed
						$error_msg = ""; // can use us $error_msg = string.empty =
                        
                        $id = $_POST['id'];
						// get the Full name
						if(!empty($_POST['full_name']))
						{
							$full = $_POST['full_name'];
							//remove any unwanted characters
							$full = filter_var($full, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Full Name is required</p>";
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
						// get the Email
						if(!empty($_POST['email']))
						{
							$email = $_POST['email'];
							//remove any unwanted characters
							$email = filter_var($email, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Email is required</p>";
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

                            $sql = "UPDATE supplier
                                    SET 
                                    name = '$full',
                                    phone = '$phone',
                                    email = '$email'
                                    WHERE id = '$id'";
                            if ($conn->query($sql) === TRUE) 
                            {
                                echo "<p>Record updated successfully</p>";
                                header("refresh:2; url=updateSupplier.php");
                            } 
                            else 
                            {
                                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                            }

                            $conn->close();
                        }
					}
					?>
				</article>
            </main>
        </section>
    </div>
</body>
</html>