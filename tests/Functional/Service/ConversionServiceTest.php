<?php

namespace Tests\Functional\Service;


use CurrencyConversion\DTO\ConversionDTO;
use CurrencyConversion\Service\ConversionService\ConversionService;

class ConversionServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testService()
    {
        $conversionDTO = new ConversionDTO('USD', 'BRL', 1);
        $conversionService = new ConversionService($conversionDTO);
        $conversionService->convert();
        $amount = $conversionService->getAmountConverted();
        $expected = $conversionDTO->amount * $conversionService->getRate();
        $this->assertEquals($expected, $amount);
    }
}