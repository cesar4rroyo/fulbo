@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Member
    </h1>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
            <tr>
                <th> # </th>
                <th> Nama / No. Telepon </th>
                <th class="text-center"> Status </th>
                <th> Pembayaran </th>
                <th class="text-center"> Kendali </th>
            </tr>
            </thead>
            <tbody>
            @foreach($members AS $member)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td>
                        <div> {{ $member->user->name }} </div>
                        <div> {{ $member->no_telepon }} </div>
                    </td>
                    <td class="text-uppercase text-center">
                        <x-membership-status
                            status="{{ $member->membership->status }}"
                        />
                    </td>
                    <td>
                    </td>
                    <td class="text-center">
                        <a href="{{ route("member-tempat-penyewaan-by-tempat-penyewaan.edit", $member->membership)  }}" class="btn btn-info btn-sm">
                            Ubah
                            <i class="fas fa-pencil-alt  "></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection