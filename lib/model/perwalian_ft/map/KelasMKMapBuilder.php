<?php

require_once 'propel/map/MapBuilder.php';
include_once 'creole/CreoleTypes.php';


/**
 * This class adds structure of 'tk_kelas_mk' table to 'propel' DatabaseMap object.
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
class KelasMKMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.KelasMKMapBuilder';

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

		$tMap = $this->dbMap->addTable('tk_kelas_mk');
		$tMap->setPhpName('KelasMK');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('KODE_KELAS', 'KodeKelas', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addForeignKey('KODE_MK', 'KodeMk', 'string', CreoleTypes::VARCHAR, 'tk_master_mk', 'KODE_MK', true, 10);

		$tMap->addColumn('KP', 'Kp', 'string', CreoleTypes::VARCHAR, true, 9);

		$tMap->addColumn('ISI', 'Isi', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('KAPASITAS', 'Kapasitas', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SEMESTER', 'Semester', 'string', CreoleTypes::VARCHAR, false, 5);

		$tMap->addColumn('TAHUN', 'Tahun', 'string', CreoleTypes::VARCHAR, false, 9);

		$tMap->addColumn('STATUS_BUKA', 'StatusBuka', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DMB', 'Dmb', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('WAKTU_BUKA', 'WaktuBuka', 'int', CreoleTypes::TIMESTAMP, false, null);

	} // doBuild()

} // KelasMKMapBuilder