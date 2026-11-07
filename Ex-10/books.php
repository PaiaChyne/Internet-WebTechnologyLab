<?php
/* Hypothetical book API: this plays the role of https://api.example.com/books */
header("Content-Type: application/json; charset=utf-8");

$books = [
    ["title" => "To Kill a Mockingbird", "author" => "Harper Lee", "year" => 1960, "genre" => "Fiction"],
    ["title" => "The Great Gatsby", "author" => "F. Scott Fitzgerald", "year" => 1925, "genre" => "Historical Fiction"],
    ["title" => "The Hobbit", "author" => "J.R.R. Tolkien", "year" => 1937, "genre" => "Fantasy"],
    ["title" => "Pride and Prejudice", "author" => "Jane Austen", "year" => 1813, "genre" => "Romance"],
    ["title" => "The Hunger Games", "author" => "Suzanne Collins", "year" => 2008, "genre" => "Young Adult"],
    ["title" => "The Kite Runner", "author" => "Khaled Hosseini", "year" => 2003, "genre" => "Historical Fiction"],
    ["title" => "1984", "author" => "George Orwell", "year" => 1949, "genre" => "Dystopian"],
    ["title" => "Brave New World", "author" => "Aldous Huxley", "year" => 1932, "genre" => "Dystopian"],
    ["title" => "Harry Potter and the Sorcerer's Stone", "author" => "J.K. Rowling", "year" => 1997, "genre" => "Fantasy"],
    ["title" => "The Alchemist", "author" => "Paulo Coelho", "year" => 1988, "genre" => "Fiction"],
    ["title" => "The Da Vinci Code", "author" => "Dan Brown", "year" => 2003, "genre" => "Thriller"],
    ["title" => "Gone Girl", "author" => "Gillian Flynn", "year" => 2012, "genre" => "Thriller"],
    ["title" => "Murder on the Orient Express", "author" => "Agatha Christie", "year" => 1934, "genre" => "Mystery"],
    ["title" => "The Girl with the Dragon Tattoo", "author" => "Stieg Larsson", "year" => 2005, "genre" => "Mystery"],
    ["title" => "Dune", "author" => "Frank Herbert", "year" => 1965, "genre" => "Science Fiction"],
    ["title" => "The Martian", "author" => "Andy Weir", "year" => 2011, "genre" => "Science Fiction"],
    ["title" => "Ender's Game", "author" => "Orson Scott Card", "year" => 1985, "genre" => "Science Fiction"],
    ["title" => "The Fault in Our Stars", "author" => "John Green", "year" => 2012, "genre" => "Young Adult"],
    ["title" => "Jane Eyre", "author" => "Charlotte Brontë", "year" => 1847, "genre" => "Romance"],
    ["title" => "Treasure Island", "author" => "Robert Louis Stevenson", "year" => 1883, "genre" => "Adventure"],
    ["title" => "The Count of Monte Cristo", "author" => "Alexandre Dumas", "year" => 1844, "genre" => "Adventure"],
    ["title" => "Life of Pi", "author" => "Yann Martel", "year" => 2001, "genre" => "Adventure"],
    ["title" => "Sapiens", "author" => "Yuval Noah Harari", "year" => 2011, "genre" => "Non-Fiction"],
    ["title" => "Atomic Habits", "author" => "James Clear", "year" => 2018, "genre" => "Self-Help"],
    ["title" => "Wings of Fire", "author" => "A.P.J. Abdul Kalam", "year" => 1999, "genre" => "Biography"],
    ["title" => "The Diary of a Young Girl", "author" => "Anne Frank", "year" => 1947, "genre" => "Biography"],
];

/* Simulate a tiny delay, like a real network call */
usleep(400000);

echo json_encode(["count" => count($books), "books" => $books], JSON_UNESCAPED_UNICODE);
