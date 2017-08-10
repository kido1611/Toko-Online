<?php
	$title = "Login";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		$data = $_SESSION['login-data'];
		echo "Selamat datang ".$data->nama;
	}
	else
	{
	?>
		<div class="login">
			<form action="action.php" method="post" enctype="multipart/form-data">
				<ul>
					<li >Username:<input class="login_form" type="text" id="username" name="username"/></li>
					<li >Password:<input class="login_form" type="password" id="password" name="password" /></li>
					<li ><input class="btn" type="submit" value="login" name="action"></li>
					<li >Belum mempunyai akun blabla, <a href="register_page.php">klik disini</a></li>
				</ul> 
			</form>
		</div>

	<?php
	}
		include 'footer.php';
?>