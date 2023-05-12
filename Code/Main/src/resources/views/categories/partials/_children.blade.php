<ul>
    @foreach($children as $child)
        <li>
            <strong> <a rel="noopener noreferrer" href="#">{{ $child->name }}</a> </strong>
        </li>
    @endforeach
</ul>
