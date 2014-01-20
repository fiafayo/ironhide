<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PenjadwalanUjian
 *
 * @author heloz
 */
class PenjadwalanUjian {
    const IS_DEBUG = false;
    const IS_RANDOMIZE_DEBUG = true;
    const TAHAP_AWAL = 1;
    const TAHAP_KEDUA = 2;
    const DEFAULT_MINIMUM_KURSI_KOSONG_UNTUK_PENEMPATAN = 5;
    const DEFAULT_MAKSIMUM_MATA_KULIAH_PER_RUANG = 4;
    const DEFAULT_MAKSIMUM_JUMLAH_JAGA_DOSEN = 6;
    const DEFAULT_MAKSIMUM_JUMLAH_JAGA_KARYAWAN = 14;
    
    public $kodeSemester = 20131;
    public $isDataDariBaak = true;
    public $isDebug = false;
    public $ujianSlots; // 123 = minggu 1, hari 2, jam 3
    public $ruangKelass;  // ruang kelas yang dapat dipakai untuk ujian, index berisi kode ruang, isi berisi kapasitas max
    public $ruangLabs;
    public $mkUjians;
    public $pesertaMks;
    public $dosenReffs;
    public $karyawanReffs;
    public $mataKuliahReffs;
    public $isiRuangPerSlot;
    public $jenisUjians;
    public $daftarDosenJaga;
    public $daftarKaryawanJaga;
    public $daftarDosenNonJaga;
    public $daftarKaryawanNonJaga;
    public $pengajarMk;
    public $pengajarMkReffs;
    public $errorLogs;
    public $dosenJurusans;
    public $daftarKelasDosen;
    public $dosenPikets;
    
    
    private $settingMinimumKursiKosongUntukPenempatan;
    private $settingMaxMatKulPerRuang;
    private $settingMaxJumlahJagaDosen;
    private $settingMaxJumlahJagaKaryawan;
    
    public $jmlMkPerMinggu;
    public $jmlMkPerHari;
    public $jmlMkPerJam;
    
    /**
     * Slot adalah kode 3 digit yang berisi minggu-hari-jam, fungsi ini untuk memecahnya menjadi 3 integer
     * @param String $slot 
     * @param int $minggu
     * @param int $hari
     * @param int $jam
     * @return array
     */
    public static function kodeSlotKeMinggu($slot, &$minggu, &$hari, &$jam) {
        $minggu = substr($slot, 0, 1);
        $hari = substr($slot, 1, 1);
        $jam = substr($slot, 2, 1);
        return array($minggu,$hari,$jam);
    }
    
    /**
     * fungsi untuk menampilkan debug ke symfony 
     */
    public static function debug($kode,$pesan) {
        if (self::IS_DEBUG) {
            sfContext::getInstance()->getLogger()->debug("{heloz} ==$kode== $pesan");     
        }        
    }
    
    /**
     * Fungsi untuk menampilkan error ke symfony
     * @param string $kode
     * @param string $pesan
     */
    public static function error($kode,$pesan) {
        //if (self::IS_DEBUG) {
            sfContext::getInstance()->getLogger()->err("{heloz} ==$kode== $pesan");     
        //}        
    }
    
    /**
     * Alternatif fungsi untuk menampilkan debug ke symfony, tapi dalam posisi bukan static
     * @param string $kode
     * @param string $pesan
     */
    public function writeDebug($kode,$pesan) {
        
        if ($this->isDebug) {
            sfContext::getInstance()->getLogger()->debug("{heloz} ==$kode== $pesan");     
        }        
        
        $flog=fopen( dirname(__FILE__)."/../web/uploads/".$kode.".log",'a' );
        if ($flog) {
            fwrite($flog, date('Ymd_His').'::'.$pesan."\n"  );
            fclose($flog);
        }
    }
    
     
    
    /**
     * function initUjianSlot() adalah bagian pertama dari inisialisasi seluruh penjadwalan
     * 
     */
    private function initUjianSlot() {
        //tahap awal mengisi daftar slot ujian per minggu, hari dan jam
        $this->ujianSlots=array();
        for ($m=1;$m<3;$m++) {
            for ($h=1;$h<6;$h++){
                for ($j=1;$j<5;$j++) {
                    $this->ujianSlots[]=$m*100 + $h*10 + $j;
                }
            }
        }
        
    }
    
    /**
     * ruangan kelas dan lab yang dipakai ujian, dimasukkan ke dalam array
     * 
     */
    private function initRuangan() {
        //berikutnya mendaftarkan ruang kelas dan lab apa saja yang bisa dipakai
        $this->ruangKelass=array();
        $this->ruangLabs=array();
        $c=new Criteria();
        $c->add(RuangPeer::JENIS, array('KELAS','LAB'), Criteria::IN );
        $c->add(RuangPeer::UNTUK_UJIAN,1);
        $c->addAscendingOrderByColumn(RuangPeer::PRIORITAS);
        $c->addAscendingOrderByColumn(RuangPeer::KODE_RUANG);
        $rows=  RuangPeer::doSelect($c);
        foreach($rows as $row) {
            $data=$row->toArray( BasePeer::TYPE_FIELDNAME );
            
            if ( $row->getJenis()=='KELAS' ) {
                $this->ruangKelass[$row->getKodeRuang()]=$data;
            } else {
                $this->ruangLabs[$row->getKodeRuang()]=$data;
            }
        }        
        $data=sfYaml::dump($this->ruangKelass);
        $filename=dirname(__FILE__).'/../cache/ruangKelass.yml';
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/ruangLabs.yml';
        $data=sfYaml::dump($this->ruangLabs);
        file_put_contents($filename, $data);
    }
    
    /**
     * Berdasarkan slot ujian yang telah dibuat pada initUjianSlot() maka didaftarkan mata kuliah tiap slot
     */
    private function initMKUjian() {
        
        //dafar matakuliah dan jumlah pesertanya
        $this->pesertaMks=array();
        if ( !$this->isDataDariBaak ) {
        $c=new Criteria();
        $c->clearSelectColumns()->clearGroupByColumns()->clearOrderByColumns();
        $c->addSelectColumn(KelasMKPeer::KODE_MK);
        $c->addSelectColumn(KelasMKPeer::KP);
        $c->addSelectColumn("COUNT(".DaftarKelasPeer::NRP.') AS jml');
        $c->addJoin(KelasMKPeer::KODE_KELAS, DaftarKelasPeer::KODE_KELAS);
        $c->add(DaftarKelasPeer::STATUS,1);
        $c->add(KelasMKPeer::STATUS_BUKA,1);
        $c->addGroupByColumn(KelasMKPeer::KODE_MK);
        $c->addGroupByColumn(KelasMKPeer::KP);
        $c->addAscendingOrderByColumn(KelasMKPeer::KODE_MK);
        $c->addAscendingOrderByColumn(KelasMKPeer::KP);
        $rs=  DaftarKelasPeer::doSelectStmt($c);
        
        while ( $row=$rs->fetch(PDO::FETCH_NUM) ) {
            $kodeMk=$row[0];
            $kp=$row[1];
            $jml=$row[2];
            if ( !isset( $this->pesertaMks[$kodeMk] ) ) {
                $this->pesertaMks[$kodeMk] = array();
            }
            $this->pesertaMks[$kodeMk][$kp]=$jml;
        }
        
        } else {
            $c=new Criteria();
            $c->add(KelasMKPeer::STATUS_BUKA,1);
            $c->addAscendingOrderByColumn(KelasMKPeer::KODE_MK);
            $c->addAscendingOrderByColumn(KelasMKPeer::KP);
            $rows=  KelasMKPeer::doSelect($c);
            foreach($rows as $row) {
                $kodeMk = $row->getKodemk();
                if ( !isset( $this->pesertaMks[$kodeMk] ) ) {
                    $this->pesertaMks[$kodeMk] = array();
                }
                $this->pesertaMks[$kodeMk][$row->getKp()]=0;                
            }
             
            
            foreach ( $this->pesertaMks as $kodeMk=>$data ) {
                $kps = array_keys( $data );
                $c->clear();
                $c->clearSelectColumns()->clearGroupByColumns()->clearGroupByColumns();
                $c->add(BaakMahasiswaAmbilMKPeer::KODEMKBUKA,"$kodeMk".$this->kodeSemester);
                $c->add(BaakMahasiswaAmbilMKPeer::KP,$kps,Criteria::IN);
                $c->addSelectColumn(BaakMahasiswaAmbilMKPeer::KP);
                $c->addSelectColumn("COUNT(".BaakMahasiswaAmbilMKPeer::NRP.") AS jml");
                $c->addGroupByColumn(BaakMahasiswaAmbilMKPeer::KP);
                $c->addAscendingOrderByColumn(BaakMahasiswaAmbilMKPeer::KP);
                $rs=  BaakMahasiswaAmbilMKPeer::doSelectStmt($c);
                while ( $row=$rs->fetch(PDO::FETCH_NUM) ) {
                     
                    $kp=$row[0];
                    $jml=$row[1];
                    
                    $this->pesertaMks[$kodeMk][$kp]=$jml;
                }                
                
            }
            
        }
        
        
        $filename=dirname(__FILE__).'/../cache/pesertaMks.yml';
        $data=sfYaml::dump($this->pesertaMks);
        file_put_contents($filename, $data);
        
        
        
        //daftar matakuliah yang diujikan per slotnya, dijadwalkan yang KELAS dan LAB, selain TUGAS
        $this->mkUjians=array();
        foreach( $this->ujianSlots as $slot ) {
            $this->mkUjians[$slot] = array(); //setiap slot berisi daftar mata kuliah
        }
        $c->clear();
        $c->addAscendingOrderByColumn ( JadwalUjianPeer::MINGGU );
        $c->addAscendingOrderByColumn ( JadwalUjianPeer::HARI );
        $c->addAscendingOrderByColumn ( JadwalUjianPeer::JAM );
        $c->addAscendingOrderByColumn ( JadwalUjianPeer::KODE_MK );
        $c->addDescendingOrderByColumn ( JadwalUjianPeer::PRIORITAS_RUANG );
        //$c->add(JadwalUjianPeer::JENIS_UJIAN,'TGS',Criteria::NOT_EQUAL);

        
        //sementara diskip, dianggap record pasti hanya untuk semester
        //$c->add( JadwalUjianPeer::KODE_UJIAN, '%13GA', Criteria::LIKE ); 
        
        $rows=  JadwalUjianPeer::doSelect($c);
        unset($c);
        foreach ( $rows as $row ) {
            $slot=$row->getMinggu()*100 + $row->getHari()*10 + $row->getJam();
            $kodeMk = $row->getKodeMk();
            $isi = ( isset( $this->pesertaMks[$kodeMk] ) ) ? $this->pesertaMks[$kodeMk] :  array() ;
            $this->mkUjians[$slot][$kodeMk] = array(
                'isi'=>$isi,
                'rua'=>$row->getJenisRuang(),
                'uji'=>$row->getJenisUjian(),
                'id'=>$row->getKodeUjian(),
                'prio'=>$row->getPrioritasRuang(),
            );
             
        }
        
        
        $filename=dirname(__FILE__).'/../cache/mkUjians.yml';
        $data=sfYaml::dump($this->mkUjians);
        file_put_contents($filename, $data);
         
        
        
    }
    
