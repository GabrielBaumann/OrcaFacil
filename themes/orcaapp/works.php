<?php $this->layout("layout"); ?>

<div><?= flash(); ?></div>
<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">Beneficiários e obras</h2>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Barra de Pesquisa -->
            <div class="relative flex-grow sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    data-url="<?= url("/recipient"); ?>"
                    id="input-search"
                    name="input-search"
                    type="text" 
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 sm:text-sm" placeholder="Pesquisar...">
            </div>
            
            <!-- Filtro -->
            <!-- <select 
                data-url="<?= url("/recipient"); ?>"
                id="select-data"
                name="select-search"
                class="block w-full sm:w-auto pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg sm:text-sm bg-white">
                <option>Todos</option>
                <option>Ativos</option>
                <option>Inativos</option>
            </select> -->
            
            <!-- Botão Novo Cliente -->
            <a href="<?= url("/addrecipient"); ?>" class="w-full sm:w-auto">
                <button class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Novo Beneficiário
                </button>
            </a>
        </div>
    </div>

    <!-- Tabela Responsiva -->
    <div id="updateList">
        <?php $this->insert("/updateAjax/listWorksRecipient", ["recipients" => $recipients]) ?>
    </div>

</main>

<?= $this->start("scripts"); ?>
    <script src="<?= theme("/assets/js/works/modal.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/works/calc.js", CONF_VIEW_APP)?>"></script>
    <script src="<?= theme("/assets/js/works/forms.js", CONF_VIEW_APP)?>"></script>
<?= $this->stop("scripts"); ?>
<!-- Modal Simplificado para Cadastrar Material -->
<!-- Modal para Visualizar Detalhes -->
<!-- <div id="modal"></div> -->


    