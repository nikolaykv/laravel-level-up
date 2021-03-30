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

                        <div class="groups">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#groups">Учебные группы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#subjects">Учебные предметы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#students">Студенты</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#service_tab">&nbsp;</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="groups">
                                    @include('admin.tables.list')
                                </div>
                                <div class="tab-pane fade" id="subjects">Предметы</div>
                                <div class="tab-pane fade" id="students">Студенты</div>

                                <div class="tab-pane fade" id="service_tab">
                                    @include('admin.tables.detail')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('javascript')
    <script>
        let emptyResult =
            '<div class="alert alert-info" role="alert">' +
            'Нет результатов!' +
            '</div>';

        // Сначала скрыть служебную вкладку
        $('.nav-item').last().hide();

        // Программное переключение табов
        $('.nav-item a').click(function (event) {
            event.preventDefault();
            $(this).tab('show');

            // Если активна не служебная вкладка, то скрыть её
            if (event.target.getAttribute('href') != '#service_tab') {
                $('.nav-item').last().hide();
            }
        });

        // Список
        $.getJSON('/api/groups', function (data) {
            if (data) {
                $.each(data.groups, function () {
                    $('.table-bordered.list > tbody').append(
                        '<tr>' +
                        '<td>' + this.id + '</td>' +
                        '<td>' + this.name + '</td>' +
                        '<td>' + this.created_at + '</td>' +
                        '<td>' + this.updated_at + '</td>' +
                        '<td class="d-xl-flex justify-content-xl-around">' +
                        '<i class="far fa-edit bg-primary text-white btn d-flex align-items-center"></i>' +
                        '<i class="far fa-eye bg-success text-white btn d-flex align-items-center" ' +
                        'data-id="' + this.id + '"></i>' +
                        '<i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>' +
                        '</td>' +
                        '</tr>'
                    );
                });

                // Детальный просмотр
                $('.fa-eye').click(function (event) {
                    // Показать служебную вкладку
                    $('.nav-item').last().show();
                    // Переключить программно таб служебной вкладки
                    $('.nav-item a[href="#service_tab"]').tab('show');

                    $.ajax({
                        url: '/api/groups/' + event.target.getAttribute('data-id'),
                        method: 'get',
                        dataType: 'json',
                        success: function (data) {

                            $('.nav-link').last().text(data.group.name);

                            $('.table-bordered.detail > tbody').html(
                                '<tr>' +
                                '<td>' + data.group.id + '</td>' +
                                '<td>' + data.group.name + '</td>' +
                                '<td>' + data.group.created_at + '</td>' +
                                '<td>' + data.group.updated_at + '</td>' +
                                '<td class="d-xl-flex justify-content-xl-around">' +
                                '<i class="far fa-trash-alt bg-danger text-white btn d-flex align-items-center"></i>' +
                                '</td>' +
                                '</tr>'
                            );
                        }
                    });
                });
            } else {
                $('.groups').html(emptyResult);
            }
        });
    </script>
@endpush
