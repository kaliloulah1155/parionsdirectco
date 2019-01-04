@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" action="{{route('search')}}" method="GET">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="card-body">
                            <h1 class="card-title">Formulaire de recherche</h1>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">critère de recherche</label>
                                <div class="col-sm-4 input-group date">
                                    <input type="text" class="form-control" id="mtn" name="q" placeholder="search">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-info">Recherche</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <hr/>
        @if(count($result))
        <div class="alert alert-success"> Data find {{ $search }}</div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Intitulé</th>
                <th>Département</th>
                <th>Responsable</th>
            </tr>
            <tr>
            @foreach($result as $role)
                <tr>
                    <td>{{ $role->name }}</td> {{-- intituler --}}
                    <td>{{ $role->departement }}</td> {{-- departement --}}
                    <td>{{ $role->responsable }}</td>  {{-- responsable --}}
                <tr>
                    @endforeach
                </tr>
        </table>
    </div>
  @else
      <h1>No data</h1>
  @endif
@endsection
