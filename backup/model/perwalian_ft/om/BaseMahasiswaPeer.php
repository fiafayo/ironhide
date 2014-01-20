<?php

/**
 * Base static class for performing query and update operations on the 'tk_mhs' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 14:50:17 2010
 *
 * @package    lib.model.perwalian_ft.om
 */
abstract class BaseMahasiswaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tk_mhs';

	/** the related Propel class for this table */
	const OM_CLASS = 'Mahasiswa';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.perwalian_ft.Mahasiswa';

	/** the related TableMap class for this table */
	const TM_CLASS = 'MahasiswaTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 21;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the NRP field */
	const NRP = 'tk_mhs.NRP';

	/** the column name for the SKSMAX field */
	const SKSMAX = 'tk_mhs.SKSMAX';

	/** the column name for the IPS field */
	const IPS = 'tk_mhs.IPS';

	/** the column name for the STATUS field */
	const STATUS = 'tk_mhs.STATUS';

	/** the column name for the JURUSAN field */
	const JURUSAN = 'tk_mhs.JURUSAN';

	/** the column name for the NAMA field */
	const NAMA = 'tk_mhs.NAMA';

	/** the column name for the ALAMAT field */
	const ALAMAT = 'tk_mhs.ALAMAT';

	/** the column name for the TGLLAHIR field */
	const TGLLAHIR = 'tk_mhs.TGLLAHIR';

	/** the column name for the TMPLAHIR field */
	const TMPLAHIR = 'tk_mhs.TMPLAHIR';

	/** the column name for the TOTBSS field */
	const TOTBSS = 'tk_mhs.TOTBSS';

	/** the column name for the IPK field */
	const IPK = 'tk_mhs.IPK';

	/** the column name for the SKSKUM field */
	const SKSKUM = 'tk_mhs.SKSKUM';

	/** the column name for the TELEPON field */
	const TELEPON = 'tk_mhs.TELEPON';

	/** the column name for the PASSWORD field */
	const PASSWORD = 'tk_mhs.PASSWORD';

	/** the column name for the ANGKATAN field */
	const ANGKATAN = 'tk_mhs.ANGKATAN';

	/** the column name for the NAMASMA field */
	const NAMASMA = 'tk_mhs.NAMASMA';

	/** the column name for the NAMAORTU field */
	const NAMAORTU = 'tk_mhs.NAMAORTU';

	/** the column name for the KELAMIN field */
	const KELAMIN = 'tk_mhs.KELAMIN';

	/** the column name for the ASISTEN field */
	const ASISTEN = 'tk_mhs.ASISTEN';

	/** the column name for the KONSULTASI field */
	const KONSULTASI = 'tk_mhs.KONSULTASI';

	/** the column name for the AA field */
	const AA = 'tk_mhs.AA';

	/**
	 * An identiy map to hold any loaded instances of Mahasiswa objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Mahasiswa[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Nrp', 'Sksmax', 'Ips', 'Status', 'Jurusan', 'Nama', 'Alamat', 'Tgllahir', 'Tmplahir', 'Totbss', 'Ipk', 'Skskum', 'Telepon', 'Password', 'Angkatan', 'Namasma', 'Namaortu', 'Kelamin', 'Asisten', 'Konsultasi', 'Aa', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('nrp', 'sksmax', 'ips', 'status', 'jurusan', 'nama', 'alamat', 'tgllahir', 'tmplahir', 'totbss', 'ipk', 'skskum', 'telepon', 'password', 'angkatan', 'namasma', 'namaortu', 'kelamin', 'asisten', 'konsultasi', 'aa', ),
		BasePeer::TYPE_COLNAME => array (self::NRP, self::SKSMAX, self::IPS, self::STATUS, self::JURUSAN, self::NAMA, self::ALAMAT, self::TGLLAHIR, self::TMPLAHIR, self::TOTBSS, self::IPK, self::SKSKUM, self::TELEPON, self::PASSWORD, self::ANGKATAN, self::NAMASMA, self::NAMAORTU, self::KELAMIN, self::ASISTEN, self::KONSULTASI, self::AA, ),
		BasePeer::TYPE_FIELDNAME => array ('nrp', 'sksmax', 'ips', 'status', 'jurusan', 'nama', 'alamat', 'tgllahir', 'tmplahir', 'totbss', 'ipk', 'skskum', 'telepon', 'password', 'angkatan', 'namasma', 'namaortu', 'kelamin', 'asisten', 'konsultasi', 'aa', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Nrp' => 0, 'Sksmax' => 1, 'Ips' => 2, 'Status' => 3, 'Jurusan' => 4, 'Nama' => 5, 'Alamat' => 6, 'Tgllahir' => 7, 'Tmplahir' => 8, 'Totbss' => 9, 'Ipk' => 10, 'Skskum' => 11, 'Telepon' => 12, 'Password' => 13, 'Angkatan' => 14, 'Namasma' => 15, 'Namaortu' => 16, 'Kelamin' => 17, 'Asisten' => 18, 'Konsultasi' => 19, 'Aa' => 20, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('nrp' => 0, 'sksmax' => 1, 'ips' => 2, 'status' => 3, 'jurusan' => 4, 'nama' => 5, 'alamat' => 6, 'tgllahir' => 7, 'tmplahir' => 8, 'totbss' => 9, 'ipk' => 10, 'skskum' => 11, 'telepon' => 12, 'password' => 13, 'angkatan' => 14, 'namasma' => 15, 'namaortu' => 16, 'kelamin' => 17, 'asisten' => 18, 'konsultasi' => 19, 'aa' => 20, ),
		BasePeer::TYPE_COLNAME => array (self::NRP => 0, self::SKSMAX => 1, self::IPS => 2, self::STATUS => 3, self::JURUSAN => 4, self::NAMA => 5, self::ALAMAT => 6, self::TGLLAHIR => 7, self::TMPLAHIR => 8, self::TOTBSS => 9, self::IPK => 10, self::SKSKUM => 11, self::TELEPON => 12, self::PASSWORD => 13, self::ANGKATAN => 14, self::NAMASMA => 15, self::NAMAORTU => 16, self::KELAMIN => 17, self::ASISTEN => 18, self::KONSULTASI => 19, self::AA => 20, ),
		BasePeer::TYPE_FIELDNAME => array ('nrp' => 0, 'sksmax' => 1, 'ips' => 2, 'status' => 3, 'jurusan' => 4, 'nama' => 5, 'alamat' => 6, 'tgllahir' => 7, 'tmplahir' => 8, 'totbss' => 9, 'ipk' => 10, 'skskum' => 11, 'telepon' => 12, 'password' => 13, 'angkatan' => 14, 'namasma' => 15, 'namaortu' => 16, 'kelamin' => 17, 'asisten' => 18, 'konsultasi' => 19, 'aa' => 20, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. MahasiswaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MahasiswaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(MahasiswaPeer::NRP);
		$criteria->addSelectColumn(MahasiswaPeer::SKSMAX);
		$criteria->addSelectColumn(MahasiswaPeer::IPS);
		$criteria->addSelectColumn(MahasiswaPeer::STATUS);
		$criteria->addSelectColumn(MahasiswaPeer::JURUSAN);
		$criteria->addSelectColumn(MahasiswaPeer::NAMA);
		$criteria->addSelectColumn(MahasiswaPeer::ALAMAT);
		$criteria->addSelectColumn(MahasiswaPeer::TGLLAHIR);
		$criteria->addSelectColumn(MahasiswaPeer::TMPLAHIR);
		$criteria->addSelectColumn(MahasiswaPeer::TOTBSS);
		$criteria->addSelectColumn(MahasiswaPeer::IPK);
		$criteria->addSelectColumn(MahasiswaPeer::SKSKUM);
		$criteria->addSelectColumn(MahasiswaPeer::TELEPON);
		$criteria->addSelectColumn(MahasiswaPeer::PASSWORD);
		$criteria->addSelectColumn(MahasiswaPeer::ANGKATAN);
		$criteria->addSelectColumn(MahasiswaPeer::NAMASMA);
		$criteria->addSelectColumn(MahasiswaPeer::NAMAORTU);
		$criteria->addSelectColumn(MahasiswaPeer::KELAMIN);
		$criteria->addSelectColumn(MahasiswaPeer::ASISTEN);
		$criteria->addSelectColumn(MahasiswaPeer::KONSULTASI);
		$criteria->addSelectColumn(MahasiswaPeer::AA);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MahasiswaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MahasiswaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseMahasiswaPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Mahasiswa
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MahasiswaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return MahasiswaPeer::populateObjects(MahasiswaPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			MahasiswaPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Mahasiswa $value A Mahasiswa object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Mahasiswa $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getNrp();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Mahasiswa object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Mahasiswa) {
				$key = (string) $value->getNrp();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Mahasiswa object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Mahasiswa Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to tk_mhs
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = MahasiswaPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = MahasiswaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = MahasiswaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				MahasiswaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseMahasiswaPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseMahasiswaPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new MahasiswaTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? MahasiswaPeer::CLASS_DEFAULT : MahasiswaPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Mahasiswa or Criteria object.
	 *
	 * @param      mixed $values Criteria or Mahasiswa object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseMahasiswaPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseMahasiswaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Mahasiswa object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseMahasiswaPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseMahasiswaPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Mahasiswa or Criteria object.
	 *
	 * @param      mixed $values Criteria or Mahasiswa object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseMahasiswaPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseMahasiswaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(MahasiswaPeer::NRP);
			$selectCriteria->add(MahasiswaPeer::NRP, $criteria->remove(MahasiswaPeer::NRP), $comparison);

		} else { // $values is Mahasiswa object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseMahasiswaPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseMahasiswaPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the tk_mhs table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(MahasiswaPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			MahasiswaPeer::clearInstancePool();
			MahasiswaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Mahasiswa or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Mahasiswa object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			MahasiswaPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Mahasiswa) {
			// invalidate the cache for this single object
			MahasiswaPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MahasiswaPeer::NRP, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				MahasiswaPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			MahasiswaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Mahasiswa object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Mahasiswa $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Mahasiswa $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MahasiswaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MahasiswaPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(MahasiswaPeer::DATABASE_NAME, MahasiswaPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Mahasiswa
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = MahasiswaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(MahasiswaPeer::DATABASE_NAME);
		$criteria->add(MahasiswaPeer::NRP, $pk);

		$v = MahasiswaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(MahasiswaPeer::DATABASE_NAME);
			$criteria->add(MahasiswaPeer::NRP, $pks, Criteria::IN);
			$objs = MahasiswaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array();
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BaseMahasiswaPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseMahasiswaPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseMahasiswaPeer::buildTableMap();

