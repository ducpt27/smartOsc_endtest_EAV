<?php

namespace Mvc\Controllers;

use Mvc\Models\Category;
use Mvc\Models\Product;
use Mvc\Models\Eav\Attribute;

class PageController extends BaseController
{
    public function contact()
    {
        $this->render('contact');
    }

    public function showCategories($page, $total)
    {
        $categories = Category::all();
        $filterable = Attribute::getByIsFilterable();

        $this->render('category', [
            'categories' => $categories,
            'filter' => $filterable
        ]);
    }

    public function getProduct()
    {
        if (isset($_POST['id'])) {
            $page = $_POST['id'];
            unset($_POST['id']);
        } else {
            $page = 1;
        }
        if (isset($_POST['num'])) {
            $num = $_POST['num'];
            unset($_POST['num']);
        } else {
            $num = 6;
        }

        //TODO inject data filter
        $data = $_POST; // try

        $dataFilter = [];
        foreach ($data as $id => $value) {
            $value = $this->testInput($value);
            $id = str_replace('_', '', $id);
            $dataFilter[] = [
                'attribute_id' => $id,
                'value' => $value,
            ];
        }
        echo json_encode(Product::getByAttribute($dataFilter, $page, $num));
    }

    public function getProductById($id)
    {
        $product = Product::getById($id)[0];
        if (is_null($product)) {
            echo json_encode(['status' => 'errors', 'message' => 'Product id does not exist']);
        }
        echo json_encode($product);
    }

    public function showProductDetails($id)
    {
        $product = Product::getById($id)[0];
        $this->render('single-product', [
            'product' => $product
        ]);
    }
}