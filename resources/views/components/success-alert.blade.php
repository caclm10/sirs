@if (session()->has('success'))
    <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
        <span class='iconify flex-shrink-0 me-2' data-icon="bi:check-circle-fill" style="width:20px; height:20px;"></span>
        <div>
            {{ session('success') }}
        </div>
    </div>
@endif
