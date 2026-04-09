let switchBtn = document.getElementById("switch-btn");

function darkSwitch() {
    document.body.classList.toggle("dark-mode");
}

switchBtn.addEventListener("click", darkSwitch);