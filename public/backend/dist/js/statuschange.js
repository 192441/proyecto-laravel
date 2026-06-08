$(document).ready(function() {
    // Inicializar DataTable si existe
    
        $("#example1").DataTable();
    

    // Manejar el evento de cambio para cualquier elemento con la clase toggle-class
    $(document).on('change', '.toggle-class', function() {
        var isChecked = $(this).prop('checked');
        var elementType = $(this).data('type');
        var elementId = $(this).data('id');
        var url = '';

        // Configurar la URL según el tipo de elemento
        switch (elementType) {
            case 'cliente':
                url = '/cambioestadocliente/' + elementId;
                break;
            
        }

        // Realizar la solicitud AJAX
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: {
                'estado': isChecked ? 1 : 0,
                'id': elementId
            },
            success: function(data) {
                console.log('Se ha cambiado el estado del ' + elementType + ' correctamente.');
                if (data.success) {
                    // Mostrar mensaje de éxito si lo deseas
                    toastr.success(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cambiar el estado del ' + elementType + ': ' + error);
                // Revertir el checkbox si hubo error
                $(this).prop('checked', !isChecked);
            }
        });
    });
});