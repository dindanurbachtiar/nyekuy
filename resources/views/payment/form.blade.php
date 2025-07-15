@extends('layouts.app')

@section('title', 'Pembayaran Tunai')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="bg-white border rounded-4 shadow-lg p-4 overflow-auto" style="max-height: 90vh; width: 100%; max-width: 500px;">

        <!-- Header -->
        <div class="bg-danger px-4 py-3 text-white d-flex align-items-center rounded-3 mb-4">
            <i class="fas fa-cash-register me-2"></i>
            <h1 class="h5 m-0">Pembayaran Tunai</h1>
        </div>

        <!-- Form -->
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf

            <!-- Total Pesanan -->
            <div class="mb-3">
                <label class="form-label">Total Pesanan</label>
                <div class="form-control bg-light fw-bold text-primary">
                    Rp. {{ number_format($orderTotal, 0, ',', '.') }}
                </div>
                <input type="hidden" name="order_total" value="{{ $orderTotal }}">
            </div>

            <!-- Pilih Nominal Cepat -->
            <div class="mb-3">
                <label class="form-label">Pilih Nominal Cepat</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($quickAmounts as $amount)
                        <button type="button"
                                class="quick-amount-btn btn btn-outline-success btn-sm"
                                data-amount="{{ $amount }}">
                            Rp. {{ number_format($amount, 0, ',', '.') }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Input Uang -->
            <div class="mb-3">
                <label for="paid_amount" class="form-label">Uang Dibayarkan</label>
                <input type="number"
                       id="paid_amount"
                       name="paid_amount"
                       value="{{ old('paid_amount') }}"
                       class="form-control"
                       placeholder="Masukkan jumlah uang"
                       min="1">
                @error('paid_amount')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kembalian -->
            <div id="change-display" class="mb-3 bg-light border rounded p-3 d-none">
                <div class="mb-1 fw-medium">Kembalian:</div>
                <div class="d-flex justify-content-between">
                    <span id="change-amount" class="fw-bold text-success">Rp. 0</span>
                </div>
                <div id="insufficient-warning" class="text-danger small mt-2 d-none">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Uang yang dibayarkan kurang!
                </div>
            </div>

            <input type="hidden" name="payment_method" value="cash">

            <!-- Tombol Bayar -->
            <div class="text-center">
                <button type="submit" id="pay-button" class="btn btn-danger px-4">
                    <i class="fas fa-cash-register me-2"></i> Bayar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quickAmountBtns = document.querySelectorAll('.quick-amount-btn');
    const paidAmountInput = document.getElementById('paid_amount');
    const changeDisplay = document.getElementById('change-display');
    const changeAmount = document.getElementById('change-amount');
    const insufficientWarning = document.getElementById('insufficient-warning');
    const payButton = document.getElementById('pay-button');
    const orderTotal = {{ $orderTotal }};

    quickAmountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            paidAmountInput.value = this.dataset.amount;
            calculateChange();
        });
    });

    paidAmountInput.addEventListener('input', function() {
        calculateChange();
    });

    function calculateChange() {
        const paid = parseFloat(paidAmountInput.value) || 0;
        const change = paid - orderTotal;

        if (paid > 0) {
            changeDisplay.classList.remove('d-none');

            if (change >= 0) {
                changeAmount.textContent = 'Rp. ' + change.toLocaleString('id-ID');
                insufficientWarning.classList.add('d-none');
                payButton.disabled = false;
            } else {
                changeAmount.textContent = 'Rp. ' + Math.abs(change).toLocaleString('id-ID') + ' kurang';
                insufficientWarning.classList.remove('d-none');
                payButton.disabled = true;
            }
        } else {
            changeDisplay.classList.add('d-none');
            payButton.disabled = true;
        }
    }
});
</script>
@endsection
