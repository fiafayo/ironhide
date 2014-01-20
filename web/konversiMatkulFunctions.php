<?php
define ('FTUBAYA_DBNAME', 'ftubaya_20122');
$bobotNilais = array(
    'A'=>4,
    'AB'=>3.5,
    'B'=>3,
    'BC'=>2.5,
    'C'=>2,
    'D'=>1,
    'E'=>0,
    'E*'=>0,
    'K'=>0
);

function tulisErrorLog($pesan) {
    $fName = dirname(__FILE__).'/../cache/error_konversi.log';
    $fl=fopen($fName,"a");
    if ($fl) {
        fwrite($fl,date("YmdHis").": $pesan \n");
        fclose($fl);
    }

}

function cariNilaiTerdekatBerdasarBobot($bobot) {
    global $bobotNilais;
    $selisihMin = 4;
    $hasil = 'E';
    foreach ($bobotNilais as $huruf=>$nilai) {
        $selisih=abs( $bobot - $nilai );
        if ( $selisih < $selisihMin ) {
            $selisihMin=$selisih;
            $hasil = $huruf;
        }
    }
    return $hasil;
    
}

function konversiMataKuliah1on1($kodeJur,$tahun) {
    echo "Bismillah ... \n";
    $dbuser='ftubaya';
    $dbname=FTUBAYA_DBNAME;
    $dbhost='localhost';
    $dbpass='sugianto';
    $con=mysql_connect($dbhost, $dbuser, $dbpass) or  die("Gagal koneksi mysql ke $dbhost \n");
    mysql_select_db($dbname, $con);

    //PROSES KONVERSI 1 ke 1 dulu
    $query="SELECT * FROM konversi_mk WHERE tahun='$tahun' AND kode_jur='$kodeJur' AND jenis_konversi='1 ke 1' ORDER BY mk_lama";
    $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n"); 
    $konversiMks=array();
    while ( $row=mysql_fetch_assoc($rs) ) {
        $konversiMks[ $row['mk_lama'] ] = $row['mk_baru'];
    }
    mysql_free_result($rs);
    $mkIds = '';
    $n=0;
    foreach (array_keys($konversiMks)  as $kodeMk ) {
        if ($n) $mkIds.=','; else $n=1;
        $mkIds.="'$kodeMk'";
        
    }
    if ($n) {

    

        $query="SELECT * FROM tk_transkrip_asli WHERE  (kode_mk IN  ( $mkIds ) ) AND  (nrp IN  (SELECT nrp FROM tk_mhs WHERE status NOT IN ('PO','DO','L') AND jurusan='$kodeJur'  AND ((substring(nrp,2,1)='0') OR (substring(nrp,2,1)='1'))  ORDER BY nrp)) ORDER BY nrp, kode_mk";
        $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");;
        $querySel = "SELECT nilai FROM tk_transkrip WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $queryIns = "INSERT INTO tk_transkrip(nrp,kode_mk,tahun,semester,nilai) VALUES ('%s','%s','%s','%s','%s')";
        $queryUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        while ( $row=mysql_fetch_assoc($rs) ) {

            $query=sprintf($querySel, $row['nrp'], $konversiMks[$row['kode_mk']], $row['tahun'], $row['semester'] );
            $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
            $n=mysql_num_rows($rsc);
            mysql_free_result($rsc);
            if (!$n) {
                $query=sprintf( $queryIns, $row['nrp'], $konversiMks[$row['kode_mk']], $row['tahun'], $row['semester'], $row['nilai'] );

                                    try {
                                        $rsc=mysql_query($query);
                                        echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                                    } catch (Exception $e) {
                                        $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                        tulisErrorLog($pesan);
                                        echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                                        echo ("\n $pesan \n");
                                    }



                
            } else {
                echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
            }


        }
        mysql_free_result($rs);
    }
    echo "Alhamdulillah, done! \n";


}

