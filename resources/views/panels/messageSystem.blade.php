@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection


@if (Session::has('msj-success'))
@push('custom-scripts')
<script>
    toastr.success("{{Session::get('msj-success')}}", '¡Notificacion!', { "progressBar": true });
</script>
@endpush
@endif

@if (Session::has('msj-info'))
@push('custom-scripts')
    <script>
        toastr.info("{{Session::get('msj-info')}}", '¡Aviso!', { "progressBar": true });
    </script>
@endpush
@endif

@if (Session::has('msj-warning'))
@push('custom-scripts')
    <script>
        toastr.warning("{{Session::get('msj-warning')}}", '¡Advertencia!', { "progressBar": true });
    </script>
@endpush
@endif

@if (Session::has('msj-danger'))
@push('custom-scripts')
    <script>
        toastr.error("{{Session::get('msj-danger')}}", '¡Error!', { "progressBar": true });
    </script>
@endpush
@endif

{{-- mensajes de errores --}}
@if ($errors->any())
@push('custom-scripts')
<script>
    let msjErrors = '<ul>';
</script>
        @foreach ($errors->all() as $error)
        <script>msjErrors = msjErrors+'<li>{{ $error }}</li>';</script>
        @endforeach
    <script>
        msjErrors = msjErrors+'</ul>';
        toastr.error(msjErrors, '¡Error!', { "progressBar": true });
    </script>
@endpush
@endif

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
@endsection
