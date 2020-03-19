<?php

namespace Mvc\Models\Eav;

use Mvc\Models\AbstractModel;

abstract class AbstractAttribute extends AbstractModel
{
    public static function getByIsFilterable()
    {
        return static::getValue(['is_filterable' => 1]);
    }

    /*
     * Get all value needed for input
     * @return array
     */
    public static function allWithValueInput()
    {
        $list = parent::all();
        $primaryKey = static::$primaryKey;
        foreach ($list as $key => $item) {
            switch ($item['frontend_input']) {
                case 'multiselect':
                    $list[$key] = static::getValue([$primaryKey => $item[$primaryKey]])[$item[$primaryKey]];
                    break;
                case 'multilevel':
                    if ($item['attribute_code'] == 'category_id') {
                        $list[$key]['value'] = \Mvc\Models\Category::all();
                    }
                    break;
            }
        }
        return $list;
    }

    /*
     * @param array $dataCondition
     * @return array
     */
    public static function getValue($dataCondition = null)
    {
        $data = [];
        $primaryKey = static::$primaryKey;

        $attributes = static::getByAttribute($dataCondition);
        foreach ($attributes as $item) {
            $tableName = static::$tableValueName[$item['backend_type']];
            $sql = 'SELECT * FROM '. $tableName . ' WHERE ' . $primaryKey . ' = ' . $item[$primaryKey] . ' GROUP BY value';
            $arr = parent::fetch($sql);
            foreach ($arr as $row) {
                foreach (static::$fillable as $element) {
                    $data[$row['attribute_id']][$element] = $item[$element];
                }
                $data[$row['attribute_id']]['value'][] = $row['value'];
            }
        }
        return $data;
    }

    public static function createInnerJoin($asTableName = null)
    {
        $primaryKey = static::getPrimaryKey();
        $asTableName = is_null($asTableName) ? 'v' . static::getTableName() : $asTableName;
        $sql = ' INNER JOIN ' . static::getTableName() . ' as ' . $asTableName .
            ' ON ' . $asTableName . '.' . $primaryKey . ' = v.' . $primaryKey;
        return $sql;
    }

    /*
     * Create rules for input
     * @param array $elements
     * @return array
     */
    public static function validationClient($elements = null)
    {
        if (is_null($elements)) {
            $elements = static::all();
        }
        $validation = [];
        foreach ($elements as $key => $item) {
            $input = $item['frontend_input'];
            $arr = ['multiselect', 'multilevel', 'image'];
            if (in_array($input, $arr)) {
                continue;
            }
            $rules = [];
            switch ($item['backend_type']) {
                case 'decimal':
                case 'int':
                    $rules = [
                        'number' => true
                    ];
                    if ($input == 'price') {
                        $rules = [
                            'number' => true,
                            'min' => 0
                        ];
                    }
                    break;
                case 'varchar':
                    $rules = [
                        'maxlength' => 255
                    ];
                    break;
                case 'textarea':
                    break;
            }

            if (count($rules)) {
                $validation['rules'][$item['attribute_code']] = $rules;
            }
        }
        return $validation;
    }
}