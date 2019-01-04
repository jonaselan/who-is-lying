<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class AllUsersQuery extends Query
{
    protected $attributes = [
        'name' => 'allUsers'
    ];

    // public function authorize($root, $args, $currentUser)
    // {
    //     return false;
    // }

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'ranking' => [
                'name' => 'ranking',
                'type' => Type::boolean() 
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return User::query()
                ->when($args['ranking'] ?? false, function($q){
                    $q->orderBy('points', 'desc'); 
                })
                ->get();
    }
}