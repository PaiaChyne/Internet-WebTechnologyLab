document.addEventListener("DOMContentLoaded", function () {

    // Live search
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

    // Fade out success message
    var msg = document.querySelector(".message");
    if (msg) setTimeout(function () { msg.style.display = "none"; }, 3500);
});
