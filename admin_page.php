<?php
	$title = "Admin";
	include 'header.php';

	if(isset($_SESSION['login']))
	{
		$jenis_login = $_SESSION['login-data']->jenis;	
		if($jenis_login!=-1)
		{
			header('Location: index.php');
		}
	}
	else
	{
		header('Location: index.php');
	}
?>
<section>
	<div class="admin">
		<form style="margin: auto; width: 1000px; text-align:center; " action="action.php" method="post" enctype="multipart/form-data">
			<p>
				Anda sedangkan menambahkan barang
			</p>
			<ul>
				<li>Nama barang : <input class="admin_form" type="text" id="nama_barang" name="nama_barang" required/></li>
				<li>Harga barang : <input class="admin_form" type="number" id="harga_barang" name="harga_barang" min="0" required/></li>
				<li>Jumlah barang : <input class="admin_form" type="number" id="jumlah_barang" name="jumlah_barang" required/></li>
				<li>Kategori barang : 
					<select style="float: right; margin-right: 50px;" name="kategori_barang" required>
						<option value="NULL" selected disabled>---Pilih kategori</option>
						<?php
							getAllKategoriHTMLOption();
						?>
					</select>
				</li>
				<li>
					Deskripsi barang : <br/>
					<textarea name="keterangan_barang" id="keterangan_barang" style="width: calc(100% - 32px - 20px); height: 70px;"></textarea>
				</li>
				<li>Gambar barang : <input style="margin-left: 4%;" type="file" value="Upload gambar" name="gambar_barang" required></li>
				<li>
					<input type="hidden" name="action" value="barang-tambah" >
					<input style="margin-left: 30%;" class="btn" type="submit" value="Tambah">
				</li>		
			</ul>
		</form>
		<form method="post" action="action.php" style="max-width: 70%; margin-left: 20%; margin-right: 20%; text-align:center; ">
			<h1>Kategori</h1>
			<div>
				Nama
				<input type="text" name="nama" id="name" required>
				<input type="hidden" name="action" value="kategori-tambah" >
			</div>
			<input style="margin: 10px;" type="submit" class="btn" value="Tambah">
		</form>
	</div>
</section>

<?php
	include('footer.php');
?>