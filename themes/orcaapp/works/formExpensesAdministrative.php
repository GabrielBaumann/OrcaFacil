<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/gastocustoadministrativo") . (isset($editAdministrative->id_expenses_administrative) ? "/" . $editAdministrative->id_expenses_administrative : ""); ?>" class="space-y-6">
    <?= csrf_input(); ?>
    <div class="space-y-4">
        <!-- Seção de Dados Pessoais -->
        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Fase da obra: <?= $stepWork->steps_work ?? null ?></h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Casa na árvore</p>
        </div>
        
        <input type="hidden" value="<?= $idStepWorker ?>" name="id-step-work">
        <input type="hidden" value="<?= $idWork ?>" name="id-work">
        <input type="hidden" value="<?= $budget ?? null ?>" name="id-budget">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="service-administrative" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Despesa Administrativa *</label>
                <select id="service-administrative" name="service-administrative"  class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=""></option>
                    <?php foreach($costsAdministrative as $costsAdministrativeItem): ?>
                        <option value="<?= $costsAdministrativeItem->id_costs_administrative; ?>"<?= ($editAdministrative->id_costs_administrative ?? null) == "{$costsAdministrativeItem->id_costs_administrative}" ? "selected" : "" ?>><?= $costsAdministrativeItem->name_administrative; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label for="price-service-administrative" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Valor da Despesa *</label>
                <input type="text" id="price-service-administrative" name="price-service-administrative" placeholder="R$ 0,00" value="<?= $editAdministrative->value_administrative ?? null ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

        </div>

        <!-- Seção de Observações -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detalhes do custo</h3>
        </div>
        
        <div>
            <label for="detail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detalhes</label>
            <textarea id="detail" name="detail" rows="3"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"><?= $editAdministrative->detail_administrative ?? null;?></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?? null ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?= !empty($editAdministrative->id_expenses_administrative) ? "Atualizar Custo" : "Cadastrar Custo"; ?>
        </button>
    </div>
</form>

<?php if(isset($editAdministrative->id_expenses_administrative) && !empty($editAdministrative->id_expenses_administrative)): ?>                
    
    <form action="<?= url("/confirmardeletargastos/{$category}/{$editAdministrative->id_expenses_administrative}/{$budget}/{$idWork}"); ?>" method="post">
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-red-800 inline-flex justify-center items-center transition-colors">
            Excluir
        </button>
    </form>

<?php endif; ?>

<?= $this->start("scripts"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?= theme("/assets/js/works/calc.js", CONF_VIEW_APP)?>"></script>
<?= $this->stop("scripts"); ?>