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
    @if($customizeTypes->count() >= 1)
        <div class="col-md-6">
            <div id="customize-canvas"></div>
        </div>{{-- col-md-6 --}}
        <div class="col-md-6">
            <div id="customize-wrapper">
                <input type="hidden" name="stage_width" value="" data-width="{{isset($product) ? $components['stage_width'] : ''}}">
                <input type="hidden" name="stage_height" value="" data-height="{{isset($product) ? $components['stage_height'] : ''}}">
                <button id="saveCustomizeBtn">Save customize</button>

                {{-- loop customize step --}}
                @foreach($customizeSteps as $stepIndex=>$step)
                    <div class="customize-step-wrapper"
                         step-id="{{$step->id}}"
                         unavailable="{{$step->unavailable_for}}"
                         direction="{{$step->target_direction}}"
                         personalize="{{$step->support_personalize}}"
                         layer="{{$step->layer}}"
                         fixed="{{$step->fixed_component}}"
                         primary={{$step->primary_customize_target}}>
                        <p>Step {{$stepIndex+1}}: {{$step->title}}</p>

                        {{-- primary customize target (loop customize type from database) --}}
                        @if($step->primary_customize_target)
                            @foreach($customizeTypes as $customizeIndex=>$customize)
                                <div class="form-group">
                                    <input type="radio"
                                           name="customize_type"
                                           value="{{$customize->id}}"
                                           description="{{$customize->description}}"
                                           description-wrapper="customize-description"
                                           target-element="customize-{{$customize->id}}"
                                           f-image="{{$customize->front_image ? $customize->component->first()->getImageSrc($customize->front_image) : ''}}"
                                           b-image="{{$customize->back_image ? $customize->component->first()->getImageSrc($customize->back_image) : ''}}"
                                           front-personalize="{{$customize->front_personalize ? $customize->component->first()->getImageSrc($customize->front_personalize) : ''}}"
                                           back-personalize="{{$customize->back_personalize ? $customize->component->first()->getImageSrc($customize->back_personalize) : ''}}"
                                           {{ isset($product) ? ( $product->type == $customize->id ? 'checked' : '') : ($customizeIndex==0 ? 'checked' : '') }}>
                                    <label>{{$customize->name}}</label>
                                </div>{{-- .form-group --}}
                            @endforeach
                            <div class="customize-description">
                                {!! $customizeTypes[0]->description !!}
                            </div>{{-- .customize-description --}}
                        {{-- personalize steps --}}
                        @elseif($step->support_personalize != null)
                            {{-- radio button --}}
                            @if($step->support_personalize == 'both')
                                <div class="form-group">
                                    <input type="radio" name="step_{{$step->id}}" target-element="personalize-text" checked>
                                    <label>text</label>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="step_{{$step->id}}" target-element="personalize-image" >
                                    <label>image</label>
                                </div>
                            @endif

                            @if($step->support_personalize == 'both' || $step->support_personalize == 'text')
                                <div class="form-group personalize-element personalize-text {{$step->support_per}}">
                                    <lable>Key in the text (up to  12 letter)</lable>
                                    <input type="text" name="personalize-text" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['text']['value'] : '') : ''}}">
                                    <input type="hidden" name="text-position-x" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['text']['x'] : '') : ''}}">
                                    <input type="hidden" name="text-position-y" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['text']['y'] : '') : ''}}">
                                </div>
                            @endif
                            @if($step->support_personalize == 'both' || $step->support_personalize == 'image')
                                <div class="form-group personalize-element personalize-image {{$step->support_personalize == 'both' ? 'hidden' : ''}}">
                                    <lable>Only Png or svg file are accepted</lable>
                                    <input type="file" name="personalize-image">
                                    <input type="hidden" name="image-id" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['id'] : '') : ''}}">
                                    <input type="hidden" name="image-src" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['src'] : '') : ''}}">
                                    <input type="hidden" name="image-position-x" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['x'] : '') : ''}}">
                                    <input type="hidden" name="image-position-y" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['y'] : '') : ''}}">
                                    <input type="hidden" name="image-width" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['width'] : '') : ''}}">
                                    <input type="hidden" name="image-height" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['height'] : '') : ''}}">
                                    <input type="hidden" name="image-rotation" value="{{isset($product) ? (isset($components[$step->id]) ? $components[$step->id]['image']['rotation'] : '') : ''}}">
                                </div>
                            @endif
                        @elseif($step->fixed_component)
                            <div class="main-customize-option">
                                @foreach($step->option() as $componentIndex=>$component)
                                    <div class="form-group">
                                        <input type="radio" name="step_{{$step->id}}"
                                               value="{{$component->id}}"
                                               f-image="{{$component->front_image ? $component->getImageSrc($component->front_image) : ''}}"
                                               b-image="{{$component->back_image ? $component->getImageSrc($component->back_image) : ''}}"
                                               description="{{$component->description}}"
                                               description-wrapper="main-description"
                                               target-element="component-{{$component->id}}"
                                               extral-option="{{$component->option->count() > 0 ? 1 : 0}}"
                                               size-triggle="{{$component->size_triggle}}"
                                               {{ isset($product) ? ($components[$step->id]['main'] == $component->id ? 'checked' : '') : ($componentIndex==0 ? "checked" : "")}}>
                                        <label class="customize-{{$component->type}}-option">
                                            @if($component->type == 'text')
                                                {{ $component->value }}
                                            @elseif($component->type == 'image')
                                                <img src="{{$component->getImageSrc($component->value)}}" alt="" width="20">
                                            @elseif($component->type == 'color')
                                                <div style="width: 20px; height: 20px; background-color: {{$component->value}}"></div>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                                @if($step->allow_blank)
                                    <div class="form-group">
                                        <input type="radio"
                                               name="step_{{$step->id}}"
                                               value="0"
                                               description=""
                                               {{ isset($product) ? ($components[$step->id]['main'] == 0 ? 'checked' : '') :  ""}}>
                                        <label class="customize-text-option">Blank</label>
                                    </div>
                                @endif
                            </div>{{-- .main-customize-option --}}
                            @if($step->extralOption()->count() > 0)
                                <div class="extral-customize-option">
                                    @foreach($step->extralOption() as $componentID=>$array )

                                        <div class="component-element
                                                    component-{{$componentID}}
                                                    {{isset($product) ? ($components[$step->id]['main'] == $componentID ? '' : 'hidden') : ($step->option()->first()->id == $componentID ? '' : 'hidden')}}">
                                            @foreach($array as $extralIndex=>$extralOption)
                                                <div class="form-group">
                                                    <input type="radio"
                                                           class="extral-radio"
                                                           name="step_{{$step->id}}_extral"
                                                           value="{{$extralOption->id}}"
                                                           f-image="{{$extralOption->front_image ? $extralOption->component->getImageSrc($extralOption->front_image) : ''}}"
                                                           b-image="{{$extralOption->back_image ? $extralOption->component->getImageSrc($extralOption->back_image) : ''}}"
                                                           description="{{$extralOption->description}}"
                                                           description-wrapper="extral-description"
                                                           {{ isset($product) ? ($components[$step->id]['extral'] == $extralOption->id ? 'checked' : '') : ($step->option()->first()->id == $componentID && $extralIndex == 0 ? "checked" : "")}}>
                                                    <label class="customize-{{$extralOption->type}}-option">
                                                        @if($extralOption->type == 'text')
                                                            {{ $extralOption->value }}
                                                        @elseif($extralOption->type == 'image')
                                                            <img src="{{$extralOption->component->getImageSrc($extralOption->value)}}" alt="" width="20">
                                                        @elseif($extralOption->type == 'color')
                                                            <div style="width: 20px; height: 20px; background-color: {{$extralOption->value}}"></div>
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- .component-element .component-element-{ID} --}}

                                    @endforeach
                                </div>{{-- .extral-customize-optioin --}}
                            @endif
                            <div class="customize-description">
                                <span class="main-description">
                                    {!! $step->option()->first()->description !!}
                                </span>
                                @if($step->extralOption()->count() > 0)
                                <span class="extral-description">
                                    {!! $step->extralOption()->first()->toArray()[0]['description'] !!}
                                </span>
                                @endif
                            </div>
                            {{-- customize-description --}}
                        @else
                            @foreach($customizeTypes as $customizeIndex=>$customize)
                                <div class="customize-element customize-{{$customize->id}} {{$customizeIndex!=0 ? 'hidden' : ''}}">
                                    <div class="main-customize-option">
                                        @foreach($step->option($customize->id) as $componentIndex=>$component)
                                            <div class="form-group">
                                                <input type="radio"
                                                       name="customize_{{$customize->id}}_step_{{$step->id}}"
                                                       value="{{$component->id}}"
                                                       f-image="{{$component->front_image ? $component->getImageSrc($component->front_image) : ''}}"
                                                       b-image="{{$component->back_image ? $component->getImageSrc($component->back_image) : ''}}"
                                                       description="{{$component->description}}"
                                                       description-wrapper="main-description"
                                                       target-element="component-{{$component->id}}"
                                                       extral-option="{{$component->option->count() > 0 ? 1 : 0}}"
                                                       size-triggle="{{$component->size_triggle}}"
                                                       {{ isset($product) ? ($components[$step->id]['main'] == $component->id ? 'checked' : '') : ($componentIndex==0 ? "checked" : "")}}>
                                                <label class="customize-{{$component->type}}-option">
                                                    @if($component->type == 'text')
                                                        {{ $component->value }}
                                                    @elseif($component->type == 'image')
                                                        <img src="{{$component->getImageSrc($component->value)}}" alt="" width="20">
                                                    @elseif($component->type == 'color')
                                                        <div style="width: 20px; height: 20px; background-color: {{$component->value}}"></div>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                        @if($step->allow_blank)
                                            <div class="form-group">
                                                <input type="radio"
                                                       name="customize_{{$customize->id}}_step_{{$step->id}}"
                                                       value="0"
                                                       description=""
                                                       {{ isset($product) ? ($components[$step->id]['main'] == 0 ? 'checked' : '') :  ""}}>
                                                <label class="customize-text-option">
                                                    Blank
                                                </label>
                                            </div>
                                        @endif
                                    </div>{{-- .main-customize-option --}}

                                    @if($step->extralOption($customize->id)->count() > 0)
                                        <div class="extral-customize-option">
                                            @foreach($step->extralOption($customize->id) as $componentID=>$array )

                                                <div class="component-element
                                                            component-{{$componentID}}
                                                            {{isset($product) ? ($components[$step->id]['main'] == $componentID ? '' : 'hidden') : ($step->option($customize->id)->first()->id == $componentID ? ($customizeIndex != 0 ? 'hidden' : '') : 'hidden')}}">
                                                    @foreach($array as $extralIndex=>$extralOption)
                                                        <div class="form-group">
                                                            <input type="radio"
                                                                   name="custoomize_{{$customize->id}}_step_{{$step->id}}_extral"
                                                                   value="{{$extralOption->id}}"
                                                                   f-image="{{$extralOption->front_image ? $extralOption->component->getImageSrc($extralOption->front_image) : ''}}"
                                                                   b-image="{{$extralOption->back_image ? $extralOption->component->getImageSrc($extralOption->back_image) : ''}}"
                                                                   description="{{$extralOption->description}}"
                                                                   description-wrapper="extral-description"
                                                                   {{ isset($product) ? ($components[$step->id]['extral'] == $extralOption->id ? 'checked' : '') : ($step->option()->first()->id == $componentID && $extralIndex == 0 ? "checked" : "")}}>
                                                            <label class="customize-{{$extralOption->type}}-option">
                                                                @if($extralOption->type == 'text')
                                                                    {{ $extralOption->value }}
                                                                @elseif($extralOption->type == 'image')
                                                                    <img src="{{$extralOption->component->getImageSrc($extralOption->value)}}" alt="" width="20">
                                                                @elseif($extralOption->type == 'color')
                                                                    <div style="width: 20px; height: 20px; background-color: {{$extralOption->value}}"></div>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>{{-- .component-element .component-{id} --}}

                                            @endforeach
                                        </div>{{-- .extral-customize-option --}}
                                    @endif
                                </div>{{-- .cusotmize-element .customize-{ID} --}}
                            @endforeach
                            <div class="customize-description">
                                <span class="main-description">
                                    {!! $step->option($customizeTypes->first()->id)->first()->description !!}
                                </span>
                                @if($step->extralOption()->count() > 0)
                                <span class="extral-description">
                                    {!! $step->extralOption($customizeTypes->first()->id)->first()->toArray()[0]['description'] !!}
                                </span>
                                @endif
                            </div>{{-- .customize-description --}}
                        @endif
                    </div>{{-- .customize-step-wrapper --}}
                @endforeach
            </div>{{-- .customize-wrapper  --}}
        </div>{{-- .col-md-6 --}}
    @else
        zero customize type
    @endif
@endsection

@push('scripts')
    <script src="/js/admin/ckeditor/ckeditor.js"></script>
    <script src="/js/admin/dropzone/dropzone.js"></script>
    <script src="/js/admin/dropzone/config.js"></script>
    <script src="/js/admin/konva.js"></script>
@endpush
