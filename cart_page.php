<?php
	$title = "Cart";
	include 'header.php';

	if(!isset($_SESSION['login']))
	{
		header('Location: login_page.php');
	}

	if(isset($_GET['delete-cartitem']))
	{
		$id = $_GET['delete-cartitem'];
		hapusCartItem($id);
	}
?>
<section>
	<div class="admin-page">
		<h2 class="nomargin">Cart</h2>
		<table style="width: 100%;">
			<tr>
				<th>
					No.
				</th>
				<th>
					Barang
				</th>
				<th>
					Harga
				</th>
				<th>
					Jumlah Barang
				</th>
				<th>
					Subtotal
				</th>
			</tr>
			<?php
				$jumlah = 1;
				$total = 0;
				$data = getAllCartItemByUserID($_SESSION['login-data']->id);
				$cart = $data->isi;
				$cart_item = $cart->item;
				foreach($cart_item as $data)
				{
					$barang = getBarangByID($data->barang_id);
					$subtotal = $data->jumlah*$barang->isi->harga;
					echo '	<tr>
								<td class="nomor_cart">
									'.$jumlah.' 
								</td>
								<td class="nama_cart">
									'.$barang->isi->nama.' (<a href="?delete-cartitem='.$data->id.'">Hapus</a>)
								</td>
								<td class="harga_cart">
									IDR. '.$barang->isi->harga.'
								</td>
								<td class="jumlah_cart">
									'.$data->jumlah.'
								</td>
								<td class="subtotal_cart">
									IDR. '.$subtotal.'
								</td>
							</tr>';
					$jumlah = $jumlah+1;
					$total = $total+$subtotal;
				}
			
			?>
			<tr>
				<td colspan="4" style="text-align: right;">
					<b>Total</b>&nbsp;&nbsp;
				</td>
				<td>
					IDR. <?php echo $total;?>
				</td>

			</tr>
		</table>
		<a class="button" href="cart_bayar.php">Bayar</a>
	</div>
</section>
<?php
	include('footer.php');
?>