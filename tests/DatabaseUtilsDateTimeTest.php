<?php
use PHPUnit\Framework\TestCase;
use app\services\DatabaseUtils;
use DateTime;

class DatabaseUtilsDateTimeTest extends TestCase
{
    public function testDBtoDateTimeConversion(): void
    {
        $dbDateTime = '2026-06-20 14:30:00';
        $dateTime = DatabaseUtils::DB_toDateTime($dbDateTime);
        
        $this->assertInstanceOf(DateTime::class, $dateTime);
        $this->assertSame('2026-06-20', $dateTime->format('Y-m-d'));
        $this->assertSame('14:30:00', $dateTime->format('H:i:s'));
    }

    public function testDateTimeToDBStringConversion(): void
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', '2026-06-20 14:30:00');
        $dbString = DatabaseUtils::DB_DateTimeToString($dateTime);
        
        $this->assertSame('2026-06-20 14:30:00', $dbString);
    }
}