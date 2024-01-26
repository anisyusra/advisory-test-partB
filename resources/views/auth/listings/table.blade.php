@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List of Listing</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('listings.create') }}"> Add New Listing</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>User Id</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($listings as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->latitude }}</td>
            <td>{{ $s->longitude }}</td>
            <td>{{ $s->user_id }}</td>
            <td>{{ $s->created_at }}</td>
            <td>
                <form action="{{ route('listings.destroy',$s->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('listings.show',$s->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('listings.edit',$s->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <!-- <form method="post" action="{{ route('generate-link') }}">
    @csrf
    <label for="user_id">Enter User ID:</label>
    <input type="text" name="user_id" id="user_id" required>

    @if(isset($generatedLink))
        <p>Generated Link: http://advisory_test_part_b.test/admin/listing/{{ $generatedLink }}/get</p>
    @else
        <button type="submit">Generate Link</button>
    @endif -->
</form>


@endsection