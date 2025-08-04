<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/gastomaterial") . (isset($editMaterial->id_expenses_material) ? "/" . $editMaterial->id_expenses_material  : ""); ?>" class="space-y-6">
    <?= csrf_input(); ?>
    <div class="space-y-4">
        <!-- Seção de Dados Pessoais -->
        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Fase da obra: <?= $stepWork->steps_work ?? null ?></h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Casa na árvore</p>
        </div>
        
        <input type="hidden" value="<?= $idStepWorker ?? null ?>" name="id-step-work">
        <input type="hidden" value="<?= $idWork ?? null ?>" name="id-work">
        <input type="hidden" value="<?= $budget ?? null ?>" name="id-budget">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="material" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Material *</label>
                <select id="material" name="material"  class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=""></option>
                    <?php foreach($material as $materialItem): ?>
                        <option value="<?= $materialItem->id_costs_material; ?>" <?= ($editMaterial->id_costs_material ?? null) == "{$materialItem->id_costs_material}" ? "selected" : "" ?>><?= $materialItem->name_material; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidade *</label>
                <select id="unit" name="unit" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=>Selecione</option>
                    <?php foreach($unit as $unitItem): ?>
                        <option value="<?= $unitItem->id_unit; ?>" <?= ($editMaterial->unit ?? null) == "{$unitItem->id_unit}" ? "selected" : ""?>><?= $unitItem->abbreviation; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="amount-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantidade *</label>
                <input type="number" step="0.1" id="amount-work" name="amount-work" value="<?= $editMaterial->amount ?? null; ?>" placeholder="1,00"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="price-unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Valor Unidade *</label>
                <input type="text" id="price-unit" name="price-unit" value="<?= $editMaterial->price_unit ?? null; ?>" placeholder="R$ 0,00"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="price-total" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total</label>
                <input type="text" id="price-total" disabled value="R$ 0,00" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

        </div>

        <!-- Seção de Observações -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detalhes do custo</h3>
        </div>
        
        <div>
            <label for="detail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detalhes</label>
            <textarea id="detail" name="detail" rows="3"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"><?= $editMaterial->detail_expense_material ?? null; ?></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?? null ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?= !empty($editMaterial->id_expenses_material) ? "Atualizar Custo" : "Cadastrar Custo"; ?>
        </button>   
    </div> 
</form>

<?php if(isset($editMaterial->id_expenses_material) && !empty($editMaterial->id_expenses_material)): ?>                
    
    <form action="<?= url("/confirmardeletargastos/{$category}/{$editMaterial->id_expenses_material}/{$budget}/{$idWork}"); ?>" method="post">
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