{{-- @extends('base.layout')
@section('konten')
    <div class="container mt-5">
        <x-form action="{{ route('get-daftar') }}" method="POST">
            <x-card title="SILAHKAN ISI DATA UNTUK MENDAFTAR">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" name="umur" id="" value="{{ $pasien->umur }}">
                        <x-floating-readonly label="Nomor Rekam Medis" type="text" name="no_rkm_medis"
                            value="{{ str_pad($pasien->no_rkm_medis, 6, '0', STR_PAD_LEFT) }}" />

                        <x-floating-input label="Nomor Telp" type="text" name="no_telp" value="{{ $pasien->no_tlp }}" />

                    </div>
                    <div class="col-lg-6">

                        <x-floating-readonly label="Nama Pasien" type="text" name="nama"
                            value="{{ $pasien->nm_pasien }}" />

                        <x-floating-readonly label="Alamat" type="text" name="alamat" value="{{ $pasien->alamat }}" />

                    </div>
                    <hr>
                    <div class="col-lg-6">

                        <div class="form-floating mb-5">
                            <input type="date" class="form-control" id="tanggal-periksa" required
                                placeholder="name@example.com" value="" name="tgl_registrasi" onchange="loadPoli()">
                            <label for="tanggal-periksa">Tanggal Periksa</label>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="form-floating mb-5">
                            <select class="form-select" required id="kd_poli" aria-label="Floating label select example"
                                name="kd_poli" onchange="loadDokter()">
                            </select>
                            <label for="pilih-dokter">Pilih Poli</label>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="form-floating mb-5">
                            <select class="form-select" required id="pilih-dokter"
                                aria-label="Floating label select example" name="kd_dokter">
                            </select>
                            <label for="pilih-dokter">Pilih Dokter</label>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <x-select name="kd_pj" label="Pilih cara bayar">
                            <option value=""></option>
                            <option value="-">UMUM</option>
                            <option value="BPJ">BPJS</option>
                            <option value="A05">ASURANSI / PIHAK KE - III</option>
                        </x-select>
                    </div>
                </div>
                <x-button type="submit" btn="success" label="Klik Daftar" />
            </x-card>
        </x-form>
    </div>

    <script src="{{ asset('vendor/main.js') }}"></script>
@endsection --}}

@extends('base.template')
@section('judul', 'Form Pendaftaran')
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
                <form action="{{ route('get-daftar') }}" method="POST" style="max-width: 800px" class="was-validated">
                    @csrf
                    <x-card title=" ">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" name="umur" id="" value="{{ $pasien->umur }}">
                                <x-floating-readonly label="Nomor Rekam Medis" type="text" name="no_rkm_medis"
                                    value="{{ str_pad($pasien->no_rkm_medis, 6, '0', STR_PAD_LEFT) }}" />

                                <x-floating-input label="Nomor Telp" type="text" name="no_telp"
                                    value="{{ $pasien->no_tlp }}" />

                            </div>
                            <div class="col-lg-6">

                                <x-floating-readonly label="Nama Pasien" type="text" name="nama"
                                    value="{{ $pasien->nm_pasien }}" />

                                <x-floating-readonly label="Alamat" type="text" name="alamat"
                                    value="{{ $pasien->alamat }}" />

                            </div>
                            <hr>
                            <div class="col-lg-6">

                                <div class="form-floating mb-5">
                                    <input type="date" class="form-control" id="tanggal-periksa" required
                                        placeholder="name@example.com" value="" name="tgl_registrasi"
                                        onchange="loadPoli()">
                                    <label for="tanggal-periksa">Tanggal Periksa</label>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-floating mb-5">
                                    <select class="form-select" required id="kd_poli"
                                        aria-label="Floating label select example" name="kd_poli" onchange="loadDokter()">
                                    </select>
                                    <label for="pilih-dokter">Pilih Poli</label>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-floating mb-5">
                                    <select class="form-select" required id="pilih-dokter"
                                        aria-label="Floating label select example" name="kd_dokter">
                                    </select>
                                    <label for="pilih-dokter">Pilih Dokter</label>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <x-select name="kd_pj" label="Pilih cara bayar">
                                    <option value=""></option>
                                    <option value="-">UMUM</option>
                                    <option value="BPJ">BPJS</option>
                                    <option value="A05">ASURANSI / PIHAK KE - III</option>
                                </x-select>
                            </div>
                        </div>
                        <div
                            class="d-flex d-sm-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center justify-content-xl-end mb-3">
                            <x-button type="submit" btn="warning" label="Klik untuk melanjutkan"
                                icon="fas fa-arrow-right" />
                        </div>
                    </x-card>
                </form>

            </div>
        </section>
    </main>
@endsection
