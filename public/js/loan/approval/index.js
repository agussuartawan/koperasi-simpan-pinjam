$(function () {
    $(document).ready(function () {
        var dTable = $("#approval-table").DataTable({
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
                url: "approvals/get-list",
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
                { data: "approve", name: "approve", orderable: false },
            ],
            dom: "<'row'<'col'f>>tipr",
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

    $("body").on("click", ".btn-approve", function (event) {
        event.preventDefault();

        Swal.fire({
            title: "Approve pinjaman ini?",
            text: "Approval tidak dapat dibatalkan.",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, approve",
        }).then((result) => {
            if (result.isConfirmed) {
                const me = $(this);
                const url = me.attr("href");
                const message = "Approval berhasil";
                const form = me.next();

                $.ajax({
                    url: url,
                    method: "PUT",
                    data: form.serialize(),
                    success: function (response) {
                        showSuccessToast(message);
                        $("#approval-table").DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        showErrorToast();
                    },
                });
            }
        });
    });
});

showSuccessToast = (message) => {
    Swal.fire("Berhasil!", message, "success");
};

showErrorToast = () => {
    Swal.fire("Opps!", "Terjadi kesalahan!", "error");
};
