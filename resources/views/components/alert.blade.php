{{-- Flash Messages (Sucesso ou Erro) --}}
<div x-data="{ show: false, message: '', type: 'success' }"
    x-init="
    @if (session('success'))
        show = true;
        message = '✅ {{ session('success') }}';
        type = 'success';
        setTimeout(() => show = false, 4000);
    @elseif (session('error'))
        show = true;
        message = '{{ session('error') }}';
        type = 'error';
        setTimeout(() => show = false, 4000);
    @endif
    "
    x-show="show"
    x-transition
    :class="{
    'bg-green-500': type === 'success',
    'bg-red-500': type === 'error'
    }"
    class="fixed bottom-5 right-5 text-white px-4 py-3 rounded shadow-lg">
    <span x-text="message"></span>
</div>