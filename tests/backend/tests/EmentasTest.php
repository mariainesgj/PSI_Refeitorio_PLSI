<?php

namespace backend\tests;

use app\models\Ementa;
use Yii;


class EmentasTest extends \Codeception\Test\Unit
{
    protected $tester;

    public function testCriarEmentaDadosCorretos()
    {
        $ementa = new Ementa([
            'data' => '2025-01-31 00:00:00',
            'prato_normal' => 2,
            'prato_vegetariano' => 21,
            'sopa' => 16,
            'cozinha_id' => 1
        ]);

        $this->assertTrue($ementa->validate(), 'Os dados inseridos para a ementa são válidos.');
        $this->assertTrue($ementa->save(), 'Ementa foi guardada corretamente na base de dados.');

        $ementa = Ementa::find()->where(['data' => '2025-01-31 00:00:00', 'cozinha_id' => 1])->one();
        $this->assertNotNull($ementa, 'A ementa foi encontrada no banco de dados.');
    }

    public function testCriarEmentaDadosIncorretos()
    {
        $ementa = new Ementa([
            'data' => null,
            'prato_normal' => "2",
            'prato_vegetariano' => "Legumes Salteados",
            'sopa' => 16,
            'cozinha_id' => "1"
        ]);

        $this->assertFalse($ementa->validate(), 'Os dados inseridos para a ementa não são válidos.');
        $this->assertFalse($ementa->save(), 'A ementa não foi guardada na base de dados.');
    }

    public function testMostrarEmenta()
    {
        $this->testCriarEmentaDadosCorretos();
        $ementa = Ementa::find()->where(['data' => '2025-01-31 00:00:00', 'cozinha_id' => 1])->one();

        $this->assertNotNull($ementa, 'O registo para a ementa foi encontrado na base de dados.');
    }

    public function testAtualizarEmenta()
    {
        $this->testCriarEmentaDadosCorretos();
        $ementa = Ementa::find()->where(['data' => '2025-01-31 00:00:00', 'cozinha_id' => 1])->one();

        $this->assertNotNull($ementa, 'O registo para a ementa foi encontrado na base de dados.');

        $ementa->prato_normal = 11;
        $this->assertTrue($ementa->save(), 'A ementa foi atualizada e atualizada com sucesso.');
    }

    public function testApagarEmenta()
    {
        $this->testCriarEmentaDadosCorretos();
        $ementa = Ementa::find()->where(['data' => '2025-01-31 00:00:00', 'cozinha_id' => 1])->one();

        $this->assertNotNull($ementa, 'A ementa foi encontrada na base de dados.');

        $ementa_id = $ementa->id;

        $ementa->delete();
        $this->assertNull(Ementa::findOne($ementa_id), 'A ementa foi apagada da base de dados.');
    }

    protected function _after()
    {
        Ementa::deleteAll(['data' => '2025-01-31 00:00:00', 'cozinha_id' => 1]);
    }
}
