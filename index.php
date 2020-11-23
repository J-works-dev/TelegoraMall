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
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="customers.php">Customers</a></li>
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
                        <li><a href="#top">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#where">Where are we?</a></li>
                        <li><a href="#contact">Contact details</a></li>
                    </ul>
                </nav>
            </div>
            <main class="col-lg-9">
                <article id="home"class="col-lg-5">
                    <h2 id="top">Welcome</h2>
                    <p>Welcome to Telegora Mall</p>

                    <h2 id="about">About us</h2>
                    <p>We are the Best mall</p>
                    
                    <h2 id="where">Where are we</h2>
                    <p>We are located in South Perth</p>
                    
                    <h2 id="contact">Contact us</h2>
                    <p>email us</p>
                    <p>phone us</p>
                </article>
            </main>
        </section>
    </div>
</body>
</html>