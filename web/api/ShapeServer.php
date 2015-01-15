<?php
require(__DIR__ . "\\..\\includes\\ShapeGenerator.php");
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/12/2015
 * Time: 3:36 PM
 */
function makeShape($sides, $length)
{
    $newShape = new Shape();
    for($i = 0; $i < $sides; $i++)
    {
        $newShape->
        AddPoint(
            $length * cos( deg2rad($i * (360 / $sides)) ) + $length,
            $length * sin( deg2rad($i * (360 / $sides)) ) + $length
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
            $createdShape = makeShape(3, $length);
            break;
        case 'square':
            $createdShape = makeShape(4, $length);
            break;
        case 'pentagon':
            $createdShape = makeShape(5, $length);
            break;
        case 'hexagon':
            $createdShape = makeShape(6, $length);
            break;
        case 'septagon':
            $createdShape = makeShape(7, $length);
            break;
        case 'octogon':
            $createdShape = makeShape(8, $length);
            break;
        case 'circle':
            $createdShape = makeShape(360, $length);
            break;
        case 'supershape':
            for($i = 2; $i < 20; $i ++)
            {
                $createdShape->CombineShapes(makeShape($i, $length));
            }
            $createdShape->CombineShapes(makeShape(360, $length));
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