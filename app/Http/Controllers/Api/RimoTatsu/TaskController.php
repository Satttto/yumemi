<?php

namespace App\Http\Controllers\Api\RimoTatsu;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * タスク一覧の取得
     */
    public function index(Request $request) 
    {
        // 全てのタスクを取得
        try {
            return response()->success('succeeded to retrieve tasks', [
                "tasks" => $this->taskService->getAll(),
            ]);
        } catch(QueryException $e) {
            return response()->error('failed to retrieve tasks', Status::HTTP_BAD_REQUEST);
        }
    }

}
