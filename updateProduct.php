<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 'this is a html comment' -->
    <title>Telegora Mall - Update Product</title>
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
                            document.forms["inputform"]["name"].value = document.getElementById("outTable").rows[i].cells[1].innerHTML;
                            document.forms["inputform"]["description"].value = document.getElementById("outTable").rows[i].cells[2].innerHTML;
                            document.forms["inputform"]["cost_price"].value = document.getElementById("outTable").rows[i].cells[3].innerHTML;
                            document.forms["inputform"]["size"].value = document.getElementById("outTable").rows[i].cells[4].innerHTML;
                            document.forms["inputform"]["supplier"].value = document.getElementById("outTable").rows[i].cells[5].innerHTML;
                            document.forms["inputform"]["category"].value = document.getElementById("outTable").rows[i].cells[6].innerHTML;
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
                    <li><a href="suppliers.php">Suppliers</a></li>
                    <li class="active"><a href="products.php">Products</a></li>
                    <li><a href="invoices.php">Invoice</a></li>
                </ul>
            </div>
        </nav>

        <section class="row">
            <div class="col-lg-3">
                <nav class="sidebar-nav">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="productByCat.php">Product by Category</a></li>
                        <li><a href="productBySupp.php">Product by Supplier</a></li>
                        <li><a href="addProduct.php">Add Product</a></li>
                        <li class="active"><a href="updateProduct.php">Update Product</a></li>
                        <!-- <li><a href="#where">Customer Detail</a></li> -->
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
                <article class="col-lg-12">
                    <h2>Update Product</h2>
                    <p>Click ID to update</p>
					<?php
					if(!isset($_POST['submit']))
					{
						?>
						<form name="inputform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
								<label for="id">Product ID:</label>
								<input type="text" class="form-control" id="id" name="id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="cost_price">Cost Price:</label>
                                <input type="text" class="form-control" id="cost_price" name="cost_price">
                            </div>
                            <div class="form-group">
                                <label for="size">Size:</label>
                                <input type="text" class="form-control" id="size" name="size">
                            </div>
                            <div class="form-group">
                                <label for="supplier">Supplier:</label>
                                <input list="supplier" class="form-control" name="supplier">
                                    <datalist id="supplier">
                                        <?php include 'listSuppliers_scr.php'; ?>
                                    </datalist>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <input list="category" class="form-control" name="category">
                                    <datalist id="category">
                                        <?php include 'listCategories_scr.php'; ?>
                                    </datalist>
                            </div>
							<button type="submit" name = "submit" class="btn btn-default">Update</button>
                        </form>
                        
                        </article>
                        <article class="col-lg-12">
                            <h2>Product List</h2>
                            <?php include 'listProduct_scr.php'; ?>
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
						// get the name
						if(!empty($_POST['name']))
						{
							$name = $_POST['name'];
							//remove any unwanted characters
							$name = filter_var($name, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Name is required</p>";
						}
						// get the description
						if(!empty($_POST['description']))
						{
							$description = $_POST['description'];
							//remove any unwanted characters
							$description = filter_var($description, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Description is required</p>";
                        }
                        // get the category
						if(!empty($_POST['category']))
						{
							$category = $_POST['category'];
							//remove any unwanted characters
							$category = filter_var($category, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Category is required</p>";
                        }
						// get the Supplier
						if(!empty($_POST['supplier']))
						{
							$supplier = $_POST['supplier'];
							//remove any unwanted characters
							$supplier = filter_var($supplier, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Supplier is required</p>";
						}
						// get the Cost Price
						if(!empty($_POST['cost_price']))
						{
							$cost_price = $_POST['cost_price'];
							//remove any unwanted characters
							$cost_price = filter_var($cost_price, FILTER_SANITIZE_STRING);
							//note here we have condensed it to one line
						}
						else
						{
							$error_msg .= "<p>Cost Price is required</p>";
						}
						// get the Size
						if(!empty($_POST['size']))
						{
							$size = $_POST['size'];
							//remove any unwanted characters
							$size = filter_var($size, FILTER_SANITIZE_STRING);
						}
						else
						{
							$error_msg .= "<p>Size is required</p>";
						}
                        
                        if(!empty($error_msg))
						{
							echo "<p>Error: </p>" . $error_msg;

							echo "<p>Please go <a href='javascript:history.go(-1)'>back</a> and try again</p>";
						}
						else
						{
                            require("connect.php");
                            $sql = "SELECT id
                                    FROM category
                                    WHERE name = '$category'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $cat_id = $row["id"];
                            $conn->close();

                            require("connect.php");
                            $sql = "SELECT id
                                    FROM supplier
                                    WHERE name = '$supplier'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $supp_id = $row["id"];
                            $conn->close();

							//get the connection script
							require("connect.php");

                            $sql = "UPDATE product
                                    SET 
                                    name = '$name',
                                    description = '$description',
                                    cost_price = '$cost_price',
                                    size = '$size', 
                                    cat_id = '$cat_id',
                                    supp_id = '$supp_id' 
                                    WHERE id = '$id'";
                            if ($conn->query($sql) === TRUE) 
                            {
                                echo "<p>Record updated successfully</p>";
                                header("refresh:2; url=updateProduct.php");
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