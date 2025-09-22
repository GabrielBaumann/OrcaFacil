<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
  <link rel="stylesheet" href="<?= theme("/assets/css/message.css"); ?>">
</head>
<body class="h-screen flex flex-col md:flex-row bg-gray-100">

<!-- CONTENT -->

<?= $this->section("content"); ?>

<!-- Área visual -->
<div class="hidden md:flex flex-col justify-center items-center w-full md:w-1/2 bg-blue-50 p-8 text-center">
    <h1 class="text-5xl font-bold text-blue-700 mb-8">OrçaFácil</h1>
    <h2 class="text-2xl font-semibold text-blue-600 mb-4">Sistema de Orçamentos para Obras</h2>
    <p class="text-blue-600 text-base max-w-sm mb-8">
        Organize projetos, calcule custos e otimize suas construções com facilidade e precisão.
    </p>
    <img src="<?= theme("/assets/images/login_image.svg"); ?>" alt="Ilustração de construção" class="w-80">
</div>

<script src="<?= theme("/assets/js/forms.js"); ?>"></script>
</body>
</html>