function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
}

function sendmessage()
{
	
    var myWindow = window.open("", "MsgWindow", "width=1000,height=600");
    myWindow.document.write
		("<h1>Ketentuan Umum :</h1>"+
"<ol>"+
	"<li>Konfirmasi pembayaran hanya dilakukan setelah benar-benar sudah transfer sesuai dengan nominal yang kami informasikan. Jika ternyata konfirmasi pembayaran dilakukan sebelum transfer, maka order akan kami batalkan.</li>"+
	"<li>Total pesanan yang valid adalah total dalam rupiah yang sudah ditambahkan ongkos kirim. Jika ongkos kirim belum termasuk dalam perhitungan, mohon hubungi admin.</li>"+
	"<li>Order yang sudah diinput hanya akan berlaku 3x24 jam, lakukan payment dan konfirmasikan payment sebelum melewati batas tersebut, atau order akan otomatis dibatalkan oleh sistem dan dianggap HIT & RUN.</li>"+
	"<li>Pastikan membayar order yang sudah diinput atau konfirmasikan kepada kami jika ingin membatalkan order.</li>"+
	"<li>Jika ada barang yang ternyata kosong, kami akan menghubungi buyer apakah kelebihan dananya mau di-refund atau diganti dengan barang lain. Order akan ditotal ulang, apabila dananya kurang maka buyer harus mentransfer kekurangannya, jika lebih maka akan kami refund. Pesanan hanya akan dikirim setelah kami menerima konfirmasi lebih lanjut dari buyer.</li>"+
	"<li>Setiap buyer yang melakukan order dianggap sudah membaca dan menyetujui syarat dan ketentuan yang kami buat.</li>"+
"</ol>"+
"<br><br>"+
"<h1>Pengiriman :</h1>"+
"<ol>"+
	"<li>Barang hanya dikirim apabila buyer sudah melakukan konfirmasi transfer atas order yang sudah dilakukan dan uang yang ditransfer sudah masuk ke rekening kami.</li>"+
	"<li>Apabila konfirmasi transfer kami terima paling lambat pukul 15.00 WIB (Senin-Jumat, kecuali tanggal merah) maka barang akan kami kirim di hari yang sama. Jika konfirmasi dilakukan lewat dari pukul 15.00 maka barang akan dikirim di hari kerja berikutnya.</li>"+
	"<li>Setiap barang yang dikirim akan diperiksa satu per satu untuk memastikan tidak ada cacat/rusak dan kami kemas sebaik mungkin untuk menghindari kerusakan selama pengiriman oleh kurir.</li>"+
	"<li>Kerusakan akibat kurir tidak menjadi tanggung jawab kami. Buyer bisa memastikan mendapat penggantian dari pihak kurir jika barang diterima dalam keadaan cacat dengan membayar biaya asuransi kepada kurir, yang berarti penambahan ongkos kirim. Konfirmasikan kepada kami jika anda ingin paket anda diasuransikan dan kami akan menghitung ulang total ongkos kirim yang harus dibayarkan.</li>"+
"</ol>");
	}
