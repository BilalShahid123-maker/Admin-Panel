@extends('layouts.master')

@section('title')
Dashboard
@endsection


@section('content')

<div class="container mt-4">
    <h1 class="display-4">Add Service</h1>
    <form action="{{ route('service.create') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="serviceName" class="form-label h4"  style="color:orange;">Service Name</label>
            <input type="text" class="form-control form-control-lg" id="serviceName" name="serviceName" required 
       style="width: 400px; height: 40px; border: 1px solid orange; padding: 10px; font-size: 16px;"
       placeholder="Service Name">
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
    </form>
</div>

@endsection


@section('scripts')

@endsection