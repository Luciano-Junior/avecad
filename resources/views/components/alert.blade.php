<div 
    x-data="{
        show: false, 
        message: '', 
        type: 'success',
        init() {
            // Se houver mensagens da sessão (ex: redirect)
            @if (session('success'))
                this.message = '✅ {{ session('success') }}';
                this.type = 'success';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            @elseif (session('error'))
                this.message = '✖{{ session('error') }}';
                this.type = 'error';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            @elseif (session('notify'))
                this.message = '❕{{ session('notify') }}';
                this.type = 'notify';
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            @endif

            // Evento para mensagens vindas de Livewire
            window.addEventListener('show-message', event => {
                const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
                let icon = '';
                if(detail.type === 'success'){
                    icon = '✅ ';
                }else if(detail.type === 'info' || detail.type === 'notify'){
                    icon = '❕ ';
                }else{
                    icon = '✖ ';
                }
                this.message = icon + detail.message;
                this.type = detail.type;
                this.show = true;
                setTimeout(() => this.show = false, 4000);
            });
        }
    }"
    x-show="show"
    x-transition
    :class="{
        'bg-green-500': type === 'success',
        'bg-red-500': type === 'error',
        'bg-blue-400': type === 'info'
    }"
    class="fixed bottom-5 right-5 text-white px-4 py-3 rounded shadow-lg z-50"
>
    <span x-text="message"></span>
</div>