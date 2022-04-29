<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RoomsGetController extends AbstractController
{
    public function __invoke(): Response
    {
        $roomsJson = $this->getRoomsJson();
        $paginatedRooms = Room::getRoomsWithPagination($roomsJson, 5, 10);

        return $this->render("base.html.twig", $paginatedRooms);
    }

    private function getRoomsJson(): string
    {
        return $this->localRoomsFileExists() ? $this->getLocalRoomsFile() : $this->downloadExternalRoomsFile();
    }

    private function localRoomsFileExists(): bool
    {
        return file_exists("ads-housinganywhere.json");
    }

    private function downloadExternalRoomsFile(): string
    {
        $roomsJson = file_get_contents("http://feeds.spotahome.com/ads-housinganywhere.json");
        file_put_contents("ads-housinganywhere.json", $roomsJson);

        return $roomsJson;
    }

    private function getLocalRoomsFile(): string
    {
        return file_get_contents("ads-housinganywhere.json");
    }
}
