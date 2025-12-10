{{ include('layouts/header.php', {title:'Stamp Create'})}}
<div>

    <form class="form-base" method="post">

        <h2>Créez votre timbre</h2>

        <label>Nom du timbre</label>
        <input type="text" name="name" value="{{ stamp.name }}">
        {% if errors.name is defined %}
        <span class="error">{{ errors.name }}</span>
        {% endif %}


        <label>Certifié ?</label><br>

        <label>
            <input type="radio" name="certified" value="1"
                {% if stamp.certifie is defined and stamp.certifie == 1 %} checked {% endif %}>
            Oui
        </label>

        <label>
            <input type="radio" name="certified" value="0"
                {% if stamp.certifie is not defined or stamp.certifie == 0 %} checked {% endif %}>
            Non
        </label>

        {% if errors.certified is defined %}
        <span class="error">{{ errors.certified }}</span>
        {% endif %}

        <label>Tirage</label>
        <input type="number" name="print_run" value="{{ stamp.print_run }}">
        {% if errors.print_run is defined %}
        <span class="error">{{ errors.print_run }}</span>
        {% endif %}

        <label>Hauteur</label>
        <input type="number" name="height" value="{{ stamp.height }}">
        {% if errors.height is defined %}
        <span class="error">{{ errors.height }}</span>
        {% endif %}

        <label>Largeur</label>
        <input type="number" name="width" value="{{ stamp.width }}">
        {% if errors.width is defined %}
        <span class="error">{{ errors.width }}</span>
        {% endif %}

        <label>Pays d'origine</label>
        <select name="origin_id">
            <option value="">Select</option>
            {% for origin in origins %}
            <option value="{{ origin.id }}" {% if origin.id == stamp.origin_id %} selected {% endif %}>{{ origin.pays }}</option>
            {% endfor %}
        </select>

        {% if errors.origin_id is defined %}
        <span class="error">{{ errors.origin_id }}</span>
        {% endif %}

        <label>Couleur</label>
        <select name="color_id">
            <option value="">Select</option>
            {% for color in colors %}
            <option value="{{ color.id }}" {% if color.id == stamp.color_id %} selected {% endif %}>{{ color.color }}</option>
            {% endfor %}
        </select>

        {% if errors.color_id is defined %}
        <span class="error">{{ errors.color_id }}</span>
        {% endif %}

        <input type="hidden" name="user_id" value="{{ session.user_id }}">

        <label>Etat du timbre</label>
        <select name="state_id">
            <option value="">Select</option>
            {% for state in states %}
            <option value="{{ state.id }}" {% if state.id == stamp.state_id %} selected {% endif %}>{{ state.state }}</option>
            {% endfor %}
        </select>

        {% if errors.state_id is defined %}
        <span class="error">{{ errors.state_id}}</span>
        {% endif %}

        <input type="submit" class="bouton" value="Enregistrer">
    </form>


</div>
{{ include('layouts/footer.php')}}