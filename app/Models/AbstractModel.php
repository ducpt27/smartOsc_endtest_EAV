<?php

namespace Mvc\Models;

abstract class AbstractModel
{
    public $data = [];

    protected static $tableName = '';

    protected static $primaryKey = null;

    protected static $fillable = [];

    private static $instance = null;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
                self::$instance->exec("SET NAMES 'utf8'");
            } catch (\PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        return self::$instance;
    }

    /*
     * @return $this
     */
    public function save()
    {
        $primaryKey = $this->getPrimaryKey();
        $data  = $this->prepareDataBeforeSave();

        if ($this->isNew()) {
            $lastId = static::insert($data);
        } else {
            $condition = $primaryKey .' = '. $data[$primaryKey];
            $lastId = static::update($data, $condition);
        }
        $this->prepareDataAfterSave($lastId);
        return $lastId;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        $primaryKey = static::$primaryKey;
        if (empty($this->getData($primaryKey))) {
            return true;
        }
        if (is_null(static::getById($this->data[$primaryKey]))) {
            return true;
        }
        return false;
    }

    /*
     * @param $key
     * @param $value
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /*
     * @param $key
     * @return string
     */
    public function getData($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }

    /**
     * @return array
     */
    protected function prepareDataBeforeSave()
    {
        $data = [];
        $attributes = static::$fillable;
        foreach ($this->data as $key => $value) {
            if (in_array($key, $attributes)) {
                $data[$key] = $this->data[$key];
            }
        }
        return $data;
    }

    /*
     * @param int $lastId
     */
    protected function prepareDataAfterSave($id)
    {
        $this->data = static::getById($id);
    }

    /*
     * Sort an array to generate a multilevel catalog listing
     * @param array $list
     * @param int $parentId
     * @return array
     */
    public static function _toArrayMultilevel($list, $parentId = 0)
    {
        $sorted = [];
        $primaryKey = static::$primaryKey;
        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $sorted[$key]['item'] = $item;
                unset($list[$key]);
                foreach ($list as $subKey => $subItem) {
                    if ($item[$primaryKey] == $subItem['parent_id']) {
                        $sorted[$key]['subItem'][$subKey]['item'] = $subItem;
                        unset($list[$subKey]);
                        $categoriesChild = static::_toArrayMultilevel($list, $subItem[$primaryKey]);
                        if (count($categoriesChild)) {
                            $sorted[$key]['subItem'][$subKey]['subItem'] = $categoriesChild;
                        }
                    }
                }
            }
        }
        return $sorted;
    }

    /**
     * @return array
     */
    public static function getFillable()
    {
        return static::$fillable;
    }

    /**
     * @param array $fillable
     */
    public static function setFillable($fillable)
    {
        static::$fillable = $fillable;
    }

    /**
     * @return string
     */
    public static function getTableName()
    {
        return static::$tableName;
    }

    /**
     * @param string $tableName
     */
    public static function setTableName($tableName)
    {
        static::$tableName = $tableName;
    }

    /**
     * @return $primaryKey
     */
    public static function getPrimaryKey()
    {
        return static::$primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public static function setPrimaryKey($primaryKey)
    {
        static::$primaryKey = $primaryKey;
    }

    /*
     * @param int $page, $total
     * @param string $orderBy
     * @return array
     */
    public static function all($page = null, $total = null)
    {
        if (is_null($page)) {
            return static::fetch();
        }
        if ($page != null && is_null($total)) {
            $total = 6;
        }
        $index = ($page - 1) * $total;
        $limit = ' LIMIT ' . $index . ',' . $total;
        return static::fetch(null, null, null, $limit);
    }

    /*
     * @param int $id
     * @return array
     */
    public static function getById($id)
    {
        return static::getByAttribute([static::$primaryKey => $id]);
    }

    /*
     * @param array $dataCondition
     * @param int $page, $total
     * @return array
     */
    public static function getByAttribute($dataCondition = null, $page = null, $total = null)
    {
        if ($dataCondition != null) {
            $condition = static::createCondition($dataCondition);
            $whereCondition = $condition['condition'];
            $bindParam = $condition['bindParam'];
            $data = static::fetch(null, $whereCondition, $bindParam);
            if (count($data)) {
                return $data;
            }
        }
        return static::all($page, $total);
    }

    /*
     * @param array $data
     * @return array
     */
    public static function createCondition($data)
    {
        $condition = '';
        $keys = array_keys($data);

        while ($key = current($keys)) {
            if (is_array($data[$key])) {
                $total = count($data[$key]);
                $newData = [];
                for ($i = 0; $i < $total; $i++) {
                    $newKey = ':' . $key . $i;
                    $newData[$newKey] = $data[$key][$i];
                    $condition .= $key . ' = ' . $newKey;
                    if ($i+1 < $total) {
                        $condition .= ' OR ';
                    }
                }
            } else {
                $newKey = ':' . $key;
                $newData[$newKey] = $data[$key];
                $condition .= $key . ' = ' . $newKey;
            }
            unset($data[$key]);
            $data = array_merge($data, $newData);
            if(next($keys)) {
                $condition .= ' AND ';
            };
        }
        return [
            'condition' => $condition,
            'bindParam' => $data
        ];
    }

    public static function createInnerJoin($asTableName = null) {
        return null;
    }

    /*
     * @param string $sql
     * @param string condition
     * @param array $data
     * @param string limit
     * @return array
     */
    protected static function fetch($sql = null, $condition = null, $data = null, $limit = null)
    {
        $list = [];
        $db = self::getInstance();

        if (is_null($sql)) {
            $sql = 'SELECT *, COUNT(*) OVER() as full_count FROM ' . static::$tableName;
        }

        if ($limit != null) {
            $sql .= $limit;
        }

        if ($condition != null) {
            $sql .= ' WHERE '. $condition;
        }
        $req = $db->prepare($sql);
        $req->setFetchMode(\PDO::FETCH_ASSOC);

        if ($data != null) {
            $req->execute($data);
        } else {
            $req->execute();
        }

        foreach ($req->fetchAll() as $item) {
            $list[] = $item;
        }
        return $list;
    }

    protected static function insert($data)
    {
        $db = self::getInstance();
        $values = array_keys($data);

        foreach ($values as $key => $value) {
            $values[$key] = ':'. $value;
        }
        $values = implode(',', $values);
        $keys = implode(',', array_keys($data));

        $sql = 'INSERT INTO '. static::$tableName .'('. $keys .') VALUES ('. $values .' )';
        $req = $db->prepare($sql);
        $req->execute($data);

        $lastId = $db->lastInsertId();
        return $lastId;
    }

    protected static function update($data, $condition)
    {
        $db = self::$instance;
        $tableName = static::$tableName;
        $keys = array_keys($data);
        $set = '';

        while($item = current($keys)) {
            $set .= $item .' = :'. $item;
            if(next($keys)) {
                $set .= ',';
            };
        }

        $sql = 'UPDATE '. $tableName .' SET '. $set .' WHERE '. $condition;
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        return;
    }

    /*
     * @param $condition
     * @param null $tableName
     */
    protected static function delete($primaryKey, $id, $tableName = null)
    {
        $db = self::$instance;
        if (is_null($tableName)) {
            $tableName = static::$tableName;
        }
        $sql = 'DELETE FROM '. $tableName . ' WHERE ' . $primaryKey . ' = :' . $primaryKey;
        $req = $db->prepare($sql);
        $req->execute([':'.$primaryKey => $id]);
        return;
    }
}