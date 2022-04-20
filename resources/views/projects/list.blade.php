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

    <h2>Manage Projects</h2>

    <table class="w3-table w3-stripped w3-bordered w3-margin-bottom">
        <tr class="w3-red">
            <th></th>
            <th>Title</th>
            <th>Slug</th>
            <th>Date</th>
            <th>Created</th>
            <th>URL</th>
            <th>GitHub</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($projects as $project)
            <tr>
                <td>
                    @if ($project->image)
                        <img src="{{asset('storage/'.$project->image)}}" width="200">
                    @endif
                </td>
                <td>{{$project->title}}</td>
                <td>
                    <a href="/project/{{$project->slug}}">
                        {{$project->slug}}
                    </a>
                </td>
                <td>{{$project->date}}</td>
                <td>{{$project->created_at->format('M j, Y')}}</td>
                <td>{{$project->url}}</td>
                <td>{{$project->github}}</td>
                <td><a href="/console/projects/image/{{$project->id}}">Image</a></td>
                <td><a href="/console/projects/edit/{{$project->id}}">Edit</a></td>
                <td><a href="/console/projects/delete/{{$project->id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <a href="/console/projects/add" class="w3-button w3-green">New Project</a>

</section>

@endsection