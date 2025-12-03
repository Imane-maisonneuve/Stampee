{{ include('layouts/header.php', {title:'User show'})}}

<section class="user-section">
    <div class="user-card">
        <h1 class="user-title">Mes informations :</h1>
        <p class="user-info"><strong>Nom: </strong>{{ user.surname }}</p>
        <p class="user-info"><strong>Prenom: </strong>{{ user.name }}</p>
        <p class="user-info"><strong>Addresse: </strong>{{ user.adress }}</p>
        <p class="user-info"><strong>Code postal: </strong>{{ user.zipcode }}</p>
        <p class="user-info"><strong>Telephone: </strong>{{ user.phone }}</p>
        <p class="user-info"><strong>Email: </strong>{{ user.email }}</p>

        <a href="{{base}}/user/edit?id={{ user.id }}" class="bouton">Modifier</a>
        <form class="user-form" action="{{base}}/user/delete" method="post">
            <input type="hidden" name="id" value="{{ user.id }}">
            <input type="submit" value="Supprimer mon compte" class="bouton ">
        </form>
    </div>
</section>

{{ include('layouts/footer.php')}}