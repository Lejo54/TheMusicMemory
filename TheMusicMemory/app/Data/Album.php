<?php

namespace App\Data;

use JsonSerializable;

/**
 * Album : simple data container (DTO).
 *
 * - It only HOLDS data. Fetching albums is the job of CatalogClient.
 * - It lives in memory only (do not persist Spotify data in the database).
 * - Properties are public +   (PHP 8.1+): no getters needed.
 */
class Album implements JsonSerializable
{
    /**
     * @param string[] $artistNames All the artists credited on the album
     */
    public function __construct(
        private string $id,
        private string $title,
        private ?string $artistId,
        private string $artistName,   // main artist
        private array $artistNames, //featurings
        private ?string $releaseYear,
        private string $type,
        private int $totalTracks,
        private ?string $imageLink,
        private ?int $imageWidth,
    ) {
    }

    /**
     * Builds an Album from ONE item returned by the Spotify API
     * (search results, artist albums, or "get album").
     */
    public static function fromSpotify(array $a): self
    {
        $artists = $a['artists'] ?? [];
        $image = $a['images'][0] ?? null; // widest first

        return new self(
            id: $a['id'],
            title: $a['name'],
            artistId: $artists[0]['id'] ?? null,
            artistName: $artists[0]['name'] ?? null,
            artistNames: array_column($artists, 'name'),
            // release_date can be "1999", "1999-05" or "1999-05-03"
            releaseYear: isset($a['release_date']) ? substr($a['release_date'], 0, 4) : null,
            type: $a['album_type'] ?? 'album',
            totalTracks: (int) ($a['total_tracks'] ?? 0),
            imageLink: $image['url'] ?? null,
            imageWidth: $image['width'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'artist_id' => $this->artistId,
            'artist_name' => $this->artistName,
            'artists' => $this->artistNames,
            'release_year' => $this->releaseYear,
            'type' => $this->type,
            'total_tracks' => $this->totalTracks,
            'image_link' => $this->imageLink,
            'image_width' => $this->imageWidth,
        ];
    }

    /** Lets response()->json(['data' => $albums]) work directly with Album objects. */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}