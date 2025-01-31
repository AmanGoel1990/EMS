<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="talk_proposal_id" value="{{ $proposal->id }}">
    <div class="mb-4">
        <label for="rating" class="block font-bold">Rating</label>
        <select id="rating" name="rating" class="w-full border rounded p-2">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="mb-4">
        <label for="comments" class="block font-bold">Comments</label>
        <textarea id="comments" name="comments" class="w-full border rounded p-2" required></textarea>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Review</button>
</form>
