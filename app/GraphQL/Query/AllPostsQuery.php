<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Post;

class AllPostsQuery extends Query
{
    protected $attributes = [
        'name' => 'AllPosts',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return Post::all();
    }
}
