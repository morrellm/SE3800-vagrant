<?php
require("../includes/Shape.php");
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/12/2015
 * Time: 3:36 PM
 */
$validRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shape']) && isset($_POST['sideLength']);

if ($validRequest)
{
    $shape = strtolower($_POST['shape']);
    $length = intval($_POST['sideLength']);

    $createdShape = new Shape();

    switch($shape)
    {
        case 'triangle':
            $createdShape = Shape::MakeShape(3, $length, 30);
            break;
        case 'square':
            $createdShape = Shape::MakeShape(4, $length, 45);
            break;
        case 'pentagon':
            $createdShape = Shape::MakeShape(5, $length, 198);
            break;
        case 'hexagon':
            $createdShape = Shape::MakeShape(6, $length, 0);
            break;
        case 'septagon':
            $createdShape = Shape::MakeShape(7, $length, 167);
            break;
        case 'octogon':
            $createdShape = Shape::MakeShape(8, $length, 23);
            break;
        case 'decagon':
            $createdShape = Shape::MakeShape(10, $length, 0);
            break;
        case 'circle':
            $createdShape = Shape::MakeShape(360, $length, 0);
            break;
        case 'supershape':
            for($i = 2; $i < 20; $i ++)
            {
                $createdShape->CombineShapes(Shape::MakeShape($i, $length, 0));
            }
            $createdShape->CombineShapes(Shape::MakeShape(360, $length, 0));
            break;
        default:
            break;
    }

    echo $createdShape->ToJson();
}
else
{
    echo "{\"message\": \"Invalid Request\"}";
}
?>