<div class="text-center">
    <a href="{{ route('loan.approve', $data) }}" class="mr-2 btn btn-success btn-sm btn-approve"
        title="Approve {{ $data->code }}">
        Approve
    </a>

    <form action="{{ route('loan.approve', $data) }}">
        @csrf
        @method("PUT")
    </form>
</div>