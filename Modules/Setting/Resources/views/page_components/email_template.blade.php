@foreach($email_templates as $key => $template)
    <div class="tab-pane fade white_box_30px" id="{{ $template->type }}" role="tabpanel" aria-labelledby="{{ $template->type }}-tab">

        {!! Form::open(['url' => route('template_update'), 'method' => 'post', 'id' => "template_update_{$template->type}", 'files' =>true ]) !!}
            @csrf
            <!-- content  -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="primary_input mb-25">
                        {{ Form::label('subject', __('setting.Subject') , ['class' => 'primary_input_label required']) }}
                        {{ Form::text('subject', $template->subject , ["class" => "primary_input_field", "placeholder" => __('setting.Subject'), "required"]) }}
                      </div>
                </div>

                <div class="col-xl-4">
                    <div class="primary_input mb-25 mt-40">
                        <label class="primary_checkbox d-flex  align-items-center ">
                            {{ Form::checkbox('status', 1, $template->status) }}
                            <span class="checkmark mr-12"></span>
                            <p>Active</p>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="primary_input mb-25">

                        {{ Form::label('value', __('setting.Quotation Template') , ['class' => 'primary_input_label required']) }}

                        {{ Form::textarea('value', $template->value , ["class" => "summernote3", "placeholder" =>'']) }}
                    </div>
                </div>
            </div>
            {{ Form::hidden('name', $template->type) }}

            <div class="submit_btn text-center mb-20 pt_15">
                <button class="primary_btn_large submit" type="submit"> <i class="ti-check"></i> {{ __('common.Save') }}</button>

                <button class="primary_btn_large submitting" type="submit" disabled style="display: none;"> <i class="ti-check"></i> {{ __('common.Saving') }}</button>
            </div>
            <!-- content  -->
        {!! Form::close() !!}

            <div class="row mb-80">
                <div class="col-xl-12">
                   <strong>Available variables:</strong> <p>{{ $template->available_variable }}</p>
                </div>
            </div>
    </div>

    @push('js_after')

        <script>
            _formValidation2('{{ "template_update_{$template->type}" }}');
        </script>

    @endpush
    @endforeach

