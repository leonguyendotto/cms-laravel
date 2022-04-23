@extends ('layout.console')

@section ('content')

<section class="w3-padding">
    <hr>

    @if (session()->has('message'))
        <div class="w3-padding w3-margin-top w3-margin-bottom">
            <div class="w3-red w3-center w3-padding">
                {{session()->get('message')}}
            </div>
        </div>
    @endif

    <h2>Manage Skills</h2>

    <table class="w3-table w3-stripped w3-bordered w3-margin-bottom">
        <tr class="w3-red">
            <th></th>
            <th>Name</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($skills as $skill)
            <tr>
                <td>
                    @if ($skill->image)
                        <img src="{{asset('storage/'.$skill->image)}}" width="200">
                    @endif
                </td>
                <td>{{$skill->name}}</td>
                <td><a href="/console/skills/image/{{$skill->id}}">Image</a></td>
                <td><a href="/console/skills/edit/{{$skill->id}}">Edit</a></td>
                <td><a href="/console/skills/delete/{{$skill->id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <a href="/console/skills/add" class="w3-button w3-green">New Skill</a>

</section>

@endsection