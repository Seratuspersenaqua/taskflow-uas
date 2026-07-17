<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // 1. Menampilkan daftar tugas milik user yang sedang login (Read)
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('tasks'));
    }

    // 2. Menyimpan tugas baru ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => Auth::id(), // Menyimpan berdasarkan ID user yang sedang login
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!');
    }

    // 3. Mengubah status atau mengedit teks tugas (Update)
    public function update(Request $request, Task $task)
    {
        // Pastikan ini tugas milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // JIKA USER MENGKLIK CHECKBOX (Hanya mengubah status selesai)
        if ($request->has('toggle_status')) {
            $task->update([
                'is_completed' => !$task->is_completed
            ]);
            return redirect()->route('dashboard')->with('success', 'Status tugas diperbarui!');
        }

        // JIKA USER MENGISI FORM EDIT (Mengubah judul & deskripsi)
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui!');
    }

    // 4. Menghapus tugas (Delete)
    public function destroy(Task $task)
    {
        // Pastikan ini tugas milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus!');
    }
}