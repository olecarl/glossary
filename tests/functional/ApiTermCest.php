<?php

namespace App\Tests\functional;

use \FunctionalTester;

class ApiTermCest
{


    private array $item;

    public function _before(FunctionalTester $I)
    {
        $I->am('API_USER');
        $I->expect('content type is application/ld+json');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('accept', 'application/ld+json');
    }

    public function tryToGetTerms(FunctionalTester $I)
    {
        $I->amGoingTo('get terms');
        $I->sendGet('/api/terms');

        $I->expect('response is valid');
        $I->seeResponseCodeIsSuccessful();

        $I->expect('response is matching json');
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                '@context' => 'string',
                '@id' => 'string',
                '@type' => 'string',
                'hydra:member' => 'array',
            ]
        );

        list($item) = $I->grabDataFromResponseByJsonPath('$.');

        $this->item = $item['hydra:member'][0];
    }
}
