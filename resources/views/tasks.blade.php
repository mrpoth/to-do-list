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
            <form method="POST" action="{{ route('tasks.store') }}" class="mb-2">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="title" placeholder="Insert task name" name="title">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
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
    </div>
</body>

</html>