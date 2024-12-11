<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Preçário</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">Preço</th>
                    <th style="width: 1%" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php use yii\helpers\Html;

                foreach ($valores as $valor): ?>
                    <tr>
                        <td><?= Html::encode($valor->valor) ?>€</td>
                        <td class="project-actions text-center">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['valor/show', 'id' => $valor->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['valor/update', 'id' => $valor->id], ['class' => 'btn btn-info btn-sm']) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <p class="text-center">
        <?= Html::a('Criar novo preço', ['valor/create'], ['class' => 'btn btn-info']) ?>
    </p>
</section>