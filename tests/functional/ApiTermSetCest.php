<?php

namespace App\Tests\functional;

use \Codeception\Util\HttpCode;
use \FunctionalTester;

class ApiTermSetCest
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

    public function tryToPostValidTermSet(FunctionalTester $I)
    {
        $params = [
            'name' => 'webdev'
        ];

        $I->amGoingTo('create term set');
        $I->sendPost('/api/term_sets', $params);
        $I->seeResponseCodeIsSuccessful();
        $I->seeCurrentRouteIs('api_term_sets_post_collection');
        $I->seeResponseIsJson();

        list($item) = $I->grabDataFromResponseByJsonPath('$.');
        (!empty($item)) ? $this->item = $item : '';
    }

    public function tryToDeleteTerm(FunctionalTester $I)
    {
        $I->amGoingTo('delete term set');
        $I->sendDELETE($this->item['@id']);

        $I->expect('response code is ' . HttpCode::NO_CONTENT);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
