$(function () {
    $(document).ready(function () {
        var dTable = $("#payment-table").DataTable({
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
                url: "payment/get-list",
                data: function (d) {
                    d.search = $('input[type="search"]').val();
                },
            },
            columns: [
                { data: "code", name: "code" },
                { data: "client_name", name: "client_name" },
                { data: "date", name: "date" },
                {
                    data: "total_amount",
                    name: "total_amount",
                    className: "text-right",
                },
                { data: "action", name: "action", orderable: false },
            ],
            dom: "<'row'<'col'B><'col'f>>tipr",
            buttons: [
                {
                    text: `<i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i> Pembayaran Baru`,
                    className: "btn btn-info",
                    action: function (e, dt, node, config) {
                        $(".modal-save").show();
                        $("#modal").modal("show");
                        fillModal($(this));
                    },
                },
            ],
            initComplete: function (settings, json) {
                $('input[type="search"').unbind();
                $('input[type="search"').bind("keyup", function (e) {
                    if (e.keyCode == 13) {
                        dTable.draw();
                    }
                });
            },
        });
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

        var form = $("#form-payment"),
            url = form.attr("action"),
            method =
                $("input[name=_method").val() == undefined ? "POST" : "PUT",
            message =
                $("input[name=_method").val() == undefined
                    ? "Data pembayaran berhasil ditambahkan"
                    : "Data pembayaran berhasil diubah";

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
                $("#payment-table").DataTable().ajax.reload();
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

    $("body").on("change", "#amount, #bank_interest", function () {
        var amount = $("#amount").val(),
            bank_interest = $("#bank_interest").val(),
            total_count,
            bank_interest_rp;

        bank_interest_rp = bankInterestCount(amount, bank_interest);
        total_count = totalAmountCount(amount, bank_interest_rp);

        $("#bank_interest_rp").val(bank_interest_rp);
        $("#total_amount").val(total_count);
        makeCurrency();
    });

    $("body").on("change", "#loan_id", function () {
        var loan_id = $(this).val();
        $.ajax({
            url: "/payment/payment-check",
            type: "GET",
            dataType: "json",
            data: {
                loan_id: loan_id,
            },
            success: function (response) {
                $("#installment").val(response.installment);
                $("#amount").val(response.payment_amount);
                $("#total_amount").val(response.payment_amount);
                makeCurrency();
            },
            error: function (xhr, status) {
                alert("Terjadi kesalahan");
            },
        });
    });

    $("body").on("change", "#mulct", function () {
        var mulct = $(this).val(),
            amount = $("#amount").val(),
            total_amount;

        amount = amount.replace(/Rp. /g, "");
        amount = amount.replace(/\./g, "");

        mulct = parseFloat(amount) * (mulct / 100);
        total_amount = parseFloat(amount) + parseFloat(mulct);
        $("#total_amount").val(total_amount);
        makeCurrency();
    });
});

fillModal = (me) => {
    var url = me.attr("href"),
        title = me.attr("title");

    url === undefined ? (url = "/payments/create") : url;
    title === undefined ? (title = "Tambah Pembayaran") : title;

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
            $.ajax({
                url: "/loan/get-loan-by-client",
                type: "GET",
                dataType: "json",
                data: { client_id: data },
                success: function (response) {
                    $.each(response, function (id, data) {
                        $("#loan_id").append(
                            $("<option>", {
                                value: id,
                                text: data,
                            })
                        );
                    });
                },
                error: function (xhr, status) {
                    alert("Klien tersebut tidak memiliki hutang");
                },
            });
        });
};

makeCurrency = () => {
    $(".currency")
        .maskMoney({
            thousands: ".",
            decimal: ",",
            affixesStay: true,
            precision: 0,
            prefix: "Rp. ",
            selectAllOnFocus: true,
        })
        .trigger("mask.maskMoney");
};

totalAmountCount = (amount, bank_interest_rp) => {
    var amount;

    amount = amount.replace(/Rp. /g, "");
    amount = amount.replace(/\./g, "");

    return parseInt(amount) + parseInt(bank_interest_rp);
};

bankInterestCount = (amount, bank_interest) => {
    var amount, bank_interest_rp;

    amount = amount.replace(/Rp. /g, "");
    amount = amount.replace(/\./g, "");

    bank_interest_rp = amount * (bank_interest / 100);

    return bank_interest_rp;
};
