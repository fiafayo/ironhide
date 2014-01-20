<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'tk_transkrip' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel on:
 *
 * Tue Oct  1 09:36:23 2013
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class TranskripMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.TranskripMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tk_transkrip');
		$tMap->setPhpName('Transkrip');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('NRP', 'Nrp', 'string' , CreoleTypes::VARCHAR, 'tk_mhs', 'NRP', true, 8);

		$tMap->addForeignPrimaryKey('KODE_MK', 'KodeMk', 'string' , CreoleTypes::VARCHAR, 'tk_master_mk', 'KODE_MK', true, 10);

		$tMap->addPrimaryKey('SEMESTER', 'Semester', 'string', CreoleTypes::VARCHAR, true, 5);

		$tMap->addPrimaryKey('TAHUN', 'Tahun', 'string', CreoleTypes::VARCHAR, true, 9);

		$tMap->addColumn('NILAI', 'Nilai', 'string', CreoleTypes::VARCHAR, false, 3);

		$tMap->addColumn('STATE', 'State', 'int', CreoleTypes::INTEGER, false, null);

	} // doBuild()

} // TranskripMapBuilder
