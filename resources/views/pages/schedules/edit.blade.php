@extends('layouts.app')

@section('title', 'Edit Schedule')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Schedule</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Schedules</a></div>
                    <div class="breadcrumb-item">Edit Schedule</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('schedule.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Schedule</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control select2 @error('subject_id') is-invalid @enderror"
                                    name="subject_id">
                                    <option value="">Pilih Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            @if ($subject->id == $schedule->subject_id) selected @endif>{{ $subject->title }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('subject_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mahasiswa</label>
                                <select class="form-control select2 @error('student_id') is-invalid @enderror"
                                    name="student_id">
                                    <option value="">Pilih Mahasiswa</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if ($user->id == $schedule->student_id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('student_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hari</label>
                                <select class="form-control select2 @error('hari') is-invalid @enderror" name="hari">
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" @if ($schedule->hari == 'Senin') selected @endif>Senin</option>
                                    <option value="Selasa" @if ($schedule->hari == 'Selasan') selected @endif>Selasa</option>
                                    <option value="Rabu" @if ($schedule->hari == 'Rabu') selected @endif>Rabu</option>
                                    <option value="Kamis" @if ($schedule->hari == 'Kamis') selected @endif>Kamis</option>
                                    <option value="Jumat" @if ($schedule->hari == 'Jumat') selected @endif>Jumat</option>
                                    <option value="Sabtu" @if ($schedule->hari == 'Sabtu') selected @endif>Sabtu</option>
                                    <option value="Minggu" @if ($schedule->hari == 'Minggu') selected @endif>Minggu
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('hari')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="jam_mulai" id="timepicker"
                                        value="{{ $schedule->jam_mulai }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker" name="jam_selesai" id="timepicker"
                                        value="{{ $schedule->jam_selesai }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ruangan </label>
                                <select class="form-control select2 @error('ruangan') is-invalid @enderror" name="ruangan">
                                    <option value="">Pilih Ruangan</option>
                                    <option value="A1" @if ($schedule->ruangan == 'A1') selected @endif>A1</option>
                                    <option value="A2" @if ($schedule->ruangan == 'A2') selected @endif>A2</option>
                                    <option value="A3" @if ($schedule->ruangan == 'A3') selected @endif>A3</option>
                                    <option value="A4" @if ($schedule->ruangan == 'A4') selected @endif>A4</option>
                                    <option value="A5" @if ($schedule->ruangan == 'A5') selected @endif>A5</option>
                                    <option value="A6" @if ($schedule->ruangan == 'A6') selected @endif>A6</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('ruangan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tahun Ajaran </label>
                                <select class="form-control select2 @error('tahun_akademik') is-invalid @enderror"
                                    name="tahun_akademik">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023" @if ($schedule->tahun_akademik == '2022/2023') selected @endif>2022/2023
                                    </option>
                                    <option value="2023/2024" @if ($schedule->tahun_akademik == '2023/2024') selected @endif>2023/2024
                                    </option>
                                    <option value="2024/2025" @if ($schedule->tahun_akademik == '2024/2025') selected @endif>2024/2025
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('tahun_akademik')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control select2 @error('semester') is-invalid @enderror"
                                    name="semester">
                                    <option value="">Pilih Semester</option>
                                    <option value="Ganjil" @if ($schedule->semester == 'Ganjil') selected @endif>Ganjil
                                    </option>
                                    <option value="Genap" @if ($schedule->semester == 'Genap') selected @endif>Genap
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('semester')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kode Absensi</label>
                                <input type="text" class="form-control @error('kode_absensi') is-invalid @enderror"
                                    name="kode_absensi" value="{{ $schedule->kode_absensi }}">
                                <div class="invalid-feedback">
                                    @error('kode_absensi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="created_by" value="{{ $schedule->created_by }}">
                            <input type="hidden" name="updated_by" value="{{ $loginUser->id }}">
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush