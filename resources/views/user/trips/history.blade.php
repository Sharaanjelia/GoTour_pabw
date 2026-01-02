@foreach($trips->where('status', 'completed') as $trip)
    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
        <div style="width:70px;height:70px;overflow:hidden;border-radius:10px;background:#eee;flex-shrink:0;">
            @if($trip->package->cover_image_url)
                <img src="{{ $trip->package->cover_image_url }}" alt="cover" style="width:100%;height:100%;object-fit:cover;">
            @else
                <span style="display:block;width:100%;height:100%;background:#ccc;text-align:center;line-height:70px;">?</span>
            @endif
        </div>
        <div style="flex:1;">
            <h4 style="margin:0 0 0.2em 0;">{{ $trip->package->name ?? $trip->package->title }}</h4>
            <p style="margin:0 0 0.2em 0;">Status: {{ $trip->status }}</p>
            <div style="display:flex;gap:0.5rem;align-items:center;">
                @if(!$trip->testimonial)
                    <a href="{{ route('testimoni.create', ['package_id' => $trip->package->id, 'trip_id' => $trip->id]) }}" class="btn btn-primary">Beri Testimoni</a>
                @else
                    <span class="badge badge-success">Sudah Memberi Testimoni</span>
                @endif
            </div>
            @if($trip->testimonial)
                <div style="margin-top:0.5em;">
                    <b>Testimoni:</b> {{ $trip->testimonial->message }}
                </div>
            @endif
        </div>
    </div>
@endforeach
