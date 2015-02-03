<?php
require 'web/includes/Shape.php';
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/23/2015
 * Time: 2:28 PM
 */

class ShapeTest extends PHPUnit_Framework_TestCase {

    public function test_MakeShape()
    {
        $genShape = Shape::MakeShape($sides = 4, $length = 5, $rotation = 0);

        $this->assertEquals($sides, count($genShape->pointList));

        $dist = $this->distance($genShape->pointList[0], $genShape->pointList[2]);

        $this->assertEquals(
            $length * 2,
            $dist
        );

    }

    public function test_CombineShape()
    {
        $baseShape = Shape::MakeShape($sides = 4, $length = 5, $rotation = 0);
        $toCombineShape = Shape::MakeShape($sides = 3, $length = 5, $rotation = 0);

        $ptSetBase = $baseShape->pointList;
        $ptSetToCombine = $toCombineShape->pointList;

        $baseShape->CombineShapes($toCombineShape);

        $ptSetActual = $baseShape->pointList;
        foreach($ptSetToCombine as $point)
        {
            array_push($ptSetBase, $point);
        }
        $ptSetExpected = $ptSetBase;

        $this->assertEquals(count($ptSetExpected), count($ptSetActual));

        for($i = 0; $i < count($ptSetActual); $i++)
        {
            $ptExpected = $ptSetExpected[$i];
            $ptActual = $ptSetActual[$i];

            $this->assertEquals($ptExpected->x,
                $ptActual->x);
            $this->assertEquals($ptExpected->y, $ptActual->y);
        }
    }

    private function distance($pt1, $pt2)
    {
        return
            sqrt(
                pow( ($pt2->x - $pt1->x), 2 )
                +
                pow( ($pt2->y - $pt1->y), 2 )
            );
    }
}
