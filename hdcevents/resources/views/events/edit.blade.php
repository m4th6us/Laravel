@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)
@section('content')


<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Editando: {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem do evento:</label>
            <input type="file" id="image" name="image" class="fortm-control-file">
            <br>
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
        </div>
        <br>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nome do evento" value="{{$event->title}}">
        </div>
        <br>
        <div class="form-group">
            <label for="title">Data:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{$event->date}}">
        </div>
        <br>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="Nome da cidade" value="{{$event->city}}">
        </div>
        <br>
        <div class="form-group">
            <label for="title">O evento é privado?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{$event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{$event->description}}</textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="title">Adicione itens de infraestrutura:</label>

            <div class="form-group">
                <!-- QUANDO SE ENVIA UM OU MAIS ITENS É PRECISO PASSAR [] PARA ENTENDER QUE SERÁ UM OU MAIS ITENS NO NAME -->
                <input type="checkbox" name="items[]" value="cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>
            
        </div>
        <br>
        <input type="submit" value="Editar Evento" class="btn btn-primary">
    </form>
</div>

@endsection