@extends('layouts.admin')

@section('page-direction')
    {{-- <li>
        <i class="pe-7s-box2"></i> CMS
    </li> --}}
    Dashboard
@endsection

@section('dashboard-sidebar')
    active
@endsection

@section('content')
    <div class="col-sm-4">
        <div class="card">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/lightslider.min.js"></script>
@endpush
