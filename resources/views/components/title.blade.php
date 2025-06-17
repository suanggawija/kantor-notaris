<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">{{ $title ?? 'Name' }}</h3>
        <h6 class="op-7 mb-2">{{ $desc ?? 'Desc' }}</h6>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
        <a href={{ $href ?? '#' }} class="btn btn-primary btn-round">{{ $button_title ?? '' }}</a>
    </div>
</div>
