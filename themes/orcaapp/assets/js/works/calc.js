// verifica os campos e converte para moeda corrente
document.addEventListener("change", (e) => {
    if (e.target.id === "unitPrice" || e.target.id === "amount") {
    
        const vPrice = document.getElementById("unitPrice").value;
        const vUnitPrice = cleanMaskMoney(vPrice) || 0;
        
        const vAmount = parseFloat(document.getElementById("amount").value) || 0;

        const vTotal = vUnitPrice * vAmount;

        const formatValue = vTotal.toLocaleString('pt-BR', {
            style: 'currency',
            currency:  'BRL'
        });

        const vValueTotal = document.getElementById("valueTotal");
        vValueTotal.value = formatValue;
    }
})

document.addEventListener("input", function(e) {
    if(e.target.id === "unitPrice"){
        let vCurrentValue = e.target.value.replace(/\D/g, "");
        vCurrentValue = (parseInt(vCurrentValue, 10) / 100).toFixed(2);
        vCurrentValue = vCurrentValue.replace(".", ",").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        e.target.value = "R$ " + vCurrentValue;
    }
});

function cleanMaskMoney(vValue) {
    // Remove "R$", pontos e substitui vírgula por ponto
    return parseFloat(
        vValue.replace("R$", "")
            .replace(/\./g, "")
            .replace(",", ".")
            .trim()
    );
}

// DataTable
$(document).ready( function () {
    $('#my-table').DataTable({
        "pageLength": 10,
        "language": {
            "search": "Pesquisar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrando de _MAX_ entradas no total)",
            "paginate": {
                "first": "Primeiro",
                "last": "Último",
                "next": "Próximo",
                "previous": "Anterior"
            }
        }
    });
} );