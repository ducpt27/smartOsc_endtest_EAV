<?php

$scope = isset($_REQUEST['scope']) ? $scope = $_REQUEST['scope'] : null;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$num = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;

$router = [
    'product' => ['add', 'edit', 'remove'],
    'adminPage' => ['showAddProduct'],
    'page' => ['contact', 'showCategories', 'showProductDetails', 'getProduct', 'getProductById']
];

if (!array_key_exists($scope,$router) || !in_array($action, $router[$scope])) {
    $scope = 'page';
    $action = 'showCategories';
}
$class = '\\Mvc\\Controllers\\' .ucwords($scope) . 'Controller';
$controller = new $class();
$controller->$action($id, $num);