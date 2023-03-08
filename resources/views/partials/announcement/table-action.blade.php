<div class="buttons">
    <button type="button" class="btn-sm btn-icon btn-success show" data-url="{{ route('ajax.announcements.getAnnouncement', $announcement->id) }}"><i class="fas fa-eye"></i></button>
    @if(Auth::user()->role->id != 3)
    <a href="{{ route('announcements.edit', $announcement->id) }}"><button class="btn-sm btn-icon btn-primary edit"><i class="far fa-edit"></i></button></a>
    <button type="button" class="btn-sm btn-icon btn-danger delete" data-announcement="{{$announcement->id}}" data-url="{{ route('ajax.announcements.destroy', $announcement->id) }}"><i class="fas fa-times"></i></button>
    @endif
</div>
