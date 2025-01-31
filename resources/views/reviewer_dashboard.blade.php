<div class="container">
    <h1 class="text-xl font-bold mb-4">Reviewer Dashboard</h1>

    <!-- <form method="GET" class="mb-6">
        <div class="flex gap-4">
            <input type="text" name="speaker_name" placeholder="Search by speaker name" class="border rounded p-2">
            <select name="tag" class="border rounded p-2">
                <option value="">Filter by Tag</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}" {{ request('tag') === $tag->name ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date_submitted" class="border rounded p-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form> -->

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border p-2">Tags</th>
                <th class="border p-2">Date Submitted</th>
                <th class="border p-2">File</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($talkproposal as $proposal)
                <tr>
                    
                    <td class="border p-2">{{ $proposal->tagname }}</td>
                    <td class="border p-2">{{ $proposal->created_at }}</td>
                    <!-- <td class="border-p-2"><a href="{{ route('show', ['filename' => $proposal->filepath]) }}" target="_blank">Open PDF</a> -->
                    <td><embed src="{{ asset('storage/' . $proposal->filepath) }}" type="application/pdf" width="100%"  /></td>
                    <td><a href="{{route('review', ['id' => $proposal->id])}}" class="post-id" data-id="{{ $proposal->id }}" target="_blank">Edit</a></td>    
                </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
