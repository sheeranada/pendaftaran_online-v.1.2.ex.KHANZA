@extends('base.layout')
@section('konten')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <input type="text" value="{{ $bookings->nama }}">
            </div>
        </div>
    </div>
@endsection
