<?php

/**
 * Base class that represents a row from the 'tk_transkrip_asli' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Oct 17 01:36:54 2013
 *
 * @package    lib.model.perwalian_ft.om
 */
abstract class BaseTranskripAsli extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TranskripAsliPeer
	 */
	protected static $peer;

	/**
	 * The value for the nrp field.
	 * @var        string
	 */
	protected $nrp;

	/**
	 * The value for the kode_mk field.
	 * @var        string
	 */
	protected $kode_mk;

	/**
	 * The value for the semester field.
	 * @var        string
	 */
	protected $semester;

	/**
	 * The value for the tahun field.
	 * @var        string
	 */
	protected $tahun;

	/**
	 * The value for the nilai field.
	 * @var        string
	 */
	protected $nilai;

	/**
	 * @var        Mahasiswa
	 */
	protected $aMahasiswa;

	/**
	 * @var        MataKuliah
	 */
	protected $aMataKuliah;

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
	
	const PEER = 'TranskripAsliPeer';

	/**
	 * Get the [nrp] column value.
	 * 
	 * @return     string
	 */
	public function getNrp()
	{
		return $this->nrp;
	}

	/**
	 * Get the [kode_mk] column value.
	 * 
	 * @return     string
	 */
	public function getKodeMk()
	{
		return $this->kode_mk;
	}

	/**
	 * Get the [semester] column value.
	 * 
	 * @return     string
	 */
	public function getSemester()
	{
		return $this->semester;
	}

	/**
	 * Get the [tahun] column value.
	 * 
	 * @return     string
	 */
	public function getTahun()
	{
		return $this->tahun;
	}

	/**
	 * Get the [nilai] column value.
	 * 
	 * @return     string
	 */
	public function getNilai()
	{
		return $this->nilai;
	}

	/**
	 * Set the value of [nrp] column.
	 * 
	 * @param      string $v new value
	 * @return     TranskripAsli The current object (for fluent API support)
	 */
	public function setNrp($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nrp !== $v) {
			$this->nrp = $v;
			$this->modifiedColumns[] = TranskripAsliPeer::NRP;
		}

		if ($this->aMahasiswa !== null && $this->aMahasiswa->getNrp() !== $v) {
			$this->aMahasiswa = null;
		}

		return $this;
	} // setNrp()

	/**
	 * Set the value of [kode_mk] column.
	 * 
	 * @param      string $v new value
	 * @return     TranskripAsli The current object (for fluent API support)
	 */
	public function setKodeMk($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kode_mk !== $v) {
			$this->kode_mk = $v;
			$this->modifiedColumns[] = TranskripAsliPeer::KODE_MK;
		}

		if ($this->aMataKuliah !== null && $this->aMataKuliah->getKodeMk() !== $v) {
			$this->aMataKuliah = null;
		}

		return $this;
	} // setKodeMk()

	/**
	 * Set the value of [semester] column.
	 * 
	 * @param      string $v new value
	 * @return     TranskripAsli The current object (for fluent API support)
	 */
	public function setSemester($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->semester !== $v) {
			$this->semester = $v;
			$this->modifiedColumns[] = TranskripAsliPeer::SEMESTER;
		}

		return $this;
	} // setSemester()

	/**
	 * Set the value of [tahun] column.
	 * 
	 * @param      string $v new value
	 * @return     TranskripAsli The current object (for fluent API support)
	 */
	public function setTahun($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tahun !== $v) {
			$this->tahun = $v;
			$this->modifiedColumns[] = TranskripAsliPeer::TAHUN;
		}

		return $this;
	} // setTahun()

	/**
	 * Set the value of [nilai] column.
	 * 
	 * @param      string $v new value
	 * @return     TranskripAsli The current object (for fluent API support)
	 */
	public function setNilai($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nilai !== $v) {
			$this->nilai = $v;
			$this->modifiedColumns[] = TranskripAsliPeer::NILAI;
		}

		return $this;
	} // setNilai()

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

			$this->nrp = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->kode_mk = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->semester = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->tahun = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->nilai = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = TranskripAsliPeer::NUM_COLUMNS - TranskripAsliPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating TranskripAsli object", $e);
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

		if ($this->aMahasiswa !== null && $this->nrp !== $this->aMahasiswa->getNrp()) {
			$this->aMahasiswa = null;
		}
		if ($this->aMataKuliah !== null && $this->kode_mk !== $this->aMataKuliah->getKodeMk()) {
			$this->aMataKuliah = null;
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
			$con = Propel::getConnection(TranskripAsliPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TranskripAsliPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aMahasiswa = null;
			$this->aMataKuliah = null;
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
			$con = Propel::getConnection(TranskripAsliPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseTranskripAsli:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				TranskripAsliPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseTranskripAsli:delete:post') as $callable)
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
			$con = Propel::getConnection(TranskripAsliPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseTranskripAsli:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseTranskripAsli:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				TranskripAsliPeer::addInstanceToPool($this);
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

			if ($this->aMahasiswa !== null) {
				if ($this->aMahasiswa->isModified() || $this->aMahasiswa->isNew()) {
					$affectedRows += $this->aMahasiswa->save($con);
				}
				$this->setMahasiswa($this->aMahasiswa);
			}

			if ($this->aMataKuliah !== null) {
				if ($this->aMataKuliah->isModified() || $this->aMataKuliah->isNew()) {
					$affectedRows += $this->aMataKuliah->save($con);
				}
				$this->setMataKuliah($this->aMataKuliah);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TranskripAsliPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += TranskripAsliPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aMahasiswa !== null) {
				if (!$this->aMahasiswa->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMahasiswa->getValidationFailures());
				}
			}

			if ($this->aMataKuliah !== null) {
				if (!$this->aMataKuliah->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMataKuliah->getValidationFailures());
				}
			}


			if (($retval = TranskripAsliPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = TranskripAsliPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNrp();
				break;
			case 1:
				return $this->getKodeMk();
				break;
			case 2:
				return $this->getSemester();
				break;
			case 3:
				return $this->getTahun();
				break;
			case 4:
				return $this->getNilai();
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
		$keys = TranskripAsliPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNrp(),
			$keys[1] => $this->getKodeMk(),
			$keys[2] => $this->getSemester(),
			$keys[3] => $this->getTahun(),
			$keys[4] => $this->getNilai(),
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
		$pos = TranskripAsliPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNrp($value);
				break;
			case 1:
				$this->setKodeMk($value);
				break;
			case 2:
				$this->setSemester($value);
				break;
			case 3:
				$this->setTahun($value);
				break;
			case 4:
				$this->setNilai($value);
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
		$keys = TranskripAsliPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNrp($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKodeMk($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSemester($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTahun($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNilai($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TranskripAsliPeer::DATABASE_NAME);

		if ($this->isColumnModified(TranskripAsliPeer::NRP)) $criteria->add(TranskripAsliPeer::NRP, $this->nrp);
		if ($this->isColumnModified(TranskripAsliPeer::KODE_MK)) $criteria->add(TranskripAsliPeer::KODE_MK, $this->kode_mk);
		if ($this->isColumnModified(TranskripAsliPeer::SEMESTER)) $criteria->add(TranskripAsliPeer::SEMESTER, $this->semester);
		if ($this->isColumnModified(TranskripAsliPeer::TAHUN)) $criteria->add(TranskripAsliPeer::TAHUN, $this->tahun);
		if ($this->isColumnModified(TranskripAsliPeer::NILAI)) $criteria->add(TranskripAsliPeer::NILAI, $this->nilai);

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
		$criteria = new Criteria(TranskripAsliPeer::DATABASE_NAME);

		$criteria->add(TranskripAsliPeer::NRP, $this->nrp);
		$criteria->add(TranskripAsliPeer::KODE_MK, $this->kode_mk);
		$criteria->add(TranskripAsliPeer::SEMESTER, $this->semester);
		$criteria->add(TranskripAsliPeer::TAHUN, $this->tahun);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getNrp();

		$pks[1] = $this->getKodeMk();

		$pks[2] = $this->getSemester();

		$pks[3] = $this->getTahun();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setNrp($keys[0]);

		$this->setKodeMk($keys[1]);

		$this->setSemester($keys[2]);

		$this->setTahun($keys[3]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of TranskripAsli (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNrp($this->nrp);

		$copyObj->setKodeMk($this->kode_mk);

		$copyObj->setSemester($this->semester);

		$copyObj->setTahun($this->tahun);

		$copyObj->setNilai($this->nilai);


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
	 * @return     TranskripAsli Clone of current object.
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
	 * @return     TranskripAsliPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TranskripAsliPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Mahasiswa object.
	 *
	 * @param      Mahasiswa $v
	 * @return     TranskripAsli The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMahasiswa(Mahasiswa $v = null)
	{
		if ($v === null) {
			$this->setNrp(NULL);
		} else {
			$this->setNrp($v->getNrp());
		}

		$this->aMahasiswa = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Mahasiswa object, it will not be re-added.
		if ($v !== null) {
			$v->addTranskripAsli($this);
		}

		return $this;
	}


	/**
	 * Get the associated Mahasiswa object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Mahasiswa The associated Mahasiswa object.
	 * @throws     PropelException
	 */
	public function getMahasiswa(PropelPDO $con = null)
	{
		if ($this->aMahasiswa === null && (($this->nrp !== "" && $this->nrp !== null))) {
			$this->aMahasiswa = MahasiswaPeer::retrieveByPk($this->nrp);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMahasiswa->addTranskripAslis($this);
			 */
		}
		return $this->aMahasiswa;
	}

	/**
	 * Declares an association between this object and a MataKuliah object.
	 *
	 * @param      MataKuliah $v
	 * @return     TranskripAsli The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMataKuliah(MataKuliah $v = null)
	{
		if ($v === null) {
			$this->setKodeMk(NULL);
		} else {
			$this->setKodeMk($v->getKodeMk());
		}

		$this->aMataKuliah = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the MataKuliah object, it will not be re-added.
		if ($v !== null) {
			$v->addTranskripAsli($this);
		}

		return $this;
	}


	/**
	 * Get the associated MataKuliah object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     MataKuliah The associated MataKuliah object.
	 * @throws     PropelException
	 */
	public function getMataKuliah(PropelPDO $con = null)
	{
		if ($this->aMataKuliah === null && (($this->kode_mk !== "" && $this->kode_mk !== null))) {
			$this->aMataKuliah = MataKuliahPeer::retrieveByPk($this->kode_mk);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMataKuliah->addTranskripAslis($this);
			 */
		}
		return $this->aMataKuliah;
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
		} // if ($deep)

			$this->aMahasiswa = null;
			$this->aMataKuliah = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseTranskripAsli:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseTranskripAsli::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseTranskripAsli
