<?php
	$title = "Register";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		header('Location: index.php');
	}
	if(isset($_SESSION['message']))
	{
		if($_SESSION['message']->sukses==1)
		{
			header('Location: login_page.php');
		}
	}
?>
	<div class="login">
		<form style="width: 100%" action="action.php" method="post" enctype="multipart/form-data">
			<p style="text-align: center;">
				Selamat datang di toko kami<br>
				Silahkan isi form di bawah ini untuk menjadi member kami<br>
			</p>
			<?php
				if(isset($_SESSION['message']))
				{
					if($_SESSION['message']->sukses==0)
					{
						echo '<div class="error-div">'.$_SESSION['messsage']->message.'</div>';
					}
			?>
			<ul>
				<li>Username:<input class="regis_form" type="text" id="username" name="username" required value="<?php echo $_SESSION['message']->isi->username;?>"/></li>
				<li>Password:<input class="regis_form" type="password" id="password" name="password" required value="<?php echo $_SESSION['message']->isi->password;?>" /></li>
				<li>Nama Lengkap:<input class="regis_form" type="text" id="namalengkap" name="namalengkap" required value="<?php echo $_SESSION['message']->isi->nama;?>"></span></li>
				<li>Email:<input class="regis_form" type="Email" id="email" name="email" required value="<?php echo $_SESSION['message']->isi->email;?>"></span></li>
				<li>Nomor Telepon:<input class="regis_form" type="number" id="telepon" name="telepon" required value="<?php echo $_SESSION['message']->isi->no_hp;?>"></span></li>
				<li>Alamat:<input class="regis_form" type="text" id="alamat" name="alamat" required value="<?php echo $_SESSION['message']->isi->alamat;?>"></span></li>
				<li><input type="checkbox" id="newsletter" name="newsletter" value="newsletter">Newsletter
				<span style="padding-left: 6em"></span><input type="checkbox" id="EULA_term" name="EULA_term" value="EULA_term" required><span style="text-decoration: underline;" onclick="sendmessage()"> EULA terms</span></li>
				<li>
					<input type="hidden" value="register" name="action">
					<input style="margin-left: 30%;" class="btn" type="submit" value="Daftar">
				</li>
				<li>Sudah mempunyai akun, <a href="login_page.php">klik disini</a></li>
			</ul>	
			<?php		
					unset($_SESSION['message']);
				}
			else
			{
				echo '	<ul>
							<li>Username:<input class="regis_form" type="text" id="username" name="username" required/></li>
							<li>Password:<input class="regis_form" type="password" id="password" name="password" required/></li>
							<li>Nama Lengkap:<input class="regis_form" type="text" id="namalengkap" name="namalengkap" required></span></li>
							<li>Email:<input class="regis_form" type="Email" id="email" name="email" required></span></li>
							<li>Nomor Telepon:<input class="regis_form" type="text" id="telepon" name="telepon" required></span></li>
							<li>Alamat:<input class="regis_form" type="text" id="alamat" name="alamat" required></span></li>
							<li><input type="checkbox" id="newsletter" name="newsletter" value="newsletter">Newsletter
							<span style="padding-left: 6em"></span><input type="checkbox" id="EULA_term" name="EULA_term" value="EULA_term" required><span style="text-decoration: underline; cursor:pointer;" onclick="sendmessage()"> EULA terms</span></li>
							<li>
								<input type="hidden" value="register" name="action">
								<input style="margin-left: 30%;" class="btn" type="submit" value="Daftar">
							</li>
							<li>Sudah mempunyai akun, <a href="login_page.php">klik disini</a></li>
						</ul>';
			}
			?>
		</form>
	</div>
	<script src="js/javascript.js"></script>
<?php
	include 'footer.php';
?>