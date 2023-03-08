@extends('layouts.main', ['title' => 'Announcement'])

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Announcement</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Announcement</div>
        </div>
    </div>

    @include('components.message')

    <div class="section-body">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pinned Announcement</h4>
                    </div>
                    <div class="card-body">
                        <textarea type="text" class="pinned_announcement" id="pinned_announcement">{{ $announcement->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Announcements</h4>
                        @if(Auth::user()->role->id != 3)
                        <div style="margin-left: auto;">
                            <a href="{{ route('announcements.create') }}" class="btn btn-primary">New Announcement</a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="announcementTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Announce at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('modals.announcement.show')
@endsection

@push('js')
<script src="{{ asset('assets/js/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.pinned_announcement').summernote('disable');
    });

    $('.pinned_announcement').summernote({
        placeholder: 'Tidak ada announcement yang di pin!',
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
    });

    jQuery(function() {
        var announcementTable = $('#announcementTable').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            ajax: "{{ route('ajax.announcements.index') }}",
            columns: [{
                    "data": "id",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'announced_at',
                    name: 'announced_at'
                },
                {
                    data: 'actions',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        $('#announcementTable').on('click', '.show', function() {
            var url = $(this).data('url');

            $('#pinned_announcement_modal').summernote('disable');

            $('#showAnnouncement').modal({
                backdrop: 'static',
                keyboard: false
            });

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    var markupStr = $('.pinned_announcement').eq(1).summernote('code',
                        response.data.description);
                    $('#title').html(response.data.title);
                    $('#announced_at').html(response.data.announced_at);
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        });

        const deleteAnnouncement = (url) => {
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {

                    swal(response.message, {
                        icon: 'success',
                    }).then((accept) => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#announcementTable').on('click', '.delete', function() {
            var url = $(this).data('url');
            swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this data!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        deleteAnnouncement(url);
                    }
                });
        });
    });
</script>
@endpush