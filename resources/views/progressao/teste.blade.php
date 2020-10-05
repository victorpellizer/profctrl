<html>
<head></head>
<body>
<div>
@foreach($docentes as $item)
<li>{{$item->nomeDocente}}</li>
@endforeach
</div>
<div>
{{$docentes->links()}}
</div>
</body>
</html>