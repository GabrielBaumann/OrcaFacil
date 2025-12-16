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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
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
        <h1>Sessão finalizada</h1>
</body>
</html>
