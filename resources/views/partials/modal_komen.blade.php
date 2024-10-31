@foreach($tasks as $task)
    <div class="modal fade" id="commentModal{{ $task->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel{{ $task->id }}">
                        Komentar untuk {{ $task->teknisi->name ?? 'Teknisi Tidak Ditemukan' }} - {{ $task->category ?? 'Kategori Tidak Ditemukan' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="comments-section mb-3">
                        @if($task->comments->isEmpty())
                            <p>Tidak ada komentar.</p>
                        @else
                            @foreach($task->comments as $comment)
                                <div class="comment mb-2">
                                    <strong>{{ $comment->user->name }}</strong> <em>{{ $comment->created_at->diffForHumans() }}</em>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <form action="{{ route('comments.store', $task->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="comment{{ $task->id }}" class="form-label">Tambah Komentar</label>
                            <textarea class="form-control" id="comment{{ $task->id }}" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
