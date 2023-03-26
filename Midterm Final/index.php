<?php
require('model/database.php');
require('model/vehicle_DB.php');
require('model/type_DB.php');
require('model/class_DB.php');
require('model/make_DB.php');
$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
$year_price = filter_input(INPUT_POST, 'year_price', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'item_list';
    }
}
switch($action)
{
    default:
        $types = get_types();
        $classes = get_classes();
        $makes = get_makes();
        $vehicles = get_vehicle_by_categoy($type_id, $class_id, $make_id, $year_price);
        include('view/vehicleList.php');
        break;
}
?>