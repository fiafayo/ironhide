<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'tk_dosen' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel on:
 *
 * Tue Oct  1 09:36:22 2013
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class DosenMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.DosenMapBuilder';

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

		$tMap = $this->dbMap->addTable('tk_dosen');
		$tMap->setPhpName('Dosen');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('KODE_DOSEN', 'KodeDosen', 'string', CreoleTypes::VARCHAR, true, 8);

		$tMap->addColumn('NAMA', 'Nama', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addForeignKey('KODE_JUR', 'KodeJur', 'string', CreoleTypes::VARCHAR, 'tk_jurusan', 'KODE_JUR', false, 5);

		$tMap->addColumn('IS_PENGAWAS', 'IsPengawas', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('NPK', 'Npk', 'string', CreoleTypes::VARCHAR, true, 8);

	} // doBuild()

} // DosenMapBuilder
