@extends('layouts.app')

@section('title', 'Form Pemesanan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    .booking-container {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 0 1.5rem;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .booking-grid {
            grid-template-columns: 1fr;
        }
    }

    .booking-form {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        outline: none;
        border-color: #ff7a18;
        background: white;
        box-shadow: 0 0 0 3px rgba(255, 122, 24, 0.1);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.375rem;
    }

    .summary-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        position: sticky;
        top: 2rem;
    }

    .summary-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .summary-package-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .summary-package-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f3f4f6;
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
    }

    .summary-value {
        color: #1a1a1a;
        font-weight: 600;
    }

    .summary-total {
        margin-top: 1rem;
        padding-top: 1rem;
    }

    .summary-total .summary-label {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .summary-total .summary-value {
        font-size: 1.5rem;
        color: #1a1a1a;
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

    .cancel-button {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.875rem;
        background: #f3f4f6;
        color: #6b7280;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        margin-top: 0.75rem;
    }

    .cancel-button:hover {
        background: #e5e7eb;
        color: #374151;
    }
</style>
@endpush

@section('content')
<div class="booking-container">
    <div class="booking-grid">
        <!-- Form Pemesanan -->
        <div class="booking-form">
            <h1 class="form-title">Form Pemesanan</h1>

            <form action="{{ route('payments.store') }}" method="POST" id="bookingForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Pilih Paket <span class="required-star">*</span></label>
                    <select name="package_id" id="packageSelect" class="form-control" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->id }}" 
                                    data-price="{{ $pkg->price }}"
                                    data-title="{{ $pkg->title }}"
                                    {{ $package && $package->id == $pkg->id ? 'selected' : '' }}>
                                {{ $pkg->title }} — Rp {{ number_format($pkg->price ?? 0, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                    <input type="text" name="full_name" id="fullName" value="{{ old('full_name', auth()->user()->name ?? '') }}" class="form-control" placeholder="sharaanjelia" required>
                    @error('full_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span class="required-star">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="form-control" placeholder="sharaanjelia@gmail.com" required>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon <span class="required-star">*</span></label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" placeholder="08xxxxxxxxxx" required>
                    @error('phone')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jumlah Peserta <span class="required-star">*</span></label>
                        <input type="number" name="participants" id="participants" value="{{ old('participants', 1) }}" min="1" class="form-control" required>
                        @error('participants')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Keberangkatan <span class="required-star">*</span></label>
                        <input type="date" name="travel_date" id="travelDate" value="{{ old('travel_date') }}" class="form-control" required>
                        @error('travel_date')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="amount" id="totalAmount" value="{{ old('amount', $package->price ?? 0) }}">

                <div class="form-group">
                    <label class="form-label">Permintaan Khusus</label>
                    <textarea name="requests" rows="3" class="form-control" placeholder="Catatan atau permintaan khusus untuk perjalanan...">{{ old('requests') }}</textarea>
                    @error('requests')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="submit-button">Lanjutkan ke Pembayaran</button>
                <a href="{{ route('paket.index') }}" class="cancel-button">Batal</a>
            </form>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="summary-card">
            <h2 class="summary-title">Ringkasan Pesanan</h2>

            <div id="summaryPackageName" class="summary-package-name">
                {{ $package->title ?? 'Pilih paket terlebih dahulu' }}
            </div>
            <div id="summaryPackagePrice" class="summary-package-price">
                {{ $package ? '— Rp ' . number_format($package->price, 0, ',', '.') : '' }}
            </div>

            <div class="summary-item">
                <span class="summary-label">Harga per orang</span>
                <span class="summary-value" id="pricePerPerson">Rp {{ number_format($package->price ?? 0, 0, ',', '.') }}</span>
            </div>

            <div class="summary-item">
                <span class="summary-label">Jumlah peserta</span>
                <span class="summary-value" id="totalParticipants">1 orang</span>
            </div>

            <div class="summary-item summary-total">
                <span class="summary-label">Total Pembayaran</span>
                <span class="summary-value" id="grandTotal">Rp {{ number_format($package->price ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const packageSelect = document.getElementById('packageSelect');
    const participantsInput = document.getElementById('participants');
    const totalAmountInput = document.getElementById('totalAmount');
    
    const summaryPackageName = document.getElementById('summaryPackageName');
    const summaryPackagePrice = document.getElementById('summaryPackagePrice');
    const pricePerPerson = document.getElementById('pricePerPerson');
    const totalParticipants = document.getElementById('totalParticipants');
    const grandTotal = document.getElementById('grandTotal');

    function updateSummary() {
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        const price = parseInt(selectedOption.getAttribute('data-price')) || 0;
        const title = selectedOption.getAttribute('data-title') || 'Pilih paket terlebih dahulu';
        const participants = parseInt(participantsInput.value) || 1;
        const total = price * participants;

        summaryPackageName.textContent = title;
        summaryPackagePrice.textContent = price > 0 ? '— Rp ' + formatNumber(price) : '';
        pricePerPerson.textContent = 'Rp ' + formatNumber(price);
        totalParticipants.textContent = participants + ' orang';
        grandTotal.textContent = 'Rp ' + formatNumber(total);
        totalAmountInput.value = total;
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    packageSelect.addEventListener('change', updateSummary);
    participantsInput.addEventListener('input', updateSummary);

    updateSummary();
});
</script>
@endpush
@endsection
