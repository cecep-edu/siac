$(document).ready(function() {

    // para los mensajes flash
    window.setTimeout(function() {
        $('.siac-message').alert('close');
    }, 5000);


    autocompletado('pais', 'pais_id', '../paises/getpaises?');
    autocompletado('ciudad', 'ciudad_residencia_id', '../paises/getciudades?');
    autocompletado('idioma', 'id_lenguaje', '../idioma/getidiomas?');

    /**
     * 
     * @param {type} campo_nombre : id del campo temporal donde aparecen los paises
     * @param {type} campo_id : campo de la tabla oculto donde se guarad el código.
     * @param {type} url : la url de donde se llama el metodo que devuelve el json.
     * @returns {undefined} : un listado de ciudades
     */
    function autocompletado(campo_nombre, campo_id, url) {
        $('#form_' + campo_nombre).typeahead({
            ajax: url, //../paises/getpaises?
            display: 'value',
            valueField: 'id',
            onSelect: function(item) {
                $('#form_' + campo_id).val(item.value);
            }
        });
    }



});
 