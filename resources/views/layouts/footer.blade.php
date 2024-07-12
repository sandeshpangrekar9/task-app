<!-- Footer -->
<div class="navbar navbar-sm navbar-footer border-top">
    <div class="container-fluid">
        <span>&copy; 2024 Task App</span>

        <ul class="nav">
            <li class="nav-item">
                &nbsp;
            </li>
        </ul>
    </div>
</div>
<!-- /footer -->

@push('js_post_content')

<script>
    @if(session('success'))
        notify("{{ session('success') }}", 'success');
    @endif

    @if(session('error'))
        notify("{{ session('error') }}", 'error');
    @endif

    @if(session('warning'))
        notify("{{ session('warning') }}", 'warning');
    @endif

    @if(session('info'))
        notify("{{ session('info') }}", 'info');
    @endif

    @if(session('alert'))
        notify("{{ session('alert') }}", 'alert');
    @endif
</script>

@endpush