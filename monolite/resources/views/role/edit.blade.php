<form action="{{route("role.edit")}}" method="POST">
    <label>Name</label>
    <input type="hidden" name="id" value="{{$editRole->id}}">
    <input type="text" name="name" value="{{$editRole->name}}" required>
    <label>Parent role</label>
    <select name="parent_id">
        <option value="">_</option>
        @foreach($roles as $role)
            <option value="{{$role->id}}" @if($role->id === $editRole->id) disabled
                    @endif  @if($role->id === $editRole->parent_id) selected @endif>{{$role->name}}</option>
        @endforeach
    </select><br><br>
    @csrf
    <button type="submit">Save changes</button>
</form>
