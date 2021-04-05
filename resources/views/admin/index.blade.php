@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="card">
                    <div class="card-header">{{ __('common.admin.card') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="font-weight-bold mt-xl-2">
                            {{ __('common.admin.you_are_logged') }}
                        </p>

                        <div id="tabs">
                            <tabs></tabs>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vue-components')
    <script src="{{ asset('js/tabs.js') }}"></script>
@endpush

