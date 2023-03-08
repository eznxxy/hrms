@extends('layouts.main', ['title' => 'Edit announcement'])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.css') }}">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Announcement</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Announcement</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        @include('components.message')

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit announcement</h4>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="formAnnouncement">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title <span class="text-danger"><strong>*</strong></span></label>
                                    <input type="text" class="form-control" value="{{ $announcement->title }}"
                                        placeholder="Perubahan jadwal" name="title" required>
                                </div>

                                <div class="form-group">
                                    <label>Description <span class="text-danger"></span></label>
                                    <textarea name="description" id="description">{{ $announcement->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_pinned" name="is_pinned"
                                            value="true" {{ $announcement->is_pinned ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_pinned">
                                            Pinned Announcement
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" id="btnSubmit" type="button">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/js/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#description').summernote({
            placeholder: 'Mulai per tanggal sekian jadwal telah berubah',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        $('#btnSubmit').click(function() {
            var formArray = $('#formAnnouncement').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.announcements.update', $announcement->id) }}",
                data: formArray,
                beforeSend: function() {
                    $('#btnSubmit').prop('disabled', true);
                    $('#btnSubmit').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#btnSubmit').removeClass('btn-progress');
                        $('#btnSubmit').prop('disabled', false);

                        window.location = "{{ route('announcements.index') }}";
                    });
                },
                error: function(xhr) {
                    $('#btnSubmit').removeClass('btn-progress');
                    $('#btnSubmit').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        });
    </script>
@endpush
