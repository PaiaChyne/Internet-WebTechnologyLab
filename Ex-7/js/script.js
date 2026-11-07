document.addEventListener("DOMContentLoaded", function () {

    // Live search for tables
    var search = document.getElementById("search");
    if (search) {
        search.addEventListener("input", function () {
            var q = search.value.toLowerCase();
            document.querySelectorAll("table.searchable tbody tr").forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().indexOf(q) > -1 ? "" : "none";
            });
        });
    }

    // Confirm before delete
    document.querySelectorAll("form[data-confirm]").forEach(function (f) {
        f.addEventListener("submit", function (e) {
            if (!confirm(f.dataset.confirm)) e.preventDefault();
        });
    });

    // Show admin code only when Admin is chosen
    var role = document.getElementById("role");
    var box = document.getElementById("code-box");
    if (role && box) {
        var toggle = function () {
            var isAdmin = role.value === "admin";
            box.style.display = isAdmin ? "block" : "none";
            box.querySelector("input").required = isAdmin;
        };
        role.addEventListener("change", toggle);
        toggle();
    }
});
