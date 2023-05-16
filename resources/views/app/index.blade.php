@extends('base.template')
@section('judul', 'Pendaftaran Online')
@section('isi')
    <x-nav />
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-center text-info" style="font-weight: bold;">Pendaftaran Online</h2>
                    <hr class="pembatas">
                    <p>Kami memberi pelayanan terbaik</p>
                </div>
                <x-form action="{{ route('cekPasien') }}" method="POST">
                    <x-floating-input label="Nomor Rekam Medis" type="text" name="no_rkm_medis" required>
                    </x-floating-input>
                    <x-floating-input label="Tanggal Lahir" type="date" name="tgl_lahir"></x-floating-input>
                    <div class="mb-3"></div>
                    <div class="mb-3"></div>
                    <div
                        class="d-flex d-sm-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center justify-content-xl-end mb-3">
                        <button class="btn btn-danger" type="submit"><i class="fas fa-lock"></i> Login</button>
                    </div>
                </x-form>
            </div>
        </section>
    </main>
@endsection