function konversiMataKuliah1on2($kodeJur,$tahun) {
    echo "Bismillah ... \n";
    $dbuser='ftubaya';
    $dbname=FTUBAYA_DBNAME;
    $dbhost='localhost';
    $dbpass='sugianto';
    $con=mysql_connect($dbhost, $dbuser, $dbpass) or  die("Gagal koneksi mysql ke $dbhost \n");
    mysql_select_db($dbname, $con);

    //PROSES KONVERSI 1 ke 2
    $query="SELECT * FROM konversi_mk WHERE tahun='$tahun' AND kode_jur='$kodeJur' AND jenis_konversi='1 ke 2' ORDER BY mk_lama";
    $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
    $konversiMks=array();
    while ( $row=mysql_fetch_assoc($rs) ) {
        if ( !isset( $konversiMks[ $row['mk_lama'] ] ) ) {
            $konversiMks[ $row['mk_lama'] ] = array();
        }
        $konversiMks[ $row['mk_lama'] ][] = $row['mk_baru'];
    }
    mysql_free_result($rs);
    $mkIds = '';
    $n=0;
    foreach (array_keys($konversiMks)  as $kodeMk ) {
        if ($n) $mkIds.=','; else $n=1;
        $mkIds.="'$kodeMk'";

    }
    if ($n) {
        $query="SELECT * FROM tk_transkrip_asli WHERE  (kode_mk IN  ( $mkIds ) ) AND  (nrp IN  (SELECT nrp FROM tk_mhs WHERE status NOT IN ('PO','DO','L') AND jurusan='$kodeJur'  AND ((substring(nrp,2,1)='0') OR (substring(nrp,2,1)='1'))  ORDER BY nrp)) ORDER BY nrp, kode_mk";
        $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");;
        $querySel = "SELECT nilai FROM tk_transkrip WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $queryIns = "INSERT INTO tk_transkrip(nrp,kode_mk,tahun,semester,nilai) VALUES ('%s','%s','%s','%s','%s')";
        $queryUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        while ( $row=mysql_fetch_assoc($rs) ) {
            foreach ($konversiMks[$row['kode_mk']] as $mkBaru  ) {
                $query=sprintf($querySel, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'] );
                $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
                $n=mysql_num_rows($rsc);
                mysql_free_result($rsc);
                if (!$n) {
                    $query=sprintf( $queryIns, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'], $row['nilai'] );

                                    try {
                                        $rsc=mysql_query($query);
                                        echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                                    } catch (Exception $e) {
                                        $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                        tulisErrorLog($pesan);
                                        echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                                        echo ("\n $pesan \n");
                                    }


                    
                } else {
                    echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                }
            }
        }
        mysql_free_result($rs);
    }
    echo "Alhamdulillah, done! \n";


}

function konversiMataKuliah2on1And($kodeJur,$tahun) {
    global $bobotNilais;
    echo "Bismillah ... \n";
    $dbuser='ftubaya';
    $dbname=FTUBAYA_DBNAME;
    $dbhost='localhost';
    $dbpass='sugianto';
    $con=mysql_connect($dbhost, $dbuser, $dbpass) or  die("Gagal koneksi mysql ke $dbhost \n");
    mysql_select_db($dbname, $con);


    $query="SELECT * FROM konversi_mk WHERE tahun='$tahun' AND kode_jur='$kodeJur' AND jenis_konversi='2 ke 1 And' ORDER BY mk_baru,mk_lama";
    $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
    $konversiMks=array(); //index=lama, isi=baru
    $konversiMkInvs=array(); //index=baru, isi=lama, 1 to many
    while ( $row=mysql_fetch_assoc($rs) ) {
        if ( !isset( $konversiMkInvs[ $row['mk_baru'] ] ) ) {
            $konversiMkInvs[ $row['mk_baru'] ] = array();
        }
        $konversiMkInvs[ $row['mk_baru'] ][] = $row['mk_lama'];
        $konversiMks[$row['mk_lama'] ] = $row['mk_baru'];
    }
    mysql_free_result($rs);
    ksort($konversiMkInvs);
    ksort($konversiMks);


    $mkIds = '';
    $n=0;
    foreach (array_keys($konversiMks)  as $kodeMk ) {
        if ($n) $mkIds.=','; else $n=1;
        $mkIds.="'$kodeMk'";

    }
    if ($n) {
        $query="SELECT * FROM tk_transkrip_asli WHERE  (kode_mk IN  ( $mkIds ) ) AND  (nrp IN  (SELECT nrp FROM tk_mhs WHERE status NOT IN ('PO','DO','L') AND jurusan='$kodeJur'  AND ((substring(nrp,2,1)='0') OR (substring(nrp,2,1)='1'))  ORDER BY nrp)) ORDER BY nrp, kode_mk, tahun, semester ";
        $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");;
        print "$query \n";



        $querySel = "SELECT COUNT(*) as jml FROM tk_transkrip WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $queryIns = "INSERT INTO tk_transkrip(nrp,kode_mk,tahun,semester,nilai) VALUES ('%s','%s','%s','%s','%s')";
        $queryUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $nrpAktif = null;
        $mkBaruAktif = null;
        $mkLamaAktif = null;


        while ( $row=mysql_fetch_assoc($rs) ) {
            //ambil satu-satu record by nrp
            $nrp = $row['nrp'];
            $mkLama = $row['kode_mk'];
            if ( !isset( $konversiMks[ $mkLama ] ) ) continue; //abaikan mata kuliah yang di luar daftar
            if ($nrp != $nrpAktif) {  //ganti mahasiswa, mkLama yang pertama
                if ($nrp=='6094032') print "ganti mahasiswa, mkLama yang pertama $tahun \n";
                $nrpAktif=$nrp;
                $mkLamaAktif = $mkLama;
                $mkBaruAktif= $konversiMks[ $mkLama ];
                $nilai1=$row['nilai'] ? $row['nilai'] : 'E';
                $bobot1 = isset( $bobotNilais[ $nilai1 ] ) ? $bobotNilais[ $nilai1 ] : 0;
                if ($nrp=='6094032') print "didapatkan nilai $nilai1 dan bobot $bobot1 \n";

                //do nothing, tunggu sampai iterasi kedua
            } else {
$nrpAktif='';
                //nrp yang sama, cek apakah kode mata kuliah iterasi kedua adalah pasangan sebelumnya
                if ($nrp=='6094032') print "nrp yang sama, cek apakah kode mata kuliah iterasi kedua $mkLama adalah pasangan sebelumnya $mkLamaAktif ke $mkBaruAktif\n";
                if ( isset( $konversiMkInvs[ $mkBaruAktif ] ) ) { //valid mkBaru nya
                    $mkLamas=$konversiMkInvs[ $mkBaruAktif ];

                    if (count( $mkLamas )==2) {
                        if ($nrp=='6094032') print "iterasi valid yang kedua mk=".$mkLamas[0]." \n";

                        if ( ($mkLamas[0]==$mkLamaAktif) && ($mkLamas[1]==$mkLama)  ) { //valid
                            if ($nrp=='6094032') print "pasangan valid mk=".$mkLamas[0]." dan ".$mkLamas[1]." \n";
                        
                            $nilai2=$row['nilai'] ? $row['nilai'] : 'E';
                            $bobot2 = isset( $bobotNilais[ $nilai2 ] ) ? $bobotNilais[ $nilai2 ] : 0;
                            $bobotRata2 = ($bobot1 + $bobot2) / 2 ;
                            $nilaiTerdekat=cariNilaiTerdekatBerdasarBobot($bobotRata2);
                            if ($nrp=='6094032') print "pasangan valid mk=".$mkLamas[0]." dan ".$mkLamas[1]." nilai $nilaiTerdekat \n";


                            $query=sprintf($querySel, $nrp, $mkBaruAktif, $row['tahun'], $row['semester'] );
                            if ($nrp=='6094032') print "$query \n";
                            
                            $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
                            $dt=mysql_fetch_array($rsc);
                            $n=$dt[0];
                            if ($nrp=='6094032') print "jumlah record=$n \n";
                            mysql_free_result($rsc);
                            if (!$n) {
                                $query=sprintf( $queryIns, $nrp, $mkBaruAktif, $row['tahun'], $row['semester'], $nilaiTerdekat );
                                if ($nrp=='6094032') print "eksekusi $query \n";

                                    try {
                                        $rsc=mysql_query($query);
                                        if ($nrp=='6094032') print "BERHASIL $query \n";
                                        echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.' to='.$konversiMks[$row['kode_mk']]."\n";
                                    } catch (Exception $e) {
                                        $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                        tulisErrorLog($pesan);
                                        echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.' to='.$konversiMks[$row['kode_mk']]."\n";
                                        echo ("\n $pesan \n");
                                    }




                            } else {
                                echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                            }


                        }
                    }
                }
                $nrpAktif='';
            }




//            foreach ($konversiMks[$row['kode_mk']] as $mkBaru  ) {
//                $query=sprintf($querySel, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'] );
//                $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                $n=mysql_num_rows($rsc);
//                mysql_free_result($rsc);
//                if (!$n) {
//                    $query=sprintf( $queryIns, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'], $row['nilai'] );
//                    $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                    echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                } else {
//                    echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                }
//            }
        }
        mysql_free_result($rs);
    }
    echo "Alhamdulillah, done! \n";


}


function konversiMataKuliah3on1And($kodeJur,$tahun) {
    global $bobotNilais;
    echo "Bismillah ... \n";
    $dbuser='ftubaya';
    $dbname=FTUBAYA_DBNAME;
    $dbhost='localhost';
    $dbpass='sugianto';
    $con=mysql_connect($dbhost, $dbuser, $dbpass) or  die("Gagal koneksi mysql ke $dbhost \n");
    mysql_select_db($dbname, $con);


    $query="SELECT * FROM konversi_mk WHERE tahun='$tahun' AND kode_jur='$kodeJur' AND jenis_konversi='3 ke 1 And' ORDER BY mk_baru,mk_lama";
    $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
    $konversiMks=array(); //index=lama, isi=baru
    $konversiMkInvs=array(); //index=baru, isi=lama, 1 to many
    while ( $row=mysql_fetch_assoc($rs) ) {
        if ( !isset( $konversiMkInvs[ $row['mk_baru'] ] ) ) {
            $konversiMkInvs[ $row['mk_baru'] ] = array();
        }
        $konversiMkInvs[ $row['mk_baru'] ][] = $row['mk_lama'];
        $konversiMks[$row['mk_lama'] ] = $row['mk_baru'];
    }
    mysql_free_result($rs);
    ksort($konversiMkInvs);
    ksort($konversiMks);


    $mkIds = '';
    $n=0;
    foreach (array_keys($konversiMks)  as $kodeMk ) {
        if ($n) $mkIds.=','; else $n=1;
        $mkIds.="'$kodeMk'";

    }
    if ($n) {
        $query="SELECT * FROM tk_transkrip_asli WHERE  (kode_mk IN  ( $mkIds ) ) AND  (nrp IN  (SELECT nrp FROM tk_mhs WHERE status NOT IN ('PO','DO','L') AND jurusan='$kodeJur'  AND ((substring(nrp,2,1)='0') OR (substring(nrp,2,1)='1'))  ORDER BY nrp)) ORDER BY nrp, kode_mk, tahun, semester ";
        $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");;



        $querySel = "SELECT nilai FROM tk_transkrip WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $queryIns = "INSERT INTO tk_transkrip(nrp,kode_mk,tahun,semester,nilai) VALUES ('%s','%s','%s','%s','%s')";
        $queryUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $nrpAktif = null;
        $mkBaruAktif = null;
        $mkLamaAktif = null;
        $mkLamaAktif2 = null;
        $iterasi=1;
        $bobot1=0;
        $bobot2=0;
        $bobot3=0;


        while ( $row=mysql_fetch_assoc($rs) ) {
            //ambil satu-satu record by nrp
            $nrp = $row['nrp'];
            $mkLama = $row['kode_mk'];
            if ( !isset( $konversiMks[ $mkLama ] ) ) continue; //abaikan mata kuliah yang di luar daftar
            if ($nrp != $nrpAktif) {  //ganti mahasiswa, mkLama yang pertama
                $nrpAktif=$nrp;
                $mkBaruAktif= $konversiMks[ $mkLama ];
                $mkLamaAktif = $mkLama;
                
                $nilai1=$row['nilai'] ? $row['nilai'] : 'E';
                $bobot1 = isset( $bobotNilais[ $nilai1 ] ) ? $bobotNilais[ $nilai1 ] : 0;
                $iterasi=1;

                //do nothing, tunggu sampai iterasi kedua
            } else {
                //nrp yang sama, cek apakah kode mata kuliah iterasi kedua adalah pasangan sebelumnya
                if ( isset( $konversiMkInvs[ $mkBaruAktif ] ) ) { //valid mkBaru nya
                    $mkLamas=$konversiMkInvs[ $mkBaruAktif ];

                    if (count( $mkLamas )==3) { //master data adalah valid
                        $iterasi++;
                        if ($iterasi==2) {
                            $mkLamaAktif2 = $mkLama;
                            $nilai2=$row['nilai'] ? $row['nilai'] : 'E';
                            $bobot2 = isset( $bobotNilais[ $nilai2 ] ) ? $bobotNilais[ $nilai2 ] : 0;
                            
                        } else {


                            if ( ($mkLamas[0]==$mkLamaAktif) && ($mkLamas[1]==$mkLamaAktif2) && ($mkLamas[2]==$mkLama)  ) { //valid
                                $nilai3=$row['nilai'] ? $row['nilai'] : 'E';
                                $bobot3 = isset( $bobotNilais[ $nilai3 ] ) ? $bobotNilais[ $nilai3 ] : 0;
                                $bobotRata2 = ($bobot1 + $bobot2 + $bobot3) / 3 ;
                                $nilaiTerdekat=cariNilaiTerdekatBerdasarBobot($bobotRata2);


                                $query=sprintf($querySel, $nrpAktif, $mkBaruAktif, $row['tahun'], $row['semester'] );
                                $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
                                $n=mysql_num_rows($rsc);
                                mysql_free_result($rsc);
                                if (!$n) {
                                    $query=sprintf( $queryIns, $nrpAktif, $mkBaruAktif, $row['tahun'], $row['semester'], $nilaiTerdekat );



                                    try {
                                        $rsc=mysql_query($query);
                                        echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.'+'.$mkLamaAktif2.' to='.$konversiMks[$row['kode_mk']]."\n";
                                    } catch (Exception $e) {
                                        $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                        tulisErrorLog($pesan);
                                        echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.'+'.$mkLamaAktif2.' to='.$konversiMks[$row['kode_mk']]."\n";
                                        echo ("\n $pesan \n");
                                    }
                                } else {
                                    echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
                                }


                            }
                            $nrpAktif='';
                        }
                    }
                }

            }




//            foreach ($konversiMks[$row['kode_mk']] as $mkBaru  ) {
//                $query=sprintf($querySel, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'] );
//                $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                $n=mysql_num_rows($rsc);
//                mysql_free_result($rsc);
//                if (!$n) {
//                    $query=sprintf( $queryIns, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'], $row['nilai'] );
//                    $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                    echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                } else {
//                    echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                }
//            }
        }
        mysql_free_result($rs);
    }
    echo "Alhamdulillah, done! \n";


}
function konversiMataKuliah2on1Or($kodeJur,$tahun) {
    global $bobotNilais;
    echo "Bismillah ... \n";
    $dbuser='ftubaya';
    $dbname=FTUBAYA_DBNAME;
    $dbhost='localhost';
    $dbpass='sugianto';
    $con=mysql_connect($dbhost, $dbuser, $dbpass) or  die("Gagal koneksi mysql ke $dbhost \n");
    mysql_select_db($dbname, $con);


    $query="SELECT * FROM konversi_mk WHERE tahun='$tahun' AND kode_jur='$kodeJur' AND jenis_konversi='2 ke 1 Or' ORDER BY mk_baru,mk_lama";
    $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
    $konversiMks=array(); //index=lama, isi=baru
    $konversiMkInvs=array(); //index=baru, isi=lama, 1 to many
    while ( $row=mysql_fetch_assoc($rs) ) {
        if ( !isset( $konversiMkInvs[ $row['mk_baru'] ] ) ) {
            $konversiMkInvs[ $row['mk_baru'] ] = array();
        }
        $konversiMkInvs[ $row['mk_baru'] ][] = $row['mk_lama'];
        $konversiMks[$row['mk_lama'] ] = $row['mk_baru'];
    }
    mysql_free_result($rs);
    ksort($konversiMkInvs);
    ksort($konversiMks);


    $mkIds = '';
    $n=0;
    foreach (array_keys($konversiMks)  as $kodeMk ) {
        if ($n) $mkIds.=','; else $n=1;
        $mkIds.="'$kodeMk'";

    }
    if ($n) {
        $query="SELECT * FROM tk_transkrip_asli WHERE  (kode_mk IN  ( $mkIds ) ) AND  (nrp IN  (SELECT nrp FROM tk_mhs WHERE status NOT IN ('PO','DO','L') AND jurusan='$kodeJur'  AND ((substring(nrp,2,1)='0') OR (substring(nrp,2,1)='1'))  ORDER BY nrp)) ORDER BY nrp, kode_mk, tahun, semester ";
        $rs=mysql_query($query) or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");;



        $querySel = "SELECT nilai FROM tk_transkrip WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $queryIns = "INSERT INTO tk_transkrip(nrp,kode_mk,tahun,semester,nilai) VALUES ('%s','%s','%s','%s','%s')";
        $queryUpd = "UPDATE tk_transkrip SET nilai='%s' WHERE nrp='%s' AND kode_mk='%s' AND tahun='%s' and semester='%s'";
        $nrpAktif = null;
        $mkBaruAktif = null;
        $mkLamaAktif = null;
        $tahunAktif=null;
        $semesterAktif=null;
        $nilaiAktif=null;
        $nilai1='E';
        $bobot1=0;
        $nilai2='E';
        $bobot2=0;
        $iterasi=0;


        while ( $row=mysql_fetch_assoc($rs) ) {
            //ambil satu-satu record by nrp
            $nrp = $row['nrp'];
            $mkLama = $row['kode_mk'];
            $mkBaru= $konversiMks[ $mkLama ];
            if ( !isset( $konversiMks[ $mkLama ] ) ) continue; //abaikan mata kuliah yang di luar daftar
            if ($nrp != $nrpAktif) {  //ganti mahasiswa, mkLama yang pertama
                if ($iterasi==1) {  //hanya terjadi sekali, lalu ganti nrp, maka langsung diproses karena OR
                            $query=sprintf($querySel, $nrpAktif, $mkBaruAktif, $tahunAktif, $semesterAktif );
                            $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
                            $n=mysql_num_rows($rsc);
                            mysql_free_result($rsc);
                            if (!$n) {
                                $query=sprintf( $queryIns, $nrpAktif, $mkBaruAktif, $tahunAktif, $semesterAktif, $nilaiAktif );
                                try {
                                    $rsc=mysql_query($query);
                                    echo 'INS  nrp='.$row['nrp'].' from='. $mkLamaAktif.' to='.$mkBaruAktif."\n";
                                } catch (Exception $e) {
                                    $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                    tulisErrorLog($pesan);
                                    echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $mkLamaAktif.' to='.$mkBaruAktif."\n";
                                    echo ("\n $pesan \n");
                                }
                            } else {
                                echo 'SKIP nrp='.$row['nrp'].' from='. $mkLamaAktif.' to='.$mkBaruAktif."\n";
                            }
                            $iterasi=0;
                } else {
                    $nrpAktif=$nrp;
                    $mkLamaAktif = $mkLama;
                    $tahunAktif=$row['tahun'];
                    $semesterAktif=$row['semester'];
                    $nilaiAktif=$row['nilai'];
                    $mkBaruAktif= $konversiMks[ $mkLama ];
                    $nilai1=$row['nilai'] ? $row['nilai'] : 'E';
                    $bobot1 = isset( $bobotNilais[ $nilai1 ] ) ? $bobotNilais[ $nilai1 ] : 0;
                    $iterasi=1;
                }

                //do nothing, tunggu sampai iterasi kedua
            } else {
                //nrp yang sama, cek apakah kode mata kuliah iterasi kedua adalah pasangan sebelumnya
                if ( isset( $konversiMkInvs[ $mkBaruAktif ] ) ) { //valid mkBaru nya
                    $mkLamas=$konversiMkInvs[ $mkBaruAktif ];

                    if (count( $mkLamas )==2) {

                        if ( ($mkLamas[0]==$mkLamaAktif) && ($mkLamas[1]==$mkLama)  ) { //valid
                            $iterasi=2;
                            $nilai2=$row['nilai'] ? $row['nilai'] : 'E';
                            $bobot2 = isset( $bobotNilais[ $nilai2 ] ) ? $bobotNilais[ $nilai2 ] : 0;
                            if ($bobot1 > $bobot2) {
                                $nilaiTerdekat=$nilai1;
                            } else {
                                $nilaiTerdekat=$nilai2;
                            }
                             


                            $query=sprintf($querySel, $nrpAktif, $mkBaruAktif, $row['tahun'], $row['semester'] );
                            $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
                            $n=mysql_num_rows($rsc);
                            mysql_free_result($rsc);
                            if (!$n) {
                                $query=sprintf( $queryIns, $nrpAktif, $mkBaruAktif, $row['tahun'], $row['semester'], $nilaiTerdekat );
                                try {
                                    $rsc=mysql_query($query);
                                    echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.' to='.$konversiMks[$mkLamaAktif]."\n";
                                } catch (Exception $e) {  
                                    $pesan="\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n";
                                    tulisErrorLog($pesan);
                                    echo 'FAIL-INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].'+'.$mkLamaAktif.' to='.$konversiMks[$mkLamaAktif]."\n";
                                    echo ("\n $pesan \n");
                                }
                                
                            } else {
                                echo 'SKIP nrp='.$row['nrp'].' from='. $mkLamaAktif.' to='.$konversiMks[$mkLamaAktif]."\n";
                            }


                        }
                    }
                }
                $nrpAktif='';

            }




//            foreach ($konversiMks[$row['kode_mk']] as $mkBaru  ) {
//                $query=sprintf($querySel, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'] );
//                $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                $n=mysql_num_rows($rsc);
//                mysql_free_result($rsc);
//                if (!$n) {
//                    $query=sprintf( $queryIns, $row['nrp'], $mkBaru, $row['tahun'], $row['semester'], $row['nilai'] );
//                    $rsc=mysql_query($query)  or die("\nGagal eksekusi SQL $query  karena ".mysql_error($con)."\n");
//                    echo 'INS  nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                } else {
//                    echo 'SKIP nrp='.$row['nrp'].' from='. $row['kode_mk'].' to='.$konversiMks[$row['kode_mk']]."\n";
//                }
//            }
        }
        mysql_free_result($rs);
    }
    echo "Alhamdulillah, done! \n";


}


function konversiMataKuliah($kodeJur,$tahun) {
    konversiMataKuliah1on1($kodeJur, $tahun);
    konversiMataKuliah1on2($kodeJur, $tahun);
    konversiMataKuliah2on1And($kodeJur, $tahun);
    konversiMataKuliah3on1And($kodeJur, $tahun);
    konversiMataKuliah2on1Or($kodeJur, $tahun);
}

$jurusanNames = array(
        '61-61'=>'Teknik Elektro',
        '62-62'=>'Teknik Kimia',
        '63-63'=>'Teknik Industri',
        '64-64'=>'Teknik Informatika',
        '65-65'=>'Teknik Manufaktur',
        '66-66'=>'Desain dan Manajemen Produk',
        '67-67'=>'Sistem Informasi',
        '68-68'=>'Multimedia',
        '69-69'=>'IT Dual Degree'
    );

$jenisKonversis = array(
    "2 ke 1 And",
    "1 ke 1",
    "2 ke 1 Or",
    "3 ke 1 And",
    "1 ke 2"
);

?>
