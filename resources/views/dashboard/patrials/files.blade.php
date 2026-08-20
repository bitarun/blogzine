<div class="row mt-5 border pt-4 px-3 rounded overflow-y-auto" style="max-height: 700px">
@foreach($files as $file)
    <div class="col-sm-12 col-md-3 mb-4 position-relative">
        <div class="form-check position-absolute z-1" style="left: 20px; top: 10px;">
            <input name="selectedFiles[]" value="{{ $file->id }}" type="checkbox"
                   class="form-check-input">
        </div>
        @php
            $name = $file->name;
            $type = explode('/' ,$name)[0];
            $fileName = explode('/' ,$name)[1];

            $icons = [
                'audios' => 'audio',
                'applications' => 'archive',
                'texts' => 'word'
            ]
        @endphp
        @if($type == 'images')
            <img class="clickable-element border rounded p-2 clickable-image shadow-sm"
                 src="{{ asset('uploads/file_manager/' . $name) }}" alt=""
                 data-url="{{ asset('uploads/file_manager/' . $name) }}">
        @elseif($type == 'videos')
            <video class="clickable-element" controls data-url="{{ asset('uploads/file_manager/' . $name) }}">
                <source src="{{ asset('uploads/file_manager/' . $name) }}" type="">
            </video>
        @elseif($type === 'texts')
            <a class="clickable-element d-flex flex-column justify-content-center align-items-center gap-2 bg-light h-100 img-thumbnail"
               href="{{ asset('uploads/file_manager/' . $name) }}"
               data-url="{{ asset('uploads/file_manager/' . $name) }}">

                <i class="far fa-file-{{ $icons[$type] }} fs-3 text-info"></i>
                <div class="text-center">{{ $fileName }}</div>
            </a>
        @else
            <div class="clickable-element d-flex flex-column justify-content-center align-items-center gap-2 bg-light h-100 img-thumbnail"
                 data-url="{{ asset('uploads/file_manager/' . $name) }}">
                <i class="far fa-file-{{ $icons[$type] }} fs-3 text-info"></i>
                <div class="text-center">{{ $fileName }}</div>
            </div>
        @endif
    </div>
    @endforeach
    </div>
