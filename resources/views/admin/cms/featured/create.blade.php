@extends('layouts.admin')

@section('page-direction')
    {{-- <li>
        <i class="pe-7s-box2"></i> CMS
    </li> --}}
    CMS / Featured Product / product
@endsection

@section('cms-sidebar')
    active
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Product info</h4>
            </div>
            <div class="content">
                <div class="title">Product Info</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/lightslider.min.js"></script>
@endpush
