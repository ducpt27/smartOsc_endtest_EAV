<?php

namespace Mvc\Models\Eav;

class Attribute extends AbstractAttribute
{
    protected static $tableName = 'eav_attribute';

    protected static $primaryKey = 'attribute_id';

    //TODO: remove $tableValueName
    protected static $tableValueName = [
        'datetime' => 'product_value_datetime',
        'varchar' => 'product_value_varchar',
        'decimal' => 'product_value_decimal',
        'text' => 'product_value_text',
        'int' => 'product_value_int'
    ];

    protected static $fillable = [
        'attribute_id', 'attribute_code', 'frontend_input',
        'frontend_label', 'backend_type', 'is_filterable',
        'default_value'
    ];
}