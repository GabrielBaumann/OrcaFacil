<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/gastoaluguelequipamento") . (isset($editRentalEquipment->id_expenses_rental_equipment) ? "/" . $editRentalEquipment->id_expenses_rental_equipment : ""); ?>" class="space-y-6">
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
                <label for="equipment-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Equipamento *</label>
                <select id="equipment-rental" name="equipment-rental"  class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=""></option>
                    <?php foreach($retalEquipment as $retalEquipmentItem): ?>
                        <option value="<?= $retalEquipmentItem->id_costs_rental_equipment; ?>" <?= ($editRentalEquipment->id_costs_rental_equipment ?? null) == "{$retalEquipmentItem->id_costs_rental_equipment}" ? "selected" : "" ?>><?= $retalEquipmentItem->name_equipment; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="date-start-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data de Início *</label>
                <input type="date" id="date-start-rental" name="date-start-rental" value="<?= $editRentalEquipment->date_start ?? null ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="date-end-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data de Fim *</label>
                <input type="date" id="date-end-rental" name="date-end-rental" value="<?= $editRentalEquipment->date_end ?? null ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="days-use" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dias de uso</label>
                <input type="text" id="days-use" disabled value="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="price-dail-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Valor Diária *</label>
                <input type="text" id="price-dail-rentalt" name="price-dail-rental" value="<?= $editRentalEquipment->value_daily ?? null ?>"  placeholder="R$ 0,00"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="price-total-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total</label>
                <input type="text" id="price-total-rental" disabled value="R$ 0,00" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

        </div>

        <!-- Seção de Observações -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detalhes do custo</h3>
        </div>
        
        <div>
            <label for="detail-rental" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detalhes</label>
            <textarea id="detai-rentall" name="detail-rental" rows="3"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"><?= $editRentalEquipment->detail_equipment ?? null; ?></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?? null ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?= !empty($editRentalEquipment->id_expenses_rental_equipment) ? "Atualizar Custo" : "Cadastrar Custo"; ?>
        </button>
    </div>
</form>

<?php if(isset($editRentalEquipment->id_expenses_rental_equipment) && !empty($editRentalEquipment->id_expenses_rental_equipment)): ?>                
    
    <form action="<?= url("/confirmardeletargastos/{$category}/{$editRentalEquipment->id_expenses_rental_equipment}/{$budget}/{$idWork}"); ?>" method="post">
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