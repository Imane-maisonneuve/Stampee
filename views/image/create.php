{{ include('layouts/header.php', {title:'Image Create'})}}
<div>

    <form class="form-base" action="{{base}}/image/create" method="post" enctype="multipart/form-data">
        <label>Telecharger l'image principale</label>
        <input type="file" name="main_image" id="" value="{{ image.main_image }}">
        {% if errors.main_image is defined %}
        <span class="error">{{ errors.main_image }}</span>
        {% endif %}

        <label>Telecharger une image secondaire</label>
        <input type="file" name="additional_image" id="" value="{{ image.additional_image }}">
        {% if errors.additional_image is defined %}
        <span class="error">{{ errors.additional_image }}</span>
        {% endif %}
        <input type="hidden" name="stamp_id" value="{{stamp_id}}">

        <input type="submit" class="bouton" value="Telecharger">
    </form>
</div>
{{ include('layouts/footer.php')}}