    /**
     * inisialisasi array untuk referensi kode ke nama, untuk dosen dan karyawan
     */
    private function initDosenKaryawan() {
        $c=new Criteria();
        $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
        $c->add(DosenPeer::IS_PENGAWAS,1);
        $dosens=  DosenPeer::doSelect($c);
        $this->dosenReffs=array();
        $this->dosenJurusans=array();
        foreach($dosens as $row){
            $this->dosenReffs[trim($row->getKodeDosen())]=$row->getNama();
            $this->dosenJurusans[trim($row->getKodeDosen())]=$row->getKodeJur();
        }
        $c->clear();
        $c->addAscendingOrderByColumn(KaryawanPeer::KODE_KARYAWAN);
        $c->add(KaryawanPeer::IS_PENGAWAS,1);
        $kars=  KaryawanPeer::doSelect($c);
        $this->karyawanReffs=array();
        foreach($kars as $row){
            $this->karyawanReffs[trim($row->getKodeKaryawan())]=$row->getNama();
        }
        $c->clear();
        $c->addAscendingOrderByColumn( PiketUjianPeer::KODE_DOSEN );
        $rows=  PiketUjianPeer::doSelect($c);
        $this->dosenPikets=array();
        foreach ($rows as $row) {
            if ( !isset( $this->dosenPikets[ $row->getKodeDosen() ] ) ) {
                $this->dosenPikets[ $row->getKodeDosen() ] = array();
            }
            $this->dosenPikets[ $row->getKodeDosen() ][$row->getMinggu().$row->getHari()] = array(
                'm'=>$row->getMinggu(),
                'h'=>$row->getHari(),
            );
        }
        $c->clear();
        $c->addAscendingOrderByColumn(DosenNonJagaPeer::KODE_DOSEN);
        $rows=  DosenNonJagaPeer::doSelect($c);
        $this->daftarDosenNonJaga=array();
        foreach($rows as $row) {
            $this->daftarDosenNonJaga[ $row->getKodeDosen() ] =array(
                'm1'=>$row->getMulaiMinggu(),
                'm2'=>$row->getSampaiMinggu(),
                'h1'=>$row->getMulaiHari(),
                'h2'=>$row->getSampaiHari(),
            );
        }
        $c->clear();
        $c->addAscendingOrderByColumn(KaryawanNonJagaPeer::KODE_KARYAWAN);
        $rows=  KaryawanNonJagaPeer::doSelect($c);
        $this->daftarKaryawanNonJaga=array();
        foreach($rows as $row) {
            $this->daftarKaryawanNonJaga[ $row->getKodeKaryawan() ] =array(
                'm1'=>$row->getMulaiMinggu(),
                'm2'=>$row->getSampaiMinggu(),
                'h1'=>$row->getMulaiHari(),
                'h2'=>$row->getSampaiHari(),
            );
        }
        
        $filename=dirname(__FILE__).'/../cache/dosenNonJaga.yml';
        $data=sfYaml::dump($this->daftarDosenNonJaga);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/karyawanNonJaga.yml';
        $data=sfYaml::dump($this->daftarKaryawanNonJaga);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/dosenPikets.yml';
        $data=sfYaml::dump($this->dosenPikets);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/dosenReffs.yml';
        $data=sfYaml::dump($this->dosenReffs);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/karyawanReffs.yml';
        $data=sfYaml::dump($this->karyawanReffs);
        file_put_contents($filename, $data);
        
    }
    /**
     * inisialisasi tabel konversi kode ke nama untuk mata kuliah, hanya yang dibuka saja
     */
    private function initMataKuliah() {
        $c=new Criteria();
        $c->add(KelasMKPeer::STATUS_BUKA,1);
        $c->addJoin(KelasMKPeer::KODE_MK, MataKuliahPeer::KODE_MK);
        $c->clearSelectColumns()->clearGroupByColumns();
        $c->addSelectColumn(MataKuliahPeer::KODE_MK);
        $c->addSelectColumn(MataKuliahPeer::NAMA);
        $c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
        $c->setDistinct();
        $rs=  MataKuliahPeer::doSelectStmt($c);
        while ( $row=$rs->fetch(PDO::FETCH_NUM) ) {
            $kodeMk=$row[0];
            $nama=$row[1];
            $this->mataKuliahReffs[$kodeMk]=$nama;
        }
        $filename=dirname(__FILE__).'/../cache/mataKuliahReffs.yml';
        $data=sfYaml::dump($this->mataKuliahReffs);
        file_put_contents($filename, $data);
    }
    
    /**
     * setiap mata kuliah memiliki daftar pengajar, disinilah initnya
     */
    private function initPengajarMk() {
        $c=new Criteria();
        $c->addJoin(DosenKelasPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS);
        $c->addJoin(DosenKelasPeer::KODE_DOSEN, DosenPeer::KODE_DOSEN);
        //$c->add(DosenPeer::IS_PENGAWAS,1);
        $c->clearSelectColumns()->clearGroupByColumns();
        $c->addSelectColumn(KelasMKPeer::KODE_MK);
        $c->add(KelasMKPeer::STATUS_BUKA,1);
        $c->addSelectColumn(DosenKelasPeer::KODE_DOSEN);
        $c->addAscendingOrderByColumn(KelasMKPeer::KODE_MK);
        $c->addDescendingOrderByColumn(DosenKelasPeer::KODE_DOSEN);
        $c->setDistinct();
        $rs= DosenKelasPeer::doSelectStmt($c);
        $this->pengajarMkReffs=array();
        while( $row=$rs->fetch(PDO::FETCH_NUM) ) {
            $kodeMk=$row[0];
            $kodeDosen=$row[1];
            $this->pengajarMkReffs[$kodeDosen]='';
            if ( !isset($this->pengajarMk[$kodeMk]) ) {
                $this->pengajarMk[$kodeMk] = array();
            }
            $this->pengajarMk[$kodeMk][]=$kodeDosen;
            
        }
        ksort($this->pengajarMkReffs);
        $c->clear();
        $c->add(DosenPeer::KODE_DOSEN,array_keys($this->pengajarMkReffs),Criteria::IN);
        $c->addAscendingOrderByColumn(DosenPeer::KODE_DOSEN);
        $dosens=  DosenPeer::doSelect($c);
        foreach($dosens as $dosen) {
            $this->pengajarMkReffs[ $dosen->getKodeDosen() ] = $dosen->getNama();
        }
        
        $filename=dirname(__FILE__).'/../cache/pengajarMk.yml';
        $data=sfYaml::dump($this->pengajarMk);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/pengajarMkReffs.yml';
        $data=sfYaml::dump($this->pengajarMkReffs);
        file_put_contents($filename, $data);
        
    }
    
    /**
     * constructor !! I miss U, D
     */
    public function __construct() {
        $this->errorLogs=array();
        $this->isDataDariBaak = sfConfig::get('app_penjadwalan_AMBIL_DATA_PESERTA_KULIAH_DARI_BAAK',1);
        $this->initUjianSlot();
        $this->initRuangan();
        $this->initMKUjian();
        $this->initDosenKaryawan();
        $this->initMataKuliah();
        $this->settingMinimumKursiKosongUntukPenempatan=  
                sfConfig::get('app_penjadwalan_MINIMUM_KURSI_KOSONG_UNTUK_PENEMPATAN',
                        self::DEFAULT_MINIMUM_KURSI_KOSONG_UNTUK_PENEMPATAN );
        
        $this->settingMaxMatKulPerRuang = 
                sfConfig::get('app_penjadwalan_MAKSIMUM_MATA_KULIAH_PER_RUANG',
                        self::DEFAULT_MAKSIMUM_MATA_KULIAH_PER_RUANG );
        $this->settingMaxJumlahJagaDosen = 
                sfConfig::get('app_penjadwalan_MAKSIMUM_JUMLAH_JAGA_DOSEN',
                        self::DEFAULT_MAKSIMUM_JUMLAH_JAGA_DOSEN );
        $this->settingMaxJumlahJagaKaryawan = 
                sfConfig::get('app_penjadwalan_MAKSIMUM_JUMLAH_JAGA_KARYAWAN',
                        self::DEFAULT_MAKSIMUM_JUMLAH_JAGA_KARYAWAN );
        
        $this->initPengajarMk();
    }
    
    /**
     * jalankan proses randomisasi dan penempatan mata kuliah buka ke slot ujian
     */
    public function jalankanProses() {
        $this->errorLogs=array();
        $this->hitungIsiKelasPerSlot();
        $this->tempatkanPetugasDiRuangan();
        //$this->simpanIsiKelasPerSlotKeDB();
    }
    
    
    
