<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'tk_fpp' table to 'propel' DatabaseMap object.
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
class FPPMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.FPPMapBuilder';

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

		$tMap = $this->dbMap->addTable('tk_fpp');
		$tMap->setPhpName('FPP');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('KODE_FPP', 'KodeFpp', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('JENIS', 'Jenis', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('SEMESTER', 'Semester', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('TAHUN', 'Tahun', 'string', CreoleTypes::VARCHAR, false, 9);

		$tMap->addColumn('WAKTU_BUKA', 'WaktuBuka', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('WAKTU_TUTUP', 'WaktuTutup', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('STATUS_AKTIF', 'StatusAktif', 'string', CreoleTypes::VARCHAR, false, 2);

	} // doBuild()

} // FPPMapBuilder
