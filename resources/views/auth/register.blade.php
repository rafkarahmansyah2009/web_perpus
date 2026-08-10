<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Portal Perpustakaan SMKN 5 Tangerang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#0d1117] flex items-center justify-center p-4">
    {{-- Background decoration --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-violet-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md animate-fade-in-up relative my-8">
        {{-- Card --}}
        <div class="bg-[#161b22]/80 backdrop-blur-xl border border-[#30363d] rounded-2xl p-8 shadow-2xl shadow-black/50">
            {{-- Logo --}}
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-violet-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/20">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h1 class="text-2xl font-bold font-['Space_Grotesk'] mb-1">Daftar Akun</h1>
                <p class="text-[#8b949e] text-sm">SMKN 5 Tangerang</p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    <div class="flex flex-col gap-1">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-red-400 text-sm">{{ $error }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-[#8b949e] mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="input-dark" placeholder="Nama Lengkap">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-[#8b949e] mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="input-dark" placeholder="contoh@smkn5tng.sch.id">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-[#8b949e] mb-2">Peran</label>
                    <select id="role" name="role" required class="input-dark bg-[#0d1117] text-[#c9d1d9] border-[#30363d] focus:border-blue-500 focus:ring-blue-500/20 rounded-xl w-full px-4 py-2.5">
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru / Staff</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-[#8b949e] mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="input-dark pr-12" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#8b949e] hover:text-white transition-colors">
                            <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#8b949e] mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="input-dark pr-12" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#8b949e] hover:text-white transition-colors">
                            <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full btn-gradient py-3 text-base mt-2">
                    Daftar Sekarang
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-[#8b949e] text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors font-medium">Masuk disini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[#8b949e] text-xs mt-6">&copy; {{ date('Y') }} Perpustakaan SMKN 5 Tangerang</p>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
