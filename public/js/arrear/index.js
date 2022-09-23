$(function () {
    $(document).ready(function () {
        var dTable = $("#arrear-table").DataTable({
            lengthChange: false,
            paging: true,
            responsive: true,
            autoWidth: false,
            order: [[0, "desc"]],
            language: {
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ ke _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 ke 0 dari 0 data",
                emptyTable: "Tidak ada data tersedia pada tabel",
                infoFiltered: "(Difilter dari _MAX_ total data)",
                search: "Cari:",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                },
            },
            scroller: {
                loadingIndicator: false,
            },
            pagingType: "first_last_numbers",
            dom: "<'row'<'col'B><'col'f>>tipr",
        });
    });

    $("body").on("click", ".btn-show", function (event) {
        event.preventDefault();
        var me = $(this);

        $('.modal-save').hide();
        $("#modal").modal("show");
        fillModal(me);
    });
});

fillModal = (me) => {
    var url = me.attr("href"),
        title = me.attr("title");

    $(".modal-title").text(title);

    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        success: function (response) {
            $(".modal-body").html(response);
        },
        error: function (xhr, status) {
            $("#modal").modal("hide");
            alert("Terjadi kesalahan");
        },
    });
};
