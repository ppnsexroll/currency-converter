<?php
namespace CurrencyConversion\Service\ConversionService;


use CurrencyConversion\DTO\ConversionDTO;
use GuzzleHttp\Client;

class ConversionService
{
    private $conversionDTO;
    private $client;
    private $rate;

    public function __construct(ConversionDTO $conversionDTO)
    {
        $this->conversionDTO = $conversionDTO;
        $this->client = new Client();
    }

    private function buildApiUrl(string $conversionKey)
    {
        return "https://free.currencyconverterapi.com/api/v6/convert?q={$conversionKey}&compact=y";
    }

    public function convert()
    {
        $conversionKey = $this->conversionDTO->from . '_' . $this->conversionDTO->to;
        $response = $this->client->get($this->buildApiUrl($conversionKey));
        $body = json_decode((string) $response->getBody(), true);
        $this->rate = $body[$conversionKey]['val'];
        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getAmountConverted()
    {
        return $this->conversionDTO->amount * $this->rate;
    }
}