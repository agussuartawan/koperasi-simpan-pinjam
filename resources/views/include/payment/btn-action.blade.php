<div class="text-center">
    <a href="{{ route('loans.show', $data->id) }}" class="mr-2 btn btn-info btn-circle btn-sm btn-show"
        title="Detail {{ $data->code }}">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
    </a>
    {{-- |
    <a href="{{ route('loans.edit', $data->id) }}" class="ml-2 Sbtn btn-warning btn-circle btn-sm modal-edit"
        title="Edit {{ $data->name }}">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a> --}}
</div>
