<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Yii::$app->formatter->asDate($item->ementa_data, 'yyyy-MM-dd') ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $item->prato_nome?></h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?= $item->valor?></h6>
            <a href="#" class="card-link">Remover</a>
        </div>
    </div>
</div>
