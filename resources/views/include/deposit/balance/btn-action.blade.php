<div class="text-center">
    <a href="{{ route('deposits.index', ['clientId' => $data->client_id]) }}" class="mr-2 btn btn-info btn-sm"
        title="Setoran">
        Setoran
    </a>

    <a href="{{ route('withdrawals.index', ['clientId' => $data->client_id]) }}" class="mr-2 btn btn-warning btn-sm"
        title="Tarikan">
        Tarikan
    </a>
</div>