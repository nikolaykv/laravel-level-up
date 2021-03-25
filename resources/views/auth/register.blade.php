@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('common.register') }}</div>

                    <div class="card-body">
                        @if(count($groups) > 0)
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{-- Имя --}}
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('common.other.name') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="name"
                                               type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}"
                                               required
                                               autocomplete="name"
                                               autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Фамилия --}}
                                <div class="form-group row">
                                    <label for="surname"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('common.other.surname') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="surname"
                                               type="text"
                                               class="form-control @error('surname') is-invalid @enderror"
                                               name="surname" value="{{ old('surname') }}"
                                               required
                                               autocomplete="surname"
                                               autofocus>

                                        @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Группа --}}
                                <div class="form-group row">
                                    <label for="group"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('common.other.group') }}
                                    </label>

                                    <div class="col-md-6">
                                        <select class="form-control @error('group_id') is-invalid @enderror" id="group"
                                                name="group_id" required>
                                            <option disabled selected>Выберите группу</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">
                                                    {{$group->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('group_id')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                {{-- E-mail --}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{ __('E-Mail') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="email"
                                               type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}"
                                               required
                                               autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('common.password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password"
                                               type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               required
                                               autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Confirm password --}}
                                <div class="form-group row">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-right">
                                        {{ __('common.confirm_password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password-confirm"
                                               type="password"
                                               class="form-control"
                                               name="password_confirmation"
                                               required
                                               autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('common.register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p>
                                В системе не заведено ни одной учебной группы. Регистрация новых пользователей не
                                возможна! Выполните:
                            </p>
                            <pre class="text-success">php artisan db:seed</pre>
                            <p>
                                А также заведите нового админа, используя консольную команду:
                            </p>
                            <pre class="text-success">php artisan admin:create</pre>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
