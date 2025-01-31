<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="container">
    <div class="tab-content mt-4" id="proposalTabsContent">
        <div class="tab-pane fade show active" id="submit" role="tabpanel">
            <h2>Feedback</h2>
            <form action="{{ route('reviewerfeedback') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="text" class="form-control" name="rating" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <input type="text" class="form-control" name="comment" required>
                </div>
                <input type="hidden" name="proposal_id" value="{{$id}}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        
    </div>
</div>
</body>
</html>