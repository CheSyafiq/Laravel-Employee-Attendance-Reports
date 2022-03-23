<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route("admin.listing.index") }}" class="nav-link {{ request()->is('admin/listing') || request()->is('admin/listing/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-briefcase nav-icon">

                    </i>
                    Listing
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

@section('scripts')
@parent
<script>
function switchWorkStatus(data) {
    let $timer = $("#timer span");
    let text = $timer.text() == 'Stop work' ? 'Start work' : 'Stop work';
    $timer.text(text);

    Swal.fire({
        title: 'Success!',
        text: data.status,
        icon: 'success'
    })
}

$(function() {
    $.get("{{ route('admin.time-entries.showCurrent') }}", function (data) {
        if(data.timeEntry != null) {
            switchWorkStatus();
        }
    });

    $('#timer').click(function () {
        $.ajax({
            method: "POST",
            url: "{{ route('admin.time-entries.updateCurrent') }}",
            data: {
                _token
            },
            success: (data) => switchWorkStatus(data),
            error: () => window.location.reload()
        });
    });
});
</script>
@endsection
