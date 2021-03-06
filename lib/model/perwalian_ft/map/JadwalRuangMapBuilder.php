<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'jadwal_ruang' table to 'propel' DatabaseMap object.
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
class JadwalRuangMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.JadwalRuangMapBuilder';

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

		$tMap = $this->dbMap->addTable('jadwal_ruang');
		$tMap->setPhpName('JadwalRuang');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('KODE_RUANG', 'KodeRuang', 'string', CreoleTypes::VARCHAR, 'tk_ruang', 'KODE_RUANG', true, 10);

		$tMap->addColumn('HARI', 'Hari', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('JAM', 'Jam', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('MINGGU', 'Minggu', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SEMESTER', 'Semester', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addForeignKey('KODE_KARYAWAN', 'KodeKaryawan', 'string', CreoleTypes::VARCHAR, 'karyawan', 'KODE_KARYAWAN', false, 8);

		$tMap->addForeignKey('KODE_DOSEN', 'KodeDosen', 'string', CreoleTypes::VARCHAR, 'tk_dosen', 'KODE_DOSEN', false, 8);

	} // doBuild()

} // JadwalRuangMapBuilder
