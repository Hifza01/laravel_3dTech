@extends('layouts.app')

@section('content')
<div class="container container-home mt-5" style="min-height:80vh">
    <div class="row">
        <div class="col-md-auto">
            <div class="kanban-column">
                <div class="kanban-header">
                    <h4>To Do</h4>
                    <a href="#" class="btn-add" data-bs-toggle="modal" data-bs-target="#addItemModal">+</a>
                </div>
                <div class="kanban-body">
                    @foreach($toDoTasks as $task)
                        <div class="card card-home
                            @if($task->color === 'merah') bg-merah 
                            @elseif($task->color === 'kuning') bg-kuning 
                            @elseif($task->color === 'hijau') bg-hijau 
                            @endif">
                            <div class="card-body card-body-home">
                                <h5 class="card-title">{{ $task->teknisi->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $task->category }}</h6>
                                <p class="card-text card-text-home">{{ $task->content }}</p>
                                <form action="{{ route('task.update_status', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button type="submit" class="btn btn-card">Do It</button>
                                </form>
                                <p class="card-link card-link-home">Due Date: {{ $task->due }}</p>
                                <button type="button" class="btn btn-comment d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#commentModal{{ $task->id }}" style="width: 100%;">
                                    <span>Comment</span>
                                    <img src="{{ asset('img/send-icon.png') }}" alt="Send Icon" class="icon" style="width: 16px; height: 16px;">
                                </button>
                            </div>
                        </div>                        
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="kanban-column">
                <div class="kanban-header">
                    <h4>In Progress</h4>
                </div>
                <div class="kanban-body">
                    @foreach($inProgressTasks as $task)
                        @if($task->is_approved && $task->status === 'in_progress')
                            <div class="card card-home
                        @if($task->color === 'merah') bg-merah 
                        @elseif($task->color === 'kuning') bg-kuning 
                        @elseif($task->color === 'hijau') bg-hijau 
                        @endif">
                                <div class="card-body card-body-home">
                                    <h5 class="card-title">{{ $task->teknisi->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $task->category }}</h6>
                                    <p class="card-text card-text-home">{{ $task->content }}</p>
                                    <form action="{{ route('task.update_status', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="done">
                                        <button type="submit" class="btn btn-card">Done</button>
                                    </form>
                                    <p class="card-link card-link-home">Due Date: {{ $task->due }}</p>    
                                    <button type="button" class="btn btn-comment d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#commentModal{{ $task->id }}" style="width: 100%;">
                                        <span>Comment</span>
                                        <img src="{{ asset('img/send-icon.png') }}" alt="Send Icon" class="icon" style="width: 16px; height: 16px;">
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="kanban-column">
                <div class="kanban-header">
                    <h4>Done</h4>
                    <p style="font-size: 10px">({{ \Carbon\Carbon::now()->translatedFormat('F, Y') }})</p>
                </div>
                <div class="kanban-body">
                    @foreach($doneTasks as $task)
                        @if($task->is_approved && $task->status === 'done')
                            <div class="card card-home
                                @if($task->color === 'merah') bg-merah 
                                @elseif($task->color === 'kuning') bg-kuning 
                                @elseif($task->color === 'hijau') bg-hijau 
                                @endif">
                                <div class="card-body card-body-home">                                
                                    <h5 class="card-title">{{ $task->teknisi ? $task->teknisi->name : 'Teknisi tidak ditemukan' }}</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $task->category }}</h6>
                                    <p class="card-text card-text-home">{{ $task->content }}</p>
                                    <p class="card-link card-link-home">Due Date: {{ $task->due }}</p>                                    
                                    <button type="button" class="btn btn-comment d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#commentModal{{ $task->id }}" style="width: 100%;">
                                        <span>Comment</span>
                                        <img src="{{ asset('img/send-icon.png') }}" alt="Send Icon" class="icon" style="width: 16px; height: 16px;">
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="kanban-column">
                <div class="kanban-header">
                    <h4>Backlog</h4>
                </div>
                <div class="kanban-body">
                    @foreach($overdueTasks as $task)
                        <div class="card card-home
                        @if($task->color === 'merah') bg-merah 
                        @elseif($task->color === 'kuning') bg-kuning 
                        @elseif($task->color === 'hijau') bg-hijau 
                        @endif">
                            <div class="card-body card-body-home">
                                <h5 class="card-title">{{ $task->teknisi->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">{{ $task->category }}</h6>
                                <p class="card-text card-text-home">{{ $task->content }}</p>
                                <form action="{{ route('task.update_status', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="in_progress">
                                    <button type="submit" class="btn btn-card">Do It</button>
                                </form>
                                <p class="card-link card-link-home">Due Date: {{ $task->due }}</p>
                                <button type="button" class="btn btn-comment d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#commentModal{{ $task->id }}" style="width: 100%;">
                                    <span>Comment</span>
                                    <img src="{{ asset('img/send-icon.png') }}" alt="Send Icon" class="icon" style="width: 16px; height: 16px;">
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal_tambah')
    @include('partials.modal_komen', ['tasks' => $toDoTasks])
    @include('partials.modal_komen', ['tasks' => $inProgressTasks])
    @include('partials.modal_komen', ['tasks' => $doneTasks])
    @include('partials.modal_komen', ['tasks' => $overdueTasks])
</div>
@endsection
