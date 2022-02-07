<?php

namespace App\Tests\functional;


use \FunctionalTester;
use Codeception\Example;

class ApiEntryCest
{


    public function _before(FunctionalTester $I)
    {
    }

    /**
     * @param FunctionalTester $I
     * @param Example $example
     * @dataProvider provideSupportedFormats
     */
    public function trySupportedFormats(FunctionalTester $I, Example $example)
    {
        $I->am('API_USER');
        $I->expect('content type ' . $example['mimetype']);
        $I->haveHttpHeader('accept', $example['mimetype']);
        $I->send('GET', '/api');
        $I->seeResponseCodeIsSuccessful();
    }

    /**
     * Data provider function
     *
     * @return string[]
     */
    private function provideSupportedFormats() : array
    {
        return [
                ['mimetype' => 'text/html'],
                ['mimetype' => 'application/json'],
                ['mimetype' => 'application/ld+json'],
                ['mimetype' => 'application/hal+json'],
                ['mimetype' => 'application/vnd.api+json'],
                ['mimetype' => 'application/x-yaml'],
                ['mimetype' => 'application/xml'],
                ['mimetype' => 'text/csv'],
        ];
    }
}
