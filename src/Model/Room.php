<?php

declare(strict_types=1);

namespace App\Model;

class Room
{
    private string $title;
    private string $link;
    private string $address;
    private string $city;
    private string $image;

    public function __construct(string $title, string $link, string $address, string $city, string $image)
    {
        $this->title = $title;
        $this->link = $link;
        $this->address = $address;
        $this->city = $city;
        $this->image = $image;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public static function getRoomsWithPagination(string $roomsJson, int $min, int $max): array
    {
        $roomsArray = json_decode($roomsJson);
        $roomsWithPagination = [];

        for ($i = $min; $i < $max; $i++) {
            $actualRoom = $roomsArray[$i];
            
            $roomsWithPagination[] = new self(
                    "Room {$i}",
                    $actualRoom->Link,
                    $actualRoom->Address,
                    $actualRoom->City,
                    empty($actualRoom->Images) ? "" : $actualRoom->Images[0]
                );
        }

        return $roomsWithPagination;
    }

    public static function getVariablesNames(): array
    {
        return ["title", "link", "address", "city", "image"];
    }
}