    /**
     * fungsi ini adalah fungsi utama penjadwalan, untuk menghitung berapa jumlah mahasiswa  per slot lalu menempatkannya di ruang-ruang kosong
     *
     * 
     */
    private function hitungIsiKelasPerSlot() {
        $minggu=1;
        $hari=1;
        $jam=1;
        
        $this->isiRuangPerSlot=array();
                    
        try {
            $kode='hitungIsiKelasPerSlot';
            unlink( dirname(__FILE__)."/../web/uploads/".$kode.".log" );
            $kode='plot_ruang';
            unlink( dirname(__FILE__)."/../web/uploads/".$kode.".log" );
            $kode='plot_karyawan';
            unlink( dirname(__FILE__)."/../web/uploads/".$kode.".log" );
        } catch (Exception $e) {
            
        }
        foreach ($this->ujianSlots as $slot) { //untuk tiap slot ...
            //if ($slot!='112') continue; //DEBUG DEBUG DEBUG
            $matkulDiSlot=array();
            $this->writeDebug('hitungIsiKelasPerSlot', "mulai proses pembagian tiap mata kuliah buka ke ruang, jenis KELAS pada slot ke-$slot");
            self::kodeSlotKeMinggu($slot, $minggu, $hari, $jam);
            //ambil dulu daftar matakuliah di slot tersebut, lalu diurutkan
            //dari terbesar isinya ke yang terkecil
            $kodeMks=array_keys($this->mkUjians[$slot]);
            foreach ( $kodeMks as $kodeMk ) {
                //$nomorUrut = sprintf( "%03d.%s", $isi, $kodeMk );
                //$matkulDiSlot[$nomorUrut]=$kodeMk;
                $kps=$this->mkUjians[$slot][$kodeMk]['isi'];
                $uji=$this->mkUjians[$slot][$kodeMk]['uji'];
                $rua=$this->mkUjians[$slot][$kodeMk]['rua'];
                if (( $rua!='LAB' ) && ($uji != 'TGS')) { //hanya yang dikelas dan bukan hanya mengumpulkan tugas atau LAB tertentu
                    foreach($kps as $kp=>$isi) {
                        if ($isi>0) {
                            $kodeKelas=$kodeMk.'_'.$kp;
                            $nomorUrut = sprintf( "%03d.%s", $isi, $kodeKelas );
                            $matkulDiSlot[$nomorUrut]=$kodeKelas;
                        } else {
                            self::error('hitungIsiKelasPerSlot', "Kelas $kodeKelas tidak dijadwalkan karena kapasitas=0");
                            $this->errorLogs[]="Matakuliah $kodeKelas  tidak diperhitungkan karena isinya nol";
                        }
                    }
                }
                
            }
            krsort($matkulDiSlot); //urut terbalik dari besar ke kecil
            //setelah itu diproses satu per satu ke dalam kelas yang tersedia
            
            $matkulsTerlibat =  implode( ",", array_keys($matkulDiSlot) );
            $this->writeDebug('hitungIsiKelasPerSlot', "mata kuliah di slot ke-$slot adalah $matkulsTerlibat");
            $penempatanDiRuang=array();
            foreach($this->ruangKelass as $kodeRuang=>$data  ) {
                $penempatanDiRuang[$kodeRuang] = array(
                    'kap'=>$data['kapasitas_ujian'], 
                    'isi'=>0,
                    'dos'=>null,
                    'kar'=>null,
                    'ket'=>null,
                    'mk'=>array()
                    );
            }
            $matkulSudahBeres = array();
            foreach($matkulDiSlot as $nomorUrut=>$kodeMk) { //tempatkan di ruang paling FIT
                $isi = intval(substr($nomorUrut,0,3));
                //untuk tiap matkul, pertama cek apakah isi kurang dari kapasitas
                //jika kurang, maka masukkan matkul tersebut ke kelas itu
                //$tahap=self::TAHAP_AWAL;
                $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot");
                    

                    
                $kodeRuangs = array_keys($penempatanDiRuang);
                $kodeRuangTerpilih=null; //jika sampai akhir ternyata masih null, berarti tidak ketemu yang fit   
                $deltaKapasitas=1000;//selisih antara kapasitas ruang dengan jumlah mahasiswa
                //tahap pertama, cari ruang yang kapasitasnya best match dengan isi mahasiswa
                    
                foreach ( $kodeRuangs as $kodeRuang  ) {
                    if (( substr($kodeRuang,0,2)!='PE' ) && ( substr($kodeRuang,0,5)!='TF 01' )) { 
                        $kapRuang = $penempatanDiRuang[$kodeRuang]['kap'];
                        $isiRuang = $penempatanDiRuang[$kodeRuang]['isi'];
                        $sisaKursi = $kapRuang - $isiRuang; 
                        $deltaKapasitasBaru =  ( $sisaKursi - $isi );
                        if ( ($deltaKapasitasBaru>=0) && ($deltaKapasitasBaru < $deltaKapasitas )) {
                            $deltaKapasitas=$deltaKapasitasBaru;
                            $kodeRuangTerpilih=$kodeRuang;
                            $this->writeDebug('hitungIsiKelasPerSlot',"Didapatkan ruang sementara untuk MK $kodeMk dengan isi $isi yaitu $kodeRuang sisa kursi $sisaKursi");
                        }                    
                    }
                } //loop untuk semua ruang, bubble short menemukan ruang paling fit
                if ($kodeRuangTerpilih) {
                        $matkulSudahBeres[$kodeMk]=$kodeRuangTerpilih;
                    
                        $penempatanDiRuang[$kodeRuangTerpilih]['mk'][$kodeMk]=$isi;
                        $penempatanDiRuang[$kodeRuangTerpilih]['isi'] = $penempatanDiRuang[$kodeRuangTerpilih]['isi'] + $isi;
                        $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-1 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuangTerpilih masuk total, penempatan selesai");                        
                    
                } else {
                    $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-1 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot GAGAL");                        
                    
                }
            }
            //tahap berikutnya, karena tidak ada yang cocok, maka dilakukan split
//            foreach($matkulDiSlot as $nomorUrut=>$kodeMk) {
//                if (array_key_exists( $kodeMk,$matkulSudahBeres )) {
//                    continue; //cari mata kuliah yang belum beres
//                }//tahap kedua adalah melakukan split
//                $isi = intval(substr($nomorUrut,0,3));
//                $splitRuang = false;
//                $sudahDitempatkan=false;
//                $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses PASS-2 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot");
//
//                foreach ( $kodeRuangs as $kodeRuang  ) {
//                    $kapRuang = $penempatanDiRuang[$kodeRuang]['kap'];
//                    $isiRuang = $penempatanDiRuang[$kodeRuang]['isi'];
//                    
//                    //cek tiap ruangan apakah sisa kursinya cukup
//                    $sisaKursi = $kapRuang - $isiRuang; 
//                    $this->writeDebug('hitungIsiKelasPerSlot',"Cek kecukupan $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang dengan kapasitas $kapRuang dan daya tampung $isiRuang");
//                    if ( ( $isi <= $sisaKursi )  &&
//                                ( count( $penempatanDiRuang[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
//                    {
//                        //jika sisa kursi cukup, maka mata kuliah tersebut selesai ditempatkan
//                        $sudahDitempatkan = true;
//                        $matkulSudahBeres[$kodeMk]=$kodeRuang;
//                        $penempatanDiRuang[$kodeRuang]['mk'][$kodeMk]=$isi;
//                        $penempatanDiRuang[$kodeRuang]['isi'] = $penempatanDiRuang[$kodeRuang]['isi'] + $isi;
//                        $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-2 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk total, penempatan selesai");
//                        break; //dari loop ruang
//                    }
//                }
//                    
//            }

            foreach($matkulDiSlot as $nomorUrut=>$kodeMk) {
                if (array_key_exists( $kodeMk,$matkulSudahBeres )) {
                    continue;
                }//tahap ketiga adalah melakukan split
                $isi = intval(substr($nomorUrut,0,3));  
                $sudahDitempatkan=false;
                
                foreach ( $kodeRuangs as $kodeRuang  ) {                
                    if (( substr($kodeRuang,0,2)!='PE' ) && ( substr($kodeRuang,0,2)!='TG' )) {
                        $kapRuang = $penempatanDiRuang[$kodeRuang]['kap'];
                        $isiRuang = $penempatanDiRuang[$kodeRuang]['isi'];
                        $sisaKursi = $kapRuang - $isiRuang; 
                        if (($isi>0) && ($sisaKursi >= $this->settingMinimumKursiKosongUntukPenempatan)) {

                            //jika tidak cukup maka ada kemungkinan peserta displit menjadi banyak ruang
                            //cek terlebih dahulu apakah di ruang tersebut sisanya cukup banyak
                            $this->writeDebug('hitungIsiKelasPerSlot',"proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang tidak cukup masuk semuanya sisa kursi $sisaKursi ");
                            if ( 
                                    ( count( $penempatanDiRuang[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
                            {
                                if ($isi >= $sisaKursi) {
                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-3 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk kategori split, masuk sejumlah $sisaKursi ");          
                                    $penempatanDiRuang[$kodeRuang]['mk'][$kodeMk]=$sisaKursi;
                                    $penempatanDiRuang[$kodeRuang]['isi'] = $penempatanDiRuang[$kodeRuang]['kap']; //penuh
                                    $isi = $isi - $sisaKursi;

                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-3 pada matakuliah $kodeMk dengan sisa isi=$isi pada slot ke-$slot berlanjut ");          
                                } else {
                                    if ($isi>0) {
                                        $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-3 pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk kategori split, masuk sejumlah $isi ");          
                                        $penempatanDiRuang[$kodeRuang]['mk'][$kodeMk]=$isi;
                                        $penempatanDiRuang[$kodeRuang]['isi'] = $penempatanDiRuang[$kodeRuang]['isi'] + $isi;  
                                        $isi = 0;                    
                                        $sudahDitempatkan=true;
                                        $matkulSudahBeres[$kodeMk]=$kodeRuang;
                                        $this->writeDebug('hitungIsiKelasPerSlot',"proses PASS-3 pada matakuliah $kodeMk dengan sisa isi=$isi pada slot ke-$slot SELESAI ");          
                                    } 

                                }
                            } 
                         }
                    }

                }        
               
                    

            }
            
            $matkulBermasalah = array();
            foreach( $matkulDiSlot as $nomorUrut=>$kodeMk ) {
                if ( !array_key_exists($kodeMk, $matkulSudahBeres) ) {
                    $matkulBermasalah[] = $kodeMk;
                }
            }
            $n=count($matkulBermasalah);
            if ($n>0) {
                $mkText = join(",", $matkulBermasalah);
                $this->writeDebug('plot_ruang',"MASALAH: matakuliah $mkText  pada slot ke-$slot TANPA RUANG ");              
            }
        

            
            $this->isiRuangPerSlot[$slot]=$penempatanDiRuang;
            
            //selesai PEMROSESAN KELAS, lanjut pada PEMROSESAN lab
            $matkulDiSlot=array();
            
            $this->writeDebug('hitungIsiKelasPerSlot', "mulai proses pembagian LAB tiap mata kuliah buka ke ruang, jenis KELAS pada slot ke-$slot");
            $kodeMks=  array_keys($this->mkUjians[$slot]);
            
            foreach ( $kodeMks as $kodeMk  ) {
                //$nomorUrut = sprintf( "%03d.%s", $isi, $kodeMk );
                //$matkulDiSlot[$nomorUrut]=$kodeMk;
                $kps=$this->mkUjians[$slot][$kodeMk]['isi'];
                $uji=$this->mkUjians[$slot][$kodeMk]['uji'];
                $rua=$this->mkUjians[$slot][$kodeMk]['rua'];
                $prio=$this->mkUjians[$slot][$kodeMk]['prio'];
                //kelas yang dipesan khusus untuk digunakan suatu mata kuliah tertentu, harus didefinisikan sebagai LAB
                if (( $rua=='LAB' ) && ($uji != 'TGS')) { //hanya yang dikelas dan bukan hanya mengumpulkan tugas
                    foreach($kps as $kp=>$isi) {
                        if ($isi>0) {
                            $kodeKelas=$kodeMk.'_'.$kp.'_'.$prio;
                            if ($prio) {
                                $prefix=1;
                            } else {
                                $prefix=0;
                            }
                            $nomorUrut = sprintf( "%s.%03d.%s", $prefix, $isi, $kodeKelas );
                            $matkulDiSlot[$nomorUrut]=$kodeKelas;
                        } else {
                            self::error('hitungIsiKelasPerSlot', "Kelas LAB $kodeKelas tidak dijadwalkan karena kapasitas=0");
                            $this->errorLogs[]="Matakuliah LAB $kodeKelas  tidak diperhitungkan karena isinya nol";
                        }
                    }
                }
                
            }
            $penempatanDiLab=array();
            $n=count( $matkulDiSlot );
            if ($n>0) {
                krsort($matkulDiSlot); //urut terbalik dari besar ke kecil
                //setelah itu diproses satu per satu ke dalam kelas yang tersedia

                $matkulsTerlibat =  implode( ",", array_keys($matkulDiSlot) );
                $this->writeDebug('hitungIsiKelasPerSlot', "mata kuliah LAB di slot ke-$slot adalah $matkulsTerlibat");

                foreach($this->ruangLabs as $kodeRuang=>$data  ) {
                    $penempatanDiLab[$kodeRuang] = array(
                        'kap'=>$data['kapasitas_ujian'], 
                        'isi'=>0,
                        'dos'=>false,
                        'kar'=>false,
                        'mk'=>array()
                        );
                }

                    
                foreach($matkulDiSlot as $nomorUrut=>$kodeKelas) { //LAKUKAN PROSES PRIORITAS
                    $isi = intval(substr($nomorUrut,2,3));
                    //untuk tiap matkul, pertama cek apakah isi kurang dari kapasitas
                    //jika kurang, maka masukkan matkul tersebut ke kelas itu
                    //$tahap=self::TAHAP_AWAL;
                    $this->writeDebug('hitungIsiKelasPerSlot',"cek LAB PASS-1 pada matakuliah $kodeKelas urutan $nomorUrut dengan isi $isi pada slot ke-$slot");

                    $prio = substr($nomorUrut,0,1); //jika ada prioritas sebuah MK masuk lab tertentu
                    //diasumsikan isi kelas pasti masuk semua ke lab tersebut
                    if ($prio) {
                        $kodes=explode('_',$nomorUrut);
                        $targetRuang = $kodes[2];
                        list($kodeMk,$kp) = explode('_',$kodeKelas);
                        if ( !isset( $penempatanDiLab[$targetRuang] ) ){
                             $penempatanDiLab[$targetRuang] = array(
                                'kap'=>$isi, 
                                'isi'=>$isi,
                                'dos'=>false,
                                'kar'=>false,
                                'mk'=>array($kodeKelas=>$isi)
                                );
                            $matkulSudahBeres[ $kodeKelas ] = $targetRuang; //masukkan daftar beres agar tidak dicari lagi kemudian
                            $this->writeDebug('hitungIsiKelasPerSlot',"Plot OK LAB PASS-1 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang PRIORITAS $targetRuang");                     
                        } else {
                            //WARNING-WARNING!! SHORTCUT DETECTED
                            //seluruh isi yang diminta akan dimasukkan ke targetRuang
                            //diasumsikan yang mengeset targetRuang paham bahwa isinya dapat ditampung ke dalamnya
                            $penempatanDiLab[$targetRuang]['mk'][$kodeKelas]=$isi;
                            $penempatanDiLab[$targetRuang]['isi']=$penempatanDiLab[$targetRuang]['isi']+$isi;
                    
                            $matkulSudahBeres[ $kodeKelas ] = $targetRuang; //masukkan daftar beres agar tidak dicari lagi kemudian
                            $this->writeDebug('hitungIsiKelasPerSlot',"Plot OK LAB PASS-1 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang PRIORITAS $targetRuang");                     
                        }
                    }
                }
                $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-2 pada matakuliah dimulai pada slot ke-$slot");                     
                foreach($matkulDiSlot as $nomorUrut=>$kodeKelas) { //LAKUKAN PROSES PENEMPATAN PADA RUANG PALING FIT
                    if (!array_key_exists($kodeKelas, $matkulSudahBeres) ) {
                    
                        $isi = intval(substr($nomorUrut,2,3));
                        $deltaKapasitas=1000;
                        $kodeRuangTerpilih=null;
                        $kodeRuangs=array_keys($penempatanDiLab);
                        foreach ( $kodeRuangs as $kodeRuang ) {
                            $kapRuang = $penempatanDiLab[$kodeRuang]['kap'];
                            $isiRuang = $penempatanDiLab[$kodeRuang]['isi'];
                            $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-2 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang dengan kapasitas $kapRuang dan isi awal $isiRuang");
                            //cek tiap ruangan apakah sisa kursinya cukup
                            $sisaKursi = $kapRuang - $isiRuang; 
                            $deltaKapasitasBaru=$sisaKursi - $isi;
                            if ($deltaKapasitasBaru>=0) {
                                if ($deltaKapasitasBaru<$deltaKapasitas) {
                                    $kodeRuangTerpilih=$kodeRuang; //DICARI RUANG YANG KAPASITASNYA PALING MENDEKATI
                                }                            
                            }                                                
                        }
                        if ($kodeRuangTerpilih) { //jika tidak null berarti ketemu
                            $matkulSudahBeres[$kodeKelas]=$kodeRuangTerpilih; //masukkan daftar beres agar tidak dicari lagi kemudian
                            $penempatanDiLab[$kodeRuangTerpilih]['mk'][$kodeKelas]=$isi;
                            $penempatanDiLab[$kodeRuangTerpilih]['isi']=$penempatanDiLab[$kodeRuangTerpilih]['isi']+$isi;  
                            $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-2 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuangTerpilih masuk FIT total");                     
                        }
                    }

                }
                
                
                $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-3 pada matakuliah dimulai pada slot ke-$slot dengan metode SPLIT"); 
                foreach($matkulDiSlot as $nomorUrut=>$kodeKelas) { //berikutnya cari sistem split
                    if (!array_key_exists($kodeKelas, $matkulSudahBeres) ) {
                        $isi = intval(substr($nomorUrut,2,3));


                        $kodeRuangs=array_keys($penempatanDiLab);
                        foreach ( $kodeRuangs as $kodeRuang ) {
                            $kapRuang = $penempatanDiLab[$kodeRuang]['kap'];
                            $isiRuang = $penempatanDiLab[$kodeRuang]['isi'];
                    
                            //cek tiap ruangan apakah sisa kursinya cukup
                            $sisaKursi = $kapRuang - $isiRuang; 
                            if ( ( $isi <= $sisaKursi )  &&  //non split
                                        ( count( $penempatanDiLab[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
                            {
                                //jika sisa kursi cukup, maka mata kuliah tersebut selesai ditempatkan
                                $sudahDitempatkan = true;
                                $penempatanDiLab[$kodeRuang]['mk'][$kodeKelas]=$isi;
                                $penempatanDiLab[$kodeRuang]['isi'] = $penempatanDiLab[$kodeRuang]['isi'] + $isi;
                                $matkulSudahBeres[$kodeKelas]=$kodeRuang; //masukkan daftar beres agar tidak dicari lagi kemudian
                                $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS=3 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk total, penempatan selesai");
                            } else {
                                //jika tidak cukup maka ada kemungkinan peserta displit menjadi banyak ruang
                                //cek terlebih dahulu apakah di ruang tersebut sisanya cukup banyak
                                $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-3 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang tidak cukup masuk semuanya daya tampung $sisaKursi");
                                if ( ( $sisaKursi >= $this->settingMinimumKursiKosongUntukPenempatan ) &&
                                        ( count( $penempatanDiLab[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
                                {
                                    //boleh displit
                                    $penempatanDiLab[$kodeRuang]['mk'][$kodeKelas]=$sisaKursi;
                                    $penempatanDiLab[$kodeRuang]['isi'] = $penempatanDiLab[$kodeRuang]['kap']; //penuh
                                    $isi = $isi - $sisaKursi;
                                    $splitRuang=true;
                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-3 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk kategori split, masuk sejumlah $sisaKursi ");
                                } else {
                                    //pindah cek ruang berikutnya
                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB PASS-3 pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang sisa kursi $sisaKursi gagal masuk, pindah ke ruang berikutnya ");
                                }

                            }
                            if ($sudahDitempatkan) {

                                break;
                            }

                        }

                        if (!$sudahDitempatkan) {
                            $this->errorLogs[]="Matakuliah $kodeKelas dengan isi $isi tidak mendapatkan ruang di slot $slot";
                            self::error('hitungIsiKelasPerSlot',"ERROR! proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot GAGAL masuk ke semua ruangan tersedia ");
                        }
                    } // IF NOT IN ARRAY MATKUL SUDAH BERES

                }
            }
            
            $n=count( $penempatanDiLab );
            if ($n>0) {
                $this->isiRuangPerSlot[$slot]= array_merge($penempatanDiRuang,$penempatanDiLab);            
            } else {
                $this->writeDebug('hitungIsiKelasPerSlot', "Proses penempatan LAB tidak dilakukan di slot $slot karena tidak ada data");
            }
            
            
            
             
            
        }
        $filename=dirname(__FILE__).'/../cache/isiRuangPerSlot.yml';
        $data=sfYaml::dump($this->isiRuangPerSlot);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/errorRuangLogs.yml';
        $data=sfYaml::dump($this->errorLogs);
        file_put_contents($filename, $data);
        
    }
    
//    
//    
//    /**
//     * fungsi ini untuk menghitung berapa jumlah mahasiswa  per slot lalu menempatkannya di ruang-ruang kosong
//     */
//    private function hitungIsiKelasPerSlotDisabled() {
//        $minggu=1;
//        $hari=1;
//        $jam=1;
//        
//        $this->isiRuangPerSlot=array();
//        $flog=fopen( dirname(__FILE__).'/../cache/hitungIsiKelasPerSlot.log','w' );
//        
//        foreach ($this->ujianSlots as $slot) { //untuk tiap slot ...
//            $matkulDiSlot=array();
//            $this->writeDebug('hitungIsiKelasPerSlot', "mulai proses pembagian tiap mata kuliah buka ke ruang, jenis KELAS pada slot ke-$slot");
//            self::kodeSlotKeMinggu($slot, $minggu, $hari, $jam);
//            //ambil dulu daftar matakuliah di slot tersebut, lalu diurutkan
//            //dari terbesar isinya ke yang terkecil
//            $kodeMks=array_keys($this->mkUjians[$slot]);
//            foreach ( $kodeMks as $kodeMk ) {
//                //$nomorUrut = sprintf( "%03d.%s", $isi, $kodeMk );
//                //$matkulDiSlot[$nomorUrut]=$kodeMk;
//                $kps=$this->mkUjians[$slot][$kodeMk]['isi'];
//                $uji=$this->mkUjians[$slot][$kodeMk]['uji'];
//                $rua=$this->mkUjians[$slot][$kodeMk]['rua'];
//                if (( $rua!='LAB' ) && ($uji != 'TGS')) { //hanya yang dikelas dan bukan hanya mengumpulkan tugas atau LAB tertentu
//                    foreach($kps as $kp=>$isi) {
//                        if ($isi>0) {
//                            $kodeKelas=$kodeMk.'_'.$kp;
//                            $nomorUrut = sprintf( "%03d.%s", $isi, $kodeKelas );
//                            $matkulDiSlot[$nomorUrut]=$kodeKelas;
//                        } else {
//                            self::error('hitungIsiKelasPerSlot', "Kelas $kodeKelas tidak dijadwalkan karena kapasitas=0");
//                            $this->errorLogs[]="Matakuliah $kodeKelas  tidak diperhitungkan karena isinya nol";
//}
//                    }
//                }
//                
//            }
//            krsort($matkulDiSlot); //urut terbalik dari besar ke kecil
//            //setelah itu diproses satu per satu ke dalam kelas yang tersedia
//            
//            $matkulsTerlibat =  implode( ",", array_keys($matkulDiSlot) );
//            $this->writeDebug('hitungIsiKelasPerSlot', "mata kuliah di slot ke-$slot adalah $matkulsTerlibat");
//            $penempatanDiRuang=array();
//            foreach($this->ruangKelass as $kodeRuang=>$data  ) {
//                $penempatanDiRuang[$kodeRuang] = array(
//                    'kap'=>$data['kapasitas_ujian'], 
//                    'isi'=>0,
//                    'dos'=>null,
//                    'kar'=>null,
//                    'ket'=>null,
//                    'mk'=>array()
//                    );
//            }
//            
//            foreach($matkulDiSlot as $nomorUrut=>$kodeMk) {
//                $isi = intval(substr($nomorUrut,0,3));
//                //untuk tiap matkul, pertama cek apakah isi kurang dari kapasitas
//                //jika kurang, maka masukkan matkul tersebut ke kelas itu
//                //$tahap=self::TAHAP_AWAL;
//                $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot");
//
//                $sudahDitempatkan = false;
//                $splitRuang = false;
//                $kodeRuangs = array_keys($penempatanDiRuang);
//                foreach ( $kodeRuangs as $kodeRuang  ) {
//                    $kapRuang = $penempatanDiRuang[$kodeRuang]['kap'];
//                    $isiRuang = $penempatanDiRuang[$kodeRuang]['isi'];
//                    $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang dengan kapasitas $kapRuang dan isi awal $isiRuang");
//                    //cek tiap ruangan apakah sisa kursinya cukup
//                    $sisaKursi = $kapRuang - $isiRuang; 
//                    if ( ( $isi <= $sisaKursi )  &&
//                                ( count( $penempatanDiRuang[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
//                    {
//                        //jika sisa kursi cukup, maka mata kuliah tersebut selesai ditempatkan
//                        $sudahDitempatkan = true;
//                        $penempatanDiRuang[$kodeRuang]['mk'][$kodeMk]=$isi;
//                        $penempatanDiRuang[$kodeRuang]['isi'] = $penempatanDiRuang[$kodeRuang]['isi'] + $isi;
//                        $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk total, penempatan selesai");
//                    } else {
//                        //jika tidak cukup maka ada kemungkinan peserta displit menjadi banyak ruang
//                        //cek terlebih dahulu apakah di ruang tersebut sisanya cukup banyak
//                        $this->writeDebug('hitungIsiKelasPerSlot',"proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang tidak cukup masuk semuanya");
//                        if ( ( $sisaKursi >= $this->settingMinimumKursiKosongUntukPenempatan ) &&
//                                ( count( $penempatanDiRuang[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
//                        {
//                            //boleh displit
//                            $penempatanDiRuang[$kodeRuang]['mk'][$kodeMk]=$sisaKursi;
//                            $penempatanDiRuang[$kodeRuang]['isi'] = $penempatanDiRuang[$kodeRuang]['kap']; //penuh
//                            $isi = $isi - $sisaKursi;
//                            $splitRuang=true;
//                            $this->writeDebug('hitungIsiKelasPerSlot',"proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk kategori split, masuk sejumlah $sisaKursi ");
//                        } else {
//                            //pindah cek ruang berikutnya
//                            $this->writeDebug('hitungIsiKelasPerSlot',"proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot ruang $kodeRuang gagal masuk, pindah ke ruang berikutnya ");
//                        }
//                        
//                    }
//                    if ($sudahDitempatkan) {
//                        
//                        break;
//                    }
//                    
//                }
//                if (!$sudahDitempatkan) {
//                    $this->errorLogs[]="Matakuliah $kodeMk dengan isi $isi tidak mendapatkan ruang di slot $slot";
//                    self::error('hitungIsiKelasPerSlot',"ERROR! proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot GAGAL masuk ke semua ruangan tersedia ");
//                    if ($flog) {
//                        fwrite($flog, "ERROR! proses pada matakuliah $kodeMk dengan isi $isi pada slot ke-$slot GAGAL masuk ke semua ruangan tersedia\n" );
//                    }
//                }
//                
//            }
//            
//            
//            $this->isiRuangPerSlot[$slot]=$penempatanDiRuang;
//            
//            //selesai PEMROSESAN KELAS, lanjut pada PEMROSESAN lab
//            $matkulDiSlot=array();
//            
//            $this->writeDebug('hitungIsiKelasPerSlot', "mulai proses pembagian LAB tiap mata kuliah buka ke ruang, jenis KELAS pada slot ke-$slot");
//            $kodeMks=  array_keys($this->mkUjians[$slot]);
//            foreach ( $kodeMks as $kodeMk  ) {
//                //$nomorUrut = sprintf( "%03d.%s", $isi, $kodeMk );
//                //$matkulDiSlot[$nomorUrut]=$kodeMk;
//                $kps=$this->mkUjians[$slot][$kodeMk]['isi'];
//                $uji=$this->mkUjians[$slot][$kodeMk]['uji'];
//                $rua=$this->mkUjians[$slot][$kodeMk]['rua'];
//                $prio=$this->mkUjians[$slot][$kodeMk]['prio'];
//                if (( $rua=='LAB' ) && ($uji != 'TGS')) { //hanya yang dikelas dan bukan hanya mengumpulkan tugas
//                    foreach($kps as $kp=>$isi) {
//                        if ($isi>0) {
//                            $kodeKelas=$kodeMk.'_'.$kp.'_'.$prio;
//                            if ($prio) {
//                                $prefix=1;
//                            } else {
//                                $prefix=0;
//                            }
//                            $nomorUrut = sprintf( "%s.%03d.%s", $prefix, $isi, $kodeKelas );
//                            $matkulDiSlot[$nomorUrut]=$kodeKelas;
//                        } else {
//                            self::error('hitungIsiKelasPerSlot', "Kelas LAB $kodeKelas tidak dijadwalkan karena kapasitas=0");
//                            $this->errorLogs[]="Matakuliah LAB $kodeKelas  tidak diperhitungkan karena isinya nol";
//                        }
//                    }
//                }
//                
//            }
//            
//            
//            $penempatanDiLab=array();
//            $n=count( $matkulDiSlot );
//            if ($n>0) {
//                krsort($matkulDiSlot); //urut terbalik dari besar ke kecil
//                //setelah itu diproses satu per satu ke dalam kelas yang tersedia
//
//                $matkulsTerlibat =  implode( ",", array_keys($matkulDiSlot) );
//                $this->writeDebug('hitungIsiKelasPerSlot', "mata kuliah LAB di slot ke-$slot adalah $matkulsTerlibat");
//
//                foreach($this->ruangLabs as $kodeRuang=>$data  ) {
//                    $penempatanDiLab[$kodeRuang] = array(
//                        'kap'=>$data['kapasitas_ujian'], 
//                        'isi'=>0,
//                        'dos'=>false,
//                        'kar'=>false,
//                        'mk'=>array()
//                        );
//                }
//
//                foreach($matkulDiSlot as $nomorUrut=>$kodeKelas) {
//                    $isi = intval(substr($nomorUrut,2,3));
//                    //untuk tiap matkul, pertama cek apakah isi kurang dari kapasitas
//                    //jika kurang, maka masukkan matkul tersebut ke kelas itu
//                    //$tahap=self::TAHAP_AWAL;
//                    $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot");
//
//                    $sudahDitempatkan = false;
//                    $splitRuang = false;
//                    $prio = substr($nomorUrut,0,1); //jika ada prioritas sebuah MK masuk lab tertentu
//                    //diasumsikan isi kelas pasti masuk semua ke lab tersebut
//                    if ($prio) {
//                        $kodes=explode('_',$nomorUrut);
//                        $targetRuang = $kodes[2];
//                        list($kodeMk,$kp) = explode('_',$kodeKelas);
//                        if ( isset( $penempatanDiLab[$targetRuang] ) ){
//                            //WARNING-WARNING!! SHORTCUT DETECTED
//                            //seluruh isi yang diminta akan dimasukkan ke targetRuang
//                            //diasumsikan yang mengeset targetRuang paham bahwa isinya dapat ditampung ke dalamnya
//                            $penempatanDiLab[$targetRuang]['mk'][$kodeKelas]=$isi;
//                            $penempatanDiLab[$targetRuang]['isi']=$isi;
//                            $sudahDitempatkan=true;
//                        }
//                    } 
//                }
//                        
//                foreach($matkulDiSlot as $nomorUrut=>$kodeKelas) {
//                    $isi = intval(substr($nomorUrut,2,3));
//
//                        foreach ( $penempatanDiLab as $kodeRuang=>$data ) {
//                            $kapRuang = $data['kap'];
//                            $isiRuang = $data['isi'];
//                            $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang dengan kapasitas $kapRuang dan isi awal $isiRuang");
//                            //cek tiap ruangan apakah sisa kursinya cukup
//                            $sisaKursi = $kapRuang - $isiRuang; 
//                            if ( ( $isi <= $sisaKursi )  &&
//                                        ( count( $penempatanDiLab[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
//                            {
//                                //jika sisa kursi cukup, maka mata kuliah tersebut selesai ditempatkan
//                                $sudahDitempatkan = true;
//                                $penempatanDiLab[$kodeRuang]['mk'][$kodeKelas]=$isi;
//                                $penempatanDiLab[$kodeRuang]['isi'] = $penempatanDiLab[$kodeRuang]['isi'] + $isi;
//                                $this->writeDebug('hitungIsiKelasPerSlot',"mulai proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk total, penempatan selesai");
//                            } else {
//                                //jika tidak cukup maka ada kemungkinan peserta displit menjadi banyak ruang
//                                //cek terlebih dahulu apakah di ruang tersebut sisanya cukup banyak
//                                $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang tidak cukup masuk semuanya");
//                                if ( ( $sisaKursi >= $this->settingMinimumKursiKosongUntukPenempatan ) &&
//                                        ( count( $penempatanDiLab[$kodeRuang]['mk'] ) < $this->settingMaxMatKulPerRuang ) )
//                                {
//                                    //boleh displit
//                                    $penempatanDiLab[$kodeRuang]['mk'][$kodeKelas]=$sisaKursi;
//                                    $penempatanDiLab[$kodeRuang]['isi'] = $penempatanDiLab[$kodeRuang]['kap']; //penuh
//                                    $isi = $isi - $sisaKursi;
//                                    $splitRuang=true;
//                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang masuk kategori split, masuk sejumlah $sisaKursi ");
//                                } else {
//                                    //pindah cek ruang berikutnya
//                                    $this->writeDebug('hitungIsiKelasPerSlot',"proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot ruang $kodeRuang gagal masuk, pindah ke ruang berikutnya ");
//                                }
//
//                            }
//                            if ($sudahDitempatkan) {
//
//                                break;
//                            }
//
//                        }
//                }
//                    if (!$sudahDitempatkan) {
//                        $this->errorLogs[]="Matakuliah $kodeKelas dengan isi $isi tidak mendapatkan ruang di slot $slot";
//                        self::error('hitungIsiKelasPerSlot',"ERROR! proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot GAGAL masuk ke semua ruangan tersedia ");
//                        if ($flog) {
//                            fwrite($flog, "ERROR! proses LAB pada matakuliah $kodeKelas dengan isi $isi pada slot ke-$slot GAGAL masuk ke semua ruangan tersedia\n" );
//                        }
//                    }
//
//                }
//            }
//            
//            $n=count( $penempatanDiLab );
//            if ($n>0) {
//                $this->isiRuangPerSlot[$slot]= array_merge($penempatanDiRuang,$penempatanDiLab);            
//            } else {
//                $this->writeDebug('hitungIsiKelasPerSlot', "Proses penempatan LAB tidak dilakukan di slot $slot karena tidak ada data");
//            }
//            
//            
//            
//             
//            
//        }
//        if ($flog) {
//            fclose($flog);
//        }
//        $filename=dirname(__FILE__).'/../cache/isiRuangPerSlot.yml';
//        $data=sfYaml::dump($this->isiRuangPerSlot);
//        file_put_contents($filename, $data);
//        $filename=dirname(__FILE__).'/../cache/errorRuangLogs.yml';
//        $data=sfYaml::dump($this->errorLogs);
//        file_put_contents($filename, $data);
//        
//    }    
    
    /**
     * mencari dosen yang bisa ditempatkan di slot tertentu secara random
     * @param string $slot
     * @return kodeDosen jika berhasil, atau false jika gagal
     */
    private function randomTempatkanDosenDiSlot($slot) {
        $n=count( $this->dosenReffs );
        $keys=array_keys($this->dosenReffs);
        $isKetemu=false;
        $r=rand(0,$n-1);
        $i=1;
        $maxRandom = $n*2;
        while ( !$isKetemu && ($i<$maxRandom) ) {
            $kodeDosen = $keys[$r];
            if ( $this->tempatkanDosenDiSlot($slot, $kodeDosen) ) {
                $isKetemu=true;
                return $kodeDosen;
            } else {
                $i++;
                $r=rand(0,$n-1);
            }
        }
        return false;
    }
    
    /**
     * mencari karyawan yang bisa ditempatkan di slot tertentu secara random
     * @param string $slot
     * @return kode karyawan jika berhasil, atau false jika gagal
     */
    private function randomTempatkanKaryawanDiSlot($slot) {
        $n=count( $this->karyawanReffs );
        $keys=array_keys($this->karyawanReffs);
        $isKetemu=false;
        $r=rand(0,$n-1);
        $i=1;
        $maxRandom = $n*10;
        while ( !$isKetemu && ($i<$maxRandom) ) {
            $kodeKaryawan = $keys[$r];
            if ( $this->tempatkanKaryawanDiSlot($slot, $kodeKaryawan) ) {
                $isKetemu=true;
                return $kodeKaryawan;
            } else {
                $i++;
                $r=rand(0,$n-1);
            }
        }
        return false;
    }    
    
    /**
     * menguji apakah dosen tertentu boleh ditempatkan di slot tertentu
     * @param string $slot
     * @param string $kodeDosen
     * @return boolean true jika berhasil, dan false jika tidak memenuhi ketentuan
     */
    private function tempatkanDosenDiSlot($slot,$kodeDosen,$isLogged=false,$kodeMk='64B032') {
        $minggu = substr($slot,0,1);
        $hari   = substr($slot,1,1);
        $jam = substr($slot,2,1);
        
        $flog=null;
        if ($isLogged  ) {
            $this->isDebug=true;
            $flog=fopen( dirname(__FILE__).'/../cache/tempatkanDosenDiSlot.log','a' ); 
            if ($flog) {
                fwrite($flog,"-------------\n");
                fwrite($flog,"01.mulai mencari apakah dosen $kodeDosen bisa bertugas di slot $slot untuk $kodeMk\n");
            }            
            $filename=dirname(__FILE__).'/../cache/daftarDosenNonJagaDebug.yml';
            $data=sfYaml::dump($this->daftarDosenNonJaga);
            file_put_contents($filename, $data);
            
            
        }

        if (($jam==1) && (($kodeDosen=='203014') || ($kodeDosen=='202017'))) {  
                    
            //hope someday you will understand how much I care about you, D ... 
            //and how much you hurt me as return, but my love is a lot bigger than my hate. 
            //whatever makes you happy, even it means throwing me away ... I accept your will
             //but ...
            //love doesn't need to have a happy ending, because love doesn't need to end at all
            //I love Allah, His prophet Muhammad, and you
            //this is the truth, I can not lie about my own feelings
            //I may take a distance from you from now on,
            //A hard decision to make, but I feel that can make you happier 
            //good bye D.. hope your life is better without me
            //I love you, as always ....
            return false;
        }
        $kodeHari = substr ( $slot, 0, 2 );

         
        //cek apakah dosennya piket di hari itu
        if ( isset( $this->dosenPikets[$kodeDosen] ) ) {
            $kdPikets=array_keys($this->dosenPikets[$kodeDosen]);
            foreach( $kdPikets as $kdPiket ) {
                if ( ($this->dosenPikets[$kodeDosen][$kdPiket]['m']==$minggu) 
                     && ($this->dosenPikets[$kodeDosen][$kdPiket]['h']==$hari)    
                        ) {


                    return false; //dosen piket di hari itu, tidak bisa diset jaga
                }
            }
        }
        
        if ($isLogged) {
            if ($flog) {
                fwrite($flog,"-------------\n");
                fwrite($flog,"01A.Cek dosen $kodeDosen diblok jaga di slot $slot untuk $kodeMk\n");
                fwrite($flog, sfYaml::dump($this->daftarDosenNonJaga)  ."\n" );
            }            
        }
        //cek apakah dosennya di hari itu masuk kategori non jaga, misalnya cuti atau tugas univ
        if ( isset( $this->daftarDosenNonJaga[$kodeDosen] ) ) {
            $kh1=intval($this->daftarDosenNonJaga[$kodeDosen]['m1']. $this->daftarDosenNonJaga[$kodeDosen]['h1']);
            $kh2=intval($this->daftarDosenNonJaga[$kodeDosen]['m2']. $this->daftarDosenNonJaga[$kodeDosen]['h2']);
            $kh=intval(substr($slot,0,2));

        if ($isLogged) {
            if ($flog) {
                fwrite($flog,"-------------\n");
                fwrite($flog,"01B.Dosen $kodeDosen TERNYATA diblok jaga di slot $slot antara $kh1 dan $kh2 untuk $kodeMk\n");
            }            
        }
            
            
            if ( ($kh>=$kh1) && ($kh<=$kh2) ) {
                return false; //dosen terdaftar sebagai non jaga di hari itu
            }
        } else {
            
            if ($isLogged) {
                if ($flog) {
                    fwrite($flog,"-------------\n");
                    fwrite($flog,"01B.Dosen $kodeDosen TIDAK diblok jaga di slot $slot untuk $kodeMk\n");
                }            
            }
        }
        
        
        
        //cek dulu apakah dosen sudah terdaftar di slot tersebut
        if (isset( $this->daftarDosenJaga[$kodeDosen] )) {
            if (in_array($slot, $this->daftarDosenJaga[$kodeDosen])) {
                if ($flog && ($isLogged)) {
                    fwrite($flog,"02.GAGAL ternyata dosen $kodeDosen sudah bertugas di slot $slot untuk $kodeMk\n");
                        fclose($flog); 
                }
                return false;
            }
            //cek apakah di hari itu terjadi jam kesatu dan keempat
            $jam=$slot % 10;
            $mingguHari = floor($slot/10);
            if ( $jam==1 ) {
                $cariSlot = $mingguHari.'4';
                if (in_array($cariSlot, $this->daftarDosenJaga[$kodeDosen]) ) {
                    if ($flog && ($isLogged)) {
                        fwrite($flog,"03.GAGAL ternyata dosen $kodeDosen sudah bertugas di jam ke-empat untuk jam pertama slot $slot  untuk $kodeMk\n");
                        fclose($flog);
                    }
                    return false;
                }
            }
            if ( $jam==4 ) {
                $cariSlot = $mingguHari.'1';
                if (in_array($cariSlot, $this->daftarDosenJaga[$kodeDosen]) ) {
                    if ($flog && ($isLogged)) {
                        fwrite($flog,"04.GAGAL ternyata dosen $kodeDosen sudah bertugas di jam ke-satu untuk jam keempat slot $slot  untuk $kodeMk\n");
                        fclose($flog);
                    }
                    return false;
                }
            }
            
            //cek apakah di hari itu sudah jaga 2 kali
            $i=0;
            foreach( $this->daftarDosenJaga[$kodeDosen] as $cekSlot) {
                $mingguHariCek = floor($cekSlot/10);
                if (( abs ($mingguHari - $mingguHariCek) < 0.0001 )) {
                    $i++;
                }
            }
            if ($i>=2) {
                    if ($flog && ($isLogged)) {
                        fwrite($flog,"05.GAGAL ternyata dosen $kodeDosen sudah bertugas dua kali sebelum ditugaskan di slot $slot  untuk $kodeMk\n");
                        fclose($flog);
                    }
                return false;
            }
            
            
            //cek apakah jumlah jaga dosen melebihi nilai maksimum total
            $n=count( $this->daftarDosenJaga[$kodeDosen] );            
            if ($n >= $this->settingMaxJumlahJagaDosen) {
                    if ($flog && ($isLogged)) {
                        fwrite($flog,"06.GAGAL ternyata dosen $kodeDosen sudah bertugas maksimum slot sebelum ditugaskan di slot $slot  untuk $kodeMk\n");
                        fclose($flog);
                    }
                return false;
            }
            
            
        }
        $this->daftarDosenJaga[$kodeDosen][]=$slot;
                    if ($flog && ($isLogged)) {
                        fwrite($flog,"07.BERHASIL ternyata dosen $kodeDosen bisa ditugaskan di slot $slot  untuk $kodeMk\n");
                        fclose($flog);
                    }
        $this->isDebug=false;
        return true;
        
    }
    
    private function tempatkanKaryawanDiSlot($slot,$kodeKaryawan) {
        if (self::IS_DEBUG) {
            $flog=fopen( dirname(__FILE__).'/../cache/tempatkanKaryawanDiSlot.log','a' );         
        }
        
        //cek apakah karyawan di hari itu masuk kategori non jaga, misalnya cuti atau tugas univ
        if ( isset( $this->daftarKaryawanNonJaga[$kodeKaryawan] ) ) {
            $kh1=intval($this->daftarKaryawanNonJaga[$kodeKaryawan]['m1']. $this->daftarKaryawanNonJaga[$kodeKaryawan]['h1']);
            $kh2=intval($this->daftarKaryawanNonJaga[$kodeKaryawan]['m2']. $this->daftarKaryawanNonJaga[$kodeKaryawan]['h2']);
            $kh=intval(substr($slot,0,2));
            if ( ($kh>=$kh1) && ($kh<=$kh2) ) {
                return false; //dosen terdaftar sebagai non jaga di hari itu
            }
        }
        
        //cek dulu apakah karyawan sudah terdaftar di slot tersebut
        if (isset( $this->daftarKaryawanJaga[$kodeKaryawan] )) {
            if (in_array($slot, $this->daftarKaryawanJaga[$kodeKaryawan])) {
                if (self::IS_DEBUG) {                     
                    fwrite($flog,"FAIL: Karyawan $kodeKaryawan sudah terdaftar di slot $slot\n");
                    fclose($flog);
                }
                
                return false;
            }
            //cek apakah di hari itu terjadi jam kesatu dan keempat
            $jam=$slot % 10;
            $mingguHari = floor($slot/10);
            if ( $jam==1 ) {
                $cariSlot = $mingguHari.'4';
                if (in_array($cariSlot, $this->daftarKaryawanJaga[$kodeKaryawan]) ) {
                    return false;
                }
            }
            if ( $jam==4 ) {
                $cariSlot = $mingguHari.'1';
                if (in_array($cariSlot, $this->daftarKaryawanJaga[$kodeKaryawan]) ) {
                    if (self::IS_DEBUG) {                     
                        fwrite($flog,"FAIL: Karyawan $kodeKaryawan sudah jaga di jam pertama terhadap $slot\n");
                        fclose($flog);
                    }
                    return false;
                }
            }
            
            //cek apakah di hari itu sudah jaga 2 kali
            $i=0;
            foreach( $this->daftarKaryawanJaga[$kodeKaryawan] as $cekSlot) {
                $mingguHariCek = floor($cekSlot/10);
                if (( abs ($mingguHari - $mingguHariCek) < 0.0001 )) {
                    $i++;
                }
            }
            if ($i>=3) {
                if (self::IS_DEBUG) {                     
                    fwrite($flog,"FAIL: Karyawan $kodeKaryawan sudah jaga 3 kali di hari ini slot $slot\n");
                    fclose($flog);
                }
                
                return false;
            }
            
            
            //cek apakah jumlah jaga dosen melebihi nilai maksimum total
            $n=count( $this->daftarKaryawanJaga[$kodeKaryawan] );            
            if ($n >= $this->settingMaxJumlahJagaKaryawan) {
                if (self::IS_DEBUG) {                     
                    fwrite($flog,"FAIL: Karyawan $kodeKaryawan sudah melebihi batas jaga max $n\n");
                    fclose($flog);
                }
                
                return false;
            }
            
            
        }
        $this->daftarKaryawanJaga[$kodeKaryawan][]=$slot;
                if (self::IS_DEBUG) {                     
                    fwrite($flog,"GOOD: Karyawan $kodeKaryawan  terdaftar di slot $slot\n");
                    fclose($flog);
                }
        
        return true;
        
    }
        
    /**
     * function tempatkanPetugasDiRuangan() untuk menempatkan dosen dan karyawan di tiap ruang per slot
     * 
     * fungsi ini baru boleh dijalankan setelah terlebih dahulu menempatkan mahasiswa ke ruangan
     * melalui fungsi hitungIsiKelasPerSlot()  dan sebaiknya disusul dengan simpanIsiKelasPerSlotKeDB()
     * perhatikan bahwa hitungIsiKelasPerSlot() hanya memproses ujian yang ada di ruang kelas, bukan LAB
     * sehingga harus ditambahkan dulu ujian di LAB baru bisa menempatkan petugas-petugas
     */
    private function tempatkanPetugasDiRuangan() {
                    
        $this->daftarDosenJaga = array();
        $this->daftarKaryawanJaga = array();
                    
        //masukkan dosen yang jaga mata kuliah tanpa ujian tulis/lab yang mengumpulkan tugas saja
        $c=new Criteria();
        $c->add( JadwalUjianPeer::JENIS_UJIAN,'TGS' );
        $c->addAscendingOrderByColumn(JadwalUjianPeer::KODE_MK);
        $jadwals = JadwalUjianPeer::doSelect($c);
        foreach($jadwals as $jadwal) {
            $kodeMk = $jadwal->getKodemk();
//            $c->clear();
//            $c->add(DosenKelasPeer::KODE_KELAS,$kodeMk.'%',Criteria::LIKE );
//            $dosen=  DosenKelasPeer::doSelectOne($c);
//            if ($dosen) {
//                $kodeDosen = $dosen->getKodeDosen();
//            } else {
//                $kodeDosen = null;
//            }
                    
            $kodeDosen = null; //UNTUK jenis tugas ini defaultnya dikosongi saja
            //alasannya, belum tentu dijaga dosen kalau hanya mengumpulkan tugas
            //tidak mengurangi jatah maksimum 5 jaga ujian di kelas yang normal
            $kodeRuang = $jadwal->getPrioritasRuang();
            if (!$kodeRuang) {
                $kodeJur = substr($kodeMk,0,2);
                switch ( $kodeJur ) {
                    case '65':
                        $kodeRuang = 'TG 01.03';
                        break;
                    case '66':
                        $kodeRuang = 'PE 02.02';
                        break;
                    case '61':
                        $kodeRuang = 'TC 03';
                        break;
                    default:
                        $kodeRuang = 'TC 02.01';
                }
            }
            try {
                
                $ruang = RuangPeer::retrieveByPK($kodeRuang);
                if (!$ruang) {
                    $ruang=new Ruang();
                    $ruang->setKodeRuang($kodeRuang);
                    $ruang->setJenis('LAB');
                    $ruang->setUntukUjian(0);
                    $ruang->setKapasitas(24);
                    $ruang->setKapasitasUjian(24);
                    $ruang->save();
                }
                
                $jr = new JadwalRuang();
                $jr->setKodeDosen($kodeDosen);
                $jr->setHari($jadwal->getHari());
                $jr->setMinggu($jadwal->getMinggu());
                $jr->setJam( $jadwal->getJam() );
                $jr->setKodeRuang($kodeRuang);
                $jr->save();
                $jrm=new JadwalRuangMk();
                $jrm->setJadwalRuangId($jr->getId());
                $jrm->setKodeKelas($kodeMk);
                $jrm->setKp('*');

                $jrm->save();
                $slot = $jadwal->getMinggu().$jadwal->getHari().$jadwal->getJam();
                $this->daftarDosenJaga[$kodeDosen][]=$slot;
                $this->writeDebug('plot_ruang', "PLOT ruang TUGAS untuk $kodeMk pada ruang $kodeRuang pada slot $slot");
            } catch (Exception $e) {
                $pesanErr =  " gagal melakukan insert jadwal ruang untuk matkul $kodeMk di ruangan $kodeRuang karena ".$e->getMessage()."\n";
                sfContext::getInstance()->getLogger()->err("{heloz}".$pesanErr);
                $this->writeDebug('error', $pesanErr);    
                
            }    
            
            
        }
        
        
        //loop pertama, masukkan dosen pengajar
        foreach ($this->ujianSlots as $slot) {
            
             
            $kodeRuangs=array_keys($this->isiRuangPerSlot[$slot]);
            foreach($kodeRuangs  as $kodeRuang  ) {
                $isRuangTerisiDosen = false;
                if ( $this->isiRuangPerSlot[$slot][$kodeRuang]['isi'] > 0 ) { //terpakai di Ujian, ruang yang ada isinya
                    foreach($this->isiRuangPerSlot[$slot][$kodeRuang]['mk'] as $kodeKelas=>$jmlMhs ) {
                        //untuk tiap mata kuliah di ruang itu
                        $kodes = explode('_' ,$kodeKelas);
                        $kodeMk=$kodes[0];
                        if ( isset( $this->pengajarMk[$kodeMk] ) ) {
                            //untuk tiap pengajar mata kuliah itu
                             
                            
                            foreach($this->pengajarMk[$kodeMk] as $kodeDosen) {
                                if ($kodeDosen == '204037') {
                                    $validTempatDosen = $this->tempatkanDosenDiSlot($slot, $kodeDosen, true, $kodeMk);
                                } else {
                                    $validTempatDosen = $this->tempatkanDosenDiSlot($slot, $kodeDosen, false);
                                }
                                
                                if ( $validTempatDosen  ) {
                                    $isRuangTerisiDosen=true;
                                    $this->isiRuangPerSlot[$slot][$kodeRuang]['dos'] = $kodeDosen;
                                    $this->isiRuangPerSlot[$slot][$kodeRuang]['ket'] = 'P';
                                    
                                    
                                    break; //keluar dari pengecekan tiap pengajar di mata kuliah itu
                                }
                            }
                        }
                        if ($isRuangTerisiDosen) {
                            break; //keluar dari pengecekan tiap mata kuliah di ruang itu
                        }
                        
                    }
                    if (!$isRuangTerisiDosen) {
                        //jika belum ada pengajar mata kuliah yang bisa dimasukkan
                        //do nothing, namun bisa saja dosen random
                        $this->isiRuangPerSlot[$slot][$kodeRuang]['ket'] = 'P';
                        $this->isiRuangPerSlot[$slot][$kodeRuang]['dos'] = false;
                         
                    }
                    
                    
                }
 
                
                
            }
            //break; //TODO TODO TODO cuma buat debug
        }
        
        //loop kedua, masukkan dosen pengajar secara random pada slot dosen yang masih kosong
        
        foreach ($this->ujianSlots as $slot) {
            $kodeRuangs=array_keys($this->isiRuangPerSlot[$slot]);
            foreach( $kodeRuangs as $kodeRuang ) {
                if ( $this->isiRuangPerSlot[$slot][$kodeRuang]['isi'] > 0 ) { //terpakai di ujian
                    if ( ! $this->isiRuangPerSlot[$slot][$kodeRuang]['dos'] ) { //belum ada dosennya
                        
                        $kodeDosen = $this->randomTempatkanDosenDiSlot($slot);
                        if (!$kodeDosen) {
                             self::error('tempatkanPetugasDiRuangan', "Gagal mencari dosen untuk slot $slot di ruang $kodeRuang\n");
                        } else {
                            $this->isiRuangPerSlot[$slot][$kodeRuang]['ket'] = 'R';
                            $this->isiRuangPerSlot[$slot][$kodeRuang]['dos'] = $kodeDosen;
                         }
                    }
                    //if ( ! $this->isiRuangPerSlot[$slot][$kodeRuang]['kar'] ) {
                        $x=0;
                        $kodeKaryawan = $this->randomTempatkanKaryawanDiSlot($slot);    
                        while (($x<100) && ($kodeKaryawan=='197022') && ($this->isiRuangPerSlot[$slot][$kodeRuang]['dos']=='202017')) {
                           $kodeKaryawan = $this->randomTempatkanKaryawanDiSlot($slot);   //to ease my mind, I don't like this pair, it hurts
                           $x++;
                        }
                        if (!$kodeKaryawan) {
                            $this->errorLogs[]=  "Gagal mencari karyawan untuk slot $slot di ruang $kodeRuang";
                            self::error('tempatkanPetugasDiRuangan', "Gagal mencari karyawan untuk slot $slot di ruang $kodeRuang\n");
                            $this->writeDebug('plot_karyawan', "Gagal mencari karyawan untuk slot $slot di ruang $kodeRuang");
                        } else {

                            $this->isiRuangPerSlot[$slot][$kodeRuang]['kar'] = $kodeKaryawan;

                        }
                    //}
                }

            }
            //break; //TODO TODO TODO cuma buat debug

        }        
        
        $filename=dirname(__FILE__).'/../cache/isiRuangPerSlot.yml';
        $data=sfYaml::dump($this->isiRuangPerSlot);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/daftarDosenJaga.yml';
        $data=sfYaml::dump($this->daftarDosenJaga);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/daftarKaryawanJaga.yml';
        $data=sfYaml::dump($this->daftarKaryawanJaga);
        file_put_contents($filename, $data);
        $filename=dirname(__FILE__).'/../cache/errorLogs.yml';
        $data=sfYaml::dump($this->errorLogs);
        file_put_contents($filename, $data);
        
    }
    
    /**
     * fungsi simpanIsiKelasPerSlotKeDB() digunakan untuk menyimpan hasil proses perhitungan ke DB
     * 
     * untuk bisa melakukan ini, lakukan terlebih dahulu fungsi hitungIsiKelasPerSlot() diikuti tempatkanPetugasDiRuangan()
     */
    public function simpanIsiKelasPerSlotKeDB() {
                  
//        $con = Propel::getConnection(JadwalRuangPeer::DATABASE_NAME);
//        $sql = 'TRUNCATE jadwal_ruang_mk';
//        $con->executeUpdate($sql);                    
//        $sql = 'TRUNCATE jadwal_ruang';
//        $con->executeUpdate($sql);
        
                    
        JadwalRuangMkPeer::doDeleteAll();
        JadwalRuangPeer::doDeleteAll();
        $filename=dirname(__FILE__).'/../cache/isiRuangPerSlot.yml';
        $isiRuangPerSlot=sfYaml::load($filename);
        $slots=array_keys($isiRuangPerSlot); 
        foreach( $slots as $slot ) {
            $kodeRuangs = array_keys( $isiRuangPerSlot[$slot] );
            foreach ($kodeRuangs as $kodeRuang) {
                if ($isiRuangPerSlot[$slot][$kodeRuang]['isi'] > 0) {                 
                    $dos = $isiRuangPerSlot[$slot][$kodeRuang]['dos'];
                    $kar = $isiRuangPerSlot[$slot][$kodeRuang]['kar'];
                    $minggu=1; $hari=1; $jam=1;
                    self::kodeSlotKeMinggu($slot, $minggu, $hari, $jam);
                    $jadwal = new JadwalRuang();
                    $jadwal->setMinggu($minggu);
                    $jadwal->setHari($hari);
                    $jadwal->setJam($jam);
                    $jadwal->setKodeDosen($dos);
                    $jadwal->setKodeKaryawan($kar);
                    $jadwal->setKodeRuang($kodeRuang);
                    $jadwal->setSemester($this->kodeSemester);
                    $jadwal->save();
                    $idJadwal = $jadwal->getId();
                    
                    
                    $kodeKelass = array_keys($isiRuangPerSlot[$slot][$kodeRuang]['mk']);
                    foreach($kodeKelass as $kodeKelas) {
                        $kodes=explode('_',$kodeKelas);
                        $kodeMk=$kodes[0];
                        $kp=$kodes[1];
                        $dJadwal = new JadwalRuangMk();
                        $dJadwal->setJadwalRuangId($idJadwal);
                        $dJadwal->setKodeKelas($kodeMk);
                        $dJadwal->setKp($kp);
                        $dJadwal->setKapasitas($isiRuangPerSlot[$slot][$kodeRuang]['mk'][$kodeKelas] );
                        $dJadwal->save();
                        
                    }
                }
            }
        }
        
    }
    
    /**
     * fungsi ini untuk membuat array dari kelas-kelas yang statusnya terbuka, daftar mata kuliah yang diajar oleh tiap dosen
     */
    public function buatDaftarPengajarAktif() {
        $this->daftarKelasDosen = array();
        $c=new Criteria();
        $c->addJoin(DosenKelasPeer::KODE_KELAS, KelasMKPeer::KODE_KELAS);
        $c->addJoin(DosenKelasPeer::KODE_DOSEN, DosenPeer::KODE_DOSEN);
        $c->addJoin(KelasMKPeer::KODE_MK, MataKuliahPeer::KODE_MK); 
        $c->clearSelectColumns()->clearGroupByColumns();
        $c->addSelectColumn(KelasMKPeer::KODE_MK);
        $c->addSelectColumn(DosenKelasPeer::KODE_DOSEN);
        $c->addAscendingOrderByColumn(DosenKelasPeer::KODE_DOSEN);
        $c->addAscendingOrderByColumn(KelasMKPeer::KODE_MK);         
        $c->add(KelasMKPeer::STATUS_BUKA,1);
        $c->setDistinct();
        $rs= DosenKelasPeer::doSelectStmt($c);
        while( $row=$rs->fetch(PDO::FETCH_NUM) ) {
            $kodeMk=trim($row[0]);
            $kodeDosen=trim($row[1]);
            if ( !isset($this->daftarKelasDosen[$kodeDosen]) ) {
                $this->daftarKelasDosen[$kodeDosen] = array();
            }
            $this->daftarKelasDosen[$kodeDosen][]=$kodeMk;
            
        }
        $filename=dirname(__FILE__).'/../cache/daftarKelasDosen.yml';
        $data=sfYaml::dump($this->daftarKelasDosen);
        file_put_contents($filename, $data);        
    }
    
  /**
   * Berdasarkan kode mata kuliah, bisa dicari slot ujian yang sudah ditentukan
   * @param String $kodeMk
   * @return slot atau false jika tidak ketemu
   */  
  public function cariSlotMataKuliah($kodeMk) {
      $slots=array_keys($this->mkUjians);
      foreach($slots as $slot) {
          $matkuls = array_keys($this->mkUjians[$slot]);
          if (in_array($kodeMk, $matkuls) ) {
              return $slot;
          }
      }
      return false;
  }    
 
  
  /**
   * function generateTabelSoalUjian($jenis='UTS') digunakan untuk mengisi tabel soal ujian, diperlukan untuk membuat laporan ke SISKA
   * @param String $jenis, apakah UTS ataukah UAS
   * @return array jadwal ujian yang berisi data soal ujian
   */
  public static function generateTabelSoalUjian($jenis='UTS') {
      $c=new Criteria();
      $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_RUANG);
      $jrs = JadwalRuangPeer::doSelect($c);
      
      $c->clear();
      $c->addAscendingOrderByColumn(JadwalRuangMkPeer::JADWAL_RUANG_ID);
      $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KODE_KELAS);
      $jrms= JadwalRuangMkPeer::doSelect($c);
      
      $c->clear();
      $c->add(KelasMKPeer::STATUS_BUKA,1);
      $c->addJoin(KelasMKPeer::KODE_KELAS, DosenKelasPeer::KODE_KELAS);
      $ds=  DosenKelasPeer::doSelect($c);
      
      $dosens=array();
      foreach($ds as $d) {
          if ( !isset( $dosens[$d->getKodeKelas()] )  ) {
              $dosens[$d->getKodeKelas()] = array();
          }
          $dosens[$d->getKodeKelas()][]=$d->getKodeDosen();
      }
      
      SoalUjianPeer::doDeleteAll();
      
      $jadwals=array();
      foreach ($jrs as $jr) {
          if ( !isset( $jadwals[$jr->getId()] ) ) {
              $jadwals[$jr->getId()] = array(
                  'r'=>$jr->getKodeRuang(),
                  'm'=>$jr->getMinggu(),
                  'h'=>$jr->getHari(),
                  'j'=>$jr->getJam(),                    
                  'd'=>$jr->getKodeDosen(),
                  'k'=>$jr->getKodeKaryawan(),
                  'c'=>array()
              );
          }
      }
      foreach($jrms as $jrm) {
          if ( isset( $jadwals[ $jrm->getJadwalRuangId() ] ) ) {
              $kodeKelas = $jrm->getKodeKelas().$jrm->getKp().'13GA';
                    
              $pengujis = array();
              if ( isset( $dosens[$kodeKelas] ) ) {
                  $pengujis=$dosens[$kodeKelas];
              }
                    
              $jadwals[ $jrm->getJadwalRuangId() ]['c'][$kodeKelas] =
                      array(
                          'm'=>$jrm->toArray( BasePeer::TYPE_FIELDNAME ),
                          'd'=>$pengujis);
              
          }
      }
      return $jadwals;
      
  }
  
  public static function generateReportUjianKeSiska($jenis='UTS', $tglAwal='2013-10-21', $format='BeritaAcara') {
      $result=array();                    
      
      $c=new Criteria();
      $c->addJoin(JadwalRuangMkPeer::JADWAL_RUANG_ID, JadwalRuangPeer::ID);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::MINGGU);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::HARI);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::JAM);
      $c->addAscendingOrderByColumn(JadwalRuangPeer::KODE_RUANG);
      $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KODE_KELAS);
      $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KP);
      $rows=  JadwalRuangMkPeer::doSelectJoinJadwalRuang($c);
      foreach ($rows as $row) {
          $jr = $row->getJadwalRuang();
          $minggu=$jr->getMinggu();
          $hari=$jr->getHari();
          $jam=$jr->getJam();
          $kodeRuang=$jr->getKodeRuang();
          $kodeMk=$row->getKodeKelas();
          $kp=$row->getKp();
          $kodeDosen=$jr->getKodeDosen();
          $kodeKaryawan=$jr->getKodeKaryawan();
          $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
          $kapMhs=$row->getKapasitas();
          $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari); 
          $komponens=explode('-',$tglUjian);
          $tglUjian=$komponens[2].'/'.$komponens[1].'/'.$komponens[0];
          switch ($format) {
              case 'BeritaAcara' :
                  $result[]=array(
                      $kodeMk,$kp,$kodeRuang,$kapMhs,$jenis,$tglUjian,$jam,0,'Esai','-'
                  );
                  break;
              case 'BeritaAcaraPengawas' :
              case 'BeritaAcaraKaryawan' :
                  $result[]=array(
                      $kodeMk,$kp,$kodeRuang,$jenis,$jam,$kodeDosen,'Karyawan'
                  );
                  $result[]=array(
                      $kodeMk,$kp,$kodeRuang,$jenis,$jam,$kodeKaryawan,'Karyawan'
                  );
                  break;
              case 'BeritaAcaraDosen' :
                  $dosens=  MataKuliahPeer::getPengajars($kodeMk);
                  $kodeDosens=array_keys($dosens);
                  foreach($kodeDosens as $kodePengajar) {
                      $result[]=array(
                            $kodeMk,$kp,$kodeRuang,$jenis,$jam,$kodePengajar,'Ya','Ya'
                      );
                  }
                  break;
              case 'JadwalPengawas' :
                  $id=sprintf("%s_%s_%s_%s_%s",$minggu,$hari,$jam,$kodeMk,$kp);
                  $result[$id]=array(
                      'r'=>$kodeRuang,'d'=>$kodeDosen,'k'=>$kodeKaryawan
                  );
                  break;
              
              default:
              
          }          
          
      }
      
      return $result;
  }
  public function getDosenPiket($minggu,$hari) {
      $result=array('kode'=>'','nama'=>'');
              
      
      $kodeDosens=array_keys( $this->dosenPikets);
      foreach ($kodeDosens as $kodeDosen) {
          $kdPikets=array_keys($this->dosenPikets[$kodeDosen]);
          foreach($kdPikets as $kdPiket) {
            $m=$this->dosenPikets[$kodeDosen][$kdPiket]['m'];
            $h=$this->dosenPikets[$kodeDosen][$kdPiket]['h'];
            if (($m==$minggu) && ($h==$hari)) {
                $result['kode']=$kodeDosen;
                $dosen=  DosenPeer::retrieveByPK($kodeDosen);
              
                $result['nama']= ( $dosen ) ? $dosen->getNama() : '';
                return $result;
            }
          }
      }
      return $result;
  }
  
  public function generateReportJadwalUjian() {
        $c=new Criteria();
        $c->add( KelasMKPeer::STATUS_BUKA,1 );
        $c->addJoin(JadwalUjianPeer::KODE_MK, KelasMKPeer::KODE_MK);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::MINGGU);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::HARI);
        $c->addAscendingOrderByColumn(JadwalUjianPeer::JAM);
        $c->setDistinct();
        $kelass = JadwalUjianPeer::doSelectJoinMataKuliah($c);
        $jadwalUjians = array();
        foreach ($kelass as $kelas) {
          $kodeMk = $kelas->getKodeMk();
          $namaMk = $kelas->getMataKuliah()->getNama();
          $minggu=$kelas->getMinggu();
          $hari=$kelas->getHari();
          $jam=$kelas->getJam();
          
          if ( !isset($jadwalUjians[$minggu]) ) {
              $jadwalUjians[$minggu] = array('c'=>0,'d'=>array());
          }
          if ( !isset($jadwalUjians[$minggu]['d'][$hari]) ) {
              $jadwalUjians[$minggu]['d'][$hari] = array('c'=>0,'d'=>array());
          }
          if ( !isset($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]) ) {
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam] = array('c'=>0,'d'=>array());
          }
          if ( !isset($jadwalUjians[$minggu][$hari]['d'][$jam]['d'][$kodeMk]) ) {
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk] = array( 'c'=>0, 'namaMk'=>$namaMk, 'ruangs'=>array() );
          }
          $c->clear();
          $c->add(JadwalRuangPeer::MINGGU,$minggu);
          $c->add(JadwalRuangPeer::HARI,$hari);
          $c->add(JadwalRuangPeer::JAM,$jam);
          $c->addJoin(JadwalRuangMkPeer::JADWAL_RUANG_ID,JadwalRuangPeer::ID);
          $c->add(JadwalRuangMkPeer::KODE_KELAS,$kodeMk);        
          $c->addAscendingOrderByColumn(JadwalRuangMkPeer::KP);
          $ruangs=JadwalRuangMkPeer::doSelectJoinJadwalRuang($c);
          foreach ($ruangs as $ruang) {
              $kodeRuang = $ruang->getJadwalRuang()->getKodeRuang();
              $kodeDosen=$ruang->getJadwalRuang()->getKodeDosen();
              $kodeKaryawan=$ruang->getJadwalRuang()->getKodeKaryawan();
              $kp=$ruang->getKp();
              if ( !isset($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]) ) {
                  $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]=array();
                  $jadwalUjians[$minggu]['c']=$jadwalUjians[$minggu]['c']+1;
                  $jadwalUjians[$minggu]['d'][$hari]['c']=$jadwalUjians[$minggu]['d'][$hari]['c']+1;
                  $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['c']=$jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['c']+1;
                  $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']=$jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']+1;
              }
              $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp][$kodeRuang]= 
                      array(
                          'i'=>$ruang->getKapasitas(),
                          'b'=>$ruang->getNrpAwal(),
                          'e'=>$ruang->getNrpAkhir(),
                          'd'=>$kodeDosen,
                          'k'=>$kodeKaryawan
                      );
          }

        }
        return $jadwalUjians;
  }
  
 /**
   * function isiNrpPerKp untuk mengisi batas nrp awal dan nrp akhir di tiap KP
   * 
   * fungsi ini hanya boleh dijalankan setelah proses penjadwalan selesai, dan sudah disimpan di DB
   * karena fungsi akan memasukkan data mahasiswa ke DB
   * 
   * 
   */
  public function isiNrpPerKp() {
      
      
// $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp][$kodeRuang]= 
//                      array(
//                          'i'=>$ruang->getKapasitas(),
//                          'b'=>$ruang->getNrpAwal(),
//                          'e'=>$ruang->getNrpAkhir(),
//                          'd'=>$kodeDosen,
//                          'k'=>$kodeKaryawan
//                      );      
      
      $jadwalUjians=$this->generateReportJadwalUjian();
      $minggus=array_keys($jadwalUjians);
      foreach($minggus as $minggu) {
          $haris=array_keys($jadwalUjians[$minggu]['d']);
          foreach($haris as $hari) {
              $jams=array_keys($jadwalUjians[$minggu]['d'][$hari]['d']);
              foreach($jams as $jam) {
                  $kodeMks=array_keys($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d']);
                  
                  foreach($kodeMks as $kodeMk) {
                      $kps=array_keys($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs']);
                      $lastKodeKelas=null;
                      foreach($kps as $kp) {
                          $kodeKelas=$kodeMk.'_'.$kp;
                          $this->writeDebug("isiNrpPerKp", "Mulai proses pada kelas $kodeKelas");
                          $kodeRuangs=array_keys($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]);                          
                          foreach($kodeRuangs as $kodeRuang) {
                                $isi=$jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp][$kodeRuang]['i'];
                                $c=new Criteria();
                                $c->add( BaakMahasiswaAmbilMKPeer::KODEMKBUKA, $kodeMk.$this->kodeSemester );
                                $c->add( BaakMahasiswaAmbilMKPeer::KP, $kp);
                                $c->addAscendingOrderByColumn(BaakMahasiswaAmbilMKPeer::NRP);
                                if ($lastKodeKelas==$kodeKelas) {
                                    $offset= ($sudahMasukRuang==0) ? 0 : ($sudahMasukRuang) ;
                                    $sudahMasukRuang+=$isi;
                                } else {
                                  $offset = 0;
                                  $sudahMasukRuang=$isi;                      
                                }
                                $lastKodeKelas=$kodeKelas;
                                $this->writeDebug("isiNrpPerKp", "Proses pada kelas $kodeKelas di $kodeRuang dengan isi $isi offset $offset");
              

                                $c->setOffset($offset);
                                $mhsAwal = BaakMahasiswaAmbilMKPeer::doSelectOne($c);
                                $offset += $isi-1;
                                $c->setOffset($offset);
                                $mhsAkhir = BaakMahasiswaAmbilMKPeer::doSelectOne($c);
                                if ( $mhsAkhir && $mhsAwal ) {
                                    $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp][$kodeRuang]['b']=$mhsAwal->getNRP();
                                    $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp][$kodeRuang]['e']=$mhsAkhir->getNRP();
                                    
                                    $nrpAwal=$mhsAwal->getNRP();
                                    $nrpAkhir=$mhsAkhir->getNRP();
                                    $c->clear();
                                    $c->add( JadwalRuangPeer::MINGGU, $minggu );
                                    $c->add( JadwalRuangPeer::HARI, $hari );
                                    $c->add( JadwalRuangPeer::JAM, $jam );
                                    $c->addJoin( JadwalRuangPeer::ID, JadwalRuangMkPeer::JADWAL_RUANG_ID );
                                    $c->add( JadwalRuangPeer::KODE_RUANG, $kodeRuang );
                                    $c->add( JadwalRuangMkPeer::KODE_KELAS, $kodeMk);
                                    $c->add(JadwalRuangMkPeer::KP,$kp);
                                    $jadwal = JadwalRuangMkPeer::doSelectOne($c);
                                    if ($jadwal) {
                                        $jadwal->setNrpAwal($nrpAwal);
                                        $jadwal->setNrpAkhir($nrpAkhir);
                                        $jadwal->save();
                                    }
                                    
                                    $this->writeDebug("isiNrpPerKp", "Proses pada kelas $kodeKelas di $kodeRuang dengan isi $isi, offset $offset BERHASIL range $nrpAwal - $nrpAkhir");
                                } else {
                                    $this->writeDebug("isiNrpPerKp", "Proses pada kelas $kodeKelas di $kodeRuang dengan isi $isi, offset $offset bermasalah di DB BAAK");

                                }

                              
                              
                          }
                      }
                  }
              }
          }
      }
      
