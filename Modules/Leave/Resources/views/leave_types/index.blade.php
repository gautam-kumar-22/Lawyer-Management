@extends('backEnd.master')
@section('mainContent')
    @include("backEnd.partials.alertMessage")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="admin-visitor-area up_st_admin_visitor">

        @include('leave::leave_types.components.create')
        @include('leave::leave_types.components.edit')
        @include('backEnd.partials.deleteModalAjaxRequest',['item_name' => 'Leave Type'])

        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                        <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('leave.Leave Type') }} </h3>
                            @if(permissionCheck('leave_types.store'))
                            <ul class="d-flex">
                                <li><button class="primary-btn radius_30px mr-10 fix-gr-bg" onclick="createModalShow()" ><i class="ti-plus"></i>{{ __('common.Add New') }} {{ __('leave.Leave Type') }}</button></li>
                            </ul>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <div class="" id="item_table">
                                {{-- Leave Type List --}}
                                @include('leave::leave_types.components.list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


@push('scripts')

    <script>
        var baseUrl = $('#app_base_url').val();

        $(document).ready(function() {

            $('#item_create_form').on('submit',function(event){
                event.preventDefault();
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name,element.value);
                });
                formData.append('_token',"{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('leave_types.store')}}",
                    type:"POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:function(response){
                        resetAfterChange(response.TableData)
                        toastr.success('Leave Type has been created successfully!')
                        $('#item_add').modal('hide');
                    },
                    error:function(response) {
                        showValidationErrors('.item_create_form',response.responseJSON.errors);
                    }
                });
            });

            $('#item_edit_form').on('submit',function(event){
                event.preventDefault();
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name,element.value);
                });
                formData.append('_token',"{{ csrf_token() }}");
                formData.append('id',$('#item_id').val());
                $.ajax({
                    url: "{{ route('leave_types.update')}}",
                    type:"POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:function(response){
                        resetAfterChange(response.TableData)
                        toastr.success('Leave Type has been updated successfully!')
                        $('#item_edit').modal('hide');
                    },
                    error: function(response) {
                        showValidationErrors('.item_edit_form',response.responseJSON.errors);
                    }
                });
            });

            $('#deleteItemModal').on('submit',function(event){
                event.preventDefault();
                var formData = new FormData();
                formData.append('_token',"{{ csrf_token() }}");
                formData.append('id',$('#delete_item_id').val());
                $.ajax({
                    url: "{{ route('leave_types.delete')}}",
                    type:"POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success:function(response){
                        resetAfterChange(response.TableData);
                        toastr.success('Leave Type has been deleted successfully!')
                        $('#deleteItemModal').modal('hide');
                    },
                    error: function(response) {
                        toastr.error('Something wrong !')
                    }
                });
            });

        });

        function createModalShow(){
            $('#item_add').modal('show');
            resetForm();
        }

        function showValidationErrors(formType, errors){
            $(formType +' #name_error').text(errors.name);
            $(formType +' #total_days_error').text(errors.percentage);
            $(formType +' #status_error').text(errors.quantity);
        }

        function showDeleteModal(imteId){
           $('#delete_item_id').val(imteId);
           $('#deleteItemModal').modal('show');
        }

        function editItem(item){
           $('#item_edit').modal('show');
           $('#item_id').val(item.id);
           $(".item_edit_form #name").val(item.name);
           $('.item_edit_form #total_days').val(item.total_days);
           if(item.status == 1){
                $('.item_edit_form #status_active').prop("checked", true);
                $('.item_edit_form #status_inactive').prop("checked", false);
           }else{
                $('.item_edit_form #status_active').prop("checked", false);
                $('.item_edit_form #status_inactive').prop("checked", true);
           }
        }

        function resetForm(){
            $('form')[0].reset();
            $('#name_error').text('');
            $('#percentage_error').text('');
        }

        function resetAfterChange(tableData){
            $('#item_table').empty();
            $('#item_table').html(tableData);
            startDatatable();
            resetForm();
        }

    </script>
@endpush
