// Envio de formulário
document.addEventListener("submit", (e) => {
    if(e.target.tagName === "FORM") {
        e.preventDefault()
        const vformData = new FormData(e.target);
        const vActionForm = e.target.action;

        // Agenda a exibição de carregamento
        let timeLoading;
        timeLoading = setTimeout(() => {
            fncLoading();
        }, 300);

        fetch(vActionForm, {
            method: "POST",
            body: vformData
        })
        .then(response => {
            clearTimeout(timeLoading);
            return response.json();
        })
        .then(data => {

            fncMensagem(data.message);
            
            if(data.status) {
                const vUpdateContent = document.getElementById("updateList");
                vUpdateContent.innerHTML = data.html
            }

            if(data.resetForm) {
                document.getElementById("form-user").reset();
            }
        })
    }
})

// Função de mensagem de loading
function fncLoading () {
    return setTimeout(() => {
        const load = document.createElement("div");
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
}

// Função de mensagem
function fncMensagem (vMessage) {
    const vResponse = document.createElement("div");
    vResponse.id = "reponse";
    vResponse.innerHTML = vMessage;

    document.body.appendChild(vResponse);

    setTimeout(() => {
        vResponse.style.transition = "opacity 0.5s ease";
        vResponse.style.opacity = "0";
        setTimeout(()=> vResponse.remove(), 1000);
    }, 3000)
}

/**
 * evento para fechar messagem
 */
document.body.addEventListener("click", (e) => {
    const botao = e.target.closest("#botao");
    const message = e.target.closest(".alert-container");

    if (botao && message) {
        message.style.transition = "opacity 0.5s ease";
        message.style.opacity = "0";
        setTimeout(() => message.remove(), 2000);
    }
})