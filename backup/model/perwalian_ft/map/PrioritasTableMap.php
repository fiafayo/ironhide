<?php


/**
 * This class defines the structure of the 'tk_prioritas' table.
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
class PrioritasTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.PrioritasTableMap';

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
		$this->setName('tk_prioritas');
		$this->setPhpName('Prioritas');
		$this->setClassname('Prioritas');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('KODE_PRIORITAS', 'KodePrioritas', 'INTEGER', true, null, null);
		$this->addColumn('KODE_FPP', 'KodeFpp', 'VARCHAR', true, 20, null);
		$this->addColumn('NAMA', 'Nama', 'VARCHAR', false, 100, null);
		$this->addColumn('PRIORITAS', 'Prioritas', 'INTEGER', false, null, 10);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // PrioritasTableMap
