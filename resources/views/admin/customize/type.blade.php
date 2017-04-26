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
                <form action="/admin/customize/type/{{$type->id}}" method="post">
                    {{csrf_field()}}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{$type->name}}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" value="{{$type->price}}">
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <textarea name="ckeditorProductDescription" class="ckeditor form-control">{!!$type->description!!}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/admin/customize/" class="btn btn-default">Cancel</a>
                    </div>
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Front Base</label>
                            <input type="file">
                            <img src="{{$type->front_image ? $type->component->first()->getImageSrc($type->front_image) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div>
                        <div class="form-group">
                            <label>Back Base</label>
                            <input type="file">
                            <img src="{{$type->back_image ? $type->component->first()->getImageSrc($type->back_image) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div>
                        {{-- <div class="form-group">
                            <label>Front Personalize</label>
                            <input type="file">
                            <img src="{{$type->front_personalize ? $type->component->first()->getImageSrc($type->front_personalize) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div>
                        <div class="form-group">
                            <label>Back Personalize</label>
                            <input type="file">
                            <img src="{{$type->back_personalize ? $type->component->first()->getImageSrc($type->back_personalize) : '/images/image_placeholder.png'}}" width="150" style="margin-top: 15px;">
                        </div> --}}
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
