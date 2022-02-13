<?php

namespace App\Tests\functional;

use \Codeception\Util\HttpCode;
use Doctrine\ORM\Query\Expr\Func;
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

    /**
     * Try to create term-set.
     *
     * @param FunctionalTester $I
     */
    public function tryToPostValidTermSet(FunctionalTester $I)
    {
        $params = [
            'name' => 'functional'
        ];

        $I->amGoingTo('create term set');
        $I->sendPost('/api/term_sets', $params);
        $I->seeResponseCodeIsSuccessful();
        $I->seeCurrentRouteIs('api_term_sets_post_collection');
        $I->seeResponseIsJson();

        list($item) = $I->grabDataFromResponseByJsonPath('$.');
        (!empty($item)) ? $this->item = $item : '';
        $I->assertNotEmpty($item['@id']);
        $I->assertEquals($params['name'], $item['name']);
    }

    /**
     * Try to get term-set collection.
     *
     * @param FunctionalTester $I
     */
    public function tryToGetTermSet(FunctionalTester $I)
    {
        $I->am('API_USER');
        $I->amGoingTo('get a term sets');
        $I->sendGet($this->item['@id']);
    }

    /**
     * Try to get term-set collection.
     *
     * @param FunctionalTester $I
     */
    public function tryToGetTermSets(FunctionalTester $I)
    {
        $I->am('API_USER');
        $I->amGoingTo('get a list of term sets');
        $I->sendGet('/api/term_sets');
        $I->seeResponseCodeIsSuccessful();
    }

    public function tryToDeleteTermSet(FunctionalTester $I)
    {
        $I->amGoingTo('delete term set');
        $I->sendDELETE($this->item['@id']);

        $I->expect('response code is ' . HttpCode::NO_CONTENT);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
