<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="container">
    @include('logout')
    <h1 class="text-xl font-bold mb-4">Reviewer Dashboard</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form action="{{route('filter')}}" method="GET" class="mb-6">
        <div class="flex gap-4">
            <select name="user" class="border rounded p-2">
                <option value="">Filter by speaker name</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user') === $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            <select name="tag" class="border rounded p-2">
                <option value="">Filter by Tag</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag') === $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date_submitted" class="border rounded p-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border p-2">Tags</th>
                <th class="border p-2">Speaker Name</th>
                <th class="border p-2">Date Submitted</th>
                <th class="border p-2">File</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($talkproposal as $proposal)
                <tr>
                    
                    <td class="border p-2">{{ $proposal->tagname }}</td>
                    <td class="border p-2">{{ $proposal->speaker_name }}</td>
                    <td class="border p-2">{{ date('d-m-Y', strtotime($proposal->created_at)); }}</td>
                    <td><a href="{{route('pdf.download', ['file' => $proposal->filepath])}}" class="post-id" data-id="{{ $proposal->id }}"><i class="fas fa-file-pdf text-danger"></i></a></td>
                    <td><a href="{{route('review', ['id' => $proposal->id])}}" class="post-id" data-id="{{ $proposal->id }}" target="_blank">Edit</a></td>    
                </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
</body>
</html>