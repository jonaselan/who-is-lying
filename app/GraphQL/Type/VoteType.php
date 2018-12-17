<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class VoteType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Vote',
        'description' => 'A Vote'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a post'
            ],
            'vote' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The name of a user'
            ],
            'voter' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'Who made a vote'
            ],
            'post' => [
                'type' => Type::nonNull(GraphQL::type('Post')),
                'description' => 'Where the vote was made'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a was updated'
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }
}