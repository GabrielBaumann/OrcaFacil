<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
        <h4 class="text-lg font-semibold text-gray-800">Materiais Utilizados</h4>
    <?php if($materialWorks): ?>
        <button id="searchMaterial" data-url="<?= url("/seefilter") ?>" class="border border-gray-300">Pesquisar</button>
        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input name="inputSearch" id="inputSearch" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 text-sm" placeholder="Pesquisar materiais...">
        </div>
    </div>

    <div class="responsive-table-modal">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço Unitário</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach($materialWorks as $materialWork): ?>
                    <tr>
                        <td data-label="Material" class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $materialWork->material; ?>
                        </td>
                        <td data-label="Quantidade" class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $materialWork->amount; ?>
                        </td>
                        <td data-label="Preço Unitário" class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= str_price($materialWork->unit_price); ?>
                        </td>
                        <td data-label="Total" class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= str_price($materialWork->total_value); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else:?>
        <div>Não há materiais lançados</div>
    <?php endif; ?>
    </div>
</div>