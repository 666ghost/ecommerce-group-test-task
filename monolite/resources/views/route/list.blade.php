<ul>
    @foreach($mainRoute->child as $route)
        @can('view-route-in-tree', $route)
            <li><a href="{{$prefix}}/{{$route->uri}}">{{$route->name}}</a></li>
            @if($route->child->count())
                @include('route.list', ['mainRoute' => $route, 'prefix' => "{$prefix}/{$route->uri}"])
            @endif
        @endcan
    @endforeach
</ul>
