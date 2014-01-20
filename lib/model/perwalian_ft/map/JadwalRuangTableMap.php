<?php


/**
 * This class defines the structure of the 'jadwal_ruang' table.
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
class JadwalRuangTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.JadwalRuangTableMap';

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
		$this->setName('jadwal_ruang');
		$this->setPhpName('JadwalRuang');
		$this->setClassname('JadwalRuang');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('KODE_RUANG', 'KodeRuang', 'VARCHAR', 'tk_ruang', 'KODE_RUANG', true, 10, null);
		$this->addColumn('HARI', 'Hari', 'INTEGER', false, null, 0);
		$this->addColumn('JAM', 'Jam', 'INTEGER', false, null, 0);
		$this->addColumn('MINGGU', 'Minggu', 'INTEGER', false, null, 0);
		$this->addColumn('SEMESTER', 'Semester', 'VARCHAR', false, 5, null);
		$this->addForeignKey('KODE_KARYAWAN', 'KodeKaryawan', 'VARCHAR', 'karyawan', 'KODE_KARYAWAN', false, 8, null);
		$this->addForeignKey('KODE_DOSEN', 'KodeDosen', 'VARCHAR', 'tk_dosen', 'KODE_DOSEN', false, 8, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Ruang', 'Ruang', RelationMap::MANY_TO_ONE, array('kode_ruang' => 'kode_ruang', ), 'RESTRICT', null);
    $this->addRelation('Karyawan', 'Karyawan', RelationMap::MANY_TO_ONE, array('kode_karyawan' => 'kode_karyawan', ), 'RESTRICT', null);
    $this->addRelation('Dosen', 'Dosen', RelationMap::MANY_TO_ONE, array('kode_dosen' => 'kode_dosen', ), 'RESTRICT', null);
    $this->addRelation('JadwalRuangMk', 'JadwalRuangMk', RelationMap::ONE_TO_MANY, array('id' => 'jadwal_ruang_id', ), 'RESTRICT', null);
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

} // JadwalRuangTableMap
