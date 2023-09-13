let X, Y, R;
document.addEventListener("DOMContentLoaded", function (){
    document.getElementById("submit-button").addEventListener("click", submit)
    document.getElementById("clear-button").addEventListener("click", clear);
});

window.onload = function () {
    fetch("php/script.php")
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response)
        .then(response => console.log(response));
}
function checkY() {
    Y = document.getElementById("y");
    if (Y.value.trim() === "") {
        Y.setCustomValidity("Input number!");
        return false;
    } else if (!isFinite(Y.value)){
        Y.setCustomValidity("Wrong input (only number)!");
        return false;
    } else if (Y.value > 3 || Y.value < -3){
        Y.setCustomValidity("Input number in [-3; 3]!");
        return false;
    }
    Y.setCustomValidity("");
    return true;
}

const submit = function(e) {
    //checkY();
    if (!checkY()) return;
    e.preventDefault();
    X = (new FormData(document.getElementById("coordinates-form"))).get("x");
    R = (new FormData(document.getElementById("coordinates-form"))).get("r");
    // console.log(X, Y, R);
    let request = ("?x=" + X + "&y=" + Y.value + "&r=" + R);
    //console.log(request);
    fetch("php/script.php" + request)
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response);
};

const clear = function (e) {
    e.preventDefault();
    fetch("php/clear.php")
        .then(response => response.text())
        .then(response => document.getElementById("table-header").innerHTML = response);
}