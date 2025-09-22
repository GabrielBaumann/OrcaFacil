<?php $this->layout("layout"); ?>

<!-- Formulário -->
<div class="flex flex-col justify-center items-center h-full w-full md:w-1/2 p-8 bg-white">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800">Seja bem-vindo de volta</h2>
        <p class="text-gray-500 text-sm mt-2">Gerencie seus orçamentos de obras de forma prática e eficiente.</p>
        </div>

        <a href="<?= url("/login"); ?>">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg font-semibold transition shadow-md">
                Fazer login
            </button>
        </a>
        <div>
            <a href="<?= url("/criarconta"); ?>">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg font-semibold transition shadow-md">
                    Crie sua conta agora!
                </button>
            </a>
        </div>
    </div>
</div>