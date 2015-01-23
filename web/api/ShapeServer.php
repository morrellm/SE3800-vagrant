<?php
require(__DIR__ . "\\..\\includes\\ShapeGenerator.php");
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/12/2015
 * Time: 3:36 PM
 */
function makeShape($sides, $length, $rotation)
{
    $newShape = new Shape();
    for($i = 0; $i < $sides; $i++)
    {
        $newShape->
        AddPoint(
            $length * cos( deg2rad($i * (360 / $sides) + $rotation) ) + $length + 5,
            $length * sin( deg2rad($i * (360 / $sides) + $rotation) ) + $length + 5
        );
    }
    return $newShape;
}
$validRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shape']) && isset($_POST['sideLength']);

if ($validRequest)
{
    $shape = strtolower($_POST['shape']);
    $length = intval($_POST['sideLength']);

    $createdShape = new Shape();

    switch($shape)
    {
        case 'triangle':
            $createdShape = makeShape(3, $length, 30);
            break;
        case 'square':
            $createdShape = makeShape(4, $length, 45);
            break;
        case 'pentagon':
            $createdShape = makeShape(5, $length, 198);
            break;
        case 'hexagon':
            $createdShape = makeShape(6, $length, 0);
            break;
        case 'septagon':
            $createdShape = makeShape(7, $length, 167);
            break;
        case 'octogon':
            $createdShape = makeShape(8, $length, 23);
            break;
        case 'circle':
            $createdShape = makeShape(360, $length, 0);
            break;
        case 'supershape':
            for($i = 2; $i < 20; $i ++)
            {
                $createdShape->CombineShapes(makeShape($i, $length, 0));
            }
            $createdShape->CombineShapes(makeShape(360, $length, 0));
            break;
        default:
            break;
    }

    echo $createdShape->ToJson();
}
else
{
    echo "{'message': 'Invalid Request'}";
}
?>