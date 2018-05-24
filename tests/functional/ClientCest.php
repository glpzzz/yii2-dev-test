<?php

use app\models\Client;

class ClientCrudCest
{
    public function openClientsPage(\FunctionalTester $I)
    {
        $I->amOnPage(['client/index']);
        $I->see('Clients', 'h1');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnPage(['client/index']);
        $I->click('Add');
        $I->see('Create client', 'h1');

        $I->submitForm('#client-form', []);
        $I->expectTo('see validations errors');
        $I->see('Name cannot be blank');
        $I->see('Surname cannot be blank');
        $I->see('Email cannot be blank');
    }

    public function submitFormWithIncorrectEmail(\FunctionalTester $I)
    {

        $I->amOnPage(['client/create']);
        $I->see('Create client', 'h1');

        $I->submitForm('#client-form', [
            'Client[name]' => 'Juan',
            'Client[surname]' => 'Jimenez',
            'Client[email]' => 'juan',
        ]);
        $I->expectTo('see that email address is wrong');
        $I->dontSee('Name cannot be blank', '.help-inline');
        $I->see('Email is not a valid email address.');
        $I->dontSee('Surname cannot be blank', '.help-inline');
    }

    public function submitFormWithCorrectData(\FunctionalTester $I)
    {
        $I->amOnPage(['client/create']);
        $I->see('Create client', 'h1');

        $I->submitForm('#client-form', [
            'Client[name]' => 'Juan',
            'Client[surname]' => 'Jimenez',
            'Client[email]' => 'juan.jimenez@trueapps.cz',
        ]);
        $I->expectTo('see that correct data in saved');
        $I->see('Juan Jimenez', 'h1');
    }

    public function submitFormWithSameEmail(\FunctionalTester $I)
    {
        $I->amOnPage(['client/create']);
        $I->see('Create client', 'h1');

        $I->submitForm('#client-form', [
            'Client[name]' => 'Juan',
            'Client[surname]' => 'Jimenez',
            'Client[email]' => 'juan.jimenez@trueapps.cz',
        ]);
        $I->expectTo('see that error for not unique email');
        $I->see('Email "juan.jimenez@trueapps.cz" has already been taken.', '.help-block');
    }

    public function updateClient(\FunctionalTester $I)
    {
        $I->amOnPage(['client/index']);
        $I->click('table tr:first-child > td:last-child > a[title=Update]');
        $I->expectTo('see update page');
        $I->see('Update');
        $I->submitForm('#client-form', [
            'Client[name]' => 'Pedro',
        ]);
        $I->see('Pedro', 'h1');
    }

    public function deleteClient(\FunctionalTester $I)
    {
        $I->amOnPage(['client/index']);
        $I->see('Clients', 'h1');

        $clientsBegin = Client::find()->count();

        $var = $I->grabAttributeFrom('table tr:first-child > td:last-child > a[title=Delete]', 'href');
        $I->sendAjaxPostRequest($var);
        $I->see('Clients', 'h1');

        $clientsEnd = Client::find()->count();

        $I->assertEquals($clientsBegin - 1, $clientsEnd);
    }

    public function erasingAll()
    {
        \app\models\Client::deleteAll();
    }

}
