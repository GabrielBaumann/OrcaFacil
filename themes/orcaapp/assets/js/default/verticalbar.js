// verticalbar geral
const vSepanAll = [...document.getElementsByTagName("a")];
const vUrl = window.location.href.split('/');
const vLocation = vUrl.filter(p => p !== '').pop();

vSepanAll.map((e) => {
    if(e.classList.contains("sidebar-menu")) {
        if(vLocation === e.id) {
            e.classList.remove("hover:bg-gray-50", "text-gray-600", "hover:text-gray-900");
            e.classList.add("relative", "border-b-2", "border-orange-600", "text-black", "font-medium");
        }
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