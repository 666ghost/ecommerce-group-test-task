<ul class="nested roles_list_ul">
    @foreach($mainRole->child as $role)
        @if($role->child->count())
            <li><span class="caret"></span> <a href="?role_id={{$role->id}}">{{$role->name}}</a>
                @include('role.list', ['mainRole' => $role])
            </li>
        @else
            <li><a href="?role_id={{$role->id}}">{{$role->name}}</a></li>
        @endif
    @endforeach
</ul>
