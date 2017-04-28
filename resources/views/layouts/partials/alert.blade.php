{{-- <div id="{{ isset($alertID) ? $alertID : '' }}"class="alert alert-{{ isset($alertType) ? $alertType : 'danger' }} {{ isset($alertVisible) ? $alertVisible : ''}}">
    <div class="alert-title">
        <strong>
            {{ isset($alertTitle) ? $alertTitle : 'Testing Title' }}
        </strong>
    </div>{{-- .alert-title
    <ul class="alert-description">
        {!! isset($alertDescription) ? $alertDescription : '' !!}
    </ul>{{-- .alert-description
</div>{{-- .alert  --}}

@if (count($errors) > 0)
    <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif
