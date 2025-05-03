<?php $this->layout("layout"); ?>

<!-- Formulário -->
<div class="flex flex-col justify-center items-center h-full w-full md:w-1/2 p-8 bg-white">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800">Seja bem-vindo de volta</h2>
        <p class="text-gray-500 text-sm mt-2">Gerencie seus orçamentos de obras de forma prática e eficiente.</p>
        </div>

        <form class="space-y-5" action="<?= url("/")?>" method="post">
        <div><?= flash(); ?></div>
        <?= csrf_input(); ?>
        <div>
            <label for="usuario" class="block text-sm font-medium text-gray-700">Usuário</label>
            <div class="flex items-center mt-1 border border-gray-200 rounded-lg bg-gray-50">
            <input id="usuario" type="text" name="user"
                class="w-full p-3 bg-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" placeholder="Digite seu usuário" />
            </div>
        </div>

        <div>
            <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
            <div class="flex items-center mt-1 mb-6 border border-gray-200 rounded-lg bg-gray-50">
            <input id="senha" type="password" name="password"
                class="w-full p-3 bg-transparent focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" placeholder="Digite sua senha" />
            </div>
        </div>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg font-semibold transition shadow-md">
                Entrar
            </button>
        </form>

    </div>
</div>