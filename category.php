<?php
	include 'config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Home
		</title>
		<style type="text/css">
			*{
				margin: 0;
				padding: 0;
			}

			header{
				background: #f00;
				height: 56px;
				width: 100%;
			}
			div#container, body
			{
				height: 100vh;
				width: 100%;
			}
			section{
				min-height: calc(100vh - 56px - 50px);
				width: 100%;
			}
			footer{
				background: #ff0;
				height: 50px;
				width: 100%;
			}
		</style>
	</head>

	<body>
		<div id="container">
			<header>

			</header>

			<section>
				<form method="post" action="action.php">
					<h1>Kategori</h1>
					<div>
						Nama
						<input type="text" name="nama" id="name">
						<input type="hidden" name="action" value="kategori-tambah" >
					</div>
					<input type="submit" value="Tambah">
				</form>
				
				<?php
					getAllKategoriHTML();
				?>
			</section>

			<footer>
				
			</footer>
		</div>
	</body>
</html>