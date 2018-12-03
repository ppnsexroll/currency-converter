<?php
namespace CurrencyConversion\DTO;


class ConversionDTO
{
    public $from;
    public $to;
    public $amount;

    public function __construct($from, $to, $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }
}
