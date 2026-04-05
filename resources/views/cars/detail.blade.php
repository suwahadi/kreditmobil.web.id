@extends('layouts.app')

@section('title', $car->name . ' - ' . env('APP_NAME'))

@section('content')
<div>
    <livewire:car-detail :car="$car" />
</div>
@endsection
