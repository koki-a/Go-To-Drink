@if ($errors->any())
        <div class="errors_inner inner">
            <ul class="errors">
                @foreach($errors->all() as $error)
                <li class="error_msg">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif