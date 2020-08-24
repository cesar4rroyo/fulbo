@switch($status)
    @case(\App\Enums\PemesananStatus::DRAFT)
    <span class="badge badge-pill badge-primary">
        Belum Diproses
    </span>
    @break
    @case(\App\Enums\PemesananStatus::DITERIMA)
    <span class="badge badge-pill badge-success">
        {{ $status }}
    </span>
    @break
    @case(\App\Enums\PemesananStatus::BATAL)
    <span class="badge badge-pill badge-danger">
        {{ $status }}
    </span>
    @break
@endswitch