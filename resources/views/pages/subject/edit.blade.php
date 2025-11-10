@extends('layouts.app')

@section('title', 'Edit Subject')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Subject</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Subjects</a></div>
                    <div class="breadcrumb-item">Edit Subject</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('subject.update', $subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Subject</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Mata Kuliah</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ $subject->title }}">
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
                                        <option value="{{ $user->id }}"
                                            @if ($user->id == $subject->lecturer_id) selected @endif>{{ $user->name }}</option>
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
                                    <option value="Ganjil" @if ($subject->semester == 'Ganjil') selected @endif>Ganjil</option>
                                    <option value="Genap" @if ($subject->semester == 'Genap') selected @endif>Genap</option>
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
                                    <option value="2022/2023" @if ($subject->academic_year == '2022/2023') selected @endif>2022/2023
                                    </option>
                                    <option value="2023/2024" @if ($subject->academic_year == '2023/2024') selected @endif>2023/2024
                                    </option>
                                    <option value="2024/2025" @if ($subject->academic_year == '2024/2025') selected @endif>2024/2025
                                    </option>
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
                                    name="sks" value="{{ $subject->sks }}">
                                <div class="invalid-feedback">
                                    @error('sks')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" value="{{ $subject->code }}">
                                <div class="invalid-feedback">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Deskripsi</label>
                                <textarea class="form-control" data-height="150" name="description">{{ $subject->description }}</textarea>
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