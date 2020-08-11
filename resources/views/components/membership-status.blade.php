@switch($status)
    @case(\App\Enums\MemberTempatPenyewaanStatus::REQUESTED)
    <span class="badge badge-pill badge-info">
        Diajukan
    </span>
    @break
    @case(\App\Enums\MemberTempatPenyewaanStatus::ACTIVE)
    <span class="badge badge-pill badge-success">
        Aktif
    </span>
    @break
    @case(\App\Enums\MemberTempatPenyewaanStatus::INACTIVE)
    <span class="badge badge-pill badge-danger">
        Non-Aktif
    </span>
    @break
@endswitch