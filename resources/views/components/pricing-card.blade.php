<div class="container">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('pricelists.index')}}">@yield('all')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pricelists.index', ['cat' => 1])}}">@yield('item_one')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pricelists.index', ['cat' => 2])}}">@yield('item_two')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pricelists.index', ['cat' => 3])}}">@yield('item_three')</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">@yield('title')</h5>
            <p class="card-text">@yield('table')</p>
        </div>
    </div>
</div>