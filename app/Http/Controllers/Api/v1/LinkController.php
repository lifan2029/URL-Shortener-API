<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\MakeShortRequest;
use App\Services\LinkService;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService
    ) {
    }

    public function makeShortLink(MakeShortRequest $request)
    {
        $data = $request->validated();

        $data['ip_address'] = $request->ip();

        return response()->json([
            'short_link' => $this->linkService->makeShortLink($data),
        ]);
    }

    public function getLinkStatistic(string $shortCode)
    {
        return response()->json(
            $this->linkService->getStatistic($shortCode)
        );
    }

    public function redirectFromShortLink(string $shortCode)
    {
        return redirect(
            $this->linkService->getOriginalUrl($shortCode)
        );
    }
}
