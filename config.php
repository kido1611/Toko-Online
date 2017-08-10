<?php

	include 'Object.php';

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "webprog_tr";

	session_start();

	$conn = new mysqli($server, $username, $password, $database);


	if($conn->connect_error)
	{
		echo "failed to connect";
	}

	function registerUser($user)
	{
		global $conn;
		$message = new ObjectMessage();
		
		$sql = "select * from webprog_user where user_username='$user->username'";
		
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			$message->message = "User sudah ada";
			$message->sukses = 0;
		}
		else
		{
			$sql = "INSERT INTO `webprog_user` (`user_id`, `user_jenis`, `user_nama`, `user_email`, `user_username`, `user_password`, `user_alamat`, `user_nohp`, `user_tanggal_daftar`) VALUES (NULL, '$user->jenis', '$user->nama', '$user->email', '$user->username', '".base64_encode($user->password)."', '$user->alamat', '$user->no_hp', NOW());";
			$result = $conn->query($sql);

			$message->message = "Berhasil ditambahkan";
			$message->sukses = 1;
		}	
		
		return $message;
			
	}

	function getUser($username, $password)
	{
		global $conn;
		$message = new ObjectMessage();
		
		$sql = "select * from webprog_user where user_username='".mysqli_real_escape_string($conn, $username)."' and user_password='".base64_encode($password)."'";
		$result = $conn->query($sql);
		
		if($result->num_rows<1)
		{
			$message->message = "User tidak ada";
			$message->sukses = 0;
		}
		else
		{
			$data = $result->fetch_assoc();
		
			$user = new ObjectUser();
			$user->id = $data['user_id'];
			$user->jenis = $data['user_jenis'];
			$user->nama = $data['user_nama'];
			$user->email = $data['user_email'];
			$user->username = $data['user_username'];
			$user->password = $data['user_password'];
			$user->alamat = $data['user_alamat'];
			$user->ho_hp = $data['user_nohp'];

			$message->message = "User ditemukan";
			$message->sukses = 1;
			$message->isi = $user;
		}
		
		return $message;
	}

	function addKategori($nama)
	{
		global $conn;
		
		$sql = "INSERT INTO `webprog_kategori` (`kategori_id`, `kategori_nama`, `kategori_tanggal_tambah`, `kategori_index`) VALUES (NULL, '$nama', NOW(), '0');";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil ditambahkan";
		
		return $message;
	}

	function getAllKategori()
	{
		global $conn;
		
		$sql = "SELECT * FROM `webprog_kategori` order by `kategori_nama` asc";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 0;
		
		$num_result = $result->num_rows;
		if($num_result>0)
		{
			$message->sukses = 1;
			$data = array();
			while($rows = $result->fetch_assoc())
			{
				$kategori = new Objectkategori();
				$kategori->id = $rows['kategori_id'];
				$kategori->nama = $rows['kategori_nama'];
				$kategori->tanggal_tambah = $rows['kategori_tanggal_tambah'];
				$kategori->index = $rows['kategori_index'];
				$data[] = $kategori;
			}
			$message->isi = $data;
		}
		
		return $message;
	}

	function getAllKategoriHTML()
	{
		$message = getAllKategori();
		
		if($message->sukses==1)
		{
			echo "<ul>";
			foreach($message->isi as $data)
			{
				echo "<li>$data->nama</li>";
			}
			echo "</ul>";
		}
	}

	function getAllKategoriHTMLOption()
	{
		$message = getAllKategori();
		
		if($message->sukses==1)
		{
			foreach($message->isi as $data)
			{
				echo "<li>$data->nama</li>";
				echo "<option value='$data->id'>$data->nama</option>";
			}
		}
	}

	function getAllKategoriHTMLA()
	{
		$message = getAllKategori();
		
		if($message->sukses==1)
		{
			foreach($message->isi as $data)
			{
				echo "<a href='index.php?category=$data->id'>$data->nama</a>";
			}
		}
	}

	function addBarang($barang)
	{
		global $conn;
		
		$sql = "INSERT INTO `webprog_barang` (`barang_id`, `barang_nama`, `barang_harga`, `barang_kategori`, `barang_jumlah`, `barang_gambar`, `barang_tanggal_tambah`) VALUES ('', '$barang->nama', '$barang->harga', '$barang->kategori', '$barang->jumlah', '$barang->gambar', NOW());";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil ditambahkan";
		
		return $message;
	}

	function getAllBarang($sql)
	{
		global $conn;
		
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 0;
		
		$num_result = $result->num_rows;
		if($num_result>0)
		{
			$message->sukses = 1;
			$data = array();
			while($rows = $result->fetch_assoc())
			{
				$barang = new ObjectBarang();
				$barang->id = $rows['barang_id'];
				$barang->nama = $rows['barang_nama'];
				$barang->harga = $rows['barang_harga'];
				$barang->kategori = $rows['barang_kategori'];
				$barang->jumlah = $rows['barang_jumlah'];
				$barang->gambar = $rows['barang_gambar'];
				$barang->tanggal_tambah = $rows['barang_tanggal_tambah'];
				
				$data[] = $barang;
			}
			$message->isi = $data;
		}
		
		return $message;
	}

	function getAllBarangHTMLLI($sql)
	{
		$message = getAllBarang($sql);
		
		if($message->sukses==1)
		{
			foreach($message->isi as $data)
			{
				echo "<li><a href='index.php?barang=$data->id'>$data->nama</a><br/>"
					."<img src='$data->gambar' width='200px' height='200px'/>"
					."</li>";
			}
		}
		
	}
?>