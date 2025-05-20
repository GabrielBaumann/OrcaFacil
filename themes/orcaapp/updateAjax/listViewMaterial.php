<?php if($materialWorks): ?>
    <div class="responsive-table-modal h-64" style="max-height: 290px; overflow-y: auto;">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 sticky top-0">
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
                            <?= str_replace(".", ",", $materialWork->amount) ?>
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
    </div>
<?php else:?>
<div>Não existe material...</div>
<?php endif; ?>
