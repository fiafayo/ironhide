<?php
$isi='';
$isiNama='';
foreach ($jurusans as $jurusan) {
    $isi .= '"'.$jurusan->getKodeJur().'",';
    $isiNama .= '"'.$jurusan->getNama().'",';
}
$isi=substr($isi,0,strlen($isi)-1 );
$isiNama=substr($isiNama,0,strlen($isiNama)-1 );

?>         

<script type="text/javascript"> 
    var daftarkelas = '';
    var gantikelas = '';
    
    $(document).ready(function() {
        $('.showable').hide();
    });
    
    function getNamaHari(idx) {
        var arNames=Array(
           'Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'
        );
            return arNames[idx];
            
    }
    function getNamaJurusan(kode) 
    {
        
        var kodes = new Array(<?php  echo $isi; ?>);            
        var names = new Array(<?php  echo $isiNama; ?>);            
        var idx=0;
        for (var i=0; i<kodes.length; i++) {
            if ( kodes[i] == (kode) ) {
                 
                idx=i;
                break;
            }
        }
        return names[idx];
    }
    
    function changeNrp() {
        var nrp=$('#kaskus_nrp');
        
   
                $('#kaskus_mk').html('<tr><th>Kode</th><th>Nama</th><th>KP</th><th>SKS</th><th>Jadwal</th><th>Jadwal Ujian</th></tr> ');
                $('#kaskus_lama').html('<option value="-">--- pilih salah satu ---</option>');
                $('#kaskus_baru').html('<option value="-">--- pilih salah satu ---</option>');
                $('#kaskus_kelas').html('<tr><th>Kode</th><th>Nama</th><th>KP</th><th>SKS</th><th>Jadwal Kuliah</th><th>Jadwal Ujian</th></tr> ');
    
    
        $.getJSON(
            "<?php echo url_for('kaskus/getMhs')?>", //url
            {nrp: nrp.val()}, //array of data
            function(returneddata){ //callback
                daftarkelas=returneddata;
                $('#kaskus_nama').html(returneddata.mhs.nama);
                $('#kaskus_jurusan').html( getNamaJurusan( returneddata.mhs.jurusan ) );
                var panels=$('.showable');
                panels.show();
                    
                
                var jmlSks=0;
                 
                $.each(returneddata.daftar, function(i,item){
                     
                    $('#kaskus_mk').append('<tr><td>'+item.kode+'</td><td>'+item.nama+'</td><td align="center">'+item.kp+'</td><td align="center">'+item.sks+'</td><td align="left">'+item.jadwal+'</td><td align="left">'+item.jadwalu+'</td></tr>');
                    $('#kaskus_lama').append('<option value="'+item.kode+item.kp+'">'+item.kode+'.'+item.nama+' ('+item.sks+' SKS)</option>'); 
                    jmlSks+=item.sks;
                });
                $('#kaskus_mk').append('<tr><th colspan="3">Jumlah SKS</th><th>'+jmlSks+'</th><th>&nbsp;</th><th>&nbsp;</th></tr>');
                
                $.each(returneddata.kelas, function(i,item){
                    $('#kaskus_baru').append('<option value="'+item.kode+'">'+item.kode_mk+'.'+item.nama+' (KP='+item.kp+' '+item.sks+' SKS)</option>'); 
                });
                
              
            }
        )
        };    
    function changeMk() {
        var baru=$('#kaskus_baru');
        var nrp=$('#kaskus_nrp');
        var lama=$('#kaskus_lama');
        var masalah=$('#kaskus_masalah');
   
        $('#kaskus_kelas').html('<tr><th>Kode</th><th>Nama</th><th>KP</th><th>SKS</th><th>Jadwal Kuliah</th><th>Jadwal Ujian</th><th>Kapasitas</th><th>Kursi Kosong</th></tr> ');
        masalah.html('');
        $.getJSON(
            "<?php echo url_for('kaskus/getMk')?>", //url
            {baru: baru.val(), nrp: nrp.val(), lama: lama.val()}, //array of data
            function(returneddata){ //callback
                gantikelas=returneddata;
                $('#kaskus_masalah').html(returneddata.masalah);
                
                $.each(returneddata.mk, function(i,item){
                    var jadwalText=item.jadwal;
                     
                    $('#kaskus_kelas').append('<tr><td>'+item.kode+'</td><td>'+item.nama+'</td><td>'+item.kp+'</td><td>'+item.sks
                        +'</td><td>'+jadwalText+'</td><td>'+item.jadwalu
                        +'</td><td>'+item.kap+'</td><td>'+item.kk
                        +'</td></tr>');
                    
                    
                });
            }
        )
        };      
    function simpan() {
        var baru=$('#kaskus_baru');
        var nrp=$('#kaskus_nrp');
        var lama=$('#kaskus_lama');
        var masalah=$('#kaskus_masalah');
        if (baru.val()=='-') {
            alert("Pilihan mata kuliah pengganti tidak boleh kosong !");
            return false;
        }
   
        if (lama.val()=='-') {
            alert("Pilihan mata kuliah yang dibatalkan tidak boleh kosong !");
            return false;
        }
        
        if (masalah.html()!='') {
            alert("Penggantian ini masih bermasalah, tidak bisa disimpan !");
            return false;
        }
        
        $('#kaskus_masalah').html('');
        $.getJSON(
            "<?php echo url_for('kaskus/update')?>", //url
            {baru: baru.val(), nrp: nrp.val(), lama: lama.val()}, //array of data
            function(returneddata){ //callback
                $('#kaskus_masalah').html(returneddata.masalah);
            }
        )
        };          
        
        
    function batal() {
        var nrp=$('#kaskus_nrp');
        var lama=$('#kaskus_lama');
   
        if (lama.val()=='-') {
            alert("Pilihan mata kuliah yang dibatalkan tidak boleh kosong !");
            return false;
        }
        
        
        $('#kaskus_masalah').html('');
        $.getJSON(
            "<?php echo url_for('kaskus/batal')?>", //url
            {nrp: nrp.val(), lama: lama.val()}, //array of data
            function(returneddata){ //callback
                $('#kaskus_masalah').html(returneddata.masalah);
            }
        )
        };                  
