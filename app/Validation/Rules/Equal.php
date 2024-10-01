<?php declare(strict_types=1);

namespace App\Validation\Rules;

use Closure;
use Illuminate\Database\Capsule\Manager as Connection;
use Somnambulist\Components\Validation\Rule;

class Equal extends Rule
{
    private Connection $connection;
    protected string $message = "rule.equal";
    protected array $fillableParams = ['value'];
    
    public static function make($value): string
    {
        return sprintf('equal:%s', $value);
    }
    public function check($value): bool
    {
        $this->assertHasRequiredParameters($this->fillableParams);

        return $value == $this->parameter('value');
    }
}