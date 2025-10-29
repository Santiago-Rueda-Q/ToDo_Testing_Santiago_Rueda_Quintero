<?php
namespace Domain;

class Task {
    private static int $counter = 0;
    private int $id;
    private string $title;
    private ?string $description;
    private string $priority;
    private bool $completed;

    public function __construct(string $title, ?string $description, string $priority) {
        if (empty(trim($title))) {
            throw new \InvalidArgumentException("El título no puede estar vacío.");
        }

        $validPriorities = ['alta', 'media', 'baja'];
        if (!in_array(strtolower($priority), $validPriorities)) {
            throw new \InvalidArgumentException("Prioridad inválida.");
        }

        $this->id = ++self::$counter;
        $this->title = $title;
        $this->description = $description;
        $this->priority = strtolower($priority);
        $this->completed = false;
    }

    public function complete(): void {
        $this->completed = true;
    }

    public function getId(): int { return $this->id; }
    public function isCompleted(): bool { return $this->completed; }
    public function getPriority(): string { return $this->priority; }
    public function getTitle(): string { return $this->title; }
}
