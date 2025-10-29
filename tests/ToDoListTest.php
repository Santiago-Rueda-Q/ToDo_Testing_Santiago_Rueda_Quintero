<?php
use PHPUnit\Framework\TestCase;
use App\ToDoApp;
use Infra\Storage;

class ToDoListTest extends TestCase {
    private ToDoApp $app;

    protected function setUp(): void {
        $this->app = new ToDoApp(new Storage());
    }

    public function test_agregar_y_listar_tareas() {
        $this->app->addTask("Lavar", "Ropa", "baja");
        $this->assertCount(1, $this->app->listTasks());
    }

    public function test_completar_tarea() {
        $task = $this->app->addTask("Estudiar", "", "alta");
        $this->app->completeTask($task->getId());
        $tasks = $this->app->listTasks('completadas');
        $this->assertCount(1, $tasks);
    }

    public function test_eliminar_tarea_inexistente() {
        $this->assertFalse($this->app->deleteTask(999));
    }
}
