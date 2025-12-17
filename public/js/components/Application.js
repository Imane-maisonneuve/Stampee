import Filtre from "../components/Filtre.js";

class Application {
  listeAuctions;
  listeStamps;
  listeImages;
  asset;
  base;
  amounts;
  #listeAuctionsHTML;
  #conteneurHTML;
  #filtre;

  constructor(listeAuctions, listeStamps, listeImages, asset, base, amounts) {
    this.listeAuctions = listeAuctions;
    this.listeAllAuctions = listeAuctions;
    this.listeStamps = listeStamps;
    this.listeImages = listeImages;
    this.asset = asset;
    this.base = base;
    this.amounts = amounts;

    this.#conteneurHTML = document.querySelector("[data-application]");
    this.#listeAuctionsHTML = this.#conteneurHTML.querySelector(
      "[data-conteneur-encheres]"
    );

    this.afficherListeAuctions();

    this.#filtre = new Filtre(this);
  }

  // modifier la liste des encheres
  set listeAuctions(nouvelleListe) {
    this.listeAuctions = nouvelleListe;
  }

  afficherListeAuctions() {
    this.#listeAuctionsHTML.innerHTML = "";
    this.listeAuctions.forEach((auction) => {
      this.listeStamps.forEach((stamp) => {
        if (auction.stamp_id === stamp.id) {
          this.injecterHTML(auction, stamp);
        }
      });
    });
  }

  injecterHTML(auction, stamp) {
    const image = this.listeImages[stamp.id];
    const amount = this.amounts[auction.id];
    const gabarit = `<div class="carte carrousel-carte">
                <div class="carte-detail">
                    <picture>
                        <img class="img-box" src="${this.asset}img/${image}" alt="" />
                    </picture>
                    <section class="carte-information">
                        <h2 class="carte-titre">${stamp.name}</h2>
                        <p>Mise actuelle :<strong>${amount}$</strong></p>
                        <div class="actions">
                            <a href="${this.base}/auction/show?id=${auction.id}" class="bouton">Enchérir</a>
                        </div>
                        <small>Date de fin : ${auction.date_end}</small>
                    </section>
                </div>
            </div>`;
    this.#listeAuctionsHTML.insertAdjacentHTML("beforeend", gabarit);
  }
}
export default Application;
