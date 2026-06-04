<?php
use PHPUnit\Framework\TestCase;
use core\Utils;

class UtilsTest extends TestCase {
    public function testCapitalize() {
        $this->setUp();
        $this->assertEquals('Hello', Utils::capitalize('hello'));
        $this->assertEquals('World', Utils::capitalize('world'));
    }
}