<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_APP)?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/message.css", CONF_VIEW_APP)?>">
    <title><?= $this->e($title); ?></title>
    <!-- Adicionando a fonte Inter do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
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
        /* Garantindo que o modal fique visível no mobile */
        .modal {
            align-items: flex-start;
            padding-top: 2rem;
            padding-bottom: 2rem;
            overflow-y: auto;
        }
        
        /* Estilo para a tabela responsiva no modal */
        @media (max-width: 640px) {
            .responsive-table-modal {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .responsive-table-modal table {
                min-width: 100%;
            }
            
            .responsive-table-modal td:before {
                content: attr(data-label);
                font-weight: 500;
                display: inline-block;
                width: 6rem;
                color: #6b7280;
            }
        }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen font-sans pb-16 sm:pb-0">
    <!-- Primeiro Header -->
    <header class="h-14 bg-gray-100 sticky top-0 z-10">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 h-full flex items-center">
            <div class="flex items-center space-x-2 text-sm w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-gray-700"><?= $usuario ?></span>
            </div>
            
            <h1 class="text-lg font-semibold text-center w-1/3">OrçaFácil</h1>
            
            <div class="flex justify-end w-1/3">
                <a href="<?= url("/exit")?>">
                    <button class="text-sm flex items-center text-red-600 hover:text-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sair
                    </button>
                </a>
            </div>
        </div>
    </header>

    <!-- Segundo Header -->
    <header class="h-12 bg-gray-100 border-b border-gray-200 hidden sm:block">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 h-full flex justify-center">
            <nav class="flex items-stretch h-full">
                <a id="recipient"  href="<?= url("/recipient"); ?>" class="sidebar-menu flex items-center justify-center px-4 sm:px-6 h-full hover:bg-gray-50 text-gray-600 hover:text-gray-900">
                    <span class="text-sm">Obras</span>
                </a>
                <a id="unit" href="<?= url("/unit"); ?>" class="sidebar-menu flex items-center justify-center px-4 sm:px-6 h-full hover:bg-gray-50 text-gray-600 hover:text-gray-900">
                    <span class="text-sm">Unidades de medida</span>
                </a>
                <!-- <a href="../Categoria/index.html" class="flex items-center justify-center px-4 sm:px-6 h-full hover:bg-gray-50 text-gray-600 hover:text-gray-900">
                    <span class="text-sm">Categoria de materiais</span>
                </a> -->
                <a id="report" href="<?= url("/report"); ?>" class="sidebar-menu flex items-center justify-center px-4 sm:px-6 h-full hover:bg-gray-50 text-gray-600 hover:text-gray-900">
                    <span class="text-sm">Relatórios</span>
                </a>
                
                <?php if($typeAccess == "developer"): ?>
                    <a id="user" href="<?= url("/user"); ?>" class="sidebar-menu flex items-center justify-center px-4 sm:px-6 h-full hover:bg-gray-50 text-gray-600 hover:text-gray-900">
                        <span class="text-sm">Usuários</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    
    <?= $this->section("content"); ?>

    <!-- Mobile Bottom Navigation -->
    
    <?= $this->insert("mobileBottomNavigation"); ?>

    <script src="<?= theme("assets/js/default/verticalbar.js", CONF_VIEW_APP) ?>"></script>
    <?= $this->section("scripts"); ?>

</body>
</html>