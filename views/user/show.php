{{ include('layouts/header.php', {title:'User show'})}}

<div class="enchere">
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
        <h1>Mes enchères :</h1>
        <div class="grille">
            {% for auction in auctions %}
            <div class="carte carrousel-carte">
                <div class="carte-detail">
                    <picture>
                        <img class="img-box" src="{{asset}}img/stamp_holder.png" alt="" />
                    </picture>
                    <section class="carte-information">
                        <h2 class="carte-titre">{{ auction.name }}</h2>
                        <p>Prix plancher : {{ auction.price_floor }} $</p>
                        <p>Mise actuelle : {{ auction.current_bid_amount }}$</p>
                        <p>Date de fin : {{ auction.date_end }}</p>
                        <a class="bouton">Enchérir</a>
                    </section>
                </div>
            </div>
            {% endfor %}
        </div>
    </article>
</div>

{{ include('layouts/footer.php')}}