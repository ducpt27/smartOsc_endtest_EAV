<?php

namespace Mvc\Models;

class Category extends AbstractModel
{
    protected static $tableName = 'category';

    protected static $primaryKey = 'entity_id';

    protected static $fillable = [
        'entity_id', 'parent_id', 'name',
        'created_at', 'updated_at'
    ];

    /*
     * @Override
     */
    public static function fetch($sql = null, $condition = "1", $bindParam = null, $limit = null)
    {
        $categories = parent::fetch($sql, $condition, $bindParam);
        $categories = parent::_toArrayMultilevel($categories);
        return $categories;
    }

}