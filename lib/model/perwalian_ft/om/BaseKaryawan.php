<?php

/**
 * Base class that represents a row from the 'karyawan' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:54 2013
 *
 * @package    lib.model.perwalian_ft.om
 */
abstract class BaseKaryawan extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        KaryawanPeer
	 */
	protected static $peer;

	/**
	 * The value for the kode_karyawan field.
	 * @var        string
	 */
	protected $kode_karyawan;

	/**
	 * The value for the nama field.
	 * @var        string
	 */
	protected $nama;

	/**
	 * The value for the kode_jur field.
	 * @var        string
	 */
	protected $kode_jur;

	/**
	 * The value for the is_pengawas field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_pengawas;

	/**
	 * @var        Jurusan
	 */
	protected $aJurusan;

	/**
	 * @var        KaryawanNonJaga one-to-one related KaryawanNonJaga object
	 */
	protected $singleKaryawanNonJaga;

	/**
	 * @var        array JadwalRuang[] Collection to store aggregation of JadwalRuang objects.
	 */
	protected $collJadwalRuangs;

	/**
	 * @var        Criteria The criteria used to select the current contents of collJadwalRuangs.
	 */
	private $lastJadwalRuangCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'KaryawanPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_pengawas = true;
	}

	/**
	 * Initializes internal state of BaseKaryawan object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [kode_karyawan] column value.
	 * 
	 * @return     string
	 */
	public function getKodeKaryawan()
	{
		return $this->kode_karyawan;
	}

	/**
	 * Get the [nama] column value.
	 * 
	 * @return     string
	 */
	public function getNama()
	{
		return $this->nama;
	}

	/**
	 * Get the [kode_jur] column value.
	 * 
	 * @return     string
	 */
	public function getKodeJur()
	{
		return $this->kode_jur;
	}

	/**
	 * Get the [is_pengawas] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPengawas()
	{
		return $this->is_pengawas;
	}

	/**
	 * Set the value of [kode_karyawan] column.
	 * 
	 * @param      string $v new value
	 * @return     Karyawan The current object (for fluent API support)
	 */
	public function setKodeKaryawan($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kode_karyawan !== $v) {
			$this->kode_karyawan = $v;
			$this->modifiedColumns[] = KaryawanPeer::KODE_KARYAWAN;
		}

		return $this;
	} // setKodeKaryawan()

	/**
	 * Set the value of [nama] column.
	 * 
	 * @param      string $v new value
	 * @return     Karyawan The current object (for fluent API support)
	 */
	public function setNama($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nama !== $v) {
			$this->nama = $v;
			$this->modifiedColumns[] = KaryawanPeer::NAMA;
		}

		return $this;
	} // setNama()

	/**
	 * Set the value of [kode_jur] column.
	 * 
	 * @param      string $v new value
	 * @return     Karyawan The current object (for fluent API support)
	 */
	public function setKodeJur($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kode_jur !== $v) {
			$this->kode_jur = $v;
			$this->modifiedColumns[] = KaryawanPeer::KODE_JUR;
		}

		if ($this->aJurusan !== null && $this->aJurusan->getKodeJur() !== $v) {
			$this->aJurusan = null;
		}

		return $this;
	} // setKodeJur()

	/**
	 * Set the value of [is_pengawas] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Karyawan The current object (for fluent API support)
	 */
	public function setIsPengawas($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_pengawas !== $v || $this->isNew()) {
			$this->is_pengawas = $v;
			$this->modifiedColumns[] = KaryawanPeer::IS_PENGAWAS;
		}

		return $this;
	} // setIsPengawas()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_pengawas !== true) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->kode_karyawan = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->nama = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->kode_jur = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->is_pengawas = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = KaryawanPeer::NUM_COLUMNS - KaryawanPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Karyawan object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aJurusan !== null && $this->kode_jur !== $this->aJurusan->getKodeJur()) {
			$this->aJurusan = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KaryawanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = KaryawanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aJurusan = null;
			$this->singleKaryawanNonJaga = null;

			$this->collJadwalRuangs = null;
			$this->lastJadwalRuangCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KaryawanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseKaryawan:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				KaryawanPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseKaryawan:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(KaryawanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseKaryawan:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseKaryawan:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				KaryawanPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aJurusan !== null) {
				if ($this->aJurusan->isModified() || $this->aJurusan->isNew()) {
					$affectedRows += $this->aJurusan->save($con);
				}
				$this->setJurusan($this->aJurusan);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = KaryawanPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += KaryawanPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->singleKaryawanNonJaga !== null) {
				if (!$this->singleKaryawanNonJaga->isDeleted()) {
						$affectedRows += $this->singleKaryawanNonJaga->save($con);
				}
			}

			if ($this->collJadwalRuangs !== null) {
				foreach ($this->collJadwalRuangs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aJurusan !== null) {
				if (!$this->aJurusan->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aJurusan->getValidationFailures());
				}
			}


			if (($retval = KaryawanPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singleKaryawanNonJaga !== null) {
					if (!$this->singleKaryawanNonJaga->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleKaryawanNonJaga->getValidationFailures());
					}
				}

				if ($this->collJadwalRuangs !== null) {
					foreach ($this->collJadwalRuangs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KaryawanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getKodeKaryawan();
				break;
			case 1:
				return $this->getNama();
				break;
			case 2:
				return $this->getKodeJur();
				break;
			case 3:
				return $this->getIsPengawas();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = KaryawanPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKodeKaryawan(),
			$keys[1] => $this->getNama(),
			$keys[2] => $this->getKodeJur(),
			$keys[3] => $this->getIsPengawas(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = KaryawanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setKodeKaryawan($value);
				break;
			case 1:
				$this->setNama($value);
				break;
			case 2:
				$this->setKodeJur($value);
				break;
			case 3:
				$this->setIsPengawas($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = KaryawanPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKodeKaryawan($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNama($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setKodeJur($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsPengawas($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);

		if ($this->isColumnModified(KaryawanPeer::KODE_KARYAWAN)) $criteria->add(KaryawanPeer::KODE_KARYAWAN, $this->kode_karyawan);
		if ($this->isColumnModified(KaryawanPeer::NAMA)) $criteria->add(KaryawanPeer::NAMA, $this->nama);
		if ($this->isColumnModified(KaryawanPeer::KODE_JUR)) $criteria->add(KaryawanPeer::KODE_JUR, $this->kode_jur);
		if ($this->isColumnModified(KaryawanPeer::IS_PENGAWAS)) $criteria->add(KaryawanPeer::IS_PENGAWAS, $this->is_pengawas);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);

		$criteria->add(KaryawanPeer::KODE_KARYAWAN, $this->kode_karyawan);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getKodeKaryawan();
	}

	/**
	 * Generic method to set the primary key (kode_karyawan column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setKodeKaryawan($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Karyawan (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setKodeKaryawan($this->kode_karyawan);

		$copyObj->setNama($this->nama);

		$copyObj->setKodeJur($this->kode_jur);

		$copyObj->setIsPengawas($this->is_pengawas);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			$relObj = $this->getKaryawanNonJaga();
			if ($relObj) {
				$copyObj->setKaryawanNonJaga($relObj->copy($deepCopy));
			}

			foreach ($this->getJadwalRuangs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addJadwalRuang($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Karyawan Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     KaryawanPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new KaryawanPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Jurusan object.
	 *
	 * @param      Jurusan $v
	 * @return     Karyawan The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setJurusan(Jurusan $v = null)
	{
		if ($v === null) {
			$this->setKodeJur(NULL);
		} else {
			$this->setKodeJur($v->getKodeJur());
		}

		$this->aJurusan = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Jurusan object, it will not be re-added.
		if ($v !== null) {
			$v->addKaryawan($this);
		}

		return $this;
	}


	/**
	 * Get the associated Jurusan object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Jurusan The associated Jurusan object.
	 * @throws     PropelException
	 */
	public function getJurusan(PropelPDO $con = null)
	{
		if ($this->aJurusan === null && (($this->kode_jur !== "" && $this->kode_jur !== null))) {
			$this->aJurusan = JurusanPeer::retrieveByPk($this->kode_jur);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aJurusan->addKaryawans($this);
			 */
		}
		return $this->aJurusan;
	}

	/**
	 * Gets a single KaryawanNonJaga object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     KaryawanNonJaga
	 * @throws     PropelException
	 */
	public function getKaryawanNonJaga(PropelPDO $con = null)
	{

		if ($this->singleKaryawanNonJaga === null && !$this->isNew()) {
			$this->singleKaryawanNonJaga = KaryawanNonJagaPeer::retrieveByPK($this->kode_karyawan, $con);
		}

		return $this->singleKaryawanNonJaga;
	}

	/**
	 * Sets a single KaryawanNonJaga object as related to this object by a one-to-one relationship.
	 *
	 * @param      KaryawanNonJaga $l KaryawanNonJaga
	 * @return     Karyawan The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setKaryawanNonJaga(KaryawanNonJaga $v)
	{
		$this->singleKaryawanNonJaga = $v;

		// Make sure that that the passed-in KaryawanNonJaga isn't already associated with this object
		if ($v->getKaryawan() === null) {
			$v->setKaryawan($this);
		}

		return $this;
	}

	/**
	 * Clears out the collJadwalRuangs collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addJadwalRuangs()
	 */
	public function clearJadwalRuangs()
	{
		$this->collJadwalRuangs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collJadwalRuangs collection (array).
	 *
	 * By default this just sets the collJadwalRuangs collection to an empty array (like clearcollJadwalRuangs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initJadwalRuangs()
	{
		$this->collJadwalRuangs = array();
	}

	/**
	 * Gets an array of JadwalRuang objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Karyawan has previously been saved, it will retrieve
	 * related JadwalRuangs from storage. If this Karyawan is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array JadwalRuang[]
	 * @throws     PropelException
	 */
	public function getJadwalRuangs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collJadwalRuangs === null) {
			if ($this->isNew()) {
			   $this->collJadwalRuangs = array();
			} else {

				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				JadwalRuangPeer::addSelectColumns($criteria);
				$this->collJadwalRuangs = JadwalRuangPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				JadwalRuangPeer::addSelectColumns($criteria);
				if (!isset($this->lastJadwalRuangCriteria) || !$this->lastJadwalRuangCriteria->equals($criteria)) {
					$this->collJadwalRuangs = JadwalRuangPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastJadwalRuangCriteria = $criteria;
		return $this->collJadwalRuangs;
	}

	/**
	 * Returns the number of related JadwalRuang objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related JadwalRuang objects.
	 * @throws     PropelException
	 */
	public function countJadwalRuangs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collJadwalRuangs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				$count = JadwalRuangPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				if (!isset($this->lastJadwalRuangCriteria) || !$this->lastJadwalRuangCriteria->equals($criteria)) {
					$count = JadwalRuangPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collJadwalRuangs);
				}
			} else {
				$count = count($this->collJadwalRuangs);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a JadwalRuang object to this object
	 * through the JadwalRuang foreign key attribute.
	 *
	 * @param      JadwalRuang $l JadwalRuang
	 * @return     void
	 * @throws     PropelException
	 */
	public function addJadwalRuang(JadwalRuang $l)
	{
		if ($this->collJadwalRuangs === null) {
			$this->initJadwalRuangs();
		}
		if (!in_array($l, $this->collJadwalRuangs, true)) { // only add it if the **same** object is not already associated
			array_push($this->collJadwalRuangs, $l);
			$l->setKaryawan($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Karyawan is new, it will return
	 * an empty collection; or if this Karyawan has previously
	 * been saved, it will retrieve related JadwalRuangs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Karyawan.
	 */
	public function getJadwalRuangsJoinRuang($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collJadwalRuangs === null) {
			if ($this->isNew()) {
				$this->collJadwalRuangs = array();
			} else {

				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				$this->collJadwalRuangs = JadwalRuangPeer::doSelectJoinRuang($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

			if (!isset($this->lastJadwalRuangCriteria) || !$this->lastJadwalRuangCriteria->equals($criteria)) {
				$this->collJadwalRuangs = JadwalRuangPeer::doSelectJoinRuang($criteria, $con, $join_behavior);
			}
		}
		$this->lastJadwalRuangCriteria = $criteria;

		return $this->collJadwalRuangs;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Karyawan is new, it will return
	 * an empty collection; or if this Karyawan has previously
	 * been saved, it will retrieve related JadwalRuangs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Karyawan.
	 */
	public function getJadwalRuangsJoinDosen($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(KaryawanPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collJadwalRuangs === null) {
			if ($this->isNew()) {
				$this->collJadwalRuangs = array();
			} else {

				$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

				$this->collJadwalRuangs = JadwalRuangPeer::doSelectJoinDosen($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(JadwalRuangPeer::KODE_KARYAWAN, $this->kode_karyawan);

			if (!isset($this->lastJadwalRuangCriteria) || !$this->lastJadwalRuangCriteria->equals($criteria)) {
				$this->collJadwalRuangs = JadwalRuangPeer::doSelectJoinDosen($criteria, $con, $join_behavior);
			}
		}
		$this->lastJadwalRuangCriteria = $criteria;

		return $this->collJadwalRuangs;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->singleKaryawanNonJaga) {
				$this->singleKaryawanNonJaga->clearAllReferences($deep);
			}
			if ($this->collJadwalRuangs) {
				foreach ((array) $this->collJadwalRuangs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->singleKaryawanNonJaga = null;
		$this->collJadwalRuangs = null;
			$this->aJurusan = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseKaryawan:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseKaryawan::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseKaryawan
