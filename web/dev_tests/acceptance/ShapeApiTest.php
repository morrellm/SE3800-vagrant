<?php
/**
 * Created by PhpStorm.
 * User: Mitchell
 * Date: 2/19/2015
 * Time: 12:22 PM
 */

class ShapeApiTest extends PHPUnit_Framework_TestCase {

    private $urlToTest = "http://localhost/api/ShapeServer.php";
    function testValidShape()
    {
        $result = ShapeApiTest::post($this->urlToTest, array("shape" => "square", "sideLength" => 7));
        $jsonResult = json_decode($result);
        $this->assertEquals(count($jsonResult), 4);
        foreach($jsonResult as $point)
        {
            $this->assertTrue(is_numeric($point->x));
            $this->assertTrue(is_numeric($point->y));
        }
    }

    function testInvalidShape()
    {
        $result = ShapeApiTest::post($this->urlToTest, array("shape" => "abadba", "sideLength" => 7));
        $jsonResult = json_decode($result);
        $this->assertEquals(count($jsonResult), 0);
    }

    function testInvalidRequest()
    {
        $result = file_get_contents($this->urlToTest);
        $jsonResult = json_decode($result, true);
        $this->assertTrue(isset($jsonResult['message']));
        $this->assertEquals($jsonResult['message'], "Invalid Request");
}

private function post($url, array $args)
{
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($args),
        ),
    );
    $context  = stream_context_create($options);
    return file_get_contents($url, false, $context);
}
}
