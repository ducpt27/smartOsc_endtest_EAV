<?php

namespace Mvc\Models\Eav;

use Mvc\Models\AbstractModel;

abstract class AbstractValue extends AbstractModel
{
    public static function createInnerJoin($asTableName = null, $keyBindValue = null, $attribute_id = null)
    {
        $asTableName = is_null($asTableName) ? 'v' . static::getTableName() : $asTableName;
        $width_value = is_null($keyBindValue) ? "" : ' AND ' . $asTableName . '.value = ' . $keyBindValue;
        $width_attribute_id = is_null($attribute_id) ? "" : ' AND ' . $asTableName . '.' . Attribute::getPrimaryKey() . ' = ' . $attribute_id;

        $sql = ' INNER JOIN ' . static::getTableName() . ' as ' . $asTableName .
            ' ON ' . $asTableName . '.entity_id' . ' = e.entity_id' . $width_attribute_id
             . $width_value;
        return $sql;
    }
}