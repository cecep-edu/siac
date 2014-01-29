$(document).ready(function() {

    // para los mensajes flash
    window.setTimeout(function() {
        $('.siac-message').alert('close');
    }, 5000);

    var colors = ["red", "blue", "green", "yellow", "brown", "black"];

    
    $('#form_ciudad').typeahead({
        source: [
            {id: 1, name: 'Toronto'},
            {id: 2, name: 'Montreal'},
            {id: 3, name: 'New York'},
            {id: 4, name: 'Buffalo'},
            {id: 5, name: 'Boston'},
            {id: 6, name: 'Columbus'},
            {id: 7, name: 'Dallas'},
            {id: 8, name: 'Vancouver'},
            {id: 9, name: 'Seattle'},
            {id: 10, name: 'Los Angeles'}
        ],
        display: 'Name',
        valueField: 'id',
         onSelect: function (item){//item.text 
             //console.log(item);
             $('#form_pais_id').val(item.value); 
         }

    });


});
 