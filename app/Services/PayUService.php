<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;

class PayUService
{
    use ConsumesExternalServices;

    protected $baseUri;

    protected $accountId;

    protected $merchantId;

    protected $key;

    protected $secret;

    protected $baseCurrency;

    protected $converter;

    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.payu.base_uri');
        $this->accountId = config('services.payu.account_id');
        $this->merchantId = config('services.payu.merchant_id');
        $this->key = config('services.payu.key');
        $this->secret = config('services.payu.secret');
        $this->baseCurrency = strtoupper(config('services.payu.base_currency'));

        $this->converter = $converter;
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $formParams['merchant']['apiKey'] = $this->key;
        $formParams['merchant']['apiLogin'] = $this->secret;
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function handlePayment(Request $request)
    {
        //
    }

    public function handleApproval()
    {
        //
    }

    public function createPayment()
    {
        //
    }

    public function resolveFactor($currency)
    {
        return $this->converter->convertCurrency($currency, $this->baseCurrency);
    }

    public function generateSignature($referenceCode, $value)
    {
        return md5("{$this->key}~{$this->merchantId}~{$referenceCode}~{$value}~{$this->baseCurrency}");
    }
}
