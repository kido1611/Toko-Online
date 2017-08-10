<?php
	$title = "Home";
	include('header.php');
?>
<div class="home">
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<?php
			getAllKategoriHTMLA();
		?>
	</div>

	<div id="main">
		  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Category</span>
	</div>

	<?php
		if(isset($_SESSION['login']))
		{
			if($_SESSION['login-data']->jenis==-1)
			{
				echo '<div>'.  
						'<a href="admin_page.php"><input class="adm_btn" style="float: right; width: 200px" type="submit" name="tombol_admin" value="Tombol Admin" ></a>'.
						'</div>';
			}
		}
	?>	
	<div class="table_product">
		<ul>
			<?php
				$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_JUMLAH > 0 order by barang_tanggal_tambah desc";
				if(isset($_GET['category']))
				{
					$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_KATEGORI = ".$_GET['category'];
				}
				$message = getAllBarangHTMLLI($sql);
			
				//$jumlah = count($message->isi);
				
			?>
		</ul>
	</div>
</div>
<?php
	include('footer.php');
?>