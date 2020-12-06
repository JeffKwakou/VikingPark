//Déclarations des éléments du DOM
let star1 = document.getElementById("star1");
let star2 = document.getElementById("star2");
let star3 = document.getElementById("star3");
let star4 = document.getElementById("star4");
let star5 = document.getElementById("star5");

let resultRating = document.getElementById("resultRating");

let inputRating = document.getElementById("rating");

//Ajoute l'attribut checked quand hover
star5.addEventListener("mouseenter", () => {
    console.log("five stars");
    star5.classList.add("checked");
    star4.classList.add("checked");
    star3.classList.add("checked");
    star2.classList.add("checked");
    star1.classList.add("checked");

    resultRating.textContent = "5/5";

    inputRating.value = 5;
});

star4.addEventListener("mouseenter", () => {
    console.log("five stars");
    star5.classList.remove("checked");
    star4.classList.add("checked");
    star3.classList.add("checked");
    star2.classList.add("checked");
    star1.classList.add("checked");

    resultRating.textContent = "4/5";

    inputRating.value = 4;
});

star3.addEventListener("mouseenter", () => {
    console.log("five stars");
    star5.classList.remove("checked");
    star4.classList.remove("checked");
    star3.classList.add("checked");
    star2.classList.add("checked");
    star1.classList.add("checked");

    resultRating.textContent = "3/5";

    inputRating.value = 3;
});

star2.addEventListener("mouseenter", () => {
    console.log("five stars");
    star5.classList.remove("checked");
    star4.classList.remove("checked");
    star3.classList.remove("checked");
    star2.classList.add("checked");
    star1.classList.add("checked");

    resultRating.textContent = "2/5";

    inputRating.value = 2;
});

star1.addEventListener("mouseenter", () => {
    console.log("five stars");
    star5.classList.remove("checked");
    star4.classList.remove("checked");
    star3.classList.remove("checked");
    star2.classList.remove("checked");
    star1.classList.add("checked");

    resultRating.textContent = "1/5";

    inputRating.value = 1;
});