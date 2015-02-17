<?php
require_once '../../vendor/phpunit.phar/Extensions/SeleniumTestCase.php';

class MainPageTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://www.example.com/');
    }

    public function testTitle()
    {
        $this->url('http://www.example.com/');
        $this->assertEquals('Example Domain', $this->title());
    }

}
?>