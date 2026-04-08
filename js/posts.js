let switchBtn = document.getElementById("switch-btn");
let h2 = document.getElementById("topH2");
let posts = document.getElementById("posts");

function darkSwitch() {
    document.body.style.background = "linear-gradient(180deg, #2b2b2b 0%, #1a1a1a 100%)";
    h2.style.color = "white";
    posts.style.backgroundColor = "black";
}


switchBtn.addEventListener("click", darkSwitch);