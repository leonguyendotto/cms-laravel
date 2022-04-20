@extends ('layout.console');

@section ('content')

<section class="w3-padding">
    <form action="/console/login" method ="post" novalidate>

        @csrf 

        <div class="w3-margin-bottom">
            Email Address:
            <input type="email" name="email" id="email" value="{{old('email')}}" required>
            @if ($errors->first('email'))
                <br>
                <span class="w3-text-red">{{$errors->first('email')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom">
            Password:
            <input type="password" name="password" id="password" required>
            @if ($errors->first('password'))
                <br>
                <span class="w3-text-red">{{$errors->first('password')}}</span>
            @endif
        </div>

        <button type="submit">Login</button>
    </form>
</section>

@endsection