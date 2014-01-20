<h1>Halaman yang dicari tidak bisa ditampilkan!</h1>
<? if ($sf_request->hasErrors()) { ?>
<div id="error" >
<?php 
  $es = $sf_request->getErrors();
  foreach ($es as $n=>$v) {
    echo "$n : $v <br/>";
  }
?>
</div>
<?php 

?>
<h3>Apakah anda mengetikkan sendiri alamat ini?</h3>
<p>
    Kemungkinan besar anda salah ketik atau HAK AKSES ANDA TIDAK MENCUKUPI. Coba cek untuk meyakinkan anda telah benar ejaan, huruf besar, maupun kodenya.
</p>
<h3>Apakah anda memilih link ini dengan cara click pada halaman lain?</h3>
<p>
  Kalau begitu, mohon hubungi webmaster mengenai masalah ini. Terima kasih.
</p>

<h3>Pilihan langkah selanjutnya :</h3>
<ul>
<LI><a href="javascript:history.back(-1)">Kembali ke halaman sebelumnya</a></LI>
<LI><?php echo link_to('Halaman Utama','@homepage')?></LI>
</ul>

