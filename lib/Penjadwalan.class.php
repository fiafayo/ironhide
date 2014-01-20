<?php
class Penjadwalan
{
    public $selectedRuangs=array(); //ruang yang terpilih untuk setiap slot ujian
    public $jadwalUjians=array();//jadwal ujian yang melibatkan KELAS
    public $jadwalUjianLabs=array();//jadwal ujian yang melibatkan NON-KELAS
    public $kapasitasMK=array();//tabel kapasitas per mata kuliah yang direncanakan
    public $pesertaMK=array();//tabel jumlah riil mahasiswa per mata kuliah
    public $ruanganMK=array();//tabel jumlah riil mahasiswa per mata kuliah

    public $ruangs=array(); //tabel ruangan yang bisa dipakai untuk ujian
    public $dosenKelas=array(); //dosen pengasuh mata kuliah
    public $kelasJurusans=array(); //relasi mata kuliah dan jurusan
    public $dosenJurusans=array();
    public $isDebug=false;
    public $dosens=array();//dosen yang bisa ditugaskan untuk jaga
    public $karyawans=array();//karyawan yang bisa ditugaskan untuk jaga
    public $dosenNames=array();
    public $karyawanNames=array();
    public $haris=array(11,12,13,14,15,21,22,23,24,25);
    public $hariNames=array(1=>'Senin','Selasa','Rabu','Kamis','Jumat');
    public $thsms=null;
    public $kodePerwalian=null;


    const SISA_KURSI_MINIMUM = 5;//jika perlu melakukan split, maka jumlah mahasiswa minimum per kelas adalah 5
    const MK_MAX_PER_RUANG = 3;//jumlah mata kuliah maksimum per ruangan
    const DOSEN_JML_JAGA_MAX = 10;
    const DOSEN_JML_JAGA_MAX_PER_HARI = 3;
    const KARYAWAN_JML_JAGA_MAX = 30;
    const KARYAWAN_JML_JAGA_MAX_PER_HARI=3;

    const ERR_NONE=0;

    const ERR_UNKNOWN = -127;
    const ERR_KAP_LEBIH = -1;//kapasitas ruang tidak mencukupi peserta ujian
    const GAGAL_PILIH_RUANG = -2;//ada mata kuliah yang tidak bisa disolusikan pilihan ruangannya
    const ERR_JML_JAGA_LEBIH=-3;
    const ERR_JAGA_BENTROK=-4;
    const ERR_JAGA_1_DAN_4 = -5;
    const ERR_JAGA_LEBIH_HARIAN = -6;
    const ERR_DOSEN_NOT_PENGAWAS = -7;

  
    public function inisialisasiPilihRuang($semester=null)
    {
        if (!$semester)
        {
            if (!$this->thsms)
            {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
            } else {
                $thsms=$this->thsms;
                $kodePerwalian=$this->kodePerwalian;
            }
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        

        $this->kapasitasMK=array();
        $this->pesertaMK=array();
        $this->ruanganMK =array();
        if ($thsms)
        {
            //ambil data kapasitas kelas tiap mata kuliah
            $criteria=new Criteria;
            $criteria->add(KelasMKPeer::STATUS_BUKA,1);
            $criteria->addAscendingOrderByColumn(KelasMKPeer::KODE_MK);
            $criteria->addAscendingOrderByColumn(KelasMKPeer::KP);
            $criteria->add(KelasMKPeer::SEMESTER,$thsms->getSemester());
            $criteria->add(KelasMKPeer::TAHUN,$thsms->getTahun());
            $rows=KelasMKPeer::doSelect($criteria);
            unset($criteria);
            foreach ( $rows as $row ) 
            {
                $kodeMk=$row->getKodeMk();
                $kp=$row->getKp();
                $isi=$row->getIsi();
                if ( !isset( $this->kapasitasMK[$kodeMk] ) ) $this->kapasitasMK[$kodeMk]=0;
                $this->kapasitasMK[$kodeMk] += $isi;
                
                if ( !isset( $this->pesertaMK[$kodeMk] ) ) $this->pesertaMK[$kodeMk]=array();
                $this->pesertaMK[$kodeMk][$kp]=$isi;                
            }


        }
        if ($this->isDebug)
        {
            print "Kapasitas Kelas : \n";
            print_r($this->pesertaMK);
        }

        //inisialisasi jadwal ujian
        //index 11 artinya minggu ke-1 hari ke-1, index 23 artinya minggu ke-2 hari ke-3
        $this->jadwalUjians=array();
        $this->jadwalUjianLabs=array();
        $this->selectedRuangs=array();
        foreach ($this->haris as $h)
        {
            $this->jadwalUjians[$h]=array(
                1=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                2=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                3=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                4=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                )
            );
            $this->jadwalUjianLabs[$h]=array(
                1=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                2=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                3=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                ),
                4=>array(
                    'mk'=>array(),
                    'rua'=>array(),
                    'dos'=>array(),
                    'kar'=>array()
                )
            );
            $this->selectedRuangs[$h]=array(
                1=>array(
                    
                ),
                2=>array(
                    
                ),
                3=>array(
                    
                ),
                4=>array(
                    
                )
            ); 
            $this->ruanganMK[$h]=array(
                1=>array(

                ),
                2=>array(

                ),
                3=>array(

                ),
                4=>array(

                )
            );

        }
        $this->ruangs=array();

