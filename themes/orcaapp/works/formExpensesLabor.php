<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/gastomaodeobra") . (isset($editLabor->id_expenses_labor) ? "/" . $editLabor->id_expenses_labor : ""); ?>" class="space-y-6">
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
                <label for="labor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mão de Obra *</label>
                <select id="labor" name="labor"  class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=""></option>
                    <?php foreach($labor as $laborItem): ?>
                        <option value="<?= $laborItem->id_costs_labor; ?>" <?= ($editLabor->id_costs_labor ?? null) == "{$laborItem->id_costs_labor}" ? "selected" : "" ?>><?= $laborItem->name_labor ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="sm:col-span-2">
                <label for="name-labor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome </label>
                <input type="text" id="name-labor" name="name-labor" value="<?= $editLabor->name_employee ?? null; ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="sm:col-span-2">
                <label for="format-labor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Forma de Trabalho *</label>
                <select id="format-labor" name="format-labor" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=>Selecione</option>
                    <option value="DIARIA" <?= ($editLabor->format_work ?? "") === "DIARIA" ? "selected" : "" ?>>Diaria</option>
                    <option value="EMPREITA" <?= ($editLabor->format_work ?? "") === "EMPREITA" ? "selected" : "" ?>>Empreita</option>
                </select>
            </div>

            <div hidden class="daily">
                <label for="amount-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 hidden">Quantidade de Diarias *</label>
                <input type="number" step="0.1" id="amount-work" name="amount-work" placeholder="0,0" value="<?= $editLabor->days_worked ?? null; ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div hidden class="daily">
                <label for="price-unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 hidden">Valor diária *</label>
                <input type="text" id="price-unit" name="price-daily" placeholder="R$ 0,00" value="<?= $editLabor->value_daily ?? null; ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div hidden class="daily">
                <label for="price-total" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total</label>
                <input type="text" id="price-total" disabled value="R$ 0,00" placeholder="R$ 0,00" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div hidden class="contract">
                <label for="price-contract" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 hidden">Valor Empreita *</label>
                <input type="text" id="price-contract" name="price-contract" placeholder="R$ 0,00" value="<?= $editLabor->contract_value ?? null; ?>"
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
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"><?= $editLabor->detail_expenses_labor ?? null; ?></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?? null ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?= !empty($editLabor->id_expenses_labor) ? "Atualizar Custo" : "Cadastrar Custo"; ?>
        </button>
    </div>
</form>

<?php if(isset($editLabor->id_expenses_labor) && !empty($editLabor->id_expenses_labor)): ?>                
    
    <form action="<?= url("/confirmardeletargastos/{$category}/{$editLabor->id_expenses_labor}/{$budget}/{$idWork}"); ?>" method="post">
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