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
                        {{ $post->loadCount('post_attachments')->post_attachments_count }}
                    </td>
                    <td>
                        {{ $post->loadCount('comments')->comments_count }}
                    </td>
                    <td>
                        {{ $post->sumCommentsAttachmentCount() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr />

@endforeach
