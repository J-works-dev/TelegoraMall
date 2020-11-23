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
                        <li class="active"><a href="productByCat.php">Product by Category</a></li>
                        <li><a href="productBySupp.php">Product by Supplier</a></li>
                        <?php
                        if(isset($_COOKIE['userid']))
                        {
                            ?>
                            <li><a href="addProduct.php">Add Product</a></li>
                            <li><a href="updateProduct.php">Update Product</a></li>
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
                        <h2>Categories</h2>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<!-- <div class="form-group"> -->
                            <label for="category">Choose Category: </label>
                            <input list="category" name="category">
                            <datalist id="category">
                                <?php include 'listCategories_scr.php'; ?>
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
                            if(!empty($_POST['category']))
                            {
                                $selected = $_POST['category'];
                                // header($_SERVER['PHP_SELF']);
                                require("connect.php");
                                $sql = "SELECT p.id, p.name, p.description, p.cost_price, p.size, s.name AS 'supplier', c.name AS 'category', c.description AS 'cat_des'
                                        FROM product p
                                        INNER JOIN category c
                                            ON p.cat_id = c.id
                                        INNER JOIN supplier s
                                            ON p.supp_id = s.id
                                        WHERE c.name = '$selected'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    //open table
                                    $row = $result->fetch_assoc();
                                    $category = $row["category"];
                                    $cat_des = $row["cat_des"];
                                    echo "<h2>$category</h2>";
                                    echo "<p>$cat_des</p>";
                                    echo '<table class="table table-striped table-margin" id="outTable">';
                                    echo     "<tr>
                                                <th>Product ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Cost Price</th>
                                                <th>Size</th>
                                                <th>Supplier</th>
                                            </tr>";
                                        $id = $row['id'];
                                        $name = $row["name"];
                                        $description = $row["description"];
                                        $cost_price = $row["cost_price"];
                                        $size = $row["size"];
                                        $supplier = $row["supplier"];
                                    echo "<tr>
                                            <td onclick=popfields($id)>$id</td>
                                            <td>$name</td>
                                            <td>$description</td>
                                            <td>$cost_price </td>
                                            <td>$size</td>
                                            <td>$supplier</td>
                                        </tr>";
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $name = $row["name"];
                                        $description = $row["description"];
                                        $cost_price = $row["cost_price"];
                                        $size = $row["size"];
                                        $supplier = $row["supplier"];
                                    echo "<tr>
                                            <td onclick=popfields($id)>$id</td>
                                            <td>$name</td>
                                            <td>$description</td>
                                            <td>$cost_price </td>
                                            <td>$size</td>
                                            <td>$supplier</td>
                                        </tr>";

                                    }
                                    echo "</table>";
                                } else {
                                    echo "There are currently no products for that category";
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