</script>
<div id="sf_admin_container">
    <h2>Input Batal dan Tambah di Kasus Khusus</h2>
    <form action="<?php echo url_for('/kaskus/update');?>" method="post">
    <table border="0" cellspacing="2" cellpadding="2">
        <tr>
            <th>Nrp :</th>
            <td><input type="text" name="kaskus[nrp]" value="" onblurr="changeNrp()"   id="kaskus_nrp" size="20" /> <input type="button" name="loadBtn" value="load" onclick="changeNrp()"  /> <span style="color:red">Ketik NRP dan tekan tombol Load</span></td>
        </tr>
        <tr class="showable" >
            <th>Nama :</th>
            <td><span id="kaskus_nama"  /></span> </td>
        </tr>
        <tr class="showable" >
            <th>Jurusan :</th>
            <td><span id="kaskus_jurusan"  /></span> </td>
        </tr>
        <tr class="showable" >
            <td colspan="2" valign="top">Mata Kuliah Yang Sudah Diambil :<br/>
            
                <table border="1" cellpadding="2"  cellspacing="1" id="kaskus_mk"  >
                                       
                </table> 
            </td>
        </tr>        
        <tr class="showable" >
            <th valign="top">Mata Kuliah Yang Akan Dibatalkan :</th>
            <td>
                <select  id="kaskus_lama" name="kaskus[batal]"   onchange="changeMk()" >
                                       
                </select> 
            </td>
        </tr>        
        <tr class="showable" >
            <th valign="top">Kode Mata Kuliah Pengganti :</th>
            <td><select name="kaskus[ganti]"   onchange="changeMk()" id="kaskus_baru" >
                </select>
            </td>
        </tr>        
        <tr class="showable" >
            <th>Pilihan Kelas Mata Kuliah:</th>
            <td> 
                <table border="1" cellpadding="2"  cellspacing="1" id="kaskus_kelas"  >
                                       
                </table>                 
            </td>
        </tr>    
        <tr class="showable" >
            <td colspan="2">
                <span id="kaskus_masalah" style="color:red">Permasalahan: tidak ada</span>
            </td>
        </tr>
        <tr class="showable" >
            <td colspan="2">
                <input type="button" name="simpanBtn" value="Batal dan Tambah" onclick="simpan()" />
                <input type="button" name="simpanBtn" value="Batalkan Saja" onclick="batal()" />
            </td>
        </tr>
    </table>
    </form>
</div>