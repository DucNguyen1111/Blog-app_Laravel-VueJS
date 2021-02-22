@if(Auth::check())
    <h1>hello</h1>
@endif
<h1>hello {{session('user')}}</h1>