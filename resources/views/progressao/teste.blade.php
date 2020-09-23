<table class="table display responsive no-wrap table-striped" style="width: 1000px">
<thead>
<tr>
            <th>NOME</th>
            <th>ID</th>
            <th>STATUS</th>
            <th>CLASSE</th>
            <th>NÍVEL</th>
        </tr>
        </thead>

        <tbody>
             @foreach($docentes as $d)
             <tr>
                <td>{{$d->nomeDocente}}</td>
                <td>{{$d->idDocente}}</td>
                <td>{{$d->status}}</td>
                <td>{{$d->classe}}</td>
                <td>{{$d->nivel}}</td>
            </tr>
            @endforeach
        </tbody>