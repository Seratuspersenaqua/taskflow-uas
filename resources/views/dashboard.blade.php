<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                🚀 {{ __('TaskFlow') }} 
                <span class="text-sm font-normal bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full">Workspace</span>
            </h2>
            <p class="text-sm text-gray-500">Halo, <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>!</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- FORM TAMBAH TUGAS (CREATE) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-6 transition-all hover:shadow-md">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-3">
                    <span class="p-2 bg-blue-50 text-blue-600 rounded-lg text-lg">📝</span>
                    <h3 class="text-lg font-bold text-gray-800">Tambah Tugas Baru</h3>
                </div>
                
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Judul Tugas</label>
                        <input type="text" name="title" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none" 
                            placeholder="Contoh: Belajar Pemrograman Web 2">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none resize-none" 
                            placeholder="Detail atau catatan tugas..."></textarea>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow-sm shadow-blue-500/20 transition-all transform active:scale-95 flex items-center gap-2 text-sm cursor-pointer">
                            Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>

            <!-- DAFTAR TUGAS (READ, UPDATE, DELETE) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-6">
                <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="p-2 bg-amber-50 text-amber-600 rounded-lg text-lg">📋</span>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Tugas Anda</h3>
                    </div>
                    <span class="text-xs bg-gray-100 text-gray-600 font-medium px-2.5 py-1 rounded-full">Total: {{ $tasks->count() }}</span>
                </div>
                
                @if($tasks->isEmpty())
                    <div class="text-center py-8">
                        <span class="text-4xl">🎉</span>
                        <p class="text-gray-400 text-sm mt-2">Belum ada data tugas. Silakan tambah di atas!</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($tasks as $task)
                            <div class="py-4 flex items-center justify-between group transition-all">
                                <div class="flex items-start gap-3 flex-1 mr-4">
                                    <!-- TOMBOL CEKLIS STATUS -->
                                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="mt-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="toggle_status" value="1">
                                        <input type="checkbox" onChange="this.form.submit()" {{ $task->is_completed ? 'checked' : '' }} 
                                            class="rounded border-gray-300 text-blue-600 w-5 h-5 cursor-pointer transition-all">
                                    </form>
                                    
                                    <div class="space-y-0.5">
                                        <p class="text-sm font-semibold transition-all {{ $task->is_completed ? 'line-through text-gray-400 font-normal' : 'text-gray-800' }}">
                                            {{ $task->title }}
                                        </p>
                                        @if($task->description)
                                            <p class="text-xs text-gray-400 {{ $task->is_completed ? 'line-through' : '' }}">
                                                {{ $task->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <!-- TOMBOL EDIT -->
                                    <button onclick="openEditModal('{{ $task->id }}', '{{ addslashes($task->title) }}', '{{ addslashes($task->description) }}')"
                                        class="text-amber-500 hover:text-amber-700 hover:bg-amber-50 p-2 rounded-lg transition-all cursor-pointer">
                                        ✏️
                                    </button>

                                    <!-- TOMBOL HAPUS -->
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus tugas ini?')" 
                                            class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-all cursor-pointer">
                                            ❌
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- JENDELA POP-UP (MODAL) FOR EDIT TUGAS -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-900/50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 space-y-4">
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2">✏️ Edit Tugas</h3>
            
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Judul Tugas</label>
                    <input type="text" id="editTitle" name="title" required 
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Deskripsi</label>
                    <textarea id="editDescription" name="description" rows="3"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 rounded-lg cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK MODAL POP-UP -->
    <script>
        function openEditModal(id, title, description) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const inputTitle = document.getElementById('editTitle');
            const inputDesc = document.getElementById('editDescription');
            
            form.action = `/tasks/${id}`;
            inputTitle.value = title;
            inputDesc.value = description;
            
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>