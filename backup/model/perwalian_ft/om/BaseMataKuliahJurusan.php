<?php

/**
 * Base class that represents a row from the 'tk_mk_jur' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Wed Sep 29 14:50:17 2010
 *
 * @package    lib.model.perwalian_ft.om
 */
abstract class BaseMataKuliahJurusan extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MataKuliahJurusanPeer
	 */
	protected static $peer;

	/**
	 * The value for the kode_mk field.
	 * @var        string
	 */
	protected $kode_mk;

	/**
	 * The value for the kode_jur field.
	 * @var        string
	 */
	protected $kode_jur;

	/**
	 * The value for the jenis field.
	 * Note: this column has a database default value of: '0'
	 * @var        string
	 */
	protected $jenis;

	/**
	 * The value for the status_bebas field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $status_bebas;

	/**
	 * The value for the semester field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $semester;

	/**
	 * The value for the sks_min field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $sks_min;

	/**
	 * The value for the kurikulum field.
	 * @var        string
	 */
	protected $kurikulum;

	/**
	 * @var        MataKuliah
	 */
	protected $aMataKuliah;

	/**
	 * @var        Jurusan
	 */
	protected $aJurusan;

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
	
	const PEER = 'MataKuliahJurusanPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->jenis = '0';
		$this->status_bebas = false;
		$this->semester = 0;
		$this->sks_min = 0;
	}

	/**
	 * Initializes internal state of BaseMataKuliahJurusan object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
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
	 * Get the [kode_jur] column value.
	 * 
	 * @return     string
	 */
	public function getKodeJur()
	{
		return $this->kode_jur;
	}

	/**
	 * Get the [jenis] column value.
	 * 
	 * @return     string
	 */
	public function getJenis()
	{
		return $this->jenis;
	}

	/**
	 * Get the [status_bebas] column value.
	 * 
	 * @return     boolean
	 */
	public function getStatusBebas()
	{
		return $this->status_bebas;
	}

	/**
	 * Get the [semester] column value.
	 * 
	 * @return     int
	 */
	public function getSemester()
	{
		return $this->semester;
	}

	/**
	 * Get the [sks_min] column value.
	 * 
	 * @return     int
	 */
	public function getSksMin()
	{
		return $this->sks_min;
	}

	/**
	 * Get the [kurikulum] column value.
	 * 
	 * @return     string
	 */
	public function getKurikulum()
	{
		return $this->kurikulum;
	}

	/**
	 * Set the value of [kode_mk] column.
	 * 
	 * @param      string $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setKodeMk($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kode_mk !== $v) {
			$this->kode_mk = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::KODE_MK;
		}

		if ($this->aMataKuliah !== null && $this->aMataKuliah->getKodeMk() !== $v) {
			$this->aMataKuliah = null;
		}

		return $this;
	} // setKodeMk()

	/**
	 * Set the value of [kode_jur] column.
	 * 
	 * @param      string $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setKodeJur($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kode_jur !== $v) {
			$this->kode_jur = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::KODE_JUR;
		}

		if ($this->aJurusan !== null && $this->aJurusan->getKodeJur() !== $v) {
			$this->aJurusan = null;
		}

		return $this;
	} // setKodeJur()

	/**
	 * Set the value of [jenis] column.
	 * 
	 * @param      string $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setJenis($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->jenis !== $v || $this->isNew()) {
			$this->jenis = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::JENIS;
		}

		return $this;
	} // setJenis()

	/**
	 * Set the value of [status_bebas] column.
	 * 
	 * @param      boolean $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setStatusBebas($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->status_bebas !== $v || $this->isNew()) {
			$this->status_bebas = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::STATUS_BEBAS;
		}

		return $this;
	} // setStatusBebas()

	/**
	 * Set the value of [semester] column.
	 * 
	 * @param      int $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setSemester($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->semester !== $v || $this->isNew()) {
			$this->semester = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::SEMESTER;
		}

		return $this;
	} // setSemester()

	/**
	 * Set the value of [sks_min] column.
	 * 
	 * @param      int $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setSksMin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sks_min !== $v || $this->isNew()) {
			$this->sks_min = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::SKS_MIN;
		}

		return $this;
	} // setSksMin()

	/**
	 * Set the value of [kurikulum] column.
	 * 
	 * @param      string $v new value
	 * @return     MataKuliahJurusan The current object (for fluent API support)
	 */
	public function setKurikulum($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->kurikulum !== $v) {
			$this->kurikulum = $v;
			$this->modifiedColumns[] = MataKuliahJurusanPeer::KURIKULUM;
		}

		return $this;
	} // setKurikulum()

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
			if ($this->jenis !== '0') {
				return false;
			}

			if ($this->status_bebas !== false) {
				return false;
			}

			if ($this->semester !== 0) {
				return false;
			}

			if ($this->sks_min !== 0) {
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

			$this->kode_mk = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->kode_jur = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->jenis = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->status_bebas = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->semester = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->sks_min = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->kurikulum = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = MataKuliahJurusanPeer::NUM_COLUMNS - MataKuliahJurusanPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating MataKuliahJurusan object", $e);
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

		if ($this->aMataKuliah !== null && $this->kode_mk !== $this->aMataKuliah->getKodeMk()) {
			$this->aMataKuliah = null;
		}
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
			$con = Propel::getConnection(MataKuliahJurusanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MataKuliahJurusanPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aMataKuliah = null;
			$this->aJurusan = null;
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
			$con = Propel::getConnection(MataKuliahJurusanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseMataKuliahJurusan:delete:pre') as $callable)
			{
			  if ($ret = call_user_func($callable, $this, $con))
			  {
			    return;
			  }
			}

			if ($ret) {
				MataKuliahJurusanPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseMataKuliahJurusan:delete:post') as $callable)
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
			$con = Propel::getConnection(MataKuliahJurusanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseMataKuliahJurusan:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseMataKuliahJurusan:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				$con->commit();
				MataKuliahJurusanPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aMataKuliah !== null) {
				if ($this->aMataKuliah->isModified() || $this->aMataKuliah->isNew()) {
					$affectedRows += $this->aMataKuliah->save($con);
				}
				$this->setMataKuliah($this->aMataKuliah);
			}

			if ($this->aJurusan !== null) {
				if ($this->aJurusan->isModified() || $this->aJurusan->isNew()) {
					$affectedRows += $this->aJurusan->save($con);
				}
				$this->setJurusan($this->aJurusan);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MataKuliahJurusanPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += MataKuliahJurusanPeer::doUpdate($this, $con);
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

			if ($this->aMataKuliah !== null) {
				if (!$this->aMataKuliah->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMataKuliah->getValidationFailures());
				}
			}

			if ($this->aJurusan !== null) {
				if (!$this->aJurusan->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aJurusan->getValidationFailures());
				}
			}


			if (($retval = MataKuliahJurusanPeer::doValidate($this, $columns)) !== true) {
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
		$pos = MataKuliahJurusanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getKodeMk();
				break;
			case 1:
				return $this->getKodeJur();
				break;
			case 2:
				return $this->getJenis();
				break;
			case 3:
				return $this->getStatusBebas();
				break;
			case 4:
				return $this->getSemester();
				break;
			case 5:
				return $this->getSksMin();
				break;
			case 6:
				return $this->getKurikulum();
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
		$keys = MataKuliahJurusanPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getKodeMk(),
			$keys[1] => $this->getKodeJur(),
			$keys[2] => $this->getJenis(),
			$keys[3] => $this->getStatusBebas(),
			$keys[4] => $this->getSemester(),
			$keys[5] => $this->getSksMin(),
			$keys[6] => $this->getKurikulum(),
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
		$pos = MataKuliahJurusanPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setKodeMk($value);
				break;
			case 1:
				$this->setKodeJur($value);
				break;
			case 2:
				$this->setJenis($value);
				break;
			case 3:
				$this->setStatusBebas($value);
				break;
			case 4:
				$this->setSemester($value);
				break;
			case 5:
				$this->setSksMin($value);
				break;
			case 6:
				$this->setKurikulum($value);
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
		$keys = MataKuliahJurusanPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setKodeMk($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setKodeJur($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setJenis($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatusBebas($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSemester($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSksMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setKurikulum($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MataKuliahJurusanPeer::DATABASE_NAME);

		if ($this->isColumnModified(MataKuliahJurusanPeer::KODE_MK)) $criteria->add(MataKuliahJurusanPeer::KODE_MK, $this->kode_mk);
		if ($this->isColumnModified(MataKuliahJurusanPeer::KODE_JUR)) $criteria->add(MataKuliahJurusanPeer::KODE_JUR, $this->kode_jur);
		if ($this->isColumnModified(MataKuliahJurusanPeer::JENIS)) $criteria->add(MataKuliahJurusanPeer::JENIS, $this->jenis);
		if ($this->isColumnModified(MataKuliahJurusanPeer::STATUS_BEBAS)) $criteria->add(MataKuliahJurusanPeer::STATUS_BEBAS, $this->status_bebas);
		if ($this->isColumnModified(MataKuliahJurusanPeer::SEMESTER)) $criteria->add(MataKuliahJurusanPeer::SEMESTER, $this->semester);
		if ($this->isColumnModified(MataKuliahJurusanPeer::SKS_MIN)) $criteria->add(MataKuliahJurusanPeer::SKS_MIN, $this->sks_min);
		if ($this->isColumnModified(MataKuliahJurusanPeer::KURIKULUM)) $criteria->add(MataKuliahJurusanPeer::KURIKULUM, $this->kurikulum);

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
		$criteria = new Criteria(MataKuliahJurusanPeer::DATABASE_NAME);

		$criteria->add(MataKuliahJurusanPeer::KODE_MK, $this->kode_mk);
		$criteria->add(MataKuliahJurusanPeer::KODE_JUR, $this->kode_jur);

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

		$pks[0] = $this->getKodeMk();

		$pks[1] = $this->getKodeJur();

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

		$this->setKodeMk($keys[0]);

		$this->setKodeJur($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of MataKuliahJurusan (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setKodeMk($this->kode_mk);

		$copyObj->setKodeJur($this->kode_jur);

		$copyObj->setJenis($this->jenis);

		$copyObj->setStatusBebas($this->status_bebas);

		$copyObj->setSemester($this->semester);

		$copyObj->setSksMin($this->sks_min);

		$copyObj->setKurikulum($this->kurikulum);


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
	 * @return     MataKuliahJurusan Clone of current object.
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
	 * @return     MataKuliahJurusanPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MataKuliahJurusanPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a MataKuliah object.
	 *
	 * @param      MataKuliah $v
	 * @return     MataKuliahJurusan The current object (for fluent API support)
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
			$v->addMataKuliahJurusan($this);
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
			   $this->aMataKuliah->addMataKuliahJurusans($this);
			 */
		}
		return $this->aMataKuliah;
	}

	/**
	 * Declares an association between this object and a Jurusan object.
	 *
	 * @param      Jurusan $v
	 * @return     MataKuliahJurusan The current object (for fluent API support)
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
			$v->addMataKuliahJurusan($this);
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
			   $this->aJurusan->addMataKuliahJurusans($this);
			 */
		}
		return $this->aJurusan;
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

			$this->aMataKuliah = null;
			$this->aJurusan = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseMataKuliahJurusan:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseMataKuliahJurusan::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseMataKuliahJurusan
