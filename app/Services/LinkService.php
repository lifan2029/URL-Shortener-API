<?php

namespace App\Services;

use App\Models\Link;
use App\Repositories\LinkRepsository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class LinkService
{
    public function __construct(
        private readonly LinkRepsository $linkRepository
    ) {
    }

    public function makeShortLink(array $data): string
    {
        if ($this->linkRepository->countByIpAddressToday($data['ip_address']) >= 3) {
            throw new TooManyRequestsHttpException(null, 'IP address has reached the daily limit for creating short links');
        }

        $data['short_code'] = bin2hex(random_bytes(4));

        $link = $this->linkRepository->store($data);

        return url($link->short_code);
    }

    public function getStatistic(string $shortCode)
    {
        $link = $this->linkRepository->findByShortCode($shortCode);

        if (!$link) {
            throw new NotFoundHttpException('Link not found');
        }

        return [
            'original_url' => $link->original_url,
            'click_count' => $link->click_count,
            'created_at' => $link->created_at,
        ];
    }

    public function getOriginalUrlAndIncrement(string $shortCode): string
    {
        $link = $this->linkRepository->findByShortCode($shortCode);

        if (!$link) {
            throw new NotFoundHttpException('Link not found');
        }

        $this->linkRepository->incrementClickCount($link);

        return $link->original_url;
    }
}