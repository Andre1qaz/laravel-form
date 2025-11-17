@extends('layouts.app')

@section('title', 'Tambah Kontak')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('contacts.index') }}" class="btn btn-info">⬅️ Kembali</a>
    </div>

    <div class="card">
        <h2>➕ Tambah Kontak Baru</h2>
        <br>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>❌ Terjadi Kesalahan:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form dengan HTML5 Validation -->
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required 
                    maxlength="100"
                    pattern="[A-Za-z\s]+"
                    title="Nama hanya boleh berisi huruf dan spasi"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    maxlength="100"
                    placeholder="contoh@email.com">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon *</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    required 
                    maxlength="20"
                    pattern="[0-9+\-\s()]+"
                    title="Nomor telepon hanya boleh berisi angka, +, -, (, ), dan spasi"
                    placeholder="081234567890">
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">Subjek *</label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject') }}"
                    required 
                    maxlength="200"
                    placeholder="Masukkan subjek pesan">
                @error('subject')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Pesan *</label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="5" 
                    required
                    placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">💾 Simpan Kontak</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-danger">❌ Batal</a>
            </div>
        </form>
    </div>

    <div class="card" style="margin-top: 20px; background: #e3f2fd;">
        <h3>🔒 Keamanan yang Diterapkan:</h3>
        <ul style="margin-left: 20px; line-height: 1.8;">
            <li>✅ <strong>CSRF Protection:</strong> Token @csrf mencegah serangan CSRF</li>
            <li>✅ <strong>HTML5 Validation:</strong> Validasi client-side (required, pattern, maxlength)</li>
            <li>✅ <strong>Server Validation:</strong> Validasi Laravel di Controller</li>
            <li>✅ <strong>Anti SQL Injection:</strong> Laravel Eloquent menggunakan prepared statements</li>
            <li>✅ <strong>Anti XSS:</strong> Fungsi htmlentities() membersihkan input berbahaya</li>
        </ul>
    </div>
@endsection
