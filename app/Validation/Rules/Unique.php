<?php declare(strict_types=1);

namespace App\Validation\Rules;

use Closure;
use Illuminate\Database\Capsule\Manager as Connection;
use Somnambulist\Components\Validation\Rule;

class Unique extends Rule
{
    private Connection $connection;
    protected string $message = 'rule.unique';
    protected array $fillableParams = ['table', 'column', 'ignore', 'ignore_column'];

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

    public function ignore(mixed $value, string $column = null): self
    {
        $this->params['ignore']        = $value;
        $this->params['ignore_column'] = $column;

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

        if ($this->parameter('ignore')) {
            $qb->where($this->parameter('ignore_column') ?? $this->parameter('column'), '<>', $this->parameter('ignore'));
        }

        if (null !== $func = $this->parameter('callback')) {
            $func($qb);
        }

        return $qb->doesntExist();
    }
}
