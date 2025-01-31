
<div class="container">
    

    <div class="tab-content mt-4" id="proposalTabsContent">
        <!-- Submit Proposal Tab -->
        <div class="tab-pane fade show active" id="submit" role="tabpanel">
            <h2>Submit a Talk Proposal</h2>
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
