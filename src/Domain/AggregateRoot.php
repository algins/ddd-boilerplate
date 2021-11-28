<?php

namespace App\Domain;

use App\Domain\Events\DomainEvent;
use App\Domain\Events\DomainEventPublisher;
use ReflectionClass;

class AggregateRoot
{
    private array $recordedEvents = [];

    protected function recordApplyAndPublishThat(DomainEvent $domainEvent): void
    {
        $this->recordThat($domainEvent);
        $this->applyThat($domainEvent);
        $this->publishThat($domainEvent);
    }

    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->recordedEvents[] = $domainEvent;
    }

    protected function applyThat(DomainEvent $domainEvent): void
    {
        $reflection = new ReflectionClass($domainEvent);
        $modifier = 'apply' . $reflection->getShortName();

        $this->$modifier($domainEvent);
    }

    protected function publishThat(DomainEvent $domainEvent): void
    {
        DomainEventPublisher::instance()->publish($domainEvent);
    }

    public function recordedEvents(): array
    {
        return $this->recordedEvents;
    }

    public function clearEvents(): void
    {
        $this->recordedEvents = [];
    }
}
