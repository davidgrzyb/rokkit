<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use App\Http\Api\CloudwaysApi;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    public function index()
    {
        return view('domains.index');
    }

    public function view(int $id)
    {
        $domain = Domain::where('user_id', auth()->user()->id)->findOrFail($id);
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

        app(CloudwaysApi::class)->addDomain($request->input('domain'));

        Session::flash('message', sprintf('Success! Your %s domain was added.', $domain->name));
        return redirect('/domains');
    }

    public function delete(Request $request)
    {
        $domain = Domain::query()
            ->where('user_id', auth()->user()->id)
            ->findOrFail($request->input('id'));

        if ($domain->isDefault()) {
            return redirect('/domains');
        }

        if (auth()->user()->id !== $domain->user_id) {
            return redirect('/domains');
        }

        $domain->links()->update([
            'enabled' => false,
        ]);

        $domain->delete();

        Session::flash('message', sprintf('Success! Your %s domain was deleted.', $domain->name));
        return redirect('/domains');
    }
}
