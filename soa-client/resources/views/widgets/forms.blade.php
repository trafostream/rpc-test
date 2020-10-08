<form>
    <input type="hidden" name="page_uid" value="{{ $page_uid }}">
<ul>
@foreach($fields as $filed)
    <li>
        <span>
            <b>
                {{ $filed['name'] }}
            </b>
        </span>
        <input name="{{ $filed['name'] }}" value="{{ $filed['value'] }}"/>
    </li>
@endforeach
</ul>
</form>

