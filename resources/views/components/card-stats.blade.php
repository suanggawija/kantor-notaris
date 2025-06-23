<div class="card card-stats card-round">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-icon">
                <div class="text-center icon-big icon-primary bubble-shadow-small">
                    <i class="{{ $icon ?? 'fas fa-users' }}"></i>
                </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                    <p class="card-category">{{ $title ?? 'Name' }}</p>
                    <h4 class="card-title">{{ $value ?? '0' }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
