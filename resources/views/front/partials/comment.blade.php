<div id="commentFormSection"
     class="my-4 d-flex rounded-3 p-3 position-relative {{ $level === 0 ? 'bg-primary bg-opacity-15' : '' }}"
     style="margin: {{ ($level * 2).'px' }}" data-id="{{ $comment->id }}">
    <img class="avatar avatar-md rounded-circle float-start me-3"
         src="{{ getAvatarImage($comment->user->profile->avatar) }}" alt="avatar">
    <div class="w-100">
        <div class="mb-2">
            <h5 class="m-0">{{ $comment->user->name }}</h5>

            <span class="me-3 small">{{ humanReadableDate($comment->created_at) }}</span>
            <a href="javascript:void(0)"
               class="text-primary fw-normal reply-toggle"
               data-comment-id="{{ $comment->id }}">
                پاسخ به این دیدگاه
            </a>
        </div>

        <p>{{ $comment->body }}</p>

        <div class="reply-form mt-2 d-none" id="reply-form-{{ $comment->id }}">
            <form method="POST" action="{{ route('comment.store', $article) }}">
                @csrf

                <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                <textarea
                    name="body"
                    rows="6"
                    class="form-control mb-2"
                    placeholder="پاسخ شما..."></textarea>

                <button type="submit" class="btn btn-sm btn-primary">ارسال پاسخ</button>
            </form>
        </div>

        @if(!$comment->is_approved && auth()->check() && auth()->id() == $comment->user_id)
            <div class="badge bg-warning bg-opacity-25 text-dark position-absolute" style="top: 20px; left: 20px;">نظر
                شما پس از تأیید مدیر، در دید عموم قرار
                خواهدگرفت.
            </div>
        @endif
    </div>

</div>

@forelse($comment->replies as $reply)
    @include('front.partials.comment', ['comment' => $reply, 'level' => $level + 15])
@empty
@endforelse

