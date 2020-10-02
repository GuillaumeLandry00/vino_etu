/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//Test commit
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
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          location.reload();
          console.debug(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });
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
        .catch((error) => {
          console.error(error);
        });
    });
  });

  let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
  console.log(inputNomBouteille);

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
        //Permet de reinitaliser rles donnees
        document.getElementById("errMillesime").innerHTML = "";
        document.getElementById("errPrix").innerHTML = "";
        document.getElementById("errDate").innerHTML = "";
        document.getElementById("errQt").innerHTML = "";
        document.getElementById("confirmation").innerHTML = "";

        var select = document.getElementById("cellier");

        //Permet d'aller chercher les valeurs des inputs
        var param = {
          id_bouteille: bouteille.nom.dataset.id,
          date_achat: bouteille.date_achat.value,
          garde_jusqua: bouteille.garde_jusqua.value,
          notes: bouteille.notes.value,
          prix: bouteille.prix.value,
          quantite: bouteille.quantite.value,
          millesime: bouteille.millesime.value,
          cellier: select.options[select.selectedIndex].value,
        };

        console.log(param);

        //Permet de creer un objet options pour les requete
        let requete = new Request(
          BaseURL + "index.php?requete=ajouterNouvelleBouteilleCellier",
          {
            method: "POST",
            body: JSON.stringify(param),
            headers: { "Content-Type": "application/json" },
          }
        );
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              //Rentre ici
              console.log(response);
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);
            //Permet de verifier si il y des erreurs et afficher
            if (response.prix == true) {
              document.getElementById("errPrix").innerHTML =
                "Veuillez entrer un prix valide 00.00";
            }
            //Vérifie le millesime
            if (response.millesime == true) {
              document.getElementById("errMillesime").innerHTML =
                "Veuillez entrer une année entre 1000 et 2999";
            }
            //Vérifie les dates
            if (response.date_achat == true || response.garde_jusqua == true) {
              document.getElementById("errDate").innerHTML =
                "Veuillez entrer la date sous le format YYYY-MM-DD";
            }
            //Vérifie la quantite
            if (response.quantite == true) {
              document.getElementById("errQt").innerHTML =
                "Veuillez entrer une quantite valide";
            }

            //Permet de confirmer si l'ajout à eu lieu
            if (response == true) {
              document.getElementById("confirmation").innerHTML =
                "Bien ajoutée!";
              document.getElementById("confirmation").style.color = "green";
            } else if (response == false) {
              document.getElementById("confirmation").innerHTML =
                "Ajout non effectuée";
              document.getElementById("confirmation").style.color = "red";
            }
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
      //Permet de reinitaliser rles donnees
      document.getElementById("errMillesime").innerHTML = "";
      document.getElementById("errPrix").innerHTML = "";
      document.getElementById("errDate").innerHTML = "";
      document.getElementById("errQt").innerHTML = "";
      document.getElementById("confirmation").innerHTML = "";

      //Creer un objet qui permet d'aller chercher le GET dans le url
      const urlParams = new URLSearchParams(window.location.search);

      //Permet d'aller chercher les valeurs des inputs
      var param = {
        id: urlParams.get("id"),
        date_achat: document.querySelector("[name='date_achat']").value,
        garde_jusqua: document.querySelector("[name='garde_jusqua']").value,
        notes: document.querySelector("[name='notes']").value,
        prix: document.querySelector("[name='prix']").value,
        quantite: document.querySelector("[name='quantite']").value,
        millesime: document.querySelector("[name='millesime']").value,
        cellier_id: urlParams.get("cellier_id"),
      };
      console.log(param);

      //Permet de creer un objet options pour les requete
      let requete = new Request(
        BaseURL + "index.php?requete=modifierBouteilleCellier",
        {
          method: "PUT",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
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
          //Permet de verifier si il y des erreurs et afficher
          if (response.prix == true) {
            document.getElementById("errPrix").innerHTML =
              "Veuillez entrer un prix valide 00.00";
          }
          //Vérifie le millesime
          if (response.millesime == true) {
            document.getElementById("errMillesime").innerHTML =
              "Veuillez entrer une année entre 1000 et 2999";
          }
          //Vérifie les dates
          if (response.date_achat == true || response.garde_jusqua == true) {
            document.getElementById("errDate").innerHTML =
              "Veuillez entrer la date sous le format YYYY-MM-DD";
          }
          //Vérifie la quantite
          if (response.quantite == true) {
            document.getElementById("errQt").innerHTML =
              "Veuillez entrer une quantite valide";
          }

          //Permet de confirmer si le modifier à eu lieu
          if (response == true) {
            document.getElementById("confirmation").innerHTML =
              "Modfication effectuée!";
            document.getElementById("confirmation").style.color = "green";
          } else if (response == false) {
            document.getElementById("confirmation").innerHTML =
              "Modication non effectuée";
            document.getElementById("confirmation").style.color = "red";
          }
        })
        .catch((error) => {
          console.error(error);
        });
    });
  }

  //Supprimer une  bouteille
  let btnSupprimer = document.querySelector("[name='supprimerBouteille']");
  if (btnSupprimer) {
    btnSupprimer.addEventListener("click", function (evt) {
      //Creer un objet qui permet d'aller chercher le GET dans le url
      const urlParams = new URLSearchParams(window.location.search);

      //Permet d'aller chercher les valeurs des inputs
      var param = {
        id: urlParams.get("id"),
        cellier_id: urlParams.get("cellier_id"),
      };
      console.log(param);

      //Permet de creer un objet options pour les requete
      let requete = new Request(
        BaseURL + "index.php?requete=supprimerBouteilleCellier",
        {
          method: "DELETE",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
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
          //Permet de confirmer si le modifier à eu lieu
          if (response == true) {
            document.getElementById("confirmation").innerHTML =
              "Suppression effectuée!";
            document.getElementById("confirmation").style.color = "green";
          } else if (response == false) {
            document.getElementById("confirmation").innerHTML =
              "Suppression non effectuée";
            document.getElementById("confirmation").style.color = "red";
          }
        })
        .catch((error) => {
          console.error(error);
        });
    });
  }

  /////////fonction partage facebook/////////////
  (function (d, s, id) {
    var js,
      fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  })(document, "script", "facebook-jssdk");

  /////////////fonctio pour afficher ou cacher Filtre du cellier///////////////
  // let btnFiltre = document.getElementById("btnFiltre");
  // let filtre = document.getElementById("filtre");

  // btnFiltre.addEventListener("click", () => {
  //   if (getComputedStyle(filtre).display != "none") {
  //     filtre.style.display = "none";
  //   } else {
  //     filtre.style.display = "block";
  //   }
  // });

  //Modifier une  bouteille
  let btnModifierAdmin = document.querySelector(
    "[name='modifierBouteilleCatalogue']"
  );
  if (btnModifierAdmin) {
    btnModifierAdmin.addEventListener("click", function (evt) {
      //Permet de reinitaliser rles donnees
      document.getElementById("errNom").innerHTML = "";
      document.getElementById("errSaq").innerHTML = "";
      document.getElementById("errPays").innerHTML = "";
      document.getElementById("errPrix").innerHTML = "";
      document.getElementById("errFormat").innerHTML = "";
      document.getElementById("confirmation").innerHTML = "";

      //Creer un objet qui permet d'aller chercher le GET dans le url
      const urlParams = new URLSearchParams(window.location.search);

      //Permet d'aller chercher le slect
      var type = document.querySelector("[name='type']");

      //Permet d'aller chercher les valeurs des inputs
      var param = {
        id: urlParams.get("id"),
        nom: document.querySelector("[name='nom']").value,
        code_saq: document.querySelector("[name='code_saq']").value,
        pays: document.querySelector("[name='pays']").value,
        description: document.querySelector("[name='desc']").value,
        prix: document.querySelector("[name='prix']").value,
        format: document.querySelector("[name='format']").value,
        type: type.options[type.selectedIndex].value,
      };
      console.log(param);

      //Permet de creer un objet options pour les requete
      let requete = new Request(
        BaseURL + "index.php?requete=admin/modifierBouteille",
        {
          method: "PUT",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
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

          //Permet de confirmer si le modifier à eu lieu
          if (response == true) {
            document.getElementById("confirmation").innerHTML =
              "Modfication effectuée!";
            document.getElementById("confirmation").style.color = "green";
          } else if (response == false) {
            document.getElementById("confirmation").innerHTML =
              "Modication non effectuée";
            document.getElementById("confirmation").style.color = "red";
          }
        })
        .catch((error) => {
          console.error(error);
        });
    });
  }

  //Permet de donner des droits de admin au user
  document.querySelectorAll(".droitAdmin").forEach(function (element) {
    console.log(element);

    //Ajoute un event qui vas permettre d'ajouter des bouteilles au ceillier
    element.addEventListener("click", function (evt) {
      //Permet d'aller chercher le id et créer la requête
      let id = evt.target.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=admin/ajouterDroit",
        {
          method: "PUT",
          body: '{"id": ' + id + ', "droit": "admin"}',
          header: "Content-Type: application/json",
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
          location.reload();
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });

  //Permet de donner des droits de utilisateur au user
  document.querySelectorAll(".droitUtilisateur").forEach(function (element) {
    console.log(element);

    //Ajoute un event qui vas permettre d'ajouter des bouteilles au ceillier
    element.addEventListener("click", function (evt) {
      //Permet d'aller chercher le id et créer la requête
      let id = evt.target.dataset.id;
      let requete = new Request(
        BaseURL + "index.php?requete=admin/ajouterDroit",
        {
          method: "PUT",
          body: '{"id": ' + id + ', "droit": "utilisateur"}',
          header: "Content-Type: application/json",
        }
      );
      console.log('{"id": ' + id + ', "droit": "utilisateur"}');
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          location.reload();
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });

  //Permet d'afficher la boite au lettre ou nn
  let btnMail = document.querySelector(".btnmailbox");
  let conteneur = document.querySelector(".message");
  console.log(btnMail);
  if (btnMail) {
    btnMail.addEventListener("click", function (evt) {
      if (conteneur.style.display === "none") {
        conteneur.style.display = "block";
      } else {
        conteneur.style.display = "none";
      }
    });
  }

  //Permet de supprimer un message de la messagerie
  document.querySelectorAll(".supprimerMail").forEach(function (element) {
    //Ajoute un event qui vas permettre d'ajouter des bouteilles au ceillier
    element.addEventListener("click", function (evt) {
      //Permet d'aller chercher le id et créer la requête
      let id = evt.target.dataset.id;

      let requete = new Request(
        BaseURL + "index.php?requete=admin/supprimerMessage",
        {
          method: "DELETE",
          body: '{"id": ' + id + "}",
          header: "Content-Type: application/json",
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
  });

  //Modifier une  bouteille
  let btnSignaler = document.querySelector(".btnSignaler");
  if (btnSignaler) {
    btnSignaler.addEventListener("click", function (evt) {
      //Permet d'aller chercher les valeurs des inputs
      var param = {
        id: urlParams.get("id"),
        date_achat: document.querySelector("[name='date_achat']").value,
        garde_jusqua: document.querySelector("[name='garde_jusqua']").value,
        notes: document.querySelector("[name='notes']").value,
        prix: document.querySelector("[name='prix']").value,
        quantite: document.querySelector("[name='quantite']").value,
        millesime: document.querySelector("[name='millesime']").value,
        cellier_id: urlParams.get("cellier_id"),
      };
      console.log(param);

      //Permet de creer un objet options pour les requete
      let requete = new Request(
        BaseURL + "index.php?requete=modifierBouteilleCellier",
        {
          method: "PUT",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
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
