<div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
    <table id="my-table" class="responsive-table min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome Obra</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Obra</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if($recipients): ?>
                <?php foreach($recipients as $recipient): ?>
                    <tr>
                        <td data-label="Nome" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <?= $recipient->name_client; ?>
                        </td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->name_work; ?>
                        </td>
                        <td data-label="Telefone" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= $recipient->status; ?>
                        </td>
                        <td data-label="Ações" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                            <div class="flex justify-end space-x-3">
                                <a href="<?= url("/clienteobra/{$recipient->id_work}/1")?>">    
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">Orçamento</button>
                                </a>
                                <a href="<?= url("/clienteobra/{$recipient->id_work}/2")?>">    
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">Custos</button>
                                </a>
                                <a href="<?= url("/editarobra/{$recipient->id_work}")?>">    
                                    <button class="text-purple-600 hover:text-purple-800 font-medium">Editar</button>
                                </a>    
                                    <button data-urlexpense="<?= url("/excluirobra/{$recipient->id_work}")?>" class="text-purple-600 hover:text-purple-800 font-medium">Excluir</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else:?>
            <?php endif;?>
        </tbody>
    </table>
</div>