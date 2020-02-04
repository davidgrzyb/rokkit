<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    public function index()
    {
        return view('domains.index');
    }

    public function view(int $id)
    {
        $domain = Domain::findOrFail($id);
        return view('domains.view')->withDomain($domain);
    }

    public function create()
    {
        return view('domains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain' => [
                'required',
                'regex:/^([a-zA-Z0-9][a-zA-Z0-9-_]*\.)*[a-zA-Z0-9]*[a-zA-Z0-9-_]*[[a-zA-Z0-9]+$/',
                'unique:domains,name',
            ],
        ]);

        $domain = Domain::create([
            'name' => $request->input('domain'),
            'user_id' => auth()->user()->id,
        ]);

        Session::flash('message', sprintf('Success! Your %s domain was added.', $domain->name));
        return redirect('/domains');
    }

    public function delete(Request $request)
    {
        $domain = Domain::findOrFail($request->input('id'));

        if ($domain->name === 'rokk.it') {
            return redirect('/domains');
        }

        if (auth()->user()->id !== $domain->user->id) {
            return redirect('/domains');
        }

        $domain->delete();

        // TODO: disable associated links

        Session::flash('message', sprintf('Success! Your %s domain was deleted.', $domain->name));
        return redirect('/domains');
    }
}
