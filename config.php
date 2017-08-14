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
		$message->isi = $user;
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

	function getAllKategoriHTML($id="kategori_list")
	{
		$message = getAllKategori();
		
		if($message->sukses==1)
		{
			echo '<ul id="'.$id.'">';
			foreach($message->isi as $data)
			{
				echo "<li><a href='index.php?category=$data->id'>$data->nama</a></li>";
			}
			echo "</ul>";
		}
	}

	function getAllKategoriHTMLOption($selected = -1)
	{
		$message = getAllKategori();
		echo $selected;
		if($message->sukses==1)
		{
			foreach($message->isi as $data)
			{
//				echo "<li>$data->nama</li>";
				if($selected==$data->id)
				{
					echo "<option value='$data->id' selected>$data->nama</option>";
				}
				else
				{
					echo "<option value='$data->id'>$data->nama</option>";
				}
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
		
		$sql = "INSERT INTO `webprog_barang` (`barang_id`, `barang_nama`, `barang_harga`, `barang_kategori`, `barang_jumlah`, `barang_gambar`, `barang_tanggal_tambah`, `barang_keterangan`) VALUES ('', '$barang->nama', '$barang->harga', '$barang->kategori', '$barang->jumlah', '$barang->gambar', NOW(), '$barang->keterangan');";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil ditambahkan";
		
		return $message;
	}

	function editBarang($barang)
	{
		global $conn;
		
		$sql = "UPDATE `webprog_barang` SET 
					`barang_nama` = '$barang->nama', 
					`barang_harga` = '$barang->harga', 
					`barang_kategori` = '$barang->kategori', 
					`barang_jumlah` = '$barang->jumlah', 
					`barang_keterangan` = '$barang->keterangan' 
				WHERE `webprog_barang`.`barang_id` = $barang->id";
		$result = $conn->query($sql);
		
		if($barang->gambar != null || $barang->gambar!="")
		{
			$sql = "UPDATE `webprog_barang` SET 
				`barang_gambar` = '$barang->gambar' 
				WHERE `webprog_barang`.`barang_id` = $barang->id";
			$result = $conn->query($sql);
		}
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil diubah";
		
		return $message;
	}

	function hapusBarang($id)
	{
		global $conn;
		
		$sql = "DELETE FROM `webprog_barang` WHERE `webprog_barang`.`barang_id` = $id";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil dihapus";
		
		return $message;
	}

	function ubahKategori($id, $nama)
	{
		global $conn;
		
		$sql = "UPDATE `webprog_kategori` SET `kategori_nama` = '$nama' WHERE `webprog_kategori`.`kategori_id` = $id;";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil diubah";
		
		return $message;
	}

	function hapusKategori($id)
	{
		global $conn;
		
		$sql = "DELETE FROM `webprog_kategori` WHERE `webprog_kategori`.`kategori_id` = $id";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil dihapus";
		
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

	function getAllBarangHTMLDIV($sql)
	{
		$message = getAllBarang($sql);
		
		if($message->sukses==1)
		{
			if(count($message->isi) < 1)
			{
				echo "<h3 class='nomargin'>Barang tidak ada</h3>";
				return;
			}
			foreach($message->isi as $data)
			{
				?>
					<div class="barang-item">
						<a href="product_page.php?id=<?php echo $data->id; ?>">
							<img src="<?php echo $data->gambar; ?>" class="barang-item-gambar">
						</a>
						<div class="barang-item-info">
							<span class="barang-item-info-nama">
								<a href="product_page.php?id=<?php echo $data->id; ?>" title="<?php echo $data->nama;?>">
									<?php 
										if(strlen($data->nama)>15){
											echo substr($data->nama, 0, 12)."...";
										}else{
											echo $data->nama; 
										}
									?>
								</a>
							</span>
							<span class="barang-item-info-harga">IDR <?php echo $data->harga; ?></span>
							<?php
								if(isset($_SESSION['login']))
								{
									if($_SESSION['login-data']->jenis > -1)
									{
										?>
											<div class="barang-item-info-whist">
												<?php
													if(isset($_SESSION['login']))
													{
														echo '<img class="barang-item-whislist" src="images/like.png" >';
													}
												?>
												<a href="cart_add_page.php?id=<?php echo $data->id;?>"><img class="barang-item-cart" src="images/cart.png"></a>
											</div>
										<?php
									}
								}
								else
								{
									?>
										<div class="barang-item-info-whist">
											<?php
												if(isset($_SESSION['login']))
												{
													echo '<img class="barang-item-whislist" src="images/like.png" >';
												}
											?>
											<a href="cart_add_page.php?id=<?php echo $data->id;?>"><img class="barang-item-cart" src="images/cart.png"></a>
										</div>
									<?php
								}
							?>
						</div>
					</div>
				<?php
			}
		}
		else
		{
			echo "<h3 class='nomargin'>Barang tidak ada</h3>";
		}
		
	}
	function getBarangByID($id)
	{
		global $conn;
		
		$sql = "SELECT * FROM WEBPROG_BARANG WHERE BARANG_ID = '$id'";

		
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 0;
		
		$num_result = $result->num_rows;
		if($num_result>0)
		{
			$data = $result->fetch_assoc();
			
			$barang = new ObjectBarang();
			$barang->id = $data['barang_id'];
			$barang->nama = $data['barang_nama'];
			$barang->harga = $data['barang_harga'];
			$barang->kategori = $data['barang_kategori'];
			$barang->jumlah = $data['barang_jumlah'];
			$barang->gambar = $data['barang_gambar'];
			$barang->tanggal_tambah = $data['barang_tanggal_tambah'];
			$barang->keterangan = $data['barang_keterangan'];
				
			$message->message = "Barang ditemukan";
			$message->sukses = 1;
			$message->isi = $barang;
		}
		
		return $message;
	}
	function getKategoriByID($id)
	{
		global $conn;
		
		$sql = "SELECT * FROM webprog_kategori where kategori_id = '$id'";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 0;
		
		$num_result = $result->num_rows;
		if($num_result>0)
		{
			$rows = $result->fetch_assoc();

			$kategori = new Objectkategori();
			$kategori->id = $rows['kategori_id'];
			$kategori->nama = $rows['kategori_nama'];
			$kategori->tanggal_tambah = $rows['kategori_tanggal_tambah'];
			$kategori->index = $rows['kategori_index'];
			
			$message->message = "Kategori ditemukan";
			$message->sukses = 1;
			$message->isi = $kategori;
		}
		else
		{
			$kategori = new Objectkategori();
			$kategori->nama = "Tidak ada";
			$message->isi = $kategori;
		}
		
		return $message;
	}

	function getCartByUserID($id, $transaksi=0)
	{
		global $conn;
		
		$message = new ObjectMessage();
		$message->sukses = 0;
		
		$sql = "SELECT * FROM `webprog_cart` WHERE user_id=$id and cart_transaksi = $transaksi";
		$result = $conn->query($sql);
		
		if($result->num_rows < 1 && $transaksi==0)
		{
			$sql = "INSERT INTO `webprog_cart` (`cart_id`, `user_id`, `cart_jasa_kirim`, `cart_tanggal_tambah`, `cart_transaksi`) VALUES (NULL, '$id', '0', NOW(), '0');";
			$result = $conn->query($sql);
			
			$sql = "SELECT * FROM `webprog_cart` WHERE user_id=$id and cart_transaksi = $transaksi";
			$result = $conn->query($sql);
		}
		
		if($result->num_rows > 0)
		{
			
			$message->sukses = 1;
			$data = array();
			while($rows = $result->fetch_assoc())
			{
				$cart = new ObjectCart();
				$cart->id = $rows['cart_id'];
				$cart->user_id = $rows['user_id'];
				$cart->jasa_kirim = $rows['cart_jasa_kirim'];
				$cart->tanggal_tambah = $rows['cart_tanggal_tambah'];
				$cart->transaksi = $rows['cart_transaksi'];
				
				$data[] = $cart;
			}
			
			$message->sukses = 1;
			$message->message = "Cart ada";
			$message->isi = $data;
		}
		else
		{
			$message->message = "Cart tidak ada";
		}
		
		return $message;
	}

	function addCartItem($cart_item)
	{
		global $conn;
		
		$sql = "INSERT 
				INTO `webprog_cart_item` (`cart_item_id`, `cart_id`, `barang_id`, `cart_item_jumlah`, `cart_item_keterangan`, `cart_item_tanggal_tambah`) 
				VALUES (NULL, '$cart_item->cart_id', '$cart_item->barang_id', '$cart_item->jumlah', '$cart_item->keterangan', NOW());";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil ditambahkan";
		
		return $message;
	}

	function getAllCartItemByCart($cart)
	{
		global $conn;
		
		$sql = "SELECT * FROM `webprog_cart_item` WHERE cart_id=$cart";
		
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
				$cart_item = new ObjectCartItem();
				$cart_item->id = $rows['cart_item_id'];
				$cart_item->cart_id = $rows['cart_id'];
				$cart_item->barang_id = $rows['barang_id'];
				$cart_item->jumlah = $rows['cart_item_jumlah'];
				$cart_item->keterangan= $rows['cart_item_keterangan'];
				$cart_item->tanggal_tambah = $rows['cart_item_tanggal_tambah'];
				
				$data[] = $cart_item;
			}
			$message->isi = $data;
		}
		
		return $message;
	}

	function getAllCartItemByUserID($id, $transaksi=0)
	{
		global $conn;
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		
		$cart = getCartByUserID($id, $transaksi);	
		
		if(count($cart->isi)>0)
		{
			foreach($cart->isi as $data)
			{
				$cart_item = getAllCartItemByCart($data->id);
				$data->item = $cart_item->isi;
			}
		}
		
		$message->isi = $cart;
		
		return $message;
	}

	function getAllCartItem($transaksi=0)
	{
		global $conn;
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		
		$cart = getCartByUserID($id, $transaksi);	
		
		if(count($cart->isi)>0)
		{
			foreach($cart->isi as $data)
			{
				$cart_item = getAllCartItemByCart($data->id);
				$data->item = $cart_item->isi;
			}
		}
		
		$message->isi = $cart;
		
		return $message;
	}

	function hapusCartItem($id)
	{
		global $conn;
		
		$sql = "DELETE FROM `webprog_cart_item` WHERE `webprog_cart_item`.`cart_item_id` = $id";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil dihapus";
		
		return $message;
	}

	function updateTransaksiCart($cart_id, $transaksi)
	{
		global $conn;
		
		$sql = "UPDATE `webprog_cart` SET `cart_transaksi` = '$transaksi' WHERE `webprog_cart`.`cart_id` = $cart_id";
		$result = $conn->query($sql);
		
		$message = new ObjectMessage();
		$message->sukses = 1;
		$message->message = "Berhasil diubah";
		
		return $message;
	}
?>