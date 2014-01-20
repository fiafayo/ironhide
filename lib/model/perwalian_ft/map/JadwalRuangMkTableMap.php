<?php


/**
 * This class defines the structure of the 'jadwal_ruang_mk' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:55 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class JadwalRuangMkTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.JadwalRuangMkTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('jadwal_ruang_mk');
		$this->setPhpName('JadwalRuangMk');
		$this->setClassname('JadwalRuangMk');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('JADWAL_RUANG_ID', 'JadwalRuangId', 'INTEGER', 'jadwal_ruang', 'ID', true, null, null);
		$this->addForeignKey('KODE_KELAS', 'KodeKelas', 'VARCHAR', 'tk_kelas_mk', 'KODE_KELAS', true, 20, null);
		$this->addColumn('KAPASITAS', 'Kapasitas', 'INTEGER', false, null, 20);
		$this->addColumn('KP', 'Kp', 'VARCHAR', false, 2, '-');
		$this->addColumn('NRP_AWAL', 'NrpAwal', 'VARCHAR', false, 8, null);
		$this->addColumn('NRP_AKHIR', 'NrpAkhir', 'VARCHAR', false, 8, null);
		$this->addColumn('UTS_MAHASISWA_TERDAFTAR', 'UtsMahasiswaTerdaftar', 'INTEGER', false, null, 0);
		$this->addColumn('UTS_MAHASISWA_HADIR', 'UtsMahasiswaHadir', 'INTEGER', false, null, 0);
		$this->addColumn('UTS_TANGGAL', 'UtsTanggal', 'DATE', false, null, null);
		$this->addColumn('UTS_JAM_KE', 'UtsJamKe', 'INTEGER', false, null, 1);
		$this->addColumn('UTS_JUMLAH_MENIT', 'UtsJumlahMenit', 'INTEGER', false, null, 120);
		$this->addColumn('UTS_JENIS_SOAL', 'UtsJenisSoal', 'VARCHAR', false, 8, 'Esai');
		$this->addColumn('UTS_KEJADIAN_PENTING', 'UtsKejadianPenting', 'VARCHAR', false, 255, null);
		$this->addColumn('UTS_DOSEN_JAGA', 'UtsDosenJaga', 'VARCHAR', false, 8, null);
		$this->addColumn('UTS_KARYAWAN_JAGA', 'UtsKaryawanJaga', 'VARCHAR', false, 8, null);
		$this->addColumn('UAS_MAHASISWA_TERDAFTAR', 'UasMahasiswaTerdaftar', 'INTEGER', false, null, 0);
		$this->addColumn('UAS_MAHASISWA_HADIR', 'UasMahasiswaHadir', 'INTEGER', false, null, 0);
		$this->addColumn('UAS_TANGGAL', 'UasTanggal', 'DATE', false, null, null);
		$this->addColumn('UAS_JAM_KE', 'UasJamKe', 'INTEGER', false, null, 1);
		$this->addColumn('UAS_JUMLAH_MENIT', 'UasJumlahMenit', 'INTEGER', false, null, 120);
		$this->addColumn('UAS_JENIS_SOAL', 'UasJenisSoal', 'VARCHAR', false, 8, 'Esai');
		$this->addColumn('UAS_KEJADIAN_PENTING', 'UasKejadianPenting', 'VARCHAR', false, 255, null);
		$this->addColumn('UAS_DOSEN_JAGA', 'UasDosenJaga', 'VARCHAR', false, 8, null);
		$this->addColumn('UAS_KARYAWAN_JAGA', 'UasKaryawanJaga', 'VARCHAR', false, 8, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('JadwalRuang', 'JadwalRuang', RelationMap::MANY_TO_ONE, array('jadwal_ruang_id' => 'id', ), 'RESTRICT', null);
    $this->addRelation('KelasMK', 'KelasMK', RelationMap::MANY_TO_ONE, array('kode_kelas' => 'kode_kelas', ), 'RESTRICT', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // JadwalRuangMkTableMap