<?php $this->layout("/forms/layout"); ?>

<form id="form" method="post" action="<?= url("/cadastrarcliente") . (isset($editClient->id_client) ? "/" . encrypt_data($editClient->id_client) : ""); ?>" class="space-y-6">
    <?= csrf_input(); ?>
    <div class="space-y-4">
        <!-- Seção de Dados Pessoais -->
        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Dados Pessoais</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="name-client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome completo *</label>
                <input 
                    type="text" 
                    id="name-client" 
                    name="name-client" 
                    placeholder="Joãzinho"
                    value="<?= $editClient->name_client ?? null ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CPF *</label>
                <input type="text" 
                    id="cpf" 
                    name="cpf"
                    placeholder="111.222.333-44"
                    data-validadecpf="<?= url("/validatecpf")?>"
                    value="<?= formatCPF($editClient->cpf_client ?? "") ?? null ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="gender-client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gênero *</label>
                <select id="gender-client" name="gender-client"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=>Selecione</option>
                    <option value="MASCULINO" <?= ($editClient->gender ?? "") === "MASCULINO" ? "selected" : "" ?>>Masculino</option>
                    <option value="FEMININO" <?= ($editClient->gender ?? "") === "FEMININO" ? "selected" : "" ?>>Feminino</option>
                    <option value="OUTRO" <?= ($editClient->gender ?? "") === "OUTRO" ? "selected" : "" ?>>Outro</option>
                    <option value="NAO INFORMADO" <?= ($editClient->gender ?? "") === "NAO INFORMADO" ? "selected" : "" ?>>Prefiro não informar</option>
                </select>
            </div>
        </div>

        <!-- Seção de Contato -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informações de Contato</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-mail</label>
                <input type="email" id="email" name="email" value="<?= $editClient->email_client ?? null ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telefone *</label>
                <input type="tel" id="telephone" name="telephone" value="<?= $editClient->contact_client ?? null ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div class="sm:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Endereço *</label>
                <input type="text" id="address" name="address" value="<?= $editClient->address_client ?? null ?>"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="sm:col-span-2">
                <label for="location-client" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bairro *</label>
                <select id="location-client" name="location-client"
                    class="select w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value=>Selecione</option>
                    <?php foreach($locationAddress as $locationAddressItem): ?>    
                        <option value="<?= $locationAddressItem->id_location_address; ?>" <?= ($editClient->id_location_client ?? null) == "{$locationAddressItem->id_location_address}" ? "selected" : "" ?>><?= $locationAddressItem->location ?? null ?></option>
                    <?php endforeach;?>
                </select>
            </div>

        </div>

    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="<?= $default->url ?>" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button name="btn-form" value="created" type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            <?=  isset($editClient->id_client) ? "Atualizar" : "Cadastrar Cliente"; ?>
        </button>

        <?php if(isset($editClient->id_client) && !empty($editClient->id_client)): ?>                
        
            <!-- <form action="<?= url("/confirmardeletargastos/{$editClient->id_client}"); ?>" method="post"> -->
                <button name="btn-form" value="delete" type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-red-800 inline-flex justify-center items-center transition-colors">
                    Excluir
                </button>
            <!-- </form> -->

        <?php endif; ?>
    </div>
</form>

<?php $this->start("scripts") ?>
    <script src="<?= theme("/assets/js/works/mask.js", CONF_VIEW_APP)?>"></script>
<?php $this->stop() ?>