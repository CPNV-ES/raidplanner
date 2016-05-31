@extends('layouts.app')

@section('content')

    <div class="col-sm-12 col-md-12">
        <div class="thumbnail">
            <img src="{{ $guild->icon_path }}" alt="{{ $guild->name }} logo">

            <div class="caption">
                <h3 class="text-center">{{ $guild->name }}</h3>

                @if ($guild->alliance_role === 'master')
                    <img style="width:50px" src="http://dofus2.org/images/items/couronne-d-allister.png"
                         alt="{{ $guild->name }} contrôle"/>
                @endif

                @if ($guild->alliance)
                    <p>Fait partie de l'alliance: <b>{{ $guild->alliance->name }}</b></p>
                @else
                    <p>La guilde <b>{{ $guild->name }}</b> n'appartient à aucune alliance</p>
                @endif
                <table class="table table-hover">
                    {{ $guild->members }}
                    <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Pseudo</th>
                        <th>Rang</th>
                    </tr>
                    </thead>
                    <td>Osa</td>
                    <td>xX_THEOSA_Xx</td>
                    <td>membre</td>

                </table>

            </div>
        </div>
    </div>


@endsection