@foreach ($users as $user)

    <h2>{{ $user->name }} posts</h2>

    <table>
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Attachments
                </th>
                <th>
                    Comments
                </th>
                <th> Comment Attachments

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->posts as $post)
                <tr>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        {{ $post->post_attachments()->count() }}
                    </td>
                    <td>
                        {{ $post->comments()->count() }}
                    </td>
                    <td>
                        {{ $post->comments->reduce(function ($carry, $comment) {
    return $carry + $comment->comment_attachments()->count();
}) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr />

@endforeach
