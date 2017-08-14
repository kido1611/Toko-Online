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
			$_SESSION['message'] = $message;
			header('Location: register_page.php');
		}
		else if($action=="login")
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$message = getUser($username, $password);
			
			$_SESSION['message'] = $message;
			
			if($message->sukses==0)
			{
				$user = new ObjectUser();
				$user->username = $username;
				$user->password = $password;
				$message->isi = $user;
				header('Location: login_page.php');
			}
			else
			{
				$_SESSION['login'] = $message->isi->id;
				$_SESSION['login-data'] = $message->isi;
				header('Location: index.php');
			}
		}
		else if($action=="kategori-tambah")
		{
			$nama = $_POST['nama'];
			$message = addKategori($nama);
			
			header('Location: admin_page.php');
		}
		else if($action=="kategori-ubah")
		{
			$nama = $_POST['nama'];
			$id = $_POST['id'];
			
			echo $nama." ".$id;
			$message = ubahKategori($id, $nama);
			
			header('Location: admin_page.php');
		}
		else if($action=="barang-tambah")
		{	
			$message = new ObjectMessage();
			$message->sukses = 0;

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
				$message->message =  "Hanya file jpeg, jpg, dan png yang diperbolehkan";
			}
			else
			{
				if (move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $target_file)) {
					$message = addBarang($barang);
				} else {
					$message->message =  "Hanya file jpeg, jpg, dan png yang diperbolehkan";
				}
			}
			
			header('Location: admin_page.php?barang');
		}
		else if($action=="barang-ubah")
		{	
			$message = new ObjectMessage();
			$message->sukses = 0;
			
			$barang = new ObjectBarang();
			$barang->id = $_POST['id_barang'];
			$barang->nama = $_POST['nama_barang'];
			$barang->harga = $_POST['harga_barang'];
			$barang->kategori = $_POST['kategori_barang'];
			$barang->jumlah = $_POST['jumlah_barang'];
			$barang->keterangan = $_POST['keterangan_barang'];
			
			if($_FILES['gambar_barang']["name"]!="")
			{
				$target_dir = "barang/";
				$target_file = $target_dir . $barang->nama."_".basename($_FILES["gambar_barang"]["name"]);

				$barang->gambar = $target_file;

				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$message->message =  "Hanya file jpeg, jpg, dan png yang diperbolehkan";
				}
				else
				{
					if (move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $target_file)) {
						//header('Location: index.php');
					} else {
						$message->message =  "Hanya file jpeg, jpg, dan png yang diperbolehkan";
					}
				}
			}
			
			$message = editBarang($barang);
			
			header('Location: admin_page.php?barang');
		}
		else if($action=="cart-add")
		{
			$id = $_POST['id_barang'];
			$jumlah = $_POST['jumlah_barang'];
			$keterangan = $_POST['keterangan_barang'];
			
			$cart = getCartByUserID($_SESSION['login-data']->id);
			
			$cart_item = new ObjectCartItem();
			$cart_item->cart_id = $cart->isi[0]->id;
			$cart_item->barang_id = $id;
			$cart_item->jumlah = $jumlah;
			$cart_item->keterangan = $keterangan;
			
			$message = addCartItem($cart_item);
			
			header('Location: index.php');
		}
		else
		{
			echo "Action not found";
		}
	}
	else
	{
		echo "Action not found";
	}
?>