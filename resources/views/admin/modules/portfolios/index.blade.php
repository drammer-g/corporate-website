@extends('admin.layouts.master')

@section('pagenav', 'Портфолио')

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
                        Создать новое портфолио
                    </a>
                </div>
            </div>
        </div>

        <table class="table custom-table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Клиент</th>
                <th>Описание</th>
                <th>Контент</th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            @foreach ($portfolio as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->client }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        @include('admin.partials.buttons._redirect_link', [
                            'url'   => route('admin.portfolios.images.index', ['portfolio' => $item]),
                            'title' => 'Перейти к изображениям'
                        ])
                    </td>
                    <td>
                        @include('admin.partials.buttons._edit_link', [
                            'url' => route('admin.portfolios.edit', ['portfolio' => $item])])
                        @include('admin.partials._destroy', [
                            'url' => route('admin.portfolios.destroy', ['portfolio' => $item])])
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@stop