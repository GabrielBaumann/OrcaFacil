<?php $this->layout("layout"); ?>

<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">Unidades de medida</h2>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Barra de Pesquisa -->
            <div class="relative flex-grow sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    name="inputSearch"
                    id="inputSearch"
                    data-url="<?= url("/filterUnit") ?>"
                    type="text" 
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 sm:text-sm" 
                    placeholder="Pesquisar...">
                <input 
                    name="idRecipient"
                    id="idRecipient"
                    hidden
                    type="number"
                    value="<?= $idUser->id_usuarios ?>"
                >
            </div>
            <!-- Botão Novo -->
            <a href="<?= url("/cadUnit"); ?>" class="w-full sm:w-auto">
                <button class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nova unidade
                </button>
            </a>
        </div>
    </div>

    <!-- Tabela Responsiva -->
    <div id="updateListModal" >
        <?= $this->insert("/updateAjax/listUnit"); ?>
    </div>

    <!-- Paginação -->
    <!-- <div class="flex items-center justify-end mt-6">
        <div class="flex space-x-2">
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</main> -->