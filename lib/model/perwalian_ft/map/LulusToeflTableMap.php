<?php


/**
 * This class defines the structure of the 'lulus_toefl' table.
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
class LulusToeflTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.LulusToeflTableMap';

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
		$this->setName('lulus_toefl');
		$this->setPhpName('LulusToefl');
		$this->setClassname('LulusToefl');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('NRP', 'Nrp', 'VARCHAR' , 'tk_mhs', 'NRP', true, 8, null);
		$this->addColumn('LULUS', 'Lulus', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // LulusToeflTableMap
