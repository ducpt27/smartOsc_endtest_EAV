<?php

namespace Mvc\Models\Eav;

use Mvc\Models\AbstractModel;

abstract class AbstractEntity extends AbstractModel
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    /*
     * Get values​for all attributes for entity with id
     * @return array
     */
    public static function getValueById($id)
    {
        $condition = "e." . static::$primaryKey . " = " . $id;
        return static::getValue($condition);
    }

    /*
     * Get values for all attributes
     * @param string $condition
     * @return array
     */
    public static function getValue($condition = null)
    {
        $data = [];
        $sql = '';

        $tableValueType = ['varchar', 'int', 'datetime', 'decimal', 'text'];
        while ($item = current($tableValueType)) {
            $valueModel = FactoryValue::createValueModel(static::class, $item);
            if (is_null($valueModel)) {
                next($tableValueType);
            }

            $sql .= "SELECT a.attribute_code, v.value
                FROM " . static::$tableName . " as e";
            $sql .= $valueModel::createInnerJoin('v');
            $sql .= Attribute::createInnerJoin('a');
            $sql .= " WHERE " . $condition;

            if (next($tableValueType)) {
                $sql .= " UNION ";
            }
        }

        $arr = parent::fetch($sql);
        if (is_null($arr)) {
            return null;
        }

        foreach ($arr as $item) {
            $data[$item['attribute_code']][] = $item['value'];
        }
        return $data;
    }

    /*
     * @Override
     */
    public static function getByAttribute($dataCondition = null, $page = null, $total = null)
    {
        if (is_null($page)) {
            $page = 1;
        }
        if (is_null($total)) {
            $total = 6;
        }

        if ($dataCondition == null) {
            return parent::getByAttribute($dataCondition, $page, $total);
        }

        $index = ($page - 1) * $total;
        $limit = ' LIMIT ' . $index . ',' . $total;

        $primaryKey = static::$primaryKey;
        $sql = 'SELECT e.' . $primaryKey . ', COUNT(e.' . $primaryKey . ') OVER() as full_count FROM ' . static::$tableName . ' as e';
        $bindParam = [];

        foreach ($dataCondition as $key => $item) {
            $primaryKey_attribute = Attribute::getPrimaryKey();
            if (!isset($item[$primaryKey_attribute])) {
                continue;
            }

            $attribute = Attribute::getById($item[$primaryKey_attribute])[0];
            $valueModel = FactoryValue::createValueModel(static::class, $attribute['backend_type']);
            if (is_null($valueModel)) {
                continue;
            }

            foreach ($item['value'] as $subKey => $value) {
                $asTable = 'v' . $key . $subKey;
                $keyBind = ':' . $asTable;
                $bindParam[$keyBind] = $value;
                $sql .= $valueModel::createInnerJoin($asTable, $keyBind, $item[Attribute::getPrimaryKey()]);
            }
        }
        $data = static::fetch($sql, null, $bindParam, $limit);
        if (count($data)) {
            return $data;
        }
        return null;
    }

    /*
     * @Override
     * Get all entities with all attributes
     * @param string $sql
     * @param string $condition
     * @param array $bindParam
     * @return array
     */
    protected static function fetch($sql = null, $condition = null, $bindParam = null, $limit = null)
    {
        $list = parent::fetch($sql, $condition, $bindParam, $limit);
        foreach ($list as $key => $value) {
            $data = static::getValueById($value[static::$primaryKey]);
            $list[$key] = array_merge($list[$key], $data);
        }
        return $list;
    }

    protected function prepareDataAfterSave($id)
    {
        $data = $this->data;
        if (count($data) && $id != 0) {
            $this->addValue($id, $data);
        }
        parent::prepareDataAfterSave($id);
    }

    public function addValue($id, $data) {
        $primaryKey = static::$primaryKey;
        $attributes = ['attribute_code' => array_keys($data)];
        $list = Attribute::getByAttribute($attributes);
        if (is_null($list)) {
            return;
        }

        foreach ($list as $item) {
            $valueModel = FactoryValue::createValueModel(static::class, $item['backend_type']);
            if (is_null($valueModel)) {
                continue;
            }

            $values = $data[$item['attribute_code']];
            if (is_array($values) && count($values)) {
                foreach ($values as $value) {
                    $bindData['value'] = $value;
                    $bindData['attribute_id'] = $item['attribute_id'];
                    $bindData[$primaryKey] = $id;
                    $valueModel::insert($bindData);
                }
            } else if (is_string($values) && $values != "") {
                $bindData['value'] = $values;
                $bindData['attribute_id'] = $item['attribute_id'];
                $bindData[$primaryKey] = $id;
                $valueModel::insert($bindData);
            }
        }
    }
}