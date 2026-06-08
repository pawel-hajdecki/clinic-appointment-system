<?php
use PHPUnit\Framework\TestCase;
use core\Utils;
use core\App;
use core\Messages;
use core\Validator;
class PassValidationTest extends TestCase
{
    protected function setUp(): void
    {
        $messages = new Messages();
        App::setMessages($messages);
        $_REQUEST = [];
    }
 
    public function testCorrectPasswordValidation(): void
    {
        //Poprawne hasło (8 znaków, wielka litera + cyfra) - przyjęte, brak błędu.
        $messages = new Messages();
        App::setMessages($messages);
        $_REQUEST['password'] = 'Hasło123';
        $validator = new Validator();
        $result = Utils::passwordValidateFromRequest($validator, 'password', true);
        $this->assertSame('Hasło123', $result);
        $this->assertTrue($validator->isLastOK());
        $this->assertFalse(App::getMessages()->isError());
        
    }
}