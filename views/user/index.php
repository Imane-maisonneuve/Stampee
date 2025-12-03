{{ include('layouts/header.php', {title:'Liste des user'})}}
<h3>Liste des encheres:</h3>
<table>

    <tr>
        <th>Nom</th>
        <th>Présurname</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Téléphone</th>
        <th>Courriel</th>
        <th>Matricule</th>
        <th>Privilege </th>
        <th>Date de création</th>
    </tr>

    {% for user in users %}
    <tr>
        <td>{{ user.surname }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.adress }}</td>
        <td>{{ user.zipcode }}</td>
        <td>{{ user.phone }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.matricule }}</td>

        {% for privilege in privileges %}
        {% if privilege.id == user.privilegeId %}
        <td>{{ privilege.privilege }}</td>
        {% endif %}
        {% endfor %}

        <td>{{ user.created_at }}</td>
    </tr>
    {% endfor %}
</table>

{% if session.privilege_id ==1 %}
<a href="{{base}}/user/create" class="bouton bouton-submit "> Ajouter un user</a>
{% endif %}

{{ include('layouts/footer.php')}}