<?php

namespace App\Tests\functional;

use \Codeception\Util\HttpCode;
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

    public function tryToGetTerm(FunctionalTester $I)
    {
        $I->amGoingTo('get term');
        $I->sendGet($this->item['@id']);
        $I->seeResponseCodeIsSuccessful();
    }

    public function tryToPostValidTerm(FunctionalTester $I)
    {
        $I->amGoingTo('create term set');
        $I->sendPost('/api/term_sets', ['name' => 'test', 'description' => 'Test']);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        list($item) = $I->grabDataFromResponseByJsonPath('$.');

        $params = [
                'name' => 'solid',
                'description' => "Solid.",
                'termSet' => $item['@id'],
        ];

        $I->amGoingTo('create term');
        $I->sendPost('/api/terms', $params);
        $I->seeResponseCodeIsSuccessful();
        $I->seeCurrentRouteIs('api_terms_post_collection');
        $I->seeResponseIsJson();

        list($item) = $I->grabDataFromResponseByJsonPath('$.');
        (!empty($item)) ? $this->item = $item : '';

        $I->assertNotEmpty($item['@id']);
        $I->assertEquals($params['name'], $item['name']);
    }

    /**
     * public function tryToGetTerm(FunctionalTester $I)
     * {
     * $I->amGoingTo('get term');
     * $I->sendGet($this->item['@id']);
     * $I->seeResponseCodeIsSuccessful();
     * }
     *
     * public function tryToPutTerm(FunctionalTester $I)
     * {
     * $params = [
     * 'name' => 'dry',
     * 'description' => "Don't repeat yourself."
     * ];
     * $I->amGoingTo('update term');
     * $I->sendPut($this->item['@id'], $params);
     * $I->seeResponseCodeIsSuccessful();
     * }
     *
     *
     * public function tryToDeleteTerm(FunctionalTester $I)
     * {
     * $I->amGoingTo('delete term');
     * $I->sendDELETE($this->item['@id']);
     *
     * $I->expect('response code is ' . HttpCode::NO_CONTENT);
     * $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
     * }
     **/
}
