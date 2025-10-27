<?php

namespace App\Repositories;

use App\Models\Link;

class LinkRepsository
{
    public function store(array $data): Link
    {
        return Link::create($data);
    }

    public function incrementClickCount(Link $link): void
    {
        $link->click_count++;
        $link->save();
    }

    public function findByShortCode(string $shortCode): ?Link
    {
        return Link::where('short_code', $shortCode)->first();
    }

    public function countByIpAddressToday(string $ipAddress): int
    {
        return Link::where('ip_address', $ipAddress)
            ->whereDate('created_at', now()->toDateString())
            ->count();
    }
}