        if ($thsms)
        {
            //ambil data jadwal ujian
            $criteria=new Criteria();
            //$criteria->add(JadwalUjianPeer::KODE_MK,'%'.$kodePerwalian,Criteria::LIKE);
            $criteria->add(JadwalUjianPeer::SEMESTER,$thsms->getSemester());
            $criteria->add(JadwalUjianPeer::TAHUN,$thsms->getTahun());

            $criteria->addAscendingOrderByColumn(JadwalUjianPeer::MINGGU);
            $criteria->addAscendingOrderByColumn(JadwalUjianPeer::HARI);
            $criteria->addAscendingOrderByColumn(JadwalUjianPeer::JAM);
            $jadwals=JadwalUjianPeer::doSelect($criteria);
            unset($criteria);
            foreach($jadwals as $jadwal)
            {
                $kodeHari= intval ($jadwal->getMinggu()) *10 + intval($jadwal->getHari() );
                $kodeJam = intval ($jadwal->getJam());
                $kodeMk = $jadwal->getKodeMk();
 
                if ( $jadwal->getJenisRuang()=='KELAS' )
                {
                    //menentukan isi tiap kp di mata kuliah ini
                    $this->jadwalUjians[$kodeHari][$kodeJam]['mk'][$kodeMk]=  array();
                    if (isset($this->pesertaMK[$kodeMk])) $this->jadwalUjians[$kodeHari][$kodeJam]['mk'][$kodeMk]=$this->pesertaMK[$kodeMk] ;
                } else {
                    $this->jadwalUjianLabs[$kodeHari][$kodeJam]['mk'][$kodeMk]=  array();
                    if (isset($this->pesertaMK[$kodeMk])) $this->jadwalUjianLabs[$kodeHari][$kodeJam]['mk'][$kodeMk]=$this->pesertaMK[$kodeMk] ;

                }
            }
            //ambil data ruang
            $c=new Criteria;
            $c->add(RuangPeer::UNTUK_UJIAN,1);
            $c->addAscendingOrderByColumn(RuangPeer::PRIORITAS);
            $c->addAscendingOrderByColumn(RuangPeer::KAPASITAS_UJIAN);
            $ruangs=RuangPeer::doSelect($c);
            unset($c);
            //todo ambil data ruang
            foreach ($ruangs as $ruang)
            {
                $this->ruangs[$ruang->getKodeRuang()]=array(
                    'pri'=>$ruang->getPrioritas(),
                    'kap'=>$ruang->getKapasitasUjian(),
                    'jen'=>$ruang->getJenis(),

                );
            }
        }
        if ($this->isDebug)
        {
            print "Jadwal Ujian Kelas  : \n";
            print_r($this->jadwalUjians);
            print "Ruangan  : \n";
            print_r($this->ruangs);
        }
    }

    public function getJumlahMhs($kode_mk)
    {
        $result=0;
        if ( isset( $this->pesertaMK[$kode_mk] ) )
        {
            foreach( $this->pesertaMK[$kode_mk] as $isi )
            {
                $result += $isi;
            }
        }
        return $result;
    }

    public  function pilihRuanganKelas(&$errors, &$infos)
    {
        $result=0;
        if (!$errors)  $errors=array();
        if (!$infos) $infos=array();
        $kapasitasMax=0;
        $c=new Criteria;
        $c->add(RuangPeer::UNTUK_UJIAN,1);
        $c->add(RuangPeer::JENIS,'KELAS');
        $c->clearSelectColumns()->clearGroupByColumns();
        $c->addSelectColumn( 'SUM('. RuangPeer::KAPASITAS_UJIAN .')' );
        $stmt=RuangPeer::doSelectStmt($c);
        unset($c);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ( $row  )
        {
            $kapasitasMax=$row[0];

        }  
        $infos[]='Didapatkan kapasitas ruang KELAS total maksimum sejumlah '.$kapasitasMax;
        $this->kapasitasPerJam=array();
         
        foreach ($this->haris as $hari)
        {
            $this->kapasitasPerJam[$hari]=array(1=>0,0,0,0);
        }

        $kelases=array();
        $rcodes=array_keys($this->ruangs);
        foreach ($rcodes as $rcode)
        {
          $ruang=$this->ruangs[$rcode];
          if ( $ruang['jen']=='KELAS' )
          {
             $kelases[$rcode]=$ruang;
             $kelases[$rcode]['mhs']=0;
             $kelases[$rcode]['kls']=array();
          }
        }

        foreach ($this->haris as $hari) //cek kapasitas maksimum per jam
        {
            for ($jam=1;$jam<=4;$jam++)
            {
               
              $keys=array_keys($this->jadwalUjians[$hari][$jam]['mk']);
              foreach ($keys as $key) //masukkan kapasitas per jam
              {
                  $this->kapasitasPerJam[$hari][$jam]=$this->kapasitasPerJam[$hari][$jam] + $this->getJumlahMhs($key);
                  
              }
              if ( $this->kapasitasPerJam[$hari][$jam] > $kapasitasMax )
              {
                  $result=self::ERR_KAP_LEBIH;
                  $errors[]="Terdapat kapasitas ruang TIDAK mencukupi untuk seluruh kelas ($kapasitasMax) pada hari=$hari jam=$jam jumlah=".$this->kapasitasPerJam[$hari][$jam]." (kode:".self::ERR_KAP_LEBIH.")";
                  return $result;
              }
            }
        }

        foreach ($this->haris as $hari) //cek kapasitas maksimum per jam
        {
            for ($jam=1;$jam<=4;$jam++)
            {

              $rcodes=array_keys($kelases); //inisialiasi array ruang untuk pencarian lokal
              foreach ($rcodes as $rcode)
              {
                $kelases[$rcode]['mhs']=0;
                $kelases[$rcode]['kls']=array();
              }
              //print_r($kelases);

              arsort($this->jadwalUjians[$hari][$jam]['mk']); //reverse sorting
              $mcodes=array_keys($this->jadwalUjians[$hari][$jam]['mk']);
              foreach ($mcodes as $mcode)
              {
                  $jmlMhsMK=$this->getJumlahMhs($mcode);
                  if ($jmlMhsMK<1){
                      $infos[]="SKIP mata kuliah $mcode dengan kursi=$jmlMhsMK ";
                      continue;
                  }
                  $infos[]="Memulai proses mata kuliah $mcode dengan kursi=$jmlMhsMK ";
                  foreach( $this->pesertaMK[$mcode] as $kp=>$jmlMhs ) //pencarian solusi ruang per KP
                  {

                      $solved=false;
                      if ($jmlMhs<1){
                          $infos[]="mk=$mcode kp=$kp n=$jmlMhs dilewati karena jumlah mahasiswa tidak valid";
                          $errors[]="mk=$mcode kp=$kp n=$jmlMhs dilewati karena jumlah mahasiswa tidak valid";
                          continue;
                      }

                      foreach ($rcodes as $rcode) //cari dulu ruang kosong supaya satu KP dapat semuanya masuk ke satu ruang
                      {
                         $kursiKosong=$kelases[$rcode]['kap']-$kelases[$rcode]['mhs'];

                         if (($jmlMhs<=$kursiKosong)  && ( count($kelases[$rcode]['kls'])<self::MK_MAX_PER_RUANG) && ( $kelases[$rcode]['pri']<50 )) //hindari PE
                         {
                                  $infos[]="mk=$mcode kp=$kp n=$jmlMhs pada $rcode masuk semuanya satu ruang, solved kap=$kursiKosong";
                                  $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$jmlMhs;
                                  if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                      $kelases[$rcode]['kls'][$mcode]=array();
                                  }
                                  $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;
                                  
                                  if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                  {
                                      $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                  }
                                  if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                  {
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                  }
                                  $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $jmlMhs;
                                  if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                  $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$jmlMhs );



                                  $this->jadwalUjians[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                  $sisaAlokasi=0;
                                  $solved=true;
                                  break;
                         }

                      }






                      if (!$solved)
                      {

                          $sisaAlokasi=$jmlMhs;

                          foreach ($rcodes as $rcode) //cari seluruh ruangan
                          {
                              $kursiKosong=$kelases[$rcode]['kap']-$kelases[$rcode]['mhs'];
                              //$infos[]="Cek $mcode pada ruangan $rcode dengan kursi kosong=$kursiKosong";
                              if (($kursiKosong>self::SISA_KURSI_MINIMUM) && ( count($kelases[$rcode]['kls'])<self::MK_MAX_PER_RUANG))
                              {  //jika kursi kosong lebih dari minimum dan jumlah Mata Kuliah masih lebih dari maksimum
                                  if ($sisaAlokasi>$kursiKosong) //sebagian di taruh di sini
                                  {

                                      $infos[]="mk=$mcode kp=$kp  pada $rcode sisa alokasi=$sisaAlokasi lebih dari kursi kosong=$kursiKosong, ditempatkan sebagian";
                                      $sisaAlokasi=$sisaAlokasi-$kursiKosong;
                                      $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$kursiKosong;

                                      if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                          $kelases[$rcode]['kls'][$mcode]=array();
                                      }
                                      $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;


                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                      }
                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                      }
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $kursiKosong;
                                      $this->jadwalUjians[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                      if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                      $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$kursiKosong );
                                  } else {
                                      //cukup masuk ruangan sisanya
                                      $infos[]="mk=$mcode kp=$kp pada $rcode sisa alokasi=$sisaAlokasi masuk semuanya, solved kap=$kursiKosong";
                                      $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$sisaAlokasi;

                                       if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                          $kelases[$rcode]['kls'][$mcode]=array();
                                      }
                                      $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;


                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                      }
                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                      }
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $sisaAlokasi;
                                      $this->jadwalUjians[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                      if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                      $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$sisaAlokasi );
                                      $sisaAlokasi=0;
                                      $solved=true;
                                  }
                                  if ($solved) break;
                              }
                          }

                      }

                      if (!$solved)
                      {
                          $infos[]= "KELAS $mcode kp=$kp hari=$hari jam=$jam tidak ada solusi, FATAL ERROR";
                          $errors[]="KELAS $mcode kp=$kp hari=$hari jam=$jam tidak ada solusi, FATAL ERROR";
                      }
                  }



              }
            }
        }
 
        
        return $result;
    }


    public  function pilihRuanganNonKelas(&$errors, &$infos)
    {
        $result=0;
        if (!$errors)  $errors=array();
        if (!$infos) $infos=array();
        $kapasitasMax=0;
        $c=new Criteria;
        $c->add(RuangPeer::UNTUK_UJIAN,1);
        $c->add(RuangPeer::JENIS,'KELAS',Criteria::NOT_EQUAL);
        $c->clearSelectColumns()->clearGroupByColumns();
        $c->addSelectColumn( 'SUM('. RuangPeer::KAPASITAS_UJIAN .')' );
        $stmt=RuangPeer::doSelectStmt($c);
        unset($c);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ( $row  )
        {
            $kapasitasMax=$row[0];

        }
        $infos[]='Didapatkan kapasitas ruang NON KELAS total maksimum sejumlah '.$kapasitasMax;
        $this->kapasitasPerJam=array();

        foreach ($this->haris as $hari)
        {
            $this->kapasitasPerJam[$hari]=array(1=>0,0,0,0);
        }

        $kelases=array();
        $rcodes=array_keys($this->ruangs);
        foreach ($rcodes as $rcode)
        {
          $ruang=$this->ruangs[$rcode];
          if ( $ruang['jen']!='KELAS' )
          {
             $kelases[$rcode]=$ruang;
             $kelases[$rcode]['mhs']=0;
             $kelases[$rcode]['kls']=array();
          }
        }
 

        foreach ($this->haris as $hari)  
        {
            for ($jam=1;$jam<=4;$jam++)
            {

              $rcodes=array_keys($kelases); //inisialiasi array ruang untuk pencarian lokal
              foreach ($rcodes as $rcode)
              {
                $kelases[$rcode]['mhs']=0;
                $kelases[$rcode]['kls']=array();
              }
              //print_r($kelases);


              arsort($this->jadwalUjianLabs[$hari][$jam]['mk']); //reverse sorting
              $mcodes=array_keys($this->jadwalUjianLabs[$hari][$jam]['mk']);
              foreach ($mcodes as $mcode)
              {
                  $jmlMhsMK=$this->getJumlahMhs($mcode);
                  if ($jmlMhsMK<1){
                      $infos[]="SKIP mata kuliah $mcode dengan kursi=$jmlMhsMK ";
                      continue;
                  }
                  $infos[]="Memulai proses mata kuliah $mcode dengan kursi=$jmlMhsMK ";
                  foreach( $this->pesertaMK[$mcode] as $kp=>$jmlMhs ) //pencarian solusi ruang per KP
                  {

                      $solved=false;
                      if ($jmlMhs<1){
                          $infos[]="mk=$mcode kp=$kp n=$jmlMhs dilewati karena jumlah mahasiswa tidak valid";
                          $errors[]="mk=$mcode kp=$kp n=$jmlMhs dilewati karena jumlah mahasiswa tidak valid";
                          continue;
                      }

                      foreach ($rcodes as $rcode) //cari dulu ruang kosong supaya satu KP dapat semuanya masuk ke satu ruang
                      {
                         $kursiKosong=$kelases[$rcode]['kap']-$kelases[$rcode]['mhs'];

                         if (($jmlMhs<=$kursiKosong)  && ( count($kelases[$rcode]['kls'])<self::MK_MAX_PER_RUANG) && ( $kelases[$rcode]['pri']<50 )) //hindari PE
                         {
                                  $infos[]="mk=$mcode kp=$kp pada $rcode masuk semuanya satu ruang, solved n=$jmlMhs kap=$kursiKosong";
                                  $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$jmlMhs;
                                  if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                      $kelases[$rcode]['kls'][$mcode]=array();
                                  }
                                  $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;

                                  if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                  {
                                      $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                  }

                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                      }
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $jmlMhs;


                                  $this->jadwalUjianLabs[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                  if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                  $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$jmlMhs );
                                  $sisaAlokasi=0;
                                  $solved=true;
                                  break;
                         }

                      }






                      if (!$solved)
                      {

                          $sisaAlokasi=$jmlMhs;

                          foreach ($rcodes as $rcode) //cari seluruh ruangan
                          {
                              $kursiKosong=$kelases[$rcode]['kap']-$kelases[$rcode]['mhs'];
                              //$infos[]="Cek $mcode pada ruangan $rcode dengan kursi kosong=$kursiKosong";
                              if (($kursiKosong>self::SISA_KURSI_MINIMUM) && ( count($kelases[$rcode]['kls'])<self::MK_MAX_PER_RUANG))
                              {  //jika kursi kosong lebih dari minimum dan jumlah Mata Kuliah masih lebih dari maksimum
                                  if ($sisaAlokasi>$kursiKosong) //sebagian di taruh di sini
                                  {

                                      $infos[]="mk=$mcode kp=$kp  pada $rcode sisa alokasi=$sisaAlokasi lebih dari kursi kosong=$kursiKosong, ditempatkan sebagian";
                                      $sisaAlokasi=$sisaAlokasi-$kursiKosong;
                                      $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$kursiKosong;

                                      if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                          $kelases[$rcode]['kls'][$mcode]=array();
                                      }
                                      $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;


                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                      }
                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                      }
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $kursiKosong;
                                      $this->jadwalUjianLabs[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                      if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                      $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$kursiKosong );
                                  } else {
                                      //cukup masuk ruangan sisanya
                                      $infos[]="mk=$mcode kp=$kp pada $rcode n=$sisaAlokasi masuk semuanya, solved kap=$kursiKosong";
                                      $kelases[$rcode]['mhs']=$kelases[$rcode]['mhs']+$sisaAlokasi;

                                       if ( !isset( $kelases[$rcode]['kls'][$mcode] )  ) {
                                          $kelases[$rcode]['kls'][$mcode]=array();
                                      }
                                      $kelases[$rcode]['kls'][$mcode][$kp]=$jmlMhs;


                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode]=array();
                                      }
                                      if (!isset($this->selectedRuangs[$hari][$jam][$rcode][$mcode]))
                                      {
                                          $this->selectedRuangs[$hari][$jam][$rcode][$mcode]=array();
                                      }
                                      $this->selectedRuangs[$hari][$jam][$rcode][$mcode][$kp]= $sisaAlokasi;
                                      $this->jadwalUjianLabs[$hari][$jam]['rua'][$rcode]=$kelases[$rcode]['mhs'];
                                      if ( !isset($this->ruanganMK[$hari][$jam][$mcode]) ) $this->ruanganMK[$hari][$jam][$mcode]=array();
                                      $this->ruanganMK[$hari][$jam][$mcode][$kp]=array( 'r'=>$rcode, 'n'=>$sisaAlokasi );
                                      $sisaAlokasi=0;
                                      $solved=true;
                                  }
                                  if ($solved) break;
                              }
                          }

                      }

                      if (!$solved)
                      {
                          $infos[]= "KELAS $mcode kp=$kp hari=$hari jam=$jam tidak ada solusi, FATAL ERROR";
                          $errors[]="KELAS $mcode kp=$kp hari=$hari jam=$jam tidak ada solusi, FATAL ERROR";
                      }
                  }



              }
            }
        }


        return $result;
    }


  
    public function simpanPilihanRuang($semester=null)
    {

        if (!$semester)
        {
            if (!$this->thsms)
            {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
            } else {
                $thsms=$this->thsms;
                $kodePerwalian=$this->kodePerwalian;
            }
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$thsms->getKode();

        $con=Propel::getConnection(JadwalRuangPeer::DATABASE_NAME);
        $con->beginTransaction();
        try {

            //$thsms=TahunSemesterPeer::getDefault();
            
            $sql="DELETE FROM jadwal_ruang_mk WHERE jadwal_ruang_id IN (SELECT id FROM jadwal_ruang WHERE semester='$semester')";
            $stmt=$con->prepare($sql);
            $stmt->execute();


            $sql="DELETE FROM jadwal_ruang WHERE semester='$semester'";
            $stmt=$con->prepare($sql);
            $stmt->execute();

            $ruangs=array();

            foreach ( $this->haris as $hari )
            {
                for ($jam=1;$jam<=4;$jam++)
                {
                    if ( is_array($this->selectedRuangs[$hari][$jam] ) )
                    {

                        $rcodes=array_keys($this->selectedRuangs[$hari][$jam]);
                         

                        foreach($rcodes as $rcode)
                        {

                            try {


                                $jr=new JadwalRuang();
                                $jr->setJam($jam);
                                $jr->setHari( substr($hari,1,1) );
                                $jr->setMinggu( substr($hari,0,1) );
                                //$jr->setKodeRuang($rcode);
                                if ( !isset( $ruangs[$rcode] ) )
                                {


                                    $ruangs[$rcode]=RuangPeer::retrieveByPK($rcode);
                                
                                }
                                $jr->setRuang( $ruangs[$rcode] );
                                $jr->setSemester($semester);
                                if ( isset($this->jadwalUjians[$hari][$jam]['dos'][$rcode]) )  {
                                    $jr->setKodeDosen( $this->jadwalUjians[$hari][$jam]['dos'][$rcode] );
                                } else $jr->setKodeDosen(0);
                                if ( isset($this->jadwalUjians[$hari][$jam]['kar'][$rcode]) ) {
                                    $jr->setKodeKaryawan( $this->jadwalUjians[$hari][$jam]['kar'][$rcode] );
                                } else $jr->setKodeKaryawan(0);
                                $jr->save($con);
                                $jrId=$jr->getId();
 
                                $mcodes=array_keys($this->selectedRuangs[$hari][$jam][$rcode]);
                                foreach ($mcodes as $mcode)
                                {
                                    foreach ($this->selectedRuangs[$hari][$jam][$rcode][$mcode] as $kp=>$jmlMhs)
                                    {
                                        $jrm=new JadwalRuangMk();
                                        $jrm->setJadwalRuangId($jrId);
                                        $jrm->setKapasitas($jmlMhs);
                                        $jrm->setKp( $kp );
                                        $jrm->setKodeKelas($mcode);
                                        $jrm->save($con);
                                        sfContext::getInstance()->getLogger()->debug("{Heloz} simpan data hari=$hari jam=$jam  ruang=$rcode mk=$mcode kp=$kp jml=$jmlMhs ");
                                    }
                                    
                                }



                            } catch (Exception $e) {
                                
                            }
                            



                        }


                    }


                }
            }
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
        }
    }

    public function inisialisasiPilihDosen($semester=null)
    {
        if (!$semester)
        {
            if (!$this->thsms)
            {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
            } else {
                $thsms=$this->thsms;
                $kodePerwalian=$this->kodePerwalian;
            }
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        
        $this->kelasJurusans=array();
        if ($thsms)
        {
            $c=new Criteria;
            $c->add(KelasJurusanPeer::KODE_KELAS,'%'.$kodePerwalian,Criteria::LIKE);
            $c->addAscendingOrderByColumn(KelasJurusanPeer::KODE_KELAS);
            $c->addAscendingOrderByColumn(KelasJurusanPeer::KODE_JUR);
            $rows=KelasJurusanPeer::doSelectJoinKelasMK($c);
            unset($c);
            foreach ($rows as $row)
            {
                $kode=$row->getKelasMK()->getKodeMk();
                $kodeJur=$row->getKodeJur();
                if ( !isset( $this->kelasJurusans[$kode] ) )
                {
                    $this->kelasJurusans[$kode]=array();
                }
                $this->kelasJurusans[$kode][$kodeJur]=$kodeJur;
            }
        }
        if ($this->isDebug)
        {
            print "Kode perwalian: $kodePerwalian \n";
            print "Kelas Jurusan : \n";
            print_r($this->kelasJurusans);
        }
        $this->dosenKelas=array();
        if ($thsms)
        {
            $c=new Criteria;
            $c->add( DosenKelasPeer::KODE_KELAS,'%'.$kodePerwalian,Criteria::LIKE);
            $c->addAscendingOrderByColumn(DosenKelasPeer::KODE_KELAS);
            $c->addAscendingOrderByColumn(DosenKelasPeer::KODE_DOSEN);
            $rows=DosenKelasPeer::doSelectJoinAll($c);
             
            unset($c);
            foreach ($rows as $row)
            {
                $kode=$row->getKelasMK()->getKodeMK();
                $kodeDsn=$row->getKodeDosen();
                if ( !isset( $this->dosenKelas[$kode] ) )
                {
                    $this->dosenKelas[$kode]=array();
                }
                $dosen=$row->getDosen();

                if ($dosen && $dosen->getIsPengawas() )  {
                    $this->dosenKelas[$kode][$kodeDsn]= $kodeDsn;
                }
            }
        }

        if ($this->isDebug)
        {
            print "Dosen Kelas  : \n";
            print_r($this->dosenKelas);
        }

        $this->dosens=array();
        $this->dosenJurusans=array();
        $this->dosenNames=array();
        $this->karyawanNames=array();
        $c=new Criteria();
        $c->add(DosenPeer::IS_PENGAWAS,1);
        $c->addDescendingOrderByColumn(DosenPeer::KODE_DOSEN);
        $rows=DosenPeer::doSelect($c);
        unset($c);
        foreach ($rows as $row)
        {
            $kodeDsn=$row->getKodeDosen();
            $this->dosens[$kodeDsn]=0; //diisi angka jumlah slot jaga
            $this->dosenNames[$kodeDsn]=$row->getNama();
            $kodeJur=$row->getKodeJur();
            if ( !isset( $this->dosenJurusans[$kodeJur] ) )
            {
                $this->dosenJurusans[$kodeJur]=array();
            }
            $this->dosenJurusans[$kodeJur][$kodeDsn]=0; //diisi angka jumlah slot jaga
        }
        $this->karyawans=array();
        $c=new Criteria();
        $c->add(KaryawanPeer::IS_PENGAWAS,1);
        $c->addDescendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
        $rows=KaryawanPeer::doSelect($c);
        unset($c);
        foreach ($rows as $row)
        {
            $this->karyawans[$row->getKodeKaryawan()]=0; //diisi angka jumlah slot jaga
            $this->karyawanNames[$row->getKodeKaryawan()]=$row->getNama();
        }

        


    }

    public function isDosenBolehJaga($kodeDosen,$hari,$jam, &$infos, &$errors)
    {

        $errCode=self::ERR_UNKNOWN;
        if (isset( $this->dosens[$kodeDosen]  )) //jika ada, berarti dosennya bisa jadi pengawas
        {
            //$infos[]="Cek penjadwalan dosen $kodeDosen pada hari $hari dan jam $jam dengan kondisi jadwal:  ".print_r($this->jadwalUjians[$hari][$jam]['dos'],TRUE );

            if ( in_array($kodeDosen, $this->jadwalUjians[$hari][$jam]['dos'] )  )
            {
                //bentrok, sudah diset di jam tersebut
                $errors[]="Proses penjadwalan dosen $kodeDosen gagal karena pada hari $hari dan jam $jam dosen tersebut sudah terjadwal jaga ";
                return self::ERR_JAGA_BENTROK;
            }


            $jmlJagaTotal=0;
            foreach ($this->haris as $hari)
            {
                for ($jam=1; $jam<=4; $jam++)
                {
                    if ( in_array($kodeDosen, $this->jadwalUjians[$hari][$jam]['dos'] ) )
                    {
                        $jmlJagaTotal++;
                    }
                }
            }

            $jmlJagaMaxDosen=sfConfig::get('app_dosen_jml_jaga_max', self::DOSEN_JML_JAGA_MAX );
            if ($jmlJagaTotal>=$jmlJagaMaxDosen)
            {
                $errors[]="Proses penjadwalan dosen $kodeDosen gagal karena jumlah jaga $jmlJagaTotal melebihi ketentuan $jmlJagaMaxDosen ";
                return self::ERR_JML_JAGA_LEBIH;
            }

            
            $jagaDiHariItu=array(1=>0,0,0,0);
            $jmlJaga=0;
            for ($ijam=1; $ijam<=4; $ijam++)
            {

                if ( in_array($kodeDosen,$this->jadwalUjians[$hari][$ijam]['dos']) )
                {
                    $jagaDiHariItu[$ijam]=1;
                    $jmlJaga++;

                }
            }
            $jmlJagaMaxHari=sfConfig::get('app_dosen_jml_jaga_max_harian', self::DOSEN_JML_JAGA_MAX_PER_HARI );
            if ( $jmlJaga >= ($jmlJagaMaxHari) )
            {
                $errors[]="Proses penjadwalan dosen $kodeDosen gagal karena jumlah jaga harian $jmlJaga melebihi ketentuan $jmlJagaMaxHari ";
                return self::ERR_JAGA_LEBIH_HARIAN;
            }



            if (($jam==1) || ($jam==4)) //menghindari jaga ujian sekaligus di jam 1 dan jam 4
            {


                
                if (
                     ( ($jam==1) && ($jagaDiHariItu[4]) ) || ( ($jam==4) && ($jagaDiHariItu[1]) )  //jam 1 dan 4 di hari yg sama

                   )
                {
                    $errors[]="Proses penjadwalan dosen $kodeDosen gagal karena pada hari $hari dan jam $jam dosen tersebut  terjadwal jaga jam 1 dan 4";
                    return self::ERR_JAGA_1_DAN_4;
                }
            }
            $errCode=self::ERR_NONE;
        } else {
            $errCode=self::ERR_DOSEN_NOT_PENGAWAS;
        }
        return $errCode;
    }


    public function isKaryawanBolehJaga($kodeKaryawan,$hari,$jam, &$infos, &$errors)
    {

        $errCode=self::ERR_UNKNOWN;
        if (isset( $this->karyawans[$kodeKaryawan]  )) //jika ada, berarti dosennya bisa jadi pengawas
        {
            //$infos[]="Cek penjadwalan dosen $kodeKaryawan pada hari $hari dan jam $jam dengan kondisi jadwal:  ".print_r($this->jadwalUjians[$hari][$jam]['dos'],TRUE );

            if ( in_array($kodeKaryawan, $this->jadwalUjians[$hari][$jam]['kar'] )  )
            {
                //bentrok, sudah diset di jam tersebut
                $errors[]="Proses penjadwalan karyawan $kodeKaryawan gagal karena pada hari $hari dan jam $jam karyawan tersebut sudah terjadwal jaga ";
                return self::ERR_JAGA_BENTROK;
            }


            $jmlJagaTotal=0;
            foreach ($this->haris as $hari)
            {
                for ($jam=1; $jam<=4; $jam++)
                {
                    if ( in_array($kodeKaryawan, $this->jadwalUjians[$hari][$jam]['kar'] ) )
                    {
                        $jmlJagaTotal++;
                    }
                }
            }

            $jmlJagaMaxDosen=sfConfig::get('app_karyawan_jml_jaga_max', self::KARYAWAN_JML_JAGA_MAX );
            if ($jmlJagaTotal>=$jmlJagaMaxDosen)
            {
                $errors[]="Proses penjadwalan dosen $kodeKaryawan gagal karena jumlah jaga $jmlJagaTotal melebihi ketentuan $jmlJagaMaxDosen ";
                return self::ERR_JML_JAGA_LEBIH;
            }


            $jagaDiHariItu=array(1=>0,0,0,0);
            $jmlJaga=0;
            for ($ijam=1; $ijam<=4; $ijam++)
            {

                if ( in_array($kodeKaryawan,$this->jadwalUjians[$hari][$ijam]['kar']) )
                {
                    $jagaDiHariItu[$ijam]=1;
                    $jmlJaga++;

                }
            }
            $jmlJagaMaxHari=sfConfig::get('app_karyawan_jml_jaga_max_harian', self::KARYAWAN_JML_JAGA_MAX_PER_HARI );
            if ( $jmlJaga >= ($jmlJagaMaxHari) )
            {
                $errors[]="Proses penjadwalan Karyawan $kodeKaryawan gagal karena jumlah jaga harian $jmlJaga melebihi ketentuan $jmlJagaMaxHari ";
                return self::ERR_JAGA_LEBIH_HARIAN;
            }



            if (($jam==1) || ($jam==4)) //menghindari jaga ujian sekaligus di jam 1 dan jam 4
            {



                if (
                     ( ($jam==1) && ($jagaDiHariItu[4]) ) || ( ($jam==4) && ($jagaDiHariItu[1]) )  //jam 1 dan 4 di hari yg sama

                   )
                {
                    $errors[]="Proses penjadwalan Karyawan $kodeKaryawan gagal karena pada hari $hari dan jam $jam Karyawan tersebut  terjadwal jaga jam 1 dan 4";
                    return self::ERR_JAGA_1_DAN_4;
                }
            }
            $errCode=self::ERR_NONE;
        } else {
            $errCode=self::ERR_DOSEN_NOT_PENGAWAS;
        }
        return $errCode;
    }



    public function pilihDosenKaryawan(&$errors, &$infos)
    {
        $result=0;
        if (!$errors) $errors=array();
        if (!$infos) $infos=array();

        foreach ($this->haris as $hari)

        {
            for ($jam=1; $jam<5; $jam++)

            {
 
                $rcodes=array_keys($this->selectedRuangs[$hari][$jam]); //ruang-ruang yang dipakai di slot tsb
                foreach ($rcodes as $rcode)
                {
                    if ( count($this->selectedRuangs[$hari][$jam][$rcode]) )
                    {
                        $mcodes=array_keys($this->selectedRuangs[$hari][$jam][$rcode]); //daftar mata kuliah di jam itu
                        
                        $solved=false;
                        foreach($mcodes as $mcode) //diproses per mata kuliah
                        {
                            if ( isset($this->dosenKelas[$mcode]) )
                            {
                                foreach( $this->dosenKelas[$mcode] as $kodeDosen ) //cari dosen pengajarnya
                                {
                                    if (   $this->isDosenBolehJaga($kodeDosen,$hari,$jam,$infos,$errors)==self::ERR_NONE )
                                    {
                                        $this->dosens[$kodeDosen]=$this->dosens[$kodeDosen]+1;
                                        $this->jadwalUjians[$hari][$jam]['dos'][$rcode]=$kodeDosen;
                                        $infos[]="Proses penjadwalan Dosen $kodeDosen terpilih pada hari $hari dan jam $jam sebagai dosen pengajar $mcode";
                                        $solved=true;
                                        break;
                                    }
                                }
                            }
                        }
                        if (!$solved)
                        {
                            foreach($mcodes as $mcode) //diproses per mata kuliah
                            {

                                if ( isset( $this->kelasJurusans[$mcode] ) )
                                {

                                    //cari dosen lain di jurusannya
                                    $kodeJurs=$this->kelasJurusans[$mcode];
                                    foreach ($kodeJurs as $kodeJur)
                                    {
                                        if ( isset($this->dosenJurusans[$kodeJur]) )
                                        {
                                            $kodeDosens=array_keys( $this->dosenJurusans[$kodeJur] );
                                            foreach ($kodeDosens as $kodeDosen)
                                            {
                                                if (   $this->isDosenBolehJaga($kodeDosen,$hari,$jam,$infos,$errors)==self::ERR_NONE )
                                                {
                                                    $this->dosens[$kodeDosen]=$this->dosens[$kodeDosen]+1;
                                                    $this->jadwalUjians[$hari][$jam]['dos'][$rcode]=$kodeDosen;
                                                    $infos[]="Proses penjadwalan Dosen $kodeDosen terpilih pada hari $hari dan jam $jam sebagai dosen  di jurusan $kodeJur";
                                                    $solved=true;
                                                    break;

                                                }
                                            }
                                        }
                                        if ($solved)
                                        {
                                            break;
                                        }
                                    }


                                }
                                if ($solved)
                                {
                                    break;
                                }


                            }

                        }
                        
                        if (!$solved)
                        {
                            //cari dosen sembarang
                            $kodeDosens=array_keys( $this->dosens  );
                            foreach ($kodeDosens as $kodeDosen)
                            {
                                    if (   $this->isDosenBolehJaga($kodeDosen,$hari,$jam,$infos,$errors)==self::ERR_NONE )
                                    {
                                        $this->dosens[$kodeDosen]=$this->dosens[$kodeDosen]+1;
                                        $this->jadwalUjians[$hari][$jam]['dos'][$rcode]=$kodeDosen;
                                        $infos[]="Proses penjadwalan Dosen $kodeDosen terpilih pada hari $hari dan jam $jam sebagai dosen Umum";
                                        $solved=true;
                                        break;
                                    }
                            }

                        }
                        if (!$solved)
                        {
                            $errors[]="Proses penjadwalan dosen GAGAL pada hari $hari dan jam $jam, tidak ada kandidat dosen yang memenuhi syarat";
                            $infos[]="Proses penjadwalan dosen GAGAL pada hari $hari dan jam $jam, tidak ada kandidat dosen yang memenuhi syarat";
                        } else {
                            //$infos[]="Proses penjadwalan dosen BERHASIL pada hari $hari dan jam $jam, untuk ruang $rcode ditemukan dosen=".$this->jadwalUjians[$hari][$jam]['dos'][$rcode];
                        }

                        $solved=false;
                        $kodeKaryawans=array_keys( $this->karyawans  );
                        foreach ($kodeKaryawans as $kodeKaryawan)
                        {
                                if (   $this->isKaryawanBolehJaga($kodeKaryawan,$hari,$jam,$infos,$errors)==self::ERR_NONE )
                                {
                                    $this->karyawans[$kodeKaryawan]=$this->karyawans[$kodeKaryawan]+1;
                                    $this->jadwalUjians[$hari][$jam]['kar'][$rcode]=$kodeKaryawan;
                                    $infos[]="Proses penjadwalan Karyawan $kodeKaryawan terpilih pada hari $hari dan jam $jam";
                                    $solved=true;
                                    break;
                                }
                        }
                        if (!$solved)
                        {
                            $errors[]="Proses penjadwalan karyawan GAGAL pada hari $hari dan jam $jam, tidak ada kandidat  yang memenuhi syarat";
                            $infos[]="Proses penjadwalan karyawan GAGAL pada hari $hari dan jam $jam, tidak ada kandidat  yang memenuhi syarat";
                        } else {
                            //$infos[]="Proses penjadwalan dosen BERHASIL pada hari $hari dan jam $jam, untuk ruang $rcode ditemukan dosen=".$this->jadwalUjians[$hari][$jam]['dos'][$rcode];
                        }

                    }
                }
            }
        }
    }

    public function load(&$errors, &$infos, $semester=null)
    {
        $this->inisialisasiPilihRuang($semester);
        $this->inisialisasiPilihDosen($semester);
        
        if (!$semester)
        {
            if (!$this->thsms)
            {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
            } else {
                $thsms=$this->thsms;
                $kodePerwalian=$this->kodePerwalian;
            }
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$thsms->getKode();

        $c=new Criteria();
        $c->add(JadwalRuangPeer::SEMESTER,$semester);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
        $rows=JadwalRuangPeer::doSelect($c);
        unset($c);
        sfContext::getInstance()->getLogger()->debug('{Heloz} Proses Loading: didapatkan jadwal ruang tersimpan sebanyak '.count($rows) );

        foreach ($rows as $row)
        {
            $kodeHari=$row->getMinggu().$row->getHari();
            $rcode=$row->getKodeRuang();
            $this->jadwalUjians[$kodeHari][$row->getJam()]['rua'][$rcode]=array();
            $this->jadwalUjians[$kodeHari][$row->getJam()]['dos'][$rcode]=$row->getKodeDosen();
            $this->jadwalUjians[$kodeHari][$row->getJam()]['kar'][$rcode]=$row->getKodeKaryawan();
            $krows=$row->getJadwalRuangMks();
            foreach ( $krows as $krow )
            {
                $this->jadwalUjians[$kodeHari][$row->getJam()]['rua'][$rcode][$krow->getKodeKelas()]=$krow->getKapasitas();

                if (!isset($this->selectedRuangs[$kodeHari][$row->getJam()][$rcode]))
                {
                    $this->selectedRuangs[$kodeHari][$row->getJam()][$rcode]=array();
                }
                $this->selectedRuangs[$kodeHari][$row->getJam()][$rcode][$krow->getKodeKelas()]=$krow->getKapasitas();
                if ( !isset( $this->ruanganMK[$kodeHari][$row->getJam()][$krow->getKodeKelas()] ) ) $this->ruanganMK[$kodeHari][$row->getJam()][$krow->getKodeKelas()]=array();
                $this->ruanganMK[$kodeHari][$row->getJam()][$krow->getKodeKelas()][$krow->getKp()]=array( 'r'=>$rcode, 'n'=>$krow->getKapasitas() );
                sfContext::getInstance()->getLogger()->debug('{Heloz} ditemukan jadwal untuk mk='.$krow->getKodeKelas().' kp='.$krow->getKp().' n='.$krow->getKapasitas());

            }



        }
        ksort($this->jadwalUjians);
        ksort($this->jadwalUjianLabs);
        ksort($this->selectedRuangs);
        ksort($this->ruanganMK);
        foreach ( $this->haris as $hari )
        {
            ksort($this->jadwalUjians[$hari]);
            ksort($this->jadwalUjianLabs[$hari]);
            ksort($this->selectedRuangs[$hari]);
            ksort($this->ruanganMK[$hari]);
        }

        
    }

    public static function importJumlahPesertaKeJadwalUjian($isVerbose=false)
    {
        if ($isVerbose)
        {
            echo "Beginning the process ... \n";
        }
        $con=Propel::getConnection(DaftarKelasPeer::DATABASE_NAME);
        $con->beginTransaction();
        try
        {
            $kode=TahunSemesterPeer::getDefaultKodePerwalian();
            $thsms=TahunSemesterPeer::getDefault();
            $c=new Criteria();
            $c->add(DaftarKelasPeer::KODE_KELAS,'%'.$kode,Criteria::LIKE);
            $c->add(DaftarKelasPeer::STATUS,1);
            $c->clearSelectColumns()->clearGroupByColumns();
            $c->addSelectColumn( DaftarKelasPeer::KODE_KELAS );
            $c->addGroupByColumn( DaftarKelasPeer::KODE_KELAS );
            $c->addAscendingOrderByColumn( DaftarKelasPeer::KODE_KELAS );
            $c->addSelectColumn( 'COUNT('.DaftarKelasPeer::NRP.')' );
            $stmt=DaftarKelasPeer::doSelectStmt($c,$con);
            unset($c);
            while ( $row = $stmt->fetch(PDO::FETCH_NUM) )
            {
                $kodeKelas=$row[0];
                $jml=$row[1];
                $n=strlen($kodeKelas);
                $kodeMk=substr($kodeKelas, 0, $n-5 ); //dikurangi Z10GA
                $c=new Criteria();
                $c->add( JadwalUjianPeer::KODE_MK, $kodeMk );
                $c->add( JadwalUjianPeer::KODE_UJIAN,  '%'.$kode,Criteria::LIKE);
                $jadwal=JadwalUjianPeer::doSelectOne($c,$con);
                unset($c);
                if ($isVerbose)
                {
                    echo "Processing $kodeKelas sejumlah $jml  ... \n";
                }

                if ($jadwal)
                {
                    $jadwal->setJumlahMhs($jml);
                    $jadwal->save($con);
                }


            }
            $con->commit();
            if ($isVerbose)
            {
                echo "Processing ALL DONE ... \n";
            }

            return 0;
        } catch (Exception $e) {
            $con->rollback();
                if ($isVerbose)
                {
                    echo "Processing   GAGAL karena ".$e->getMessage()." \n";
                }

            return "ERROR: ".$e->getMessage();
        }
        

    }

   public function simpanPilihanDosen($semester=null)
    {

        if (!$semester)
        {
            if (!$this->thsms)
            {
                $thsms=TahunSemesterPeer::getDefault();
                $kodePerwalian=TahunSemesterPeer::getDefaultKodePerwalian();
            } else {
                $thsms=$this->thsms;
                $kodePerwalian=$this->kodePerwalian;
            }
        } else {
            $c=new Criteria();
            $c->add(TahunSemesterPeer::SEMESTER,$semester);
            $thsms=TahunSemesterPeer::doSelectOne($c);
            unset($c);
            $kodePerwalian=$thsms->getKodePerwalian();
        }
        $this->thsms=$thsms;
        $this->kodePerwalian=$kodePerwalian;
        $semester=$thsms->getKode();
        
        $con=Propel::getConnection(JadwalRuangPeer::DATABASE_NAME);
        $con->beginTransaction();
        try {

            //$thsms=TahunSemesterPeer::getDefault();

//            $sql="DELETE FROM jadwal_ruang_mk WHERE jadwal_ruang_id IN (SELECT id FROM jadwal_ruang WHERE semester='$semester')";
//            $stmt=$con->prepare($sql);
//            $stmt->execute();
//
//
//            $sql="DELETE FROM jadwal_ruang WHERE semester='$semester'";
//            $stmt=$con->prepare($sql);
//            $stmt->execute();

            $ruangs=array();

            foreach ( $this->haris as $hari )
            {
                for ($jam=1;$jam<=4;$jam++)
                {
                   

                        $rcodes=array_keys($this->jadwalUjians[$hari][$jam]['dos']);


                        foreach($rcodes as $rcode)
                        {

                            try {


                                $kodeHari=substr($hari,1,1);
                                $kodeMinggu=substr($hari,0,1);
                                $kodeDosen=0;
                                $kodeKaryawan=0;
                                if ( isset($this->jadwalUjianLabs[$hari][$jam]['dos'][$rcode]) ) $kodeDosen=$this->jadwalUjianLabs[$hari][$jam]['dos'][$rcode];
                                if ( isset($this->jadwalUjianLabs[$hari][$jam]['kar'][$rcode]) ) $kodeKaryawan=$this->jadwalUjianLabs[$hari][$jam]['kar'][$rcode];
                                if ( isset($this->jadwalUjians[$hari][$jam]['dos'][$rcode]) ) $kodeDosen=$this->jadwalUjians[$hari][$jam]['dos'][$rcode];
                                if ( isset($this->jadwalUjians[$hari][$jam]['kar'][$rcode]) ) $kodeKaryawan=$this->jadwalUjians[$hari][$jam]['kar'][$rcode];


sfContext::getInstance()->getLogger()->debug("{Heloz} update pengawas ruangan untuk dosen pada hari=$hari jam=$jam ruang=$rcodes dos=$kodeDosen kar=$kodeKaryawan" );
                                $sql="UPDATE jadwal_ruang SET kode_dosen=?, kode_karyawan=? WHERE semester=? and kode_ruang=? and minggu=? and hari=? and jam=?";

                                $stmt=$con->prepare($sql);
                                $stmt->bindValue(1,$kodeDosen);
                                $stmt->bindValue(2,$kodeKaryawan);
                                $stmt->bindValue(3,$semester);
                                $stmt->bindValue(4,$rcode);
                                $stmt->bindValue(5,$kodeMinggu);
                                $stmt->bindValue(6,$kodeHari);
                                $stmt->bindValue(7,$jam);
                                $stmt->execute();


                                if ( !isset( $ruangs[$rcode] ) )
                                {


                                    $ruangs[$rcode]=RuangPeer::retrieveByPK($rcode);

                                }
                             } catch (Exception $e) {
sfContext::getInstance()->getLogger()->err("{Heloz} GAGAL update pengawas ruangan untuk dosen pada hari=$hari jam=$jam ruang=$rcodes dos=$kodeDosen kar=$kodeKaryawan ".$e->getMessage() );
                            }




                        }


                    


                }
            }
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
        }
    }

    public function prepareReport($semester=null)
    {
        
    }

    
} 
?>
