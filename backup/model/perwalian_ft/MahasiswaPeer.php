<?php

/**
 * Subclass for performing query and update operations on the 'tk_mhs' table.
 *
 *
 *
 * @package lib.model.perwalian_ft
 */
class MahasiswaPeer extends BaseMahasiswaPeer
{
  public static function importFromCsv($csvFileName){
    $csvIn=fopen($csvFileName,"r");
    if (!$csvIn) die ("gagal membaca $bioFile \n");
    $fieldNames=fgetcsv($csvIn,2048,';');
    if (!$fieldNames) die ("gagal membaca nama field dari input CSV \n");
    $i=1;
    while ($input=fgetcsv($csvIn,2048,';')) {
      $nrp=$input[0];
      $mhs=MahasiswaPeer::retrieveByPk($nrp);
      if (!$mhs) {
        $mhs=new Mahasiswa();
        $mhs->setNrp($nrp);
        $mhs->setNama  ($input[ array_search('NAMA'   ,$fieldNames) ]);
        $mhs->setAlamat  ($input[ array_search('ALAMAT'   ,$fieldNames) ]);
        $mhs->setTmplahir  ($input[ array_search('TMPLAHIR'   ,$fieldNames) ]);
        $mhs->setTelepon   ($input[ array_search('TELEPON'   ,$fieldNames) ]);
        $mhs->setPassword   ($input[ array_search('PASSWORD'   ,$fieldNames) ]);
        $mhs->setAngkatan   ($input[ array_search('ANGKATAN'   ,$fieldNames) ]);
        $mhs->setNamasma   ($input[ array_search('NAMASMA'   ,$fieldNames) ]);
        $mhs->setNamaortu   ($input[ array_search('NAMAORTU'   ,$fieldNames) ]);
        $mhs->setKelamin   ($input[ array_search('KELAMIN'   ,$fieldNames) ]);
        $kodeJur='6'.substr($nrp,3,1);
        $mhs->setJurusan ($kodeJur.'-'.$kodeJur);
        print "$i >Insert $nrp\n";
      } else print "$i >Update $nrp\n";
      $i++;
      //NRP;SKSMAX;IPS;STATUS;JURUSAN;WALI;NAMA;ALAMAT;NIRM;TGLLAHIR;TMPLAHIR;TOTBSS;IPK;SKSKUM;TELEPON;VALIDID;PASSWORD;ANGKATAN;NAMASMA;NAMAORTU;NRPKOP;KELAMIN
      //'Nrp' => 0, 'Sksmax' => 1, 'Ips' => 2, 'Status' => 3, 'Jurusan' => 4, 'Nama' => 5, 'Alamat' => 6, 'Tgllahir' => 7, 'Tmplahir' => 8, 'Totbss' => 9, 'Ipk' => 10, 'Skskum' => 11, 'Telepon' => 12, 'Password' => 13, 'Angkatan' => 14, 'Namasma' => 15, 'Namaortu' => 16, 'Kelamin' => 17, 'Asisten' => 18

        $tgl=$input[ array_search('TGLLAHIR'   ,$fieldNames) ];
        $angkas=explode('/',$tgl);
        if (count($angkas)==3) {
          $tgl_lahir=$angkas[2].'-'.$angkas[1].'-'.$angkas[0];
        } else $tgl_lahir=null;
        if ($tgl_lahir<='1950-12-31') $tgl_lahir=null;
        $mhs->setTgllahir  ($tgl_lahir);


      $mhs->setSksmax  ($input[ array_search('SKSMAX'   ,$fieldNames) ]);
      $mhs->setIps     ($input[ array_search('IPS'      ,$fieldNames) ]);
      $mhs->setStatus  ($input[ array_search('STATUS'   ,$fieldNames) ]);
      $mhs->setTotbss  ($input[ array_search('TOTBSS'   ,$fieldNames) ]);
      $mhs->setIpk  ($input[ array_search('IPK'   ,$fieldNames) ]);
      $mhs->setSkskum  ($input[ array_search('SKSKUM'   ,$fieldNames) ]);
      $mhs->setPassword  ($input[ array_search('PASSWORD'   ,$fieldNames) ]);
      $mhs->save();
    }
    fclose($csvIn);
  }
}
