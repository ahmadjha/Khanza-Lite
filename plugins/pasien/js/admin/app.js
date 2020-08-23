function cekNokaBPJS(){
    var no_peserta = $("#no_peserta").val();
    $.ajax({
        url: '{?=url()?}/admin/pasien/noka_bpjs?noka='+no_peserta+'&t={?=$_SESSION['token']?}',
    }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        console.log(obj);
        $('#nm_pasien').val(obj.response.peserta.nama);
        $('#no_ktp').val(obj.response.peserta.nik);
        $('#tgl_lahir').val(obj.response.peserta.tglLahir);
        $('#no_tlp').val(obj.response.peserta.mr.noTelepon);
    });
}

function cekNikBPJS(){
    var no_ktp = $("#no_ktp").val();
    $.ajax({
        url: '{?=url()?}/admin/pasien/nik_bpjs?nik='+no_ktp+'&t={?=$_SESSION['token']?}',
    }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        console.log(obj);
        $('#nm_pasien').val(obj.response.peserta.nama);
        $('#no_peserta').val(obj.response.peserta.noKartu);
        $('#tgl_lahir').val(obj.response.peserta.tglLahir);
        $('#no_tlp').val(obj.response.peserta.mr.noTelepon);
    });
}

// Avatar
var reader  = new FileReader();
reader.addEventListener("load", function() {
  $("#photoPreview").attr('src', reader.result);
}, false);
$("input[name=photo]").change(function() {
  reader.readAsDataURL(this.files[0]);
});

// Datepicker
$( function() {
  $( ".datepicker" ).datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
    yearRange: "-100:+0",
  });
} );

$(document).ready(function(){
    $.ajax({
      type: 'GET',
      url: '{?=url()?}/admin/pasien/ajax?show=propinsi&t={?=$_SESSION['token']?}',
      success: function(response) {
        $('#propinsi').html(response);
        $('.propinsi').DataTable({
          "lengthChange": false,
          "scrollX": true
        });
        console.log(response);
      }
    })
});

$(document).on('click', '.pilihpropinsi', function (e) {
  $("#kd_prop")[0].value = $(this).attr('data-kdprop');
  $("#namaprop")[0].value = $(this).attr('data-namaprop');
  $('#propinsiModal').modal('hide');
  var kd_prop = $(this).attr('data-kdprop');
  $.ajax({
    type: 'GET',
    url: '{?=url()?}/admin/pasien/ajax?show=kabupaten&kd_prop='+kd_prop+'&t={?=$_SESSION['token']?}',
    success: function(response) {
      $('#kabupaten').html(response);
      $('.kabupaten').DataTable({
        "lengthChange": false,
        "scrollX": true
      });
      console.log(kd_prop);
    }
  })
});

$(document).on('click', '.pilihkabupaten', function (e) {
  $("#kd_kab")[0].value = $(this).attr('data-kdkab');
  $("#namakab")[0].value = $(this).attr('data-namakab');
  $('#kabupatenModal').modal('hide');
  var kd_kab = $(this).attr('data-kdkab');
  $.ajax({
    type: 'GET',
    url: '{?=url()?}/admin/pasien/ajax?show=kecamatan&kd_kab='+kd_kab+'&t={?=$_SESSION['token']?}',
    success: function(response) {
      $('#kecamatan').html(response);
      $('.kecamatan').DataTable({
        "lengthChange": false,
        "scrollX": true
      });
      console.log(response);
    }
  })
});

$(document).on('click', '.pilihkecamatan', function (e) {
  $("#kd_kec")[0].value = $(this).attr('data-kdkec');
  $("#namakec")[0].value = $(this).attr('data-namakec');
  $('#kecamatanModal').modal('hide');
  var kd_kec = $(this).attr('data-kdkec');
  $.ajax({
    type: 'GET',
    url: '{?=url()?}/admin/pasien/ajax?show=kelurahan&kd_kec='+kd_kec+'&t={?=$_SESSION['token']?}',
    success: function(response) {
      $('#kelurahan').html(response);
      $('.kelurahan').DataTable({
        "lengthChange": false,
        "scrollX": true
      });
      console.log(response);
    }
  })
});

$(document).on('click', '.pilihkelurahan', function (e) {
    $("#kd_kel")[0].value = $(this).attr('data-kdkel');
    $("#namakel")[0].value = $(this).attr('data-namakel');
    $('#kelurahanModal').modal('hide');
});

$("#copy_alamat").click(function(){
    $("#alamatpj")[0].value = $("#alamat").val();
    $("#propinsipj")[0].value = $("#namaprop").val();
    $("#kabupatenpj")[0].value = $("#namakab").val();
    $("#kecamatanpj")[0].value = $("#namakec").val();
    $("#kelurahanpj")[0].value = $("#namakel").val();
});

$(document).ready(function () {
    var table = $('#patient-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{?=url(ADMIN)?}/pasien/datatable?t={?=$_SESSION['token']?}',
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        order: [0, 'desc'],
        columnDefs: [{
                width: "40px",
                targets: 0
            },
            {
                responsivePriority: 1,
                targets: 1
            },
            {
                className: 'control',
                targets: 8
            },
            {
                width: "160px",
                orderable: false,
                targets: 9
            }
        ],
        bFilter: true,
        bLengthChange: true,
        pagingType: "simple",
        "paging": true,
        "bDestroy": true,
        "searching": true,
        "language": {
            "info": " _START_ - _END_ of _TOTAL_ ",
            "sLengthMenu": "<span class='custom-select-title'>Rows per page:</span> <span class='pmd-custom-select'> _MENU_ </span>",
            "sSearch": "",
            "sSearchPlaceholder": "Search",
            "paginate": {
                "sNext": " ",
                "sPrevious": " "
            }
        },
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>"
    });
    /// Select value
    $('#patient-datatable_wrapper .custom-select-info').hide();
    table.on( 'xhr', function () {
        var json = table.ajax.json();
        var totalrecord = json.recordsTotal;
        $("#patient-datatable_wrapper .data-table-title").html(
            '<h2 class="card-title">Total: ' + totalrecord + '</h2>');
    } );
    $("#patient-datatable_wrapper .custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );
});

