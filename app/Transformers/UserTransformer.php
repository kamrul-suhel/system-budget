<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier'    => (int) $user->id,
            'email'    => (string) $user->email,
            'name'    => (string) $user->name,
            'isadmin'    => ($user->admin === 'true'),
            'isverify'    => (int) $user->verified,
            'creationdate'    => (string) $user->created_at,
            'lastchange'    => (string) $user->updated_at,
            'deleteddate'   => isset($user->deleted_at) ? (string) $user->deleted_al : null,
            'links' =>[
                [
                    'rel'   => 'self',
                    'href'  => route('users.show',$user->id)
                ]
            ]
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identifier'    => 'id',
            'email'    => 'email',
            'name'    => 'name',
            'isverify'    => 'verified',
            'creationdate'    => 'created_at',
            'lastchange'    => 'updated_at',
            'deleteddate'   => 'deleted_al'
        ];
        return isset($attributes[$index]) ? $attributes[$index]: null;
    }
}
