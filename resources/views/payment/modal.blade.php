<!-- Modal Header -->
<div class="flex items-center justify-between p-6 border-b border-gray-200">
    <div class="flex items-center">
        <button onclick="closePaymentModal()" class="mr-4 p-2 hover:bg-gray-200 rounded-full transition-colors">
            <i class="fas fa-arrow-left text-gray-600"></i>
        </button>
        <h2 class="text-xl font-semibold text-gray-800">Pembayaran</h2>
    </div>
</div>

<!-- Modal Body -->
<div class="p-6">
    <form id="payment-form">
        @csrf
        <input type="hidden" name="order_total" value="{{ $orderTotal }}">
        
        <!-- Total Display -->
        <div class="mb-6">
            <div class="flex items-center mb-2">
                <span class="text-gray-500 text-sm">Total :</span>
            </div>
            <div class="bg-white rounded-lg px-4 py-3 shadow-sm border">
                <span class="text-2xl font-bold text-gray-800">
                    Rp. {{ number_format($orderTotal, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Quick Amount Buttons -->
        <div class="mb-4">
            <div class="grid grid-cols-3 gap-3">
                @foreach($quickAmounts as $amount)
                <button type="button" 
                        class="amount-btn px-4 py-3 rounded-lg font-medium text-gray-700 text-center"
                        data-amount="{{ $amount }}">
                    Rp. {{ number_format($amount, 0, ',', '.') }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Selected Amount Display -->
        <div class="mb-6">
            <input type="number" 
                   id="selected-amount"
                   name="amount" 
                   value="20000"
                   class="amount-input w-full px-4 py-3 text-xl font-semibold text-gray-800 focus:outline-none"
                   placeholder="Masukkan jumlah">
        </div>

        <!-- Payment Methods -->
        <div class="mb-6">
            <div class="grid grid-cols-3 gap-3">
                @foreach($paymentMethods as $method)
                <button type="button" 
                        class="payment-method-btn bg-white p-3 rounded-lg border-2 border-gray-200 hover:border-blue-300 transition-all duration-200"
                        data-method="{{ $method['id'] }}">
                    <div class="text-center">
                        @if($method['id'] == 'shopeepay')
                            <div class="w-8 h-8 mx-auto mb-1 bg-orange-500 rounded flex items-center justify-center">
                                <span class="text-white text-xs font-bold">S</span>
                            </div>
                            <span class="text-xs font-medium text-orange-600">Pay</span>
                        @elseif($method['id'] == 'gopay')
                            <div class="w-8 h-8 mx-auto mb-1 bg-green-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-bold">G</span>
                            </div>
                            <span class="text-xs font-medium text-green-600">gopay</span>
                        @elseif($method['id'] == 'dana')
                            <div class="w-8 h-8 mx-auto mb-1 bg-blue-500 rounded flex items-center justify-center">
                                <span class="text-white text-xs font-bold">D</span>
                            </div>
                            <span class="text-xs font-medium text-blue-600">DANA</span>
                        @elseif($method['id'] == 'ovo')
                            <div class="w-8 h-8 mx-auto mb-1 bg-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-bold">O</span>
                            </div>
                            <span class="text-xs font-medium text-purple-600">OVO</span>
                        @else
                            <div class="w-8 h-8 mx-auto mb-1 bg-gray-400 rounded flex items-center justify-center">
                                <i class="fas fa-university text-white text-xs"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-600">Bank Lain</span>
                        @endif
                    </div>
                </button>
                @endforeach
            </div>
            <input type="hidden" id="payment-method" name="payment_method" value="">
        </div>

        <!-- Error Display -->
        <div id="error-message" class="hidden mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm"></div>

        <!-- Pay Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    id="pay-button"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg disabled:opacity-50"
                    disabled>
                <span id="pay-button-text">Bayar</span>
                <i id="pay-button-loading" class="fas fa-spinner fa-spin ml-2 hidden"></i>
            </button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    let selectedAmount = 20000;
    let selectedPaymentMethod = '';
    
    // Handle quick amount buttons
    $('.amount-btn').click(function() {
        selectedAmount = $(this).data('amount');
        $('#selected-amount').val(selectedAmount);
        
        // Update button states
        $('.amount-btn').removeClass('active');
        $(this).addClass('active');
        
        checkFormValidity();
    });
    
    // Handle amount input
    $('#selected-amount').on('input', function() {
        selectedAmount = $(this).val();
        
        // Remove active state from quick buttons
        $('.amount-btn').removeClass('active');
        
        checkFormValidity();
    });
    
    // Handle payment method selection
    $('.payment-method-btn').click(function() {
        selectedPaymentMethod = $(this).data('method');
        $('#payment-method').val(selectedPaymentMethod);
        
        // Update button states
        $('.payment-method-btn').removeClass('border-blue-500 bg-blue-50');
        $(this).addClass('border-blue-500 bg-blue-50');
        
        checkFormValidity();
    });
    
    // Check form validity
    function checkFormValidity() {
        if (selectedAmount > 0 && selectedPaymentMethod) {
            $('#pay-button').prop('disabled', false);
        } else {
            $('#pay-button').prop('disabled', true);
        }
    }
    
    // Handle form submission
    $('#payment-form').submit(function(e) {
        e.preventDefault();
        
        // Show loading state
        $('#pay-button').prop('disabled', true);
        $('#pay-button-text').text('Memproses...');
        $('#pay-button-loading').removeClass('hidden');
        $('#error-message').addClass('hidden');
        
        $.ajax({
            url: '{{ route("payment.process") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Show success message
                    alert('Pembayaran berhasil!\nID Transaksi: ' + response.data.transaction_id);
                    closePaymentModal();
                } else {
                    showError('Pembayaran gagal. Silakan coba lagi.');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'Terjadi kesalahan:\n';
                    Object.keys(errors).forEach(key => {
                        errorMessage += '- ' + errors[key][0] + '\n';
                    });
                    showError(errorMessage);
                } else {
                    showError('Terjadi kesalahan sistem. Silakan coba lagi.');
                }
            },
            complete: function() {
                // Reset loading state
                $('#pay-button').prop('disabled', false);
                $('#pay-button-text').text('Bayar');
                $('#pay-button-loading').addClass('hidden');
                checkFormValidity();
            }
        });
    });
    
    function showError(message) {
        $('#error-message').text(message).removeClass('hidden');
    }
    
    // Set default amount button as active
    $('.amount-btn[data-amount="20000"]').addClass('active');
    checkFormValidity();
});
</script>