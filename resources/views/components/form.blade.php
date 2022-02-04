<div class="section-body positive">
    @include('admin.partials.loading')
    <div class="card">
        <div class="card-header">
            {{ $header}}
        </div>
        
        <div class="card-body">
        {{ $slot }}
        </div>
    </div>
</div>