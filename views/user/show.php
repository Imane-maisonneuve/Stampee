{{ include('layouts/header.php', {title:'User show'})}}

<div class="enchere show">
    <div class="barre-laterale">
        <h2>Mes informations</h2>
        <div class="enchere-detail">
            <div class="enchere-infos">
                <p>Nom</p>
                <p>Prenom</p>
                <p>Addresse</p>
                <p>Code postal</p>
                <p>Telephone</p>
                <p>Courriel</p>
            </div>
            <div class="enchere-infos">
                <p>: {{ user.surname }}.</p>
                <p>: {{ user.name }}.</p>
                <p>: {{ user.adress }}.</p>
                <p>: {{ user.zipcode }}.</p>
                <p>: {{ user.phone }}.</p>
                <p>: {{ user.email }}.</p>
            </div>
        </div>
        <div class="actions">
            <a href="{{base}}/user/edit?id={{ user.id }}" class="bouton">Modifier</a>
            <form class="user-form" action="{{base}}/user/delete" method="post">
                <input type="hidden" name="id" value="{{ user.id }}">
                <input type="submit" value="Supprimer mon compte" class="bouton">
            </form>
        </div>
    </div>
    <article>
        <h1>Mes timbres :</h1>
        <div class="grille">
            {% for stamp in stamps %}
            <div class="carte carrousel-carte">
                <div class="carte-detail">
                    <picture>
                        <img class="img-box" src="{{asset}}img/{{images[stamp.id]}}" alt="" />
                    </picture>
                    <section class="carte-information">
                        <h2 class="carte-titre">{{ stamp.name }}</h2>
                        <p>Date de creation : {{ stamp.date_creation }}</p>
                        {% if isAuction[stamp.id] == 1 %}
                        <marquee>Timbre en enchere !!</marquee>
                        {% else %}
                        <div class="actions">
                            <a href="{{base}}/stamp/edit?id={{ stamp.id }}" class="bouton">Modifier</a>
                            <form class="user-form" action="{{base}}/stamp/delete" method="post">
                                <input type="hidden" name="stamp_id" value="{{ stamp.id }}">
                                <input type="submit" value="Supprimer" class="bouton">
                            </form>
                        </div>
                        {% endif %}
                    </section>
                </div>
            </div>
            {% endfor %}
        </div>
        <br>
        <a href="{{base}}/stamp/create" class="bouton-submit">Ajouter un timbre</a>
    </article>
</div>

{{ include('layouts/footer.php')}}