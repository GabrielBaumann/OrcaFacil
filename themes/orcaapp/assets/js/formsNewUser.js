/**
 * Envio de formulário
 */
document.addEventListener("submit", (e)=> {
    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;

        let load;
        let timeoutLoading;

        // Agenda a exibição do "carregamento..." após 300 milesimo
        timeoutLoading = setTimeout(() => {
            fncLoading();
        }, 300);

        fetch(actionForm, {
            method: "POST",
            body: formData
        })
        .then(response => {
            clearTimeout(timeoutLoading);

            if(!response.ok) throw new Error("Erro no servidor");

            return response.json();
        })
        .then(data => {
            
            if(data.redirected) {
                window.location.href = data.redirected
            } else {

                const load = document.getElementById("response");

                if(load) load.remove();

                fncMensagem(data.message);

                if(data.complete) {
                document.getElementById("form").reset();
            }

            }

        })
        .catch(error => {
            clearTimeout(timeoutLoading);
            const load = document.getElementById("response");
            if(load) load.remove();
            
            console.log("Erro", error);
            
            const erroResponse = document.createElement("div");
            erroResponse.id = "response";
            erroResponse.innerHTML = `
                <div class="alert-container">
                    <div class="alert-message bg-white border border-red-400 rounded-lg p-4 text-red-700">
                        Erro inesperado. Tente novamente.
                    </div>
                </div>
            `;
           document.body.appendChild(erroResponse);

           setTimeout(() => {
                removeElement(erroResponse)
           }, 3000);            
        });
    }
});


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

/**
 * Função para evento de saída 
 */
function removeElement(element, duration = 1000) {
    if(!element) return;
        element.style.transition = "opacity 0.5s ease";
        element.style.opacity = "0";
    setTimeout(()=> element.remove(), duration);
}

// Pesquisa o cpf no banco e retorna erro se já existir
// document.addEventListener("focusout", (e) => {

//     if(e.target.id === "cpf") {
//         if(e.target.value !== ""){
//             const vUrlValidate = e.target.dataset.validadecpf;
//             const vCpf = e.target.value.replace(/\D/g, '')
//             const vCpfData = new FormData();
//             vCpfData.append(e.target.name, vCpf );
            
//             fetch(vUrlValidate, {
//                 method: "POST",
//                 body: vCpfData
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if(data.erro) {
//                     document.getElementById("cpf").value = "";
//                 }
//                 fncMensagem(data.message);
//             })
//         }
//     }
// })

// Função de mensagem
function fncMensagem (vMessage) {
    const vResponse = document.createElement("div");
    vResponse.id = "reponse";
    vResponse.innerHTML = vMessage;

    document.body.appendChild(vResponse);

    setTimeout(() => {
        removeElement(vResponse);
    }, 3000)
}

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