<div class="card" style="min-height: 100%">
    <div class="card-header">Menu</div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action {{ Request::is('admin/home') ? 'active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/courier') ? 'active' : '' }}" href="{{ route('admin.courier') }}">{{ __('Add Package') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shippings') ? 'active' : '' }}" href="{{ route('admin.shippings') }}">{{ __('All Shippings') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/1') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 1) }}">{{ __('Picked') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/2') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 2) }}">{{ __('Received') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/3') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 3) }}">{{ __('Shipping') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/4') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 4) }}">{{ __('Delayed') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/5') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 5) }}">{{ __('Returned') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/6') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 6) }}">{{ __('Delivered') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/shipping/status/7') ? 'active' : '' }}" href="{{ route('admin.shipping-status', 7) }}">{{ __('Corperate') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/vehicles') ? 'active' : '' }}" href="{{ route('admin.vehicles') }}">{{ __('Vehicle') }}</a>
            <a class="list-group-item list-group-item-action {{ Request::is('admin/user') ? 'active' : '' }}" href="{{ route('admin.user') }}">{{ __('Create User') }}</a>
        </ul>
    </div>
</div>