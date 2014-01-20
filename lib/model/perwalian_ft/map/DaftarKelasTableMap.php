<?php


/**
 * This class defines the structure of the 'tk_daftar_kls' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:51 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class DaftarKelasTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.DaftarKelasTableMap';

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
		$this->setName('tk_daftar_kls');
		$this->setPhpName('DaftarKelas');
		$this->setClassname('DaftarKelas');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('KODE_FPP', 'KodeFpp', 'VARCHAR' , 'tk_fpp', 'KODE_FPP', true, 20, null);
		$this->addForeignPrimaryKey('KODE_KELAS', 'KodeKelas', 'VARCHAR' , 'tk_kelas_mk', 'KODE_KELAS', true, 20, null);
		$this->addForeignPrimaryKey('NRP', 'Nrp', 'VARCHAR' , 'tk_mhs', 'NRP', true, 8, null);
		$this->addColumn('STATUS', 'Status', 'VARCHAR', false, 2, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('FPP', 'FPP', RelationMap::MANY_TO_ONE, array('kode_fpp' => 'kode_fpp', ), 'RESTRICT', null);
    $this->addRelation('KelasMK', 'KelasMK', RelationMap::MANY_TO_ONE, array('kode_kelas' => 'kode_kelas', ), 'RESTRICT', null);
    $this->addRelation('Mahasiswa', 'Mahasiswa', RelationMap::MANY_TO_ONE, array('nrp' => 'nrp', ), 'RESTRICT', null);
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

} // DaftarKelasTableMap
