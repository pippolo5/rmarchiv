@extends('layouts.app')
@section('pagetitle', trans('developer.show.title').': '. \App\Models\Developer::whereId($id)->first()->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Entwicklerprofil: {{ \App\Models\Developer::whereId($id)->first()->name }}</h1>
                {!! Breadcrumbs::render('developer', \App\Models\Developer::whereId($id)->first()) !!}
            </div>
        </div>
        <div class="row">
            @include('_partials.tables.game_table', [
                'games' => $games,
                'orderby' => $orderby,
                'direction' => $direction,
            ])
        </div>
    </div>
@endsection