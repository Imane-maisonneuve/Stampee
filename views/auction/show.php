{{ include('layouts/header.php', {title:'Auction show'})}}

<div id="main-enchere">
    <main>
        <div class="enchere">
            <div>
                <div class="enchere-image-box">
                    <picture class="enchere-timbre-image">
                        <img src="{{asset}}img/{{image.main_image}}" alt="timbre" />
                    </picture>
                </div>
                <div class="enchere-description">
                    <h2>Description :</h2>
                    <div>
                        <p><strong>Nom:</strong> {{ stamp.name }}.</p>
                        <p><strong>Date :</strong> {{ stamp.name }}.</p>
                        <p><strong>Pays :</strong> {{origin.pays}}.</p>
                        <p><strong>Couleur(s) :</strong> {{color.color}}.</p>
                        <p><strong>Condition :</strong> {{state.state}}.</p>
                        <p><strong>Tirage :</strong> {{stamp.print_run}}.</p>
                        <p><strong>Dimensions :</strong> Environ {{stamp.height}} × {{stamp.width}}.</p>
                        {% if stamp.certified == 1 %}
                        <p><strong>Certifié :</strong> Oui.</p>
                        {% else %}
                        <p><strong>Certifié :</strong> Non.</p>
                        {% endif %}
                    </div>
                </div>
            </div>
            <section class="enchere-box">
                <h2>{{ stamp.name }}</h2>
                <div class="enchere-detail">
                    <div class="enchere-infos">
                        <p>Date de début</p>
                        <p>Date de fin</p>
                        <p>Prix plancher</p>
                        <p>Mise actuelle</p>
                    </div>
                    <div class="enchere-infos">
                        <p>: {{ auction.date_start }}.</p>
                        <p>: {{ auction.date_end }}</p>
                        <p>: {{ auction.price_floor }}$.</p>
                        <p>: {{ userBid.bid_amount }} $.</p>
                    </div>
                </div>

                {%if isAuthenticated %}
                <form class="bid-form" method="post">
                    <input type="hidden" name="user_id" value="{{ session.user_id }}">
                    <input type="hidden" name="auction_id" value="{{ auction.id }}">
                    <input class="mise-input" placeholder="Placer Votre mise" type="number" name="bid_amount" value="{{ userBid.bid_amount }}">
                    {% if errors.bid_amount is defined %}
                    <span class="error">{{ errors.bid_amount }}</span>
                    {% endif %}
                    <input type="submit" value="Enchérir" class="bouton">
                </form>
                {% else %}
                <a href="{{base}}/login" class="bouton">Se connecter pour enchérir</a>
                {% endif %}

                <div class="enchere-detail">
                    <div class="enchere-infos">
                        {% if historiqueBids %}
                        <p>Historique des mises :</p>
                        {% endif %}
                    </div>
                    <div class="enchere-infos">
                        {% for historiqueBid in historiqueBids %}
                        <p> {{ historiqueBid.bid_date }}, {{ historiqueUsers[historiqueBid.user_id] }} a misé {{ historiqueBid.bid_amount }}$.</p>
                        {% endfor %}
                    </div>
                </div>
            </section>
        </div>
        </section>
    </main>
</div>

{% include('layouts/footer.php')%}