@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            <div><i class="fa fa-exclamation-circle"></i>{{$error}}</div>
        @endforeach
    </div>
@endif