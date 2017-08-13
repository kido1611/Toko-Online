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
			<select name="sort" required id="barang-sort-list" onChange="sort();">
				<option value="0" selected>Terbaru</option>
				<option value="1">Nama</option>
				<option value="2">Termahal</option>
				<option value="3">Termurah</option>
			</select>
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
					$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_JUMLAH > 0";
					if(isset($_GET['search']))
					{
						$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_NAMA LIKE '%".$_GET['search']."%'";
					}
					else if(isset($_GET['category']))
					{
						$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_KATEGORI = ".$_GET['category'];
					}
				
					if(isset($_GET['sort']))
					{
						if($_GET['sort']==1)
						{
							$sql = $sql." order by barang_nama asc";
						}
						else if($_GET['sort']==2)
						{
							$sql = $sql." order by barang_harga desc";
						}
						else if($_GET['sort']==3)
						{
							$sql = $sql." order by barang_harga asc";
						}
						else
						{
							$sql = $sql." order by barang_tanggal_tambah desc";
						}
					}
					else
					{
						$sql = $sql." order by barang_tanggal_tambah desc";
					}
				
					$message = getAllBarangHTMLDIV($sql);
				?>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function sort()
	{
		var list = document.getElementById("barang-sort-list");
		var value = list.value;
		
		var loc = window.location.href;
		
		if(loc.match("category") || loc.match("search"))
		{
			loc+="&sort="+value;
		}
		else
		{
			loc=window.location.pathname+"?sort="+value;
		}
		
		window.location.href=loc;
	}
</script>
<?php
	include('footer.php');
?>