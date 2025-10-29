<?php
namespace App;

use Domain\Task;
use Infra\Storage;

class ToDoApp {
    private Storage $storage;

    public function __construct(Storage $storage) {
        $this->storage = $storage;
    }

    public function addTask(string $title, ?string $description, string $priority): Task {
        $task = new Task($title, $description, $priority);
        $this->storage->save($task);
        return $task;
    }

    public function listTasks(?string $filter = null): array {
        return $this->storage->list($filter);
    }

    public function completeTask(int $id): bool {
        $task = $this->storage->find($id);
        if (!$task) throw new \Exception("ID no encontrado");
        $task->complete();
        return true;
    }

    public function deleteTask(int $id): bool {
        return $this->storage->delete($id);
    }
}
