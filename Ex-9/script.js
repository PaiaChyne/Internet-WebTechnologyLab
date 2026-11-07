var icons = {
    "Sunny": "☀️",
    "Partly Cloudy": "⛅",
    "Cloudy": "☁️",
    "Rain": "🌧️",
    "Hazy": "🌫️"
};

var citySelect = document.getElementById("city");
var button = document.getElementById("getWeather");
var statusBox = document.getElementById("status");
var result = document.getElementById("result");

/* ---- 1. Send the Ajax request ---- */
function getWeather() {
    var city = citySelect.value;

    statusBox.textContent = "Loading...";
    statusBox.className = "status";
    result.classList.add("hidden");

    var xhr = new XMLHttpRequest();     // AJAX
    xhr.open("GET", "weather.php?city=" + encodeURIComponent(city), true);

    /* ---- 2. Handle the response ---- */
    xhr.onload = function () {
        var data = JSON.parse(xhr.responseText);     // JSON text -> JavaScript object

        if (xhr.status === 200) {
            showWeather(data);
        } else {
            showError(data.error);
        }
    };

    xhr.onerror = function () {
        showError("Could not reach the server.");
    };

    xhr.send();
}

/* ---- 3. Display the data on the page ---- */
function showWeather(d) {
    statusBox.textContent = "";

    document.getElementById("cityName").textContent = d.city;
    document.getElementById("temp").textContent = d.temp;
    document.getElementById("condition").textContent = d.condition;
    document.getElementById("icon").textContent = icons[d.condition] || "🌡️";
    document.getElementById("humidity").textContent = d.humidity;
    document.getElementById("wind").textContent = d.wind;
    document.getElementById("updated").textContent = d.updated;

    var box = document.getElementById("forecast");
    box.innerHTML = "";

    d.forecast.forEach(function (day) {
        var card = document.createElement("div");
        card.className = "day";
        card.innerHTML =
            "<b>" + day[0] + "</b>" +
            "<span>" + (icons[day[2]] || "🌡️") + "</span>" +
            "<em>" + day[1] + "&deg;</em>";
        box.appendChild(card);
    });

    result.classList.remove("hidden");
}

function showError(message) {
    statusBox.textContent = message;
    statusBox.className = "status error";
}

button.addEventListener("click", getWeather);
citySelect.addEventListener("change", getWeather);
getWeather();   // load the first city when the page opens
