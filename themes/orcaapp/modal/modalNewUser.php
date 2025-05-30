
<div id="detailModal" class="modal fixed inset-0 flex items-center justify-center z-50 px-4 bg-black bg-opacity-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Cadastrar Novo Usuário</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
                <!-- Body -->
            <form action="<?= url("/newuser") . (isset($user->id_usuarios) ? "/" . $user->id_usuarios : "") ?>" method="post">
                <?= csrf_input(); ?>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Entidade</label>
                        <input name="idEntidade" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->id_entidade ?? "" ?>"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input name="nome" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->nome ?? "" ?>"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                        <input name="telefone" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->telefone ?? "" ?>"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome Usuário</label>
                        <input name="usuario" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->usuario ?? "" ?>"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->email ?? "" ?>"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                        <input name="senha" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600"
                            value="<?= $user->senha ?? "" ?>"
                        >
                    </div>
                    <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                            <option value="1" <?= ($user->ativo ?? "1") == "1" ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= ($user->ativo ?? "1") == "0" ? 'selected' : '' ?>>Cancelado</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type Access</label>
                        <select name="typeAccess" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-primary-600">
                            <option value="admin" <?= ($user->type_access ?? "user") == "admin" ? 'selected' : '' ?>>admin</option>
                            <option value="user" <?= ($user->type_access ?? "user") == "user" ? 'selected' : '' ?>>user</option>
                            <option value="developer" <?= ($user->type_access ?? "user") == "developer" ? 'selected' : '' ?>>developer</option>
                        </select>
                    </div>       
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button id="closeModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg">
                        <?= (isset($user->id_usuarios) ? "Editar Usuário" : "Salvar Usuário"); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
