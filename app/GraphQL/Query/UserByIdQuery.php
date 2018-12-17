<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UserByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'UserById',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' =>  ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if (!$user = User::find($args['id'])) {
            throw new \Exception('Resource not found');
        }

        return $user;
    }
}
