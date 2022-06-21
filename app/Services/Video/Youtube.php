<?php
namespace App\Services\Video;

use App\Contracts\Video\VideoHosting;

class Youtube implements VideoHosting {
    protected int $random;

    public function __construct()
    {
        $this->random = 'Youtube'. rand(0, 1000);
    }

    public function showString()
    {
        return $this->showString();
    }

    public function showMeString(): string
    {
        return $this->random;
    }

    public function getVideoWidth()
    {
        // TODO: Implement getVideoWidth() method.
    }

    public function getVideoHeight()
    {
        // TODO: Implement getVideoHeight() method.
    }

    public function getVideoPreviewUrl()
    {
        // TODO: Implement getVideoPreviewUrl() method.
    }
}