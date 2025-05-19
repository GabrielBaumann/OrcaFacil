<div id="materialModal" class="modalNew fixed inset-0 flex items-center justify-center z-50 px-4 bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Cadastrar Novo Material</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <form id="form" action="<?= url("/registerMaterial")?>">

                <?= csrf_input(); ?>
                <input hidden id="idWork" name="idWork" type="text" value="<?= $idWork; ?>"> 
                <div class="p-6 space-y-4">
                <label class="block text-sm font-medium text-gray-700 mb-1"><?= $user->name_recipient; ?></label>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Material</label>
                        <input name="material" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600" rows="3"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Preço Unitário (R$)</label>
                            <input id="unitPrice" 
                                name="unitPrice" 
                                type="text" 
                                placeholder="R$ 0,00" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unidade de Medida</label>
                            <select name="selectAmount" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                                <option value="" selected>Selecione unidade</option>
                                <?php foreach($units as $unit): ?>
                                    <option value="<?= $unit->id_unit; ?>"><?= $unit->unit; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade</label>
                            <input 
                                id="amount" 
                                name="amount" 
                                type="number" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                                step="0.01" 
                                rows="3"></input>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Valor Total</label>
                            <input id="valueTotal" 
                                name="valueTotal" 
                                type="text" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600" 
                                rows="3" 
                                disabled></input>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button id="sendData" type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg">
                        Salvar Material
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>