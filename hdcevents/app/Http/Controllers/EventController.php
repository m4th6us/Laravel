<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

use App\Models\User;

class EventController extends Controller
{
    public function index() {

        $search = request('search');

        if ($search){

            // filtrando registros com o where
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        }
        else {

            // Pegando todos os registros do banco
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function products() {
        $busca = request('search');
        return view('products', ['busca' => $busca]);
    }

    public function contacts() {
        return view('contact');
    }

    public function store(Request $request){

        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->date = $request->date;
        $event->items = $request->items;
        
        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect("/");

    }

    public function show($id){

        
        $event = Event::findOrFail($id);
        
        $eventOwner = User::where('id', $event->user_id)->first();
        
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id) {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }
}
