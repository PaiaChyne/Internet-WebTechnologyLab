$(document).ready(function () {

    console.log("Book Library script v2 loaded (search enabled)");

    /* Hypothetical API endpoint.
       Replace this with the real endpoint you want to use, e.g.
       "https://api.example.com/books" */
    var API_URL = "books.php";

    var allBooks = [];   // all books received from the API

    $("#loadBooks").on("click", loadBooks);
    $("#searchBox").on("input", searchBooks);   // runs on every key typed

    function loadBooks() {

        $("#status").removeClass("error").text("Loading books...");
        $("#bookList").empty();
        $("#count").text("");
        $("#searchBox").val("");
        allBooks = [];

        /* ---- jQuery Ajax GET request ---- */
        $.ajax({
            url: API_URL,
            type: "GET",
            dataType: "json"
        })
        .done(function (response) {
            $("#status").text("");
            allBooks = response.books;
            $("#count").text(response.count + " books found");
            renderBooks(allBooks);
        })
        .fail(function () {
            $("#status").addClass("error").text("Could not load books from the API.");
        });
    }

    /* ---- Search by title, author or genre ---- */
    function searchBooks() {
        var term = $("#searchBox").val().toLowerCase().trim();

        var results = $.grep(allBooks, function (book) {
            return book.title.toLowerCase().indexOf(term) !== -1 ||
                   book.author.toLowerCase().indexOf(term) !== -1 ||
                   book.genre.toLowerCase().indexOf(term) !== -1;
        });

        if (term === "") {
            $("#count").text(allBooks.length + " books found");
        } else {
            $("#count").text(results.length + " of " + allBooks.length + " books match");
        }

        renderBooks(results);
    }

    function renderBooks(books) {
        $("#bookList").empty();

        if (books.length === 0 && allBooks.length > 0) {
            $("#bookList").append($("<p>").addClass("no-results").text("No books match your search."));
            return;
        }

        $.each(books, function (index, book) {
            /* "Science Fiction" -> "genre-science-fiction" (used for the cover colour) */
            var genreClass = "genre-" + book.genre.toLowerCase().replace(/[^a-z]+/g, "-");

            var card = $("<div>").addClass("book-card " + genreClass);

            card.append($("<div>").addClass("cover").text(book.title.charAt(0)));

            var info = $("<div>").addClass("info");
            info.append($("<h3>").text(book.title));
            info.append($("<p>").addClass("author").text("by " + book.author));
            info.append(
                $("<div>").addClass("meta")
                    .append($("<span>").addClass("tag").text(book.genre))
                    .append($("<span>").addClass("year").text(book.year))
            );

            card.append(info);
            $("#bookList").append(card);
        });
    }

    loadBooks();   // load the list automatically when the page opens
});
