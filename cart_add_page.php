<?php
	$title = "Beli barang";
	include('header.php');

	if(isset($_SESSION['login']))
	{
		if(!isset($_GET['id']))
		{
			header('Location: index.php');
		}
	}
	else
	{
		header('Location: login_page.php');
	}

	$barang = getBarangByID($_GET['id']);
	$kategori = getKategoriByID($barang->isi->kategori);
?>
<section>
	<div class="admin-page">
		<form action="action.php" method="post" enctype="multipart/form-data" id="form-add-cart">
			<p>
				Anda akan membeli :
			</p>
			<br>
			<h3 class="nomargin"><?php echo $barang->isi->nama; ?></h3>
			<br>
			<h5 class="nomargin">IDR. <?php echo $barang->isi->harga; ?></h5>
			<h5 class="nomargin"><?php echo $kategori->isi->nama; ?></h5>
			<br>
			<br>
			<div>
				Jumlah barang : 
				<input type="number" name="jumlah_barang" id="jumlah_barang" min="0" max="5" required/>
			</div>
			<div>
				Keterangan :<br/>
				<textarea maxlength="160" cols="50" rows="5" name="keterangan_barang">
					
				</textarea>
			</div>
			<br>
			<div>
				<input type="hidden" name="action" value="cart-add"/>
				<input type="hidden" name="id_barang" value="<?php echo $barang->isi->id; ?>" />
				<a class="button" href="index.php">Batal</a>
				<a class="button" href="#" onClick="document.getElementById('form-add-cart').submit();">Beli</a>
			</div>
		</form>
		
		
	</div>	
</section>

<?php
	include('footer.php');
?>