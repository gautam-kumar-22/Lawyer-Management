<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ __('case.Add New File')  }}</h4>
            <button type="button" class="close " data-dismiss="modal">
                <i class="ti-close "></i>
            </button>
        </div>
        @php
            $form_id = 'team_add_form';
            if(isset($quick_add)){
            $form_id = 'quick_add_team';
            }
        @endphp
        {!! Form::open(['url' => route('file.store', ['case' => $case_id, 'date' => $date_id]), 'method' => 'post', 'id' => $form_id, 'files' =>true, 'data-parsley-focus' => 'none' ]) !!}
        <div class="modal-body ">
            <div class="row">
                @includeIf('case.file')

                <div class="col-xl-12 text-center mt-3">
                    <button class="primary_btn_large submit" type="submit"><i
                            class="ti-check"></i>{{ __('common.Create') }}
                    </button>
                    <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                        <i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                    </button>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    _formValidation('#{{$form_id}}');

    // for upload attach file when apply leave
    var fileInput = document.getElementById('attach_file');
    if (fileInput) {
        fileInput.addEventListener('change', showFileName);

        function showFileName(event) {
            "use strict";
            var fileInput = event.srcElement;
            document.getElementById('placeholderAttachFile').placeholder = fileInput.files[0].name;
        }
    }

</script>
