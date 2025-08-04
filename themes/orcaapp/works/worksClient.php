<?php $this->layout("layout"); ?>
<div><?= flash(); ?></div>

<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <h1><?= (int)$budget === 1 ? "ORÇAMENTO" : "CUSTO" ?></h1>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800"><?= $clientWork->name_work; ?></h2>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <h2>Data de Início: <?= date_simple($clientWork->date_start); ?></h2>
            <h2>Data de Encerramento: <?= date_simple($clientWork->date_end_forcast); ?></h2>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800"><?= $clientWork->name_client; ?></h2>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <h2>Valor gasto: <?= str_price($expensesWorkTotal->expenses_work_total ?? 00); ?></h2>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">123.123.123-56</h2>
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <h2>Valor orçado: <?= str_price($budgetTotal->expenses_work_total ?? 00); ?></h2>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <!-- <h2 class="text-xl font-semibold text-gray-800">Obras</h2> -->
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Botão Novo Cliente -->
            <button data-urlexpense="<?= url("/selecionaretapa/{$clientWork->id_work}/1/{$budget}"); ?>" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Materiais
            </button>
        </div>

        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Botão Novo Cliente -->
            <button data-urlexpense="<?= url("/selecionaretapa/{$clientWork->id_work}/2/{$budget}"); ?>" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Mão de Obra
            </button>
        </div>

        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Botão Novo Cliente -->
            <button data-urlexpense="<?= url("/selecionaretapa/{$clientWork->id_work}/3/{$budget}"); ?>" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Aluguel de Equipamento
            </button>
        </div>

        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Botão Novo Cliente -->
            <button data-urlexpense="<?= url("/selecionaretapa/{$clientWork->id_work}/4/{$budget}"); ?>" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ferramentas
            </button>
        </div>

        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Botão Novo Cliente -->
            <button data-urlexpense="<?= url("/selecionaretapa/{$clientWork->id_work}/5/{$budget}"); ?>" class="w-full px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Custos Administrativos
            </button>
        </div>

    </div>

    <!-- Tabela Responsiva -->
    <div id="updateList">
        <?php $this->insert("/works/listExpensesWorks") ?>
    </div>
</main>



<?= $this->start("scripts"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?= theme("/assets/js/works/modal.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/default/default.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/works/calc.js", CONF_VIEW_APP) ?>"></script>
<?= $this->stop("scripts"); ?>



    