$(document).ready(function () {
    // Date picker
    $(".datepicker").datetimepicker({
        format: 'DD-MM-YYYY'
    });

    // Custom file uplaod
    bsCustomFileInput.init();

    // Edit About Info
    $('.edit-about-link').on('click', function (e) {
        e.preventDefault();
        $(".view-about-fields").hide();
        $(".edit-about-fields").show();
        $('.form-group').on('change keyup keydown paste cut', 'textarea', function () {
            $(this).height(0).height(this.scrollHeight - 10);
        }).find('textarea').change();
    });
    $('#update-about-info, #cancel-about-info').on('click', function (e) {
        e.preventDefault();
        $(".view-about-fields").show();
        $(".edit-about-fields").hide();
    });

    // Edit Contact Info
    $('.edit-contact-link').on('click', function (e) {
        e.preventDefault();
        $(".view-contact-fields").hide();
        $(".edit-contact-fields").show();
        $('.form-group').on('change keyup keydown paste cut', 'textarea', function () {
            $(this).height(0).height(this.scrollHeight - 10);
        }).find('textarea').change();
    });
    $('#update-contact-info, #cancel-contact-info').on('click', function (e) {
        e.preventDefault();
        $(".view-contact-fields").show();
        $(".edit-contact-fields").hide();
    });

    $('.pmd-detail-section').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight - 10);
    }).find('textarea').change();

});
$(window).resize(function () {
    $('.form-group').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight - 10);
    }).find('textarea').change();
});

$('#delete_patient_modal').on('show.bs.modal', function (event) {
  let pasienId = $(event.relatedTarget).data('pasienid')
  $("#pasienId").attr("href", pasienId);
})

$(document).ready(function () {
    $("#cara_bayar").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        columnDefs: [{ className: "control", orderable: !1, targets: 5 }],
        order: [0, "asc"],
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
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>",
    });
    $(".custom-select-info").hide();
    var t = $("#cara_bayar").DataTable().rows().count();
    $("#cara_bayar_wrapper .data-table-title").html('<h2 class="card-title">Total: ' + t + '</h2>');
    $(".custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );

    $('#delete_carabayar_modal').on('show.bs.modal', function (event) {
      let carabayarId = $(event.relatedTarget).data('carabayarid')
      $("#carabayarId").attr("href", carabayarId);
    })

});


$(document).ready(function () {
    $("#bahasa").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        columnDefs: [{ className: "control", orderable: !1, targets: 2 }],
        order: [0, "asc"],
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
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>",
    });
    $(".custom-select-info").hide();
    var t = $("#bahasa").DataTable().rows().count();
    $("#bahasa_wrapper .data-table-title").html('<h2 class="card-title">Total: ' + t + '</h2>');
    $(".custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );
});

$(document).ready(function () {
    $("#suku_bangsa").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        columnDefs: [{ className: "control", orderable: !1, targets: 2 }],
        order: [0, "asc"],
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
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>",
    });
    $(".custom-select-info").hide();
    var t = $("#suku_bangsa").DataTable().rows().count();
    $("#suku_bangsa_wrapper .data-table-title").html('<h2 class="card-title">Total: ' + t + '</h2>');
    $(".custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );
});

$(document).ready(function () {
    $("#cacat_fisik").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        columnDefs: [{ className: "control", orderable: !1, targets: 2 }],
        order: [0, "asc"],
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
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>",
    });
    $(".custom-select-info").hide();
    var t = $("#cacat_fisik").DataTable().rows().count();
    $("#cacat_fisik_wrapper .data-table-title").html('<h2 class="card-title">Total: ' + t + '</h2>');
    $(".custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );
});

$(document).ready(function () {
    $("#perusahaan_pasien").DataTable({
        responsive: { details: { type: "column", target: "tr" } },
        columnDefs: [{ className: "control", orderable: !1, targets: 2 }],
        order: [0, "asc"],
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
        dom: "<'card-header d-md-flex flex-row'<'data-table-title mb-3'><'pmd-textfield datatable-search pmd-textfield-outline ml-sm-auto'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'card-footer' <'pmd-datatable-pagination' l i p>>",
    });
    $(".custom-select-info").hide();
    var t = $("#perusahaan_pasien").DataTable().rows().count();
    $("#perusahaan_pasien_wrapper .data-table-title").html('<h2 class="card-title">Total: ' + t + '</h2>');
    $(".custom-select-action").html(
        '<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>'
    );
});

$(document).ready(function () {
    // Edit Hospital Info
    $('.edit-setting-link').on('click', function (e) {
        e.preventDefault();
        $(".view-setting-fields").hide();
        $(".edit-setting-fields").show();
    });
    $('#update-setting-info, #cancel-setting-info').on('click', function (e) {
        e.preventDefault();
        $(".view-setting-fields").show();
        $(".edit-setting-fields").hide();
    });

});
