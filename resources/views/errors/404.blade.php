@extends("layouts.app")

@section("content")
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i>
        {{ __("messages.errors.404")  }}
    </div>
@endsection