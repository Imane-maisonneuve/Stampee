{{ include('layouts/header.php', {title:'Auction index'})}}

<script id="auction-data" type="application/json">
{{ {
  auctions: auctions,
  stamps: stamps,
  images:images,
  asset:asset,
  base:base,
  amounts:amounts,
  session_user_id : session.user_id
}|json_encode|raw }}
</script>


<div class="enchere">

    <aside class="barre-laterale">
        <form data-filtres>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Coups de coeur de Lord❤️</h4>
                </legend>
                <label><input data-categorie="coups-de-coeur"
                        type="checkbox"
                        name="type"
                        value="coeur" />Coups de coeur de Lord
                </label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Types de vente</h4>
                </legend>
                <label><input data-categorie="status"
                        type="checkbox"
                        name="type"
                        value="en_cours" />En cours
                </label>
                <label>
                    <input data-categorie="status"
                        type="checkbox"
                        name="type"
                        value="archive" />Archivées
                </label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Origine</h4>
                </legend>
                <label><input data-categorie="origine"
                        type="checkbox"
                        name="origine-Europe"
                        value="canada" />Canada
                </label>
                <label><input data-categorie="origine"
                        type="checkbox"
                        name="origine"
                        value="maroc" /> Maroc
                </label>
                <label><input data-categorie="origine"
                        type="checkbox"
                        name="origine"
                        value="belgique" />Belgique
                </label>
                <label><input data-categorie="origine"
                        type="checkbox"
                        name="origine"
                        value="france" />France
                </label>
                <label><input data-categorie="origine"
                        type="checkbox"
                        name="origine"
                        value="usa" />États-Unis
                </label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Condition</h4>
                </legend>
                <label><input data-categorie="condition"
                        type="checkbox"
                        name="condition"
                        value="neuf" />Neuf
                </label>
                <label><input data-categorie="condition"
                        type="checkbox"
                        name="condition"
                        value="oblitere" />Oblitéré
                </label>
                <label><input data-categorie="condition"
                        type="checkbox"
                        name="condition"
                        value="comme-neuf" />Comme neuf
                </label>
                <label><input data-categorie="condition"
                        type="checkbox"
                        name="condition"
                        value="Bon-Etat" />Bon état
                </label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Certification</h4>
                </legend>
                <label><input data-categorie="certification"
                        type="checkbox"
                        name="certification"
                        value="oui" />Oui
                </label>
                <label><input data-categorie="ertification"
                        type="checkbox"
                        name="certification"
                        value="non" />Non
                </label>
            </fieldset>
        </form>
    </aside>
    <article data-application>
        <h1>Les Meilleures Enchères de Timbres pour Collectionneurs Passionnés</h1>
        <div class="grille" data-conteneur-encheres>
            {% for auction in auctions %}
            {% for stamp in stamps %}
            {% if stamp.id == auction.stamp_id %}
            <div class="carte carrousel-carte">
                <div class="carte-detail">
                    <picture>
                        <img class="img-box" src="{{asset}}img/{{images[stamp.id]}}" alt="" />
                    </picture>
                    <section class="carte-information">
                        <h2 class="carte-titre">{{ stamp.name }}</h2>
                        <p>Mise actuelle :<strong>{{ amounts[auction.id] }} $</strong></p>
                        {% if auction.date_end|date("U") < "now"|date("U")  %}
                        <div class="actions">
                            <a href="{{base}}/auction/show?id={{ auction.id }}" class="bouton">Terminé</a>
                        </div>
                        {% else %}
                        <div class="actions">
                            <a href="{{base}}/auction/show?id={{ auction.id }}" class="bouton">Enchérir</a>
                        </div>
                        {% endif %}
                        <small>Date de fin : {{ auction.date_end }}</small>
                    </section>
                </div>
            </div>
            {% endif %}
            {% endfor %}
            {% endfor %}
        </div>

    </article>
</div>

{{ include('layouts/footer.php')}}