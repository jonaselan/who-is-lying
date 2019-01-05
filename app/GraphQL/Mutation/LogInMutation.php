<?php

namespace App\GraphQL\Mutation;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class LogInMutation extends Mutation
{
    protected $attributes = [
        'name' => 'logIn'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
          'email' => [
            'name' => 'email',
            'type' => Type::nonNull(Type::string()),
            'rules' => ['required', 'email'],
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
        $credentials = [
          'email' => $args['email'],
          'password' => $args['password']
        ];

        if (! $token = auth()->attempt($credentials)) {
            throw new \Exception('Unauthorized!');
        }
        
        return $token;
    }
}
