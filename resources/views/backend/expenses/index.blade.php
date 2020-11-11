@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.expenses.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.expenses.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.expenses.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.expenses.partials.expenses-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="expenses-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.expenses.table.id') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.who_pay') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.amount') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.pay_date') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.building_id') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.buildings_details_id') }}</th>
                            <th>{{ trans('labels.backend.expenses.table.expense_type_id') }}</th>	
                            <th>{{ trans('labels.backend.expenses.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        //Below written line is short form of writing $(document).ready(function() { })
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var dataTable = $('#expenses-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.expenses.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.expenses.table')}}.id'},
                    {data: 'who_pay', name: '{{config('module.expenses.table')}}.who_pay'},
                    {data: 'amount', name: '{{config('module.expenses.table')}}.amount'},
                    {data: 'pay_date', name: '{{config('module.expenses.table')}}.pay_date'},
                    {data: 'building_id', name: '{{config('module.expenses.table')}}.building_id'},
                    {data: 'buildings_details_id', name: '{{config('module.expenses.table')}}.buildings_details_id'},
                    {data: 'expense_type_id', name: '{{config('module.expenses.table')}}.expense_type_id'},
                    {data: 'created_at', name: '{{config('module.expenses.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection