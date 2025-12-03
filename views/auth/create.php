{{ include('layouts/header.php', {title:'Login'})}}

<form class="form-base" method="POST">
    <h2>Connectez-vous! </h2>

    <label for="email">Courriel</label>
    <input id="email" name="email" type="email" />
    {% if errors.email is defined %}
    <span class="error">{{ errors.email }}</span>
    {% endif %}

    <label for="password">Mot de passe</label>
    <input id="password" name="password" type="password" />
    {% if errors.password is defined %}
    <span class="error">{{ errors.password }}</span>
    {% endif %}
    {% if errors.message %}
    <span class="erreur">{{ errors.message }}</span>
    {% endif %}
    <input type="submit" value="Se connecter" class="bouton" />
    <span>Vous n’avez pas de compte ? <a href="{{base}}/user/create">Inscrivez-vous !</a></span>
</form>

{{ include('layouts/footer.php')}}