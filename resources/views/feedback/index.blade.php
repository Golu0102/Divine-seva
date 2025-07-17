<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .star {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }
        .star.hovered,
        .star.selected {
            color: #ffc107;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card mx-auto shadow" style="max-width: 600px;" x-data="{ rating: 0, hover: 0 }">
        <div class="card-body">

            @if (session('submitted'))
                <h3 class="text-success text-center mb-3">🙏 Thank you for your feedback!</h3>
                <p class="text-center text-muted">We appreciate your time and response.</p>

            @elseif($feedback)
                <h3 class="text-warning text-center mb-3">😊 Feedback already submitted</h3>
                <p class="text-center text-muted">Thank you for your valuable input.</p>

            @else
                <h4 class="mb-3">🙏 Thank you for booking with us, {{ $booking->name }}!</h4>
                <form method="POST" action="{{ url('/feedback/' . $booking->id) }}">
                    @csrf

                    <!-- Star Rating -->
                    <div class="mb-4">
                        <label class="form-label">Your Rating:</label>
                        <div>
                            <template x-for="star in 5" :key="star">
                                <span
                                    class="star"
                                    :class="{'hovered': hover >= star, 'selected': rating >= star}"
                                    @click="rating = star"
                                    @mouseover="hover = star"
                                    @mouseleave="hover = 0"
                                >★</span>
                            </template>
                        </div>
                        <input type="hidden" name="rating" :value="rating">
                        @error('rating')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="mb-4">
                        <label for="comment" class="form-label">Your Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Write your thoughts..."></textarea>
                        @error('comment')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning fw-bold">Submit Feedback</button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>

</body>
</html>
