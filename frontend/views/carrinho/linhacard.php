<div class="col">
    <div class="card" style="min-height: 11vh">
        <div class="card-body">
            <div class="row" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-3 text-center">
                    <?php if ($item->prato_tipo === 'prato vegetariano'): ?>
                        <h6>
                            <img src="<?= Yii::getAlias('@web/images/folha.png') ?>" alt="Imagem ilustrativa"
                                 class="img-fluid" style="height: 4vh;">
                        </h6>
                    <?php elseif ($item->prato_tipo === 'prato normal'): ?>
                        <h6>
                            <img src="<?= Yii::getAlias('@web/images/talheres.png') ?>" alt="Imagem ilustrativa"
                                 class="img-fluid" style="height: 4vh;">
                        </h6>
                    <?php endif; ?>
                </div>

                <div class="col-6">
                    <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                        <?= Yii::$app->formatter->asDate($item->ementa_data, 'yyyy-MM-dd') ?>
                    </h6>
                    <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                        <?= $item->prato_nome ?>
                    </h6>
                    <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                        <?= $item->valor ?>€
                    </h6>
                </div>

                <div class="col-3 text-center">
                    <form id="delete-form-<?= $item->linha_id ?>" action="<?= \yii\helpers\Url::to(['linhascarrinho/delete', 'id' => $item->linha_id]) ?>" method="post" style="display: inline;">
                        <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <button type="button" onclick="confirmDelete(<?= $item->linha_id ?>)" style="background: none; border: none; padding: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24" height="24">
                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(itemId) {
        const form = document.getElementById('delete-form-' + itemId);
        if (confirm('Tem certeza que deseja remover este item?')) {
            form.submit();  // Submete o formulário para excluir o item
        }
    }
</script>
