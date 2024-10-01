<?php declare(strict_types=1);

namespace App\Validation\Rules;

use Closure;
use Illuminate\Database\Capsule\Manager as Connection;
use Somnambulist\Components\Validation\Rule;

class Exists extends Rule
{
    private Connection $connection;
    protected string $message = 'rule.exists';
    protected array $fillableParams = ['table', 'column'];

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    public function table(string $table): self
    {
        $this->params['table'] = $table;

        return $this;
    }

    public function column(string $column): self
    {
        $this->params['column'] = $column;

        return $this;
    }

    public function where(Closure $callback): self
    {
        $this->params['callback'] = $callback;

        return $this;
    }

    public function check(mixed $value): bool
    {
        $this->assertHasRequiredParameters(['table', 'column']);

        $qb = $this->connection::table($this->parameter('table'))
            ->where($this->parameter('column'), $value);

        if (null !== $func = $this->parameter('callback')) {
            $func($qb);
        }

        return $qb->exists();
    }
}
