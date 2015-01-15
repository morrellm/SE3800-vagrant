<?php
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 1/9/2015
 * Time: 2:06 PM
 */

class Point
{
    public $x;
    public $y;

    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }
}
class Shape
{
    public $pointList;

    function __construct()
    {
        $this->pointList = array();
    }
    public function AddPoint($x, $y)
    {
        array_push($this->pointList, new Point($x, $y));
    }

    public function CombineShapes($shape)
    {
        if ( gettype($shape) === gettype(new Shape()) )
        {
            foreach($shape->pointList as $point)
            {
                array_push($this->pointList, $point);
            }
            return true;
        }
        return false;
    }

    public function ToJson()
    {
        return json_encode($this->pointList);
    }
}