<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="container">
    

    <div class="tab-content mt-4" id="proposalTabsContent">
    @include('logout')
        <div class="tab-pane fade show active" id="submit" role="tabpanel">
            <h2>Submit a Talk Proposal</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('proposal.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="speaker" class="form-label">Tag Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload Presentation (PDF)</label>
                    <input type="file" class="form-control" name="file" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Proposal</button>
            </form>
        </div>

        
    </div>
</div>
</body>
</html>
