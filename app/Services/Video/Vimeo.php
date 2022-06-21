<?php
namespace App\Services\Video;

use App\Contracts\Video\VideoHosting;

class Vimeo  implements VideoHosting {
    protected int $random;

    public function __construct()
    {
        $this->random = 'Vimeo'. rand(0, 1000);
    }

    public function showMeString(): int|string
    {
       return  $this->random;
    }

    public function showMeRandomString() : int
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