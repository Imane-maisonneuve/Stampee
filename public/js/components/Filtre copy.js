import filtre from "./Application.js";

/**
 * classe Filtre qui gère la logique de filtrage des ecnheres
 */
class Filtre {
  #elementHTML;
  #application;
  #listeAuctionsClone;
  #listeStampsClone;
  #filtersChecked;

  /**
   * Le constructeur reçoit une instance de l’application principale
   */
  constructor(application) {
    this.#application = application;

    // Sélection de l’élément HTML contenant les filtres
    this.#elementHTML = document.querySelector("[data-filtres]");

    // Sélection de toutes les checkboxs du formulaire data-filtres
    const listCheckbox = this.#elementHTML.querySelectorAll("[data-categorie]");

    // Initialisation
    this.#filtersChecked = {};

    // Construire la liste des filtres cochés
    this.creerfiltersChecked(listCheckbox);

    // Appliquer le filtre à chaque changement de checkbox
    this.filtrer(this.#filtersChecked, this.#application.listeAuctions);
  }

  creerfiltersChecked(listCheckbox) {
    listCheckbox.forEach((checkbox) => {
      checkbox.addEventListener("change", () => {
        // initialiser
        this.#filtersChecked = {};

        // Verifier tous les checkbox
        listCheckbox.forEach((cb) => {
          if (cb.checked) {
            const categorie = cb.dataset.categorie;
            const valeur = cb.value;

            // Creer la catégorie de filtre si elle n’existe pas encore avec un tableau de valeur vide
            if (!this.#filtersChecked[categorie]) {
              this.#filtersChecked[categorie] = [];
            }

            this.#filtersChecked[categorie].push(valeur);
          }
        });
        console.log(this.#filtersChecked);

        // relancer les filtres
        this.filtrer(this.#filtersChecked);
      });
    });
  }

  // Appliquer les filtres sur la liste des encheres
  filtrer(listFiltres) {
    const dateFormatee = new Date().toISOString().slice(0, 10);

    this.#listeAuctionsClone = [...this.#application.listeAllAuctions];
    this.#listeStampsClone = [...this.#application.listeStamps];

    let totalFiltres = 0;

    let nouvelleListAuctions = [];

    for (const filtre in listFiltres) {
      totalFiltres += listFiltres[filtre].length;
    }
    if (totalFiltres > 0) {
      for (const categorie in listFiltres) {
        if (categorie === "status") {
          listFiltres["status"].forEach((statu) => {
            switch (statu) {
              case "en_cours":
                this.#listeAuctionsClone.forEach((auction) => {
                  if (auction.date_end > dateFormatee) {
                    nouvelleListAuctions.push(auction);
                  }
                });
                break;

              case "archive":
                this.#listeAuctionsClone.forEach((auction) => {
                  if (auction.date_end < dateFormatee) {
                    nouvelleListAuctions.push(auction);
                  }
                });
                break;
            }
          });
        }
        if (categorie === "origine") {
          listFiltres["origine"].forEach((origine) => {
            switch (origine) {
              case "canada":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.origin_id === 1
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "france":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.origin_id === 2
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "maroc":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.origin_id === 3
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "belgique":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.origin_id === 4
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "usa":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.origin_id === 5
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "autre":
                nouvelleListAuctions.push(auction);
                break;
            }
          });
        }
        if (categorie === "condition") {
          listFiltres["condition"].forEach((condition) => {
            switch (condition) {
              case "neuf":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (auction.stamp_id === stamp.id && stamp.state_id === 1) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "oblitere":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (auction.stamp_id === stamp.id && stamp.state_id === 2) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "comme-neuf":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (auction.stamp_id === stamp.id && stamp.state_id === 4) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "Bon-Etat":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (auction.stamp_id === stamp.id && stamp.state_id === 5) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;
            }
          });
        }
        if (categorie === "certification") {
          listFiltres["certification"].forEach((cert) => {
            switch (cert) {
              case "oui":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.certified === 1
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;

              case "non":
                this.#listeAuctionsClone.forEach((auction) => {
                  this.#listeStampsClone.forEach((stamp) => {
                    if (
                      auction.stamp_id === stamp.id &&
                      stamp.certified === 0
                    ) {
                      nouvelleListAuctions.push(auction);
                    }
                  });
                });
                break;
            }
          });
        }
        this.#application.listeAuctions = nouvelleListAuctions;
        this.#application.afficherListeAuctions();
      }
    } else {
      this.#application.listeAuctions = this.#application.listeAllAuctions;
      this.#application.afficherListeAuctions();
    }
  }
}

export default Filtre;
