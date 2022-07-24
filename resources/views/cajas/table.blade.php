@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).on('click', '.abrirCaja', function (e) {
            e.preventDefault();
            alert('{!! auth()->user()->id !!}');
            return false;
            $('#helperId').val($(this).parents().eq(3).data('id'));
            if ($(this).parents().eq(2).data('id') > 0) {
                $('#helperId').val($(this).parents().eq(2).data('id'));
            }
            $('#txtDeudaConcepto').val('');
            $('#txtDeudaImporte').val('');
            $('#modalDeuda').modal('show');
        });
    </script>
@endsection
