<?php
	$title = "Login";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		header('Location: index.php');
	}
	else
	{
	?>
		<section> 
			<div class="login">
				<br><br><br><br><br>
				<form method="post" action="action.php" enctype="multipart/form-data">
					<?php
						if(isset($_SESSION['message']))
						{
							if($_SESSION['message']->sukses == 0)
							{
								echo '	<br/><div class="error-div">'.$_SESSION['message']->message.'</div>
										<ul>
											<li >Username:<input class="login_form" type="text" id="username" name="username" value="'.$_SESSION['message']->isi->username.'"/></li>
											<li >Password:<input class="login_form" type="password" id="password" name="password" value="'.$_SESSION['message']->isi->password.'"/></li>
											<li >
												<input type="hidden" name="action" value="login">
												<input class="btn" type="submit" value="login">
											</li>
											<li >Belum mempunyai akun toko ini, <a href="register_page.php">klik disini</a></li>
										</ul> ';
							}
						}
						else
						{
							echo '	<ul>
										<li >Username:<input class="login_form" type="text" id="username" name="username"/></li>
										<li >Password:<input class="login_form" type="password" id="password" name="password" /></li>
										<li >
											<input type="hidden" name="action" value="login">
											<input class="btn" type="submit" value="login">
										</li>
										<li >Belum mempunyai akun toko ini, <a href="register_page.php">klik disini</a></li>
									</ul> ';
						}
					?>
				</form>	
			</div>
		</section>
		<?php
			unset($_SESSION['message']);
		?>
	<?php
	}
	include 'footer.php';
?>