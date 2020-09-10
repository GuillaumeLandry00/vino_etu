/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//Permet de definir la BaseUrl
//const BaseURL = "http://vino.ca/";
const BaseURL = document.baseURI;
console.log(BaseURL);
//Permet de load la page
window.addEventListener("load", function () {
  console.log("load");
  document.querySelectorAll(".btnBoire").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=boireBouteilleCellier",
        { method: "POST", body: '{"id": ' + id + "}" }
      );

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
          
             //window.location.href=window.location.href;
            return response.json();
            
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
         //rechargement de la page
         location.reload();
          console.debug(response);

//Permet de load la page
window.addEventListener("load", function () {
  console.log("load");
  document.querySelectorAll(".btnBoire").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=boireBouteilleCellier",
        { method: "POST", body: '{"id": ' + id + "}" }
      );

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          console.debug(response);

        })
        .catch((error) => {
          console.error(error);
        });
    
    });
      location.reload();
    });
    // $(".fermer").click((evt)=>{
    // location.reload();

    // });
  });

  //Permet de selectionner tous les éléments avec la classe .btnAjouter
  document.querySelectorAll(".btnAjouter").forEach(function (element) {
    console.log(element);

    //Ajoute un event qui vas permettre d'ajouter des bouteilles au ceillier
    element.addEventListener("click", function (evt) {
      //Permet d'aller chercher le id et créer la requête
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=ajouterBouteilleCellier",
        { method: "POST", body: '{"id": ' + id + "}" }
      );

    //Ajoute un event qui vas permettre d'ajouter des bouteilles au ceillier
    element.addEventListener("click", function (evt) {
      //Permet d'aller chercher le id et créer la requête
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=ajouterBouteilleCellier",
        { method: "POST", body: '{"id": ' + id + "}" }
      );

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Erreur");
          }
          
        })
        .then((response) => {
          //rechargement de la page
          location.reload();
          console.debug(response);
        })
          location.reload();
        })
        .then((response) => {
          console.debug(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });

  let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
  console.log(inputNomBouteille);
  let liste = document.querySelector(".listeAutoComplete");

  let liste = document.querySelector(".listeAutoComplete");
  if (inputNomBouteille) {
    inputNomBouteille.addEventListener("keyup", function (evt) {
      console.log(evt);
      let nom = inputNomBouteille.value;
      liste.innerHTML = "";
      if (nom) {
        let requete = new Request(
          BaseURL + "index.php?requete=autocompleteBouteille",
          { method: "POST", body: '{"nom": "' + nom + '"}' }
        );
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);

            response.forEach(function (element) {
              liste.innerHTML +=
                "<li data-id='" + element.id + "'>" + element.nom + "</li>";
            });
          })
          .catch((error) => {
            console.error(error);
          });
      }
    });

    //Créer un objet bouteille avec les inputs entrés
    //Créer un objet bouteille

    let bouteille = {
      nom: document.querySelector(".nom_bouteille"),
      millesime: document.querySelector("[name='millesime']"),
      quantite: document.querySelector("[name='quantite']"),
      date_achat: document.querySelector("[name='date_achat']"),
      prix: document.querySelector("[name='prix']"),
      garde_jusqua: document.querySelector("[name='garde_jusqua']"),
      notes: document.querySelector("[name='notes']"),
    };

    liste.addEventListener("click", function (evt) {
      console.dir(evt.target);
      //Permet de vérifier qu'il a bien clique sur LI
      if (evt.target.tagName == "LI") {
        //Permet d'aller attribuer les données de la recherche dans les inputs
        bouteille.nom.dataset.id = evt.target.dataset.id;
        bouteille.nom.innerHTML = evt.target.innerHTML;

        liste.innerHTML = "";
        inputNomBouteille.value = "";
      }
    });

    //Ajouter une nouvelle bouteille
    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    if (btnAjouter) {
      btnAjouter.addEventListener("click", function (evt) {
        //Permet d'aller chercher les valeurs des inputs
        var param = {
          id_bouteille: bouteille.nom.dataset.id,
          date_achat: bouteille.date_achat.value,
          garde_jusqua: bouteille.garde_jusqua.value,
          notes: bouteille.notes.value,
          prix: bouteille.prix.value,
          quantite: bouteille.quantite.value,
          millesime: bouteille.millesime.value,
        };

        //Permet de creer un objet options pour les requete
        let requete = new Request(
          BaseURL + "index.php?requete=ajouterNouvelleBouteilleCellier",
          {
            method: "POST",
            body: JSON.stringify(param)
          }
        );
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
             
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    }

    liste.addEventListener("click", function (evt) {
      console.dir(evt.target);
      //Permet de vérifier qu'il a bien clique sur LI
      if (evt.target.tagName == "LI") {
        //Permet d'aller attribuer les données de la recherche dans les inputs
        bouteille.nom.dataset.id = evt.target.dataset.id;
        bouteille.nom.innerHTML = evt.target.innerHTML;

        liste.innerHTML = "";
        inputNomBouteille.value = "";
      }
    });

    //Ajouter une nouvelle bouteille
    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    if (btnAjouter) {
      btnAjouter.addEventListener("click", function (evt) {
        //Permet d'aller chercher les valeurs des inputs
        var param = {
          id_bouteille: bouteille.nom.dataset.id,
          date_achat: bouteille.date_achat.value,
          garde_jusqua: bouteille.garde_jusqua.value,
          notes: bouteille.notes.value,
          prix: bouteille.prix.value,
          quantite: bouteille.quantite.value,
          millesime: bouteille.millesime.value,
        };

        console.log(JSON.stringify(param));

        //Permet de creer un objet options pour les requete
        let requete = new Request(
          BaseURL + "index.php?requete=ajouterNouvelleBouteilleCellier",
          {
            method: "POST",
            body: JSON.stringify(param),
          }
        );
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    }
  }

  //Modifier une  bouteille
  let btnModifier = document.querySelector("[name='modifierBouteilleCellier']");
  if (btnModifier) {
    btnModifier.addEventListener("click", function (evt) {
      //Permet d'aller chercher les valeurs des inputs
      var param = {
        id: document.getElementById("id_bouteille").innerHTML,
        date_achat: document.querySelector("[name='date_achat']").value,
        garde_jusqua: document.querySelector("[name='garde_jusqua']").value,
        notes: document.querySelector("[name='notes']").value,
        prix: document.querySelector("[name='prix']").value,
        quantite: document.querySelector("[name='quantite']").value,
        millesime: document.querySelector("[name='millesime']").value,
      };

      //Permet de creer un objet options pour les requete
      let requete = new Request(
        BaseURL + "index.php?requete=modifierBouteilleCellier",
        {
          method: "PUT",
          body: JSON.stringify(param),
          // headers: { "Content-Type": "application/json" },
        }
      );

      console.log(JSON.stringify(param));
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });

  }
});