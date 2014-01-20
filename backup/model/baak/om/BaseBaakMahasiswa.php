<?php

/**
 * Base class that represents a row from the 'Mahasiswa' table.
 *
 * Data Mahasiswa di BAAK
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 14:50:13 2010
 *
 * @package    lib.model.baak.om
 */
abstract class BaseBaakMahasiswa extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BaakMahasiswaPeer
	 */
	protected static $peer;

	/**
	 * The value for the nrp field.
	 * @var        string
	 */
	protected $nrp;

	/**
	 * The value for the pin field.
	 * @var        string
	 */
	protected $pin;

	/**
	 * The value for the nama field.
	 * @var        string
	 */
	protected $nama;

	/**
	 * The value for the kodestatus field.
	 * @var        string
	 */
	protected $kodestatus;

	/**
	 * The value for the ipkdengane field.
	 * @var        double
	 */
	protected $ipkdengane;

	/**
	 * The value for the ipktanpae field.
	 * @var        double
	 */
	protected $ipktanpae;

	/**
	 * The value for the ipsakhir field.
	 * @var        double
	 */
	protected $ipsakhir;

	/**
	 * The value for the sksmaxdepan field.
	 * @var        int
	 */
	protected $sksmaxdepan;

	/**
	 * The value for the skskumtanpae field.
	 * @var        int
	 */
	protected $skskumtanpae;

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
	
	const PEER = 'BaakMahasiswaPeer';

	/**
	 * Get the [nrp] column value.
	 * 
	 * @return     string
	 */
	public function getNRP()
	{
		return $this->nrp;
	}

	/**
	 * Get the [pin] column value.
	 * 
	 * @return     string
	 */
	public function getPin()
	{
		return $this->pin;
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
	 * Get the [kodestatus] column value.
	 * 
	 * @return     string
	 */
	public function getKodeStatus()
	{
		return $this->kodestatus;
	}

	/**
	 * Get the [ipkdengane] column value.
	 * 
	 * @return     double
	 */
	public function getIPKDenganE()
	{
		return $this->ipkdengane;
	}

	/**
	 * Get the [ipktanpae] column value.
	 * 
	 * @return     double
	 */
	public function getIPKTanpaE()
	{
		return $this->ipktanpae;
	}

	/**
	 * Get the [ipsakhir] column value.
	 * 
	 * @return     double
	 */
	public function getIPSAkhir()
	{
		return $this->ipsakhir;
	}

	/**
	 * Get the [sksmaxdepan] column value.
	 * 
	 * @return     int
	 */
	public function getSksMaxDepan()
	{
		return $this->sksmaxdepan;
	}

	/**
	 * Get the [skskumtanpae] column value.
	 * 
	 * @return     int
	 */
	public function getSKSKumTanpaE()
	{
		return $this->skskumtanpae;
	}

	/**
	 * Set the value of [nrp] column.
	 * 
	 * @param      string $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setNRP($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nrp !== $v) {
			$this->nrp = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::NRP;
		}

		return $this;
	} // setNRP()

	/**
	 * Set the value of [pin] column.
	 * 
	 * @param      string $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setPin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pin !== $v) {
			$this->pin = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::PIN;
		}

		return $this;
	} // setPin()

	/**
	 * Set the value of [nama] column.
	 * 
	 * @param      string $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setNama($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nama !== $v) {
			$this->nama = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::NAMA;
		}

		return $this;
	} // setNama()

	/**
	 * Set the value of [kodestatus] column.
	 * 
	 * @param      string $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setKodeStatus($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kodestatus !== $v) {
			$this->kodestatus = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::KODESTATUS;
		}

		return $this;
	} // setKodeStatus()

	/**
	 * Set the value of [ipkdengane] column.
	 * 
	 * @param      double $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setIPKDenganE($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->ipkdengane !== $v) {
			$this->ipkdengane = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::IPKDENGANE;
		}

		return $this;
	} // setIPKDenganE()

	/**
	 * Set the value of [ipktanpae] column.
	 * 
	 * @param      double $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setIPKTanpaE($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->ipktanpae !== $v) {
			$this->ipktanpae = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::IPKTANPAE;
		}

		return $this;
	} // setIPKTanpaE()

	/**
	 * Set the value of [ipsakhir] column.
	 * 
	 * @param      double $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setIPSAkhir($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->ipsakhir !== $v) {
			$this->ipsakhir = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::IPSAKHIR;
		}

		return $this;
	} // setIPSAkhir()

	/**
	 * Set the value of [sksmaxdepan] column.
	 * 
	 * @param      int $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setSksMaxDepan($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sksmaxdepan !== $v) {
			$this->sksmaxdepan = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::SKSMAXDEPAN;
		}

		return $this;
	} // setSksMaxDepan()

	/**
	 * Set the value of [skskumtanpae] column.
	 * 
	 * @param      int $v new value
	 * @return     BaakMahasiswa The current object (for fluent API support)
	 */
	public function setSKSKumTanpaE($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->skskumtanpae !== $v) {
			$this->skskumtanpae = $v;
			$this->modifiedColumns[] = BaakMahasiswaPeer::SKSKUMTANPAE;
		}

		return $this;
	} // setSKSKumTanpaE()

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
			$this->pin = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->nama = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->kodestatus = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ipkdengane = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
			$this->ipktanpae = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
			$this->ipsakhir = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
			$this->sksmaxdepan = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->skskumtanpae = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = BaakMahasiswaPeer::NUM_COLUMNS - BaakMahasiswaPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating BaakMahasiswa object", $e);
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
			$con = Propel::getConnection(BaakMahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BaakMahasiswaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

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
			$con = Propel::getConnection(BaakMahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBaakMahasiswa:delete:pre') as $callable)
			{
			  if ($ret = call_user_func($callable, $this, $con))
			  {
			    return;
			  }
			}

			if ($ret) {
				BaakMahasiswaPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseBaakMahasiswa:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
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
			$con = Propel::getConnection(BaakMahasiswaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseBaakMahasiswa:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
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
				foreach (sfMixer::getCallables('BaseBaakMahasiswa:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				$con->commit();
				BaakMahasiswaPeer::addInstanceToPool($this);
				return $affectedRows;
			}
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BaakMahasiswaPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += BaakMahasiswaPeer::doUpdate($this, $con);
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


			if (($retval = BaakMahasiswaPeer::doValidate($this, $columns)) !== true) {
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
		$pos = BaakMahasiswaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNRP();
				break;
			case 1:
				return $this->getPin();
				break;
			case 2:
				return $this->getNama();
				break;
			case 3:
				return $this->getKodeStatus();
				break;
			case 4:
				return $this->getIPKDenganE();
				break;
			case 5:
				return $this->getIPKTanpaE();
				break;
			case 6:
				return $this->getIPSAkhir();
				break;
			case 7:
				return $this->getSksMaxDepan();
				break;
			case 8:
				return $this->getSKSKumTanpaE();
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
		$keys = BaakMahasiswaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNRP(),
			$keys[1] => $this->getPin(),
			$keys[2] => $this->getNama(),
			$keys[3] => $this->getKodeStatus(),
			$keys[4] => $this->getIPKDenganE(),
			$keys[5] => $this->getIPKTanpaE(),
			$keys[6] => $this->getIPSAkhir(),
			$keys[7] => $this->getSksMaxDepan(),
			$keys[8] => $this->getSKSKumTanpaE(),
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
		$pos = BaakMahasiswaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNRP($value);
				break;
			case 1:
				$this->setPin($value);
				break;
			case 2:
				$this->setNama($value);
				break;
			case 3:
				$this->setKodeStatus($value);
				break;
			case 4:
				$this->setIPKDenganE($value);
				break;
			case 5:
				$this->setIPKTanpaE($value);
				break;
			case 6:
				$this->setIPSAkhir($value);
				break;
			case 7:
				$this->setSksMaxDepan($value);
				break;
			case 8:
				$this->setSKSKumTanpaE($value);
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
		$keys = BaakMahasiswaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNRP($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPin($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNama($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setKodeStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIPKDenganE($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIPKTanpaE($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIPSAkhir($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSksMaxDepan($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSKSKumTanpaE($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BaakMahasiswaPeer::DATABASE_NAME);

		if ($this->isColumnModified(BaakMahasiswaPeer::NRP)) $criteria->add(BaakMahasiswaPeer::NRP, $this->nrp);
		if ($this->isColumnModified(BaakMahasiswaPeer::PIN)) $criteria->add(BaakMahasiswaPeer::PIN, $this->pin);
		if ($this->isColumnModified(BaakMahasiswaPeer::NAMA)) $criteria->add(BaakMahasiswaPeer::NAMA, $this->nama);
		if ($this->isColumnModified(BaakMahasiswaPeer::KODESTATUS)) $criteria->add(BaakMahasiswaPeer::KODESTATUS, $this->kodestatus);
		if ($this->isColumnModified(BaakMahasiswaPeer::IPKDENGANE)) $criteria->add(BaakMahasiswaPeer::IPKDENGANE, $this->ipkdengane);
		if ($this->isColumnModified(BaakMahasiswaPeer::IPKTANPAE)) $criteria->add(BaakMahasiswaPeer::IPKTANPAE, $this->ipktanpae);
		if ($this->isColumnModified(BaakMahasiswaPeer::IPSAKHIR)) $criteria->add(BaakMahasiswaPeer::IPSAKHIR, $this->ipsakhir);
		if ($this->isColumnModified(BaakMahasiswaPeer::SKSMAXDEPAN)) $criteria->add(BaakMahasiswaPeer::SKSMAXDEPAN, $this->sksmaxdepan);
		if ($this->isColumnModified(BaakMahasiswaPeer::SKSKUMTANPAE)) $criteria->add(BaakMahasiswaPeer::SKSKUMTANPAE, $this->skskumtanpae);

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
		$criteria = new Criteria(BaakMahasiswaPeer::DATABASE_NAME);

		$criteria->add(BaakMahasiswaPeer::NRP, $this->nrp);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getNRP();
	}

	/**
	 * Generic method to set the primary key (nrp column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setNRP($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of BaakMahasiswa (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNRP($this->nrp);

		$copyObj->setPin($this->pin);

		$copyObj->setNama($this->nama);

		$copyObj->setKodeStatus($this->kodestatus);

		$copyObj->setIPKDenganE($this->ipkdengane);

		$copyObj->setIPKTanpaE($this->ipktanpae);

		$copyObj->setIPSAkhir($this->ipsakhir);

		$copyObj->setSksMaxDepan($this->sksmaxdepan);

		$copyObj->setSKSKumTanpaE($this->skskumtanpae);


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
	 * @return     BaakMahasiswa Clone of current object.
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
	 * @return     BaakMahasiswaPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BaakMahasiswaPeer();
		}
		return self::$peer;
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

	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseBaakMahasiswa:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseBaakMahasiswa::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseBaakMahasiswa
