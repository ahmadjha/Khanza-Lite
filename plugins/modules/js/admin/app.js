$(document).ready(function () {
    $("#module-lists").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        order: [0, "asc"],
        columnDefs: [
            { width: "40px", targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { className: "control", targets: 4 },
            { width: "160px", orderable: !1, targets: 5 },
        ],
        bFilter: !0,
        bLengthChange: !0,
        pagingType: "simple",
        paging: !0,
        bDestroy: !0,
        searching: !0,
        language: {
            info: " _START_ - _END_ of _TOTAL_ ",
            sLengthMenu: "<span class='custom-select-title'>Rows per page:</span> <span class='pmd-custom-select'> _MENU_ </span>",
            sSearch: "",
            sSearchPlaceholder: "Search",
            paginate: { sNext: " ", sPrevious: " " },
        },
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>><'row'<'col-sm-12'tr>><'card-footer' <'pmd-datatable-pagination' l i p>>",
    }),
        $("#module-lists_wrapper .custom-select-info").hide();
    var t = $("#module-lists").DataTable().rows().count();
    $("#module-lists_wrapper .data-table-title").html('<h2 class="card-title">Total Modul: ' + t + "</h2>"),
        $("#module-lists_wrapper .custom-select-action").html(
            '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
        );
});
