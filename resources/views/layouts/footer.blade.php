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

<!-- start of moreModal -->
<div class="modal" id="moreModal">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">More..</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div id="more-modal-body">

        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- end of moreModal -->

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