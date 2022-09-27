$(function () {
    $(".btn-search").on("click", function (event) {
        event.preventDefault();
        $(".btn-download").remove();

        var form = $("#form-search"),
            url = form.attr("action");

        $.ajax({
            url: url,
            method: "GET",
            data: form.serialize(),
            beforeSend: function () {
                $(".btn-search").attr("disabled", true);
            },
            complete: function () {
                $(".btn-search").removeAttr("disabled");
            },
            success: function (response) {
                $("#report-table").remove();
                $("#search-area").after(response);
                $(".btn-search").after(
                    `<button class="btn btn-danger btn-download btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                        <span class="text">Download PDF</span>
                    </button>`
                );
            },
            error: function (xhr) {
                alert("Terjadi kesalahan");
            },
        });
    });

    $("body").on("click", ".btn-download", function (event) {
        event.preventDefault();
        var from = $("#from").val(),
            to = $("#to").val();
        window.open(`/report-withdrawal-pdf?from=${from}&to=${to}`, "_blank");
    });
});
