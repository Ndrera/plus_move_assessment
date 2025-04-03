<div class="card" style="min-height: 100%">
    <div class="card-header">Menu</div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/home') ? 'active' : '' }}" href="{{ route('warehouse.home') }}">Dashboard</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/1') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 1) }}">{{ __('Picked') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/2') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 2) }}">{{ __('Received') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/3') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 3) }}">{{ __('Shipping') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/4') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 4) }}">{{ __('Delayed') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/5') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 5) }}">{{ __('Returned') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('warehouse/shipping/status/6') ? 'active' : '' }}" href="{{ route('warehouse.shipping-status', 6) }}">{{ __('Delivered') }}</a>  
        </ul>
    </div>
</div>