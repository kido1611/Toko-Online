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

	if(isset($_GET['delete-category']))
	{
		$id = $_GET['delete-category'];
		hapusKategori($id);
	}
	else if(isset($_GET['delete-barang']))
	{
		$id = $_GET['delete-barang'];
		hapusBarang($id);
	}
?>
<section>
	<div class="admin-page">
		<a href="?kategori" class="button">Kategori</a> <a href="?barang" class="button">Barang</a>
	</div>
	<?php
		if(isset($_GET['kategori']))
		{
			?>
				<div id="admin-kategori" class="admin-page">
					<h3 class="nomargin">Kategori</h3>
					<a href="admin_page_category_add.php" class="button">Tambah kategori</a>
					<br/>
					<table>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Tanggal ditambah</th>
							<th>Aksi</th>
						</tr>
						<?php
							$hasil = getAllKategori();
							$jumlah = 1;
							foreach($hasil->isi as $data)
							{
								echo 	"<tr>
											<td>$jumlah</td>
											<td>$data->nama</td>
											<td>$data->tanggal_tambah</td>
											<td><a href='admin_page_category_add.php?id=$data->id'>Ubah</a> <a href='?delete-category=$data->id'>Hapus</a></td>
										</tr>";
								$jumlah = $jumlah+1;
							}
						?>
					</table>
				</div>
			<?php
		}
		else
		{
			?>
				<div id="admin-barang" class="admin-page">
					<h3 class="nomargin">Barang</h3>
					<a href="admin_page_product_add.php" class="button">Tambah barang</a>
					<br/>
					<table>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Kategori</th>
							<th>Jumlah</th>
							<th>Tanggal ditambah</th>
							<th>Aksi</th>
						</tr>
						<?php
							$sql = "Select * from webprog_barang";
							$hasil = getAllBarang($sql);
							$jumlah = 1;
							foreach($hasil->isi as $data)
							{
								$kategori = getKategoriByID($data->kategori)->isi;
								echo 	"<tr>
											<td>$jumlah</td>
											<td>
												<img class='image-cover image-admin-barang' src='$data->gambar'/>
												<br/>
												<a href='product_page.php?id=$data->id'>$data->nama</a>
											</td>
											<td>IDR. $data->harga</td>
											<td>$kategori->nama</td>
											<td>$data->jumlah</td>
											<td>$data->tanggal_tambah</td>
											<td><a href='admin_page_product_add.php?id=$data->id'>Ubah</a> <a href='?delete-barang=$data->id'>Hapus</a></td>
										</tr>";
								$jumlah = $jumlah+1;
							}
						?>
					</table>
				</div>
			<?php
		}
	?>
</section>

<?php
	include('footer.php');
?>