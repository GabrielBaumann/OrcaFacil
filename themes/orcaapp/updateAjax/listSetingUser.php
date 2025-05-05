<!-- Tabela Responsiva -->
<div class="overflow-hidden rounded-lg border border-gray-200 bg-white">
    <table class="responsive-table min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Senha</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TypeAccess</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td data-label="Nome" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $usuario->id_usuarios; ?></td>
                        <td data-label="Nome" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $usuario->nome; ?></td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $usuario->senha; ?></td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $usuario->ativo ? "ATIVO": "CANCELADO"; ?></td>
                        <td data-label="CPF" class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $usuario->type_access; ?></td>
                        <td data-label="Ações" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                            <div class="flex justify-end space-x-3">
                                <button data-modal="addModalUser" data-url="/orcafacil/newuser/<?= $usuario->id_usuarios ?>" class="text-blue-600 hover:text-blue-800">Editar</button>
                                <!-- <button class="text-red-600 hover:text-red-800">CANCELAR</button> -->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
</div>