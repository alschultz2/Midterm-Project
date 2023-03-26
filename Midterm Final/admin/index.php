<?php
require('Model_Databases/database.php');
require('Model_Databases/vehicleDB.php');
require('Model_Databases/typeDB.php');
require('Model_Databases/classDB.php');
require('Model_Databases/makeDB.php');
$type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
$make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
$year_price = filter_input(INPUT_POST, 'year_price', FILTER_VALIDATE_INT);
$type_name = filter_input(INPUT_POST, 'type_name', FILTER_UNSAFE_RAW);
$class_name = filter_input(INPUT_POST, 'class_name', FILTER_UNSAFE_RAW);
$make_name = filter_input(INPUT_POST, 'make_name', FILTER_UNSAFE_RAW);
$year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
$model = filter_input(INPUT_POST, 'model', FILTER_UNSAFE_RAW);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'vehicles_list';
    }
}
switch($action)
{
    case "list_types":
        $types = get_types();
        include('Viewer/typeList.php');
        break;
    case "add_type":
        if ($type_name) {
            add_type($type_name);
            header("Location: .?action=list_types");
            break;
        } else {
            $error = "invalid Data Item.";
            include('Viewer/error.php');
            exit();
        }
        header("Location: .?action=list_types");
        break;
    case "delete_type":
        if ($type_id) {
            try {
                delete_type($type_id);
            } catch (PDOException $error) {
                $error = "you cannot delete the category.";
                include('Viewer/error.php');
                exit();
            }
            header("Location: .?action=list_types");
            break;
        }
        break;
    case "list_classes":
        $classes = get_classes();
        include('Viewer/classList.php');
        break;
    case "add_class":
        if ($class_name) {
            add_class($class_name);
            header("Location: .?action=list_classes");
            break;
        } else {
            $error = "invalid Data Item.";
            include('Viewer/error.php');
            exit();
        }
        header("Location: .?action=list_classes");
        break;
    case "delete_class":
        if ($class_id) {
            try {
                delete_class($class_id);
            } catch (PDOException $error) {
                $error = "you cannot delete the category.";
                include('Viewer/error.php');
                exit();
            }
            header("Location: .?action=list_classes");
            break;
        }
        break;
    case "list_makes":
        $makes = get_makes();
        include('Viewer/makeList.php');
        break;
    case "add_make":
        if ($make_name) {
            add_make($make_name);
            header("Location: .?action=list_makes");
            break;
        } else {
            $error = "invalid Data Item.";
            include('Viewer/error.php');
            exit();
        }
        header("Location: .?action=list_makes");
        break;
    case "delete_make":
        if ($make_id) {
            try {
                delete_make($make_id);
            } catch (PDOException $error) {
                $error = "you cannot delete the category.";
                include('Viewer/error.php');
                exit();
            }
            header("Location: .?action=list_makes");
            break;
        }
        break;
    case "add_vehicle":
        $makes = get_makes();
        $types = get_types();
        $classes = get_classes(); 
        include('Viewer/addVehicle.php');
        break;
    case "add_vehicle2":
        echo 1;
        if($year && $model && $price && $type_id && $class_id && $make_id) {
            add_vehicle($year, $model, $price, $type_id, $class_id, $make_id);
            header("Location: .?action=list_vehicles");
            break;
        } else {
            $error = "invalid Data Item";
            include('Viewer/error.php');
            exit();
        }
        header("Location: .?action=list_vehicles");
        break;
    case "delete_vehicle":
        if ($model) {
            try {
                delete_vehicle($model);
            } catch (PDOException $error) {
                $error = "you cannot delete the category.";
                include('Viewer/error.php');
                exit();
            }
            header("Location: .?action=list_vehicles");
            break;
        }
        break;
    default:
        $types = get_types();
        $classes = get_classes();
        $makes = get_makes();
        $vehicles = get_vehicle_by_categoy($type_id, $class_id, $make_id, $year_price);
        include('Viewer/vehicleList.php');
        break;
}
?>