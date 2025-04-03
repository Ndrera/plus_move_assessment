<div class="card" style="min-height: 100%">
    <div class="card-header">Menu</div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action {{ Request::is('driver/home') ? 'active' : '' }}" href="{{ route('driver.home') }}">Dashboard</a>
            <a class="list-group-item list-group-item-action {{ Request::is('driver/courier') ? 'active' : '' }}" href="{{ route('driver.courier') }}">{{ __('Add Package') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('driver/shipping/status/1') ? 'active' : '' }}" href="{{ route('driver.shipping-status', 1) }}">{{ __('Picked') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('driver/shipping/status/7') ? 'active' : '' }}" href="{{ route('driver.shipping-status', 7) }}">{{ __('Corperate') }}</a>
        </ul>
    </div>
</div>