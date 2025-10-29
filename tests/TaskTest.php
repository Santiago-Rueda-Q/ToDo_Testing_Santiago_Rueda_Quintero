<?php
use PHPUnit\Framework\TestCase;
use Domain\Task;

class TaskTest extends TestCase {
    public function test_crear_tarea_valida() {
        $task = new Task("Tarea 1", "Descripción", "Alta");
        $this->assertEquals("tarea 1", strtolower($task->getTitle()));
        $this->assertFalse($task->isCompleted());
    }
    public function test_titulo_vacio_debe_fallar() {
        $this->expectException(InvalidArgumentException::class);
        new Task("", "desc", "media");
    }
    public function test_prioridad_invalida_debe_fallar() {
        $this->expectException(InvalidArgumentException::class);
        new Task("Tarea 2", "", "urgente");
    }
}
