@extends('layouts.app')

@section('title', 'Metode Pembayaran')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .payment-container {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .payment-grid {
            grid-template-columns: 1fr;
        }
    }

    .payment-section {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .payment-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
    }

    .payment-method-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .payment-method-card {
        position: relative;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .payment-method-card:hover {
        border-color: #ff7a18;
        box-shadow: 0 4px 12px rgba(255, 122, 24, 0.1);
    }

    .payment-method-card.selected {
        border-color: #ff7a18;
        background: #fff7f0;
        box-shadow: 0 4px 16px rgba(255, 122, 24, 0.15);
    }

    .payment-method-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .payment-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #ff7a18 0%, #ff9a44 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .payment-method-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        flex: 1;
    }

    .payment-radio {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #ff7a18;
    }

    .payment-options {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-left: 60px;
    }

    .payment-option-badge {
        background: #f3f4f6;
        color: #6b7280;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .payment-method-card.selected .payment-option-badge {
        background: #ffeedd;
        color: #ff7a18;
    }

    /* Sub-options (Bank selection, etc) */
    .payment-suboptions {
        margin-left: 60px;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        display: none;
    }

    .payment-method-card.selected .payment-suboptions {
        display: block;
    }

    .suboption-group {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    @media (max-width: 640px) {
        .suboption-group {
            grid-template-columns: 1fr;
        }
    }

    .suboption-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .suboption-radio {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #ff7a18;
    }

    .suboption-label {
        font-size: 0.95rem;
        color: #374151;
        cursor: pointer;
        user-select: none;
    }

    /* Detail Pesanan Sidebar */
    .order-summary {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        position: sticky;
        top: 2rem;
    }

    .summary-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .summary-label {
        color: #6b7280;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .summary-value {
        color: #1a1a1a;
        font-weight: 600;
        text-align: right;
    }

    .summary-id {
        font-family: 'Courier New', monospace;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .summary-package {
        color: #ff7a18;
        font-weight: 600;
    }

    .summary-total {
        padding: 1.25rem 0 0 0;
        margin-top: 0.5rem;
        border-top: 2px solid #ff7a18;
    }

    .summary-total .summary-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .summary-total .summary-value {
        font-size: 1.5rem;
        color: #ff7a18;
        font-weight: 700;
    }

    .submit-button {
        width: 100%;
        background: linear-gradient(135deg, #ff7a18 0%, #ff9a44 100%);
        color: white;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(255, 122, 24, 0.3);
        margin-top: 1.5rem;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 122, 24, 0.4);
    }

    .submit-button:active {
        transform: translateY(0);
    }

    .submit-button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .back-link {
        display: block;
        text-align: center;
        color: #6b7280;
        margin-top: 1rem;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #ff7a18;
    }

    .error-text {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="payment-container">
    <div class="payment-grid">
        <!-- Metode Pembayaran -->
        <div class="payment-section">
            <h1 class="payment-title">Pilih Metode Pembayaran</h1>

            <form action="{{ route('payments.pay', $payment) }}" method="POST" id="paymentForm">
                @csrf

                <div class="payment-method-group">
                    <!-- Transfer Bank -->
                    <div class="payment-method-card" data-method="bank_transfer">
                        <div class="payment-method-header">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-method-title">Transfer Bank</div>
                            <input type="radio" name="payment_method" value="bank_transfer" class="payment-radio" required>
                        </div>
                        <div class="payment-options">
                            <span class="payment-option-badge">BCA</span>
                            <span class="payment-option-badge">Mandiri</span>
                            <span class="payment-option-badge">BNI</span>
                            <span class="payment-option-badge">BRI</span>
                        </div>
                        
                        <!-- Bank Selection Sub-options -->
                        <div class="payment-suboptions">
                            <div class="suboption-group">
                                <label class="suboption-item">
                                    <input type="radio" name="bank_provider" value="BCA" class="suboption-radio">
                                    <span class="suboption-label">BCA</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="bank_provider" value="Mandiri" class="suboption-radio">
                                    <span class="suboption-label">Mandiri</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="bank_provider" value="BNI" class="suboption-radio">
                                    <span class="suboption-label">BNI</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="bank_provider" value="BRI" class="suboption-radio">
                                    <span class="suboption-label">BRI</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- E-Wallet -->
                    <div class="payment-method-card" data-method="e_wallet">
                        <div class="payment-method-header">
                            <div class="payment-icon">💳</div>
                            <div class="payment-method-title">E-Wallet</div>
                            <input type="radio" name="payment_method" value="e_wallet" class="payment-radio">
                        </div>
                        <div class="payment-options">
                            <span class="payment-option-badge">GoPay</span>
                            <span class="payment-option-badge">OVO</span>
                            <span class="payment-option-badge">Dana</span>
                            <span class="payment-option-badge">ShopeePay</span>
                        </div>

                        <!-- E-Wallet Selection Sub-options -->
                        <div class="payment-suboptions">
                            <div class="suboption-group">
                                <label class="suboption-item">
                                    <input type="radio" name="ewallet_provider" value="GoPay" class="suboption-radio">
                                    <span class="suboption-label">GoPay</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="ewallet_provider" value="OVO" class="suboption-radio">
                                    <span class="suboption-label">OVO</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="ewallet_provider" value="Dana" class="suboption-radio">
                                    <span class="suboption-label">Dana</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="ewallet_provider" value="ShopeePay" class="suboption-radio">
                                    <span class="suboption-label">ShopeePay</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Kredit/Debit -->
                    <div class="payment-method-card" data-method="credit_card">
                        <div class="payment-method-header">
                            <div class="payment-icon">💳</div>
                            <div class="payment-method-title">Kartu Kredit/Debit</div>
                            <input type="radio" name="payment_method" value="credit_card" class="payment-radio">
                        </div>
                        <div class="payment-options">
                            <span class="payment-option-badge">Visa</span>
                            <span class="payment-option-badge">Mastercard</span>
                            <span class="payment-option-badge">JCB</span>
                        </div>

                        <!-- Card Type Selection Sub-options -->
                        <div class="payment-suboptions">
                            <div class="suboption-group">
                                <label class="suboption-item">
                                    <input type="radio" name="card_provider" value="Visa" class="suboption-radio">
                                    <span class="suboption-label">Visa</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="card_provider" value="Mastercard" class="suboption-radio">
                                    <span class="suboption-label">Mastercard</span>
                                </label>
                                <label class="suboption-item">
                                    <input type="radio" name="card_provider" value="JCB" class="suboption-radio">
                                    <span class="suboption-label">JCB</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                @error('payment_method')
                    <p class="error-text">{{ $message }}</p>
                @enderror

                <button type="submit" class="submit-button" id="submitBtn">Bayar Sekarang</button>
                <a href="{{ route('payments.show', $payment) }}" class="back-link">← Kembali</a>
            </form>
        </div>

        <!-- Detail Pesanan -->
        <div class="order-summary">
            <h2 class="summary-title">Detail Pesanan</h2>

            <div class="summary-item">
                <span class="summary-label">ID Pesanan</span>
                <span class="summary-value summary-id">GT{{ str_pad($payment->id, 8, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Paket</span>
                <span class="summary-value summary-package">{{ $payment->package->title ?? 'N/A' }}</span>
            </div>

            @if($payment->package && $payment->package->duration)
            <div class="summary-item">
                <span class="summary-label">Durasi</span>
                <span class="summary-value">{{ $payment->package->duration }}</span>
            </div>
            @endif

            <div class="summary-item">
                <span class="summary-label">Nama</span>
                <span class="summary-value">{{ $payment->full_name }}</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Email</span>
                <span class="summary-value" style="font-size: 0.85rem;">{{ $payment->email }}</span>
            </div>

            @if($payment->phone)
            <div class="summary-item">
                <span class="summary-label">Tel</span>
                <span class="summary-value">{{ $payment->phone }}</span>
            </div>
            @endif

            @if($payment->participants)
            <div class="summary-item">
                <span class="summary-label">Peserta</span>
                <span class="summary-value">{{ $payment->participants }} orang</span>
            </div>
            @endif

            @if($payment->travel_date)
            <div class="summary-item">
                <span class="summary-label">Tanggal</span>
                <span class="summary-value">{{ $payment->travel_date->format('d M Y') }}</span>
            </div>
            @endif

            <div class="summary-item summary-total">
                <span class="summary-label">Total</span>
                <span class="summary-value">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.payment-method-card');
    const methodRadios = document.querySelectorAll('input[name="payment_method"]');
    const form = document.getElementById('paymentForm');
    const submitBtn = document.getElementById('submitBtn');

    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.classList.contains('suboption-radio')) {
                return;
            }
            
            if (e.target.type !== 'radio' || e.target.name === 'payment_method') {
                const radio = this.querySelector('input[name="payment_method"]');
                radio.checked = true;
                updateSelection();
            }
        });
    });

    methodRadios.forEach(radio => {
        radio.addEventListener('change', updateSelection);
    });

    function updateSelection() {
        cards.forEach(card => {
            const radio = card.querySelector('input[name="payment_method"]');
            if (radio.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
                const subRadios = card.querySelectorAll('.suboption-radio');
                subRadios.forEach(sr => sr.checked = false);
            }
        });
    }

    form.addEventListener('submit', function(e) {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
        
        if (!selectedMethod) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran');
            return;
        }

        const methodValue = selectedMethod.value;

        if (methodValue === 'bank_transfer') {
            const selectedBank = document.querySelector('input[name="bank_provider"]:checked');
            if (!selectedBank) {
                e.preventDefault();
                alert('Silakan pilih bank untuk transfer');
                return;
            }
        } else if (methodValue === 'e_wallet') {
            const selectedEwallet = document.querySelector('input[name="ewallet_provider"]:checked');
            if (!selectedEwallet) {
                e.preventDefault();
                alert('Silakan pilih e-wallet');
                return;
            }
        } else if (methodValue === 'credit_card') {
            const selectedCard = document.querySelector('input[name="card_provider"]:checked');
            if (!selectedCard) {
                e.preventDefault();
                alert('Silakan pilih jenis kartu');
                return;
            }
        }
    });

    updateSelection();
});
</script>
@endpush
@endsection
