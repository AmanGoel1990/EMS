<form action="{{ route('talk-proposals.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="title" class="block font-bold">Title</label>
        <input type="text" id="title" name="title" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
        <label for="description" class="block font-bold">Description</label>
        <textarea id="description" name="description" class="w-full border rounded p-2" required></textarea>
    </div>
    <div class="mb-4">
        <label for="tags" class="block font-bold">Tags</label>
        <select name="tags[]" id="tags" class="w-full border rounded p-2" multiple>
            <!-- Dynamically populate tags -->
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="file" class="block font-bold">Upload Presentation (PDF)</label>
        <input type="file" id="file" name="file" class="w-full border p-2" accept="application/pdf" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
</form>
