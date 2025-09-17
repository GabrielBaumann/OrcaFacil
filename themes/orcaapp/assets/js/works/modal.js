// Abrir modal
document.addEventListener("click", (e) => {
    const vBtn = e.target.closest("button");
    if(vBtn && vBtn.dataset.urlexpense) {
        const vUrle = vBtn.dataset.urlexpense;
        fetch(vUrle)
        .then(response => response.json())
        .then(data => {
            const vElemento = document.createElement("div");
            vElemento.id = "modal";
            vElemento.innerHTML = data.html;
            document.body.appendChild(vElemento);
        })
    }
})

// Abrir formulário com dados do modal id da obra e id do custo
document.addEventListener("click", (e) => {
    const vBtn = e.target.id
    if(vBtn === "btn-add-expenses") {
        const vIdWork = document.getElementById("id-work").value;
        const vIdBudGet = document.getElementById("budget").value;
        const vStep = document.querySelectorAll("input.step-work:checked")
        const vUrl = e.target.dataset.url;
        let vIdStep = 0;
        vStep.forEach((e) => {
            vIdStep = e.id;
        })

        fetch(vUrl + "/" + vIdWork + "/" + vIdStep + "/" + vIdBudGet)
        .then(response => {
            response.json();
        })
        .then(data => {
            console.log("teste");
            if(data.message) {
                fncMessage(data.message)
            }
            // window.location.href = vUrl + "/" + vIdWork + "/" + vIdStep + "/" + vIdBudGet;
        }
        )
    }
});