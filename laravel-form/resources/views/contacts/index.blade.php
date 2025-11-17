@extends('layouts.app')

@section('title', 'Daftar Kontak')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">➕ Tambah Kontak Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <h2>📋 Daftar Semua Kontak</h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Subjek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $index => $contact)
                    <tr>
                        <td>{{ $contacts->firstItem() + $index }}</td>
                        <td>{{ htmlspecialchars_decode($contact->name) }}</td>
                        <td>{{ htmlspecialchars_decode($contact->email) }}</td>
                        <td>{{ htmlspecialchars_decode($contact->phone) }}</td>
                        <td>{{ htmlspecialchars_decode($contact->subject) }}</td>
                        <td>
                            <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info">👁️ Lihat</a>
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">✏️ Edit</a>
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data kontak</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <div>
            {{ $contacts->links() }}
        </div>
    </div>
@endsection
