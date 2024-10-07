<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@extends('layouts.app')
@section('content')
    <div class="home">
        <div class="card">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
            </div>
        </div>
    </div>
    {!! $dataTable->scripts() !!}
@endsection
{{-- 
    <!-- Book Description -->
                    <div class="col-md-12 mb-3">
                        <x-textarea :name="'description'" :error="'description'" />
                    </div>
--}}
