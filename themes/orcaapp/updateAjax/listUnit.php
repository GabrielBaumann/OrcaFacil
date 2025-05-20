<?php if($units ?? ""): ?>
<div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
    <table class="responsive-table min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 hidden sm:table-header-group">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Abreviação</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach($units as $unit): ?>
                <tr class="block sm:table-row">
                    <td data-label="Nome" 
                        class="px-6 py-4 block sm:table-cell sm:whitespace-nowrap text-sm font-medium text-gray-900 before:content-[attr(data-label)] sm:before:content-none font-bold sm:font-normal">
                        <?= $unit->unit ?>
                    </td>
                    <td data-label="Abreviação" 
                        class="px-6 py-4 block sm:table-cell sm:whitespace-nowrap text-sm text-gray-600 before:content-[attr(data-label)] sm:before:content-none">
                        <?= $unit->abbreviation ?>
                    </td>
                    <td data-label="Ações" class="px-6 py-4 block sm:table-cell text-sm text-gray-500 sm:text-right before:content-[attr(data-label)] sm:before:content-none">
                        <div class="flex sm:justify-end space-x-3">
                            <a href="<?= url("/cadUnit/{$unit->id_unit}"); ?>">
                                <button class="text-blue-600 hover:text-blue-800">Editar</button>
                            </a>
                            <form action="<?= url("/deleteUnit/{$unit->id_unit}"); ?>">
                                <button class="text-red-600 hover:text-red-800">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
    <h1>Pesquisa não existente</h1>
<?php endif; ?>