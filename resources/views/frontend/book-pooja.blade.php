@extends('frontend.layouts.frontend')

@section('title', 'Book a Pooja')

@section('content')
    <div class="container py-12 px-4 mx-auto">
        <h2 class="text-3xl font-laila text-brand-maroon font-bold text-center mb-6">Book a Pooja</h2>

        <form action="{{ route('book.pooja') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
            @csrf

            {{-- Select Pooja --}}
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Select Pooja</label>
                <select name="pooja_id"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    required>
                    <option value="">-- Select a Pooja --</option>
                    @foreach ($poojas as $pooja)
                        <option value="{{ $pooja->id }}">{{ $pooja->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Show Pooja Price -->
            <div id="price-wrapper" class="mb-4 hidden">
                <label class="block font-medium text-brand-maroon">Price</label>
                <input type="text" id="pooja-price" readonly
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2">
            </div>


            {{-- Select Pandit --}}
            <select name="pandit_id" id="pandit-select"
                class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon p-2" required>
                <option value="">-- Select Pandit --</option>
                @foreach ($pandits as $pandit)
                    <option value="{{ $pandit->id }}">{{ $pandit->name }}</option>
                @endforeach
            </select>


            <!-- Name -->
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Your Name</label>
                <input type="text" name="name"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    placeholder="Enter your full name" required>
            </div>

            <!-- Mobile -->
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Mobile Number</label>
                <input type="text" name="mobile"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    placeholder="10-digit number" required>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Address</label>
                <textarea name="address" rows="3"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    placeholder="Your full address" required></textarea>
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Select Date</label>
                <input type="date" name="date"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    required>
            </div>

            <!-- Time -->
            <div class="mb-4">
                <label class="block font-medium text-brand-maroon">Preferred Time</label>
                <input type="time" name="time"
                    class="mt-1 block w-full rounded-md border border-brand-maroon bg-amber-50 text-brand-maroon placeholder-gray-500 focus:ring-brand-orange focus:border-brand-orange shadow-sm p-2"
                    required>
            </div>


            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-brand-orange text-white font-semibold px-6 py-2 rounded-md hover:bg-opacity-90 transition">Confirm
                    Booking</button>
            </div>
            <script>
                const poojaPrices = @json($poojas->pluck('price', 'id'));
            </script>
            <script>
                const poojaPanditsMap = @json(
                    $poojas->mapWithKeys(function ($pooja) {
                        return [$pooja->id => [$pooja->pandit->id => $pooja->pandit->name]];
                    }));
            </script>


        </form>
    </div>
@endsection
