<?php

namespace Mvc\Controllers;

use Mvc\Models\Product;

class ProductController extends BaseController
{
    public $folder = 'admin/';

    public function add()
    {
        if (isset($_POST)) {
            if (isset($_FILES['image'])) {
                $files_image = $this->uploadFileImage($_FILES['image']);
            }
            $product = new Product($_POST);
            $product->setData('image', $files_image);
            $last_id = $product->save();
            if ($last_id < 1) {
                echo "failed";
            } else {
                echo "success";
            }
        }
    }
}