// verifica os campos e converte para moeda corrente
fncFormatPrice("price-unit");
fncFormatPrice("price-contract");
fncFormatPrice("price-dail-rentalt");
fncFormatPrice("price-unit-tool");
fncFormatPrice("price-service-administrative");
fncAmoutToUnit("price-unit", "amount-work", "price-total");
fncAmoutToUnit("price-unit-tool", "amount-tool", "price-total");

// Cálculo o a quantidade vezes o valor por unidade 
function fncAmoutToUnit(vPriveUnit, vAmountFnc, vPriceTotal) {

    const vPrive = document.getElementById(vPriveUnit);
    const vAmo = document.getElementById(vAmountFnc);
    // const vPrice = document.getElementById(vPriceTotal);

    if(vPrive || vAmo) {
        const vPrice = document.getElementById(vPriveUnit).value || 0;
        let vUnitPrice = 0;
        if(vPrice != 0) {
            vUnitPrice = cleanMaskMoney(vPrice) || 0;
        }
        const vAmount = parseFloat(document.getElementById(vAmountFnc).value) || 0;
        const vTotal = vUnitPrice * vAmount;
        const formatValue = vTotal.toLocaleString('pt-BR', {
            style: 'currency',
            currency:  'BRL'
        });

        const vValueTotal = document.getElementById(vPriceTotal);
        vValueTotal.value = formatValue;
    }

    document.addEventListener("change", (e) => {
        if (e.target.id === vPriveUnit || e.target.id === vAmountFnc) {
            const vPrice = document.getElementById(vPriveUnit).value || 0;
            let vUnitPrice = 0;
            if(vPrice != 0) {
                vUnitPrice = cleanMaskMoney(vPrice) || 0;
            }
            const vAmount = parseFloat(document.getElementById(vAmountFnc).value) || 0;
            const vTotal = vUnitPrice * vAmount;
            const formatValue = vTotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency:  'BRL'
            });

            const vValueTotal = document.getElementById(vPriceTotal);
            vValueTotal.value = formatValue;
        }
    })
}

// Cálculo o a quantidade vezes o valor por aluguel de equipamento
function fncAmoutToUnitRental(vPriveUnit, vAmountFnc,vPriceTotal, vDateStart, vDateEnd) {
        
    if (vPriveUnit || vAmountFnc || vDateStart || vDateEnd) {
            const vPrice = document.getElementById(vPriveUnit).value || 0;
            let vUnitPrice = 0;

            if(vPrice != 0) {
                vUnitPrice = cleanMaskMoney(vPrice) || 0;
            }

            const vAmount = parseFloat(document.getElementById(vAmountFnc).value) || 0;
            const vTotal = vUnitPrice * vAmount;
            const formatValue = vTotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency:  'BRL'
            });

            const vValueTotal = document.getElementById(vPriceTotal);
            vValueTotal.value = formatValue;
        }    
    document.addEventListener("change", (e) => {
        if (e.target.id === vPriveUnit || e.target.id === vAmountFnc || vDateStart || vDateEnd) {
            
            const vPrice = document.getElementById(vPriveUnit).value || 0;
            let vUnitPrice = 0;

            if(vPrice != 0) {
                vUnitPrice = cleanMaskMoney(vPrice) || 0;
            }

            const vAmount = parseFloat(document.getElementById(vAmountFnc).value) || 0;
            const vTotal = vUnitPrice * vAmount
            const formatValue = vTotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency:  'BRL'
            });

            const vValueTotal = document.getElementById(vPriceTotal);
            vValueTotal.value = formatValue;
        }
    })
}

// formar máscara de valor
function fncFormatPrice(vIdInput) {

    const vElemente = document.getElementById(vIdInput);

    if(vElemente) {
            let vCurrentValue = vElemente.value.replace(/\D/g, "") || 0;
            vCurrentValue = (parseInt(vCurrentValue, 10) / 100).toFixed(2);
            vCurrentValue = vCurrentValue.replace(".", ",").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            if(vElemente.value === "") {
                vElemente.placeholder = "R$ 0,00";
            } else {
                vElemente.value = "R$ " + vCurrentValue;
            }
    }

    document.addEventListener("input", function(e) {
        if(e.target.id === vIdInput){
            let vCurrentValue = e.target.value.replace(/\D/g, "") || 0;
            vCurrentValue = (parseInt(vCurrentValue, 10) / 100).toFixed(2);
            vCurrentValue = vCurrentValue.replace(".", ",").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            if(e.target.value === "") {
                e.target.placeholder = "R$ 0,00";
            } else {
                e.target.value = "R$ " + vCurrentValue;
            }
        }
    });
}


// Limpar formatação e substituir caracteres
function cleanMaskMoney(vValue) {
    // Remove "R$", pontos e substitui vírgula por ponto
    return parseFloat(
        vValue.replace("R$", "")
            .replace(/\./g, "")
            .replace(",", ".")
            .trim()
    );
}

// Calcular quantidade de dias entre datas do aluguel de equipamento
document.addEventListener("input", (e) => {

    if(e.target.id === "date-start-rental" || e.target.id === "date-end-rental") {
        
        let vStartDate = new Date(document.getElementById("date-start-rental").value);
        let vEndDate = new Date(document.getElementById("date-end-rental").value);

        const vDif = vEndDate - vStartDate

        if(!isNaN(vDif)) {
            const vDays = Math.floor(vDif / (1000 * 60 * 60 *24));
            document.getElementById("days-use").value = vDays;
            fncAmoutToUnitRental("price-dail-rentalt", "days-use", "price-total-rental","date-start-rental","date-end-rental");
        } else {
            document.getElementById("days-use").value = 0;
        }
    }
});

