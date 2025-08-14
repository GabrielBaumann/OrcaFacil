/**
 * Envio de formulário de cadastro de vagas
 */

// variável para recever o tipo do botão (delete, save ...)
let btnClick = null;

document.addEventListener("click", (e) => {
    const vButton = e.target.closest("BUTTON");
    if(vButton) {
        if(vButton.tagName === "BUTTON" && vButton.type === "submit") {
            btnClick = vButton
        }
    }
})

document.addEventListener("submit", (e) => {
    if(e.target.tagName === "FORM") {
        e.preventDefault();

        const vForm = new FormData(e.target);
        const vActionForm = e.target.action;
        const vformId = e.target.id;
        let vtimeLoading;

        vtimeLoading = showSplash();

        if(btnClick && btnClick.name) {
            vForm.append(btnClick.name, btnClick.value);
        }

        fetch(vActionForm, {
            method: "POST",
            body: vForm
        })
        .then(response => {
            clearTimeout(vtimeLoading);
            return response.json();
        })
        .then(data => {

            if(data.redirect) {
                window.location.href = data.redirect;
            }

            if(data.complete) {
                fncMessage(data.message);
                document.getElementById(vformId).reset();
            } else {
                if(data.message) {
                    fncMessage(data.message);
                }
            }

            if(data.html) {
                if(document.getElementById("response")) document.getElementById("response").remove();
                const vElement = document.createElement("div");
                vElement.id = "modal";
                vElement.innerHTML = data.html;
                document.body.appendChild(vElement);
            }
        })
        .catch(error => {
            fncMessage();
        })
    }
});