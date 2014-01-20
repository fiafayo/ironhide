<?php


/**
 * This class defines the structure of the 'tk_master_mk' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 14:50:17 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class MataKuliahTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.MataKuliahTableMap';

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
		$this->setName('tk_master_mk');
		$this->setPhpName('MataKuliah');
		$this->setClassname('MataKuliah');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('KODE_MK', 'KodeMk', 'VARCHAR', true, 10, null);
		$this->addColumn('NAMA', 'Nama', 'VARCHAR', true, 60, null);
		$this->addColumn('SKS', 'Sks', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('JadwalUjian', 'JadwalUjian', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('KelasMK', 'KelasMK', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('MataKuliahJurusan', 'MataKuliahJurusan', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('Transkrip', 'Transkrip', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('TranskripAsli', 'TranskripAsli', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('MinatMataKuliah', 'MinatMataKuliah', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
    $this->addRelation('DosenMataKuliah', 'DosenMataKuliah', RelationMap::ONE_TO_MANY, array('kode_mk' => 'kode_mk', ), 'RESTRICT', null);
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

} // MataKuliahTableMap
