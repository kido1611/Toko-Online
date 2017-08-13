<?php
	$title = "Tambah kategori";
	include 'header.php';
?>

<section>
	<div class="admin-page">
		<form method="post" action="action.php" style="max-width: 70%; margin-left: 20%; margin-right: 20%; text-align:center; ">
			<h1>Kategori</h1>
			<?php
				if(isset($_GET['id']))
				{
					$data = getKategoriByID($_GET['id']);
					?>
						<div>
							Nama : 
							<input type="text" name="nama" id="name" required value="<?php echo $data->isi->nama;?>">
							<input type="hidden" name="action" value="kategori-ubah" >
							<input type="hidden" name="id" value="<?php echo $data->isi->id; ?>" >
						</div>
						<input style="margin: 10px;" type="submit" class="btn" value="Ubah">
					<?php
				}
				else
				{
					?>
						<div>
							Nama : 
							<input type="text" name="nama" id="name" required>
							<input type="hidden" name="action" value="kategori-tambah" >
						</div>
						<input style="margin: 10px;" type="submit" class="btn" value="Tambah">
					<?php
				}
			?>
		</form>
	</div>
</section>
<?php
	include 'footer.php';
?>