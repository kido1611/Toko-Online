<?php
	include 'config.php';

	if(isset($_GET['logout']))
	{
		session_unset();
		session_destroy();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			echo $title;
		?>
	</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
</head>

<body background="green-16.jpg" style="background-repeat: repeat;" >
	<header>
		<nav class="menu">
			<ul>
				<li><a style="padding: 7px 10px 5px 10px; " href="index.php"><img src="./images/home-page.png"/></a></li>
				<?php
					if(isset($_SESSION['login']))
					{
						echo '<li style="float: right;"><a href="?logout">Logout</a></li>';
						if($_SESSION['login-data']->jenis > -1)
						{
							echo '<li style="float: right; "><a style="padding: 7px 10px 5px 10px; " href="cart_page.php"><img src="./images/shopping-cart.png" /></a></li>';
						}
						else
						{
							echo '<li style="float: right;"><a href="admin_page.php">Admin</a></li>';
						}
					}
					else
					{
						echo '<li style="float: right;"><a href="login_page.php">Login</a></li>';
					}
				?>
			</ul>
		</nav> 	
	</header>

	