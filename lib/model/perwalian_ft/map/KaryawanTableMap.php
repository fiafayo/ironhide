<?php


/**
 * This class defines the structure of the 'karyawan' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:54 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class KaryawanTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.KaryawanTableMap';

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
		$this->setName('karyawan');
		$this->setPhpName('Karyawan');
		$this->setClassname('Karyawan');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('KODE_KARYAWAN', 'KodeKaryawan', 'VARCHAR', true, 8, null);
		$this->addColumn('NAMA', 'Nama', 'VARCHAR', false, 100, null);
		$this->addForeignKey('KODE_JUR', 'KodeJur', 'VARCHAR', 'tk_jurusan', 'KODE_JUR', false, 5, null);
		$this->addColumn('IS_PENGAWAS', 'IsPengawas', 'BOOLEAN', false, null, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Jurusan', 'Jurusan', RelationMap::MANY_TO_ONE, array('kode_jur' => 'kode_jur', ), 'RESTRICT', null);
    $this->addRelation('KaryawanNonJaga', 'KaryawanNonJaga', RelationMap::ONE_TO_ONE, array('kode_karyawan' => 'kode_karyawan', ), 'RESTRICT', null);
    $this->addRelation('JadwalRuang', 'JadwalRuang', RelationMap::ONE_TO_MANY, array('kode_karyawan' => 'kode_karyawan', ), 'RESTRICT', null);
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

} // KaryawanTableMap
