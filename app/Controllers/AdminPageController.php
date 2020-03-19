<?php

namespace Mvc\Controllers;

use Mvc\Models\Product;
use Mvc\Models\Eav\Attribute;

class AdminPageController extends BaseController
{
    public $folder = 'admin/';

    public function showAddProduct()
    {
        $elements = Attribute::allWithValueInput();
        $attributeVal= Attribute::validationClient();
        $productVal = Product::validationClient();

        $validation = [];
        $validation['rules'] = array_merge($attributeVal['rules'], $productVal['rules']);

        $this->render('product-form', [
            'elements' => $elements,
            'validation' => json_encode($validation)
        ]);
    }
}