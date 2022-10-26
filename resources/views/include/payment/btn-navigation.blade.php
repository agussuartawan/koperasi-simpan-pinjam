<h6>
    <a href="{{ route('terms.index') }}" class="btn btn-sm btn-info{{ request()->is('terms') ? ' disabled' : '' }}"><i
            class="fa fa-list" aria-hidden="true"></i>
        Lama Pinjaman</a>

    <a href="{{ route('loans.index') }}" class="btn btn-sm btn-info{{ request()->is('loans') ? ' disabled' : '' }}"><i
            class="fa fa-fw fa-arrow-circle-up" aria-hidden="true"></i>
        Peminjaman</a>

    <a href="{{ route('payments.index') }}"
        class="btn btn-sm btn-info{{ request()->is('payments') ? ' disabled' : '' }}"><i
            class="fa fa-fw fa-arrow-circle-up" aria-hidden="true"></i>
        Pembayaran</a>
</h6>
