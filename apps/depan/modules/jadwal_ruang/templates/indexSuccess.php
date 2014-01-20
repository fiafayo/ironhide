<div id="sf_admin_container">
    <h1>Jadwal Ujian</h1>
    <table class="sf_admin_list" border="1" cellpadding="2" cellspacing="0">
        <thead>
            <tr>

                <th>Hari</th>
                <th>Jam</th>
                <th>Ruang</th>

                <th>Dosen</th>
                <th>Karyawan</th>
                 
                <th>Mata Kuliah</th>
                <th>Jml Mhs</th>
<?php
if ( $sf_user->isAdministrator() )
{
    echo '<th>Update</th>';
}
?>
            </tr>
        </thead>
        <tbody>
<?php
    $tableText='';
    $genap=0;
    $dayNames=DataFormatter::getDayNames();
    $romawis=array(1=>'I','II','III','IV');
    $jmlRow=array(
        1=>array(
            'totM'=>0,
            'detM'=>array(
                1=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                2=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                3=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                4=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                5=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
            )
        ),
        2=>array(
            'totM'=>0,
            'detM'=>array(
                1=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                2=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                3=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                4=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
                5=>array(
                    'totH'=>0,
                    'detH'=>array(1=>0,0,0,0)
                ),
            )
        ),
            );

    foreach( $penjadwalan->haris as $kodeHari )
    {
        $minggu=substr($kodeHari,0,1);
        $hari=substr($kodeHari,1,1);
        for ($jam=1; $jam<=4; $jam++)
        {
            //if ( !$sf_data->getRaw($penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'] ) ) continue;
            //$rcodes=array_keys( $sf_data->getRaw($penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'] ) );
            $rcodes=array_keys(  ($penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'] ) );
            foreach ($rcodes as $rcode)
            {
                $jml=count( $penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'][$rcode] );
                $jmlRow[$minggu]['totM']=$jmlRow[$minggu]['totM']+$jml;
                $jmlRow[$minggu]['detM'][$hari]['totH']=$jmlRow[$minggu]['detM'][$hari]['totH']+$jml;
                $jmlRow[$minggu]['detM'][$hari]['detH'][$jam]=$jmlRow[$minggu]['detM'][$hari]['detH'][$jam]+$jml;
            }
        }

    }
    $prevHari=0;
    foreach( $penjadwalan->haris as $kodeHari )
    {


        $minggu=substr($kodeHari,0,1);
        $hari=substr($kodeHari,1,1);
        $prevJam=0;
        for ($jam=1; $jam<=4; $jam++)
        {



            $prevRuang=0;
            $rcodes=array_keys(  ( $penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'] ));
            foreach ($rcodes as $rcode)
            {
                $genap=0;
                $mcodes=array_keys(  ($penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'][$rcode]) );
                foreach ($mcodes as $mcode)
                {


                    $rowText='';
                    if ($prevHari!=$hari) //awal hari
                    {
                        $rowspan='';
                        $n= $jmlRow[$minggu]['detM'][$hari]['totH'];
                        if ($n>1) $rowspan='rowspan="'.$n.'"';
                        $rowText .= '<td '.$rowspan.'  valign="center" align="center">'.$dayNames[$hari].'<br/>Minggu '.$romawis[$minggu].'</td>'."\n";

                    }  
                    $prevHari=$hari;

                    if ($prevJam!=$jam) //awal jam, tiap jam ada banyak ruang
                    {
                        $rowspan='';
                        $n= $jmlRow[$minggu]['detM'][$hari]['detH'][$jam] ;
                        if ($n>1) $rowspan='rowspan="'.$n.'"';
                        $rowText .=  '<td '.$rowspan.'  valign="center" align="center">Jam '.$romawis[$jam].'</td>'."\n";
                    }
                    $prevJam=$jam;

                    if ($prevRuang!==$rcode)
                    {
                        $n=count( $penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'][$rcode] );
                        $rowspan='';
                        if ($n>1) $rowspan='rowspan="'.$n.'"';
                        $rowText .=  '<td '.$rowspan.'  valign="center" align="center">'.$rcode.'</td>'."\n";
                        $kodeDosen=$penjadwalan->jadwalUjians[$kodeHari][$jam]['dos'][$rcode];
                        if ($kodeDosen && isset( $penjadwalan->dosenNames[$kodeDosen] ) ) $kodeDosen.='/'.$penjadwalan->dosenNames[$kodeDosen];
                        $kodeKaryawan=$penjadwalan->jadwalUjians[$kodeHari][$jam]['kar'][$rcode];
                        if ($kodeKaryawan && isset( $penjadwalan->karyawanNames[$kodeKaryawan] ) ) $kodeKaryawan.='/'.$penjadwalan->karyawanNames[$kodeKaryawan];
                        $rowText .=  '<td '.$rowspan.'  valign="center" align="center">'.$kodeDosen.'</td>'."\n";
                        $rowText .=  '<td '.$rowspan.'  valign="center" align="center">'.$kodeKaryawan.'</td>'."\n";
                    }
                    $prevRuang=$rcode;


                    if ($genap==0) $genap=1; else $genap=0;
                    $tableText.= '<tr class="sf_admin_row_'.$genap.'">'.$rowText;
                    $matkul=$mcode;
                    if  ( isset($matkuls[$mcode]) ) $matkul.='/'.$matkuls[$mcode];
                    $tableText.= '<td  valign="center" align="center">'.$matkul.'</td>'."\n";
                    $tableText.= '<td  valign="center" align="right">'.$penjadwalan->jadwalUjians[$kodeHari][$jam]['rua'][$rcode][$mcode].'</td>'."\n";

if ( $sf_user->isAdministrator() )
{
    $tableText.='<td>'.link_to('Update','jadwal_ruang/update?mcode='.$mcode.'&rcode='.$rcode).'</td>';
}

                    $tableText.= '</tr>'."\n";
                }

            }
        }
    }
    echo $tableText;
?>
        </tbody>

        
    </table>
</div>