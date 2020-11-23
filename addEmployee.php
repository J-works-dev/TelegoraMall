<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora - Add Employee</title>
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
                    <li class="active"><a href="employees.php">Employees</a></li>
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
                        <li class="active"><a href="addEmployee.php">Add Employee</a></li>
                        <li><a href="updateEmployee.php">Update Employee</a></li>
                        <!-- <li><a href="#where">Customer Detail</a></li> -->
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
            <article class="col-lg-12">
				<h2>Add Employee</h2>
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
								<label for="position">Position:</label>
								<input type="text" class="form-control" id="position" name="position">
							</div>
							<div class="form-group">
								<label for="dob">Date of Birth:</label>
								<input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="form-group">
								<label for="tfn">Tax File Number:</label>
								<input type="text" class="form-control" id="tfn" name="tfn">
							</div>
							<div class="form-group">
								<label for="start_date">Start Date:</label>
								<input type="date" class="form-control" id="start_date" name="start_date">
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
                        // get the Position
						if(!empty($_POST['position']))
						{
							$position = $_POST['position'];
							//remove any unwanted characters
							$position = filter_var($position, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Position is required</p>";
						}
						// get the Date of Birth
						if(!empty($_POST['dob']))
						{
							$dob = $_POST['dob'];
							//remove any unwanted characters
							$dob = filter_var($dob, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Date of Birth is required</p>";
						}
						// get the Tax File Number
						if(!empty($_POST['tfn']))
						{
							$tfn = $_POST['tfn'];
							//remove any unwanted characters
							$tfn = preg_replace('/[^0-9]/', '', $tfn);
							//note here we have condensed it to one line
						}
						else
						{
							$error_msg .= "<p>Tax File Number is required</p>";
						}
						// get the Start Date
						if(!empty($_POST['start_date']))
						{
							$start_date = $_POST['start_date'];
							//remove any unwanted characters
							$start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Start Date is required</p>";
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
							$position = mysqli_real_escape_string($conn, $position);
							$dob = mysqli_real_escape_string($conn, $dob);
							$tfn = mysqli_real_escape_string($conn, $tfn);
							$start_date = mysqli_real_escape_string($conn, $start_date);

							$sql = "INSERT INTO employee
									(first_Name, last_Name, position, dob, tfn, start_date)
									VALUES
									('$first', '$last', '$position', '$dob', '$tfn', '$start_date')";
							
							if($conn->query($sql)===true)
							{
                                echo "<p>success! The Page will be move to Customer Home</p>";
                                header("refresh:2; url=employees.php");
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
                    <h2>Employee List</h2>
                    <?php include 'listEmployee_scr.php'; ?>
                </article>
            </main>
        </section>
    </div>
</body>
</html>