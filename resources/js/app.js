import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('cpfMask', (initialValue) => ({
    cpf: initialValue,
    formatCPF() {
        let value = this.cpf.replace(/\D/g, ''); // Remove não numéricos
        if (value.length > 11) value = value.slice(0, 11); // Limita a 11 números
        
        // Aplica a máscara (000.000.000-00)
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

        this.cpf = value;
    }
}));

Alpine.data('phoneMask', (initialValue) => ({
    phone: initialValue,
    formatPhone() {
        let value = this.phone.replace(/\D/g, ''); // Remove não numéricos
        if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos
        
        // Aplica a máscara (00) 00000-0000
        value = value.replace(/^(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');

        this.phone = value;
    }
}));

Alpine.start();
