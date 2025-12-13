{{ include('layouts/header.php', {title:'Auction index'})}}

<div class="enchere">

    <aside class="barre-laterale">
        <form>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Types de vente</h4>
                </legend>
                <label><input type="checkbox" name="type" value="en_cours" />En
                    cours</label>
                <label>
                    <input
                        type="checkbox"
                        name="type"
                        value="archive" />Archivées</label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Date d'ajout</h4>
                </legend>
                <label><input
                        type="checkbox"
                        name="Date"
                        value="Aujourdhui" />Aujourd'hui</label>
                <label><input type="checkbox" name="Date" value="semaine" />Cette
                    semaine</label>
                <label><input type="checkbox" name="Date" value="mois" />Ce mois</label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Origine</h4>
                </legend>
                <label><input
                        type="checkbox"
                        name="origine"
                        value="europe" />Europe</label>
                <label><input type="checkbox" name="origine" value="asie" /> Asie</label>
                <label><input
                        type="checkbox"
                        name="origine"
                        value="afrique" />Afrique</label>
                <label><input
                        type="checkbox"
                        name="origine"
                        value="canada" />Canada</label>
                <label><input
                        type="checkbox"
                        name="origine"
                        value="usa" />États-Unis</label>
                <label><input type="checkbox" name="origine" value="oceanie" />Australie
                    et Océanie</label>
                <label><input
                        type="checkbox"
                        name="origine"
                        value="gb" />Grande-Bretagne</label>
                <label><input type="checkbox" name="origine" value="ameriques" />Monde
                    entier</label>
            </fieldset>

            <fieldset class="filtres-form">
                <legend>
                    <h4>Condition</h4>
                </legend>
                <label><input
                        type="checkbox"
                        name="condition"
                        value="parfaite" />Parfaite</label>
                <label><input
                        type="checkbox"
                        name="condition"
                        value="excellente" />Excellente</label>
                <label><input
                        type="checkbox"
                        name="condition"
                        value="bonne" />Bonne</label>
                <label><input
                        type="checkbox"
                        name="condition"
                        value="moyenne" />Moyenne</label>
            </fieldset>
            <fieldset class="filtres-form">
                <legend>
                    <h4>Certification</h4>
                </legend>
                <label><input
                        type="checkbox"
                        name="certification"
                        value="oui" />Oui</label>
                <label><input
                        type="checkbox"
                        name="certification"
                        value="non" />Non</label>
            </fieldset>
        </form>
    </aside>
    <article>
        <h1>Les Meilleures Enchères de Timbres pour Collectionneurs Passionnés</h1>
        <div class="grille">
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
                        <div class="actions">
                            <a href="{{base}}/auction/show?id={{ auction.id }}" class="bouton">Enchérir</a>
                        </div>
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