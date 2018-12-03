<?php

namespace CurrencyConversion\Controller;

use CurrencyConversion\DTO\ConversionDTO;
use CurrencyConversion\Service\ConversionService\ConversionService;
use Slim\Http\Request;
use Slim\Http\Response;
use Rakit\Validation\Validator;
use Rakit\Validation\Validation;

class ConverterController extends BaseController
{
    /**
     * @const string CURRENCY_RULE
     */

    const CURRENCY_RULE = 'required|regex:/^\w{3}$/';
    /**
     * @const string AMOUNT_RULE
     */

    const AMOUNT_RULE = 'required|min:1';
    /**
     * @var array $CURRENCIES_ALLOWED
     */

    private static $CURRENCIES_ALLOWED = [
      'USD',
      'BRL',
      'EUR'
    ];

    /**
     * @var Validator $validator
     */
    protected $validator;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $currency
     * @return bool
     */
    private function checkCurrencyIsAllowed (string $currency): bool
    {
        return in_array($currency, self::$CURRENCIES_ALLOWED);
    }

    /**
     * @param string $currency
     * @return string
     */
    private function makeCurrencyAllowedErrorMessage (string $currency): string
    {
        $list = implode(', ', self::$CURRENCIES_ALLOWED);
        return "The currency {$currency} is not allowed, currency list:  $list";
    }

    /**
     * @param array|null $body
     * @return string|null
     */
    protected function validate($body): ?string
    {
        if (!is_array($body)) {
            return 'The body cannot be empty';
        }

        /**
         * @var Validation $validation
         */
       $validation = $this->validator->make($body, [
            'from' => self::CURRENCY_RULE,
            'to' => self::CURRENCY_RULE,
            'amount' => self::AMOUNT_RULE,
        ]);
       $validation->validate();

       if ($validation->fails()) {
           return array_values($validation->errors()->firstOfAll())[0];
       }

       if (!$this->checkCurrencyIsAllowed($body['from'])) {
            return $this->makeCurrencyAllowedErrorMessage($body['from']);
       }

       if (!$this->checkCurrencyIsAllowed($body['to'])) {
           return $this->makeCurrencyAllowedErrorMessage($body['to']);
       }

       if (strtoupper($body['from']) === strtoupper($body['to'])) {
           return 'The currencies cannot be equals';
       }

       return null;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function post(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $error = $this->validate($body);

        if ($error) {
            $responseBody = [
                'status' => false,
                'error' => $error
            ];
            return $response->withJson($responseBody, 400);
        }

        $conversionDTO = new ConversionDTO($body['from'], $body['to'], $body['amount']);
        $conversionService = new ConversionService($conversionDTO);
        $conversionService->convert();

        return $response->
                withJson([
                    'status' => true,
                    'amount' => $conversionService->getAmountConverted()

        ]);
    }
}