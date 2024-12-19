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
 * Affiche une liste en appelant une requête AJAX vers une API pour un formulaire spécifique
 * @param {HTMLDivElement} formContainer 
 * @returns void
 */
function afficherListe(formContainer) {
    const listeInfo = formContainer.querySelector('.listeInfo');
    listeInfo.innerHTML = '<p>Chargement...</p>';
    const ordre = formContainer.querySelector('.ordre');
    const filtre = formContainer.querySelector('.filtre');
    const filtreValeur = formContainer.querySelector('.filtreValeur');

    // Construire les paramètres de l'API
    let filtreAPI = `${filtre.value.trim()} LIKE '%${encodeURIComponent(filtreValeur.value.trim())}%'`;
    let ordreAPI = encodeURIComponent(ordre.value.trim()); // Encodage de l'ordre pour l'URL

    // Construire l'URL de l'API
    let params = [];

    // Ajouter le paramètre filtre si défini
    if (filtre.value && filtreValeur.value) params.push("filtre=" + encodeURIComponent(filtreAPI));

    // Ajouter le paramètre ordre si défini
    if (ordre.value) params.push("ordre=" + ordreAPI);

    // Joindre tous les paramètres à l'URL
    let API = formContainer.dataset.api;
    if (params.length > 0) API += "?" + params.join("&");

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
                console.error("Erreur :", response.status);
                let messageErreur = document.createElement('p');
                messageErreur.textContent = response.status;
                listeInfo.appendChild(messageErreur);
                return;
            }

            let idTemplate = listeInfo.dataset.template;
            const template = document.getElementById(idTemplate).innerHTML;
            let renderedContent = Mustache.render(template, response.liste);
            listeInfo.innerHTML = renderedContent;
        }        
    };
    xhttp.send();
}

function changeTypeFiltre(formContainer) {
    const filtre = formContainer.querySelector('.filtre');
    const filtreValeur = formContainer.querySelector('.filtreValeur');
    let selectedOption = filtre.options[filtre.selectedIndex];
    filtreValeur.type = selectedOption.dataset.type;
    filtreValeur.value = '';
}

// ------------------------ Initialisation ------------------------
function init() {
    const allformListeFiltreOrdre = document.querySelectorAll('.formListeFiltreOrdre');

    if(allformListeFiltreOrdre) {
        allformListeFiltreOrdre.forEach(formContainer => {
            const ordre = formContainer.querySelector('.ordre');
            const filtre = formContainer.querySelector('.filtre');
            const filtreValeur = formContainer.querySelector('.filtreValeur');

            ordre.addEventListener('change', () => afficherListe(formContainer));
            filtreValeur.addEventListener('input', () => afficherListe(formContainer));
            filtre.addEventListener('change', () => changeTypeFiltre(formContainer));

            afficherListe(formContainer); // Charger la liste initiale
        });
    }
}

// Attendre que le DOM soit prêt
window.addEventListener('DOMContentLoaded', init);

