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
                <form action="/admin/customize/component/{{$component->id}}" method="post">
                    {{csrf_field()}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Step</label>
                            <select name="step_id" class="form-control">
                                @foreach($steps as $step)
                                <option value="{{$step->id}}" {{$step->id == $component->step_id ? 'selected' : ''}}>
                                    {{$step->title}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="name" value="{{$component->value}}">
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <textarea name="ckeditorProductDescription" class="ckeditor form-control">{!!$component->description!!}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/admin/customize/" class="btn btn-default">Cancel</a>
                    </div>
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Front Image</label>
                            <input type="file">
                            <img src="{{$component->front_image ? $component->getImageSrc($component->front_image) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div>
                        <div class="form-group">
                            <label>Back Base</label>
                            <input type="file">
                            <img src="{{$component->back_image ? $component->getImageSrc($component->back_image) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/admin/ckeditor/ckeditor.js"></script>
    <script src="/js/admin/jquery.bootstrap.wizard.js"></script>
    <script src="/js/admin/gsdk-bootstrap-wizard.js"></script>
    <script src="/js/admin/jquery.validate.min.js"></script>
@endpush
