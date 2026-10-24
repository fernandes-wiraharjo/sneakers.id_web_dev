<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Services\InstagramService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InstagramConnectController extends Controller
{
    /** @var InstagramService */
    protected $instagramService;

    public function __construct(InstagramService $instagramService)
    {
        $this->instagramService = $instagramService;
    }

    public function index()
    {
        return view('administrator.instagram.index', [
            'connection' => $this->instagramService->getConnection(),
            'posts' => $this->instagramService->isConnected()
                ? $this->instagramService->getPosts(6)
                : [],
        ]);
    }

    public function connect()
    {
        session(['instagram_connect_user_id' => auth()->id()]);

        return redirect()->away($this->instagramService->getAuthorizationUrl());
    }

    public function callback(Request $request)
    {
        if ($request->filled('error')) {
            session()->forget('instagram_connect_user_id');
            Alert::error($request->get('error_description', $request->get('error', 'Instagram authorization was cancelled.')));

            return redirect()->route('administrator.instagram.index');
        }

        if (! $request->filled('code')) {
            session()->forget('instagram_connect_user_id');
            Alert::error('Instagram did not return an authorization code.');

            return redirect()->route('administrator.instagram.index');
        }

        if (! $this->instagramService->validateOAuthState($request->get('state'))) {
            session()->forget('instagram_connect_user_id');
            Alert::error('Invalid Instagram login state. Please try again.');

            return redirect()->route('administrator.instagram.index');
        }

        $connectedByUserId = session('instagram_connect_user_id');
        session()->forget('instagram_connect_user_id');

        try {
            $this->instagramService->connectFromAuthorizationCode($request->get('code'), $connectedByUserId);

            Alert::success('Instagram account connected successfully.');
        } catch (\Throwable $e) {
            Alert::error($e->getMessage());
        }

        return redirect()->route('administrator.instagram.index');
    }

    public function disconnect()
    {
        $this->instagramService->disconnect();

        Alert::success('Instagram account disconnected.');

        return redirect()->route('administrator.instagram.index');
    }

    public function refresh()
    {
        if (! $this->instagramService->isConnected()) {
            Alert::error('Connect Instagram first before refreshing the feed.');

            return redirect()->route('administrator.instagram.index');
        }

        $this->instagramService->refreshPosts();

        Alert::success('Instagram feed cache refreshed.');

        return redirect()->route('administrator.instagram.index');
    }
}
