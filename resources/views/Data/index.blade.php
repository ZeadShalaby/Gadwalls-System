<link rel="stylesheet" href="{{ asset('css/index.css') }}">


@extends('layouts.app') @section('content')
    <div class="home">
        <div class="card">
            <div class="card-body">
                <!-- عرض الجدول -->
                {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
            </div>
        </div>
    </div>
    <!-- عرض سكريبت DataTable -->
    {!! $dataTable->scripts() !!}
    {{-- 
    <!-- Book Description -->
                    <div class="col-md-12 mb-3">
                        <x-textarea :name="'description'" :error="'description'" />
                    </div>
--}}

    {{-- <script>
        $(document).ready(function() {

            Lar table = $('#datatable').DataTable({

                'processing': true,
                'serverSide': true,
                'ajax': "{{ route('user.table') }}",
                'columns': [

                    {
                        'data': 'first_name'
                    },

                    {
                        'data': 'first_name'
                    },

                    {
                        'data': 'first_name'
                    },
                ],
            });

            $('.filter-input').keyup(function() {
                table.column($(this).data('column')).search($(this).val()).draw();
            });

            $('.filter-select').change(function() {
                table.column($(this).data('column')).search($(this).val()).draw();
            });

        })
    </script> --}}
@endsection
