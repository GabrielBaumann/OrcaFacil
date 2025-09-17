<?php $this->layout("layout"); ?>

<div><?= flash(); ?></div>
<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">Clientes</h2>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">           
            <!-- Botão Novo Cliente -->
            <a href="<?= url("/cadastrarcliente"); ?>" class="w-full sm:w-auto">
                <button class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Configuração
                </button>
            </a>
        </div>
    </div>

    <!-- Tabela Responsiva -->
    <div id="updateList">

    </div>

</main>

<?= $this->start("scripts"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="<?= theme("/assets/js/works/modal.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/works/calc.js", CONF_VIEW_APP)?>"></script>
    <script src="<?= theme("/assets/js/works/forms.js", CONF_VIEW_APP)?>"></script>
<?= $this->stop("scripts"); ?>
<!-- Modal Simplificado para Cadastrar Material -->
<!-- Modal para Visualizar Detalhes -->
<!-- <div id="modal"></div> -->


    