<?php


/**
 * This class defines the structure of the 'tk_jadwal_ujian' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 14:50:16 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class JadwalUjianTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.JadwalUjianTableMap';

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
		$this->setName('tk_jadwal_ujian');
		$this->setPhpName('JadwalUjian');
		$this->setClassname('JadwalUjian');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('KODE_UJIAN', 'KodeUjian', 'VARCHAR', true, 20, null);
		$this->addForeignKey('KODE_MK', 'KodeMk', 'VARCHAR', 'tk_master_mk', 'KODE_MK', true, 10, null);
		$this->addColumn('HARI', 'Hari', 'INTEGER', true, null, 0);
		$this->addColumn('JAM', 'Jam', 'INTEGER', true, null, 0);
		$this->addColumn('MINGGU', 'Minggu', 'INTEGER', true, null, 0);
		$this->addColumn('SEMESTER', 'Semester', 'VARCHAR', true, 5, null);
		$this->addColumn('TAHUN', 'Tahun', 'VARCHAR', true, 9, null);
		$this->addColumn('JENIS_RUANG', 'JenisRuang', 'VARCHAR', true, 6, 'KELAS');
		$this->addColumn('JUMLAH_MHS', 'JumlahMhs', 'INTEGER', true, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('MataKuliah', 'MataKuliah', RelationMap::MANY_TO_ONE, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('RuangBlock', 'RuangBlock', RelationMap::ONE_TO_MANY, array('kode_ujian' => 'kode_ujian', ), 'RESTRICT', null);
    $this->addRelation('DosenBlock', 'DosenBlock', RelationMap::ONE_TO_MANY, array('kode_ujian' => 'kode_ujian', ), 'RESTRICT', null);
    $this->addRelation('KaryawanBlock', 'KaryawanBlock', RelationMap::ONE_TO_MANY, array('kode_ujian' => 'kode_ujian', ), 'RESTRICT', null);
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

} // JadwalUjianTableMap
