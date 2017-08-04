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
?>