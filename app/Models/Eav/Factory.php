<?php

namespace Mvc\Models\Eav;

class Factory
{
    /*
     * @param string class $model
     * @param string $type
     * @return class
     */
    public static function createValueModel($model, $type) {
        $class = $model . '\\Value\\Value' . ucwords($type);
        if (class_exists($class)) {
            return new $class;
        }
        return null; //TODO: Throw new Exception('Unsupported format');
    }
}
