<?php
 
use PHPUnit\Framework\TestCase;
use core\App;
use core\Messages;
use app\controllers\EditAppointmentCtrl;
 
class GetAppointmentDateTimeTest extends TestCase
{
    protected function setUp(): void
    {
        $messages = new Messages();
        App::setMessages($messages);
    }

    private function invokeGetAppointmentDateTime(string $date, string $startTime, string $endTime): array
    {
        $messages = new Messages();
        App::setMessages($messages);
 
        $ctrl = new EditAppointmentCtrl();
 
        // getAppointmentDateTime wykorzystuje pole prywatne $appointment, więc trzeba zamockować jego wartość,
        // a dostać się do niego przez refleksję.
        $appointmentProp = new ReflectionProperty(EditAppointmentCtrl::class, 'appointment');
        $form = $appointmentProp->getValue($ctrl);
        $form->date = $date;
        $form->startTime = $startTime;
        $form->endTime = $endTime;
 
        // getAppointmentDateTime jest prywatną metodą, więc musimy użyć refleksji, aby ją wywołać.
        $method = new ReflectionMethod(EditAppointmentCtrl::class, 'getAppointmentDateTime');
        $start = null;
        $end = null;
        $method->invokeArgs($ctrl, [&$start, &$end]);
 
        return [$start, $end];
    }
 
    public function testGetAppointmentDateTime(): void
    {
        // Poprawna data wejściowa to data przyszła, a godziny między 7 a 20, a czas wizyty musi być większy niż 5 min., ale mniejszy niz 4 godziny.
        [$start, $end] = $this->invokeGetAppointmentDateTime('01/01/2099', '10:00', '11:00');
        $this->assertFalse(App::getMessages()->isError());
        $this->assertInstanceOf(DateTime::class, $start);
        $this->assertInstanceOf(DateTime::class, $end);
        $this->assertSame('2099-01-01 10:00', $start->format('Y-m-d H:i'));
        $this->assertSame('2099-01-01 11:00', $end->format('Y-m-d H:i'));
    }
}