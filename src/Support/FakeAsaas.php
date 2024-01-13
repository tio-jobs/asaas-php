<?php
namespace TioJobs\AsaasPhp\Support;

use Closure;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use TioJobs\AsaasPhp\Core\Asaas;

class FakeAsaas extends Asaas
{
    private static Factory $factory;


    public function __construct(Closure|array|null $callback)
    {
        self::$factory = Http::fake($callback);

        parent::__construct();
    }


    public function assertSent(callable $callback): void
    {
        self::$factory->assertSent($callback);
    }


    public function assertNotSent(callable $callback): void
    {
        self::$factory->assertNotSent($callback);
    }


    public function assertNothingSent(): void
    {
        self::$factory->assertNothingSent();
    }


    public function assertSentCount(int $count): void
    {
        self::$factory->assertSentCount($count);
    }


    public function assertSentInOrder(array $callbacks): void
    {
        self::$factory->assertSentInOrder($callbacks);
    }


    public function assertSequencesAreEmpty(): void
    {
        self::$factory->assertSequencesAreEmpty();
    }


}