<?php
	$title = "Home";
	include('header.php');
?>
<section>
	<div id="home-wrapper">
		<div id="sidebar">
			<h2>
				Kategori
			</h2>
			<hr/>
			<?php
				getAllKategoriHTML();
			?>
			<br/>
			<h2>
				Sortir
			</h2>
			<hr/>
		</div>
		<div id="content">
			<div id="search-bar">
				<form method="get" enctype="multipart/form-data">
					<input type="text" name="search" id="serch-bar-search-box" placeholder="Cari barang disini..." value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
				</form>
			</div>
			<hr/>
			<div id="barang-container">
				
				<?php
					$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_JUMLAH > 0 order by barang_tanggal_tambah desc";
					if(isset($_GET['search']))
					{
						$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_NAMA LIKE '%".$_GET['search']."%'";
					}
					else if(isset($_GET['category']))
					{
						$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_KATEGORI = ".$_GET['category'];
					}
					$message = getAllBarangHTMLDIV($sql);
				?>
			</div>
		</div>
	</div>
</section>
<!---
<div class="home">
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<?php
//			getAllKategoriHTMLA();
		?>
	</div>

	<div id="main">
		  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Category</span>
	</div>
	<div class="table_product">
		<ul>
			<?php
//				$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_JUMLAH > 0 order by barang_tanggal_tambah desc";
//				if(isset($_GET['category']))
//				{
//					$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_KATEGORI = ".$_GET['category'];
//				}
//				$message = getAllBarangHTMLLI($sql);
			
				//$jumlah = count($message->isi);
				
			?>
		</ul>
	</div>
</div>
--->
<?php
	include('footer.php');
?>