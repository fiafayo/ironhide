<?php
$jadwals = PenjadwalanUjian::generateTabelSoalUjian('UTS');
$jrIds = array_keys($jadwals);
foreach ($jrIds as $jrId) {
    $kodeKelass = array_keys( $jadwals[$jrId]['c'] );
    foreach($kodeKelass as $kodeKelas) {
        foreach ( $jadwals[$jrId]['c'][$kodeKelas]['d'] as $dosen ) {
//            list($kodeMk,$kp)=  explode('_', $kodeKelas);
            //KodeMK,KP,Ruang,UTS/UAS,JamKe,NPK,Pembuat,Koreksi
            $kodeMk = substr($kodeKelas,0,6);
            $n=  strlen($kodeKelas);
            $nKp=$n-10;
            $kp= substr($kodeKelas,6,$nKp);
             
              printf("%s;%s;%s;%s;%s;%s;Ya;Ya\r\n", $kodeMk,$kp, $jadwals[$jrId]['r'], $ujian, $jadwals[$jrId]['j'], $dosen  );
            
        }
    }
}
?>