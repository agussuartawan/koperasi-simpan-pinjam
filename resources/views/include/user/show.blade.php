<div class="row">
    <div class="col">
        <div class="text-center">
            @if ($user->avatar)
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/' . $user->avatar) }}"
                    alt="Foto profil">
            @else
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('') }}/img/undraw_profile.svg"
                    alt="Foto profil" width="100px" height="100px">
            @endif
        </div>
        <h3 class="profile-username text-center">{{ $user->name }}
            <span class="badge badge-success">{{ $user->getRoleNames()[0] }}</span>
        </h3>
        <p class="text-muted text-center">Bergabung sejak
            {{ $user->created_at->diffForHumans() }}</p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col text-center">
        <h6>Email</h6>
        <h6>{{ $user->email }}</h6>
    </div>
    <div class="col text-center">
        <h6>Email diverifikasi pada</h6>
        <h6>
            @if (!$user->email_verified_at)
                -
            @else
                {{ $user->email_verified_at->settings(['toStringFormat' => 'd M y, g:i A']) }}
            @endif
        </h6>
    </div>
</div>
<hr>
<div class="row">
    <div class="col text-center">
        <h6>Tanggal Masuk</h6>
        <h6>{{ $user->date_in }}</h6>
    </div>
    <div class="col text-center">
        <h6>Tanggal keluar</h6>
        <h6>{{ $user->date_out }}</h6>
    </div>
</div>
