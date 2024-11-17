<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $eventsQuery = Event::query();
        $search = request('search', '');

        if ($search) {

            $eventsQuery->where('nome', 'like', '%' . $search . '%');
        }

        $events = $eventsQuery->get();
        $eventsCount = $eventsQuery->count();

        return Inertia::render('Event/Index', [
            'events' => $events->map(function ($event) {

                $event->usersCount = $event->users->count();
                return $event;
            }),
            'search' => $search,
            'eventsCount' => $eventsCount,
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);
    }

    public function create()
    {
        return view('events/create');
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->nome = $request->nome;
        $event->data = $request->data;
        $event->descricao = $request->descricao;
        $event->mapa = $request->mapa;
        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {
            $capaFile = $request->file('capa');
            $capaName = md5($capaFile->getClientOriginalName() . strtotime("now")) . '.' . $capaFile->extension();
            $capaFile->move(public_path('img/events'), $capaName);
            $event->capa = $capaName;
        }



        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $bannerFile = $request->file('banner');
            $bannerName = md5($bannerFile->getClientOriginalName() . strtotime("now")) . '.' . $bannerFile->extension();
            $bannerFile->move(public_path('img/events'), $bannerName);
            $event->banner = $bannerName;
        }
        $user = Auth::user();
        $event->user_id = $user->id;

        $event->save();
        return redirect()->route('events.index')->with('msg', 'Evento criado com sucesso!');
    }


    public function show($id)
    {

        $event = Event::findOrFail($id);

        $user = Auth::user();
        $hasUserJoined = false;

        if ($user) {

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if ($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        $event = Event::findOrFail($id);
        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }
        return view('events.edit', ['event' => $event]);
    }


    public function update(Request $request,  $id)

    {


        $data = $request->all();

        if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
            $bannerFile = $request->file('banner');
            $bannerName = md5($bannerFile->getClientOriginalName() . strtotime("now")) . '.' . $bannerFile->extension();
            $bannerFile->move(public_path('img/events'), $bannerName);
            $data['banner'] = $bannerName;
        }

        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {
            $capaFile = $request->file('capa');
            $capaName = md5($capaFile->getClientOriginalName() . strtotime("now")) . '.' . $capaFile->extension();
            $capaFile->move(public_path('img/events'), $capaName);
            $data['capa'] = $capaName;
        }

        Event::findOrFail($id)->update($data);


        return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->users()->detach();

        $event->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function joinEvent($id)
    {
        $user = Auth::user();
        $event = Event::findOrFail($id);

        if ($user->eventsAsParticipant->contains($id)) {
            return redirect('/dashboard')->with('msg', 'Você já está participando deste evento!');
        }

        $user->eventsAsParticipant()->attach($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->nome);
    }

    public function leaveEvent($id)
    {
        $user = Auth::user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Sua presença foi removida no evento ' . $event->name);
    }
}
