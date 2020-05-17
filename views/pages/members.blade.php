@extends('layouts.app')
@section('members')
@if ($member->role === 'admin')
<body>
    <div class="table-responsive table-bordered text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Permission</th>
                    <th>Action</th>
                    <th>Admin Tab</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-secondary">
                    {{-- get all users from db --}}
                    <td>{username}</td>
                    <td>{permission}</td>
                    <td>
                        <form method="GET" target="_self">
                            <select name="action">
                                <option value="">Akce...</option>
                                <option value="update">Upravit</option>
                                <option value="delete">Odstranit</option>
                              </select>
                              <select name="story">
                                <option value="">Příběh...</option>
                                <option value="1">Allwin </option>
                                <option value="2">Samuel </option>
                                <option value="3">Isama </option>
                                <option value="4">Isama - NH </option>
                                <option value="5">Angel & Eklips </option>
                                <option value="6">Mr. Y </option>
                                <option value="7">White Star </option>
                                <option value="8">Hyperion </option>
                                <option value="9">Lord Teror </option>
                                <option value="10">Démoni </option>
                              </select>
                              <input type="submit" value="Zvolit">
                        </form>    
                    <td>
                        <form method="post">
                            <button class="btn btn-primary btn-sm" type="submit" style="margin-right: 2px;">Button</button>
                            <button class="btn btn-primary btn-sm" type="submit" style="margin-right: 2px;">Button</button>
                            <button class="btn btn-primary btn-sm" type="submit">Button</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
@else
<body>
    <div class="table-responsive table-bordered text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Permission</th>
                    <th>Soukromí</th>
                </tr>
            </thead>
            <tbody>
                {{-- If status is not public dont provide link to profile & hide user info inside profile --}}
                <tr class="table-secondary">
                    <td>{username}</td>
                    <td>{permission}</td>
                    <td>{status}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>        
@endif
@endsection
