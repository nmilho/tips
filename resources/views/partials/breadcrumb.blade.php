<nav>
    <ol class="breadcrumb">
    @foreach(Breadcrumb::getBreadcrumb() as $name => $path)
    
        @if($path == Breadcrumb::getBreadcrumb()->last())
        <li class="active">{{ $name }}</li>
        @else
        <li>
            <a href="/{{ $path }}">{{ $name }}</a>
        @endif
        </li>
    @endforeach
    </ol>
</nav>