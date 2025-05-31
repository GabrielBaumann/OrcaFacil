<?php $this->layout("layout"); ?>

<main class="flex-grow w-full max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-xl font-semibold text-gray-800">Relatórios e Estatísticas</h2>
        
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Filtro de Período -->
            <select class="block w-full sm:w-auto pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg sm:text-sm bg-white">
                <option>Últimos 30 dias</option>
                <option>Últimos 3 meses</option>
                <option>Últimos 6 meses</option>
                <option>Este ano</option>
                <option>Todos</option>
            </select>
            
            <!-- Botão Exportar -->
            <button class="w-full sm:w-auto px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Exportar Relatório
            </button>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card Total Obras -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total de Obras</p>
                    <p class="text-2xl font-semibold text-gray-800 mt-1">24</p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2"><span class="text-green-600 font-medium">+12%</span> em relação ao mês passado</p>
        </div>
        
        <!-- Card Valor Total -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Valor Total</p>
                    <p class="text-2xl font-semibold text-gray-800 mt-1">R$ 287.450,00</p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2"><span class="text-green-600 font-medium">+8%</span> em relação ao mês passado</p>
        </div>
        
        <!-- Card Obras Finalizadas -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Obras Finalizadas</p>
                    <p class="text-2xl font-semibold text-gray-800 mt-1">8</p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2"><span class="text-green-600 font-medium">+2</span> em relação ao mês passado</p>
        </div>
        
        <!-- Card Média por Obra -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Média por Obra</p>
                    <p class="text-2xl font-semibold text-gray-800 mt-1">R$ 11.977,08</p>
                </div>
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2"><span class="text-red-600 font-medium">-3%</span> em relação ao mês passado</p>
        </div>
    </div>

    <!-- Gráficos e Tabelas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Gráfico de Obras por Status -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm lg:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Obras por Status</h3>
            <div class="h-64">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        
        <!-- Tabela de Últimas Obras -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Últimas Obras</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Casa da Família Silva</p>
                        <p class="text-sm text-gray-500">R$ 15.200,00 • Em andamento</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Reforma Escola Municipal</p>
                        <p class="text-sm text-gray-500">R$ 42.500,00 • Finalizada</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Posto de Saúde</p>
                        <p class="text-sm text-gray-500">R$ 78.300,00 • Em andamento</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Casa Popular 42</p>
                        <p class="text-sm text-gray-500">R$ 12.750,00 • Aguardando</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Gastos por Categoria -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Gastos por Categoria de Materiais</h3>
        <div class="h-64">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>

    <!-- Tabela de Obras Recentes -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Obras Recentes</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obra</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beneficiário</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Início</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Casa Popular 42</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Maria da Silva</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Aguardando</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 12.750,00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/05/2023</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Posto de Saúde</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Prefeitura Municipal</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Em andamento</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 78.300,00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/04/2023</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Reforma Escola</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Secretaria de Educação</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Finalizada</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 42.500,00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/03/2023</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Casa Família Silva</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">José Silva</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Em andamento</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">R$ 15.200,00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20/05/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-500">Mostrando <span class="font-medium">1</span> a <span class="font-medium">4</span> de <span class="font-medium">24</span> obras</div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</main>

<script>
// Inicialização dos gráficos
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Status das Obras
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Em andamento', 'Finalizadas', 'Aguardando', 'Canceladas'],
            datasets: [{
                data: [12, 8, 3, 1],
                backgroundColor: [
                    '#3b82f6', // azul
                    '#10b981', // verde
                    '#f59e0b', // amarelo
                    '#ef4444'  // vermelho
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });

    // Gráfico de Gastos por Categoria
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: ['Hidráulica', 'Elétrica', 'Alvenaria', 'Pintura', 'Madeira', 'Outros'],
            datasets: [{
                label: 'Valor Gasto (R$)',
                data: [45000, 38000, 72000, 28500, 32000, 71950],
                backgroundColor: '#2563eb',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'R$ ' + context.raw.toLocaleString('pt-BR');
                        }
                    }
                }
            }
        }
    });
});
</script>