<?php
	$title = "Admin page";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		$jenis_login = $_SESSION['login-data']->jenis;	
		if($jenis_login!=-1)
		{
			header('Location: index.php');
		}
	}
?>
	<div class="admin">
		<form style="max-width: 70%; margin-left: 20%; margin-right: 20%; text-align:center; " action="action.php" method="post" enctype="multipart/form-data">
			<p style="text-align: center;margin-top: 20px;margin-bottom: 20px;">
				Anda sedangkan menambahkan barang
			</p>
			<ul>
				<li>Nama barang : <input class="admin_form" type="text" id="nama_barang" name="nama_barang"/></li>
				<li>Harga barang : <input class="admin_form" type="number" id="harga_barang" name="harga_barang" min="0"/></li>
				<li>Jumlah barang : <input class="admin_form" type="number" id="jumlah_barang" name="jumlah_barang"/></li>
				<li>Kategori barang : 
					<select style="margin-left: 4%;" name="kategori_barang">
						<option value="NULL" selected disabled>---Pilih kategori</option>
						<?php
							getAllKategoriHTMLOption();
						?>
					</select>
				</li>
				<li>Gambar barang : <input style="margin-left: 4%;"  type="file" value="Upload gambar" name="gambar_barang" required></li>
				<li><input style="margin-left: 30%;" class="btn" type="submit" value="barang-tambah" name="action"></li>		
			</ul>
		</form>
		<form method="post" action="action.php" style="max-width: 70%; margin-left: 20%; margin-right: 20%; text-align:center; ">
			<h1>Kategori</h1>
			<div>
				Nama
				<input type="text" name="nama" id="name">
				<input type="hidden" name="action" value="kategori-tambah" >
			</div>
			<input type="submit" value="Tambah">
		</form>
	</div>


<?php
	include('footer.php');
?>