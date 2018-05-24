<?php

class ContractCrudCest
{

    private $client1 = null;
    private $client2 = null;

    public function init()
    {
        $this->client1 = new \app\models\Client([
            'name' => 'Pepe',
            'surname' => 'Rodriguez',
            'email' => 'pepe@pepe.cu'
        ]);
        $this->client1->save();
        $this->client2 = new \app\models\Client([
            'name' => 'Paco',
            'surname' => 'Perez',
            'email' => 'paco@paco.cu'
        ]);
        $this->client2->save();
    }

    public function openContractsPage(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/index']);
        $I->see('Contracts', 'h1');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/index']);
        $I->click('Add');
        $I->see('Create Contract', 'h1');

        $I->submitForm('form', []);
        $I->expectTo('see validations errors');
        $I->see('Number cannot be blank.');
        $I->see('Date cannot be blank.');
        $I->see('Amount cannot be blank.');
        $I->see('Buyer must be different to seller.');
        $I->see('Description cannot be blank.');
    }

    public function submitFormWithCorrectData(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/create']);
        $I->see('Create Contract', 'h1');

        $I->submitForm('form', [
            'Contract[number]' => '1259',
            'Contract[date]' => 'May 9, 2018',
            'Contract[amount]' => '56',
            'Contract[seller_id]' => $this->client1->id,
            'Contract[buyer_id]' => $this->client2->id,
            'Contract[description]' => 'The description',
        ]);
        $I->expectTo('see that correct data in saved');
        $I->see('Contract #1259', 'h1');
    }

    public function submitFormWithIncorrectData(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/create']);
        $I->see('Create Contract', 'h1');

        $I->submitForm('form', [
            'Contract[number]' => 'qwerty',
            'Contract[date]' => 'qwerty',
            'Contract[amount]' => 'qwerty',
            'Contract[seller_id]' => 'qwerty',
            'Contract[buyer_id]' => 0,
            'Contract[description]' => '',
        ]);
        $I->expectTo('see that contact number is wrong');
        $I->see('Number must be an integer.');
        $I->see('The format of Date is invalid.');
        $I->see('Amount must be a number.');
        $I->see('Seller must be an integer.');
        $I->see('Buyer is invalid.');
        $I->see('Description cannot be blank.');
    }

    public function updateContract(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/index']);
        $I->click('table tr:first-child > td:last-child > a[title=Update]');
        $I->expectTo('see update page');
        $I->see('Update Contract:');
        $I->submitForm('form', [
            'Contract[number]' => 184,
        ]);
        $I->see('Contract #184', 'h1');
    }

    public function deleteContract(\FunctionalTester $I)
    {
        $I->amOnPage(['contract/index']);
        $I->see('Contracts', 'h1');

        $contractsBegin = \app\models\Contract::find()->count();

        $var = $I->grabAttributeFrom('table tr:first-child > td:last-child > a[title=Delete]', 'href');
        $I->sendAjaxPostRequest($var);
        $I->see('Contracts', 'h1');

        $contractsEnd = \app\models\Contract::find()->count();

        $I->assertEquals($contractsBegin-1, $contractsEnd);

    }

    public function erasingAll()
    {
        \app\models\Contract::deleteAll();
        \app\models\Client::deleteAll();
    }

}
