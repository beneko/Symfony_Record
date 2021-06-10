<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table(name="artist")
 * @ORM\Entity
 */
class Artist
{
    /**
     * @var int
     *
     * @ORM\Column(name="artist_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $artistId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="artist_name", type="string", length=255, nullable=true)
     */
    private $artistName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="artist_url", type="string", length=255, nullable=true)
     */
    private $artistUrl;

    public function getArtistId(): ?int
    {
        return $this->artistId;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(?string $artistName): self
    {
        $this->artistName = $artistName;

        return $this;
    }

    public function getArtistUrl(): ?string
    {
        return $this->artistUrl;
    }

    public function setArtistUrl(?string $artistUrl): self
    {
        $this->artistUrl = $artistUrl;

        return $this;
    }


    public function __tostring():string{
        return $this->artistName;
    }

}
