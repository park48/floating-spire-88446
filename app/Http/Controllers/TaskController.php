<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(Folder $folder)
  {


      //  ユーザーのフォルダを取得する
      $folders = Auth::user()->folders()->get();

      // // すべてのフォルダを取得する
      // $folders = Folder::all();

    //   // 選ばれたフォルダを取得する
    //   $current_folder = Folder::find($id);
    //
    //   if (is_null($current_folder)) {
    //     abort(404);
    // }ルートバインディングを使えばこの処理は要らなくなる。

      // 選ばれたフォルダに紐づくタスクを取得する
      $tasks = $folder->tasks()->get();
   // $tasks = Task::where('folder_id', $current_folder->id)->get();
       if (is_null($folder)) {
             return view('/');
         }
      return view('tasks/index', [
          'folders' => $folders,
          'current_folder_id' => $folder->id,
          'tasks' => $tasks,
          // 'folder' => $folder,
       // 'この名前をつける' => $tasksという変数に、

      ]);

      // if (Auth::user()->id !== $folder->user_id) {
      //   return redirect()->route('folders.create');
      // }
  }

    public function showCreateForm(Folder $folder)
  {
      return view('tasks/create', [
          'folder_id' => $folder->id,
      ]);
  }

    public function create(Folder $folder, CreateTask $request)
  {
      // $current_folder = Folder::find($id);

      $task = new Task();
      $task->title = $request->title;
      $task->due_date = $request->due_date;

      $folder->tasks()->save($task);
      // $current_folder->tasks()->save($task);

      return redirect()->route('tasks.index', [
          'id' => $folder->id,
      ]);
  }

    public function showEditForm(Folder $folder, Task $task)
  {
      $this->checkRelation($folder, $task);

      return view('tasks/edit', [
          'task' => $task,
      ]);
  }

    public function edit(Folder $folder, Task $task, EditTask $request)
  {
      // 1
      // $task = Task::find($task_id);
      $this->checkRelation($folder, $task);
      // 2
      $task->title = $request->title;
      $task->status = $request->status;
      $task->due_date = $request->due_date;
      $task->save();

      // 3
      return redirect()->route('tasks.index', [
          'id' => $task->folder_id,
      ]);
  }

    private function checkRelation(Folder $folder, Task $task)
  {
      if ($folder->id !== $task->folder_id) {
          abort(404);
      }
  }

}
