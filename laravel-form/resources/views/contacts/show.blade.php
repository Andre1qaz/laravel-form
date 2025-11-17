@extends('layouts.app')

@section('title', 'Detail Kontak')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('contacts.index') }}" class="btn btn-info">⬅️ Kembali</a>
        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">✏️ Edit</a>
    </div>

    <div class="card">
        <h2>👤 Detail Kontak</h2>
        <br>
        
        <table style="box-shadow: none;">
            <tr>
                <th width="200">Nama</th>
                <td>{{ htmlspecialchars_decode($contact->name) }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ htmlspecialchars_decode($contact->email) }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ htmlspecialchars_decode($contact->phone) }}</td>
            </tr>
            <tr>
                <th>Subjek</th>
                <td>{{ htmlspecialchars_decode($contact->subject) }}</td>
            </tr>
            <tr>
                <th>Pesan</th>
                <td>{{ htmlspecialchars_decode($contact->message) }}</td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $contact->created_at->format('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <th>Diupdate Pada</th>
                <td>{{ $contact->updated_at->format('d F Y, H:i') }}</td>
            </tr>
        </table>
    </div>
@endsection
