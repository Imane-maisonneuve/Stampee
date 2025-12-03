{{ include('layouts/header.php', {title:'user edit'})}}
<div class="container">
    <form class="form-base" method="post">

        <h2>{{ user.name}} {{ user.surname}}</h2>

        <label>Telephone</label>
        <input type="text" name="phone" value="{{ user.phone }}">
        {% if errors.phone is defined %}
        <span class="error">{{ errors.phone }}</span>
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

        <input type="hidden" name="id" value="{{ user.id }}">
        <input type="submit" class="bouton" value="Mettre à jour">
    </form>
</div>
{{ include('layouts/footer.php')}}