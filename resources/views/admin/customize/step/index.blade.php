@extends('layouts.admin')

@section('product-nav')
    active
@endsection

@section('product-dropdown-status')
    in
@endsection

@section('customize-dropdown-nav')
    active
@endsection

@section('content')
    <div class="col-xs-12">
        <div class="card">
            <div class="content">
                @if($steps->count() > 0)
                <table class="mdl-data-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Fix component</th>
                            <th>Allow blank</th>
                            <th>Personalize</th>
                            <th>Unavailable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($steps as $step)
                        <tr>
                            <td>{{$step->sequence}}</td>
                            <td>{{$step->title}}</td>
                            <td><i class="fa {{$step->fixed_component ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td>{{$step->allow_blank}}</td>
                            <td>{{$step->unavailable_for}}</td>
                            <td>{{$step->target_direction}}</td>
                            <td>{{$step->support_personalize}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    Empty message
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/admin/ckeditor/ckeditor.js"></script>
    <script src="/js/admin/dropzone/dropzone.js"></script>
    <script src="/js/admin/dropzone/config.js"></script>
    <script src="/js/admin/konva.js"></script>
@endpush
