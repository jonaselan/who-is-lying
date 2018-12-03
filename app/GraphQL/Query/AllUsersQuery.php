<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;

class AllUsersQuery extends Query
{
    protected $attributes = [
        'name' => 'allUsers'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return User::all();
    }
}