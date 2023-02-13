$(function () {
    $(document).ready(function () {
        var dTable = $("#deposit-balance-table").DataTable({
            lengthChange: false,
            paging: true,
            serverSide: true,
            processing: true,
            responsive: true,
            autoWidth: false,
            order: [[3, "desc"]],
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
                url: "deposit-balances/get-list?clientType=1",
                data: function (d) {
                    d.search = $('input[type="search"]').val();
                    d.clientType = $("#client-type").val();
                },
            },
            columns: [
                { data: "client_code", name: "client_code" },
                { data: "client_name", name: "client_name" },
                { data: "amount", name: "amount" },
                { data: "updated_at", name: "updated_at" },
            ],
            dom: "<'row'<'col'B><'col filter'><'col'f>>tipr",
            buttons: [
                {
                    text: `<i class="fa fa-fw fa-arrow-circle-up" aria-hidden="true"></i> Setoran`,
                    className: "btn btn-info",
                    action: function (e, dt, node, config) {
                        window.location.href = "/deposits";
                    },
                },
                {
                    text: `<i class="fa fa-fw fa-arrow-circle-down" aria-hidden="true"></i> Tarikan`,
                    className: "btn btn-info",
                    action: function (e, dt, node, config) {
                        window.location.href = "/withdrawals";
                    },
                },
            ],
            initComplete: function (settings, json) {
                $('input[type="search"').unbind();
                $('input[type="search"').bind("keyup", function (e) {
                    if (e.keyCode == 13) {
                        dTable.search(this.value).draw();
                    }
                });
            },
        });

        $("div.filter").html(
            `<div class="input-group">
                <select class="form-control custom-select" id="client-type">
                    <option value="1">Anggota</option>
                    <option value="2">Nasabah</option>
                </select>
            </div>`
        );

        $("#client-type").change(function () {
            dTable.draw();
        });
    });
});
