@if($files)
    @foreach($files as $file)
        <div class="single-meta">
            <div class="d-flex align-items-center">
                <div class="name btn-modal flex-grow-1  btn-modal" data-container="file_modal" data-href="{{ route('file.show', $file->uuid) }}" style="cursor: pointer;">
                    {{ $loop->index + 1}}. {{ $file->user_filename }}
                </div>

                <div class="value mt-1">
                    @if(permissionCheck($type.'.edit'))
                        <span  class="primary-btn small fix-gr-bg icon-only  btn-modal" data-container="file_modal" data-href="{{ route('file.edit', $file->uuid) }}" style="cursor: pointer;"><i class="ti-pencil"></i></span>
                    @endif
                    @if(permissionCheck($type.'.destroy'))
                        <span style="cursor: pointer;"
                              data-url="{{route('file.destroy', $file->uuid)}}" id="delete_item" class="primary-btn small fix-gr-bg icon-only"><i class="ti-trash"></i></span>
                    @endif
                </div>

            </div>

        </div>
    @endforeach
@endif
