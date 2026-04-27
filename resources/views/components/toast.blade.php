@if(session('success'))
<div id="toast-success" class="fixed top-6 right-6 z-[100] animate-slide-in-right">
    <div class="flex items-center gap-3 bg-[#161b22] border border-green-500/30 rounded-2xl px-5 py-4 shadow-2xl shadow-green-500/10">
        <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <p class="text-sm text-green-400 font-medium">{{ session('success') }}</p>
        <button onclick="this.closest('#toast-success').remove()" class="text-[#8b949e] hover:text-white ml-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
</div>
<script>setTimeout(() => { const t = document.getElementById('toast-success'); if(t) { t.classList.add('animate-slide-out-right'); setTimeout(() => t.remove(), 300); } }, 3000);</script>
@endif

@if(session('error'))
<div id="toast-error" class="fixed top-6 right-6 z-[100] animate-slide-in-right">
    <div class="flex items-center gap-3 bg-[#161b22] border border-red-500/30 rounded-2xl px-5 py-4 shadow-2xl shadow-red-500/10">
        <div class="w-8 h-8 bg-red-500/20 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </div>
        <p class="text-sm text-red-400 font-medium">{{ session('error') }}</p>
        <button onclick="this.closest('#toast-error').remove()" class="text-[#8b949e] hover:text-white ml-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
</div>
<script>setTimeout(() => { const t = document.getElementById('toast-error'); if(t) { t.classList.add('animate-slide-out-right'); setTimeout(() => t.remove(), 300); } }, 3000);</script>
@endif
