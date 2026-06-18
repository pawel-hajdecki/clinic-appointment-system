<?php
use PHPUnit\Framework\TestCase;
use core\App;
use core\Messages;
use core\Validator;
use core\Utils;

class StringValidateFromRequestTest extends TestCase
{
    protected function setUp(): void
    {
        $messages = new Messages();
        App::setMessages($messages);
        $_REQUEST = [];
    }

    public function testStringValidateFromRequestAcceptsValidTrimmedString(): void
    {
        $_REQUEST['name'] = '  Jan  ';
        $validator = new Validator();

        $result = Utils::stringValidateFromRequest(
            $validator,
            'name',
            true,
            'Pole wymagane.',
            'Nieprawidłowa wartość.',
            '/^[A-Za-z]+$/',
            2,
            10
        );

        $this->assertSame('Jan', $result);
        $this->assertTrue($validator->isLastOK());
        $this->assertFalse(App::getMessages()->isError());
    }

    public function testStringValidateFromRequestRejectsInvalidCharacters(): void
    {
        $_REQUEST['name'] = 'Jan123';
        $validator = new Validator();

        $result = Utils::stringValidateFromRequest(
            $validator,
            'name',
            true,
            'Pole wymagane.',
            'Nieprawidłowa wartość.',
            '/^[A-Za-z]+$/',
            2,
            10
        );

        $this->assertSame('Jan123', $result);
        $this->assertFalse($validator->isLastOK());
        $this->assertTrue(App::getMessages()->isError());
    }
}