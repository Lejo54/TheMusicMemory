<?php

namespace App\Data;

/**
 * Summary of Album
 * All the method to create, fetch data about an album
 */
class Album
{
    /**
     * Create a new Album class instance.
     */
    public function __construct(
        private string $id,
        private string $title,
        private string $artist,
        private string $releaseYear,
        private string $type,
        private int $totalTrack,
        private string $listenLink,
        private string $imageLink,
        private int $imageWidth,
        private string $artistId,
        private string $artistName
    ) {
        // 
    }

    // private static function fromApi(array $data): self
    // {
    //     return new self(

    //     );
    // }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle(){return $this->title;}
    public function getArtist(){return $this->artist;}


}
