<script>
    function formatCurrencyID(amount) {
        if (typeof amount !== 'number') {
            amount = parseFloat(amount);
        }

        return amount.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }

    function formatDateTime(date) {
        // if date contains time, format it to include time. Otherwise, only show date
        $options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        };

        if (date.includes('T')) { 
            $options.hour = 'numeric';
            $options.minute = 'numeric';

            return new Date(date).toLocaleString('id-ID', $options);
        }

        return new Date(date).toLocaleDateString('id-ID', $options);
    }

    function get_service_difficulty_level(difficulty) {
        switch (parseInt(difficulty)) {
            case 1:
                return 'Ringan';
            case 2:
                return 'Sedang';
            case 3:
                return 'Besar';
            default:
                return 'Tidak Diketahui';
        }
    }
</script>