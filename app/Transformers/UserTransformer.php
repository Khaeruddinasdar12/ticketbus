<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        
    ];

    protected $availableIncludes = [
        
    ];

    public function transform(User $data)
    {
        // $data = \App\User::all();

        return [
            'nama'      => $data->name,
            'email'     => $data->email,
            'role'      => $data->role,
            'alamat'    => $data->alamat,
            'jkel'      => $data->jkel,
            // 'registered'    => $data->created_at->diffForHumans(),
        ];
    }
}
