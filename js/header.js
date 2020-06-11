let h5 = document.querySelector("h5");

h5.addEventListener("click", function(){
    document.location.href = "/";
})

h5.addEventListener("mousemove",function(){
    h5.style.cursor = "pointer";
})