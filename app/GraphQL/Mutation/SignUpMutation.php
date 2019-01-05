<?php

namespace App\GraphQL\Mutation;

use App\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use App\Jobs\SendWelcomeEmail;

class SignUpMutation extends Mutation
{
    protected $attributes = [
        'name' => 'signUp'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),
        ]);

        if ($user) {
            dispatch(new SendWelcomeEmail($user));
        }

        // generate token for user and return the token
        return auth()->login($user);
    }
}