// Ao carregar calcular a quantidade de dias entre datas do aluguel de equipamento
const vDateStart = document.getElementById("date-start-rental");
const vDateEnd = document.getElementById("date-end-rental");

if(vDateStart || vDateEnd) {
    
    let vStartDate = new Date(document.getElementById("date-start-rental").value);
    let vEndDate = new Date(document.getElementById("date-end-rental").value);

    const vDif = vEndDate - vStartDate

    if(!isNaN(vDif)) {
        const vDays = Math.floor(vDif / (1000 * 60 * 60 *24));
        document.getElementById("days-use").value = vDays;
        fncAmoutToUnitRental("price-dail-rentalt", "days-use", "price-total-rental","date-start-rental","date-end-rental");
    } else {
        document.getElementById("days-use").value = 0;
    }
}


// DataTable
if(document.getElementById("my-table")) {
    $(document).ready( function () {
        $('#my-table').DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "Nenhum registro encontrado",
                "zeroRecords": "Nenhum resultado encontrado para sua pesquisa",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "search": "Pesquisar:",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(Filtrados de _MAX_ registros)",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            }
        });
    });
}

// Caixa select de lista de mão de obras
if(document.getElementsByClassName("select").length > 0) {

    $(document).ready(function() {
        $('.select').select2({
            placeholder: "Selecione uma opção",
            language: {
                noResults: function() {
                    return "Nenhum resultado encontrado para sua pesquisa";
                },
                searching: function() {
                    return "Pesquisando..."
                },
                inputTooShort: function(args) {
                    return "Digite pelo menos " + args.minimum + " caracteres";
                }
            }
        });
    });
}

// Mudar os campos quando selecionar forma de trabalho (diária e empreita)
document.addEventListener("input", (e) => {
    // Remover os campos e valores
    if(e.target.id === "format-labor") {
        
        if(e.target.value === "") {
            const vElement = document.querySelectorAll("div.daily");
            vElement.forEach((e) => {
                e.hidden = true

                const vLabel = e.querySelector("label.requerid-alert");
                if (vLabel) {
                    vLabel.classList.add("hidden");
                    vLabel.classList.remove("requerid-alert");
                    vLabel.nextElementSibling.classList.remove("requerid-alert");
                }

            })

            document.getElementById("amount-work").value = "";
            document.getElementById("price-unit").value = "";
            document.getElementById("price-total").value = "";

            document.querySelector("div.contract").hidden = true
            document.getElementById("price-contract").value = "";

            const vLementLabel = document.querySelectorAll("div.contract");
            vLementLabel.forEach((e) => {
                const vElementLabel = e.querySelector("label.requerid-alert");
                if(vElementLabel) {

                    vElementLabel.classList.add("hidden");
                    vElementLabel.classList.remove("requerid-alert");
                    vElementLabel.nextElementSibling.classList.remove("requerid-alert");
                }
            })
        }

        // Tornar os campos da diária visível 
        if(e.target.value === "DIARIA") {

            const vElement = document.querySelectorAll("div.daily");
            vElement.forEach((e) => {
                e.hidden = false;
                const vLabel = e.querySelector("label.hidden");
                if (vLabel) {
                    vLabel.classList.remove("hidden");
                }
            })
            document.querySelector("div.contract").hidden = true;
            document.getElementById("price-contract").value = "";

            const vLementLabel = document.querySelectorAll("div.contract");
            vLementLabel.forEach((e) => {
                const vElementLabel = e.querySelector("label.requerid-alert");
                if(vElementLabel) {

                    vElementLabel.classList.add("hidden");
                    vElementLabel.classList.remove("requerid-alert");
                    vElementLabel.nextElementSibling.classList.remove("requerid-alert");
                }
            })
        } 
        
        // Tornar o campo valor da empreita visível
        if(e.target.value === "EMPREITA") {

            const vElement = document.querySelectorAll("div.daily");
            vElement.forEach((e) => {
                e.hidden = true

                const vLabel = e.querySelector("label.requerid-alert");
                if (vLabel) {
                    vLabel.classList.add("hidden");
                    vLabel.classList.remove("requerid-alert");
                    vLabel.nextElementSibling.classList.remove("requerid-alert");
                }

            })
            document.getElementById("amount-work").value = "";
            document.getElementById("price-unit").value = "";
            document.getElementById("price-total").value = "";
            
            document.querySelector("div.contract").hidden = false;
            const vLementLabel = document.querySelectorAll("div.contract");
            vLementLabel.forEach((e) => {
                const vElement = e.querySelector("label.hidden");
                if(vElement) {
                    vElement.classList.remove("hidden");
                }
            })
        }
    }
})

// Ao carregar mostrar os campos (diária ou empreita)
const vFormatWork = document.getElementById("format-labor")
if(vFormatWork) {

    if(vFormatWork.value === "DIARIA") {
        const vElement = document.querySelectorAll("div.daily");
        vElement.forEach((e) => {
            e.hidden = false;
        })
    }
    
    if(vFormatWork.value === "EMPREITA") {
        const vLementLabel = document.querySelectorAll("div.contract");
        vLementLabel.forEach((e) => {
            e.hidden = false;
        })
    }   
}