<?php

namespace App\GraphQL\Query;

use App\Vote;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class AllVotesQuery extends Query
{
    protected $attributes = [
        'name' => 'AllVotes',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Vote'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return Vote::all();
    }
}
