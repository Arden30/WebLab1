let X, Y, R;
document.addEventListener("DOMContentLoaded", function (){
    document.getElementById("y").addEventListener("input", checkY)
    document.getElementById("submit-button").addEventListener("click", submit)
    document.getElementById("clear-button").addEventListener("click", clear);
});

window.onload = function () {
    fetch("php/script.php")
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response);
}
const checkY = function (){
    Y = document.getElementById("y");
    if (Y.value.trim() === "") {
        Y.setCustomValidity("Input number!");
        return false;
    } else if (!isFinite(Y.value.replace(",", "."))){
        Y.setCustomValidity("Wrong input (only number)!");
        return false;
    } else if (Y.value.replace(",", ".") >= 3 || Y.value.replace(",", ".") <= -3){
        Y.setCustomValidity("Input number in (-3; 3)!");
        return false;
    } else {
        Y.setCustomValidity("");
        return true;
    }
}

const submit = function(e) {
    if (!checkY()) return;
    e.preventDefault();
    X = (new FormData(document.getElementById("coordinates-form"))).get("x");
    R = (new FormData(document.getElementById("coordinates-form"))).get("r");
    let request = ("?x=" + X + "&y=" + Y.value.replace(",", ".").replace("0x", "") + "&r=" + R + "&timezone=" + new Date().getTimezoneOffset());
    fetch("php/script.php" + request, {
        method: 'GET'
    })
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response);
};

const clear = function () {
    fetch("php/clear.php")
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response);
}