<?php $this->layout("/forms/layout"); ?>

<form id="form" action="<?= url("/cadUnit") . (isset($unit->id_unit) ? "/" . $unit->id_unit : ""); ?>" method="post" class="space-y-6">
    <?= csrf_input(); ?>
    <div class="space-y-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidade *</label>
                <input type="text" 
                    id="unit" 
                    name="unit" 
                    value="<?= $unit->unit ?? "" ?>"

                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="detalhe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Abreviação *</label>
                <input type="text" 
                    id="abbreviation" 
                    name="abbreviation"
                    value="<?= $unit->abbreviation ?? "" ?>" 

                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="detalhe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Observação</label>
                <input type="text" 
                    id="observation" 
                    name="observation"
                    value="<?= $unit->observation ?? "" ?>" 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
        </div>
        <!-- Botões de Ação -->
        <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4">
            <a href="<?= $default->url ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
                Cadastrar categoria
            </button>
        </div>
    </div>
</form>