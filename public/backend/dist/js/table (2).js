class CustomDataTable {
    constructor(id) {
        this.id = id;
        this.initializeDataTable();
    }

    initializeDataTable() {
        $(this.id).DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                sLengthMenu: "Mostrar _MENU_ entradas",
                sEmptyTable: "No hay datos disponibles en la tabla",
                sInfo: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                sInfoEmpty: "Mostrando 0 a 0 de 0 entradas",
                sSearch: "Buscar:",
                sZeroRecords: "No se encontraron registros coincidentes en la tabla",
                sInfoFiltered: "(Filtrado de _MAX_ entradas totales)",
                oPaginate: {
                    sFirst: "Primero",
                    sPrevious: "Anterior",
                    sNext: "Siguiente",
                    sLast: "Último"
                }
            }
        });
    }
}

// Uso de la clase CustomDataTable
$(document).ready(function() {
    const myDataTable = new CustomDataTable('#example1');
});