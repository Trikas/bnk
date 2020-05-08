@if(!empty(session($key))){{session($key)}}@else{{old($key) ? old($key) : ''}}@endif
