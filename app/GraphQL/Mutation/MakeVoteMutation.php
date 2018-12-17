<?php

namespace App\GraphQL\Mutation;

use App\Vote;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class MakeVoteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'MakeVote',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('Vote');
    }

    public function args()
    {
        return [
            'vote' => [
                'type' => Type::nonNull(Type::boolean()),
                'rules' => ['required'],
            ],
            'voter_id' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'post_id' => [
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ]
            
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $new_vote = Vote::create($args);

        return $new_vote;
    }
}
