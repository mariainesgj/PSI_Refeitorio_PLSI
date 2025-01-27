<?php


namespace backend\tests;

use app\models\Cozinha;
use \BackendTester;

class CozinhasTest extends \Codeception\Test\Unit
{

    protected BackendTester $tester;

    public function testCriarCozinhasDadosCorretos()
    {
        $cozinha = new Cozinha([
            'responsavel' => "Nome",
            'localizacao' => "Pombal",
            'designacao' => "Refeitório de Pombal",
            'telemovel' => "244156789",
        ]);

        $this->assertTrue($cozinha->validate(), 'Os dados inseridos para a cozinha são válidos.');
        $this->assertTrue($cozinha->save(), 'Cozinha foi guardada corretamente na base de dados.');

        $cozinha = Cozinha::find()->where(['responsavel' => 'Nome'])->one();
        $this->assertNotNull($cozinha, 'A cozinha foi encontrada na base de dados.');
    }

    public function testCriarCozinhaDadosIncorretos()
    {
        $cozinha = new Cozinha([
            'responsavel' => null,
            'localizacao' => "Pombal",
            'designacao' => "Refeitório de Pombal",
            'telemovel' => 244156789,
        ]);

        $this->assertFalse($cozinha->validate(), 'Os dados inseridos para a cozinha não são válidos.');
        $this->assertFalse($cozinha->save(), 'A cozinha não foi guardada na base de dados.');
    }

    public function testMostrarCozinha()
    {
        $this->testCriarCozinhasDadosCorretos();
        $cozinha = Cozinha::find()->where(['responsavel' => 'Nome'])->one();

        $this->assertNotNull($cozinha, 'O registo para a cozinha foi encontrado na base de dados.');
    }

    public function testAtualizarCozinha()
    {
        $this->testCriarCozinhasDadosCorretos();
        $cozinha = Cozinha::find()->where(['responsavel' => 'Nome'])->one();

        $this->assertNotNull($cozinha, 'O registo para a cozinha foi encontrado na base de dados.');

        $cozinha->localizacao = "Alcobaça";
        $this->assertTrue($cozinha->save(), 'A cozinha foi atualizada e atualizada com sucesso.');
    }

    public function testApagarEmenta()
    {
        $this->testCriarCozinhasDadosCorretos();
        $cozinha = Cozinha::find()->where(['responsavel' => 'Nome'])->one();

        $this->assertNotNull($cozinha, 'A cozinha foi encontrada na base de dados.');

        $cozinha_id = $cozinha->id;

        $cozinha->delete();
        $this->assertNull(Cozinha::findOne($cozinha_id), 'A cozinha foi apagada da base de dados.');
    }

    protected function _after()
    {
        Cozinha::deleteAll(['responsavel' => 'Nome']);
    }
}
