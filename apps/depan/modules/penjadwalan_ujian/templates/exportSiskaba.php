<?php
$tglAwal=$sf_request->getParameter('tanggal','2013-10-21');
//$penjadwalan=new PenjadwalanUjian();
$jadwals = PenjadwalanUjian::generateTabelSoalUjian($ujian);
$jrIds = array_keys($jadwals);
foreach ($jrIds as $jrId) {
    $kodeKelass = array_keys( $jadwals[$jrId]['c'] );
    foreach($kodeKelass as $kodeKelas) {
         
//            list($kodeMk,$kp)=  explode('_', $kodeKelas);
            //KodeMK,KP,Ruang,UTS/UAS,JamKe,NPK,Pembuat,Koreksi
            $kodeMk = substr($kodeKelas,0,6);
            $n=  strlen($kodeKelas);
            $nKp=$n-10;
            $kp= substr($kodeKelas,6,$nKp);
            //$isi = ( isset($penjadwalan->pesertaMks[$kodeMk][$kp]) ) ? $penjadwalan->pesertaMks[$kodeMk][$kp] : 0;
            $isi=$jadwals[$jrId]['c'][$kodeKelas]['m']['kapasitas'];
            $minggu=$jadwals[$jrId]['j'];
            $hari=$jadwals[$jrId]['h'];
            $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
            $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);            
            list($t,$b,$h) = explode('-',$tglUjian);
            $tglUjian="$h/$b/$t";
              printf("%s;%s;%s;%s;0;%s;%s;%s;0;Esai;-\r\n", $kodeMk,$kp, $jadwals[$jrId]['r'], $isi,   $ujian, $tglUjian,  $jadwals[$jrId]['j']  );
              
            
         
    }
}
?>