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

        $I->seeCurrentRouteIs('api_term_sets_get_collection');
    }

    /**
     * Try to create term-set.
     *
     * @param FunctionalTester $I
     */
    public function tryCrudTermSet(FunctionalTester $I)
    {
        $params = [
            'name' => 'functional',
            'description' => 'Functional Testing'
        ];

        $I->am('API_USER');
        $I->amGoingTo('create term set');
        $I->sendPost('/api/term_sets', $params);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeCurrentRouteIs('api_term_sets_post_collection');

        list($item) = $I->grabDataFromResponseByJsonPath('$.');

        $I->assertNotEmpty($item['@id']);
        $I->assertEquals($params['name'], $item['name']);

        $I->amGoingTo('get a term set');
        $I->sendGet($item['@id']);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeCurrentRouteIs('api_term_sets_get_item');

        $I->amGoingTo('delete term set');
        $I->sendDELETE($item['@id']);

        $I->expect('response code is ' . HttpCode::NO_CONTENT);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

    }
}
