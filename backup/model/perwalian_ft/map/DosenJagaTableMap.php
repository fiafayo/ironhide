<?php


/**
 * This class defines the structure of the 'dosen_jaga' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sat Jul 17 19:56:44 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class DosenJagaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.DosenJagaTableMap';

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
		$this->setName('dosen_jaga');
		$this->setPhpName('DosenJaga');
		$this->setClassname('DosenJaga');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('KODE_DOSEN', 'KodeDosen', 'VARCHAR' , 'tk_dosen', 'KODE_DOSEN', true, 8, null);
		$this->addForeignPrimaryKey('KODE_UJIAN', 'KodeUjian', 'VARCHAR' , 'tk_jadwal_ujian', 'KODE_UJIAN', true, 20, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Dosen', 'Dosen', RelationMap::MANY_TO_ONE, array('kode_dosen' => 'kode_dosen', ), 'RESTRICT', null);
    $this->addRelation('JadwalUjian', 'JadwalUjian', RelationMap::MANY_TO_ONE, array('kode_ujian' => 'kode_ujian', ), 'RESTRICT', null);
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

} // DosenJagaTableMap