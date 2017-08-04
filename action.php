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
			$user->nama = $_POST['nama'];
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];
			$user->email = $_POST['email'];
			$user->no_hp = $_POST['telepon'];
			$user->alamat = $_POST['alamat'];
			
			$message = registerUser($user);
			
			echo $message->message;
		}
		else if($action=="login")
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$message = getUser($username, $password);
				
			if($message->sukses==0)
			{
				echo $message->message;
			}
			else
			{
				echo $message->message." ".$message->isi->nama;	
			}
		}
	}
	else
	{
		echo "Action not found";
	}
?>