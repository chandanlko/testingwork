<?php
namespace App\GraphQL\Queries;


use  GraphQL\Type\Definition\ResolveInfo ; 
use App\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext ;;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'user query'
    ];
    private $jwt;
    public function __construct(JWTAuth $jwt)
      {
          $this->jwt = $jwt;
      }
     public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
      try {
          $this->auth =$this->jwt->parseToken()->authenticate();
      } catch (\Exception $e) {
          $this->auth = null;
      }
      return (boolean) $this->auth;
    }
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    } 
    public function args(): array
    {
        return [
        ];
    }
    public function resolve($root, $args)
        {
            $users = User::all();
            return $users;
        } 
}