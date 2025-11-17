<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // Menampilkan semua kontak
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    // Menampilkan form tambah kontak
    public function create()
    {
        return view('contacts.create');
    }

    // Menyimpan kontak baru (dengan keamanan)
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:contacts,email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.required' => 'Nomor telepon harus diisi',
            'subject.required' => 'Subjek harus diisi',
            'message.required' => 'Pesan harus diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Anti XSS dengan htmlentities
        $data = [
            'name' => htmlentities($request->name, ENT_QUOTES, 'UTF-8'),
            'email' => htmlentities($request->email, ENT_QUOTES, 'UTF-8'),
            'phone' => htmlentities($request->phone, ENT_QUOTES, 'UTF-8'),
            'subject' => htmlentities($request->subject, ENT_QUOTES, 'UTF-8'),
            'message' => htmlentities($request->message, ENT_QUOTES, 'UTF-8')
        ];

        // Laravel Eloquent otomatis mencegah SQL Injection
        Contact::create($data);

        return redirect()->route('contacts.index')
            ->with('success', 'Kontak berhasil ditambahkan!');
    }

    // Menampilkan detail kontak
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    // Menampilkan form edit
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // Update kontak
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:contacts,email,' . $contact->id,
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => htmlentities($request->name, ENT_QUOTES, 'UTF-8'),
            'email' => htmlentities($request->email, ENT_QUOTES, 'UTF-8'),
            'phone' => htmlentities($request->phone, ENT_QUOTES, 'UTF-8'),
            'subject' => htmlentities($request->subject, ENT_QUOTES, 'UTF-8'),
            'message' => htmlentities($request->message, ENT_QUOTES, 'UTF-8')
        ];

        $contact->update($data);

        return redirect()->route('contacts.index')
            ->with('success', 'Kontak berhasil diupdate!');
    }

    // Hapus kontak
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Kontak berhasil dihapus!');
    }
}