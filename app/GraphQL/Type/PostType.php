<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A post'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a post'
            ],
            'truthful' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The name of a user'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email address of a user'
            ],
            'author' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'votes' => [
                'type' => Type::listOf(GraphQL::type('Vote')),
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