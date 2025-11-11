<!DOCTYPE html>
<html>
<head>
    <title>Enroll User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        #results { margin-top: 10px; }
        select { padding: 5px; margin-top: 5px; }
    </style>
</head>
<body>
    <h2>Enroll User into Quiz</h2>

    {{-- Live search input --}}
    <input type="text" id="search" placeholder="Type a name...">

    {{-- Dropdown for results --}}
    <form method="POST" action="{{ route('add.participant') }}">
        @csrf
        <input type="hidden" name="quiz_id" value="1">
        <select name="user_id" id="userSelect" style="display:none;"></select>
        <button type="submit" style="display:none;" id="addBtn">Add Participant</button>
    </form>

    <script>
        let searchBox = document.getElementById("search");
        let select = document.getElementById("userSelect");
        let addBtn = document.getElementById("addBtn");

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
    </script>
</body>
</html>
