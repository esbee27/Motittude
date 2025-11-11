let searchBox = document.getElementById("search");
let select = document.getElementById("userSelect");
let addBtn = document.getElementById("addBtn");

if (searchBox) {
    searchBox.addEventListener("keyup", function() {
        let query = searchBox.value.trim();

        if (query === "") {
            select.style.display = "none";
            addBtn.style.display = "none";
            return;
        }

        fetch(`/search-users?search=${query}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                select.style.display = "inline-block";
                addBtn.style.display = "inline-block";
                select.innerHTML = "";

                data.forEach(user => {
                    let option = document.createElement("option");
                    option.value = user.id;
                    option.text = user.name;
                    select.appendChild(option);
                });
            } else {
                select.style.display = "none";
                addBtn.style.display = "none";
            }
        });
    });
}
