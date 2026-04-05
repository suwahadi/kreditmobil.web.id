@extends('layouts.app')

@section('title', $car->name . ' - Daftar Harga Mobil Daihatsu')

@section('content')
<div>
    <livewire:car-detail :car="$car" />
</div>
@endsection
