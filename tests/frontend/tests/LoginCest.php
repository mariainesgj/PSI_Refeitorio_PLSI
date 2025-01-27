<?php

declare(strict_types=1);


namespace frontend\tests;

use \FrontendTester;

final class LoginCest
{
    public function _before(FrontendTester $I): void
    {
        $I->amOnRoute('frontend/site/login');
    }

    public function tryLoginCorrectly(\FrontendTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('Username' , 'mariaines');
        $I->fillField('Password' , 'maria123456789');
        $I->click('Enter');

        $I->seeCurrentUrlEquals('/site/index');

    }

    public function trySubmitFormWrongUsername(\FrontendTester $I){
        $nomeIvalido = 'tfjugaiehrlgou';

        $I->amOnPage('frontend/site/login');
        $I->see('Login');
        $I->fillField('input[name="User[name]"]', $nomeIvalido);
        $I->fillField('input[name="User[password]"]', 'gbreuiaopghneiu');

        $I->submitForm('#login-form', []);
        $I->seeCurrentUrlEquals('frontend/site/login');
        $I->dontSeeElement('.success-message');
    }

    public function trySubmitFormWrongPassword(\FrontendTester $I){
        $passwordInvalida = 'gbreuiaopghneiu';

        $I->amOnPage('frontend/site/login');
        $I->see('Login');
        $I->fillField('input[name="User[name]"]', 'tfjugaiehrlgou');
        $I->fillField('input[name="User[password]"]', $passwordInvalida);

        $I->submitForm('#login-form', []);
        $I->seeCurrentUrlEquals('backend/site/login');
        $I->dontSeeElement('.success-message');
    }

}
