<?php

namespace App\Http\Controllers;

use App\Repositories\tmdbRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;
use Illuminate\View\View;

class tmdbController extends Controller
{
    private $tmdbRepo;

    public function __construct()
    {
        $this->tmdbRepo = new tmdbRepository();
    }

    public function getMediaDetails(string $media, string $id) : View
    {
        $item = $this->tmdbRepo->getMediaDetails($media, $id);
        return view($media . '.details', compact('item'));
    }

    public function getMediaGroup(Request $request, $media): View
    {
        $group = $request->get('media-group', 'popular');
        $page = $request->get('page', 1);

        $items = $this->tmdbRepo->getMediaGroup($media, $group, $page);

        return view($media.'.items', compact('items'));
    }


    public function getMediaSearch(Request $request): View
    {
        $media = $request->media;
        $query = $request->get('query');

        $items = $this->tmdbRepo->getMediaSearch($media, $query);

        return view($media.'.items', compact('items'));
    }

}
