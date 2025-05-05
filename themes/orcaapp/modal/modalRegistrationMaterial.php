<div id="materialModal" class="hidden modal fixed inset-0 flex items-center justify-center z-50 px-4 bg-black bg-opacity-50">
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
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Material</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600" rows="3"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Preço Unitário (R$)</label>
                        <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unidade de Medida</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                            <option>Unidade</option>
                            <option>Metro</option>
                            <option>Quilograma</option>
                            <option>Litro</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button id="closeModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Cancelar
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg">
                    Salvar Material
                </button>
            </div>
        </div>
    </div>
</div>