@extends('layouts.app')

@section('title', 'New Subject')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New Subject</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Subjects</a></div>
                    <div class="breadcrumb-item">New Subject</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('subject.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>New Subject</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Mata Kuliah</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title">
                                <div class="invalid-feedback">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dosen</label>
                                <select class="form-control select2 @error('lecturer_id') is-invalid @enderror"
                                    name="lecturer_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('lecturer_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control select2 @error('semester') is-invalid @enderror"
                                    name="semester">
                                    <option value="">Pilih Semester</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('semester')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select class="form-control select2 @error('academic_year') is-invalid @enderror"
                                    name="academic_year">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2022/2023</option>
                                    <option value="2023/2024">2023/2024</option>
                                    <option value="2024/2025">2024/2025</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('academic_year')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>SKS</label>
                                <input type="number" class="form-control @error('sks') is-invalid @enderror"
                                    name="sks">
                                <div class="invalid-feedback">
                                    @error('sks')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code">
                                <div class="invalid-feedback">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Deskripsi</label>
                                <textarea class="form-control" data-height="150" name="description"></textarea>
                            </div>
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