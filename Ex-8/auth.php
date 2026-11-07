<?php
session_start();
include "db.php";

function require_login() {
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }
}

function csrf_field() {
    if (empty($_SESSION["csrf"])) $_SESSION["csrf"] = bin2hex(random_bytes(16));
    return '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function check_csrf() {
    if (!hash_equals($_SESSION["csrf"] ?? "", $_POST["csrf"] ?? "")) die("Invalid request.");
}
