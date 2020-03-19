<?php

namespace Mvc\Models;

use Mvc\Models\Eav\AbstractEntity;

class Product extends AbstractEntity
{
    protected static $tableName = 'product_entity';

    protected static $primaryKey = 'entity_id';

    protected static $fillable = [
        'entity_id', 'sku', 'created_at',
        'updated_at'
    ];

    /*
     * Create rules for input
     * @param array $elements
     * @return array
     */
    public static function validationClient()
    {
        //TODO: Create rules for input client
        $validation['rules']['sku'] = ['required' => true];
        return $validation;
    }
}