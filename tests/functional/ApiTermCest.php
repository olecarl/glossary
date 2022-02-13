<?php

namespace App\Tests\functional;

use \Codeception\Util\HttpCode;
use \FunctionalTester;

class ApiTermCest
{

    /** @var array $item */
    private array $item = [];

    public function _before(FunctionalTester $I)
    {
        $I->am('API_USER');
        $I->expect('content type is application/ld+json');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('accept', 'application/ld+json');
    }

    public function tryToPostValidTerm(FunctionalTester $I)
    {
        $I->amGoingTo('create term set');
        $I->sendPost('/api/term_sets', ['name' => 'test']);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        list($termset) = $I->grabDataFromResponseByJsonPath('$.');

        $params = [
            'name' => 'dry',
            'description' => "Don't repeat yourself.",
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fcampus.datacamp.com%2Fcourses%2Fsoftware-engineering-for-data-scientists-in-python%2Futilizing-classes%3Fex%3D7&psig=AOvVaw066CDbN2gSRwSHCcoLHfgA&ust=1644320535298000&source=images&cd=vfe&ved=0CAgQjRxqFwoTCPCw-LzB7fUCFQAAAAAdAAAAABAL',
            'url' => 'https://en.wikipedia.org/wiki/Don%27t_repeat_yourself',
            'termSet' => $termset['@id'],
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

    public function tryToGetTerms(FunctionalTester $I)
    {
        $I->amGoingTo('get terms');
        $I->sendGet('/api/terms');
        $I->seeResponseCodeIsSuccessful();
    }

    public function tryToGetTerm(FunctionalTester $I)
    {
        $I->amGoingTo('get term');
        $I->sendGet($this->item['@id']);
        $I->seeResponseCodeIsSuccessful();
    }

    public function tryToPutTerm(FunctionalTester $I)
    {
        $params = [
            'name' => 'dry',
            'description' => "Don't repeat yourself."
        ];
        $I->amGoingTo('update term');
        $I->sendPut($this->item['@id'], $params);
        $I->seeResponseCodeIsSuccessful();
    }

    public function tryToDeleteTerm(FunctionalTester $I)
    {
        $I->amGoingTo('delete term');
        $I->sendDELETE($this->item['@id']);

        $I->expect('response code is ' . HttpCode::NO_CONTENT);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
