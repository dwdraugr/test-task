<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Http;

class WnfDataCollection extends ResourceCollection
{
    private array $statuses_names;
    private array $types_names;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $statuses_names = Http::get('https://back-directory.pharm-portal.ru/wnf-status')->json()['data'];
        $this->statuses_names = array_column($statuses_names, 'name', 'id');

        $types_names = Http::get('https://back-directory.pharm-portal.ru/wnf-type')->json()['data'];
        $this->types_names = array_column($types_names, 'name', 'id');
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->collection = $this->collection->map(function ($item) {
            $item->type_name = $this->types_names[$item->type_id] ?? '';
            $item->status_name = $this->statuses_names[$item->status_id] ?? '';
            return $item;
        });
        return [
            'data' => $this->collection,
        ];
    }
}
