@extends('base.template')
@section('judul', 'Validasi')
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
                <form action="{{ route('send-daftar') }}" method="POST" style="max-width: 800px">
                    @csrf
                    <x-card title="Data Pendaftaran">
                        <hr>
                        <div class="card-text mb-3">
                            <input type="hidden" name="kd_dokter" id="" value="{{ $reg_periksa->kd_dokter }}">
                            <input type="hidden" name="no_reg" id="" value="{{ $reg_periksa->no_reg }}">
                            <input type="hidden" name="no_rawat" id="" value="{{ $reg_periksa->no_rawat }}">
                            <input type="hidden" name="tgl_registrasi" id=""
                                value="{{ $reg_periksa->tgl_registrasi }}">
                            <input type="hidden" name="jam_reg" id="" value="{{ $reg_periksa->jam_reg }}">
                            <input type="hidden" name="kd_dokter" id="" value="{{ $reg_periksa->kd_dokter }}">
                            <input type="hidden" name="no_rkm_medis" id=""
                                value="{{ $reg_periksa->no_rkm_medis }}">
                            <input type="hidden" name="kd_poli" id="" value="{{ $reg_periksa->kd_poli }}">
                            <input type="hidden" name="p_jawab" id="" value="{{ $reg_periksa->p_jawab }}">
                            <input type="hidden" name="almt_pj" id="" value="{{ $reg_periksa->almt_pj }}">
                            <input type="hidden" name="hubunganpj" id="" value="{{ $reg_periksa->hubunganpj }}">
                            <input type="hidden" name="biaya_reg" id="" value="{{ $reg_periksa->biaya_reg }}">
                            <input type="hidden" name="stts" id="" value="{{ $reg_periksa->stts }}">
                            <input type="hidden" name="stts_daftar" id=""
                                value="{{ $reg_periksa->stts_daftar }}">
                            <input type="hidden" name="status_lanjut" id=""
                                value="{{ $reg_periksa->status_lanjut }}">
                            <input type="hidden" name="kd_pj" id="" value="{{ $reg_periksa->kd_pj }}">
                            <input type="hidden" name="umurdaftar" id="" value="{{ $reg_periksa->umurdaftar }}">
                            <input type="hidden" name="sttsumur" id="" value="{{ $reg_periksa->sttsumur }}">
                            <input type="hidden" name="status_bayar" id=""
                                value="{{ $reg_periksa->status_bayar }}">
                            <input type="hidden" name="status_poli" id=""
                                value="{{ $reg_periksa->status_poli }}">

                            <p>Silahkan mencatat atau screenshot data tersebut untuk bukti pendaftaran kemudian klik
                                <b>Daftar</b> untuk melanjutkan
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="no_reg" required placeholder=""
                                        value="{{ $reg_periksa->no_reg }}" name="" readonly>
                                    <label for="no_reg">No Registrasi</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="no_reg" required placeholder=""
                                        value="{{ $reg_periksa->tgl_registrasi }}" name="" readonly>
                                    <label for="no_reg">Tanggal Periksa</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="no_reg" required placeholder=""
                                        value="{{ $reg_periksa->no_rawat }}" name="" readonly>
                                    <label for="no_reg">No rawat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="no_reg" required placeholder=""
                                        value="{{ $reg_periksa->dokter->nm_dokter }}" name="" readonly>
                                    <label for="no_reg">Dokter</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-flex flex-row-reverse">
                            <x-button type="submit" btn="primary" label="Daftar" icon="fas fa-check" />
                            {{-- <x-button type="submit" btn="warning" label="Batal" icon="fas fa-arrow-left" /> --}}
                            <button onclick="location.href='https://rsreksawaluya.id'" type="button"
                                class="btn btn-warning"><i class="fas fa-arrow-left"></i> Batal</button>
                        </div>
                    </x-card>
                </form>
            </div>
        </section>
    </main>
@endsection
