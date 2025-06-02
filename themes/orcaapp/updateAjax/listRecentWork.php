<?php
use Source\Models\MaterialWork;
$material = new MaterialWork();
?>
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
            <?php if($recentWorks): ?>
                <?php foreach($recentWorks as $recent): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $recent->name_recipient ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $recent->name_recipient ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"><?= $recent->status_work ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= str_price($material->totalSpent($recent->id_work_recipient)->total ?? 00) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date_simple($recent->startdate) ?></td>
                    </tr>
                <?php endforeach;?>
            <?php else:?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Não há obras...</td>
                </tr>
            <?php endif;?>
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