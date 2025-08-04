<div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
    
    <table id="my-table" class="responsive-table min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Custo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo Custo</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fase da Obra</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidade</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Un.</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if($recipients): ?>
                <?php foreach($recipients as $recipient): ?>
                    <tr>
                        <td data-label="Nome" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $recipient->type_expenses; ?>
                        </td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->type_category; ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->steps_work; ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->unit; ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->amount; ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= str_price($recipient->price_unit); ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= str_price($recipient->total_value); ?>
                        </td>
                        <td data-label="Ações" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                            <div class="flex justify-end space-x-3">
                                <a href="<?= url("/editarcusto/{$recipient->id_type_category}/{$recipient->id_expenses}/{$recipient->id_work}/{$recipient->id_steps_work}/") . ($recipient->budget === "orçamento" ? 1 : 2) ?>">    
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">Ver</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
                <!-- <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sem dados.</td>
                </tr> -->
            <?php endif;?>
        </tbody>
    </table>
</div>