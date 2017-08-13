<?php
	$title = "Tambah barang";
	include 'header.php';
?>

<section>
	<div class="admin-page admin">
		<form style="margin: auto; width: 1000px; text-align:center; " action="action.php" method="post" enctype="multipart/form-data">
			<?php
				if(isset($_GET['id']))
				{
					$data = getBarangByID($_GET['id']);
					?>
						<p>
							Anda sedangkan mengubah barang
						</p>
						<ul>
							<li>Nama barang : <input class="admin_form" type="text" id="nama_barang" name="nama_barang" required value="<?php echo $data->isi->nama;?>"/></li>
							<li>Harga barang : <input class="admin_form" type="number" id="harga_barang" name="harga_barang" min="0" required value="<?php echo $data->isi->harga;?>"/></li>
							<li>Jumlah barang : <input class="admin_form" type="number" id="jumlah_barang" name="jumlah_barang" required value="<?php echo $data->isi->jumlah;?>"/></li>
							<li>Kategori barang : 
								<select style="float: right; margin-right: 50px;" name="kategori_barang" required>
									<option value="NULL" disabled>---Pilih kategori</option>
									<?php
										getAllKategoriHTMLOption($data->isi->kategori);
									?>
								</select>
							</li>
							<li>
								Deskripsi barang : <br/>
								<textarea name="keterangan_barang" id="keterangan_barang" style="width: calc(100% - 32px - 20px); height: 70px;"><?php echo $data->isi->keterangan;?></textarea>
							</li>
							<li>
								Gambar barang : <input style="margin-left: 4%;" type="file" value="Upload gambar" name="gambar_barang">
								<br/>
								<img class='image-cover image-admin-barang' src='<?php echo $data->isi->gambar?>'/>
							</li>
							<li>
								<input type="hidden" name="action" value="barang-ubah" >
								<input type="hidden" name="id_barang" value="<?php echo $data->isi->id?>" >
								<input style="margin-left: 30%;" class="btn" type="submit" value="Ubah">
							</li>		
						</ul>
					<?php
				}
				else
				{
					?>
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
					<?php
				}
			?>
		</form>
	</div>
</section>
<?php
	include 'footer.php';
?>