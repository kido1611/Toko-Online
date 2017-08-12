<?php
	include 'config.php';

	$action = "";
	if(isset($_POST['action']))
	{
		$action = $_POST['action'];
		if($action=="register")
		{
			$user = new ObjectUser();
			
			$user->jenis = 1;
			$user->nama = $_POST['namalengkap'];
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];
			$user->email = $_POST['email'];
			$user->no_hp = $_POST['telepon'];
			$user->alamat = $_POST['alamat'];
			
			$message = registerUser($user);
			
		}
		else if($action=="login")
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$message = getUser($username, $password);
				
			if($message->sukses==0)
			{
				echo $message->message;
				header('Location: login_page.php', true, 303);
			}
			else
			{
				echo $message->message." ".$message->isi->nama;	
				$_SESSION['login'] = $message->isi->id;
				$_SESSION['login-data'] = $message->isi;
				header('Location: index.php');
			}
		}
		else if($action=="kategori-tambah")
		{
			$nama = $_POST['nama'];
			$message = addKategori($nama);
			
			echo $message->message;
		}
		else if($action=="barang-tambah")
		{	
			$barang = new ObjectBarang();
			$barang->nama = $_POST['nama_barang'];
			$barang->harga = $_POST['harga_barang'];
			$barang->kategori = $_POST['kategori_barang'];
			$barang->jumlah = $_POST['jumlah_barang'];
			$barang->keterangan = $_POST['keterangan_barang'];
			
			$target_dir = "barang/";
			$target_file = $target_dir . $barang->nama."_".basename($_FILES["gambar_barang"]["name"]);
			
			$barang->gambar = $target_file;
			
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				echo "Hanya file jpeg, jpg, dan png yang diperbolehkan";
			}
			else
			{
				if (move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $target_file)) {
					$message = addBarang($barang);
					echo $message->message;
					//header('Location: index.php');
				} else {
					echo "Eror saat mengupload gambar";
				}
			}
		}
	}
	else
	{
		echo "Action not found";
	}
?>