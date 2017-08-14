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

	if(isset($_GET['bayar']))
	{
		$id = $_GET['bayar'];
		updateTransaksiCart($id, 1);
	}
?>
<section>
	<div class="admin-page">
		<h2 class="nomargin">Cart</h2>
		<hr/>
		<h5 class="nomargin">Sudah dibayar, Menunggu pengiriman</h5>
		<table style="width: 100%;">
			<tr>
				<th>No.</th>
				<th>Cart</th>
				<th>Tanggal</th>
			</tr>
			<tr>
				<?php
					$jumlah_cart = 1;
					$data = getAllCartItemByUserID($_SESSION['login-data']->id, 1);
//					print_r($data);
//					echo "<br/>----------------------------------------<br/>";
					$cart = $data->isi;
			
					if(count($cart->isi)>0)
					{
						foreach($cart->isi as $cart_data)
						{
							$jumlah = 1;
							$total = 0;
//							print_r($cart_data);
							echo '<tr>';
								echo '<td>'.$jumlah_cart.'</td>';
								echo '<td>';
									?>
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
												if(count($cart_data->item)>0)
												{
													foreach($cart_data->item as $cart_item_data)
													{
														$barang = getBarangByID($cart_item_data->barang_id);
														$subtotal = $cart_item_data->jumlah*$barang->isi->harga;
														echo '	<tr>
																	<td class="nomor_cart">
																		'.$jumlah.' 
																	</td>
																	<td class="nama_cart">
																		'.$barang->isi->nama.'
																	</td>
																	<td class="harga_cart">
																		IDR. '.$barang->isi->harga.'
																	</td>
																	<td class="jumlah_cart">
																		'.$cart_item_data->jumlah.'
																	</td>
																	<td class="subtotal_cart">
																		IDR. '.$subtotal.'
																	</td>
																</tr>';
														
														$total = $total+$subtotal;
													}
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
									<?php
								echo '</td>';
								echo '<td>'.$cart_data->tanggal_tambah.'</td>';
							echo '</tr>';
							
							$jumlah_cart = $jumlah_cart+1;
						}
					}
				?>
			</tr>
		</table>
	</div>
</section>
<?php
	include('footer.php');
?>