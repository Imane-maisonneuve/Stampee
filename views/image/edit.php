{{ include('layouts/header.php', {title:'Image edit'})}}
<div>

    <form class="form-base" method="post" enctype="multipart/form-data">
        <label>Modifier l'image principale</label>
        <img src="{{asset}}img/{{ image.main_image }}" alt="">
        <input type="file" name="main_image" id="" value="{{ image.main_image }}">
        {% if errors.main_image is defined %}
        <span class="error">{{ errors.main_image }}</span>
        {% endif %}

        <label>Modifier ou ajouter une image secondaire</label>
        <img src="{{asset}}img/{{ image.additional_image }}" alt="">
        <input type="file" name="additional_image" id="" value="{{ image.additional_image }}">
        {% if errors.additional_image is defined %}
        <span class="error">{{ errors.additional_image }}</span>
        {% endif %}
        <input type="hidden" name="stamp_id" value="{{stamp_id}}">

        <input type="submit" class="bouton" value="Modifier">
    </form>
</div>
{{ include('layouts/footer.php')}}