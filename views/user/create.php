{{ include('layouts/header.php', {title:'User Create'})}}
<div>

    <form class="form-base" method="post">

        <h2>Créez votre compte</h2>

        <label>Prenom</label>
        <input type="text" name="name" value="{{ user.name }}">
        {% if errors.name is defined %}
        <span class="error">{{ errors.name }}</span>
        {% endif %}

        <label>Nom</label>
        <input type="text" name="surname" value="{{ user.surname }}">
        {% if errors.surname is defined %}
        <span class="error">{{ errors.surname }}</span>
        {% endif %}


        <label>Telephone</label>
        <input type="text" name="phone" value="{{ user.phone }}">
        {% if errors.phone is defined %}
        <span class="error">{{ errors.phone }}</span>
        {% endif %}

        <label>Courriel</label>
        <input type="email" name="email" value="{{ user.email }}">
        {% if errors.email is defined %}
        <span class="error">{{ errors.email }}</span>
        {% endif %}

        <label>Mot De Passe</label>
        <input type="password" name="password" value="{{ user.password }}">
        {% if errors.password is defined %}
        <span class="error">{{ errors.password }}</span>
        {% endif %}


        <label>Adresse</label>
        <input type="text" name="adress" value="{{ user.adress }}">
        {% if errors.adress is defined %}
        <span class="error">{{ errors.adress }}</span>
        {% endif %}

        <label>Code Postal</label>
        <input type="text" name="zipcode" value="{{ user.zipcode }}">
        {% if errors.zipcode is defined %}
        <span class="error">{{ errors.zipcode }}</span>
        {% endif %}


        <input type="submit" class="bouton-submit" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php')}}