@php
    $scores = [1, 4, 2, 8, 6, 5, 9, 3, 10];
    // $scores = [];
    $title = "<h1>Scoreboard</h1>"
@endphp

{!! $title !!}

<style>
    table, td, th {
        border: 1px solid coral;
    }
    .bgc {
        background-color: gray;
        border-color: gray;
    }
</style>

<table>
    <tr>
        <th>STT</th>
        <th>Score</th>
        <th>Result</th>
    </tr>
    @forelse ($scores as $score)
        <tr class="{{ $loop->odd ? 'bgc' : '' }}">
            <td>{{  $loop->iteration  }}</td>
            <td>{{  $score  }}</td>
            <td>{{ $score >= 6 ? 'passed' : 'failed' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">No data</td>
        </tr>
    @endforelse
</table>

@extends('layout.master')
@section('content')
    <div>Content</div>
@endsection
@section('side-bar')
    @parent
    <h3>Score Side bar</h3>
@endsection