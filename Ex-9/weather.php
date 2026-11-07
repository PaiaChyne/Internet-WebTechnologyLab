<?php
/* Hypothetical weather API: returns JSON for a requested city */
header("Content-Type: application/json");

$data = [
    "chennai"   => ["city" => "Chennai",   "temp" => 33, "condition" => "Sunny",         "humidity" => 68, "wind" => 14,
                    "forecast" => [["Mon", 34, "Sunny"], ["Tue", 33, "Partly Cloudy"], ["Wed", 32, "Rain"], ["Thu", 31, "Rain"], ["Fri", 33, "Sunny"]]],
    "delhi"     => ["city" => "Delhi",     "temp" => 29, "condition" => "Hazy",          "humidity" => 45, "wind" => 9,
                    "forecast" => [["Mon", 30, "Hazy"], ["Tue", 31, "Sunny"], ["Wed", 30, "Sunny"], ["Thu", 28, "Cloudy"], ["Fri", 29, "Partly Cloudy"]]],
    "mumbai"    => ["city" => "Mumbai",    "temp" => 30, "condition" => "Rain",          "humidity" => 82, "wind" => 20,
                    "forecast" => [["Mon", 29, "Rain"], ["Tue", 29, "Rain"], ["Wed", 30, "Cloudy"], ["Thu", 31, "Partly Cloudy"], ["Fri", 30, "Rain"]]],
    "bengaluru" => ["city" => "Bengaluru", "temp" => 25, "condition" => "Partly Cloudy", "humidity" => 60, "wind" => 12,
                    "forecast" => [["Mon", 26, "Partly Cloudy"], ["Tue", 25, "Rain"], ["Wed", 24, "Rain"], ["Thu", 25, "Cloudy"], ["Fri", 27, "Sunny"]]],
    "london"    => ["city" => "London",    "temp" => 15, "condition" => "Cloudy",        "humidity" => 77, "wind" => 18,
                    "forecast" => [["Mon", 14, "Cloudy"], ["Tue", 13, "Rain"], ["Wed", 15, "Partly Cloudy"], ["Thu", 16, "Sunny"], ["Fri", 14, "Cloudy"]]],
];

$city = strtolower(trim($_GET["city"] ?? ""));

if (!isset($data[$city])) {
    http_response_code(404);
    echo json_encode(["error" => "City not found"]);    // JSON
    exit();
}

$result = $data[$city];
$result["updated"] = date("d M Y, h:i A");
echo json_encode($result);      // JSON
