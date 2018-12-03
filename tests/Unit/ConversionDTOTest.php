<?php
namespace Tests\Unit;


use CurrencyConversion\DTO\ConversionDTO;

class ConversionDTOTest extends \PHPUnit_Framework_TestCase
{
    public function testConversionDTOIsDataSetup()
    {
        $from = 'USD';
        $to = 'BRL';
        $amount = 0;
        $conversionDTO = new ConversionDTO($from, $to, $amount);
        $this->assertEquals($from, $conversionDTO->from);
        $this->assertEquals($to, $conversionDTO->to);
        $this->assertEquals($amount, $conversionDTO->amount);
    }
}