<x-filament::page>
    <div style="padding: 20px;">
        <div style="
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 20px; 
            margin-top: 20px;
        ">
            @foreach ($pilots as $pilot)
                @if ($pilot->status === 'Online')  {{-- Solo mostrar si está en línea --}}
                    <div style="
                        border: 1px solid #ddd; 
                        padding: 10px; 
                        border-radius: 8px;
                        background-color: #f9f9f9;
                        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                    ">
                        <h2 style="font-size: 18px; margin-bottom: 10px; text-align: center;">
                            {{ $pilot->name }}
                        </h2>

                        <div style="position: relative; height: 0; padding-top: 56.25%;">
                            <iframe
                                src="https://mediamtx.ddns.net:8889/lives/{{ $pilot->streaming_key }}"
                                style="
                                    position: absolute; 
                                    top: 0; 
                                    left: 0; 
                                    width: 100%; 
                                    height: 100%; 
                                    border: none;
                                "
                                allow="camera; microphone; fullscreen"
                            ></iframe>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-filament::page>
