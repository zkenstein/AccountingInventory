<?php
    session_start();
    if($_SESSION['isLogged'] == false){
        header("location: ../index.php");
    }

    include "../php/connect.php";
?>



<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

  


</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Inventory System
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="items.html">
                        
                        <p>Items</p>
                    </a>
                </li>
                <li>
                    <a href="stocks.html">
                       
                        <p>Stocks</p>
                    </a>
                </li>
                <li class="active">
                    <a href="sales.html">
                        
                        <p>Sales</p>
                    </a>
                </li>
                <li>
                    <a href="help.html">
                        
                        <p>Help</p>
                    </a>
                </li>
                <li>
                    <a href="export-database.html">
                        
                        <p>Export Database</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Table List</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="my-table">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Items on Stock</h4>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <form method="post" action="" id="item-table">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Item Name</th>
                                            <th>Supplier</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM items";
                                                $result = mysqli_query($conn, $sql);
                                                $rows = mysqli_num_rows($result);
                                                while($rows = mysqli_fetch_array($result)){ ?>
                                                <tr>
                                                    <td id="item-id-<?php echo $rows['item_id']; ?>"><?php echo $rows['item_id']; ?></td>
                                                    <td id="item-name-<?php echo $rows['item_id']; ?>"><?php echo $rows['item_name']; ?></td>
                                                    <td id="supplier-name-<?php echo $rows['item_id']; ?>"><?php echo $rows['supplier_name']; ?></td>
                                                    <td id="price-<?php echo $rows['item_id']; ?>"><?php echo "PHP " . $rows['price']; ?></td>
                                                    <td><?php echo $rows['stock']; ?></td>
                                                    <td><?php echo "PHP " . ($rows['price'] * $rows['stock']); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    </form>

                                    <?php
                                        if(isset($_POST['delete']) && isset($_POST['checkbox'])){
                                            for($i=0;$i<count($_POST['checkbox']);$i++){
                                                $del_id=$_POST['checkbox'][$i];
                                                $sql = "DELETE FROM items WHERE item_id='$del_id'";
                                                $result = mysqli_query($conn, $sql);
                                            }
                                            // if successful redirect to delete_multiple.php
                                            if($result)
                                            {
                                                echo "<meta http-equiv=\"refresh\" content=\"0;URL=items.php\">";
                                            }
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="col-md-12">
                        <h4>Order</h4>
                    </div>

                    <form>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item:</label>
                                <select class="form-control">
                                    <option>Item1</option>
                                    <option>Item2</option>
                                    <option>Item3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price Per Quantity:</label>
                                <input type="number" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total:</label>
                                <input type="number" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Transfer:</label><br>
                                <button type="button" class="btn btn-primary" onclick="enable();">Yes</button>
                                <button type="button" class="btn btn-primary" onclick="disable();">No</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control" id="branch" disabled>
                                    <option value="">Branch 1</option>
                                    <option value="">Branch 2</option>
                                    <option value="">Branch 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Amount:</label>
                                <input type="number" id="payment" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-8" style="margin-top:25px;">
                            <div class="form-group">
                                <button type="button" class="btn btn-success">Submit</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>


            


    </div>
</div>



</body>

    <!--   Core JS Files   -->
    <script
              src="https://code.jquery.com/jquery-3.1.1.min.js"
              integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
              crossorigin="anonymous"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <script>
        function enable(){
            document.getElementById("branch").disabled = false;
            document.getElementById("payment").disabled = true;
        }

        function disable(){
            document.getElementById("branch").disabled = true;
            document.getElementById("payment").disabled = false;
        }
    </script>


</html>