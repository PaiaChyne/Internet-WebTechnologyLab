<?php
session_start();
require_once "db.php";

/* Code required to register as an Admin. Change it! */
define("ADMIN_CODE", "ADMIN2026");

function e($s) { return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8"); }

function require_login() {
    if (!isset($_SESSION["id"])) { header("Location: login.php"); exit(); }
}

function require_role($role) {
    require_login();
    if ($_SESSION["role"] !== $role) { http_response_code(403); die("Access denied."); }
}

function csrf_field() {
    if (empty($_SESSION["csrf"])) $_SESSION["csrf"] = bin2hex(random_bytes(16));
    return '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function check_csrf() {
    if (!hash_equals($_SESSION["csrf"] ?? "", $_POST["csrf"] ?? "")) die("Invalid request.");
}

function flash($msg) { $_SESSION["flash"] = $msg; }
