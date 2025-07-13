@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Date Widget -->
    <div class="d-flex justify-content-end mb-4">
        <div class="date-widget">
            <strong>Date</strong>
            <span class="flag"></span>
            <br>
            <small class="text-muted">{{ $current_date }}</small>
        </div>
    </div>

    <!-- Module Cards -->
    <div class="row g-4">
        @foreach($modules as $module)
        <div class="col-lg-4 col-md-6">
            <div class="module-card" onclick="window.location.href='{{ route($module['route']) }}'">
                <div class="icon {{ $module['color'] }}">
                    <i class="{{ $module['icon'] }}"></i>
                </div>
                <h5>{{ $module['title'] }}</h5>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add click animation
    document.querySelectorAll('.module-card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
</script>
@endpush