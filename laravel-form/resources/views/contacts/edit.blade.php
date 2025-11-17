@extends('layouts.app')

@section('title', 'Edit Kontak')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('contacts.index') }}" class="btn btn-info">⬅️ Kembali</a>
    </div>

    <div class="card">
        <h2>✏️ Edit Kontak</h2>
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

        <form action="{{ route('contacts.update', $contact) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', htmlspecialchars_decode($contact->name)) }}"
                    required 
                    maxlength="100"
                    pattern="[A-Za-z\s]+"
                    title="Nama hanya boleh berisi huruf dan spasi">
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', htmlspecialchars_decode($contact->email)) }}"
                    required 
                    maxlength="100">
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon *</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone', htmlspecialchars_decode($contact->phone)) }}"
                    required 
                    maxlength="20"
                    pattern="[0-9+\-\s()]+">
            </div>

            <div class="form-group">
                <label for="subject">Subjek *</label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject', htmlspecialchars_decode($contact->subject)) }}"
                    required 
                    maxlength="200">
            </div>

            <div class="form-group">
                <label for="message">Pesan *</label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="5" 
                    required>{{ old('message', htmlspecialchars_decode($contact->message)) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">💾 Update Kontak</button>
                <a href="{{ route('contacts.index') }}" class="btn btn-danger">❌ Batal</a>
            </div>
        </form>
    </div>
@endsection
