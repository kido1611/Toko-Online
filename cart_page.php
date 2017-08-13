<?php
	$title = "Cart";
	include 'header.php';
?>
<section>
	<div class="table_cart">
		<table style="width: 100%;">
			<tr>
				<th>
					No.
				</th>
				<th colspan="2">
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
			<tr>
				<td class="nomor_cart">
					urutan_brg
				</td>
				<td class="gambar_cart">
					gambar_brg
				</td>
				<td class="nama_cart">
					nama_brg
				</td>
				<td class="harga_cart">
					harga_brg
				</td>
				<td class="jumlah_cart">
					jumlah_brg
				</td>
				<td class="subtotal_cart">
					subtotal_brg
				</td>
			</tr>
			<tr>
				<td colspan="5" style="text-align: right;">
					total
				</td>
				<td>
					12345
				</td>

			</tr>
		</table>
		
	</div>
</section>
<?php
	include('footer.php');
?>