$(function () {
    $(document).ready(function () {
        var dTable = $("#deposit-table").DataTable({
            lengthChange: false,
            paging: true,
            serverSide: true,
            processing: true,
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
            ajax: {
                url: "deposit/get-list",
                data: function (d) {
                    d.search = $('input[type="search"]').val();
                    d.depositType = $("#deposit-type").val();
                    d.clientId = $("#client-id").val();
                },
            },
            columns: [
                { data: "code", name: "code" },
                { data: "date", name: "date" },
                { data: "deposit_type_name", name: "deposit_type_name" },
                { data: "amount", name: "amount", className: "text-right" },
                { data: "action", name: "action", orderable: false },
            ],
            dom: "<'row'<'col btn-add'><'col'f>>tipr",
            initComplete: function (settings, json) {
                $('input[type="search"').unbind();
                $('input[type="search"').bind("keyup", function (e) {
                    if (e.keyCode == 13) {
                        dTable.draw();
                    }
                });
            },
        });

        const filterElement = $("#filter-element").html();
        $("div.btn-add").html(filterElement);

        $("#deposit-type").change(function () {
            dTable.draw();
        });
    });

    $("body").on("click", "#btn-add", function () {
        $(".modal-save").show();
        $("#modal").modal("show");
        fillModal($(this));
    });

    $("body").on("click", ".btn-show", function (event) {
        event.preventDefault();
        var me = $(this);

        $(".modal-save").hide();
        $("#modal").modal("show");
        fillModal(me);
    });

    $("body").on("click", ".modal-edit", function (event) {
        event.preventDefault();
        var me = $(this);

        $(".modal-save").show();
        $("#modal").modal("show");
        fillModal(me);
    });

    $(".modal-save").on("click", function (event) {
        event.preventDefault();

        var form = $("#form-deposit"),
            url = form.attr("action"),
            method =
                $("input[name=_method").val() == undefined ? "POST" : "PUT",
            message =
                $("input[name=_method").val() == undefined
                    ? "Data setoran berhasil ditambahkan"
                    : "Data setoran berhasil diubah";

        $(".form-control").removeClass("is-invalid");
        $(".invalid-feedback").remove();

        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            beforeSend: function () {
                $(".modal-save").attr("disabled", true);
            },
            complete: function () {
                $(".modal-save").removeAttr("disabled");
            },
            success: function (response) {
                showSuccessToast(message);
                $("#modal").modal("hide");
                $("#deposit-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                showErrorToast();
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            .addClass("is-invalid")
                            .after(
                                `<small class="invalid-feedback">${value}</small>`
                            );
                    });
                }
            },
        });
    });
});

fillModal = (me) => {
    var url = me.attr("href"),
        title = me.attr("title");

    url === undefined ? (url = "/deposits/create") : url;
    title === undefined ? (title = "Tambah Setoran") : title;

    $(".modal-title").text(title);

    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        success: function (response) {
            $(".modal-body").html(response);
            makeSelectTwo();
            makeCurrency();
        },
        error: function (xhr, status) {
            $("#modal").modal("hide");
            alert("Terjadi kesalahan");
        },
    });
};

showSuccessToast = (message) => {
    Swal.fire("Berhasil!", message, "success");
};

showErrorToast = () => {
    Swal.fire("Opps!", "Terjadi kesalahan!", "error");
};

makeSelectTwo = () => {
    $("#client_id")
        .select2({
            theme: "bootstrap4",
            ajax: {
                url: "/client/search",
                dataType: "json",
                data: function (params) {
                    var query = {
                        search: params.term,
                    };

                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id,
                            };
                        }),
                    };
                },
            },
            placeholder: "Cari klien",
            cache: true,
        })
        .on("select2:select", function (e) {
            var data = e.params.data.id;
            $("#deposit_type").empty();
            $.ajax({
                url: "/deposit/deposit-type",
                type: "GET",
                dataType: "json",
                data: { client_id: data },
                success: function (response) {
                    $.each(response, function (id, name) {
                        $("#deposit_type").append(
                            $("<option>", {
                                value: id,
                                text: name,
                            })
                        );
                    });
                },
                error: function (xhr, status) {
                    alert("Terjadi kesalahan");
                },
            });
        });
};

makeCurrency = () => {
    $(".currency").maskMoney({
        thousands: ".",
        decimal: ",",
        affixesStay: true,
        precision: 0,
        prefix: "Rp. ",
        selectAllOnFocus: true,
    });
};