//      $logs=array();
//      $filename=dirname(__FILE__).'/../cache/isiRuangPerSlot.yml';
//      
//      $this->isiRuangPerSlot = sfYaml::load($filename);
//      $slots = array_keys( $this->isiRuangPerSlot );
//      $c=new Criteria();
//      foreach($slots as $slot) {
//          $logs[$slot]="Memulai proses slot";
//          $lastKodeMk = 0;
//          $sudahMasukRuang = 0;
//          $kodeRuangs=array_keys($this->isiRuangPerSlot[$slot]);
//          foreach ($kodeRuangs as $kodeRuang) {
//              $n=count($this->isiRuangPerSlot[$slot][$kodeRuang]);
//              if ($n==0) continue;
//              $logs[$slot.'_'.$kodeRuang] = "Memulai proses di ruangan";
//              $mks=array_keys($this->isiRuangPerSlot[$slot][$kodeRuang]['mk']);
//              foreach($mks as $mk) {
//                  list($kodeMk,$kp) = explode('_', $mk);
//                  $isi=$this->isiRuangPerSlot[$slot][$kodeRuang]['mk'][$mk];
//                  $logs[$slot.'_'.$kodeRuang.'_'.$mk.'_1'] = "Memulai proses di mata kuliah $mk dengan isi $isi ";
//                  $c->clear();
//                  $c->add( BaakMahasiswaAmbilMKPeer::KODEMKBUKA, $kodeMk.$this->kodeSemester );
//                  $c->add( BaakMahasiswaAmbilMKPeer::KP, $kp);
//                  $c->addAscendingOrderByColumn(BaakMahasiswaAmbilMKPeer::NRP);
//                  if ($lastKodeMk==$mk) {
//                    $offset= ($sudahMasukRuang==0) ? 0 : ($sudahMasukRuang) ;
//                    $sudahMasukRuang+=$isi;
//                    
//                  } else {
//                      $offset = 0;
//                      $sudahMasukRuang=$isi;                      
//                  }
//                  $lastKodeMk=$mk;
//                  $logs[$slot.'_'.$kodeRuang.'_'.$mk.'_2'] = "Do proses di mata kuliah $mk dengan isi $isi  dengan offset $offset";
//                  
//                  $c->setOffset($offset);
//                  $mhsAwal = BaakMahasiswaAmbilMKPeer::doSelectOne($c);
//                  $offset += $isi-1;
//                  $c->setOffset($offset);
//                  $mhsAkhir = BaakMahasiswaAmbilMKPeer::doSelectOne($c);
//                  if ( $mhsAkhir && $mhsAwal ) {
//                    $nrpAwal=$mhsAwal->getNRP();
//                    $nrpAkhir=$mhsAkhir->getNRP();
//                    $logs[$slot.'_'.$kodeRuang.'_'.$mk.'_3'] = "Hasil proses di mata kuliah $mk awal=$nrpAwal akhir=$nrpAkhir";
//                    $c->clear();
//                    $c->add( JadwalRuangPeer::MINGGU, substr($slot,0,1) );
//                    $c->add( JadwalRuangPeer::HARI, substr($slot,1,1) );
//                    $c->add( JadwalRuangPeer::JAM, substr($slot,2,1) );
//                    $c->addJoin( JadwalRuangPeer::ID, JadwalRuangMkPeer::JADWAL_RUANG_ID );
//                    $c->add( JadwalRuangPeer::KODE_RUANG, $kodeRuang );
//                    $c->add( JadwalRuangMkPeer::KODE_KELAS, $kodeMk);
//                    $c->add(JadwalRuangMkPeer::KP,$kp);
//                    $jadwal = JadwalRuangMkPeer::doSelectOne($c);
//                    if ($jadwal) {
//                        $jadwal->setNrpAwal($nrpAwal);
//                        $jadwal->setNrpAkhir($nrpAkhir);
//                        $jadwal->save();
//                    }
//                  } else {
//                      $logs[$slot.'_'.$kodeRuang.'_'.$mk.'_3'] = "GAGAL Hasil proses di mata kuliah $mk karena tidak bisa baca DB";
//                  }
//                  
//                  
//                  
//                  
//                  
//              }
//          }
//      }
//      $filename=dirname(__FILE__).'/../cache/isiNrpPerKp.yml';
//      $data=sfYaml::dump($logs);
//      file_put_contents($filename, $data);        
  }  
  
 
}

?>
