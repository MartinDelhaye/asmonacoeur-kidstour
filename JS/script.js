// ------------------------ Variables GLobales ------------------------
let listeInfo;
let ordre;
let filtre;
let filtreValeur;


// ------------------------ Fonctions ------------------------
/**
 * Vider la div en parametre
 * @param {HTMLDivElement} div 
 * @returns void  
 */
function viderDiv(div) {
    div.innerHTML = "";
    // Supprime le premier enfant jusqu'à ce que la div soit vide
    while (div.firstChild) {
        // console.log();
        div.removeChild(div.firstChild);
    }
}

/**
 * Affiche une liste en appellant une requête AJAX vers une API
 */
function afficherListe() {

    // Construire les paramètres de l'API
    let filtreAPI = `${filtre.value.trim()} LIKE '%${encodeURIComponent(filtreValeur.value.trim())}%'`;
    let ordreAPI = encodeURIComponent(ordre.value.trim()); // Encodage de l'ordre pour l'URL

    // Construire l'URL de l'API
    let params = [];

    // Ajouter le paramètre filtre si défini
    if (filtre.value && filtreValeur.value) {
        params.push("filtre=" + encodeURIComponent(filtreAPI));
    }

    // Ajouter le paramètre ordre si défini
    if (ordre.value) {
        params.push("ordre=" + ordreAPI);
    }

    // Joindre tous les paramètres à l'URL
    let API = formListeFiltreOrdre.dataset.api;
    if (params.length > 0) {
        API += "?" + params.join("&");
    }

    console.log("API URL : ", API); // Affiche l'URL de l'API pour debug

    // Requête AJAX vers l'API
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", API, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = JSON.parse(this.responseText);
            console.log(response);
            viderDiv(listeInfo);

            if (response.status !== "OK") {
                console.log("Erreur :", response.status);
                let messageErreur = document.createElement('p');
                messageErreur.innerHTML = response.status;
                listeInfo.appendChild(messageErreur);
                return;
            }

            // Créer un tableau pour stocker le rendu des étapes
            let renderedContent = '';
            response.liste.forEach(focus => {
                let idTemplate = listeInfo.dataset.template;
                console.log(idTemplate);
                const template = document.getElementById(idTemplate).innerHTML;
                renderedContent += Mustache.render(template, focus); // Ajout de chaque étape au contenu
            });

            // Insérer tout le contenu généré dans la zone de rendu
            listeInfo.innerHTML = renderedContent;
        }
    };
    xhttp.send();
}

function changeTypeFiltre() {
    // Récupère l'option sélectionnée dans le select
    let selectedOption = filtre.options[filtre.selectedIndex];
    // Applique son data-type au type de l'input
    filtreValeur.type = selectedOption.dataset.type;
    // Reset la valeur 
    filtreValeur.value = '';
}




// ------------------------ Initialisation ------------------------
function init() {
    // Liste avec filtre et ordre
    listeInfo = document.getElementById('listeInfo');
    formListeFiltreOrdre = document.getElementById('formListeFiltreOrdre');

    if (listeInfo && formListeFiltreOrdre) {
        ordre = document.getElementById('ordre');
        filtre = document.getElementById('filtre');
        filtreValeur = document.getElementById('filtreValeur');

        // Ajoute des événements pour chaque changement de filtre ou d'ordre
        ordre.addEventListener('change', afficherListe);
        filtreValeur.addEventListener('input', afficherListe);
        filtre.addEventListener('change', changeTypeFiltre);

        // Afficher les étapes au chargement initial
        afficherListe();
    }
}

// Attendre que le DOM soit prêt
window.addEventListener('load', init);

