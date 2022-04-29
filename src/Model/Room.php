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
                    $actualRoom->Images[0]
                );
        }

        return $roomsWithPagination;
    }
}
