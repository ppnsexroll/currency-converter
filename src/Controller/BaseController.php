<?php
namespace CurrencyConversion\Controller;

use Rakit\Validation\Validator;

abstract class BaseController
{
    /**
     * @var Validator $validator
     */
    protected $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    /**
     * @param array|null $body
     * @return null|string
     */
    abstract protected function validate ($body): ?string;
}