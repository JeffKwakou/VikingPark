//Afficher l'input pour ajouter un type à un contenu
let buttonType = document.getElementById("addNewType");
let inputType = document.getElementById("addType");

let booleanType = false;

buttonType.addEventListener("click", () => {
    if (booleanType == false) {
        inputType.style.display = "inline-block";
        booleanType = true;
    } else {
        inputType.style.display = "none";
        booleanType = false;
    }    
});

