{{ include('layouts/header.php', {title:'Auction index'})}}
<marquee>
    <h1> Catalogue des encheres - En construction</h1>
</marquee>

<!-- {% for auction in auctions %}
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
            {% endfor %} -->

{{ include('layouts/footer.php')}}