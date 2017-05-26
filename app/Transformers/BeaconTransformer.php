<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Beacon;

/**
 * Class BeaconTransformer
 * @package App\Transformers
 */
class BeaconTransformer extends TransformerAbstract
{
    /**
     * @param Beacon $data
     * @return array
     */
    public function transform(Beacon $data)
    {
        return [
            'posX' => $data['x'],
            'posY' => $data['y'],
            'groupID' => $data['floor'],
            'major' => $data['major'],
            'minor' => $data['minor']
        ];
    }
}