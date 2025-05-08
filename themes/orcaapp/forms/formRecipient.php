<?php $this->layout("/forms/layout"); ?>

<form class="space-y-6">
    <div class="space-y-4">
        <!-- Seção de Dados Pessoais -->
        <div class="border-b border-gray-200 dark:border-gray-600 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Dados Pessoais</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome completo *</label>
                <input type="text" id="nome" name="nome" required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CPF *</label>
                <input type="text" id="cpf" name="cpf" required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="data-nascimento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data de Nascimento</label>
                <input type="date" id="data-nascimento" name="data-nascimento"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="genero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gênero</label>
                <select id="genero" name="genero"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                    <option value="nao-informar">Prefiro não informar</option>
                </select>
            </div>
        </div>

        <!-- Seção de Contato -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informações de Contato</h3>
        </div>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-mail *</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div>
                <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telefone *</label>
                <input type="tel" id="telefone" name="telefone" required
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>
            
            <div class="sm:col-span-2">
                <label for="endereco" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Endereço</label>
                <input type="text" id="endereco" name="endereco"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                <select id="estado" name="estado"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Selecione um estado</option>
                </select>
            </div>

            <div>
                <label for="cidade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cidade</label>
                <select id="cit" name="cit"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Selecione um estado</option>
                </select>
            </div>
    
        </div>

        <!-- Seção de Observações -->
        <div class="border-b border-gray-200 dark:border-gray-600 pt-6 pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Observações</h3>
        </div>
        
        <div>
            <label for="observacoes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Observações</label>
            <textarea id="observacoes" name="observacoes" rows="3"
                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white"></textarea>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
        <a href="index.html" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Cancelar
        </a>
        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 inline-flex justify-center items-center transition-colors">
            Salvar Cliente
        </button>
    </div>
</form>

<?php $this->start("scripts") ?>
    <script src="<?= theme("/assets/js/mask.js", CONF_VIEW_APP)?>"></script>
<?php $this->end() ?>