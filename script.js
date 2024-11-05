document.getElementById("hamburger").addEventListener("click", function() {
    document.getElementById("menuOverlay").classList.toggle("show");
});

document.getElementById("closeBtn").addEventListener("click", function() {
    document.getElementById("menuOverlay").classList.remove("show");
});
