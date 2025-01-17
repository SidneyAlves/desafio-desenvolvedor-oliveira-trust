<?php

namespace Tests\Feature;

use App\Services\ConsumeApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\ExchangeService;
use App\Traits\TestHelper;
use Tests\TestCase;

class ExchangeServiceTest extends TestCase
{
    use TestHelper;

    public function provideCurrenciesData(): array
    {
        return [
            'USD-BRL' => [
                ['USD', 'BRL'],
                true
            ],
            'EUR-BRL' => [
                ['EUR', 'BRL'],
                true
            ],
            'BTC-EUR' => [
                ['BTC', 'EUR'],
                true
            ],
            'BRL-BRL' => [
                ['BRL', 'BRL'],
                false
            ],
            'BRL-invalid' => [
                ['BRL','invalid'],
                false
            ],
            'invalid-USD' => [
                ['invalid', 'USD'],
                false
            ],
            'invalid-invalid' => [
                ['invalid', 'invalid'],
                false
            ]
        ];
    }

    /**
     * @dataProvider provideCurrenciesData
     */
    public function testShouldAcceptOnlyValidCurrencies(array $currencies, bool $expectedResult): void
    {
        $exchangeService = new ExchangeService(new ConsumeApiService());

        $validateCurrency = $this->getPrivateMethod(ExchangeService::class, 'validateCurrencies');
        $result = $validateCurrency->invokeArgs($exchangeService, array($currencies[0], $currencies[1]));

        $this->assertSame($expectedResult, $result);
    }
}
