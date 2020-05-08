@extends('base',['title'=>'Search App'])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <br>
            <h2>Search</h2>
        </div>
        <div class="col-12">
            {!! Form::open(['route' => 'root','method' => 'get']) !!}

            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        {{Form::label('Query',null,['class'=>"sr-only"])}}
                        {{Form::text('query', null,['class'=>'form-control','placeholder'=>'query'])}}
                    </div>
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-12">
        <p>{{count($data)}} record(s) found.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Organization</th>
                        <th scope="col">Tickets</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($data as $item)
                    {{-- {{dd($item['organizations'])}} --}}
                    <tr>
                        <th scope="row">{{$item['_id']}}</th>
                        <td>{{$item['name']}}</td>
                        <td>
                            @foreach ($item['organizations'] as $organization)
                            <p>{{$organization['name']}}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item['organizations'] as $organization)
                            @foreach ($organization['tickets'] as $ticket)
                            <p>{{$ticket['_id']}}</p>
                            @endforeach
                            @endforeach
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection