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
    <div class="col-sm-8">
        <div class="card">
            <div class="header">Customize Watch</div>
            <div class="content">
                <div id="customizeWatch" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner" role="listbox">
                        @foreach($types as $index=>$type)
                            <div class="item {{$index==0 ? 'active' : ''}}">
                                <article>
                                    <div class="title" style="font-size: 26px; font-weight: 600; text-transform: uppercase;">
                                        <a href="/admin/customize/type/{{$type->id}}/edit">
                                            {{$type->name}}
                                        </a>
                                        <span style="font-size: 18px; font-weight: 400; margin-left: 5px">
                                            $ {{$type->price}}
                                        </span>
                                    </div>
                                    <div>{!!$type->description!!}</div>
                                    <div>
                                        <i class="fa fa-{{$type->multipleSize() ? 'check' : 'times' }}"></i> Mutiple Size
                                        <br>
                                        @foreach($personalize as $p)
                                            <i class="fa fa-{{$p->unavailable_for == null ? 'check' : (in_array($type->id, json_decode($p->unavailable_for)) ? 'times' : 'check')}}"></i>
                                            {{$p->title}}
                                            <br>
                                        @endforeach
                                    </div>
                                </article>
                                <br>
                                <div class="title">Components</div>
                                @foreach($steps as $step)
                                    @if(!$step->primary_customize_target && $step->support_personalize == '')
                                    <div class="tittle">
                                        {{$step->title}}
                                        <br>
                                        @foreach($step->option($type->id) as $index=>$component)
                                            <a href="/admin/customize/component/{{$component->id}}/edit">
                                                @if($component->type == 'text')
                                                    {{$component->value}}{{$index!=$step->option($type->id)->count()-1 ? ', ' : ''}}
                                                @elseif($component->type == 'color')
                                                    <div style="width: 20px; height: 20px; display: inline-block; margin-right: 5px; background-color: #{{$component->value}}"></div>
                                                @else
                                                    <img src="{{$component->getImageSrc($component->value)}}" alt="" width="50" style="margin-right: 5px;">
                                                @endif
                                            </a>
                                        @endforeach
                                        <br>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="content" style="width: 100%">
                    <a class="btn btn-default" href="#customizeWatch" role="button" data-slide="prev">
                        <span class="btn-label">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </span>
                        Previous
                    </a>
                    <a class="btn btn-default pull-right" href="#customizeWatch" role="button" data-slide="next">
                        Next
                        <span class="btn-label">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="header">
                Featured Product
                <a href="/admin/customize/create" class="pull-right">New</a>
            </div>
            <div class="content">
                <ul id="lightSlider">
                    <li><img src="/images/Automatic.png" width="75%" style="margin: auto; display: block;"></li>
                    <li><img src="/images/Automatic.png" width="75%" style="margin: auto; display: block;"></li>
                    <li><img src="/images/Automatic.png" width="75%" style="margin: auto; display: block;"></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="header">
                Customize Step
            </div>
            <div class="content">
                <ul style="padding-left: 0; list-style: none;">
                @foreach($steps as $step)
                    <li>
                        <span style="width: 15px; display: inline-block; margin-right: 10px;">
                            {{$step->sequence}}.
                        </span>
                        <input type="text" value="{{$step->title}}" style="border: none" disabled>
                        <span class="pull-right">
                            <a href="" class="">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </span>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/admin/ckeditor/ckeditor.js"></script>
    <script src="/js/admin/dropzone/dropzone.js"></script>
    <script src="/js/admin/dropzone/config.js"></script>
    <script src="/js/admin/konva.js"></script>
    <script src="/js/lightslider.min.js"></script>
    <script type="text/javascript">
    $("#lightSlider").lightSlider({
        item: 1,
        pager: false,
        enableTouch: false,
        enableDrag: false,
        prevHtml: '<i class="fa fa-chevron-left" aria-hidden="true" style="font-size: 36px;"></i>',
        nextHtml: '<i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 36px;"></i>',
    });
    </script>
@endpush
