<?php
	class ObjectUser{
		var $id;				// user_id
		var $jenis;				// user_jenis
		var $nama;				// user_nama
		var $email;				// user_email
		var $username;			// user_username
		var $password;			// user_password
		var $alamat;			// user_alamat
		var $no_hp;				// user_nohp
		var $tanggal_daftar;	// user_tanggal_daftar
		var $newsletter;
	}

	class ObjectMessage{
		var $message;
		var $sukses;
		var $isi;
	}

	class Objectkategori{
		var $id;
		var $nama;
		var $tanggal_tambah;
		var $index;
	}

	class ObjectBarang{
		var $id;
		var $nama;
		var $harga;
		var $kategori;
		var $jumlah;
		var $gambar;
		var $tanggal_tambah;
		var $keterangan;
	}
?>