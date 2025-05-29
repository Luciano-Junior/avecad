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

Alpine.data('currencyMask', (initialValue) => ({
    amount: initialValue,
    formatCurrency() {
        let value = this.amount.replace(/\D/g, ''); // Remove tudo que não for número

        // Se não tiver nada digitado, zera
        if (value.length === 0) {
            this.amount = '';
            return;
        }

        // Garante ao menos 3 dígitos: 1 → 0,01 | 12 → 0,12 | 123 → 1,23
        if (value.length === 1) value = '00' + value;
        else if (value.length === 2) value = '0' + value;

        // Separa os centavos
        const cents = value.slice(-2);
        let reais = value.slice(0, -2);

        // Remove zeros à esquerda em reais (evita "0.010")
        reais = reais.replace(/^0+/, '') || '0';

        // Adiciona separadores de milhar
        reais = reais.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        // Monta a string final
        this.amount = `${reais},${cents}`;
    }
}));

Alpine.start();
