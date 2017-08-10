<?php
	$title = "Register";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		header('Location: index.php');
	}
?>
	<div class="login">
		<form style="width: 100%" action="action.php" method="post" enctype="multipart/form-data">
			<p style="text-align: center;">
				Selamat datang di toko kami<br>
				Silahkan isi form di bawah ini untuk menjadi member kami<br>
			</p>
			<ul>
				<li>Username:<input class="regis_form" type="text" id="username" name="username"/></li>
				<li>Password:<input class="regis_form" type="text" id="password" name="password"/></li>
				<li>Nama Lengkap:<input class="regis_form" type="text" id="namalengkap" name="namalengkap"></span></li>
				<li>Email:<input class="regis_form" type="Email" id="email" name="email"></span></li>
				<li>Nomor Telepon:<input class="regis_form" type="text" id="telepon" name="telepon"></span></li>
				<li>Alamat:<input class="regis_form" type="text" id="alamat" name="alamat"></span></li>
				<li><input type="checkbox" id="newsletter" name="newsletter" value="newsletter">Newsletter
				<span style="padding-left: 6em"></span><input type="checkbox" id="EULA_term" name="EULA_term" value="EULA_term" required><span style="text-decoration: underline;" onclick="sendmessage()"> EULA terms</span></li>
				<li><input style="margin-left: 30%;" class="btn" type="submit" value="register" name="action"></li>
				<li>Sudah mempunyai akun blabla, <a href="login_page.php">klik disini</a></li>
			</ul>
		</form>
	</div>
<?php
	include 'footer.php';
?>