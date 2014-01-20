<?php


/**
 * This class defines the structure of the 'tk_ruang' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:53 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.perwalian_ft.map
 */
class RuangTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.perwalian_ft.map.RuangTableMap';

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
		$this->setName('tk_ruang');
		$this->setPhpName('Ruang');
		$this->setClassname('Ruang');
		$this->setPackage('lib.model.perwalian_ft');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('KODE_RUANG', 'KodeRuang', 'VARCHAR', true, 10, null);
		$this->addColumn('KAPASITAS', 'Kapasitas', 'INTEGER', true, null, 20);
		$this->addColumn('JENIS', 'Jenis', 'VARCHAR', true, 20, null);
		$this->addColumn('KAPASITAS_UJIAN', 'KapasitasUjian', 'INTEGER', true, null, 20);
		$this->addColumn('PRIORITAS', 'Prioritas', 'INTEGER', true, null, 20);
		$this->addColumn('UNTUK_UJIAN', 'UntukUjian', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('JadwalKuliah', 'JadwalKuliah', RelationMap::ONE_TO_MANY, array('kode_ruang' => 'kode_ruang', ), 'RESTRICT', null);
    $this->addRelation('RuangNonUjian', 'RuangNonUjian', RelationMap::ONE_TO_ONE, array('kode_ruang' => 'kode_ruang', ), 'RESTRICT', null);
    $this->addRelation('JadwalRuang', 'JadwalRuang', RelationMap::ONE_TO_MANY, array('kode_ruang' => 'kode_ruang', ), 'RESTRICT', null);
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

} // RuangTableMap
