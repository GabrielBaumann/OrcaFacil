<div id="detailModal" class="modal fixed inset-0 flex items-center justify-center z-50 px-4 bg-black bg-opacity-50 overflow-y-auto">
    <div class="bg-white w-full max-w-4xl rounded-lg shadow-lg my-8 max-h-[90vh] overflow-y-auto">
        <div class="modal-content">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white z-10">
                <h3 class="text-lg font-semibold text-gray-800">Detalhes do Beneficiário</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Informações do Beneficiário -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input name="idRecipient" type="number" hidden id="idRecipient" value="<?= $recipient->id_work_recipient; ?>">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Nome Completo</h4>
                        <p class="text-base text-gray-800"><?= $recipient->name_recipient; ?></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">CPF</h4>
                        <p class="text-base text-gray-800"><?= formatCPF($recipient->cpf); ?></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-1">Telefone</h4>
                        <p class="text-base text-gray-800"><?= mask_phone($recipient->contact); ?></p>
                    </div>
                </div>
                
                <!-- Resumo Financeiro -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Resumo Financeiro</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="text-sm font-medium text-gray-500">Total Gasto</h5>
                            <p class="text-2xl font-bold text-blue-600"><?=  str_price($totalSpent->total ?? 0); ?></p>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="text-sm font-medium text-gray-500">Quantidade de Materiais</h5>
                            <p class="text-2xl font-bold text-blue-600"><?= format_number($materialCount->totalAmount ?? 000); ?></p>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="text-sm font-medium text-gray-500">Data de Início</h5>
                            <p class="text-xl font-semibold text-blue-600"><?= $recipient->startdate ? date_simple($recipient->startdate) : "00/00/0000"; ?></p>
                        </div>
                    </div>
                </div>
                

                <!-- Lista de Materiais -->
                <div>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <h4 class="text-lg font-semibold text-gray-800">Materiais Utilizados</h4>
                        <div class="relative w-full sm:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input 
                                name="inputSearch" 
                                id="inputSearch"
                                data-url="<?= url("/seefilter") ?>"
                                type="text" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 text-sm" 
                                placeholder="Pesquisar materiais...">
                        </div>
                    </div>

                    <div id="updateListModal">
                        <?php $this->insert("/updateAjax/listViewMaterial", ["materialWorks" => $materialWorks])?>
                    </div>
            
                </div>
            </div>
            
            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3 sticky bottom-0 bg-white">
                <button class="px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Baixar Relatório em PDF
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg flex items-center justify-center">
                    Editar
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg flex items-center justify-center">
                    Excluir
                </button>
                <button 
                    data-modal="materialModal" data-url="/orcafacil/registerMaterial/<?= $recipient->id_work_recipient; ?>"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg flex items-center justify-center">
                    Cadastrar Material
                </button>
                <div class="flex flex-col sm:flex-row gap-3 sm:ml-auto">
                    
                </div>
            </div>
        </div>
    </div>
</div>