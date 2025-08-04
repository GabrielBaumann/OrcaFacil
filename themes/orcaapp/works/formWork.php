<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/cadastrarobra") . (isset($editWorkClient->id_work) ? "/" . $editWorkClient->id_work : ""); ?>" class="space-y-6">
    <?= csrf_input(); ?>
    <div class="space-y-4">
        <!-- Seção de Dados Pessoais -->
        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Dados da Obra</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <?php if(isset($idClient) && !empty($idClient)): ?>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100"><?= $idClient->name_client; ?></h3>
                    <input type="hidden" name="client" value="<?= $idClient->id_client; ?>">
                </div>
            <?php else:?>
                <div>
                    <label for="client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cliente *</label>
                    <select id="client" name="client"
                        class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                        <option value=>Selecione</option>
                        <?php foreach($client as $clientIten): ?>
                            <option value="<?= $clientIten->id_client; ?>" <?= ($editWorkClient->id_client ?? null) == "{$clientIten->id_client}" ? "selected" : "" ?>><?= $clientIten->name_client; ?></option>
                        <?php endforeach; ?>    
                    </select>
                </div>
            <?php endif;?>

            <div>
                <label for="name-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome da Obra *</label>
                <input type="text" id="name-work" name="name-work" value="<?= $editWorkClient->name_work ?? null; ?>"
                    placeholder="Casa na praia, postinho de saúde..." 
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="sm:col-span-2">
                <label for="type-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo da obra *</label>
                <select id="type-work" name="type-work" class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=>Selecione</option>
                    <option value="CONSTRUÇÃO">Construção</option>
                    <option value="REFORMA">Reforma</option>
                    <option value="MANUTENÇÃO">Manutenção</option>
                </select>
            </div>
            
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Endereço *</label>
                <input type="text" id="address" name="address" value="<?= $editWorkClient->address_work ?? null; ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="sm:col-span-2">
                <label for="location-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bairro *</label>
                <select id="location-work" name="location-work" class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                <option value=>Selecione</option>
                    <?php foreach($location as $locationItem): ?>    
                        <option value="<?= $locationItem->id_location_address; ?>" <?= ($editWorkClient->id_location_work ?? null) == "{$locationItem->id_location_address}" ? "selected" : "" ?>><?= $locationItem->location; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="date-start-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data de Início Obra *</label>
                <input type="date" id="date-start-work" name="date-start-work" value="<?= isset($editWorkClient) && $editWorkClient ? date("Y-m-d", strtotime($editWorkClient->date_start)) : ""; ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="date-end-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data de Fim Obra *</label>
                <input type="date" id="date-end-work" name="date-end-work" value="<?= isset($editWorkClient) && $editWorkClient ? date("Y-m-d", strtotime($editWorkClient->date_end_forcast)) : ""; ?>"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

        </div>

        <!-- Seção de Observações -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Detalhes da obra</h3>
        </div>
        
        <div>
            <label for="detail-work" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detalhes</label>
            <textarea id="detail-work" name="detail-work" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"><?= $editWorkClient->detail_work ?? null; ?></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?? null ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?= !empty($editWorkClient->id_work) ? "Atualizar Cadastro" : "Cadastrar Obra"; ?>
        </button>
    </div>
</form>

<?= $this->start("scripts"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?= theme("/assets/js/works/calc.js", CONF_VIEW_APP)?>"></script>
<?= $this->stop("scripts"); ?>