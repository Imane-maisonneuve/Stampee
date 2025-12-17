import Application from "../components/Application.js";
// Variables globales

// Sélections HTML

// Fonctions
function initialiser() {
  const data = JSON.parse(document.getElementById("auction-data").textContent);

  const auctions = data.auctions;
  const stamps = data.stamps;
  const images = data.images;
  const asset = data.asset;
  const base = data.base;
  const amounts = data.amounts;
  const application = new Application(
    auctions,
    stamps,
    images,
    asset,
    base,
    amounts
  );
}

// Exécution
initialiser();
