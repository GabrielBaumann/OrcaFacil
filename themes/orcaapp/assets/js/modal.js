// Abre modal baseado em modelos do plates
let currentModal = null;

// Função que recebe o endereço e devolve via ajax o modelo
function openModal(url, idModal) {
    
    let load;
    let timeoutLoading;

    // Agenda a exibição do "carregamento..." após 300 milesimo
    timeoutLoading = setTimeout(() => {
        load = document.createElement("div");
        load.id = "response";
        load.innerHTML = `
            <div class="alert-container space-y-3">
                <div class="alert-message bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="flex items-center p-4">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-circle-notch text-gray-500 text-lg animate-spin"></i>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-semibold text-gray-800">Carregando...</h3>
                            <div class="mt-1 text-sm text-gray-600">
                                <p>Aguarde...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Remove mensagem anterior (se existir) e adicona a nova
        const antigoResponse = document.getElementById("response");
        if (antigoResponse) antigoResponse.remove();
    
        document.body.appendChild(load);
    }, 300);

    fetch(url)
    .then(response => {
        clearTimeout(timeoutLoading);
        
        if (!response.ok) throw new Error("Erro no servidor");
        return response.text()
    })
    .then(html => {
        if(load) load.remove();

        if(document.getElementById("modalSee")){
            const vModalNew = document.createElement("div");
            vModalNew.id = "modalNew";
            vModalNew.innerHTML = html;
            document.body.appendChild(vModalNew);

        } else {
            vModal = document.createElement("div");
            vModal.id = "modalSee";
            vModal.innerHTML = html;
            document.body.appendChild(vModal)

        }

    })
    .catch(error => console.error("Erro ao carregar", error));
}

// função para fechar os modais
function closeModal(idModal) {
    document.getElementById(idModal).remove();
}

// Escuta o clique e verifica se é data-modal, para disparar o openModal e closeModal
document.addEventListener("click", (e) => {
    if (e.target.closest("[data-modal]")) {       
        const vModal = e.target.closest("[data-modal");
        const idModal = vModal.dataset.modal;
        const dataUrl = vModal.dataset.url;
        openModal(dataUrl, idModal)
    }
})

// Esculta o clique e verifica se é closeModal e fecha fora do botão prévio do disparo de evento
document.addEventListener("click", function(e) 
{   
    const vButton = e.target.closest("button");
    if (vButton && vButton.id === "closeModal") {
        if (document.getElementById("modalNew")) {
            closeModal("modalNew");
        } else {
            closeModal("modalSee");
        }
    }
});

// Remover elementos com efeito
function removeElement(element, duration = 1000) {
    if(!element) return;
        element.style.transition = "opacity 0.5s ease";
        element.style.opacity = "0";
    setTimeout(()=> element.remove(), duration);
}

// Remove mensagem flash
window.onload = function () {
    const e = document.querySelector('.alert-container');
    if (e) {
        setTimeout(() => {
            removeElement(e, 3000)
       }, 3000); 
    }
}

// Fechar o modal detalhe e modal cadastro de material
window.addEventListener("click", function(e) {
    
    const idModal = e.target.id;

    if (idModal === "detailModal") {
       closeModal("modalSee");
    }

    if(idModal === "materialModal") {
        closeModal("modalNew");
    }
})

// Paginador ajax sem mudar o URL
document.addEventListener("click", (e) => {
    if((e.target.classList[0] === "paginator_item")) {
        e.preventDefault();
        const vUrlPaginator = e.target.href;

        fetch(vUrlPaginator)
        .then(response => response.json())
        .then(data => {
            const vList = document.getElementById("updateList");
            vList.innerHTML = data.html;
        })
    }
})

// Input Search
document.addEventListener("input", (e) => {
    vInputSearc = e.target
    if(vInputSearc.id === "input-search" || vInputSearc.id === "select-data") {
        const vStatus = document.getElementById("select-data");
        const vSearch = document.getElementById("input-search");

        const vDataForm = new FormData();

        vDataForm.append(vStatus.name, vStatus.value)
        vDataForm.append(vSearch.name, vSearch.value)

        fetch(vInputSearc.dataset.url, {
            method: "post",
            body: vDataForm
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.html);
            const vList = document.getElementById("updateList");
            vList.innerHTML = data.html; 
        })
    }
})