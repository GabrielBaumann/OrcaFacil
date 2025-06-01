<div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
    <table class="responsive-table min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if($recipients): ?>
                <?php foreach($recipients as $recipient): ?>
                    <tr>
                        <td data-label="Nome" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $recipient->name_recipient; ?>
                        </td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= formatCPF($recipient->cpf); ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->contact; ?>
                        </td>
                        <td data-label="Ações" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                            <div class="flex justify-end space-x-3">
                                <button data-modal="detailModal" data-url="/orcafacil/see/<?= $recipient->id_work_recipient; ?>" class="text-purple-600 hover:text-purple-800 font-medium">Ver</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sem dados.</td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
</div>
<!-- Paginação -->
<?= $paginator; ?>