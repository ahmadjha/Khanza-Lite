$(document).ready(function(){
    $("#user-checkbox").DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        order: [0, 'asc'],
        columnDefs: [
            {
                width: "40px",
                targets: 0
            },
            {
                responsivePriority: 1,
                targets: 1
            },
            {
                className: 'control',
                targets: 6
            },
            {
                width: "160px",
                orderable: false,
                targets: 7
            }
        ],
        bFilter: !0,
        bLengthChange: !0,
        pagingType: "simple",
        paging: !0,
        searching: !0,
        language: {
            info: " _START_ - _END_ of _TOTAL_ ",
            sLengthMenu: "<span class='custom-select-title'>Rows per page:</span> <span class='pmd-custom-select'> _MENU_ </span>",
            sSearch: "",
            sSearchPlaceholder: "Search",
            paginate: { sNext: " ", sPrevious: " " },
        },
        dom:
            "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search ml-sm-auto'f>><'custom-select-info align-items-center'<'custom-select-item'><'custom-select-action'>><'row'<'col-sm-12'tr>><'card-footer' <'pmd-datatable-pagination' l i p>>",
    }),
    $("#user-checkbox_wrapper .custom-select-info").hide();
    var t = $("#user-checkbox").DataTable().rows().count();
    $("#user-checkbox_wrapper .data-table-title").html('<h2 class="card-title">Total User: ' + t + "</h2>");
    $("#user-checkbox_wrapper .custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-dark" type="button" data-target="#delete_user_modal" data-toggle="modal" title="Delete"><i class="material-icons pmd-sm">delete_outline</i></button>'
    );
});

$('#delete_user_modal').on('show.bs.modal', function (event) {
  let userId = $(event.relatedTarget).data('userid')
  //$(this).find('.modal-body input').val(userId)
  $("#userId").attr("href", userId);
})
