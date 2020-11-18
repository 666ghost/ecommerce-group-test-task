<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">

    <title>{{$route->name}}</title>
</head>
<body>
<form action="{{route("role.set")}}" method="POST">
    <select name="id">
        @foreach($roles as $role)
            <option value="{{$role->id}}" @if($role->id === $currentRole->id) selected @endif>{{$role->name}}</option>
        @endforeach
    </select>
    @csrf
    <button type="submit">Set Role</button>
</form>
<h1>Current page is: {{$route->name}}</h1>
<h2>Links</h2>
<ul>
    @foreach($mainRoutes as $mainRoute)
        @can('view-route-in-tree', $mainRoute)
            <li><a href="/{{$mainRoute->uri}}">{{$mainRoute->name}}</a></li>
            @include('route.list', ['mainRoute' => $mainRoute, 'prefix' => "$mainRoute->uri"])
        @endcan
    @endforeach
</ul>
<h2>Roles</h2>
<ul id="rolesList" class="roles_list_ul">
    @foreach($mainRoles as $mainRole)
        @if($mainRole->child->count())
            <li><span class="caret"></span> <a href="?role_id={{$mainRole->id}}">{{$mainRole->name}}</a>
                @include('role.list', ['mainRole' => $mainRole])
            </li>
        @else
            <li><a href="?role_id={{$mainRole->id}}">{{$mainRole->name}}</a></li>
        @endif
    @endforeach
</ul>
<br><br>
@if($editRole)
    @include("role.edit")
@endif
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
