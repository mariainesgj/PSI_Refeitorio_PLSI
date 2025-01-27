<?php

declare(strict_types=1);


namespace frontend\tests;

use \FrontendTester;

final class CompraSenhaCest
{
    public function _before(FrontendTester $I): void
    {
        $I->amOnPage('/frontend/senhas/create');
    }

    public function tryToTest(FrontendTester $I): void
    {
        // Write your tests here. All `public` methods will be executed as tests.
    }

    public function trySubmitEmptyForm(\FrontendTester $I){
        $I->submitForm('#w0', []);
        $I->see('user_id cannot be blank.');
    }

    public function trySubmitValidForm(\FrontendTester $I){

        $I->selectOption('select[name="Senha[data]"]', '2025-01-31 00:00:00');
        $I->fillField('input[name="Senha[consumido]"]', '0');
        $I->fillField('input[name="Senha[criado]"]', '2025-01-24 16:32:07');
        $I->fillField('input[name="Senha[alterado]"]', 'null');
        $I->fillField('input[name="Senha[descricao]"]', '');
        $I->fillField('input[name="Senha[user_id]"]', '1');
        $I->selectOption('select[name="Senha[ementa_id]"]', '47');
        $I->selectOption('select[name="Senha[prato_id]"]', '2');
        $I->selectOption('select[name="Senha[lido]"]', 'null');
        $I->selectOption('select[name="Senha[pago]"]', '1');
        $I->selectOption('select[name="Senha[valor]"]', '3.50');
        $I->selectOption('select[name="Senha[iva]"]', '23.00');
        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('frontend/site/index');
        $I->SeeElement('.success-message');
    }

    public function trySubmitInvalidValues(\FrontendTester $I){

        $I->selectOption('select[name="Senha[data]"]', 'null');
        $I->fillField('input[name="Senha[consumido]"]', '0');
        $I->fillField('input[name="Senha[criado]"]', 'null');
        $I->fillField('input[name="Senha[alterado]"]', 'null');
        $I->fillField('input[name="Senha[descricao]"]', '');
        $I->fillField('input[name="Senha[user_id]"]', '1000');
        $I->selectOption('select[name="Senha[ementa_id]"]', '1000');
        $I->selectOption('select[name="Senha[prato_id]"]', '2000');
        $I->selectOption('select[name="Senha[lido]"]', 'null');
        $I->selectOption('select[name="Senha[pago]"]', '-1');
        $I->selectOption('select[name="Senha[valor]"]', '-3.50');
        $I->selectOption('select[name="Senha[iva]"]', '-23.00');
        $I->submitForm('#w0', []);

        $I->seeCurrentUrlEquals('frontend/site/index');
        $I->dontSeeElement('.success-message');
    }


}
