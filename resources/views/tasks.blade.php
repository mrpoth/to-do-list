<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('storage/logo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" placeholder="Insert task name" name="title">
                    </div>
                    <button type="submit" class="btn btn-primary my-4 w-100">Add</button>
                </form>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session(key: 'message') }}</div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <th scope="row">{{$loop->index}}</th>
                                <td
                                    class="{{ $task->completed ? 'text-decoration-line-through' : '' }} d-flex justify-content-between">
                                    {{ $task->title }}
                                    @if(!$task->completed)
                                        <div class="d-flex gap-1">
                                            <form method="POST"
                                                action="{{ route('tasks.update', ['task' => $task, 'completed' => 1]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                    </svg></button>
                                            </form>
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                    </svg></button>
                                            </form>
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">Copyright© 2020 All Rights Reserved.</div>
    </div>
</body>

</html>