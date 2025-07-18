<?php
    namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Task;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class TaskController extends Controller
    {
        public function TaskView(){
            $user = Auth::user();
            if(!$user){
                return redirect()->route('inicio');
            }
            if($user->admin == 0){
                return redirect()->route('pg_principal');
            }

            $initialUsers = User::select('id', 'name', 'email')->limit(10)->get();
            return view('adicionar_tarefa', compact('initialUsers'));

        }

        public function TaskPost(Request $request){
            $request->validate([
                'user_id' => 'required',
                'title' => 'required',
                'description' => 'nullable|string',
                'status' => 'required|in:pendente,andamento,concluida',
                'priority' => 'required|in:baixa,media,alta',
                'due_date' => 'nullable|date',
            ]);

            $task = Task::create([
                'user_id' => $request->user_id,
                'title' =>  $request->title,
                'description' =>  $request->description,
                'status' =>  $request->status,
                'priority' =>  $request->priority,
                'due_date' =>  $request->due_date,
            ]);

            Log::create([
                'user_id' => Auth::id(),
                'task_id' => $task->id,
                'title' => $task->title,
                'status' => $task->status,
                'action' => 'criou',
                'priority' => $task->priority,
                'due_date' => $task->due_date,
            ]);

            return redirect()->route('pg_principal');
        }

        public function deletePOST(Request $request){
            $user = Auth::user();
            $userAtt = is_array($user) ? $user['id'] : $user->id;

            if($user){
                $task = Task::find($request->id);
                if($task->user_id == $userAtt){
                    if($task){
                        Log::create([
                        'user_id' => Auth::id(),
                        'task_id' => $task->id,
                        'title' => $task->title,
                        'status' => $task->status,
                        'action' => 'Finalizou',
                        'priority' => $task->priority,
                        'due_date' => $task->due_date,
                    ]);
                        $task->delete();
                    }
                }
            }
            
            return response()->json(['url' => route('pg_principal')]);
        }

        public function index(Request $request){
            $user = Auth::user();
            $query = Task::query();

            if(!$user->admin){
                $query->where('user_id', Auth::id());
            }

            if ($request->has('status') && ($request->status !== 'todos')) {
                $query->where('status', $request->status);
            }
            if ($request->has('priority')) {
                $query->where('priority', $request->priority);
            }
            return $query->get();
        }

        public function editTask(Request $request) {
            $request->validate([
                'status' => 'required|in:pendente,andamento,concluida',
                'id' => 'required|exists:task,id'
            ]);

            $task = Task::find($request->id);
            $status_antigo = $task->status;
            
            $task->update([
                'status' => $request->status,
            ]);
            Log::create([
                'user_id' => Auth::id(),
                'task_id' => $task->id,
                'title' => $task->title,
                'status' => $status_antigo,
                'status_novo' => $request->status,
                'action' => 'editou',
                'priority' => $task->priority,
                'due_date' => $task->due_date,
            ]);

            return redirect()->route('pg_principal');
        }
    }
