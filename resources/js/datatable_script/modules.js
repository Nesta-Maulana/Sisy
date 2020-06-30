// Setup - add a text input to each footer cell
$('#manage-menu-table thead tr').clone(true).appendTo( '#manage-menu-table thead' );
$('#manage-menu-table thead tr:eq(1) th').each( function (i) {
    var title = $(this).text();
    $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );

    $( 'input', this ).on( 'keyup change', function () {
        if ( manage_menu.column(i).search() !== this.value ) {
            manage_menu
                .column(i)
                .search( this.value )
                .draw();
        }
    } );
} );
 
var manage_menu = $('#manage-menu-table').DataTable( {
    orderCellsTop: true,
    fixedHeader: true,
    pageLength:7,
    "scrollX": true,
    "pagingType":"simple"
} );


$('#manage-menu-permission-table').DataTable( {
    "scrollX":true,
    initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    }
} );
var manage_application = $('#manage-application-table').DataTable( {
    orderCellsTop: true,
    fixedHeader: true,
    pageLength:7,
    "scrollX": true,
    "pagingType":"simple"

} );

$('#manage-application-permission-table').DataTable( {
    // "scrollX":true,
    initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    }
} );


var filling_machine_table = $('#filling-machine-table').DataTable({
    bLengthChange:false,
    bFilter:true,
    bInfo:false,
    paging:true,
    pageLength:7,
    "scrollX":true,
    "pagingType":"simple"

});

var add_menu_permission_table = $('#add-menu-permission-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:false,
    pageLength:7,
    "pagingType":"simple"

});
    
var add_application_permission_table = $('#add-application-permission-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:false,
    "pagingType":"simple"

});


$('#product-data-table thead tr').clone(true).appendTo( '#product-data-table thead' );
$('#product-data-table thead tr:eq(1) th').each( function (i) {
    var title = $(this).text();
    $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );

    $( 'input', this ).on( 'keyup change', function () {
        if ( product_data_table.column(i).search() !== this.value ) {
            product_data_table
                .column(i)
                .search( this.value )
                .draw();
        }
    } );
} );
var product_data_table = $('#product-data-table').DataTable( {
    orderCellsTop: true,
    fixedHeader: true,
    pageLength:7,
    "scrollX": true,
    "pagingType":"simple"

} );

var flowmeter_categories_table = $('#flowmeter-categories-table').DataTable({
    bLengthChange:false,
    bFilter:true,
    bInfo:false,
    paging:true,
    pageLength:5,
    "scrollX":true,
    "pagingType":"simple"

});



var production_schedules_table = $('#production-schedules-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:true,
    "scrollX": true,
    aaSorting:[['4','asc']],
/*     dom: 'Bfrtip',
    columnDefs: [
        {
            targets: 1,
            className: 'noVis'
        }
    ], */
    buttons: [ 'colvis' ] 
});
production_schedules_table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');


var production_schedules_draft_table = $('#production-schedule-draft-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:false,
    pageLength:50,
    aaSorting:[['3','asc']],
    "scrollX": true
});

var rpd_filling_dashboard_table = $('#rpd-filling-dashboard-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:true,
    pageLength:20,
    aaSorting:[['2','asc']],
    "scrollX": true
});

var draft_analisa_rpd =  $('#draft-analisa-rpd').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    paging:false,
    aaSorting: [[2,'asc'],[3,'asc']] 
});


var done_analisa_rpd =  $('#done-analisa-rpd').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    paging:false,
    aaSorting: [[2,'desc'],[3,'desc']] 
});


var dashboard_cpp_produk_tabel =  $('#dashboard-cpp-produk-tabel').dataTable({
    bFilter:false,
    aaSorting: [[2,'asc']],
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    paging:true ,
    "scrollX": true
});


var fisikokimia_dashboard_table =  $('#fisikokimia-dashboard-table').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX": true,
    aaSorting: [[1,'desc'],[2,'asc']],
});

var fisikokimia_dashboard_done_table =  $('#fisikokimia-dashboard-done-table').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX": true,
    aaSorting: [[1,'desc'],[2,'asc']],
});


var analisa_mikro_dashboard_table =  $('#analisa-mikro-dashboard-table').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX": true,
    aaSorting: [[4,'asc']],
});
var analisa_mikro_dashboard_tabledone =  $('#analisa-mikro-dashboard-tabledone').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX": true,
    aaSorting: [[4,'asc']],
});

var analisa_mikro_form_tba =  $('.analisa-mikro-form').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:10,
    paging:false,
    aaSorting: [[0,'asc']],
});


var ppq_produk_dashboard_table =  $('#ppq-produk-dashboard-table').dataTable({
    bFilter:false,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX": true,
    aaSorting:[['1','asc']],
    dom: 'Bfrtip',
    columnDefs: [
        {
            targets: 1,
            className: 'noVis'
        }
    ],
    buttons: [
        {
            text: 'Filter Column',
            extend: 'colvis',
            columns: ':not(.noVis)'
        }
    ]
});

var report_release_produk_dashboard =  $('#report-release-produk-dashboard').dataTable({
    bFilter:true,
    bInfo:false,
    bLengthChange:false,
    pageLength:25,
    "scrollX":true,
    aaSorting:[['1','asc']],
    dom: 'Bfrtip',
    columnDefs: [
        {
            targets: 1,
            className: 'noVis'
        }
    ],
    buttons: [ 'copy', 'csv','colvis' ],
    initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control select2"><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    },
});


var permintaan_sampel_table = $('#permintaan-sampel-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:false,
    pageLength:7,
    "scrollX":true,
});

var permintaan_sampel_rtd_table = $('#permintaan-sampel-rtd-table').DataTable({
    bLengthChange:false,
    bFilter:false,
    bInfo:false,
    paging:false,
    pageLength:7,
    "scrollX":true,
});