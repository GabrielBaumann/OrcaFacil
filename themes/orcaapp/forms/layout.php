<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($default['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                },
                extend: {
                    colors: {
                        primary: {
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
       
        
        /* Melhora a aparência dos inputs no mobile */
        input, select, textarea {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        /* Remove seta padrão do select */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        
    </style>
    <script src="<?= theme("/themes/orcaapp/assets/css/message.css", CONF_VIEW_APP)?>"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 flex flex-col min-h-screen font-sans pb-16 sm:pb-0">
    <!-- Primeiro Header com Logo e Botão Voltar -->
    <header class="h-16 border-b border-gray-200 dark:border-gray-600 px-4 sm:px-6 flex items-center justify-between sticky top-0 bg-white dark:bg-gray-800 z-10">
        <div class="flex items-center space-x-4">
            <a href="<?= $default['url'] ?>" class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div class="flex items-center space-x-2">
                <h1 class="text-xl font-semibold">OrçaFácil</h1>
            </div>
        </div>
        
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-grow w-full max-w-4xl mx-auto px-4 sm:px-6 py-6">
        <!-- Caminho (Breadcrumb) -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="<?= $default['url'] ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Início
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ml-2"><?= $default['titleForms'] ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Título do Formulário -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold"><?= $default['titleForms'] ?></h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1"><?= $default['textForms'] ?></p>
        </div>

        <!-- Formulário -->
        
        <?= $this->section("content"); ?>

    </main>
    <script src="<?= theme("/assets/js/forms.js", CONF_VIEW_APP)?>"></script>
    <?= $this->section("scripts") ?>
</body>
</html>