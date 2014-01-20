<?php
$sf_response->addJavascript('jquery-1.10.2.min.js');
$sf_response->addJavascript('/js/bs3/js/bootstrap.min.js');
$sf_response->addStylesheet('/js/bs3/css/bootstrap.min.css');
$sf_response->addStylesheet('/js/bs3/css/bootstrap-theme.css');
?>

<script type="text/javascript" >
var dosenId='';
var karyawanId='';
var dosenName='';
var karyawanName='';


function tambahDosen(json) {
    

    if (json.status=='200') {
        alert("Sudah berhasil ditambahkan ke daftar jaga, dosen "+dosenId );
    
        $('#tabel_dosen tr:last').after('<tr id="dsn_'+dosenId+'"><td>'
            +'<a alt="hapus"   href="#" onclick="hapusDosenClick('+dosenId
            +');"><span class="glyphicon glyphicon-remove "></span></a>'    
            
            +dosenName+'</td></tr>');
        loadListDosenNonJaga();
    } 
        
     
}

function tambahDosenClick() {
    dosenId=$('#dosen_add').val();
    dosenName=$('#dosen_add').find(":selected").text();
    $.getJSON(
        '<?php echo url_for('penjadwalan_ujian/addDosen')?>',
        { id: dosenId },
        tambahDosen
            );
}



function tambahKaryawan(json) {
    

    if (json.status=='200') {
         
function tambahDosen(json) {
    

    if (json.status=='200') {
        alert("Sudah berhasil ditambahkan ke daftar jaga, dosen "+dosenId );
    
        $('#tabel_dosen tr:last').after('<tr id="dsn_'+dosenId+'"><td>'
            +'<a alt="hapus"   href="#" onclick="hapusDosenClick('+dosenId
            +');"><span class="glyphicon glyphicon-remove "></span></a>'    
            
            +dosenName+'</td></tr>');
        loadListDosenNonJaga();
    } 
        
     
}

function tambahKaryawanClick() {
    karyawanId=$('#karyawan_add').val();
    karyawanName=$('#karyawan_add').find(":selected").text();
    $.getJSON(
        '<?php echo url_for('penjadwalan_ujian/addDosen')?>',
        { id: karyawanId },
        tambahDosen
            );
}

    
        $('#tabel_karyawan tr:last').after('<tr id="dsn_'+karyawanId+'"><td>'
            +'<a alt="hapus"   href="#" onclick="hapusKaryawanClick('+karyawanId
            +');"><span class="glyphicon glyphicon-remove "></span></a>'    
            
            +karyawanName+'</td></tr>');
        loadListKaryawanNonJaga();
    } 
        
     
}

function tambahKaryawanClick() {
    karyawanId=$('#karyawan_add').val();
    karyawanName=$('#karyawan_add').find(":selected").text();
    $.getJSON(
        '<?php echo url_for('penjadwalan_ujian/addKaryawan')?>',
        { id: karyawanId },
        tambahKaryawan
            );
}



function hapusKaryawan(json) {
    if (json.status=='200') {
       $('#kry_'+karyawanId).remove();
       loadListKaryawanNonJaga();
    }
    
}

function hapusDosen(json) {
    if (json.status=='200') {
       $('#dsn_'+dosenId).remove();
       loadListDosenNonJaga();
    }
}
function hapusDosenClick(id) {
    
    dosenId=id;
    $.getJSON(
            '<?php echo url_for('penjadwalan_ujian/delDosen');?>',
            { id: id},
            hapusDosen
        );
}
function hapusKaryawanClick(id) {
    
    karyawanId=id;
    $.getJSON(
            '<?php echo url_for('penjadwalan_ujian/delKaryawan');?>',
            { id: id},
            hapusKaryawan
        );
}

function loadListDosenNonJaga() {
     
    $.getJSON(
            '<?php echo url_for('penjadwalan_ujian/listDosenNonJaga');?>',
            function (json) {
                $('#dosen_add').html('');
                $.each(json, function(index, row) {
                   $('#dosen_add').append('<option value='+row.kode+'>'+row.kode+'.'+row.nama+'</option>');               
                });
            }
        );
    }

function loadListKaryawanNonJaga() {
     
    $.getJSON(
            '<?php echo url_for('penjadwalan_ujian/listKaryawanNonJaga');?>',
            function (json) {
                $('#karyawan_add').html('');
                $.each(json, function(index, row) {
                   $('#karyawan_add').append('<option value='+row.kode+'>'+row.kode+'.'+row.nama+'</option>');               
                });
            }
        );
    }


$(document).ready(function(){
    loadListDosenNonJaga();
    loadListKaryawanNonJaga();
}
);
</script> 
<div class="container">
<?php include_partial('penjadwalan_ujian/tab_atas', array( )); ?> 
   <h3>Proses Penjadwalan Ujian</h3>
   <div class="row">
        <div class="col-sm-9">
            <div class="panel panel-info">
                <div class="panel-heading">Daftarkan Dosen Jaga</div>
            
            <div class="panel-body">
                <form action="#" class="form-group">
                    <select name="dosen_add" id="dosen_add" >
                        <option value="0" >Pilih</option>
                    </select>
                    <input type="button" class="btn btn-sm btn-primary" onClick="tambahDosenClick();" name="tambahDosen"  value="Tambahkan" />
                </form>
            </div>
                </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-info">
                <div class="panel-heading">Daftarkan Karyawan Jaga</div>
            
            <div class="panel-body">
                <form action="#" class="form-group">
                    <select name="karyawan_add" id="karyawan_add" >
                        <option value="0" >Pilih</option>
                    </select>
                    <input type="button" class="btn btn-sm btn-primary" onClick="tambahKaryawanClick();" name="tambahDosen"  value="Tambahkan" />
                </form>
            </div>
                </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-6">
            <table class="table-bordered" id="tabel_dosen">
    <thead>
        <tr>
            <th>Daftar Dosen Jaga</th>
        </tr>
    </thead>
                <tbody>
                <?php 
                foreach ($penjadwalan->dosenReffs as $kode=>$nama) :
                ?>
                <tr id="dsn_<?php echo $kode;?>"><td>
                    <a alt="hapus"   href="#" onclick="hapusDosenClick('<?php echo $kode; ?>');">
                  <span class="glyphicon glyphicon-remove "></span>
                  </a>
                  <?php echo $kode.'.'.$nama; ?>
</td>
              </tr>             
              <?php
              endforeach;
              ?>
            </tbody>
            </table>    
        </div>
        <div class="col-sm-6">
<table class="table-bordered " id="tabel_karyawan">
    <thead>
        <tr>
            <th>Daftar Karyawan Jaga</th>
        </tr>
    </thead>
                <tbody>
                <?php 
                foreach ($penjadwalan->karyawanReffs as $kode=>$nama) :
                ?>
              <tr id="kry_<?php echo $kode;?>">
                  <td>
                  <a  alt="hapus"   href="#"  onclick="hapusKaryawanClick('<?php echo $kode; ?>');" >
                  <span class="glyphicon glyphicon-remove "></span>
                  </a>
                  <?php echo   $kode.'.'.$nama; ?>
                  </td>
              </tr>             
              <?php
              endforeach;
              ?>
              </tbody>
            </table>              
        </div>
        

              
        
         
            
        
      
     </div>
    
</div> 

<pre>
<?php //print_r( $penjadwalan->mataKuliahReffs ); ?>
</pre>