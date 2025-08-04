/**
 * Envio de formulário de cadastro de vagas
 */
document.addEventListener("submit", (e) => {
    if(e.target.tagName === "FORM") {
        e.preventDefault();

        const vForm = new FormData(e.target);
        const vActionForm = e.target.action;
        const vformId = e.target.id;
        let vtimeLoading;

        vtimeLoading = showSplash();
        
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