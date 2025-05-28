<?php $this->layout("layout"); ?>

<!-- Conteúdo Principal -->
<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">Usuários</h2>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Barra de Pesquisa -->
            <div class="flex items-center flex-grow sm:w-auto">
                <div class="relative flex-grow">
                    <input id="inputSearch" data-url="<?= url("/filter") ?>" name="s" type="text" class="block w-full pl-5 pr-3 py-2 border border-gray-300 rounded-l-lg bg-white placeholder-gray-500 sm:text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400" placeholder="Pesquisar...">
                </div>
            
                <!-- Botão pesquisar -->
                <button id="search" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 border border-l-0 border-gray-300 rounded-r-lg   transition-colors duration-200">
                    <svg id="search" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span class="sr-only">Pesquisar</span>
                </button>
            </div>
            <!-- Filtro -->
            <select id="selectData" data-url="<?= url("/filter") ?>" name="status" class="block w-full sm:w-auto pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg sm:text-sm bg-white">
                <option value="2">Todos</option>
                <option value="1">Ativos</option>
                <option value="0">Cancelado</option>
            </select>
            
            <!-- Botão Novo Cliente -->
            <a class="w-full sm:w-auto">
                <button data-modal="addModalUser" data-url="/orcafacil/newuser" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Novo Usuário
                </button>
            </a>
        </div>
    </div>
    <div id="updateList">
        <!-- Tabela Responsiva -->
        <?php $this->insert("/updateAjax/listSetingUser", ["usuarios" => $usuarios]) ?>
    </div>

</main>
<div id="modal"></div>
