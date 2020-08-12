@extends("layouts.app")

@section("content")
    <h1 class="feature-title">
        Review
    </h1>

    @include("shared.messages")

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="thead thead-dark">
            <tr>
                <th> # </th>
                <th style="width: 200px"> Waktu </th>
                <th> Penyewa </th>
                <th> Komentar </th>
                <th class="text-right"> Rating </th>
            </tr>
            </thead>

            <tbody>
            @foreach($reviews AS $review)
                <tr>
                    <td> {{ $reviews->firstItem() + $loop->index }} </td>
                    <td> {{ \App\Support\Formatter::date($review->created_at) }} </td>
                    <td> {{ $review->penyewa->user->name }} </td>
                    <td> {{ $review->konten }} </td>
                    <td class="text-right"> {{ $review->rating }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>

@endsection