// Automatische fotoslider
// var counter = 1;
// setInterval(function () {
//     document.getElementById("radio" + counter).checked = true;
//     counter++;
//     if (counter > 4) {
//         counter = 1;
//     }
// }, 5000)

// Login systeem
function show() {
    var show = document.getElementById("container_logIn");
    if (show.style.display == "block"){
        show.style.display = "none";
    }
    else{
        show.style.display = "block";
    }
}

