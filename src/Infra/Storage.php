<?php
namespace Infra;

use Domain\Task;

class Storage {
    private array $tasks = [];

    public function save(Task $task): void {
        $this->tasks[$task->getId()] = $task;
    }

    public function list(?string $filter = null): array {
        if (!$filter) return array_values($this->tasks);
        if ($filter === 'completadas') {
            return array_filter($this->tasks, fn($t) => $t->isCompleted());
        }
        return array_filter($this->tasks, fn($t) => $t->getPriority() === strtolower($filter));
    }

    public function find(int $id): ?Task {
        return $this->tasks[$id] ?? null;
    }

    public function delete(int $id): bool {
        if (!isset($this->tasks[$id])) return false;
        unset($this->tasks[$id]);
        return true;
    }
}
